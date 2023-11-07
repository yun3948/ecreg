@extends('layouts.general')

@section('title','會員中心')
 
@section('css')
    <style>
        #school-wraper div:not(:first-child) {display: none}
    </style>
@endsection


 @section('main')
    <div class="container">
    <div class="row mt-5">

      <div class="left col-3">
            @include ('user.menu')
        </div>
        <div class="main col-9 bg-light p-5">
             @yield('content','')
        </div>

    </div>
      
    </div>

 @endsection