<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="flex justify-end mt-5">
            <button class="relative w-64 inline-block text-lg group disabled:opacity-25" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-red-800 transition-colors duration-300 ease-out border-2 border-red-900 rounded-lg group-hover:text-white">
                <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-red-50"></span>
                <span class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-red-900 group-hover:-rotate-180 ease"></span>
                <span class="relative">{{ __('Delete Account') }}</span>
                </span>
                <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-red-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
            </button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                        <input type="password"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser">

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="relative w-32 inline-block text-lg group disabled:opacity-25" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
                    <span class="absolute left-0 w-48 h-48 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Cancel') }}</span>
                    </span>
                    <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                </button>

                <button class="relative ml-3 w-64 inline-block text-lg group disabled:opacity-25" wire:click="deleteUser" wire:loading.attr="disabled">
                    <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-red-800 transition-colors duration-300 ease-out border-2 border-red-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-red-50"></span>
                    <span class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-red-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Delete Account') }}</span>
                    </span>
                    <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-red-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
                </button>

            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
