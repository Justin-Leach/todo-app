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
            <ul id="projectBoardItems-2" wire:sortable="updateListOrder('projectBoard')" class="px-4 space-y-1 height-project-board">
                @foreach ($projectBoardItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-2" wire:key="project-board-{{ $loop->index }}">
                        {{ $item['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col  bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">Backlog
                    ({{ $numberBacklogItems != 0 ? $numberBacklogItems . ' issues)' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="backlogItems-1" wire:sortable="updateListOrder('backlog')" class="px-4 space-y-1 height-project-board">
                @foreach ($backlogItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-2" wire:key="backlog-{{ $loop->index }}">
                        {{ $item['title'] }}
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
        <div class="fixed z-50 inset-0 overflow-y-auto"
            x-show="moveTaskModal"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
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
            onEnd: function(evt) {
                Livewire.emit('updateListProjectBoard', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });

        // Initialize the SortableJS instance for the Backlog list
        const backlogList = document.getElementById('backlogItems-1');
        const backlogSortable = new Sortable(backlogList, {
            group: 'shared-lists',
            animation: 300,
            onEnd: function(evt) {
                Livewire.emit('updateListBacklog', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });
    });
</script>
