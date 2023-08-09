@props(['name','placeholder','type'=>'text','width'=>'col-md-2','errors','labelName','value'=>'','wireValue'=>false,'wireClick'=>false,'wireFunction'=>""])
 
    <x-forms.field width="{{ $width }}">
        <x-forms.label value="{{ $labelName??$name }}"/>
        @if ($type == 'textarea')
            <x-forms.textarea-field wireValue="{{ $wireValue }}" name="{{ $name }}" value="{{ $value }}"/>
        @else
            <x-forms.input wireClick="{{ $wireClick }}" wireFunction="{{ $wireFunction }}" wireValue="{{ $wireValue }}" name="{{ $name }}" id="{{ $id??$name }}" placeholder="{{ $placeholder }}" type="{{ $type }}" value="{{ $value??'' }}"/>
        @endif
        @if ($name == 'image' && $value!='')
            <img src="{{asset($value)}}" width="50px" height="50px" alt=""/>
        @endif
        <x-forms.input-error name="{{ $name }}"/>
    </x-forms.field>