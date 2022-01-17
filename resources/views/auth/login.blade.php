<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NIN Digimon</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Custom style for this template-->
    <link rel="stylesheet" href="{{ asset('assets/sbadmin2/css/sb-admin-2.min.css') }}">

</head>

<body style="background-color:#e3f0f4">

    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"
                                style="background-image:url('{{ asset('assets/img/buildingnoktrans.png') }}');">
                            </div>
                            <div class="col-lg-6">
                                <img class="rounded mx-auto d-block mt-4" src="{{asset('assets/img/logonok.png')}}"
                                    alt="" width="100" height="100">
                                <div class="p-5 mt-1">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to NIN Digimon</h1>
                                    </div>
                                    <div id="error-msg"></div>
                                    <form class="user" method="post" id="form-login" action="{{url('/proses-login')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <small>&copy; 2021 Technology Control PT. NOK Indonesia</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

<!--Boostrap Core Javascript -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core Plugin Javascript -->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all page-->
<script src="{{ asset('assets/sbadmin2/js/sb-admin-2.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () { //function Jquery
        $('#form-login').on('submit', function (e) {
            e.preventDefault();

            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({ //function ajax
                    url: '{{ url('/proses-login') }}',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token() }}'
                    },
                    data: {
                        email,
                        password
                    },
                    success: function (response) {
                        $('#error-msg').html(`
                        <div class="alert alert-success">
                        <i class="fa fa-exclamation-triangle"></i> ${response.msg}
                        </div>
                    `);

                        window.location.href = '{{ url('/home') }}';
                    },
                    error: function (xhr, stat, err) {
                        $('#error-msg').html(`
                         <div class="alert alert-danger">
                         <i class="fa fa-exclamation-triangle"></i> Whoops, terjadi kesalahan pada sistem.
                    `);
                    }
                })
                .fail(err => {
                    $('#error-msg').html('');
                    if (err.status == 401) {
                        $('#error-msg').html(`
                        <div class="alert alert-danger"> 
                           <i class="fa fa-exclamation-triangle"></i> ${err.responseJSON.msg}
                        </div>
                    `);
                    }
                })
        })
    });

</script>

</html>
