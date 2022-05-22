<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <!-- Page Content -->
    <main>
        <div class="min-h-full">
            <div class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
                <!--
                  Off-canvas menu overlay, show/hide based on off-canvas menu state.

                  Entering: "transition-opacity ease-linear duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "transition-opacity ease-linear duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

                <!--
                  Off-canvas menu, show/hide based on off-canvas menu state.

                  Entering: "transition ease-in-out duration-300 transform"
                    From: "-translate-x-full"
                    To: "translate-x-0"
                  Leaving: "transition ease-in-out duration-300 transform"
                    From: "translate-x-0"
                    To: "-translate-x-full"
                -->
                <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-cyan-700">
                    <!--
                      Close button, show/hide based on off-canvas menu state.

                      Entering: "ease-in-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in-out duration-300"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button"
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <nav class="mt-5 flex-shrink-0 h-full divide-y divide-cyan-800 overflow-y-auto"
                         aria-label="Sidebar">
                        <div class="px-2 space-y-1">
                            <!-- Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600" -->
                            <a href="{{ route('dashboard') }}"
                               class="bg-cyan-800 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
                               aria-current="page">
                                <!-- Heroicon name: outline/home -->
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Home
                            </a>

                            <a href="#"
                               class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <!-- Heroicon name: outline/clock -->
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                User
                            </a>
                        </div>
                    </nav>
                </div>

                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col flex-grow bg-cyan-700 pt-5 pb-4 overflow-y-auto">
                    <nav class="mt-5 flex-1 flex flex-col divide-y divide-cyan-800 overflow-y-auto"
                         aria-label="Sidebar">
                        <div class="px-2 space-y-1">
                            <!-- Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600" -->
                            <a href="{{ route('dashboard') }}"
                               class="{{request()->routeIs('dashboard') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}"
                               aria-current="page">
                                <!-- Heroicon name: outline/home -->
                                <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Home
                            </a>

                            @can('view-users')
                                <a href="{{ route('users') }}"
                                   class="{{request()->routeIs('users') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    User
                                </a>
                            @endcan
                            @can('view-roles')
                                <a href="{{ route('roles') }}"
                                   class="{{request()->routeIs('roles') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                    </svg>
                                    Role
                                </a>
                            @endcan

                            @can('view-permissions')
                                <a href="{{ route('permissions') }}"
                                   class="{{request()->routeIs('permissions') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    Permission
                                </a>
                            @endcan
                            @can('view-departments')
                                <a href="{{ route('departments') }}"
                                   class="{{request()->routeIs('departments') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                        <path strokeLinecap="round" strokeLinejoin="round"
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Department
                                </a>
                            @endcan
                            @can('view-rosters')
                                <a href="{{ route('rosters') }}"
                                   class="{{request()->routeIs('rosters') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                                        <path strokeLinecap="round" strokeLinejoin="round"
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Roster
                                </a>
                            @endcan
                            @can('view-clock-in-clock-out')
                                <a href="{{ route('shifts') }}"
                                   class="{{request()->routeIs('shifts') ? 'bg-cyan-800 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md' : 'text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md'}}">
                                    <!-- Heroicon name: outline/clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Shift
                                </a>
                            @endcan
                        </div>
                    </nav>
                </div>
            </div>

            <div class="lg:pl-64 flex flex-col flex-1">
                @livewire('navigation-menu')
                <main class="flex-1 pb-8">
                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
