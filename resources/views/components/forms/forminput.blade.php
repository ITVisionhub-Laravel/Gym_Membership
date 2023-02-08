@props(['name','placeholder','type'=>'text','width'=>'col-md-6'])

{{--  @dd($placeholder1)  --}}
  {{--  class="col-md-4"  --}}
    <x-forms.field width="{{ $width }}">
        <x-forms.label value="{{ $name }}"/>
        <x-forms.input name="{{ $name }}" placeholder="{{ $placeholder }}" type="{{ $type }}"/>
        <x-input-error :messages="$errors->get('{{ $name }}')" class="text-danger" />
    </x-forms.field>