<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaction') }}
        </h2>
    </x-slot>
<!-- 
Nama    : Davin Wahyu Wardana
NIM     : 6706223003
Kelas   : D3IF-4603 
-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf

                        <!-- Peminjam -->
                        <div class="mt-4">
                            <x-input-label for="userId" :value="__('Peminjam')" />
                            <select id="userId" name="userId" class="block mt-1 w-full" required autofocus>
                                <option value="" disabled selected>Select one...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('userId')" class="mt-2" />
                        </div>

                        <!-- Vehicle -->
                        <div class="mt-4">
                            <x-input-label for="vehicleId" :value="__('Vehicle')" />
                            <select id="vehicleId" name="vehicleId" class="block mt-1 w-full" required autofocus>
                                <option value="" disabled selected>Select one...</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vehicleId')" class="mt-2" />
                        </div><br>

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label for="startDate" class="block text-sm font-medium text-gray-600">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label for="endDate" class="block text-sm font-medium text-gray-600">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('transaction.daftarTransaction') }}" class="btn btn-dark"">Back</a>
                            <x-primary-button class="ml-4" type="submit">Tambah Transaction</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>