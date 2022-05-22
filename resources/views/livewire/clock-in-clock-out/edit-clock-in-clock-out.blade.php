{{--phaes::2 clock in clock out edit page--}}
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg sm:p-6">
        <form  wire:submit.prevent="updateShift({{$clock_in_clock_out->id}})">
            @if($errors->any())
                @if($errors->has('start_time'))
                    @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('end_time'))
                    @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
            @endif
            <div class="col-span-6 sm:col-span-3">
                <strong>Shift's Details</strong>
            </div>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    {{\Carbon\Carbon::parse($clock_in_clock_out->created_at)->toDateString()}}
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="date" class="block text-sm font-medium text-gray-700">Start - End Time</label>
                    @foreach($clock_in_clock_out->clock_in_clock_out as $cicou)
                        <span
                            class="text-green-500">{{$cicou['clock_in']??'N/A'}}</span> -
                        <span
                            class="text-red-500"> {{$cicou['clock_out'] ?? 'N/A'}}</span>
                        <br>
                    @endforeach
                </div>
            </div>
            <hr class="mt-2">
            <div class="grid grid-cols-6 gap-6 mt-8">
                <div class="col-span-6 sm:col-span-3">
                    <label for="start-time" class="block text-sm font-medium text-gray-700">Start Time</label>
                    <input type="text" wire:model.debounce.500ms="start_time" id="start_time" autocomplete="start-time"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="end-time" class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="text" wire:model.debounce.500ms="end_time" id="end-time"
                           autocomplete="end_time"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button" href="{{route('shifts')}}"
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#start_time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    $("#end-time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
