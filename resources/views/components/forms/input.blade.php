@props([
    'name',
    'label' => null,
    'type' => 'text',
    'help' => null,
    'required' => null,
])

@php
    if(!$label){
        $label = ucwords(str_replace('_', ' ', $name));
    }
@endphp

<div class="space-y-1">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="form-error-text">*</span>
        @endif
    </label>
    @if($help)
        <p class="form-help-text">{!! $help !!}</p>
    @endif

    <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $slot->isEmpty() ? '' : $slot) }}"
            {{ $attributes->merge(['class' =>
                'form-text-input'
            ]) }}
            @if($required) required @endif
    >

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
