<!-- sidebar start -->
<div class="col-lg-2 col-md-2">
    <div class="sidebar">
      <div class="mb-3">
        <img class="logo" class="img-fluid" src="{{ $logo . 'light_logo.png' }}" alt="" />
      </div>
      <hr />
      <div class="profile mb-5 mt-4">
        <div>
          <img  src="{{ asset('public/frontend/images/avatar.jpg') }}" alt="" />
        </div>
        <div>
          <p class="fw-bold mb-0">Welcome</p>
          <p class="name mb-0">{{auth()->user()->nickname}}</p>
        </div>
      </div>
      <!-- Links -->
      <ul>
        <li>
          <a class="{{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"
            ><i class="fa-solid fa-user"></i> <span>Dashboard</span></a
          >
        </li>

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
          <a class="{{ request()->is('user/record-class') ? 'active' : '' }}" href="{{route('user.record-class')}}">
            <i class="fa-solid fa-video"></i>
            <span>Class Record</span></a
          >
        </li>

        <li>
          <a class="{{ request()->is('user/support') || request()->is('user/support/*') ? 'active' : '' }}" href="{{route('user.support.index')}}">
            <i class="fa-solid fa-ticket"></i>
            <span>Support</span></a
          >
        </li>

        <li>
          <a class="{{ request()->is('user/services') || request()->is('user/service-details/*') ? 'active' : '' }}" href="{{route('user.services')}}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Services</span></a
          >
        </li>

        <li>
          <a class="{{ request()->is('user/service') || request()->is('user/service/*') ? 'active' : '' }}" href="{{route('user.service.index')}}">
            <i class="fa-solid fa-truck"></i>
            <span>Service Request</span></a
          >
        </li>


        <li>
          <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span></a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>


      </ul>
    </div>
  </div>
<!-- sidebar end -->