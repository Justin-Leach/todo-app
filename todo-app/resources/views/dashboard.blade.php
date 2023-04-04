<x-app-layout>
    <div class="py-8">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col justify-center items-center space-y-8">
                <div class="flex flex-row space-x-16">
                    <div class="bg-red-500 w-64 h-48 shadow-xl rounded">
                        <div class="flex flex-col h-full justify-center items-center">
                            <div class="text-8xl">
                                {{ __('99') }}
                            </div>
                            <div class="mt-4 text-xl">
                                {{ __('Upcoming Task') }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-500 w-64 h-48 shadow-xl rounded">
                        <div class="flex flex-col h-full justify-center items-center">
                            <div class="text-8xl">
                                {{ __('05') }}
                            </div>
                            <div class="mt-4 text-xl">
                                {{ __('Task Completed') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-green-500 h-screen w-full">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
