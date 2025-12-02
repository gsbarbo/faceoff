@props(['title'])

<div x-data="{ open:false }" class="relative" @mouseleave="open = false">
    <button
            @mouseenter="open = true"
            @click="open = !open"
            class="flex items-center gap-1 hover:text-teal-500 cursor-pointer"
    >
        {{$title}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
        </svg>
    </button>

    <div
            x-show="open"
            @mouseenter="open = true"
            @mouseleave="open = false"
            x-transition
            class="absolute bg-charcoal shadow-lg border border-zinc-800 rounded p-2 mt-2 w-52 z-50"
    >
        {{$slot}}
    </div>
</div>