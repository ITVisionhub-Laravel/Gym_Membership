

@props([
    'type'=>'text','name', 'id','placeholder'
])
{{--    --}}
<input type="{{$type}}" name="{{ $name }}" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>