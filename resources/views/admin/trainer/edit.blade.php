<x-admin>
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h3>Edit Trainer
                    <a href="{{ url('admin/trainers') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/trainers/'.$trainer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <x-forms.forminput name="name" placeholder="Enter Your Name" value="{{ $trainer->name }}" width="col-md-6"/>
                        <x-forms.forminput name="description" type="textarea" value="{{$trainer->description}}" width="col-md-6" />
                    </div>
                    <div class="row">
                        <x-forms.forminput name="fb_name" placeholder="Enter fb-name" value="{{ $trainer->fb_name }}" width="col-md-6" />
                        <x-forms.forminput name="twitter_name" placeholder="Enter twitter-name" value="{{ $trainer->twitter_name }}" width="col-md-6" />
                    </div>
                    <div class="row">
                        <x-forms.forminput name="linkin_name" placeholder="Enter linkin-name" value="{{ $trainer->linkin_name }}" width="col-md-6" />
                        
                        <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-6" />
                        @if ($trainer->image)
                        <img src="{{ $trainer->image}}" alt="Trainer IMG" style="width:150px; height:150px">
                        @endif
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