@props(['status'])
@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-ui-sm text-success']) }}>
        {{ $status }}
    </div>
@endif
