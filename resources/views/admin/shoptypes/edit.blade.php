<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit ShopType
                    <a href="{{ url('admin/shoptypes') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/shoptypes/'.$shoptype->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     
                     <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $shoptype->name }}" width="col-md-6" />
                <x-forms.forminput name="email" placeholder="Enter Email" value="{{ $shoptype->email }}" width="col-md-6" />
            </div>
            
            <div class="row">
                <x-forms.forminput name="address" placeholder="Enter Address" labelName="address" value="{{ $shoptype->address }}" width="col-md-6" />
                <x-forms.forminput name="phone" placeholder="Enter Phone" labelName="phone" value="{{ $shoptype->phone }}" width="col-md-6" />
               </div>

            <div class="row">
                <x-forms.forminput name="hot_line" labelName="hot_line" placeholder="Enter hot-line" value="{{ $shoptype->hot_line }}" width="col-md-6" />
                <x-forms.forminput name="image" type="file" placeholder="Image" value="{{ $shoptype->image }}" width="col-md-6" />
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
</x-slot>
</x-admin>