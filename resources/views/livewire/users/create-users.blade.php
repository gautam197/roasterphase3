<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg sm:p-6">
        <form wire:submit.prevent="addUser">
            @if($errors->any())
                @if($errors->has('name'))
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('email_address'))
                    @error('email_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('username'))
                    @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('role'))
                    @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <br/>
                @endif
                @if($errors->has('password'))
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                @endif
            @endif
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model.debounce.500ms="name" id="name" autocomplete="name"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" wire:model.debounce.500ms="username" id="username" autocomplete="username"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" wire:model.debounce.500ms="email_address" id="email-address"
                           autocomplete="email"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select id="role" wire:model.debounce.500ms="role" autocomplete="role-name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected disabled>---Select---</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" wire:model.debounce.500ms="password" id="email-address"
                           autocomplete="password"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" wire:model.debounce.500ms="password_confirmation" id="confirm-password"
                           autocomplete="confirm-password"
                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button"  href="{{route('users')}}"
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
