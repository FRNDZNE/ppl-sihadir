<!doctype html>
<html lang="en">

<head>
    <title>SIHADIR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}/images/sihadir.ico">
    <link rel="stylesheet" href="{{ asset('/') }}/front/style.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('/') }}/images/sihadirlogo2.png" class="img-fluid rounded-5">
                </div>
                <p class="text-white fs-2 fw-bold">SiHadir</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;">Absensi lebih praktis hanya di
                    <strong>SiHadir</strong></small>
            </div>
            <div class="col-md-6 right-box d-flex flex-column justify-content-evenly">
                @guest
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row align-items-center">
                            <div class="header-text mb-4 text-center">
                                <h2>Login</h2>
                                <p>Input your email, and password</p>
                            </div>
                            <div class="form-group mb-3">
                                <input type="email"
                                    class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                    placeholder="Email Address" name="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input type="password"
                                    class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group mb-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                            </div>
                        </div>
                    </form>
                @endguest
                @auth
                    <div class="row align-items-center">
                        <div class="header-text mb-4 text-center">
                            <h2>You Have Logged In</h2>
                            <p>Go back to dashboard, or Logout</p>
                        </div>
                        <div class="input-group mb-5">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6"><a
                                    href="{{ url('/home') }}">Back</a></button>
                        </div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <div class="input-group mb-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Logout</button>
                            </div>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</body>

</html>
