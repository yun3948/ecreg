@extends('layouts.user_center')

@section('js')
    <script>
        jQuery(function($) {
            $('#up').click(function() {
                $('#_form').submit();
                return false;
            });
        })
    </script>
@endsection

@section('content')
    <div class="m-auto" style="width:420px;">

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif


        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }}</div>
        @endif


        <div class="mt-2">

            <div class="mt-2 text-center">
                您的等級：{{ $member->member_type_str }}
            </div>

            <div class="mt-2">

                <form action="" method="post" id="_form">
                    @csrf
                    <div class="d-grid gap-2 col-8 mx-auto">
                        @if ($member->member_type == 1)
                            <button id="up" type="button" class="btn btn-primary"
                                @if ($is_check) disabled @endif>申請成為資深會員</button>
                        @endif

                        @if ($member->member_type == 2 || $member->member_type == 3)
                            <button id="up" type="button" class="btn btn-primary"
                                @if ($is_check || $member->member_type == 3) disabled @endif>申請成為永久會員</button>
                        @endif
                    </div>
                </form>
            </div>

            <div class="mt-2 text-center fs-6 fw-lighter">
                {{-- 普通會員申請資深會員 --}}
                @if ($member->member_type == 1)
                  <div>
                        @if ($is_check)
                            <p>您已提出申請，請耐心等待工作人員審批。</p>
                            <p> 請把支票郵寄到：新界屯門田景邨中華基督教會蒙黃花沃紀念小學，鄭家寶校長收。</p>
                            <p>支票抬頭：教育評議會</p>
                            <p>金額：$150</p>
                            <p> 支票背面請註明「教評申請永久會員及姓名」</p>
                        @else
                            提示：申請費用$150，需經執委會審定資格及通過。
                        @endif
                    </div>
                @endif

                {{-- 資深會員申請永久會員 --}}
                @if ($member->member_type == 2)
                    <div>
                        @if ($is_check)
                            <p>您已提出申請，請耐心等待工作人員審批。</p>
                            <p> 請把支票郵寄到：新界屯門田景邨中華基督教會蒙黃花沃紀念小學，鄭家寶校長收。</p>
                            <p>支票抬頭：教育評議會</p>
                            <p>金額：$900</p>
                            <p> 支票背面請註明「教評申請永久會員及姓名」</p>
                        @else
                            提示：需成為資深會員兩年以後才可以申請成為永久會員。
                        @endif
                    </div>
                @endif


            </div>



        </div>
    </div>
@endsection
