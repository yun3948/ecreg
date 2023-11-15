    @php

        $menu_list = [
             ['route' => 'user.card', 'text' => '電子會員證'], 
            ['route' => 'user.info', 'text' => '會員資料'],           
            ['route' => 'user.level', 'text' => '會員等級'], 
            ['route' => 'user.news', 'text' => '會員新聞'],
            ['route' => 'user.password', 'text' => '修改密码'],
        ];

    @endphp

    <div class="">

        <nav class="nav flex-column nav-pills text-body-secondary">
            @foreach ($menu_list as $menu)
                 <a href="{{ route($menu['route']) }}" class="nav-link text-reset
                 @if(request()->routeIs($menu['route']))
                 border border-primary 
                 @endif
                 ">{{ $menu['text'] }}</a>
            @endforeach
      
        </nav> 

    </div>
