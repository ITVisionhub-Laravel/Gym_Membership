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

    <div class="row">
        <div class="col-md-12">
            <x-successmessage />
            <div class="card">
                <div class="card-header" style="background-color: #334860 ">
                    <h3 class="text-white">User Register form
                        <a href="{{ url('/') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
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
                                        placeholder="Enter Your Name" width="col-md-3" />
                                    <x-forms.forminput name="email" value="{{ $userinfo->email }}"
                                        placeholder="Enter Your Email" type="email" width="col-md-3" />
                                    <x-forms.forminput name="age" value="{{ $userinfo->age }}"
                                        placeholder="Enter Your Age" type="number" width="col-md-3" />
                                    <x-forms.forminput type="file" name="image" width="col-md-3"
                                        placeholder="Enter Your Image" value='' width="col-md-3" />
                                </div>


                                <div class="row">
                                    <x-forms.dropdownfield :dropdownValues="$gymclasses" name="gymclass" labelName="Classes"
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
                        <div class="pt-3">
                            <fieldset class="reset pt-2">
                                <legend class="reset">Address:</legend>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Country</label>
                                        <select id="street-dd" class="form-select" name="country">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">State</label>
                                        <select id="street-dd" class="form-select" name="state">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <x-forms.dropdownfield :dropdownValues="$cities" name="city"
                                        width="col-md-4"></x-forms.dropdownfield>
                                    <div class="form-group col-md-4">
                                        <label for="">Township</label>
                                        <select id="township-dd" class="form-select" name="township">
                                        </select>
                                        <x-forms.input-error name="township" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Ward</label>
                                        <select id="street-dd" class="form-select" name="ward">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Street</label>
                                        <select id="street-dd" class="form-select" name="street">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Block No</label>
                                        <select id="street-dd" class="form-select" name="block_no">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Floor No</label>
                                        <select id="street-dd" class="form-select" name="floor">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Zip Code</label>
                                        <select id="street-dd" class="form-select" name="zipcode">
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        {{--  <div class="pt-3">
                    <fieldset class="reset pt-2">
                        <legend class="reset">Payment:</legend>
                      --}}
                        {{-- <x-forms.dropdownfield :dropdownValues="$providers" name="payment" labelName="Bank Type" width="col-md-4"></x-forms.dropdownfield>
                        <x-forms.forminput type="file" name="bank_slip" placeholder="Enter Your Online Payment" width="col-md-4"/>
                          --}}
                        {{--  <div class="row">

                        <x-forms.dropdownfield :dropdownValues="$packages" name="package" labelName="Packages" width="col-md-3"></x-forms.dropdownfield>
                        <x-forms.forminput name="promotion" id="promotion" placeholder="Promotion" required readonly/>
                        <x-forms.forminput name="original_price" id="original_price" placeholder="Original Price" labelName="original price" required readonly/>
                        <x-forms.forminput type="number" id="price" name="price"  placeholder=" Price" required readonly/>

                    </div>
                    </fieldset>
                </div>  --}}
                        <div class="mb-3 pt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-script />
    <x-addressfieldjs />
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
