<x-admin>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card w-50 mx-auto">
                <div class="card-header">
                    <h3>Edit Ward
                        <a href="{{ route('ward.index') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ward.update', $ward->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <x-forms.forminput name="name" placeholder="Enter Name" value="{{ $ward->name }}"
                                width="col-md-12" />
                            <x-forms.dropdownfield :dropdownValues="$townships" name="township_id" labelName="Townshhip"
                                width="col-md-12" :checkOldValue="$ward->township_id"></x-forms.dropdownfield>
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
