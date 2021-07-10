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

        
    </script>
@endsection