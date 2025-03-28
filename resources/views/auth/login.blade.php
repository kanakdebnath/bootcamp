@php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = UtilityFacades::getValByName('company_favicon');
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('Login') }}</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('public/frontend/login/style.css') }}" />

    <link rel="icon"
        href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}"
        type="image" sizes="16x16">

        
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}">
  </head>
  <body>
    <main>
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="text-center mt-5">
            <img style="width: 200px" src="{{ $logo . 'light_logo.png' }}" alt="" />
          </div>
          <div class="login-box">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <div>
                <label for="">Email Address </label>
                <input
                  type="email"
                  name="email" value="{{ old('email') }}"
                  placeholder="email@gmail.com"
                />
              </div>
              <div class="position-relative">
                <label for=""> Password </label>
                <input type="password" name="password" id="password" placeholder="******" />
                <button type="button" class="eye-open">
                  <img src="{{ asset('public/frontend/login/eye.svg') }}" alt="" />
                </button>
                <button type="button" class="eye-close d-none">
                  <img src="{{ asset('public/frontend/login/eye-close.svg') }}" alt="" />
                </button>
              </div>
              <div class="mt-4 d-flex justify-content-between">
                <div
                  class="d-flex justify-content-md-between align-items-start"
                >
                  <input
                    class="mt-1"
                    type="checkbox"
                    name="remember_me"
                    id="remember_me"
                    value="1"
                  />
                  <label class="text-14 mt-0 ms-2" for="remember_me"
                    >Remember Me</label
                  >
                </div>
                <!--<a class="forgot small" href="{{ route('password.request') }}">Forgot Password?</a>-->
              </div>
              <div class="mt-5">
                <button type="submit" class="btn-one w-100">Sign In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.eye-open').on('click', function () {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                // Toggle the button text
                $('.eye-open').addClass('d-none');
                $('.eye-close').removeClass('d-none');
            });

            $('.eye-close').on('click', function () {
                const passwordField = $('#password');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                // Toggle the button text
                $('.eye-open').removeClass('d-none');
                $('.eye-close').addClass('d-none');
            });
        });
    </script>

    <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>


            <script>
                @if (session('failed'))
                    notifier.show('Sorry!', '{{ session('failed')->first() }}', 'danger',
                        '{{ asset('assets/images/notification/high_priority-48.png') }}', 4000);
                @endif

                @if (session('errors'))
                    notifier.show('Sorry!', '{{ session('errors')->first() }}', 'danger',
                        '{{ asset('assets/images/notification/high_priority-48.png') }}', 4000);
                @endif

                @if (session('success'))
                    notifier.show('Success', '{{ session('success')->first() }}', 'success',
                        '{{ asset('assets/images/notification/ok-48.png') }}', 4000);
                @endif
                @if (session('successful'))
                    notifier.show('Success', '{{ session('success')->first() }}', 'success',
                        '{{ asset('assets/images/notification/ok-48.png') }}', 4000);
                @endif

                @if (session('warning'))
                    notifier.show('Warning!', '{{ session('warning')->first() }}', 'warning',
                        '{{ asset('assets/images/notification/medium_priority-48.png') }}', 4000);
                @endif

                @if (session('status'))
                    notifier.show('Success', '{{ session('status')->first() }}', 'info',
                        '{{ asset('assets/images/notification/ok-48.png') }}', 4000);
                @endif
            </script>
  </body>
</html>
