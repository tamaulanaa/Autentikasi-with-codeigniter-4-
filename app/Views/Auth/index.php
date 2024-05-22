<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('asset//dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Halaman</b><br>Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>


                <div class="card">
                    <div class="card-body register-card-body">

                        <?php if (session()->getFlashdata('error')) : ?>

                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')) : ?>

                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('success') ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('user/masuk'); ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="social-auth-links text-center mb-1">
                                <button type="submit" class="btn btn-primary btn-block mb-1">Sign In</button>

                            </div>

                            <!-- /.col -->
                    </div>
                    </form>



                    <a href="forgot" class="text-center">I forgot my password</a>

                    <a href="register" class="text-center">Register a new membership</a>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="<?= base_url('asset/plugins/jquery/jquery.min.js') ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<? base_url('asset//plugins/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('asset/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>