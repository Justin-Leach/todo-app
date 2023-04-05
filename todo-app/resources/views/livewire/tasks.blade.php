<div class="px-12">

    <h1 class="mt-6 ml-4 text-3xl">{{ __('Tasks') }}</h1>

    <div class="mt-2 w-full px-4 py-4 bg-white shadow-md overflow-hidden rounded-lg">

        {{-- Table --}}
        {{-- <livewire:task-table /> --}}
        @livewire('task-table')
    </div>

    <div class="flex justify-end mt-5">
        <button class="relative w-64 inline-block text-lg group disabled:opacity-25" wire:click="$toggle('addTaskModal')"
            wire:loading.attr="disabled">
            <span
                class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-green-800 transition-colors duration-300 ease-out border-2 border-green-900 rounded-lg group-hover:text-white">
                <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-green-50"></span>
                <span
                    class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-green-900 group-hover:-rotate-180 ease"></span>
                <span class="relative">{{ __('Add Task') }}</span>
            </span>
            <span
                class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-green-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                data-rounded="rounded-lg"></span>
        </button>
    </div>

    <x-dialog-modal wire:model="addTaskModal">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">

            <form class="flex flex-col" wire:submit.prevent="saveTask">
                <div class="flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="title">{{ __('Title') }}</label>
                    <input type="text" wire:model="task.title"
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
                    @error('task.title')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="priority">{{ __('Priority') }}</label>
                    <input type="number" wire:model="task.priority"
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
                    @error('task.priority')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 flex flex-col">
                    <label class="block font-medium text-sm text-gray-700"
                        for="importance">{{ __('Importance') }}</label>
                    <input type="number" wire:model="task.importance"
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
                    @error('task.importance')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 flex flex-col">
                    <label class="block font-medium text-sm text-gray-700"
                        for="description">{{ __('Description') }}</label>
                    <textarea wire:model="task.description"
                        class="w-full h-36 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"></textarea>
                    @error('task.description')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <button type="submit" class="relative w-64 inline-block text-lg group disabled:opacity-25"
                wire:click="saveTask" wire:loading.attr="disabled">
                <span
                    class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-green-800 transition-colors duration-300 ease-out border-2 border-green-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-green-50"></span>
                    <span
                        class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-green-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Add Task') }}</span>
                </span>
                <span
                    class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-green-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                    data-rounded="rounded-lg"></span>
            </button>
        </x-slot>

    </x-dialog-modal>

</div>
