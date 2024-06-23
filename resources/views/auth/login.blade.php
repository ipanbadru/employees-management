<!--

=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themes.getbootstrap.com/licenses/)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Primary Meta Tags -->
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('vendor/volt/vendor/sweetalert2/dist/sweetalert2.min.css') }}"
          rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ asset('vendor/volt/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('vendor/volt/css/volt.css') }}" rel="stylesheet">

    @vite('resources/css/app.css')

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


<main>

    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image"
                 data-background-lg="{{ asset('vendor/volt/assets/img/illustrations/signin.svg') }}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Login Untuk Mengakses Aplikasi</h1>
                        </div>
                        <form action="{{ route('login') }}" method="POST" class="mt-4">
                            @csrf
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="username">Username</label>
                                <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <span class="icon icon-xs text-gray-600">
                                                <i class="icon-fa fa-solid fa-user"></i>
                                            </span>
                                        </span>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="John Doe"
                                           id="username" name="username" autofocus required>
                                    @error('username')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <span class="icon icon-xs text-gray-600">
                                                    <i class="icon-fa fa-solid fa-lock"></i>
                                                </span>
                                            </span>
                                        <input type="password" name="password" placeholder="Password" class="form-control" id="password"
                                               required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-top mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" id="remember">
                                        <label class="form-check-label mb-0" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Core -->
<script src="{{ asset('vendor/volt/vendor/@popperjs/core/dist/umd/popper.min.js') }}'"></script>
<script src="{{ asset('vendor/volt/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('vendor/volt/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

<!-- Slider -->
<script src="{{ asset('vendor/volt/vendor/nouislider/distribute/nouislider.min.js') }}"></script>

<!-- Smooth scroll -->
<script src="{{ asset('vendor/volt/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

<!-- Charts -->
<script src="{{ asset('vendor/volt/vendor/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('vendor/volt/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

<!-- Datepicker -->
<script src="{{ asset('vendor/volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{ asset('vendor/volt/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{ asset('vendor/volt/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Notyf -->
<script src="{{ asset('vendor/volt/vendor/notyf/notyf.min.js') }}'"></script>

<!-- Simplebar -->
<script src="{{ asset('vendor/volt/vendor/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Volt JS -->
<script src="{{ asset('vendor/volt/assets/js/volt.js') }}"></script>


</body>

</html>
