<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Vehicle') }}
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
                    <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf
                        <!-- Nama Vehicle -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">Nama Vehicle</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Jenis Vehicle -->
                        <div class="mt-4">
                            <x-input-label for="jenisVehicle" :value="__('Jenis Vehicle')" />
                            <select id="jenisVehicle" name="jenisVehicle" class="block mt-1 w-full" required autofocus>
                                <option value="" disabled selected>Select one...</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenisVehicle')" class="mt-2" />
                        </div><br>

                        <!-- License -->
                        <div class="mb-4">
                            <label for="license" class="block text-sm font-medium text-gray-600">License</label>
                            <input type="text" name="license" id="license" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                            <input type="number" name="price" id="price" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('vehicle.daftarVehicle') }}" class="btn btn-dark"">Back</a>
                            <x-primary-button class="ml-4" type="submit">Tambah Vehicle</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>