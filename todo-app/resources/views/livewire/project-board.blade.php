<div class="flex flex-col h-full pb-6">

    <div class="h-1/5">
        <div class="h-16">
            <a class="text-lg cursor-pointer" wire:click="openCreateTaskModal()">
                Create Task
            </a>
        </div>
    </div>

    <div class="flex bg-white rounded px-4 space-x-4 w-full h-4/5 overflow-y-auto">

        <div class="flex flex-col w-1/3 bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">TO DO {{ $numberTodoItems != 0 ? $numberTodoItems . ' ISSUES' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="todoItems-1" wire:sortable="updateListOrder('todo')" class="px-4 space-y-1 height-project-board">
                @foreach ($todoItems as $item)
                        <li id="task-{{ $item->id }}" class="bg-white border p-4 cursor-grab" wire:key="todo-{{ $loop->index }}" wire:click="openTaskModal('{{ $item->id }}')">
                            {{ $item['title'] }}
                        </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col w-1/3 bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">IN PROGRESS {{ $numberInProgressItems != 0 ? $numberInProgressItems . ' ISSUES' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="inProgressItems-2" wire:sortable="updateListOrder('inProgress')" class="px-4 space-y-1 height-project-board">
                @foreach ($inProgressItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-4 cursor-grab" wire:key="in-progress-{{ $loop->index }}" wire:click="openTaskModal('{{ $item->id }}')">
                        {{ $item['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-col w-1/3 bg-slate-100 rounded-lg">
            <div class="sticky top-0 h-8 bg-slate-100">
                <h2 class="font-semibold px-4 py-2">DONE {{ $numberDoneItems != 0 ? $numberDoneItems . ' ISSUES' : '' }}</h2>
            </div>

            {{-- Todo Improve the hardcode id --}}
            <ul id="doneItems-3" wire:sortable="updateListOrder('done')" class="px-4 space-y-1 height-project-board">
                @foreach ($doneItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-4 cursor-grab" wire:key="done-{{ $loop->index }}" wire:click="openTaskModal('{{ $item->id }}')">
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
            'animation': 300,
            onEnd: function(evt) {
                Livewire.emit('updateListTodo', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });

        // Initialize the SortableJS instance for the In Progress list
        const inProgressList = document.getElementById('inProgressItems-2');
        const inProgressSortable = new Sortable(inProgressList, {
            group: 'shared-lists',
            'animation': 300,
            onEnd: function(evt) {
                Livewire.emit('updateListInProgress', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });

        // Initialize the SortableJS instance for the Done list
        const doneList = document.getElementById('doneItems-3');
        const doneSortable = new Sortable(doneList, {
            group: 'shared-lists',
            'animation': 300,
            onEnd: function(evt) {
                Livewire.emit('updateListDone', evt.item.id.split("-")[1], evt.to.id.split("-")[0], evt.to.id.split("-")[1]);
            }
        });
    });

</script>
