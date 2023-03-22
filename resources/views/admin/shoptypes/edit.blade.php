<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit Products
                    <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <x-forms.dropdownfield :dropdownValues="$brands" checkOldValue="{{ $product->brand_id }}" name="brand_id" labelName="Brands"  width="col-md-6"></x-forms.dropdownfield>
                        <x-forms.dropdownfield :dropdownValues="$categories" checkOldValue="{{ $product->category_id }}" name="category_id" labelName="Categories" width="col-md-6"></x-forms.dropdownfield>
                    </div>

                     <div class="row">
                        <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $product->name }}" width="col-md-6" />
                        <x-forms.forminput name="slug" placeholder="Enter Slug" value="{{ $product->slug }}" width="col-md-6" />
                    </div>

                    <div class="row">
                        <x-forms.forminput name="buying_price" placeholder="Enter Buying Price" value="{{ $product->buying_price }}" labelName="buying price" width="col-md-4" />
                        <x-forms.forminput name="selling_price" placeholder="Enter Selling Price" value="{{ $product->selling_price }}" labelName="selling price" width="col-md-4" />
                        <x-forms.forminput name="quantity" placeholder="Enter Quantity" value="{{$product->quantity}}" labelName="quantity" width="col-md-4" />
                    </div>
                     
                    <div class="row">
                        <x-forms.forminput name="small_description" labelName="small description" value="{{$product->small_description}}" type="textarea" width="col-md-6" />
                        <x-forms.forminput name="description" value="{{$product->description}}" type="textarea" width="col-md-6" />    
                    </div> 
                    <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$product->image}}" width="col-md-6"/>
                    
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