<div class="sidebar_menu">
                <div class="inner__sidebar_menu">

                <ul>
  <li >
    <a href="{{ route('genres.index') }}" class="{{ request()->is('genres*') ? 'active' : '' }}">
      <span class="icon"><i class="fas fa-border-all"></i></span>
      <span class="list">Genres</span>
    </a>
  </li>
  <li >
    <a href="{{ route('artists.index') }}" class="{{ request()->is('artists*') ? 'active' : '' }}">
      <span class="icon"><i class="fas fa-border-all"></i></span>
      <span class="list">Artists</span>
    </a>
  </li>
  <li >
    <a href="{{ route('venues.index') }}" class="{{ request()->is('venues*') ? 'active' : '' }}">
      <span class="icon"><i class="fas fa-border-all"></i></span>
      <span class="list">Venues</span>
    </a>
  </li>
  <li >
    <a href="{{ route('events.index') }}" class="{{ request()->is('events*') ? 'active' : '' }}">
      <span class="icon"><i class="fas fa-border-all"></i></span>
      <span class="list">Events</span>
    </a>
  </li>
</ul>

                    <div class="hamburger">
                        <div class="inner_hamburger">
                            <span class="arrow">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

<!-- <div class="sidebar">
  <a href="#home"><i class="fa fa-fw fa-home"></i> Home</a>
  <a href="#services"><i class="fa fa-fw fa-wrench"></i> Services</a>
  <a href="#clients"><i class="fa fa-fw fa-user"></i> Clients</a>
  <a href="#contact"><i class="fa fa-fw fa-envelope"></i> Contact</a>
</div> -->