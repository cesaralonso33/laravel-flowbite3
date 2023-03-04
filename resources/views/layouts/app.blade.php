<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />


        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @notifyCss
        <!-- Scripts -->
        @livewireStyles
      {{--   @powerGridStyles --}}
      <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    </head>
    <body class="dark:bg-gray-800" >



<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
 </button>

 <aside id="separator-sidebar" class="dark:bg-gray-800 fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    @include('layouts.navegationadmin')
 </aside>

 <div class="p-4 sm:ml-64 dark:bg-gray-800">

        {{ $slot }}

 </div>


     {{--    <livewire:toasts />
        <div class="min-h-screen bg-gray-100"> --}}
          {{--   @include('layouts.navigation') --}}

            <!-- Page Heading -->
          {{--   <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->

       {{--  </div> --}}
        @livewireScripts
        @powerGridScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

        <x:notify-messages />
        @notifyJs
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        @yield('scripts')

    </body>
</html>
