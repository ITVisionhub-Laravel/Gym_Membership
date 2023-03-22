<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit Shops
                    <a href="{{ url('admin/shops') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/shops/'.$shop->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-forms.dropdownfield :dropdownValues="$products" checkOldValue="{{ $product->id }}" name="product_id" labelName="Products" width="col-md-6"></x-forms.dropdownfield>
                    <x-forms.dropdownfield :dropdownValues="$shopTypes" checkOldValue="{{ $shopType->id }}" name="shop_type_id" labelName="Shop Types" width="col-md-6"></x-forms.dropdownfield>
                    <x-forms.forminput name="quantity"  value="{{$shop->quantity}}" placeholder="Enter quantity" width="col-md-6" />
                    
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