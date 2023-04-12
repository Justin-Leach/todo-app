<div class="flex flex-col h-full">

    <div class="border border-red-500 h-1/5">
        <div class="h-16">
            <a class="text-lg cursor-pointer" wire:click="openCreateTaskModal()">
                Create Task
            </a>
        </div>
    </div>

    <div class="flex bg-white rounded py-4 px-4 w-full h-4/5 overflow-y-auto space-x-4">
        <div class="w-1/3 px-4 bg-slate-100 rounded-lg">
            <h2 class="font-bold mb-2">Todo</h2>
            {{-- Todo Improve the hardcode id --}}
            <ul id="todoItems-1" wire:sortable="updateListOrder('todo')" class="space-y-1 height-project-board">
                @foreach ($todoItems as $item)
                        <li id="task-{{ $item->id }}" class="bg-white border p-4 cursor-grab" wire:key="todo-{{ $loop->index }}" wire:click="openTaskModal('{{ $item->id }}')">
                            {{ $item['title'] }}
                        </li>
                @endforeach
            </ul>
        </div>
        <div class="w-1/3 px-4 bg-slate-100 rounded-lg">
            <h2 class="font-bold mb-2">In Progress</h2>
            {{-- Todo Improve the hardcode id --}}
            <ul id="inProgressItems-2" wire:sortable="updateListOrder('inProgress')" class="space-y-1 height-project-board">
                @foreach ($inProgressItems as $item)
                    <li id="task-{{ $item->id }}" class="bg-white border p-4 cursor-grab" wire:key="in-progress-{{ $loop->index }}" wire:click="openTaskModal('{{ $item->id }}')">
                        {{ $item['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-1/3 px-4 bg-slate-100 rounded-lg">
            <h2 class="font-bold mb-2">Done</h2>
            {{-- Todo Improve the hardcode id --}}
            <ul id="doneItems-3" wire:sortable="updateListOrder('done')" class="space-y-1 height-project-board">
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
