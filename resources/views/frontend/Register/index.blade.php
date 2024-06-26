<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <x-css></x-css>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Arial", sans-serif;
        }

        .card-header {
            background-color: rgba(243, 246, 248, 0.8);
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: rgba(35, 45, 57, 0.8);
        }

        .wrapper {
            width: 200px;
            height: 200px;
            background: #fff;
            border-radius: 16px;
            padding: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
    <x-frontend.navbar/>

        <div class="row" style="margin-top: 7rem !important;">
            <div class="col-md-12">
                <x-successmessage />
                <div class="card">
                    <div class="card-header" style="background-color: #232d39 ">
                        <h3 class="text-white">User Details form
                            <a href="{{ url('user_details') }}" class="btn btn-danger btn-sm text-white float-end" style="margin-left: 10px;">Back</a>
                            <a href="{{ url('user_address') }}" class="btn btn-success btn-sm text-white float-end">Add Address</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('create_qrcode') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="pt-1">
                                <fieldset class="reset">
                                    <legend class="reset">Personal Info:</legend>
                                    <div class="row pt-2">
                                        <x-forms.forminput name="name" value="{{ $userinfo->name }}"
                                            placeholder="Enter Your Name" width="col-md-2" />
                                        <x-forms.forminput name="email" value="{{ $userinfo->email }}"
                                            placeholder="Enter Your Email" type="email" width="col-md-2" />
                                        <x-forms.forminput name="age" value="{{ $userinfo->age }}"
                                            placeholder="Enter Your Age" type="number" width="col-md-2" />
                                        <div class="form-group col-md-3">
                                            <label for="Gender" class="mb-3">Gender</label><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="Gender">Male</label>
                                                    <input type="radio" id="Gender" name="gender" value="Male"
                                                        class="p-3" @checked(true)>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="Gender">Female</label>
                                                    <input type="radio" id="Gender" name="gender" value="Female">
                                                </div>
                                            </div>
                                        </div>
                                        <x-forms.forminput type="file" name="image" placeholder="Enter Your Image" 
                                            value='' width="col-md-3" />
                                    </div>
                                    <div class="row">
                                        <x-forms.dropdownfield :dropdownValues="$gymclasses" name="gym_class_id" labelName="Classes" :checkOldValue="$oldGymClassId"
                                            width="col-md-3"></x-forms.dropdownfield>
                                        <x-forms.forminput type="number" name="height" value="{{ $userinfo->height }}"
                                            placeholder="Enter Your Height" />
                                        <x-forms.forminput name="weight" value="{{ $userinfo->weight }}"
                                            placeholder="Enter Your Weight" />
                                        <x-forms.forminput name="phone_number" value="{{ $userinfo->phone_number }}"
                                            placeholder="Enter Your Phone Number" labelName="mobile" />
                                        <x-forms.forminput name="emergency_phone" value="{{ $userinfo->emergency_phone }}"
                                            placeholder="Enter Your Emergency Phone Number" labelName="emergency mobile"
                                            width="col-md-3" />
                                    </div>
                                </fieldset>
                            </div>
                            <div class="mb-3 pt-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  <x-script />  --}}
    {{-- <x-addressfieldjs /> --}}
</body>

</html>

<script>
    // JavaScript validation to ensure phone_number and emergency_phone are different
    document.addEventListener('DOMContentLoaded', function() {
        var phoneInput = document.getElementsByName('phone_number')[0];
        var emergencyInput = document.getElementsByName('emergency_phone')[0];

        phoneInput.addEventListener('input', validateNumbers);
        emergencyInput.addEventListener('input', validateNumbers);

        function validateNumbers() {
            if (phoneInput.value === emergencyInput.value) {
                emergencyInput.setCustomValidity("Emergency phone number must be different from phone number.");
            } else {
                emergencyInput.setCustomValidity("");
            }
        }
    });
</script>
