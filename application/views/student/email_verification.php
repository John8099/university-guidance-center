<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Virtual-and-Remote-Guidance-Counselling-System | <?= $heading; ?></title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() . 'media/' ?>assets/images/favicon.png">
  <!-- Custom CSS -->
  <link href="<?= base_url() . 'media/' ?>dist/css/style.min.css" rel="stylesheet">
  <link href="<?= base_url() . 'media/' ?>global.css" rel="stylesheet">
  <style type="text/css">
    /*the container must be positioned relative:*/
    .custom-select {
      position: relative;
      font-family: Arial;
    }

    .custom-select select {
      display: none;
      /*hide original SELECT element:*/
    }

    .select-selected {
      background-color: #ffffff;
    }

    /*style the arrow inside the select element:*/
    .select-selected:after {
      position: absolute;
      content: "";
      top: 14px;
      right: 10px;
      width: 0;
      height: 0;
      border: 6px solid transparent;
      border-color: #3e5569 transparent transparent transparent;
    }

    /*point the arrow upwards when the select box is open (active):*/
    .select-selected.select-arrow-active:after {
      border-color: transparent transparent #fff transparent;
      top: 7px;
    }

    /*style the items (options), including the selected item:*/
    .select-items div,
    .select-selected {
      color: #3e5569;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
      user-select: none;
      border-radius: 10px;
    }

    /*style items (options):*/
    .select-items {
      position: absolute;
      background-color: #ffffff;
      border-radius: 10px;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 99;
    }

    /*hide the items when the select box is closed:*/
    .select-hide {
      display: none;
    }

    .select-items div:hover,
    .same-as-selected {
      background-color: rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="login">
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>

  <div class="container-fluid" style="margin-top:100px;">

    <!-- Row -->

    <div class="row justify-content-md-center align-items-center" style=" min-height: 500px !important;">
      <!-- column -->
      <div class="col-4">
        <div class="card">
          <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
              <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
              <?= $this->session->flashdata('Success'); ?>
            </div>
          </div>
          <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
              <?= $this->session->flashdata('Failed'); ?>
            </div>
          </div>
          <div class="card-body text-center">
            <h2 class="card-title">Welcome!</h2>

            <p>Thanks for signing up! <br> We just need you to verify your email address to complete setting up your account.</p>
            <p>Please input the OTP code that we send on your email.</p>
            <form class="form-horizontal form-material mx-2" action="<?= site_url() . 'student/student_verify/' . $this->uri->segment(3); ?>" method="post">
              <?= $this->routines->InsertCSRF() ?>
              <div class="form-group d-flex justify-content-center">
                <div class="col-md-8">
                  <input type="text" class="form-control form-control-line text-center" required name="txtOTPCode" />
                </div>
              </div>
              <button class="btn btn-success text-white" style="width: 200px; background: #5271ff;" type="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="<?= base_url() . 'media/' ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url() . 'media/' ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>dist/js/app-style-switcher.js"></script>
  <!--Wave Effects -->
  <script src="<?= base_url() . 'media/' ?>dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="<?= base_url() . 'media/' ?>dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="<?= base_url() . 'media/' ?>dist/js/custom.js"></script>
  <script type="text/javascript">
    console.log("otp code: <?= $this->session->userdata("OTP"); ?>")
    function successful() {
      document.querySelector('#alertsuccess').classList.remove('d-none');
      setTimeout(function() {
        document.querySelector('#alertsuccess').classList.add('d-none');
        window.location.href = "<?= site_url() . "student/login" ?>"
      }, 5000);
    }

    function failed() {
      document.querySelector('#alertdanger').classList.remove('d-none');
      setTimeout(function() {
        document.querySelector('#alertdanger').classList.add('d-none');
      }, 5000);
    }
  </script>

  <?php if ($this->session->flashdata('Success') != '') : ?>
    <script>
      successful();
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('Failed') != '') : ?>
    <script>
      failed();
    </script>
  <?php endif; ?>
</body>

</html>