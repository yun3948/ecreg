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
                        <a class="btn btn-primary" type="button" id="up">申請成為永久會員</a>
                    </div>
                </form>
            </div>

            <div class="mt-2 text-center fs-6 fw-lighter">
                提示：需成為資深會員兩年以後才可以申請成為永久會員。
            </div>

        </div>
    </div>
@endsection
