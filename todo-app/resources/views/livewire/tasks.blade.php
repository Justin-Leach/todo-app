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
             <label class="block font-medium text-sm text-gray-700" for="status">{{ __('Status') }}</label>
            <div class="w-96">
                <div x-data="{ isOpen: false }" class="relative">
                    <div>
                        <span @click="isOpen = !isOpen" class="rounded-md shadow-sm">
                            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                                {{ $selectedOptionValue}}
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 14l5-5-5-5-1.414 1.414L11.172 9H4v2h7.172l-2.586 2.586L10 14z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </div>

                    <div x-show="isOpen" @click.away="isOpen = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <div class="py-1" role="none">
                            @foreach($options as $option)
                                {{-- TODO close the isOpen after the user selected the element --}}
                                <a wire:click="selectOption('{{ $option->id }}', '{{ $option->name }}')" href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">{{ $option->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            @error('task.status_id')
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
