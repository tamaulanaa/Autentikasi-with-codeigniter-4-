<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Recover Password</title>

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
      <a href="../../index2.html"><b>Reset Password</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <?php

        if (session()->getFlashdata('error')) : ?>

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

        <form action="<?php echo base_url('/forgot/resetpassword/' . $token); ?>" method="post">
          <?= csrf_field() ?>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


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