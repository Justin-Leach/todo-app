<div>
    @foreach ($tasks as $task)
        ...
        <div class="text-xl">{{ $task->title }}</div>
        <div class="text-xl">{{ $task->description }}</div>
    @endforeach

    {{ $tasks->links() }}
</div>
