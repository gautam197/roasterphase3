<div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
    <button type="button"
            class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: outline/menu-alt-1 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
        </svg>
    </button>
    <!-- Search bar -->
    <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Staff'))
            <div class="flex-1 flex justify-center">
                @php
                    $todayClockInClockOut = \Illuminate\Support\Facades\Auth::user()->todayClockInClockOut;
                    $todayLatestClockInClockOut = count($todayClockInClockOut) > 0 ? collect($todayClockInClockOut[0]['clock_in_clock_out'])->last() : null;
                @endphp
                @if(($todayClockInClockOut && ((count($todayClockInClockOut) > 0 && $todayClockInClockOut[0]['status'] === 'UNAPPROVED')) || count($todayClockInClockOut) === 0))
                    {{--                   iteration-2: clock in button--}}
                    <div  x-data="{ openClockIn: false }">
                        <button @click="openClockIn = true" type="button"
                                @if(isset($todayLatestClockInClockOut) && isset($todayLatestClockInClockOut['clock_in']) && !isset($todayLatestClockInClockOut['clock_out'])) disabled
                                @endif
                                class="@if(isset($todayLatestClockInClockOut) && isset($todayLatestClockInClockOut['clock_in']) && !isset($todayLatestClockInClockOut['clock_out']))inline-flex items-center px-3 py-2 my-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 @else inline-flex items-center px-3 py-2 my-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 @endif">
                            <!-- Heroicon name: solid/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Clock In
                        </button>
                        <div x-cloak x-show="openClockIn" class="fixed z-10 inset-0 overflow-y-auto"
                             aria-labelledby="modal-title"
                             role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                     aria-hidden="true"
                                     x-show="openClockIn"
                                     x-transition:enter="ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                ></div>
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                      aria-hidden="true">&#8203;</span>
                                <div
                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                    x-show="openClockIn"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-10"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                >
                                    <div>
                                        <div
                                            class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                            <!-- Heroicon name: outline/check -->
                                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-5">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Clock IN
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Are you sure you want to clock in ?
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                        <button @click="openClockIn = false" type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                            Cancel
                                        </button>
                                        <form method="POST" action="{{ url('clock-in')}}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 ml-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                                Clock In
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                iteration-2: clock out button--}}
                    <div  x-data="{ openClockOut: false }">
                        <button @click="openClockOut = true" type="button"
                                @if(count(\Illuminate\Support\Facades\Auth::user()->todayClockInClockOut) === 0 || isset($todayLatestClockInClockOut['clock_out']))  disabled
                                @endif
                                class="@if(count(\Illuminate\Support\Facades\Auth::user()->todayClockInClockOut) === 0 || isset($todayLatestClockInClockOut['clock_out'])) inline-flex items-center px-3 py-2 my-2 ml-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 @else inline-flex items-center px-3 py-2 my-2 ml-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 @endif">
                            <!-- Heroicon name: solid/mail -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Clock Out
                        </button>
                        <div x-cloak x-show="openClockOut" class="fixed z-10 inset-0 overflow-y-auto"
                             aria-labelledby="modal-title"
                             role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                     x-show="openClockOut"
                                     aria-hidden="true"
                                     x-transition:enter="ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                ></div>
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                      aria-hidden="true">&#8203;</span>
                                <div
                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                    x-show="openClockOut"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-10"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                >
                                    <div>
                                        <div
                                            class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                            <!-- Heroicon name: outline/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-5">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Clock Out
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Are you sure you want to clock out ?
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                        <button @click="openClockOut = false" type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                            Cancel
                                        </button>
                                        <form method="POST" action="{{ url('clock-out')}}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 ml-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                                                Clock Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <div class="ml-4 flex items-center md:ml-6">
            <!-- Profile dropdown -->
            <div class="ml-3 relative" x-data="{ open: false }">
                <div>
                    <button @click="open = true" type="button"
                            class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        {{--                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">--}}
                        <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span> {{ Auth::user()->name }}</span>
                        <!-- Heroicon name: solid/chevron-down -->
                        <svg class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <!-- Active: "bg-gray-100", Not Active: "" -->
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                       tabindex="-1" id="user-menu-item-0">Your Profile</a>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a @click.prevent="$root.submit();" class="block px-4 py-2 cursor-pointer text-sm text-gray-700"
                           role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    [x-cloak] { display: none; }
</style>
