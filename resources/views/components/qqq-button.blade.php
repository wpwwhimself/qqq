@props([
    "label",
    "action",
    "active" => false,
])

@if ($action == "submit")

<button type="submit" {{ $attributes->class(["btn", "active" => $active]) }}>{{ $label }}</button>

@else

<a href="{{ $action }}" {{ $attributes->class(["btn", "active" => $active]) }}>{{ $label }}</a>

@endif