{{--iteration-2 roster list page--}}
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Rosters</h2>
        @can('alter-rosters')
            <a href="{{route('rosters.create')}}" type="button"
               class="inline-flex items-center p-1.5 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <!-- Heroicon name: solid/plus-sm -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                          clip-rule="evenodd"/>
                </svg>
            </a>
        @endcan
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="grid grid-cols-6 gap-6 mb-4">
                    <input type="text" wire:model.debounce.500ms="from_date" id="from-date" autocomplete="from-date"
                           placeholder="From Date"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <input type="text" wire:model.debounce.500ms="to_date" id="to-date"
                           autocomplete="end_time"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                           placeholder="To Date">
                    @if($from_date || $to_date)
                    <div class="mt-3 relative flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:click="clearFilter" id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="comments" class="font-medium text-gray-700">Show All</label>
                        </div>
                    </div>
                    @endif
                </div>
                <div wire:loading.flex>Loading...</div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Staff's Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a wire:click="sortBy('start_time')" class="cursor-pointer">Start Time
                                    @if($sortField === 'start_time' && $sortDirection === 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" style="position: relative;
top: -17px;
left: 80px;"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    @if($sortField === 'start_time' && $sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" style="position: relative;
top: -17px;
left: 80px;"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a wire:click="sortBy('end_time')" class="cursor-pointer"> End Time
                                    @if($sortField === 'end_time' && $sortDirection === 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" style="position: relative;
top: -17px;
left: 80px;"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    @if($sortField === 'end_time' && $sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" style="position: relative;
top: -17px;
left: 80px;"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Department
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($rosters) > 0)
                            {{--                            @php--}}
                            {{--                                $ip = file_get_contents("http://ipecho.net/plain");--}}
                            {{--                                $url = 'http://ip-api.com/json/'.$ip;--}}
                            {{--                                $tz = file_get_contents($url);--}}
                            {{--                                $tz = json_decode($tz,true)['timezone'];--}}
                            {{--                            @endphp--}}
                            @foreach($rosters as $roster)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$roster->user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{\Carbon\Carbon::parse($roster->start_time)->format('Y-m-d H:i')}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{\Carbon\Carbon::parse($roster->end_time)->format('Y-m-d H:i')}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{@$roster->departmentObject->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('alter-rosters')
                                            <a href="{{route('rosters.edit',$roster->id)}}"
                                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <a wire:click.prevent="deleteRoster({{$roster->id}})"
                                               class="text-red-600 hover:text-indigo-900 p-2 cursor-pointer">Delete</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            {{$rosters->links()}}
                        @else
                            <tr>
                                <td colspan="12" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{'No Data Found'}}
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#from-date").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d"
    });
    $("#to-date").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d"
    });
</script>
