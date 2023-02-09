@props(['message'])
@error
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

{{--  @if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
    @else
    <ul>
        <li>
            hello
        </li>
    </ul>
@endif  --}}