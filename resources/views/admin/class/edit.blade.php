<x-admin>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card w-50 mx-auto">
                <div class="card-header">
                    <h3>Edit Gym Class
                        <a href="{{ route('class.index') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('class.update', $gymClass->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $gymClass->name }}"
                                width="col-md-6" />
                            <x-forms.dropdownfield :dropdownValues="$classCategory" name="gym_class_category_id" labelName="Classes"
                                width="col-md-3" :checkOldValue="$gymClass->gym_class_category_id"></x-forms.dropdownfield>
                        </div>
                        <div class="row">
                            <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-6" />
                            @if ($gymClass->image)
                                <img src="{{ $gymClass->image }}" alt="{{ $gymClass->name }}"
                                    style="width:150px;height:150px">
                            @endif
                            <x-forms.forminput name="description" type="textarea" value="{{ $gymClass->description }}"
                                width="col-md-12" />
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
