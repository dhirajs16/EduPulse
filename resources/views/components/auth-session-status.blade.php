@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm alert alert-success dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
