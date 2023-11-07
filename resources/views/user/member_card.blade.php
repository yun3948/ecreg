@extends('layouts.user_center')

@section('js')
    <script>
        jQuery(function($) {
            $('#btn').click(function() {

            })
        })
    </script>
@endsection

@section('content')

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

    @if (session('message'))
        <div class="alert alert-success"> {{ session('message') }}</div>
    @endif

    <div class="text-center">
        <img class="img-fluid " src="{{ $member->card_img }}" alt="" />
        <form action="" method="post">
            @csrf
            <button class="btn btn-primary mt-2 btn-lg" type="primary" id="btn">重新发送</button>
        </form>

    </div>
@endsection
