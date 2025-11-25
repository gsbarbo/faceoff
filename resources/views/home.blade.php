@extends('layouts.public')

@section('content')
    <div class="container max-w-4xl mx-auto grid md:grid-cols-9 gap-3">
        <div class="col-span-2 gap-3 grid grid-cols-1">
            <div class="card">
                <h1 class="flex items-center text-lg border-b-2 border-b-steel-gray">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z"/>
                    </svg>
                    Team Rankings
                </h1>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-gray-300">
                        <p>1st: Team 1</p>
                        <p class="text-green-500">+2</p>
                    </div>

                    <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                        <p>2nd: Team 1</p>
                        <p class="text-green-500">+2</p>
                    </div>

                    <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                        <p>3rd: Team 1</p>
                        <p class="text-green-500">+2</p>
                    </div>

                    <div class="flex justify-between items-center pb-2 border-b border-gray-300">
                        <p>4th: Team 1</p>
                        <p class="text-red-500">-2</p>
                    </div>

                    <div class="flex justify-end items-center">
                        <a href="#" class="underline text-base hover:text-teal-500">View All</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <h1 class="flex items-center text-lg border-b-2 border-b-steel-gray">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z"/>
                    </svg>
                    Next Matches
                </h1>

                <div class="space-y-2 text-sm">
                    <div class="py-2 border-b border-gray-300">
                        <p class="text-gray-400 text-xs">Event Title</p>
                        <p class="text-center underline">Team 1 v Team 2</p>
                        <p class="text-gray-400 text-xs">Dec 5 - 3pm CST</p>
                    </div>

                    <div class="py-2 border-b border-gray-300">
                        <p class="text-gray-400 text-xs">Event Title</p>
                        <p class="text-center underline">Team 1 v Team 2</p>
                        <p class="text-gray-400 text-xs">Dec 5 - 3pm CST</p>
                    </div>

                    <div class="py-2 border-b border-gray-300">
                        <p class="text-gray-400 text-xs">Event Title</p>
                        <p class="text-center underline">Team 1 v Team 2</p>
                        <p class="text-gray-400 text-xs">Dec 5 - 3pm CST</p>
                    </div>

                    <div class="py-2 border-b border-gray-300">
                        <p class="text-gray-400 text-xs">Event Title</p>
                        <p class="text-center underline">Team 1 v Team 2</p>
                        <p class="text-gray-400 text-xs">Dec 5 - 3pm CST</p>
                    </div>

                    <div class="flex justify-end items-center">
                        <a href="#" class="underline text-base hover:text-teal-500">View All</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-5">
            {{--            <flux:card class="">--}}
            {{--                <flux:heading size="lg" class="text-center">Welcome to FaceOff!</flux:heading>--}}
            {{--                <flux:text>Insert nice graphic with a short about us under it.</flux:text>--}}
            {{--            </flux:card>--}}

            {{--            <flux:card class="mt-3">--}}
            {{--                <flux:heading size="lg" class="text-center">Recent News</flux:heading>--}}
            {{--                <flux:separator/>--}}
            {{--                <flux:text>This is just a place for the most recent 5 articles.</flux:text>--}}
            {{--            </flux:card>--}}
        </div>

        <div class="col-span-2">
            {{--            <flux:card>--}}
            {{--                <flux:heading size="lg" class="flex items-center">--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
            {{--                         stroke="currentColor" class="size-4 mr-1">--}}
            {{--                        <path stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                              d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0 1 18 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 0 1 6 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5"/>--}}
            {{--                    </svg>--}}
            {{--                    Recent VODs--}}
            {{--                </flux:heading>--}}
            {{--                <flux:separator/>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Event Title</p>--}}
            {{--                        <p class="text-center font-semibold underline">Team 1 v Team 2</p>--}}
            {{--                        <p class="text-gray-400 text-xs">Nov 23 - 3pm CST</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Event Title</p>--}}
            {{--                        <p class="text-center font-semibold underline">Team 1 v Team 2</p>--}}
            {{--                        <p class="text-gray-400 text-xs">Nov 23 - 3pm CST</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Event Title</p>--}}
            {{--                        <p class="text-center font-semibold underline">Team 1 v Team 2</p>--}}
            {{--                        <p class="text-gray-400 text-xs">Nov 23 - 3pm CST</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </flux:card>--}}

            {{--            <flux:card class="mt-3">--}}
            {{--                <flux:heading size="lg" class="text-center">AD SPACE or whatever</flux:heading>--}}
            {{--            </flux:card>--}}

            {{--            <flux:card class="mt-3">--}}
            {{--                <flux:heading size="lg" class="flex items-center">--}}
            {{--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
            {{--                         stroke="currentColor" class="size-4 mr-1">--}}
            {{--                        <path stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                              d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>--}}
            {{--                    </svg>--}}
            {{--                    Social Media--}}
            {{--                </flux:heading>--}}
            {{--                <flux:separator/>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="flex justify-between items-center py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Twitter</p>--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
            {{--                             stroke="currentColor" class="size-4 text-gray-400">--}}
            {{--                            <path stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                                  d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>--}}
            {{--                        </svg>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="flex justify-between items-center py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Twitter</p>--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
            {{--                             stroke="currentColor" class="size-4 text-gray-400">--}}
            {{--                            <path stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                                  d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>--}}
            {{--                        </svg>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="space-y-2 text-xs">--}}
            {{--                    <div class="flex justify-between items-center py-2 border-b border-gray-300">--}}
            {{--                        <p class="text-gray-400 text-xs">Twitter</p>--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
            {{--                             stroke="currentColor" class="size-4 text-gray-400">--}}
            {{--                            <path stroke-linecap="round" stroke-linejoin="round"--}}
            {{--                                  d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>--}}
            {{--                        </svg>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </flux:card>--}}
        </div>
    </div>
@endsection
