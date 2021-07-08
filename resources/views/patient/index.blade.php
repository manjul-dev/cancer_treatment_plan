<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .error {color:red}
    </style>    
</head>

<body>
    <div class="container">
        <h1 class="text-center">Patient Registration Form</h1>
        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data" data-url="{{ route('patient.store') }}" id='store'>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name">
                        <div id="name-error" class="error"></div>
                    </div>
                    
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                        <div id="password-error" class="error"></div>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                        <div id="email-error" class="error"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">Contact</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Contact number" value="">
                        <div id="phone-error" class="error"></div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" name="state" id="state" onchange="populateCity()">
                            <option value="">--Select--</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state }}">{{ $state->state }}</option>
                            @endforeach
                        </select>
                        <div id="state-error" class="error"></div>
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control"></select>
                        <div id="city-error" class="error"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                        <div id="address-error" class="error"></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="pin">Pin Code</label>
                        <input type="text" class="form-control" name="pin" id="pin" placeholder="Enter pin code" onkeypress="return isNumber(event)" maxlength="6" minlength="6">
                        <div id="pin-error" class="error"></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="type">Cancer Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">--Select--</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <div id="type-error" class="error"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form group">
                        <label for="attachments">Documents</label>
                        <input type="file" name="attachment[]" id="attachment" multiple>
                        <div id="attachment-error" class="error"></div>
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
</body>

<script>
    function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
    
    // Populate the cities
    function populateCity() {
        let url = `{{ route("patient.cities") }}`;
        let state = $("#state").val();
        if (url && state) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: url,
                type: "POST",
                data: {state: state},
                beforeSend() {
                    $.LoadingOverlay("show");
                },

                success(response) {
                    $.LoadingOverlay('hide')
                    $("#city").html(response.html)
                },

                error(){
                    $.LoadingOverlay('hide')
                }
            });
        }

    }
    $.validator.addMethod(
        "regex",
        function(value, element, regex)
        {
            var re = new RegExp(regex);
            return this.optional(element) || re.test(value);
        },
        "Not a valid pattern"
    );

    $.validator.addMethod(
        'fileSize',
        function(value, el)
        {
            let files = $(`#${el.id}`)[0].files;
            let error = 0;
            for (let i= 0; i < files.length; i++)
            {
                let size = (files[i].size/ 1024);
                if (size > 10240) {
                    error++;
                }    
            }
            return (error === 0);
        },
        'File size cannot be greator than 10 MB'
    );
    // save form after validation
    $("#store").validate({
        rules: {
            name: {
                required: true
            },
            password: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                // regex: /^(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[789]\d{9}|(\d[ -]?){10}\d$/,
                regex: /^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[123456789]\d{9}$/
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            address: {
                required: true
            },
            pin: {
                required: true,
                regex: /^[1-9][0-9]{5}$/
            },
            type: {
                required: true
            },
            'attachment[]': {
                required: true,
                extension: 'jpg|jpeg|mp4|pdf|JPG|JPEG|MP4|PDF',
                fileSize: true
            }
        },
        submitHandler: function (form) {
            let formData = new FormData($('#store')[0]);
            let url = $("#store").data('url');
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
                    console.log(response);
                },
                error(error) {
                    showErrors(error)
                    $.LoadingOverlay('hide');
                }
            })
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
</html>