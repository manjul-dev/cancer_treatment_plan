@extends('admin.layout')

@section('content')
    <div class="container">
        <form action="javascript:void(0)" method="POST" data-url="{{ route('admin.cancer.store') }}" id='cancerType'>
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="type">Type</label>
                    <input type="text" class="form-control mb-2" name="type" id="type" placeholder="Cancer Type">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
            <div id="type-error" class="error"></div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $("#cancerType").validate({
            // rules: {
            //     type: {
            //         required: true
            //     }
            // },
            submitHandler: function (from) {
                let formData = new FormData($('#cancerType')[0]);
                let url = $("#cancerType").data('url');
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
                        showErrors(error);
                        $.LoadingOverlay('hide');
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