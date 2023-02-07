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
                <div class="row pt-3">
                    <div class="form-group col-md-6">
                    <x-forms.formlabel value="Name"/>
                    <x-forms.forminput name="name" placeholder="Enter Your Name"/>
                    <x-input-error :messages="$errors->get('name')" class="text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-forms.formlabel value="Age"/>
                    <x-forms.forminput type="number" name="age" placeholder="Enter Your Age"/>
                    <x-input-error :messages="$errors->get('age')" class="text-danger" />
                </div>
                </div>
                <div class="row pt-3">
                    <div class="form-group col-md-4">
                    <x-forms.formlabel value="Member Card ID"/>
                    <x-forms.forminput type="number" name="member_card" placeholder="Enter Your Member Card Number"/>
                    <x-input-error :messages="$errors->get('member_card')" class="text-danger" />
                </div>
                <div class="form-group col-md-4">
                    <x-forms.formlabel value="Height"/>
                    <x-forms.forminput type="number" name="height" placeholder="Enter Your Height"/>
                    <x-input-error :messages="$errors->get('height')" class="text-danger" />
                </div>
                <div class="form-group col-md-4">
                    <x-forms.formlabel value="Weight"/>
                    <x-forms.forminput name="weight" placeholder="Enter Your Weight"/>
                    <x-input-error :messages="$errors->get('weight')" class="text-danger" />
                </div>
                </div>
                 <div class="row pt-3">
                <div class="form-group col-md-4">
                    <label for="">City</label>
                    <select  id="city" class="form-select" name="city" >
                            <option value="">Select City</option>
                            @foreach ($cities as $data)
                                <option  value="{{$data->id}}">
                                    {{$data->name}}
                                </option>
                            @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('city')" class="text-danger" />
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="">Township</label>
                        <select id="township-dd" class="form-select" name="township" >
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Street</label>
                        <select id="street-dd" class="form-select" name="street" >
                        </select>
                    </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                    <x-forms.formlabel value="Mobile"/>
                    <x-forms.forminput name="phone_number" placeholder="Enter Your Phone Number"/>
                    <x-input-error :messages="$errors->get('phone_number')" class="text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-forms.formlabel value="Emergency Mobile"/>
                    <x-forms.forminput name="emergency_phone" placeholder="Enter Your Emergency Phone Number"/>
                    <x-input-error :messages="$errors->get('emergency_phone')" class="text-danger" />
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-3">
                    <label for="">Select Packages</label>
                    <select  id="package-dd" class="form-select" name="package" >
                            <option value="">Select Package</option>
                            @foreach ($packages as $data)
                            <option  value="{{ $data->id." ".$data->promotion." ".$data->original_price }}">
                                {{$data->package}}
                            </option>
                            @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('package')" class="text-danger" />
                </div>
                <div class="form-group col-md-3">
                    <x-forms.formlabel value="Promotion"/>
                    <x-forms.forminput name="promotion" id="promotion" placeholder="Promotion" required readonly/>
                </div>
                <div class="form-group col-md-3">
                    <x-forms.formlabel value="Original Price"/>
                    <x-forms.forminput name="original_price" id="original_price" placeholder="Original Price" required readonly/>
                </div>
                <div class="form-group col-md-3">
                    <x-forms.formlabel value="Price"/>
                    <x-forms.forminput type="number" id="price" name="price"  placeholder="Original Price" required readonly/>
                </div>
                </div>
                <div class="row pt-3">
                <div class="form-group col-md-6">
                <label for="provider" class="form-label">Payment Methods</label>
                <select name="provider" class="form-select @error('provider') is-invalid @enderror" aria-label=".form-select-lg example">
                    <option selected>Choose One Payment Method</option>
                    @foreach($providers as $provider)
                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                    @endforeach
                    
                </select>
                
                @error('provider')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
                <div class="form-group col-md-6">
                    <x-forms.formlabel value="Image"/>
                    <x-forms.forminput type="file" name="age" placeholder="Enter Your Image"/>
                    <x-input-error :messages="$errors->get('image')" class="text-danger" />
                </div>
                </div>
                <div class="mb-3">
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
