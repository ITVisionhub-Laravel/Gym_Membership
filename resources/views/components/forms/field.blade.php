@props(['width'])
<div {{ $attributes->merge(['class' => 'form-group ' . $width]) }}>
    {{ $slot }}
</div>

