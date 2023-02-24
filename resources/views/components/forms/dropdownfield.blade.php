@props(['dropdownValues','name','width'=>'col-md-6','labelName','id','checkOldValue'=>''])
{{--  @dd($checkOldValue)  --}}
<div {{ $attributes->merge(['class' => 'form-group ' . $width]) }}>
    <x-forms.label value="{{ $labelName ?? $name }}"/>
    <x-forms.dropdown :optionValues="$dropdownValues" id="{{ $id ?? $name }}" name="{{ $name }}" checkOldValue="{{ $checkOldValue }}"></x-forms.dropdown>
    <x-forms.input-error name="{{ $name }}"/>
</div>