@props(['id','name','optionValues','checkOldValue','wireValue'])

@if ($wireValue)
        <select wire:model.defer="{{ $name }}" class="form-select" name="{{ $name }}">
        <option value="">Select {{ $name }}</option>
         @foreach ($optionValues as $data)
                <option  value="{{ $data->id }}" {{ $data->id==$checkOldValue ? 'selected':'' }}>
                    {{$data->name ?? $data->$name}}
                </option>
            @endforeach  
    </select>
    @else
        <select id="{{ $id }}" class="form-select" name="{{ $name }}">
        <option value="">Select {{ $name }}</option>
        @if ($name == "package")
            @foreach ($optionValues as $data)
                <option  value="{{ $data->id." ".$data->promotion." ".$data->original_price }}" {{ $data->id==$checkOldValue ? 'selected':'' }}>
                    {{$data->name ?? $data->$name}}
                </option>
            @endforeach
        @else
            @foreach ($optionValues as $data)
                <option  value="{{ $data->id }}" {{ $data->id==$checkOldValue ? 'selected':'' }}>
                    {{$data->name ?? $data->$name}}
                </option>
            @endforeach
        @endif   
    </select>
@endif
    