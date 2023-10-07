<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Koleksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                    <!-- Formulir Penambahan Koleksi -->
                    <form action="{{ route('koleksi.store') }}" method="POST">
                        @csrf
                        <!-- Nama Koleksi -->
                        <div class="mb-4">
                            <label for="namaKoleksi" class="block text-sm font-medium text-gray-600">Nama Koleksi</label>
                            <input type="text" name="namaKoleksi" id="namaKoleksi" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Jenis Koleksi -->
                        <div class="mb-4">
                            <label for="jenisKoleksi" class="block text-sm font-medium text-gray-600">Jenis Koleksi</label>
                            <input type="number" name="jenisKoleksi" id="jenisKoleksi" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Jumlah Koleksi -->
                        <div class="mb-4">
                            <label for="jumlahKoleksi" class="block text-sm font-medium text-gray-600">Jumlah Koleksi</label>
                            <input type="number" name="jumlahKoleksi" id="jumlahKoleksi" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="#" class="btn btn-dark" onclick="goBack()">Back</a>
                            <x-primary-button class="ml-4" type="submit">Tambah Koleksi</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</x-app-layout>
