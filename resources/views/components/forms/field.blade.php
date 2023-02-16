@props(['width'])
<div {{ $attributes->merge(['class' => 'form-group  justify-content-center' . $width]) }}>
    {{ $slot }}
</div>

