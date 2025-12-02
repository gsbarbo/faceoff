@props(['title', 'active' => false])

<div x-data="{ open: false }" class="relative"
     @mouseenter="open = true"
     @mouseleave="open = false"
>
    <button
            @click.stop="open = !open"
            class="flex items-center gap-1 px-2 py-1 cursor-pointer
               hover:text-teal-500
               {{ $active ? 'border-b-2 border-teal-500' : '' }}"
    >
        {{ $title }}

        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="size-4 mt-0.5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
        </svg>
    </button>

    <div
            x-show="open"
            x-transition.opacity
            @click.away="open = false"
            class="absolute left-0 mt-2 w-52 bg-charcoal z-50
               shadow-lg border border-zinc-800 rounded p-2"
            style="display:none"
    >
        {{ $slot }}
    </div>
</div>