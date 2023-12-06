<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-3xl text-black pb-6">Data Absensi</h1>

        <div>
            <a href="{{ route('app.absensi.create') }}"
               class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
               type="button">
                Tambah
            </a>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Foto
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Lokasi
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Tanggal
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    status
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Keterangan
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach ($daftarAbsensi as $absensi)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 text-center">
                        {{ $loop->iteration }}
                    </td>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <img src="{{ asset('storage/absensi/' . $absensi->foto) }}" alt="foto"
                             class="w-48 h-48 object-cover rounded-xl enlarge-image mx-auto"
                             data-src="{{ asset('storage/absensi/' . $absensi->foto) }}">
                    </th>

                    <td class="px-6 py-4 text-center">
                        {{ $absensi->name }}
                        <br>
                        <b class="font-semibold"> {{ $absensi->nip }}</b>
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $absensi->lokasi }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ Carbon\Carbon::parse($absensi->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        <br>
                        <b class="font-semibold">     {{ Carbon\Carbon::parse($absensi->waktu)->format('H:i') }}</b>
                    </td>

                    <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 font-semibold leading-tight
                                        {{ $absensi->status == 'Hadir' ? 'text-green-700 bg-green-100' : '' }}
                                        {{ $absensi->status == 'Izin' ? 'text-yellow-700 bg-yellow-100' : '' }}
                                        {{ $absensi->status == 'Sakit' ? 'text-red-700 bg-red-100' : '' }}
                                        {{ $absensi->status == 'Alpa' ? 'text-gray-700 bg-gray-100' : '' }}
                                        rounded-full">
                            {{ $absensi->status }}
                            </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $absensi->keterangan }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="image-modal"
         class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50 bg-black bg-opacity-80 hidden">
        <div id="image-container" class="relative max-w-screen-xl mx-auto">
            <img id="modal-image" src="" alt="Enlarged Image" class="max-h-full max-w-full">
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("change", function (e) {
            if (e.target && e.target.id == "status") {
                const form = e.target.closest("form");
                form.submit();
            }
        });

        // JavaScript to open the lightbox when an image is clicked
        document.addEventListener("click", function (e) {
            if (e.target && e.target.classList.contains("enlarge-image")) {
                const imageSrc = e.target.src;
                const modalImage = document.getElementById("modal-image");
                modalImage.src = imageSrc;

                const imageModal = document.getElementById("image-modal");
                imageModal.style.display = "flex";
            }
        });

        // JavaScript to close the lightbox when the close button is clicked
        document.addEventListener("click", function (e) {
            if (e.target && e.target.id == "modal-image") {
                const imageModal = document.getElementById("image-modal");
                imageModal.style.display = "none";
            }
        });
    </script>
</x-admin-layout>
