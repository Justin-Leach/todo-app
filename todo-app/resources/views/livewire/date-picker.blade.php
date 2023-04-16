<div>
    <input x-data x-ref="datepicker" type="text" name="datepicker" id="datepicker" wire:model="date" />
</div>

<script>
    document.addEventListener("livewire:load", function () {
        var today = new Date();
        new Pikaday({
            field: document.getElementById("datepicker"),
            format: "YYYY-MM-DD",
            minDate: today,
            onSelect: function () {
                Livewire.emit("datePickerSelectedModalListeners", this.getMoment().format("YYYY-MM-DD"));
            },
        });
    });
</script>
