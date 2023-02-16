<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Edit Logo
                    <a href="{{url('admin/logo/')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
            <form action="{{url('admin/logo/'.$logo->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label><br>
                    <input type="text" name="name" class="form-control" value="{{ $logo->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Image </label><br>
                    <input type="file" name="image" class="form-control">
                    <img src="{{asset("$logo->image")}}" style="width:50px;height:50px" alt="Logo">
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