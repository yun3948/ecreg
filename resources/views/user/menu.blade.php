    @php

        $menu_list = [
            ['route' => 'user.info', 'text' => '會員資料'],
            ['route' => 'user.card', 'text' => '會員卡片'], 
            ['route' => 'user.level', 'text' => '會員等級'], 
            ['route' => 'user.news', 'text' => '會員新聞'],
            ['route' => 'user.password', 'text' => '修改密码'],
        ];

    @endphp

    <div class="">

        <nav class="nav flex-column nav-pills">
            @foreach ($menu_list as $menu)
                 <a href="{{ route($menu['route']) }}" class="nav-link
                 @if(request()->routeIs($menu['route']))
                 active
               
                 @endif
                 ">{{ $menu['text'] }}</a>
            @endforeach
      
        </nav> 

    </div>
