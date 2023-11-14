<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <body class="font-sans antialiased">

     
        <div class="  container mx-auto max-w-screen-lg">
            <a href="http://www.edconvergence.org.hk/">
                <img src="/image/banner2.jpg" alt="" style="max-width: 100%;" class="mx-auto">
            </a>
        </div>


        <div class=" container max-w-screen-lg mx-auto font-sans  bg-white antialiased  mt-5 mb-5">
            {{ $slot }}
        </div>


        <div class="container max-w-screen-lg mx-auto">
          <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md  ">
                    <img class="mb-2" src="/image/footerlogo2.png" alt="" width="100">
                    <small class="d-block mb-3 text-muted">&copy; 2022-2023</small>
                </div>
                <div class="col-6 col-md">

                </div>
                <div class="col-6 col-md">

                </div>
                <div class="col-6 col-md">

                </div>
            </div>
        </footer>
        </div>
    </body>

</html>
