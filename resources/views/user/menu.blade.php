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
                <a href="{{ route($menu['route']) }}"
                    class="nav-link text-reset
                 @if (request()->routeIs($menu['route'])) border border-primary @endif
                 ">{{ $menu['text'] }}</a>
            @endforeach
            <a href="javascript:;" class="nav-link text-reset"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                登 出
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
