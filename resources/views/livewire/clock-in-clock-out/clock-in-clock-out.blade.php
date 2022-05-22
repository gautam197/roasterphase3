{{--iteration-2 clock in clock out list page--}}
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Shift</h2>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Staff's Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a wire:click="sortBy('created_at')" class="cursor-pointer">Date
                                    @if($sortField === 'created_at' && $sortDirection === 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             style="position: relative;
top: -17px;
left: 80px;"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    @if($sortField === 'created_at' && $sortDirection === 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             style="position: relative;
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
                                Start-End Time
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comments
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($reports) > 0)
                            {{--                            @php--}}
                            {{--                                $ip = file_get_contents("http://ipecho.net/plain");--}}
                            {{--                                $url = 'http://ip-api.com/json/'.$ip;--}}
                            {{--                                $tz = file_get_contents($url);--}}
                            {{--                                $tz = json_decode($tz,true)['timezone'];--}}
                            {{--                            @endphp--}}
                            @foreach($reports as $report)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$report->user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{\Carbon\Carbon::parse($report->created_at)->toDateString()}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        @foreach($report->clock_in_clock_out as $cicou)
                                            <span
                                                class="text-green-500">{{$cicou['clock_in']??'N/A'}}</span> -
                                            <span
                                                class="text-red-500"> {{$cicou['clock_out'] ?? 'N/A'}}</span>
                                            <br>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{str_replace('_',' ',$report->status)}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{(strlen($report->comments) > 20) ? substr($report->comments, 0, 25) . '...' : $report->comments ?? 'N/A'}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('alter-clock-in-clock-out')
                                            <a href="{{route('shifts.edit',$report->id)}}"
                                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <a wire:click.prevent="deleteShift({{$report->id}})"
                                               class="text-red-600 hover:text-indigo-900 p-2 cursor-pointer">Delete</a>
                                        @endif
                                        @can('view-clock-in-clock-out')
                                            <a href="{{route('shifts.view',$report->id)}}"
                                               class="text-indigo-600 hover:text-indigo-900 p-2">View</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            {{$reports->links()}}
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
