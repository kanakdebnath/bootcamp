<!-- mobile sidebar star -->
<div class="mobile-sidebar w3-bar-block w3-border-right" id="mySidebar">
      <button type="button" onclick="w3_close()" class="close">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="mb-3">
        <br />
        <img
          class="img-fluid logo"
          loading="lazy"
          src="{{ $logo . 'light_logo.png' }}"
          alt=""
        />
      </div>
      <ul>
        <li>
          <a class="{{ request()->is('user/profile') ? 'active' : '' }}" href="{{route('user.profile')}}"
            ><i class="fa-solid fa-user"></i> <span>Profile</span></a
          >
        </li>

        <li>
          <a class="{{ request()->is('user/meeting') ? 'active' : '' }}" href="{{route('user.meeting')}}">
            <i class="fa-solid fa-handshake"></i>
            <span>Meeting</span></a
          >
        </li>
        <li>
          <a class="{{ request()->is('user/live-class') ? 'active' : '' }}" href="{{route('user.class')}}">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Live Class</span></a
          >
        </li>
        <li>
          <a class="{{ request()->is('user/support') ? 'active' : '' }}" href="{{route('user.support.index')}}">
            <i class="fa-solid fa-video"></i>
            <span>Class Record</span></a
          >
        </li>

      </ul>
    </div>
    <div class="p-3 mobile-header">
      <div>
        <img class="img-fluid w-25" src="{{ asset('public/frontend/images/saledom-logo.webp') }}" alt="" />
      </div>
      <button type="button" class="menu-icon" onclick="w3_open()">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
    <!-- mobile sidebar end -->