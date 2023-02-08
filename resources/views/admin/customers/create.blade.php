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
                    <x-forms.forminput type="number" name="member_card_id" placeholder="Enter Your Member Card Number" width="col-md-4"/>
                    <x-forms.forminput type="number" name="height" placeholder="Enter Your Height" width="col-md-4"/>
                    <x-forms.forminput name="weight" placeholder="Enter Your Weight" width="col-md-4"/>
                </div>
                <div class="row pt-3">
                    <x-forms.dropdown>
                        <x-slot name="trigger">

                        </x-slot>
                    </x-forms.dropdown>
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
