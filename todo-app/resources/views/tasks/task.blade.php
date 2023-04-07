<x-app-layout>
    <div class="py-8 px-12">

        <h1 class="mt-6 ml-4 text-3xl">{{ __('Tasks') }}</h1>
        <div class="mt-2 w-full px-4 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            {{-- Table --}}
            @livewire('task-table')

            <div class="mt-4 flex justify-end">
                <a  href="{{ route('create-task') }}" class="relative w-64 inline-block text-center text-lg group disabled:opacity-25" >
                    <span
                        class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-green-800 transition-colors duration-300 ease-out border-2 border-green-900 rounded-lg group-hover:text-white">
                        <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-green-50"></span>
                        <span
                            class="absolute left-0 w-64 h-64 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-green-900 group-hover:-rotate-180 ease"></span>
                        <span class="relative">{{ __('Create Task') }}</span>
                    </span>
                    <span
                        class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-green-900 rounded-lg group-hover:mb-0 group-hover:mr-0"
                        data-rounded="rounded-lg"></span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
