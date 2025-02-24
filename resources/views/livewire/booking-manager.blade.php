<div>
    <h4 class="text-xl font-bold mb-2">Réservations</h4>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <button wire:click="createBooking" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Ajouter une réservation
    </button>

    @if ($showCreateForm)
        <div class="border rounded p-4 mb-4">
            <h5 class="text-lg font-bold mb-2">Nouvelle réservation</h5>
            <form wire:submit.prevent="storeBooking">
                <div class="mb-4">
                    <label for="check_in" class="block text-gray-700 text-sm font-bold mb-2">Check-in</label>
                    <input type="date" id="check_in" wire:model.defer="newBooking.check_in"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('newBooking.check_in')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="check_out" class="block text-gray-700 text-sm font-bold mb-2">Check-out</label>
                    <input type="date" id="check_out" wire:model.defer="newBooking.check_out"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('newBooking.check_out')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Utilisateur</label>
                    <select id="user_id" wire:model.defer="newBooking.user_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach (\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('newBooking.user_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Enregistrer
                </button>
                <button type="button" wire:click="$set('showCreateForm', false)"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Annuler
                </button>
            </form>
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $booking->check_in }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $booking->check_out }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                        <button wire:click="editBooking({{ $booking->id }})"
                            class="text-blue-600 hover:text-blue-900 mr-2">Modifier</button>
                        <button wire:click="deleteBooking({{ $booking->id }})"
                            class="text-red-600 hover:text-red-900">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($editingBooking)
        <div class="border rounded p-4 mt-4">
            <h5 class="text-lg font-bold mb-2">Modifier la réservation</h5>
            <form wire:submit.prevent="updateBooking">
                <div class="mb-4">
                    <label for="edit_check_in" class="block text-gray-700 text-sm font-bold mb-2">Check-in</label>
                    <input type="date" id="edit_check_in" wire:model.defer="editingBooking.check_in"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('editingBooking.check_in')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="edit_check_out" class="block text-gray-700 text-sm font-bold mb-2">Check-out</label>
                    <input type="date" id="edit_check_out" wire:model.defer="editingBooking.check_out"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('editingBooking.check_out')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="edit_user_id" class="block text-gray-700 text-sm font-bold mb-2">Utilisateur</label>
                    <select id="edit_user_id" wire:model.defer="editingBooking.user_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach (\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('editingBooking.user_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Enregistrer
                </button>
                <button type="button" wire:click="cancelEdit"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Annuler
                </button>
            </form>
        </div>
    @endif

</div>
