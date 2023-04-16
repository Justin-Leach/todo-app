<div>
    <x-dialog-modal wire:model="createProjectBoardModal">
        <x-slot name="title">
            {{ __('Create Project Board') }}
        </x-slot>

        <x-slot name="content">
            <form class="flex flex-col" wire:submit.prevent="createProjectBoard">
                <div class="flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>
                    <input type="text" wire:model="projectBoard.name" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
                    @error('projectBoard.name')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700" for="expired_at">{{ __('Expired Date') }}</label>
                    @livewire('date-picker')
                    @error('projectBoard.expired_at')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-btn-green class="w-48" wire:click="createProjectBoard" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Create new Board') }}
                </x-slot>
            </x-btn-green>
        </x-slot>
    </x-dialog-modal>
</div>
