@props(['messages'])
@if ($messages)
    @foreach ((array) $messages as $message)
        <x-ui.form-error {{ $attributes }}>{{ $message }}</x-ui.form-error>
    @endforeach
@endif
