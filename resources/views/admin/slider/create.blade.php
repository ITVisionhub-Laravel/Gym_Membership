<x-admin>
<div class="row">
            <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Add Slider
                            <a href="{{url('admin/sliders')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/sliders')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                             <div class="mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="">Image </label><br>
                                <input type="file" name="image" class="form-control">
                            </div>

                             <div class="mb-3">
                                <label for="">Status </label><br>
                                <input type="checkbox" name="status" style="width:30px;height:30px" />Checked=Hidden,Unchecked=Visible
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