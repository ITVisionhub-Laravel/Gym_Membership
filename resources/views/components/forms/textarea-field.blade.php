

@props([
    'type'=>'text','name','value','wireValue'
])

@if ($wireValue)
    <textarea  wire:model.defer="{{ $name }}" name="{{ $name }}" class="form-control" rows="3">{{$value}}</textarea>
    @else
    <textarea name="{{ $name }}" class="form-control" rows="3">{{$value}}</textarea>
@endif


{{-- <input type="{{$type}}" name="" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}> --}}