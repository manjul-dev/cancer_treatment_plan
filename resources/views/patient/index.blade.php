<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">Contact</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone no: +91/0 1234567890" value="">
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
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control"></select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="pin">Pin Code</label>
                        <input type="text" class="form-control" name="pin" id="pin" placeholder="Enter pin code" onkeypress="return isNumber(event)" maxlength="6" minlength="6">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="type">Cancer Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">--Select--</option>
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form group">
                        <label for="attachments">Documents</label>
                        <input type="file" name="attachment" id="attachment" multiple>
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
        let url = $('#store').data('url');
        let state = $("#state").val();
        if (url && state) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: "POST",
                data: {state: state},
                beforeSend() {
                    $.LoadingOverlay("show");
                },

                success(response) {
                    $.LoadingOverlay('hide')
                },

                error(){
                    $.LoadingOverlay('hide')
                }
            });
        }

    }
</script>
</html>