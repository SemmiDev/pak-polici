<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')
    @include('sweetalert::alert')

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-[#F2F7FF] focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a class="flex ml-2 md:mr-24">
                        {{-- <img class="w-8 h-8 md:mr-3" src="{{ asset('storage/img/logo.png') }}" alt="Flowbite logo"> --}}
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Portal
                                Absensi</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-12 h-12 rounded-full"
                                     src="https://imgix3.ruangguru.com/assets/avatar/avatar_default_id.png?w=360"
                                     alt="user photo">
                            </button>
                        </div>
                        <div
                            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-gray-900 dark:text-white" role="none">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                       class="block px-4 py-2 text-gray-700 hover:bg-[#F2F7FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                       role="menuitem">Profil Pengguna</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="block px-4 py-2 text-gray-700 hover:bg-[#F2F7FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
           class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
           aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('app.absensi.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.absensi.index') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                               stroke-width="2">
                                <path d="M9 4.025A7.5 7.5 0 1 0 16.975 12H9V4.025Z"/>
                                <path
                                    d="M12.5 1c-.169 0-.334.014-.5.025V9h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 12.5 1Z"/>
                            </g>
                        </svg>
                        <span class="ml-3">Absensi</span>
                    </a>
                </li>

                <li>
                    @hasanyrole('ADMIN')
                    <a href="{{ route('app.users.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.users.index') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-800 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                        </svg>


                        <span class="ml-3">Pengguna</span>
                    </a>
                    @endhasanyrole
                </li>

                <li>
                    @hasanyrole('ADMIN')
                    <a href="{{ route('app.rekap-absensi.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.rekap-absensi.index') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-800 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                        </svg>

                        <span class="ml-3">Rekap Absensi</span>
                    </a>
                    @endhasanyrole
                </li>

                <li>
                    @hasanyrole('ADMIN')
                    <a href="{{ route('app.rekap-absensi-per-bulan.index') }}"
                       class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.rekap-absensi-per-bulan.index') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-800 dark:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                        </svg>

                        <span class="ml-3">Rekap Absensi Per Bulan</span>
                    </a>
                    @endhasanyrole
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 bg-[#F2F7FF] min-h-screen">
        <div class="p-4 border-dashed rounded-lg dark:border-gray-700">
            {{ $slot }}
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
