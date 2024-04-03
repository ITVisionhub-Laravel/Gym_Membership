<x-admin>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card w-50 mx-auto">
                <div class="card-header">
                    <h3>Edit City
                        <a href="{{ route('city.index') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('city.update', $city->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $city->name }}"
                                width="col-md-12" />
                            <x-forms.dropdownfield :dropdownValues="$state" name="state_id" labelName="Country"
                                width="col-md-12" :checkOldValue="$city->state_id"></x-forms.dropdownfield>
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
