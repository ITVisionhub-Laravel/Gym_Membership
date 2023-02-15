<x-admin>
<div class="row">
            <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Slider
                            <a href="{{url('admin/sliders/')}}" class="btn btn-danger text-white btn-sm float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/sliders/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    <x-forms.forminput name="title" placeholder="Title" value="{{$slider->title}}" width="col-md-12"/>
                    <x-forms.forminput type="textarea" name="description" value="{{$slider->description}}" width="col-md-12"/>
                    <x-forms.forminput name="image" type="file" placeholder="Image" value="{{$slider->image}}" width="col-md-12"/>

                    <div class="mb-3">
                    <label for="">Status </label><br>
                    <input type="checkbox" name="status" {{$slider->status=='1'?'checked':''}} style="width:30px;height:30px" />Checked=Hidden,Unchecked=Visible
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