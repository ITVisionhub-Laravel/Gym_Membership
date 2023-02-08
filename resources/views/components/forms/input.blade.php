

@props([
    'type'=>'text','name','placeholder'
])

<input type="{{$type}}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>