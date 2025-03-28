@extends('frontend.layouts.master')
@section('content')
<div class="login-box">
<div class="row mb-5">
    <div class="text-center mt-3 ">
        <p class="mt-4 mb-1">Best Wishes,</p>
        <h3 class="text-color-main">Saledom Agency</h3>

        <p class="mt-4">SUPPORT</p>
        <div>
            <p>
                <a class="text-decoration-none text-color-main" href="tel:{{get_option('support_hotline')}}">{{get_option('support_hotline')}}</a> <small>(Hotline)</small>
            </p>
            <p>
                <a class="text-decoration-none text-color-main" href="tel:{{get_option('support_whatsapp')}}">{{get_option('support_whatsapp')}}</a> <small>(Office)</small>
            </p>
            <p>
                <a class="text-decoration-none text-color-main" href="mailto:{{get_option('support_email')}}">{{get_option('support_email')}}</a> 
            </p>
        </div>

        <div>
          <a class="btn-one" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span></a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
    </div>
</div>
</div>

@endsection
