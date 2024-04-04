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
                    <h3 class="text-white">User Address form
                        <a href="{{ url('user_details') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('create_user_address') }}" method="POST">
                        @csrf
                        <div class="pt-3">
                            <fieldset class="reset pt-2">
                                <legend class="reset">Address:</legend>
                                <div class="row">
                                    <x-forms.dropdownfield :dropdownValues="$countries" name="country" :checkOldValue="$oldCountryId"
                                    width="col-md-4" function="getStates" modelName="selectedCountry"></x-forms.dropdownfield>

                                    <div class="form-group col-md-4">
                                        <label for="">State</label>
                                        <select id="state-dd" class="form-select" name="state">
                                            <option value="">Select State</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if($state->id == $oldStateId) selected @endif>{{ $state->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">City</label>
                                        <select id="city-dd" class="form-select" name="city">
                                            <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" @if($city->id == $oldCityId) selected @endif>{{ $city->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-forms.input-error name="city" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Township</label>
                                        <select id="township-dd" class="form-select" name="township">
                                            <option value="">Select Township</option>
                                                @foreach($townships as $township)
                                                    <option value="{{ $township->id }}" @if($township->id == $oldTownshipId) selected @endif>{{ $township->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-forms.input-error name="township" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Ward</label>
                                        <select id="ward-dd" class="form-select" name="ward">
                                            <option value="">Select Wards</option>
                                                @foreach($wards as $ward)
                                                    <option value="{{ $ward->id }}" @if($ward->id == $oldWardId) selected @endif>{{ $ward->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Street</label>
                                        <select id="street-dd" class="form-select" name="street_id">
                                            <option value="">Select Wards</option>
                                                @foreach($streets as $street)
                                                    <option value="{{ $street->id }}" @if($street->id == $oldStreetId) selected @endif>{{ $street->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-forms.input-error name="street" />
                                    </div>
                                    <x-forms.forminput name="block_no" placeholder="Enter Your Block No"
                                        width="col-md-4" value="{{ $userAddress->block_no ?? '' }}" />
                                    <x-forms.forminput name="floor" placeholder="Enter Your Floor No"
                                        width="col-md-4" value="{{ $userAddress->floor ?? '' }}" />
                                    <x-forms.forminput name="zipcode" placeholder="Enter Your Zipcode"
                                        width="col-md-4" value="{{ $userAddress->zipcode ?? '' }}" />
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
