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

        <div class="mt-4 flex flex-col">
             <label class="block font-medium text-sm text-gray-700" for="completed">{{ __('Completed') }}</label>
            <input type="checkbox" class="accent-pink-500" wire:model="task.completed" checked>
            @error('task.description')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </div>

    </form>

    <div class="mt-4 flex justify-end space-x-4">

        @if ($editMode)
            <x-btn-red class="w-48" wire:click="deleteTaskModal" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Delete Task') }}
                </x-slot>
            </x-btn-red>

            <x-dialog-modal wire:model="confirmingDeleteTaskModal">
                <x-slot name="title">
                    {{-- Todo Add task Name --}}
                    {{ __('Delete Task') }}
                </x-slot>

                <x-slot name="content">
                    <div class="text-xl">
                        {{ __('Are you sure you want to delete this task?') }}
                    </div>
                </x-slot>

                <x-slot name="footer">

                    <x-btn-gray class="w-32" wire:click="$toggle('confirmingDeleteTaskModal')"
                        wire:loading.attr="disabled">
                        <x-slot name="title">
                            {{ __('Cancel') }}
                        </x-slot>
                    </x-btn-gray>

                    <x-btn-red class="w-48" wire:click="deleteTask" wire:loading.attr="disabled">
                        <x-slot name="title">
                            {{ __('Delete Task') }}
                        </x-slot>
                    </x-btn-red>
                </x-slot>
            </x-dialog-modal>

            <x-btn-green class="w-48" wire:click="updateTask" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Save Task') }}
                </x-slot>
            </x-btn-green>
        @else
            <x-btn-green class="w-48" wire:click="createTask" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Create Task') }}
                </x-slot>
            </x-btn-green>
        @endif

    </div>


</div>
