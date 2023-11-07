@extends('layouts.general')
@section('title', '會員登入')

@section('css')
@endsection

@section('js')
@endsection




@section('main')

    <div id="error-wrap" class="mt-4 mb-4" style="display:none;">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div id="error-msg"> {{ $error }} </div>
                </div>
            @endforeach

        @endif

    </div>


    <form action="" id="_form">
        @csrf
        <div class="form-group pb-3">
            <label for="exampleInputEmail1">個人電郵</label>
            <input type="email" required class="form-control" value="" name="email" id="email"
                aria-describedby="emailHelp" placeholder="個人電郵">
        </div>

        <div class="form-group pb-3">
            <label for="password">密 碼</label>
            <input type="password" required class="form-control" minlength="8" value="" name="password"
                id="password" aria-describedby="passwordHelp" placeholder="密 碼">
            <div>
                <p  class="text-end mt-1 mb-1">
                <a href="/forgot-password">忘記密碼/設定密碼?</a>
                </p>
            </div>
        </div>


        <div class="d-grid">
            <button type="submit" id="btn" class="btn btn-primary">提交</button>
        </div>
       
    </form>

@endsection
