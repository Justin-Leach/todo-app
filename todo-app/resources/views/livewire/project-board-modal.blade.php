<div>
    <x-dialog-modal wire:model="createProjectBoardModal">
        <x-slot name="title">
            {{ __('Create Project Board') }}
        </x-slot>

        <x-slot name="content">
            <form class="flex flex-col" wire:submit.prevent="createProjectBoard">
                <div class="flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>
                    <input type="text" wire:model="projectBoard.name" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm">
                    @error('projectBoard.name')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="expired_at">{{ __('Expired Date') }}</label>
                    <input x-data x-ref="datepicker" type="text" name="datepicker" id="datepicker-1" wire:model="dateSelected" class="w-48 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"/>
                    @error('dateSelected')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-btn-green class="w-48" wire:click="createProjectBoard" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Create new Board') }}
                </x-slot>
            </x-btn-green>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="updateProjectBoardModal">
        <x-slot name="title">
            {{ __('Edit Project Board') }}
        </x-slot>

        <x-slot name="content">
            <form class="flex flex-col" wire:submit.prevent="updateProjectBoard">
                <div class="flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>
                    <input type="text" wire:model="projectBoard.name" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm" />
                    @error('projectBoard.name')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4 flex flex-col">
                    <label class="block font-medium text-sm text-gray-700" for="expired_at">{{ __('Expired Date') }}</label>
                    <input x-data x-ref="datepicker" type="text" name="datepicker" id="datepicker-2" wire:model="dateSelected" class="w-48 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm"/>
                    @error('dateSelected')
                        <span class="error text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-btn-green class="w-48" wire:click="updateProjectBoard" wire:loading.attr="disabled">
                <x-slot name="title">
                    {{ __('Save') }}
                </x-slot>
            </x-btn-green>
        </x-slot>
    </x-dialog-modal>
</div>

<script>
    document.addEventListener("livewire:load", function () {
    var today = new Date();

    var picker1 = new Pikaday({
        field: document.getElementById("datepicker-1"),
        format: "YYYY-MM-DD",
        minDate: today,
        onSelect: function () {
            Livewire.emit("dateSelected", this.getMoment().format("YYYY-MM-DD"));
        },
    });

    var picker2 = new Pikaday({
        field: document.getElementById("datepicker-2"),
        format: "YYYY-MM-DD",
        minDate: today,
        setDefaultDate: true,
        onSelect: function () {
            Livewire.emit("dateSelected", this.getMoment().format("YYYY-MM-DD"));
        },
    });

    Livewire.on('updateProjectBoardEvent', function (defaultDate) {
        picker2.setDate(defaultDate);
    });
});
</script>
