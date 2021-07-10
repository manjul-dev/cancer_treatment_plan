@extends('doctor.layout')

@section('content')
    <div class="container">
        <h1 class="text-center">Create Plan for Treatment</h1>
        <form action="javascript:void(0)" id="planForm" data-url="{{ route('doctor.createPlan') }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="password">Plan</label>
                        <textarea name="plan" id="plan" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <button class="btn btn-success btn-block">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#plan').summernote(summernoteConfig());
        });

        function summernoteConfig() {
            return {
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert',['table']]
                ]
            }
        }

        $("#planForm").validate({
            rules: {
                plan: {
                    required: true
                }
            },
            errorPlacement: function (error, element) {
                var id = $(element).attr('id');
                var name = $(element).attr('name');
                if (element.hasClass("summernote")) {
                    error.insertAfter(element.siblings(".note-editor"));
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: '.note-editor *',
            submitHandler: function (from) {
                let formData = new FormData($('#planForm')[0]);
                let url = $("#planForm").data('url');
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
    </script>
@endsection