@extends('admin')

@section('content')

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
                            <x-forms.forminput name="title" placeholder="Title" width="col-md-12" />
                            <x-forms.forminput name="description" type="textarea" width="col-md-12" />
                            <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12"  />
                           
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

@endsection