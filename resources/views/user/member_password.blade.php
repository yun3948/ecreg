@extends('layouts.user_center')

@section('js')
    <script>
        jQuery(function($) {

        })
    </script>
@endsection

@section('content')
    <div>
        @if (session('message'))
            <div class="alert alert-success"> {{ session('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="" method="post" class="">
            @csrf
            <div class="form-group  ">
                <label for="old_password">原始密碼</label>
                <input type="text" class="form-control" required value="" name="old_password" id="old_password"
                    placeholder="原始密碼">
            </div>

            <div class="form-group pb-3">
                <label for="password">新密碼</label>
                <input type="text" class="form-control" required value="" name="password" id="password" placeholder="新密碼">
            </div>

            <div class="form-group pb-3">
                <label for="password_confirmation">確認密碼</label>
                <input type="text" class="form-control" required value="" name="password_confirmation"
                    id="password_confirmation" placeholder="確認密碼">
            </div>

            <div class="d-grid">
                <button type="submit" id="btn" class="btn btn-primary">提交</button>
            </div>

        </form>
    </div>
@endsection
