<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('login2/images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login2/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login2/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('login2/images/bgg.jpeg');">
            <div class="wrap-login100" style="margin-top: 70px;">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login100-form-avatar">
                        <img src="{{asset('login2/images/logodishub.png')}}" alt="AVATAR">
                    </div>
                    <div class="text-center">
                        <h3 class="mt-4" style="color: #fff">SIANG BRPS</h3>
                        <P style="color: #fff;">Sistem Informasi Angkutan Pendataan Terminal Tipe A Bandar Raya Payung Sekaki</P>
                    </div>


                    <div class="wrap-input100 validate-input m-b-10" data-validate="Email is required"
                        style="margin-top: 50px;">
                        <input class="input100" id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Masukkan E-mail">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>



                    {{-- <div class="text-center w-full mt-5">
                        <a class="txt1" href="{{route('register')}}">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{asset('login2/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login2/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('login2/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login2/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login2/js/main.js')}}"></script>

</body>

</html>
