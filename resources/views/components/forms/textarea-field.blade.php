

@props([
    'type'=>'text','name','value'
])

<textarea name="{{ $name }}" class="form-control" rows="3">{{$value}}</textarea>

{{-- <input type="{{$type}}" name="" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}> --}}