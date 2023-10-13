<x-admin-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('app.absensi.store') }}"
        class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800 p-5">
        @csrf

        <h1 class="text-3xl text-black pb-6">Form Absensi</h1>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
            <input type="text" name="nama" readonly
                   value="{{ auth()->user()->name }}"
                   id="nama"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        @php
            $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $tanggal = $date->format('Y-m-d');
            $waktu =  $date->format('H:i');
        @endphp

        <div class="mb-6">
            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <input type="date" name="tanggal" readonly
                   id="date"
                   value="{{ $tanggal }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="waktu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu</label>
            <input type="time" name="waktu" readonly
                   id="waktu"
                   value="{{ $waktu }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
            <input type="text" name="lokasi"
                   id="lokasi"
                   autofocus
                   placeholder="Masukkan Lokasi"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="mb-6">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select name="status" id="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                <option value="">Pilih Status</option>
                @foreach ($daftarStatus as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="text"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
            <textarea name="keterangan" cols="30" rows="5" id="keterangan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('keterangan') ? 'border-red-500' : '' }}"
                placeholder="Masukkan keterangan jika ada"></textarea>
        </div>

        <div class="mb-6">
            <label for="dropzone-file"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
            <input
                required
                id="dropzone-file" name="foto" accept="image/png, image/jpeg" type="file"/>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Kirim Absensi
        </button>
    </form>

    <script>
        window.addEventListener('load', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                });
            }
        });
    </script>
</x-admin-layout>
