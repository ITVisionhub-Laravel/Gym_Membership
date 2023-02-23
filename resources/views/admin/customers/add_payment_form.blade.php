<x-admin>
<div class="row">
    <div class="col-md-12">
        <x-successmessage/>
        <div class="card">
            <div class="card-header">
                <h3>Pay Fee
                    <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/payFees') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                                        
                    {{--  <div class="row">  --}}
                        
                        <x-forms.forminput name="member_id" value="{{ $member_id }}" id="member_id" placeholder="Member Id" required readonly/>
                        <x-forms.dropdownfield :dropdownValues="$providers" name="payment" labelName="Payment Methods" width="col-md-3"></x-forms.dropdownfield>
                        <x-forms.dropdownfield :dropdownValues="$packages" name="package" labelName="Packages" width="col-md-3"></x-forms.dropdownfield>
                        <x-forms.forminput name="promotion" id="promotion" placeholder="Promotion" required readonly/>
                        <x-forms.forminput name="original_price" id="original_price" placeholder="Original Price" labelName="original price" required readonly/>     
                        <x-forms.forminput type="number" id="price" name="price"  placeholder=" Price" required readonly/>
                        
                    {{--  </div>  --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Pay</button>
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
