@props(['name','placeholder','type'=>'text','width'=>'col-md-6','errors','labelName','value'=>''])
 
    <x-forms.field width="{{ $width }}">
        <x-forms.label value="{{ $labelName??$name }}"/>
        @if ($type == 'textarea')
            <x-forms.textarea-field name="{{ $name }}" value="{{ $value }}"/>
        @else
            <x-forms.input name="{{ $name }}" id="{{ $id??$name }}" placeholder="{{ $placeholder }}" type="{{ $type }}" value="{{ $value??'' }}"/>
        @endif
        @if ($name == 'image' && $value!='')
            <img src="{{asset($value)}}" width="50px" height="50px" alt=""/>
        @endif
        <x-input-error :messages="$errors->get('$name')" class="text-danger" fieldName="$name" />
    </x-forms.field>