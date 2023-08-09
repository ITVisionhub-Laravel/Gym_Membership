

@props([
    'type'=>'text','name', 'id','placeholder','wireValue','wireClick','wireFunction'
])
{{--    --}}
{{--  @if ($wireClick)
    @endif  --}}
    @if ($wireClick)
    {{--  calculateDeliCost  --}}
    <input wire:model="{{ $name }}" wire:change="{{ $wireFunction }}()" wire:keydown="{{ $wireFunction }}()" wire:keyup="{{ $wireFunction }}()" type="{{$type}}" name="{{ $name }}" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>
    @elseif ($wireValue)
    <input wire:model.defer="{{ $name }}" type="{{$type}}" name="{{ $name }}" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>
    @else
    <input type="{{$type}}" name="{{ $name }}" id="{{$id}}" placeholder="{{ $placeholder }}" {{$attributes->merge(['class' => 'form-control']) }}>
    @endif