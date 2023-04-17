<div class="flex flex-col h-full pb-6">

    <div class="flex flex-col h-1/5 border border-red-500">

    </div>

    <div class="flex flex-col rounded px-4 space-y-4 w-full h-4/5 overflow-y-auto bg-white">

        <div class="flex flex-col  bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">Project Board ({{ $numberProjectBoardItems != 0 ? $numberProjectBoardItems . '  issues)' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="todoItems-1" wire:sortable="updateListOrder('todo')" class="px-4 space-y-1 height-project-board">
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
            <ul id="inProgressItems-2" wire:sortable="updateListOrder('inProgress')" class="px-4 space-y-1 height-project-board">
                @foreach ($backlogItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-2" wire:key="backlog-{{ $loop->index }}">
                        {{ $item['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

<script>
    document.addEventListener('livewire:load', function() {

        const todoList = document.getElementById('todoItems-1');
        // Initialize the SortableJS instance for the Todo list
        const todoSortable = new Sortable(todoList, {
            group: 'shared-lists',
            animation: 300,
            onEnd: function(evt) {
                Livewire.emit('updateListTodo', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });

        // Initialize the SortableJS instance for the In Progress list
        const inProgressList = document.getElementById('inProgressItems-2');
        const inProgressSortable = new Sortable(inProgressList, {
            group: 'shared-lists',
            animation: 300,
            onEnd: function(evt) {
                Livewire.emit('updateListInProgress', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });
    });
</script>
