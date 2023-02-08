@props(['value'])

<label>
    {{ $value ? ucwords($value): $slot }}
</label>
