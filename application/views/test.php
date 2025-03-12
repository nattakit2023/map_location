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
    body {
      background-color: #333;
    }

    button {
      border: none;
      background: none;
      outline: none;
      cursor: pointer;
      position: relative;
    }

    .login-card-body {
      background-color: #333;
    }

    .neon-text {
      color: #fff;
      /* White text */
      font-size: 2.3em;
      /* Adjust as needed */
      font-weight: bold;
      text-shadow:
        0 0 5px rgb(122, 206, 255),
        /* Inner glow */
        0 0 10px rgb(122, 206, 255),
        /* Outer glow */
        0 0 15px rgb(122, 206, 255),
        /* Further glow */
        0 0 20px rgb(122, 206, 255);
      /* Even further glow */
      -webkit-text-stroke: 1px rgb(122, 206, 255);
      /* Neon outline (WebKit) */
      text-stroke: 1px rgb(122, 206, 255);
      /* Neon outline (standard) */

      margin-bottom: 20px;
    }

    .btn-neon {
      text-decoration: none;
      text-transform: uppercase;
      text-align: center;
      font-size: 24px;
      line-height: 50px;
      color: #f5f5f5;
      width: 180px;
      transition: 1s;
      transition-delay: .9s;
      position: relative;
      display: inline-block;
    }

    .btn-neon:hover {
      box-shadow: 0 0 10px rgb(122, 206, 255),
        0 0 40px rgb(122, 206, 255),
        0 0 80px rgb(122, 206, 255);
      background-color: rgb(122, 206, 255);
    }

    .btn-neon:hover polyline {
      stroke-dashoffset: -460;
    }

    .btn-neon svg {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
    }

    .btn-neon svg polyline {
      fill: transparent;
      stroke: rgb(122, 206, 255);
      stroke-width: 2px;
      stroke-dasharray: 40 460;
      stroke-dashoffset: 40;
      transition: .8s ease-in-out;
    }

    .logo-container {
      display: flex;
      /* Center logos horizontally */
      align-items: center;
      /* Center logos vertically */
      margin-bottom: 20px;
      /* Space between logos and form */
    }

    .logo {
      max-height: 80px;
      /* Adjust logo height as needed */
      margin: 0 10px;
      /* Space between logos */
    }
  </style>
</head>

<body class="hold-transition login-page" style="background-color: #333;">
  <div class="login-box">
    <div class="logo-container" style="box-shadow: 0 0 5px rgb(122, 206, 255), 0 1px 5px rgb(0 0 0 / 20%);">
      <img src="<?= base_url(); ?>assets/image/SC.png " width="160" height="80" alt="First Logo" class="logo">
      <img src="<?= base_url(); ?>assets/image/old-logo-expert-black.png " width="160" height="80" alt="First Logo" class="logo">
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
    <div class="card" style="box-shadow: 0 0 5px rgb(122, 206, 255), 0 1px 5px rgb(0 0 0 / 20%);">
      <div class="card-body login-card-body">
        <h4 class="login-box-msg neon-text">X PERT MONITOR</h4>


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
          <div class="row" style="margin: 40px 20px 40px 20px;">
            <!-- /.col -->
            <div class="col-12" style="display: flex; justify-content: center;">

              <button type="submit" class="btn-neon">
                Sign In <svg height="50" width="180">
                  <polyline points="0,0 180,0 180,50 0,50 0,00">
                  </polyline>
                </svg>
              </button>
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
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>