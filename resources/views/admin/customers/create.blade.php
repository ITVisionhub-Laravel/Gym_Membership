<x-admin>
<div class="row">
    <div class="col-md-12">
        <x-successmessage/>
        <div class="card">
            <div class="card-header">
                <h3>Add Member
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="reset">
                        <legend class="reset">Personal Info:</legend>
                        <div class="row pt-2">
                            <x-forms.forminput name="name"
                                placeholder="Enter Your Name" width="col-md-2" />
                            <x-forms.forminput name="email"
                                placeholder="Enter Your Email" type="email" width="col-md-2" />
                            <x-forms.forminput name="age"
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
                            <x-forms.dropdownfield :dropdownValues="$gymclasses" name="gym_class_id" labelName="Classes"
                                width="col-md-3"></x-forms.dropdownfield>
                            <x-forms.forminput type="number" name="height"
                                placeholder="Enter Your Height" />
                            <x-forms.forminput name="weight"
                                placeholder="Enter Your Weight" />
                            <x-forms.forminput name="phone_number"
                                placeholder="Enter Your Phone Number" labelName="mobile" />
                            <x-forms.forminput name="emergency_phone"
                                placeholder="Enter Your Emergency Phone Number" labelName="emergency mobile"
                                width="col-md-3" />
                        </div>
                    </fieldset>
                    <div class="pt-3">
                        <fieldset class="reset">
                            <legend class="reset">Social Info:</legend>
                            <div class="row">
                                <x-forms.forminput name="facebook" placeholder="Your Facebook" />
                                <x-forms.forminput name="twitter" placeholder="Your Twitter" />
                                <x-forms.forminput name="linkedIn" placeholder="Your LinkedIn" />
                            </div>
                        </fieldset>
                    </div>
                    <div class="pt-3">
                    <fieldset class="reset">
                        <legend class="reset">Address:</legend>
                        <div class="row">
                            <x-forms.dropdownfield :dropdownValues="$countries" name="country"
                            width="col-md-4" function="getStates" modelName="selectedCountry"></x-forms.dropdownfield>

                            <div class="form-group col-md-4">
                                <label for="">State</label>
                                <select id="state-dd" class="form-select" name="state">
                                    <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" >{{ $state->name }}</option>
                                        @endforeach
                                </select>
                                <x-forms.input-error name="street" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">City</label>
                                <select id="city-dd" class="form-select" name="city">
                                    <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" >{{ $city->name }}</option>
                                        @endforeach
                                </select>
                                <x-forms.input-error name="city" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Township</label>
                                <select id="township-dd" class="form-select" name="township">
                                    <option value="">Select Township</option>
                                        @foreach($townships as $township)
                                            <option value="{{ $township->id }}" >{{ $township->name }}</option>
                                        @endforeach
                                </select>
                                <x-forms.input-error name="township" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Ward</label>
                                <select id="ward-dd" class="form-select" name="ward">
                                    <option value="">Select Wards</option>
                                        @foreach($wards as $ward)
                                            <option value="{{ $ward->id }}" >{{ $ward->name }}</option>
                                        @endforeach
                                </select>
                                <x-forms.input-error name="street" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Street</label>
                                <select id="street-dd" class="form-select" name="street_id">
                                    <option value="">Select Wards</option>
                                        @foreach($streets as $street)
                                            <option value="{{ $street->id }}" >{{ $street->name }}</option>
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

                    {{--  <div class="pt-3">
                        <fieldset class="reset">
                            <legend class="reset">Payment:</legend>
                            <div class="row">
                                <x-forms.dropdownfield :dropdownValues="$providers" name="payment" labelName="Payment Methods" width="col-md-4"></x-forms.dropdownfield>
                                <x-forms.forminput type="file" name="bank_slip" placeholder="Enter Your Online Payment" width="col-md-4"/>
                                <x-forms.dropdownfield :dropdownValues="$gymclasses" name="gymclass" labelName="Classes" width="col-md-4"></x-forms.dropdownfield>
                            </div>
                            <div class="row">

                                <x-forms.dropdownfield :dropdownValues="$packages" name="package" labelName="Packages" width="col-md-3"></x-forms.dropdownfield>
                                <x-forms.forminput name="promotion" id="promotion" width="col-md-3" placeholder="Promotion" required readonly/>
                                <x-forms.forminput name="original_price" id="original_price" width="col-md-3" placeholder="Original Price" labelName="original price" required readonly/>
                                <x-forms.forminput type="number" id="price" name="price" width="col-md-3" placeholder=" Price" required readonly/>

                            </div>
                        </fieldset>
                    </div>  --}}
                    {{--  <div class="row">

                    </div>  --}}
                    <div class="mb-3 pt-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<x-slot name="scripts">
<x-addressfieldjs></x-addressfieldjs>
</x-slot>
</x-admin>
