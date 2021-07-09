@extends('admin.layout')

@section('content')
    <div class="container">
        <h1 class="text-center">Create Doctor</h1>
        <hr>
        <form action="javascript:void(0)" method='POST' id='createDoctor' data-url={{ route('admin.doctor.store') }}>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <div class="error" id="name-error"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <div class="error" id="email-error"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="specialist">Specialist of</label>
                        <select name="specialist" id="specialist" class="form-control">
                            <option value="">--Select--</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <div class="error" id="specialist-error"></div>
                    </div>
                </div>
            </div>

            <div class="row">               
                <div class="col-sm-4 offset-sm-4">
                    <button type="submit" class="btn btn-dark btn-block">Submit</button>
                </div>
            </div>            
        </form>
    </div>
@endsection


@section('js')
    <script>
        $('#createDoctor').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                specialist: {
                    required: true
                }
            },

            submitHandler: function (form) {
                let formData = new FormData($('#createDoctor')[0]);
                let url = $("#createDoctor").data('url');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend(){
                        $.LoadingOverlay('show');
                    },
                    success(response){
                        $.LoadingOverlay('hide');
                    },
                    error(error) {
                        $.LoadingOverlay('hide');
                        showErrors(error);
                    }
                });
            }
        });

        function showErrors(error) {
            let errors = error.responseJSON.errors
            for(let key in errors)
            {
                let errorDiv = $(`#${key}-error`);
                errorDiv.html(errors[key][0]);
            }        
        }
    </script>
@endsection