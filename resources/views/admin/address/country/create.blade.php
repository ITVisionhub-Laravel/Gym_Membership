<x-admin>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card w-50 mx-auto">
                <div class="card-header">
                    <h3>Create Country
                        <a href="{{ route('country.index') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('country.store') }}" method="POST"  >
                        @csrf
                        <div class="row">
                            <x-forms.forminput name="name" placeholder="Enter Name" width="col-md-12" />
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
