<div class="top_navbar">
    <div class="logo">
        <a href="{{route('events.index')}}">ConcertWeekend</a>
    </div>
    <div class="top_menu">
        <div class="home_link">
            <a href="{{route('events.index')}}">
                <span class="icon"><i class="fas fa-home"></i></span>
                <span>Home</span>
            </a>
        </div>
        <div class="right_info">
            
        <div class="dropdown">

            <div class="icon_wrap">
               
                <div class="icon dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                </div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>Username:  {{Auth::user()->name??'-'}}</a></li>
                    <li>Email: {{Auth::user()->email??'-'}}</a></li>

                
                </ul>
            </div>

            </div>


            <div class="icon_wrap">
                <div class="icon">
                    <a href="{{route('logout')}}" style="color: white;">

                        <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
