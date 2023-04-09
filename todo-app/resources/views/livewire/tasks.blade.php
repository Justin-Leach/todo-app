<div class="px-4 py-4 bg-white shadow-md rounded">

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
            <label class="block font-medium text-sm text-gray-700" for="importance">{{ __('Importance') }}</label>
            <input type="number" wire:model="task.importance"
                class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
            @error('task.importance')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4 flex flex-col">
            <label class="block font-medium text-sm text-gray-700" for="description">{{ __('Description') }}</label>
            <textarea wire:model="task.description"
                class="w-full h-36 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"></textarea>
            @error('task.description')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </form>

    <div class="mt-4 flex justify-end space-x-4">

        @if ($editMode)
            <button type="submit" class="relative w-64 inline-block text-lg group disabled:opacity-25"
                wire:click="deleteTask" wire:loading.attr="disabled">
                <span
                    class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-red-800 transition-colors duration-300 ease-out border-2 border-red-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-red-50"></span>
                    <span
                        class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-red-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Delete Task') }}</span>
                </span>
                <span
                    class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-red-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                    data-rounded="rounded-lg"></span>
            </button>

            <button type="submit" class="relative w-64 inline-block text-lg group disabled:opacity-25"
                wire:click="updateTask" wire:loading.attr="disabled">
                <span
                    class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-green-800 transition-colors duration-300 ease-out border-2 border-green-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-green-50"></span>
                    <span
                        class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-green-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Save Task') }}</span>
                </span>
                <span
                    class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-green-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                    data-rounded="rounded-lg"></span>
            </button>
        @else
            <button type="submit" class="relative w-64 inline-block text-lg group disabled:opacity-25"
                wire:click="createTask" wire:loading.attr="disabled">
                <span
                    class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-green-800 transition-colors duration-300 ease-out border-2 border-green-900 rounded-lg group-hover:text-white">
                    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-green-50"></span>
                    <span
                        class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-green-900 group-hover:-rotate-180 ease"></span>
                    <span class="relative">{{ __('Create Task') }}</span>
                </span>
                <span
                    class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-green-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                    data-rounded="rounded-lg"></span>
            </button>
        @endif

    </div>
</div>
