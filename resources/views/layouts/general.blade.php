<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '加入會員')</title>

    {{--    <meta name="keywords" content="@yield('keywords',' ')"> --}}
    {{--    <meta name="description" content="@yield('description','')"> --}}

    {{--    <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- 引入自定义文件 --}}
    <link href="/css/index.css" rel="stylesheet">

    @yield('css')

</head>

<body>
 
    <div class="text-center">
        <a href="http://www.edconvergence.org.hk/">
            <img src="/image/banner2.jpg" alt="" style="max-width: 100%;">
        </a>
    </div>

    <div class="container py-3">
        <header>

            @yield('tip','')

        </header>

        <main>

            @yield('main')
        </main>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md text-center">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- <script src="/assets/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    @yield('js')

</body>

</html>
