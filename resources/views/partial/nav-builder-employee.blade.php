@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$logo = asset(Storage::url('uploads/logo/'));
$settings = Utility::settings();

@endphp

<!-- [ navigation menu ] start -->
<nav class="dash-sidebar light-sidebar transprent-bg">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('home') }}" class="b-brand">

                @if (isset($settings['dark_mode']))
                    @if ($settings['dark_mode'] == 'on')
                        <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'light_logo.png') }}"
                            height="46" class="navbar-brand-img">
                    @else
                        <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png') }}"
                            height="46" class="navbar-brand-img">
                    @endif
                @else
                    <img class="c-sidebar-brand-full pt-3 mt-2 mb-1"
                        src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'dark_logo.png') }}"
                        height="46" class="navbar-brand-img">
                @endif
                {{-- <img class="c-sidebar-brand-minimized"
                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'small_logo.png') }}"
                    height="46" class="navbar-brand-img"> --}}
            </a>
        </div>
        <div class="navbar-content active dash-trigger ps ps--active-y">
            <ul class="dash-navbar" style="display: block;">
                <li class="dash-item dash-hasmenu {{ request()->is('/') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('home') }}">
                        <span class="dash-micon"><i class="ti ti-home"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('employee/meeting') || request()->is('employee/meeting/*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('employee.meeting') }}">
                        <span class="dash-micon"><i class="ti ti-tag"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Meeting') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('employee/classes') || request()->is('employee/classes/*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('employee.classes') }}">
                        <span class="dash-micon"><i class="ti ti-tag"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Live Class') }}</span>
                    </a>
                </li>

                <li class="dash-item dash-hasmenu {{ request()->is('employee/task') || request()->is('employee/task/*') ? 'active' : '' }}">
                    <a class="dash-link" href="{{ route('employee.task') }}">
                        <span class="dash-micon"><i class="ti ti-tag"></i></span>
                        <span class="dash-mtext custom-weight">{{ __('Task') }}</span>
                    </a>
                </li>


                @include('layouts.menu')
            </ul>

        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
