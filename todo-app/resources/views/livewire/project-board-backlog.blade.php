<div class="flex flex-col h-full pb-6">

    <div class="flex flex-col h-1/5 border border-red-500">

    </div>

    <div class="flex flex-col rounded px-4 space-y-4 w-full h-4/5 overflow-y-auto bg-white">

        <div class="flex flex-col  bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">Project Board
                    ({{ $numberProjectBoardItems != 0 ? $numberProjectBoardItems . '  issues)' : '' }}
                </h2>
            </div>

            {{-- Project Board Improve the hardcode id --}}
            <ul id="projectBoardItems-2" class="px-4 space-y-1 height-project-board" wire:sortable="updateListProjectBoard">
                @foreach ($projectBoardItems as $item)
                    <li data-id="task-{{ $item->status_id }}-{{ $item->id }}" id="task-{{ $item->id }}" class="flex flex-row bg-white border p-2" wire:key="project-board-{{ $loop->index }}">
                        <div class="w-10/12 flex flex-row">
                            {{ $item->title }}
                            <div class="bg-red-100 px-2">{{ $item->order }}</div>
                        </div>

                        <div class="flex justify-end w-2/12">
                            <div class="w-fit">
                                <div x-data="{ isOpen: false }" class="relative" x-cloak>
                                    <div>
                                        <span @click="isOpen = !isOpen" class="rounded-md shadow-sm">
                                            <button type="button"
                                                class="inline-flex justify-center items-center w-full h-6 border border-gray-300 pl-2 pr-1 py-0.5 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="options-menu-{{ $item->id }}" aria-haspopup="true" aria-expanded="true">
                                                {{ $item->statusName($item->status_id) }}

                                                <svg role="presentation" width="10" height="10" viewBox="5 5 13 13">
                                                    <path
                                                        d="M8.292 10.293a1.009 1.009 0 0 0 0 1.419l2.939 2.965c.218.215.5.322.779.322s.556-.107.769-.322l2.93-2.955a1.01 1.01 0 0 0 0-1.419.987.987 0 0 0-1.406 0l-2.298 2.317-2.307-2.327a.99.99 0 0 0-1.406 0z"
                                                        fill="currentColor" fill-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>

                                    <div x-show="isOpen" @click.away="isOpen = false"
                                        class="origin-top-right absolute right-0 z-20 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-{{ $item->id }}">
                                        <div class="py-1" role="none">
                                            @foreach ($options as $option)
                                                @if ($option->name !== $item->statusName($item->status_id))
                                                    <a wire:click="selectOption({{ $item->id }}, {{ $option->id }})"
                                                        @click="isOpen = false"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"role="menuitem">
                                                        {{ $option->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col  bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">Backlog
                    {{ $numberBacklogItems != 0 ? '(' . $numberBacklogItems . ' issues)' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="backlogItems-1" class="px-4 space-y-1 height-project-board" wire:sortable="updateListBacklog">
                @foreach ($backlogItems as $item)
                    <li data-id="task-{{ $item->status_id }}-{{ $item->id }}" id="task-{{ $item->id }}" class="flex flex-row bg-white border p-2" wire:key="backlog-{{ $loop->index }}">
                        <div class="w-10/12 flex flex-row">
                            {{ $item->title }}
                            <div class="bg-red-100 px-2">{{ $item->order }}</div>
                        </div>

                        <div class="flex justify-end w-2/12">
                            <div class="w-fit">
                                <div x-data="{ isOpen: false }" class="relative" x-cloak>
                                    <div>
                                        <span @click="isOpen = !isOpen" class="rounded-md shadow-sm">
                                            <button type="button"
                                                class="inline-flex justify-center items-center w-full h-6 border border-gray-300 pl-2 pr-1 py-0.5 bg-white text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="options-menu-{{ $item->id }}" aria-haspopup="true" aria-expanded="true">
                                                {{ $item->statusName($item->status_id) }}

                                                <svg role="presentation" width="10" height="10" viewBox="5 5 13 13">
                                                    <path
                                                        d="M8.292 10.293a1.009 1.009 0 0 0 0 1.419l2.939 2.965c.218.215.5.322.779.322s.556-.107.769-.322l2.93-2.955a1.01 1.01 0 0 0 0-1.419.987.987 0 0 0-1.406 0l-2.298 2.317-2.307-2.327a.99.99 0 0 0-1.406 0z"
                                                        fill="currentColor" fill-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>

                                    <div x-show="isOpen" @click.away="isOpen = false"
                                        class="origin-top-right absolute right-0 z-20 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-{{ $item->id }}">
                                        <div class="py-1" role="none">
                                            @foreach ($options as $option)
                                                @if ($option->name !== $item->statusName($item->status_id))
                                                    <a wire:click="selectOption({{ $item->id }}, {{ $option->id }})"
                                                        @click="isOpen = false"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"role="menuitem">
                                                        {{ $option->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div x-data="{ moveTaskModal: @entangle('moveTaskModal') }" x-cloak>
        <!-- Background overlay -->
        <div class="fixed z-40 inset-0 bg-gray-500 opacity-75 transition-opacity duration-300" x-show="moveTaskModal"
            @click.away="moveTaskModal = false">
        </div>

        <!-- Modal -->
        <div class="fixed z-50 inset-0 overflow-y-auto" x-show="moveTaskModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex items-center justify-center min-h-screen">
                <div class="mb-6 bg-white rounded shadow-xl transform transition-all w-fit">
                    <div class="px-2 py-4">
                        <div class="font-bold text-lg text-black">
                            {{ __('Move issues') }}
                        </div>

                        <div class="mt-4">
                            <h2 class="text-md text-black">{{ __('The project scope will be affected by this action.') }}</h2>
                            <div class="flex flex-row mt-2 space-x-1">
                                <h2 class="font-bold text-md">{{ $selectedTaskTitle }}</h2>
                                <h2 class="font-medium text-md">will be moved from</h2>
                                <h2 class="font-bold text-md">{{ $moveTaskTaskText1 }}</h2>
                                <h2 class="font-medium text-md">to</h2>
                                <h2 class="font-bold text-md">{{ $moveTaskTaskText2 }}</h2>
                                <h2 class="font-medium text-md">.</h2>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row justify-end px-6 py-4 bg-white text-right rounded-lg">
                        <x-sm-btn-gray class="w-24" wire:click="moveTaskProjectBoard" wire:loading.attr="disabled">
                            <x-slot name="title">
                                {{ __('Confirm') }}
                            </x-slot>
                        </x-sm-btn-gray>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('livewire:load', function() {

        const projectBoardList = document.getElementById('projectBoardItems-2');
        // Initialize the SortableJS instance for the Project Board list
        const projectBoardSortable = new Sortable(projectBoardList, {
            group: 'shared-lists',
            animation: 300,
            // ghostClass: 'opacity-50',
            // chosenClass: 'bg-gray-100',
            onEnd: function(evt) {
                if (evt.to.id !== evt.from.id) {
                    Livewire.emit('updateListProjectBoard', parseInt(evt.item.id.split("-")[1]), parseInt(evt.to.id.split("-")[1]));
                } else {
                    Livewire.emit('updateListProjectBoardOrder', projectBoardSortable.toArray());
                }
            },
        });

        // Initialize the SortableJS instance for the Backlog list
        const backlogList = document.getElementById('backlogItems-1');
        const backlogSortable = new Sortable(backlogList, {
            group: 'shared-lists',
            animation: 300,
            // ghostClass: 'opacity-50',
            // chosenClass: 'bg-gray-100',
            onEnd: function(evt) {
                if (evt.to.id !== evt.from.id) {
                    Livewire.emit('updateListBacklog', parseInt(evt.item.id.split("-")[1]), parseInt(evt.to.id.split("-")[1]));
                } else {
                    Livewire.emit('updateListBacklogOrder', backlogSortable.toArray());
                }
            }
        });
    });
</script>
