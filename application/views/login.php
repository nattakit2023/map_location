<?php
if ($this->config->item('company_name') !== '') {
  $company_name =  $this->config->item('company_name');
} else {
  $company_name = 'Vechicle Management';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    footer {
      text-align: center;
      margin-top: 10px;
      color: #999;
    }

    footer span {
      color: #007bff;
      font-size: 18px;
      font-weight: 600;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="row" style="margin-bottom: 40px;justify-content: center;">
      <img src="<?= base_url(); ?>assets/image/SC.png" width=60%" alt="First Logo" class="logo">
    </div>

    <div class="row">
      <?php $successMessage = $this->session->flashdata('successmessage');
      $warningmessage = $this->session->flashdata('warningmessage');
      if (isset($successMessage)) {
        echo '<div id="alertmessage" class="col-md-12">
          <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   ' . output($successMessage) . '
                  </div>
          </div>';
      }
      if (isset($warningmessage)) {
        echo '<div id="alertmessage" class="col-md-12">
          <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   ' . output($warningmessage) . '
                  </div>
          </div>';
      }
      ?>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h3 class="login-box-msg">Smart Ship Solution</h3>
        <form action="<?= base_url() . 'login/login_action'; ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" required class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">

              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
    <footer>
      <p>&copy; 2021 SCM and all rights reserved. </p>
      <p> Designed by <span>Ship Expert</span>. Version 1.0</p>
    </footer>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>