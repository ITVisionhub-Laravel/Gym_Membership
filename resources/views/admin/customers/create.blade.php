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
                        <x-forms.forminput name="name" placeholder="Enter Your Name"/>
                        <x-forms.forminput name="age" placeholder="Enter Your Age" type="number"/>
                    </div>

                    <div class="row pt-3">
                        <x-forms.forminput type="number" name="member_card_id" placeholder="Enter Your Member Card Number" width="col-md-4" labelName="member card id"/>
                        <x-forms.forminput type="number" name="height" placeholder="Enter Your Height" width="col-md-4"/>
                        <x-forms.forminput name="weight" placeholder="Enter Your Weight" width="col-md-4"/>
                    </div>
               
                    <div class="row pt-3">
                        <x-forms.dropdownfield :dropdownValues="$cities" name="city" width="col-md-4"></x-forms.dropdownfield>  
                        <div class="form-group col-md-4">
                            <label for="">Township</label>
                            <select id="township-dd" class="form-select" name="township" >
                            </select>
                            <x-forms.input-error name="township"/>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Street</label>
                            <select id="street-dd" class="form-select" name="street" >
                            </select>
                            <x-forms.input-error name="street"/>
                        </div>
                    </div>
                    
                    <div class="row pt-3">
                        <x-forms.forminput name="phone_number" placeholder="Enter Your Phone Number" labelName="mobile"/>        
                        <x-forms.forminput name="emergency_phone" placeholder="Enter Your Emergency Phone Number" labelName="emergency mobile"/>        
                    </div>
                    <div class="row pt-3">
                        <x-forms.dropdownfield :dropdownValues="$packages" name="package" width="col-md-3" labelName="Select Packages"></x-forms.dropdownfield>
                        <x-forms.forminput name="promotion" id="promotion" placeholder="Promotion" width="col-md-3" required readonly/>
                        <x-forms.forminput name="original_price" id="original_price" placeholder="Original Price" width="col-md-3" labelName="original price" required readonly/>     
                        <x-forms.forminput type="number" id="price" name="price"  placeholder="Original Price" width="col-md-3" required readonly/>
                        
                    </div>
                    <div class="row pt-3">
                        <x-forms.dropdownfield :dropdownValues="$providers" name="payment" labelName="Payment Methods" labelName="Choose One Payment Method"></x-forms.dropdownfield>
                        <x-forms.forminput type="file" name="image" placeholder="Enter Your Image" value=''/>    
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
