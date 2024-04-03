<x-admin>

    <div class="card w-50 mx-auto ">
        <div class="card-header">
            <h3 class="text-center my-1">Create Schedule</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('schedule.store') }}" method="POST">
                @csrf
                <div class="row">
                    <x-forms.forminput name="hours_From" type="time" placeholder="Enter Start Time" width="col-md-6" />
                    <x-forms.forminput name="hours_To" type="time" placeholder="Enter End Time" width="col-md-6" />
                    <x-forms.dropdownfield :dropdownValues="$dayOfWeek" name="days_of_week_id" labelName="Day Of Week"
                        width="col-md-12"></x-forms.dropdownfield>
                </div>
                <button type="submit" class="btn btn-outline-success float-end mt-3">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>
