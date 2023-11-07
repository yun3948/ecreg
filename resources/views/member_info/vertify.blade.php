@extends('layouts.general')
@section('title','會員信息变更')

@section('css')
<style>

</style>
@endsection


@section('js')
<script>
</script>
@endsection


@section('tip')
    <div id="head-tip">
        <div class=" pb-md-4 mx-auto text-center" style="padding-top:30px; padding-bottom:30px; ">
            <h1 class="display-4 fw-normal">會員信息变更</h1>

        </div>

{{--        <p class="fs-5 ">「會員」細則</p>--}}
{{--        <p class="fs-5 pb-5">--}}
{{--         --}}
{{--        </p>--}}
    </div>

@endsection

@section('main')



    <div id="response-wrap" class="mt-4 mb-4">
        <div>
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>

    <form action="?" method="post" id="_form">
    @csrf

        <div class="form-group pb-3">
            <label for="chiname">中文姓名</label>
            <input type="text"  class="form-control" name="chiname" id="chiname" placeholder="中文姓名" value="{{ old('chiname') }}">
        </div>

        <div class="form-group pb-3">
            <label for="exampleInputEmail1">個人電郵</label>
            <input type="email"  class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="個人電郵">
        </div>
        <div class="d-grid">
            <button type="submit" id="btn" class="btn btn-primary">提交</button>
        </div>
    </form>



@endsection
