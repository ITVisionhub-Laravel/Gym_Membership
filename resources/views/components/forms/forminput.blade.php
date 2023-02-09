@props(['name','placeholder','type'=>'text','width'=>'col-md-6','errors','labelName','value'])
 
    <x-forms.field width="{{ $width }}">
        <x-forms.label value="{{ $labelName??$name }}"/>
        <x-forms.input name="{{ $name }}" id="{{ $id??$name }}" placeholder="{{ $placeholder }}" type="{{ $type }}" value="{{ $value??old($name) }}"/>
        @if ($name == 'image' && $value!='')
            <img src="{{asset('/uploads/customer/'.$value)}}" width="50px" height="50px" alt=""/>
        @endif
        <x-forms.input-error name="{{ $name }}"/>
    </x-forms.field>