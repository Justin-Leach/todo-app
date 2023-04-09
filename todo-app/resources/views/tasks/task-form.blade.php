<x-app-layout>
    <div class="py-8 px-12">
        <h1 class="mt-6 text-3xl">{{ __('Tasks') }}</h1>
            @livewire('tasks', ['task' => $task, 'updateTask' => $updateTask])
    </div>
</x-app-layout>
