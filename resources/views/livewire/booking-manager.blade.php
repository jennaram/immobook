<div>
    <label for="property_id">Propriété :</label>
    <select id="property_id" wire:model="property_id">
        <option value="">Sélectionner une propriété</option>
        @foreach ($availableProperties as $property)
            <option value="{{ $property->id }}">{{ $property->name }}</option>  </select>
    </select>
    @error('property_id') <span class="text-red-500">{{ $message }}</span> @enderror<br>

    <label for="start_date">Date de début :</label>
    <input type="date" id="start_date" wire:model="start_date">
    @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror<br>

    <label for="end_date">Date de fin :</label>
    <input type="date" id="end_date" wire:model="end_date">
    @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror<br>

    <label for="num_guests">Nombre de personnes :</label>
    <input type="number" id="num_guests" wire:model="num_guests" min="1">
    @error('num_guests') <span class="text-red-500">{{ $message }}</span> @enderror<br>

    <button wire:click="book">Réserver</button>

    <script>
        window.addEventListener('booking-successful', event => {
            alert(event.detail.message);
        });

        window.addEventListener('booking-failed', event => {
            if (event.detail.errors) {
                let errors = event.detail.errors;
                for (let key in errors) {
                    alert(errors[key][0]); // Display the first error message for each field
                }
            } else if (event.detail.customMessage) {
                alert(event.detail.customMessage);
            }
        });
    </script>
</div>