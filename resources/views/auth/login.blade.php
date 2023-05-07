<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | Login</title>

    <link href="{{ template_gentelellaMaster() }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ template_gentelellaMaster() }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ template_gentelellaMaster() }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="{{ template_gentelellaMaster() }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ template_gentelellaMaster() }}/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form>
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>

                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>

                        <div>
                            <a class="btn btn-default submit" href="index.html">Log in</a>
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">New to site?
                                <a href="#signup" class="to_register"> Create Account </a>
                            </p>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    {{-- <form action="{{ route('proses-regist') }}" method="POST" id="form-regist"> --}}
                    <form method="POST" id="form-regist">
                        @csrf
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                required="" />
                        </div>

                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                required="" />
                        </div>

                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required="" />
                        </div>

                        <div>
                            <button type="submit" id="regist" class="btn btn-default submit">Submit</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>\

<script>
    $(document).ready(function() {
        $('#form-regist').submit(function(event) {
            event.preventDefault(); // prevent the default behavior of the submit button
            var formData = $(this).serialize(); // serialize the form data into a URL-encoded string
            Swal.fire({
                title: 'Are You Sure You Will Register ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('{{ route('proses-regist') }}', formData, function(response) {
                        if (response.email[0] == 'Email sudah digunakan' ||
                            response.username[0] == 'Username sudah digunakan') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.email[0] + ' Atau ' +
                                    response.username[0],
                                footer: ''
                            })
                        } else {
                            Swal.fire(
                                'Registed!',
                                'Your personal data has been successfully registered.',
                                'success'
                            )
                        }
                    });
                }
            })
        });
    });
</script>

</html>
