@props([
    "name",
    "label",
    "value" => null,
    "options",
    "emptyOption" => false,
])

<div class="input-container">
    <label for="{{ $name }}">{{ $label }}</label>
    
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
    >
        @if ($emptyOption)
        <option value="">{{ $emptyOption ?? "---" }}</option>
        @endif

        @foreach ($options as $label => $val)
        <option value="{{ $val }}"
            @if ($value == $val) selected @endif
        >
            {{ $label }}
        </option>
        @endforeach
    </select>
</div>