{{--phaes::2 clock in clock out view page--}}
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg sm:p-6">
        <div class="col-span-6 sm:col-span-3">
            <strong>
                Shift's Details
            </strong>
        </div>
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                {{\Carbon\Carbon::parse($clock_in_clock_out->created_at)->toDateString()}}
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="time" class="block text-sm font-medium text-gray-700">Start - End Time</label>
                @foreach($clock_in_clock_out->clock_in_clock_out as $cicou)
                    <span
                        class="text-green-500">{{$cicou['clock_in']??'N/A'}}</span> -
                    <span
                        class="text-red-500"> {{$cicou['clock_out'] ?? 'N/A'}}</span>
                    <br>
                @endforeach
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                {{$clock_in_clock_out->status}}
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                {{$clock_in_clock_out->comments}}
            </div>
        </div>
        @can('alter-clock-in-clock-out')
            @if($clock_in_clock_out->status === 'UNAPPROVED')
                <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                <div x-data="{ approve: false }">
                    <button @click="approve = true" type="button"
                            class="inline-flex items-center px-3 py-2 my-2 ml-2 border
                                                        border-transparent shadow-sm text-sm
                                                        leading-4 font-medium rounded-md text-white bg-indigo-600
                                                        hover:bg-red-700 focus:outline-none
                                                        focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <!-- Heroicon name: solid/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Approve
                    </button>
                    <div x-cloak x-show="approve"
                         class="fixed z-10 inset-0 overflow-y-auto"
                         aria-labelledby="modal-title"
                         role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div
                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                x-cloak
                                x-show="approve"
                                aria-hidden="true"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                            ></div>
                            <span
                                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                aria-hidden="true">&#8203;</span>
                            <form method="POST"
                                  action="{{ url('approve-shift/'.$clock_in_clock_out->id)}}">
                                @csrf
                                <div
                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                    x-cloak
                                    x-show="approve"
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
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-5">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                id="modal-title">
                                                Approve Shift
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Are you sure you want to approve
                                                    shift?
                                                </p>
                                            </div>
                                            <div class="mt-2">
                                                                                        <textarea name="comment"
                                                                                                  cols="30"
                                                                                                  placeholder="Please write comment here...."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                        <button @click="approve = false"
                                                type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 ml-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                            Approve
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                <div x-data="{ reject: false }">
                    <button @click="reject = true" type="button"
                            class="inline-flex items-center px-3 py-2 my-2 ml-2 border
                                                        border-transparent shadow-sm text-sm
                                                        leading-4 font-medium rounded-md text-white bg-red-600
                                                        hover:bg-red-700 focus:outline-none
                                                        focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <!-- Heroicon name: solid/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reject
                    </button>
                    <div x-cloak x-show="reject"
                         class="fixed z-10 inset-0 overflow-y-auto"
                         aria-labelledby="modal-title"
                         role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div
                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                x-cloak
                                x-show="reject"
                                aria-hidden="true"
                                x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                            ></div>
                            <span
                                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                aria-hidden="true">&#8203;</span>
                            <form method="POST"
                                  action="{{ url('reject-shift/'.$clock_in_clock_out->id)}}">
                                @csrf
                                <div
                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                                    x-cloak
                                    x-show="reject"
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
                                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                id="modal-title">
                                                Reject Shift
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Are you sure you want to reject
                                                    shift?
                                                </p>
                                            </div>
                                            <div class="mt-2">
                                                                                        <textarea name="comment"
                                                                                                  cols="30"
                                                                                                  placeholder="Please write comment here...."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                        <button @click="reject = false"
                                                type="button"
                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 ml-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            @endif
        @endif
    </div>
</div>
<style>
    [x-cloak] {
        display: none;
    }
</style>
