<div class="flex flex-col h-full pb-6">

    <div class="flex flex-col h-1/5 border border-red-500">

    </div>

    <div class="flex flex-col rounded px-4 space-y-4 w-full h-4/5 overflow-y-auto bg-white">

        <div class="flex flex-col  bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">Project Board ({{ $numberProjectBoardItems != 0 ? $numberProjectBoardItems . '  issues)' : '' }}</h2>
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
                <h2 class="font-semibold px-4 py-2">Backlog ({{ $numberBacklogItems != 0 ? $numberBacklogItems . ' issues)' : '' }}</h2>
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

    {{-- Modal Move Task --}}
    <x-dialog-modal wire:model="moveTaskModal">
        <x-slot name="title">
            <h2 class="font-bold text-xl">{{ __('Move Task') }}</h2>
        </x-slot>

        <x-slot name="content">
            <form class="flex flex-col" wire:submit.prevent="moveTaskProjectBoard">
                <div class="flex flex-col">
                    <h2 class="block font-medium text-md text-gray-700">{{ __('The project scope will be affected by this action.') }}</h2>
                    <div class="flex flex-row mt-2 space-x-1">
                        <h2 class="font-bold text-md">{{ $selectedTaskTitle }}</h2>
                        <h2 class="font-medium text-md">will be moved from</h2>
                        <h2 class="font-bold text-md">{{ $moveTaskTaskText1 }}</h2>
                        <h2 class="font-medium text-md">to</h2>
                        <h2 class="font-bold text-md">{{ $moveTaskTaskText2 }}</h2>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-btn-gray class="w-36" wire:click="moveTaskProjectBoard" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Confirm') }}
                </x-slot>
            </x-btn-gray>
        </x-slot>
    </x-dialog-modal>

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
