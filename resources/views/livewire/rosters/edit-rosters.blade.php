{{--phaes::2 roster edit page--}}
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg sm:p-6">
        <form wire:submit.prevent="updateRoster({{$this->roster->id}})">
            @if($errors->any())
                @if($errors->has('start_time'))
                    @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('end_time'))
                    @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('department'))
                    @error('department') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('user'))
                    @error('user') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
            @endif
            <div class="grid grid-cols-6 gap-6">
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

                <div class="col-span-6 sm:col-span-3">
                    <label for="user" class="block text-sm font-medium text-gray-700">Select User</label>
                    <select id="user" wire:model.debounce.500ms="user" autocomplete="user-name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected disabled>---Select---</option>
                        @foreach($usersData as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <select id="department" wire:model.debounce.500ms="department" autocomplete="department-name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected disabled>---Select---</option>
                        @foreach($departmentsData as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button"  href="{{route('rosters')}}"
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
        defaultDate:'{{$this->start_time}}'
    });
    $("#end-time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        defaultDate:'{{$this->end_time}}'
    });
</script>
