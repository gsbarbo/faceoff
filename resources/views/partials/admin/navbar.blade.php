@php
    $currentPageStyles = "border-b border-b-teal-500";
@endphp

<nav x-data="{ mobileOpen:false }" class="w-full bg-charcoal-light shadow-sm text-sm">

    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between md:justify-normal">
        <div class="font-bold text-xl">FaceOff | Admin</div>

        <div class="hidden md:flex space-x-6 items-center ml-6 md:justify-between w-full">
            <div class="flex space-x-6 items-center ">
                <a href="{{route('home')}}"
                   class="hover:text-teal-500 @if(request()->routeIs('home')) {{$currentPageStyles}} @endif">Public</a>
                <a href="{{route('admin.dashboard')}}"
                   class="hover:text-teal-600 @if(request()->routeIs('admin.dashboard')) {{$currentPageStyles}} @endif">Dashboard</a>

                @access('admin.*')
                <x-navbar-dropdown title="Competition">
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Series</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Schedule
                        Series</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Series
                        Maps</a>
                    <a href="{{route('admin.teams.index')}}"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Teams</a>
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Players</a>
                </x-navbar-dropdown>
                @endaccess

                @access('admin.*')
                <x-navbar-dropdown title="Stats & Rankings">
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Team
                        Standings</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Player
                        Leaderboards</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Advanced
                        Stats</a>
                </x-navbar-dropdown>
                @endaccess

                @access('admin.*')
                <x-navbar-dropdown title="Game Content">
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Game Maps</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Map
                        Pool</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Game
                        Modes</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Banned
                        Items</a>
                </x-navbar-dropdown>
                @endaccess

                @access('admin.*')
                <x-navbar-dropdown title="Season & Events"
                                   :active="request()->routeIs('admin.games.*') || request()->routeIs('admin.seasons.*') || request()->routeIs('admin.events.*')">
                    <a href="{{route('admin.games.index')}}"
                       class="block px-3 py-1 hover:bg-charcoal-light hover:text-teal-500 @if(request()->routeIs('admin.games.*')) text-teal-500 @endif">Games</a>
                    <a href="{{route('admin.seasons.index')}}"
                       class="block px-3 py-1 hover:bg-charcoal-light hover:text-teal-500 @if(request()->routeIs('admin.seasons.*')) text-teal-500 @endif">Seasons</a>
                    <a href="{{route('admin.events.index')}}"
                       class="block px-3 py-1 hover:bg-charcoal-light hover:text-teal-500 @if(request()->routeIs('admin.events.*')) text-teal-500 @endif">Events</a>
                </x-navbar-dropdown>
                @endaccess

                @access('admin.*')
                <x-navbar-dropdown title="Content Management">
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">News Articles</a>
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Comments</a>
                    <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Page
                        Content</a>
                </x-navbar-dropdown>
                @endaccess

                @access('admin.*')
                <x-navbar-dropdown title="User Management">
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">All Users</a>
                    <a href="#"
                       class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Roles</a>
                </x-navbar-dropdown>
                @endaccess

                <a href="{{route('admin.dashboard')}}"
                   class="hover:text-teal-600 @if(request()->routeIs('admin.dashboard')) {{$currentPageStyles}} @endif">Site
                    Settings</a>


            </div>

            <div>
                @auth
                    <div x-data="{ open:false }" class="relative" @mouseleave="open = false">
                        <button
                                @mouseenter="open = true"

                                @click="open = !open"
                                class="flex items-center gap-1 hover:text-teal-500"
                        >
                            {{auth()->user()->discord_name}}
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
                                class="absolute bg-charcoal shadow-lg border border-zinc-800 rounded p-2 mt-2 w-40 z-50"
                        >
                            <a href="#"
                               class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Player
                                Area</a>
                            @access('admin.*')
                            <a href="{{route('admin.dashboard')}}"
                               class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Admin
                                Area</a>
                            @endaccess
                            <a href="#" class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500">Settings</a>
                            <hr class="my-2">
                            <form action="{{ route('logout') }}"
                                  class="block px-3 py-1 hover:bg-charcoal-light rounded hover:text-teal-500"
                                  method="POST">
                                @csrf
                                <a class=""
                                   href="#"
                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">

                                    Log out
                                </a>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{route('login.discord')}}" class="bg-[#7289da]! text-white! btn">Continue With Discord</a>
                @endguest


            </div>
        </div>

        <!-- MOBILE HAMBURGER -->
        <button class="md:hidden" @click="mobileOpen = true">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    <!-- MOBILE SIDEBAR -->
    <div x-show="mobileOpen" class="fixed inset-0 z-50 md:hidden" x-transition.opacity>

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/50" @click="mobileOpen = false"></div>

        <!-- SIDEBAR -->
        <div
                class="absolute left-0 top-0 w-72 h-full bg-white shadow-xl p-5 overflow-y-auto"
                x-transition:enter="transform duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
        >

            <div class="flex items-center justify-between mb-6">
                <span class="text-xl font-bold">Menu</span>
                <button @click="mobileOpen = false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- MOBILE DROPDOWNS -->
            <div class="space-y-4">

                <div x-data="{ open:false }">
                    <button @click="open = !open" class="flex justify-between w-full font-medium">
                        Teams
                        <svg class="w-5 h-5" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="pl-4 mt-2 space-y-1 text-gray-700">
                        <a href="#" class="block">All Teams</a>
                        <a href="#" class="block">Standings</a>
                    </div>
                </div>

                <div x-data="{ open:false }">
                    <button @click="open = !open" class="flex justify-between w-full font-medium">
                        Matches
                        <svg class="w-5 h-5" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="pl-4 mt-2 space-y-1 text-gray-700">
                        <a href="#" class="block">Schedule</a>
                        <a href="#" class="block">Results</a>
                    </div>
                </div>

                <a href="#" class="block font-medium">Stats</a>

            </div>

        </div>
    </div>

</nav>
