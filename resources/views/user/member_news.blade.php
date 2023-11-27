@extends('layouts.user_center')

@section('js')
    <script>
        jQuery(function($) {
       
        })
    </script>
@endsection

@section('content')
<div>
    @foreach ($list as $item)
        <div class="card" style="width:18rem;"> 

            <div class="card-body">
                <h5 class="card-title"> {{$item['title']}} </h5>
                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                <p class="card-text">{{$item['remark']}}</p>
                <a href="{{$item->link}}" target="_blank" class="card-link">詳情</a>
              
            </div>
        
        </div>
    @endforeach

    <div>
        {{$list->links()}}
    </div>
</div>
@endsection