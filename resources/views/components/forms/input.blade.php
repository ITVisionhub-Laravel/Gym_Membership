

@props([
    'type'=>'text','name', 'id','placeholder','wireValue'
])
{{--    --}}
<input $wireValue?wire:model.defer="{{ $name }}" type="{{$type}}" name="{{ $name }}" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>