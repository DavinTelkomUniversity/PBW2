<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaction') }}
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
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p>Peminjam: </p>
                        <p>Vehicle: </p>
                        <p>Harga: </p>
                        <p>Start Date: </p>
                        <p>End Date: </p>
                        <p>Diupdate: {{ $transaction->updated_at }}</p>


                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full" required autofocus>
                                <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Pinjam</option>
                                <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Kembali</option>
                                <option value="3" {{ $transaction->status == 3 ? 'selected' : '' }}>Hilang</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div><br>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('transaction.daftarTransaction') }}" class="btn btn-dark"">Back</a>
                            <x-primary-button class="ml-4" type="submit">Edit Transaction</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>