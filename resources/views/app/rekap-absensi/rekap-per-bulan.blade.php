<x-admin-layout>
    <div class="flex flex-col md:flex-row justify-between">
        <h1 class="text-3xl text-black pb-6">Rekap Per Bulan</h1>
        <form action="{{ route('app.rekap-absensi-per-bulan.index') }}" method="GET"
              id="filter-date">
            <div class="flex">
                <input type="month" name="month"
                       value="{{ request()->get('month', Carbon\Carbon::now()->format('Y-m')) }}"
                       id="month" class="px-4 py-2 border border-gray-300 rounded-md">
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto shadow-md mt-5 sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Hadir
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Izin
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Sakit
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Alpa
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Lainnya
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
                        {{ $absensi->name }}
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{ $absensi->Hadir }}
                        </span>
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                            {{ $absensi->Izin }}
                        </span>
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            {{ $absensi->Sakit }}
                        </span>
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                            {{ $absensi->Alpha }}
                        </span>
                    </th>
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                        {{ $absensi->Lainnya }}
                        </span>
                    </th>
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
            if (e.target && e.target.id == "month") {
                const form = e.target.closest("form");
                form.submit();
            }
        });

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
