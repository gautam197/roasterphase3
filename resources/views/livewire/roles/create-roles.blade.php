<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg sm:p-6">
        <form wire:submit.prevent="addRole">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <br/>
            @error('permissions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model.debounce.500ms="name" id="first-name" autocomplete="given-name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="grid grid-cols-6 gap-6 mt-5">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Permissions</label>
                </div>
            </div>
            <div class="grid grid-cols-6 gap-6 mt-5">
                @foreach($permissionData as $permission)
                    <div class="col-span-6 sm:col-span-3">
                        <input id="{{$permission->name}}"  wire:model.debounce.500ms="permissions" value="{{$permission->id}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="{{$permission->name}}" class="font-medium text-gray-700">{{$permission->name}}</label>
                    </div>
                @endforeach

            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button"  href="{{route('roles')}}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="ml-3 cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
