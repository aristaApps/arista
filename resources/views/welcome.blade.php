<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Arista - Aplikasi Repositori Informasi dan Sistem Terstruktur Arship</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    </head>
    <body class="font-sans antialiased">
        <div class="relative flex flex-col items-center justify-center min-h-screen">
            <section class="container w-full px-6 py-6"> <!-- Mengurangi padding -->
                <div class="grid gap-6 lg:grid-cols-2">
                    <!-- Kolom 1: Informasi Singkat -->
                    <div class="flex flex-col justify-center p-6 rounded-lg">
                        <!-- Membungkus gambar dalam div flex agar berdampingan dan lebih kecil -->
                        <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-4">
                            <img src="{{ asset('sbadmin2/img/kem.png') }}" alt="Gambar Kem" class="w-30 sm:w-35 rounded-lg">
                            {{-- <img src="{{ asset('sbadmin2/img/more-shadow.png') }}" alt="Gambar More Shadow" class="w-32 sm:w-40 rounded-lg"> --}}
                        </div>
                        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-2">Aplikasi Sistem Terstruktur Arsip LLDIKTI WILAYAH IX</h1>
                        {{-- <h1 class="text-4xl font-extrabold text-gray-800 mb-4"></h1> --}}
                        <p class="text-lg text-center text-gray-600 mb-5">Manajemen file arsip dengan mudah dan cepat</p>
                        <a href="{{ route('login') }}" class="w-1/2 mx-auto text-center py-3 text-white bg-blue-500 rounded-full hover:bg-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="w-1/2 mx-auto text-center py-3 text-white bg-blue-500 rounded-md hover:bg-blue-600">Register</a>
                    </div>

                    <!-- Kolom 2: Gambar -->
                    <div class="flex items-center justify-center p-6">
                        <img src="{{ asset('sbadmin2/img/arista.jpg') }}" alt="Gambar Arista" class="w-full h-auto rounded-lg">
                    </div>
                </div>
            </section>
        </div>
    </body>
    <footer class="bg-gray-800 text-white py-4 mt-5"> <!-- Mengurangi padding footer -->
        <div class="container mx-auto text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} Arista
                <a href="https://www.instagram.com/lldikti9/" target="_blank" class="text-blue-400 hover:underline">lldikti9</a>
                All Rights Reserved.
            </p>
        </div>
    </footer>
</html>
