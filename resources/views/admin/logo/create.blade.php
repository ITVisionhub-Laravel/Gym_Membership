<x-admin>
<div class="row">
            <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
                <div class="card w-50 mx-auto">
                    <div class="card-header">
                        <h3>Add Logo
                            <a href="{{url('admin/logo')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/logo')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Image </label><br>
                                <input type="file" name="image" class="form-control">
                            </div>
                             <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                             </div> 
                        </form>
                    </div>
                </div>
            </div>
    </div>
<x-slot name="scripts">
</x-slot>
</x-admin>