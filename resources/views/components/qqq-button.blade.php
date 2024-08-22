@props([
    "label",
    "action",
])

@if ($action == "submit")

<button type="submit" {{ $attributes }}>{{ $label }}</button>

@else

<a href="{{ $action }}" {{ $attributes }}>{{ $label }}</a>

@endif