<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Thank you</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
      .box {
        box-shadow: 0px 10px 40px 0px #00000026;
        background-color: #000;
        border-radius: 12px;
        padding: 24px;
      }
      .btn-one {
        background-color: #ec1c23;
        color: #fff;
        border-radius: 4px;
        padding: 12px 40px;
        border: solid 2px #ec1c23;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        display: inline-block;
      }
      .btn-one:hover {
        background-color: transparent;
        color: #ec1c23;
        border: solid 2px #ec1c23;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div
          class="col-lg-6 mx-auto justify-content-center align-items-center vh-100 d-flex"
        >
          <div class="box text-center w-100">
            <img class="img-fluid w-50" src="{{ asset('public/frontend/images/logo.png') }}" alt="" />
            <h1 class="mb-1 mt-4 text-light">Thank you!</h1>
            <p class="mb-4 text-light">
            Payment Complete. Check your email for Login Details
            </p>
            <div>
              <a class="btn btn-one" href="{{url('/')}}"> Back to Home</a>
            </div>

            <div class="text-center">
              <a class="" href="{{route('login')}}"> Login</a>
            </div>

          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

     <!-- Load jQuery first -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Default Toastr configuration
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    <!-- Flash message handling -->
    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif
  </body>
</html>
