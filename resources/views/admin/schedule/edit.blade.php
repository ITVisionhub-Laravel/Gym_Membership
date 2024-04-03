<x-admin>

    <div class="card w-50 mx-auto ">
        <div class="card-header">
            <h3 class="text-center my-1">Edit Schedule</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-forms.forminput name="hours_From" type="time" value="{{ $schedule->hours_From }}"
                        placeholder="Enter Start Time" width="col-md-6" />
                    <x-forms.forminput name="hours_To" type="time" value="{{ $schedule->hours_To }}"
                        placeholder="Enter End Time" width="col-md-6" />
                    <x-forms.dropdownfield :dropdownValues="$dayOfWeek" name="days_of_week_id" labelName="Day Of Week"
                        width="col-md-12" :checkOldValue="$schedule->days_of_week_id"></x-forms.dropdownfield>
                </div>
                <button type="submit" class="btn btn-outline-success float-end mt-3">Update</button>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-admin>
