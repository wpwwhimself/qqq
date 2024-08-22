@props([
    "type" => "text",
    "name",
    "label",
    "value" => null,
])

<div class="input-container">
    <label for="{{ $name }}">{{ $label }}</label>
    
    @switch($type)
        @case("TEXT")
        <textarea name="{{ $name }}" id="{{ $name }}">{{ $value }}</textarea>
            @break

        @default
        <input type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            {{ $attributes }}
        />
    @endswitch
</div>