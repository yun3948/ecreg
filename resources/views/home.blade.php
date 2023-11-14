<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>加入成為教育評議會會員</title>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
</head>

<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
    </svg>
 

    <div class="text-center">

        <a href="http://www.edconvergence.org.hk/"><img style="max-width: 100%;" src="image/banner2.jpg"
                alt="..."></a>
    </div>

    <div class="container py-3">
        <header>
            <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
                <h1 class="display-4 fw-normal">加入成為教育評議會會員</h1>
                <p class="fs-5 text-muted">教評會願與其他教育團體互相合作，為改善教育質素而努力，亦歡迎認同本會目標之教育同工加入。</p>
                <p class="fs-5 text-muted">"我們正在為推動香港教育政策走向專業，為香港的下一代身心健康成長而努力。"</p>
            </div>
        </header>

        <main>
            <div class="row row-cols-1 row-cols-md-4 mb-4 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">普通會員</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/年</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>申請後即獲電子會員證</li>
                                <li>無須繳付會費</li>
                                <li>可參與本會舉辦的活動</li>
                                <li>享有會員福利</li>
                                <li>及購物優惠</li>

                            </ul>
                            <a href="{{ route('register.show', [1]) }}" type="button"
                                class="w-100 btn btn-lg btn-outline-primary">免費申請</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">資深會員</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$150<small class="text-muted fw-light">/年</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>經執委會審定資格及通過</li>
                                <li>可獲推薦成為資深會員</li>
                                <li>繳費後將獲電子會員證</li>
                                <li>可參與本會活動</li>
                                <li>享有會員福利</li>
                                <li>及購物優惠</li>
                                <li>在周年大會具投票權及參選權</li>

                            </ul>
                            <a href="{{ route('register.show', [2]) }}" type="button"
                                class="w-100 btn btn-lg btn-outline-primary">申請</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">永久會員</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$900</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>經執委會審定資格及通過</li>
                                <li>兩年或以上資深會員</li>
                                <li>繳費後將獲電子會員證</li>
                                <li>可參與本會活動</li>
                                <li>享有會員福利</li>
                                <li>及購物優惠</li>
                                <li>在周年大會具投票權及參選權</li>
                            </ul>
                            {{-- <a href="{{ route('register.show',[3]) }}" type="button" class="w-100 btn btn-lg btn-outline-primary">申請</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">附屬會員</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/年</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>會員家屬或非業界人士或認同本會理念者</li>
                                <li>申請後即獲電子會員證</li>
                                <li>無須繳付會費</li>
                                <li>可參與本會舉辦的活動</li>
                                <li>享有會員福利</li>
                                <li>及購物優惠</li>
                            </ul>
                            <a href="{{ route('register.show', [4]) }}" type="button"
                                class="w-100 btn btn-lg btn-outline-primary">免費申請</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center  fs-4 border border-primary rounded-pill py-3">
             已經是教評會員？<a href="/login">按此登入</a>會員系統。
            </div>

            <h2 class="display-4 text-center mt-5 mb-4">比較不同類別的會員</h2>

            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th style="width: 28%;"></th>
                            <th style="width: 18%;">普通會員</th>
                            <th style="width: 18%;">資深會員</th>
                            <th style="width: 18%;">永久會員</th>
                            <th style="width: 18%;">附屬會員</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th scope="row" class="text-start">免費申請</th>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td></td>
                            <td></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-start">可參與本會活動</th>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">享有會員福利</th>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">購物優惠</th>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                        </tr>

                        <tr>
                            <th scope="row" class="text-start">在周年大會具投票權及參選權</th>
                            <td></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td><svg class="bi" width="24" height="24">
                                    <use xlink:href="#check" />
                                </svg></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="alert alert-info">
                請把支票郵寄到：新界屯門田景邨中華基督教會蒙黃花沃紀念小學，鄭家寶校長收。<br />
                支票抬頭：教育評議會<br />
                支票背面請註明「教評入會及姓名」
            </div>
        </main>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="image/footerlogo2.png" alt="" width="100">
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
