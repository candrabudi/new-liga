<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>Rukada - Login</title>
</head>

<body class="bg-login">
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('assets/images/logo-icon.png') }}" width="60" alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Rukada Admin</h5>
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>

                                    <div id="alert-box"></div>

                                    <div class="form-body">
                                        <form id="loginForm" class="row g-3">
                                            @csrf
                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="username"
                                                    placeholder="Masukkan Username" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control border-end-0" id="password"
                                                        placeholder="Masukkan Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember">
                                                    <label class="form-check-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            // show/hide password
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                let input = $('#show_hide_password input');
                let icon = $('#show_hide_password i');
                if (input.attr("type") == "text") {
                    input.attr('type', 'password');
                    icon.addClass("bx-hide").removeClass("bx-show");
                } else {
                    input.attr('type', 'text');
                    icon.removeClass("bx-hide").addClass("bx-show");
                }
            });

            // submit form pakai axios
            $("#loginForm").on("submit", function(e) {
                e.preventDefault();
                let formData = {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    remember: $("#remember").is(":checked"),
                    _token: "{{ csrf_token() }}"
                };

                axios.post("{{ route('secret.login.process') }}", formData)
                    .then(function(response) {
                        if (response.data.success) {
                            window.location.href = response.data.redirect ?? "/";
                        } else {
                            $("#alert-box").html(
                                `<div class="alert alert-danger">${response.data.message ?? 'Login gagal'}</div>`
                            );
                        }
                    })
                    .catch(function(error) {
                        let msg = "Terjadi kesalahan.";
                        if (error.response && error.response.data && error.response.data.message) {
                            msg = error.response.data.message;
                        }
                        $("#alert-box").html(
                            `<div class="alert alert-danger">${msg}</div>`
                        );
                    });
            });
        });
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
