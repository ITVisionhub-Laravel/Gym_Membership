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

                  
                      
                        <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $product->name }}" width="col-md-12" />
                        <x-forms.forminput name="price" placeholder="Enter Price" value="{{ $product->price }}" width="col-md-12" />

                        <x-forms.forminput name="quantity" placeholder="Enter Quantity" value="{{$product->quantity}}" labelName="quantity" width="col-md-12" />
                        <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$product->image}}" width="col-md-12"/>
                        
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