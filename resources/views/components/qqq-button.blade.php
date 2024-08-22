@props([
    "label",
    "action",
    "active" => false,
])

@if ($action == "submit")

<button type="submit" {{ $attributes->class(["btn", "active" => $active]) }}>{{ $label }}</button>

@elseif ($action == "none")

<span {{ $attributes->class(["btn", "active" => $active]) }}>{{ $label }}</span>

@else

<a href="{{ $action }}" {{ $attributes->class(["btn", "active" => $active]) }}>{{ $label }}</a>

@endif
