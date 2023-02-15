<x-admin>
<div class="row">
            <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Logo Image
                            <a href="{{url('admin/logo/create')}}" class="btn btn-primary text-white btn-sm float-end">Add Logo</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($logos as $logo)
                                   <tr>
                                    <td>{{$logo->id}}</td>
                                    <td>
                                        <img src="{{asset("$logo->image")}}" style="width:70px;height:70px" alt="logo">
                                    </td>
                                    <td>
                                        <a href="{{url('admin/logo/'.$logo->id.'/edit')}}" class="btn btn-success">Edit</a>
                                        <a href="{{url('admin/logo/'.$logo->id.'/delete')}}" 
                                            onclick="return confirm('Are you sure you want to delete this data?');"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>
<x-slot name="scripts">
</x-slot>
</x-admin>