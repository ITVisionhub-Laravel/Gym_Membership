<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit Products
                    <a href="{{ url('admin/categories') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/categories/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                     <div class="row">
                <x-forms.forminput name="name"  value="{{ $category->name }}" placeholder="Enter Name" width="col-md-6" />
                <x-forms.forminput name="slug"  value="{{ $category->slug }}" placeholder="Enter Slug" width="col-md-6" />
            </div>
            
            <div class="row">
                <x-forms.forminput name="small_description"  value="{{ $category->small_description }}" labelName="small description" type="textarea" width="col-md-6" />
                <x-forms.forminput name="description"  value="{{ $category->description }}" type="textarea" width="col-md-6" />    
            </div>  
             <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$category->image}}" width="col-md-12"/>
                    
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