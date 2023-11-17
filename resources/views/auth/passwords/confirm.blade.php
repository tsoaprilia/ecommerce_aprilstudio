<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Tautan ke Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Tautan ke Bootstrap JavaScript (Popper.js dan jQuery juga diperlukan) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Tautan ke Font Awesome -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.14.0/font/bootstrap-icons.css" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>


<style>
    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }

    @media (min-width: 1025px) {
        .h-custom-2 {
        height: 100%;
        }
    }
</style>

<section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img src="{{ asset('images/password.png') }}"
              alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
          </div>
          <div class="col-sm-1 ">
          </div>
          <div class="col-sm-5 text-black mt-5">

          <div class="d-flex align-items-center h-custom-2 mt-5 pt-5 pt-xl-0 mt-xl-n5">
            {{ __('Please confirm your password before continuing.') }}


            <form method="POST"  style="width: 23rem;" action="{{ route('password.confirm') }}">
                @csrf

              <h3 style="font-size: 18px;" class="fw-normal mb-3 pb-3 mt-5" style="letter-spacing: 1px;">Confirm Password</h3>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example28">{{ __('Password') }}</label>
                <div class="input-group">
                    <input style="font-size: 14px; margin-top:10px;" id="password" type="password" class="form-control form-control-lg form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit" style="font-size: 16px;">  {{ __('Confirm Password') }}</button>
              </div>

              @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
              @endif

            </form>

          </div>

        </div>


      </div>
    </div>
  </section>
