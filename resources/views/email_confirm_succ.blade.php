@extends('layouts.general')

@section('title','電郵驗證')




@section('tip')

@endsection


@section('main')
    <div id="succ-wrap" class="mt-4 mb-4" style="">
        <div   class="alert alert-success alert-dismissible" role="alert">
            <div id="succ-msg">
                <div class="mt-4 mb-4 mx-auto text-center">
                    <h1 class="display-4 fw-normal">電郵驗證成功</h1>
                </div>
                <p class="fs-5 text-center display-4 fw-normal" id="succ-msg">
                    電郵地址驗證成功，您已成功註冊成為本會會員！
                    <br/>
                    電子會員證已透過電郵發送給您，敬請查收。
                </p>

            </div>
        </div>
    </div>
@endsection