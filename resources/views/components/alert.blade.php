@props([
    'level' => 'info',
    'message' => '',
])

@php
    $colors = [
        'success' => 'text-green-400 focus:ring-green-400',
        'error'   => 'text-red-400 focus:ring-red-400',
        'warning' => 'text-yellow-400 focus:ring-yellow-400',
        'info'    => 'text-blue-400 focus:ring-blue-400',
    ];

    $color = $colors[$level] ?? $colors['info'];
@endphp

<div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:leave.duration.800ms
        class="flex items-center p-4 mb-4 rounded-lg bg-gray-800 {{ $color }}"
>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
         class="size-5 flex-shrink-0">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
    </svg>


    <div class="ml-3 text-sm font-medium">
        {!! $message !!}
    </div>

    <button @click="show = false" type="button"
            class="ml-auto p-1.5 rounded-lg bg-gray-800 hover:bg-gray-700 {{ $color }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>

    </button>
</div>