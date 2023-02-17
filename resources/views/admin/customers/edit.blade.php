<x-admin>
    <div class="row">
        <div class="col-md-12">
            <x-successmessage></x-successmessage>
            <div class="card">
                <div class="card-header">
                    <h3>Edit Member
                        <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/customers/'.$customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row pt-2">
                            <x-forms.forminput name="name" placeholder="Enter Your Name" value="{{ $customer->name }}" width="col-md-3"/>
                            <x-forms.forminput name="age" placeholder="Enter Your Age" type="number" value="{{ $customer->age }}" width="col-md-3"/>
                            <x-forms.forminput name="email" placeholder="Enter Your Email" type="email" value="{{ $customer->email }}" width="col-md-3"/>
                                <x-forms.forminput type="file" name="image" placeholder="Enter Your Image" value="{{ '/uploads/customer/'.$customer->image }}" width="col-md-3"/>
                        </div>

                        <div class="row">
                            <x-forms.forminput type="number" name="member_card_id" placeholder="Enter Your Member Card Number" labelName="member card id" value="{{ $customer->member_card }}" width="col-md-3"/>
                            <x-forms.forminput type="number" name="height" placeholder="Enter Your Height" value="{{ $customer->height }}"/>
                            <x-forms.forminput name="weight" placeholder="Enter Your Weight" value="{{ $customer->weight }}"/>
                            <x-forms.forminput name="phone_number" placeholder="Enter Your Phone Number" labelName="mobile" value="{{ $customer->phone_number }}"/>        
                            <x-forms.forminput name="emergency_phone" placeholder="Enter Your Emergency Phone Number" labelName="emergency mobile" value="{{ $customer->emergency_phone }}" width="col-md-3"/> 
                        </div>

                        <div class="row">
                            <x-forms.dropdownfield :dropdownValues="$cities" checkOldValue="{{ $customer->address->street->township->city->id }}" name="city" width="col-md-4"></x-forms.dropdownfield>
                            @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                            <x-forms.dropdownfield :dropdownValues="$townships" id="township-dd" checkOldValue="{{ $customer->address->street->township->id }}" name="township" width="col-md-4"></x-forms.dropdownfield>
                            <x-forms.dropdownfield :dropdownValues="$streets" id="street-dd" checkOldValue="{{ $customer->address->street->id }}" name="street" width="col-md-4"></x-forms.dropdownfield>
                        </div>

                        <div class="row">
                            <x-forms.dropdownfield :dropdownValues="$providers" checkOldValue="{{ $payment_records[0]->paymentprovider->id }}" name="payment" id="payment" labelName="Payment Methods" width="col-md-3"></x-forms.dropdownfield>
                            <x-forms.dropdownfield :dropdownValues="$packages" checkOldValue="{{ $payment_records[0]->package->id }}" name="package" id="package" width="col-md-3" labelName="Select Packages" ></x-forms.dropdownfield>
                            <x-forms.forminput name="promotion" value="{{ $payment_records[0]->package->promotion }}" id="editPromotion" placeholder="Promotion" width="col-md-2" required readonly/>
                            <x-forms.forminput name="original_price" value="{{ $payment_records[0]->package->original_price }}" id="edit_original_price" placeholder="Original Price" labelName="original price" required readonly/>     
                            <x-forms.forminput type="number" value="{{ $payment_records[0]->price }}" id="editPrice" name="price"  placeholder="Original Price" required readonly/> 
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
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