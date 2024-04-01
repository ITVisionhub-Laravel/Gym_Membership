<x-admin>

    <div class="card w-50 mx-auto ">
        <div class="card-header">
            <h3 class="text-center my-1">Class Create Form</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('class.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-6" />
                    <x-forms.dropdownfield :dropdownValues="$classCategories" name="gym_class_category_id" labelName="Class Category"
                        width="col-md-6"></x-forms.dropdownfield>

                    <x-forms.forminput name="description" type="textarea" width="col-md-12" />
                    <x-forms.forminput name="image" type="file" placeholder="Image" width="col-md-12" />

                </div>
                <button type="submit" class="btn btn-outline-success float-end mt-3">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>
