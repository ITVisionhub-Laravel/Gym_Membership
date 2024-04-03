<x-admin>

    <div class="card w-50 mx-auto ">
        <div class="card-header">
            <h3 class="text-center my-1">Create Ward</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('ward.store') }}" method="POST">
                @csrf
                <div class="row">
                    <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
                    <x-forms.dropdownfield :dropdownValues="$township" name="township_id" labelName="Township"
                        width="col-md-12"></x-forms.dropdownfield>
                </div>
                <button type="submit" class="btn btn-outline-success float-end mt-3">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>
