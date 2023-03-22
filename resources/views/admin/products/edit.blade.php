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
          <x-forms.dropdownfield :dropdownValues="$categories" name="category_id" labelName="Trainer Category" width="col-md-6"></x-forms.dropdownfield>
         <x-forms.dropdownfield :dropdownValues="$brands" name="brand_id" labelName="Trainer Brand" width="col-md-6"></x-forms.dropdownfield>        
        </div>

                  <div class="row">
                <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $product->name }}" width="col-md-6" />
                <x-forms.forminput name="slug" placeholder="Enter Slug"  value="{{ $product->slug }}" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="small_description" type="textarea"  value="{{ $product->small_description }}" placeholder="Enter small_description" width="col-md-6" />
                <x-forms.forminput name="description" type="textarea"  value="{{ $product->description }}" placeholder="Enter description" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="buying_price" placeholder="Enter buying_price"  value="{{ $product->buying_price }}" width="col-md-6" />
                <x-forms.forminput name="selling_price" placeholder="Enter selling_price"  value="{{ $product->selling_price }}" width="col-md-6" />
            </div>
            <div class="row">
                <x-forms.forminput name="quantity" placeholder="Enter quantity"  value="{{ $product->quantity }}" width="col-md-6" />
                <x-forms.forminput name="image" type="file" placeholder="Image"  value="{{ $product->image }}" width="col-md-6" />      
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