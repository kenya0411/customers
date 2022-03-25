

<header>
    <div class="flex common_padding_wide">
        <div class="flex2 no1"> 
            <a href="/">   
                <h1>
                 ロゴ
             </h1>
         </a>
     </div>
        <div class="flex2 no2 navi"> 

            <div id="nav_toggle" class="nav_toggle">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

                        @guest
                        @else
                        <ul>
                            <li>{{ Auth::user()->nickname }}様</li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                
                            </li>
                        </ul>
                        
                        
                        @endguest
            <nav>
 @include('common.components.side_list')

</nav>
     </div>

</div>
</header>




