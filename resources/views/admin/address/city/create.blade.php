<x-admin>

    <div class="card w-50 mx-auto ">
        <div class="card-header">
            <h3 class="text-center my-1">Create City</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('city.store') }}" method="POST">
                @csrf
                <div class="row">
                    <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
                    <x-forms.dropdownfield :dropdownValues="$states" name="state_id" labelName="State"
                        width="col-md-12"></x-forms.dropdownfield>
                </div>
                <button type="submit" class="btn btn-outline-success float-end mt-3">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>
