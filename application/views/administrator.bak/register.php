<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual-and-Remote-Guidance-Counselling-System | <?=$heading;?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url().'media/'?>assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="<?=base_url().'media/'?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?=base_url().'media/'?>global.css" rel="stylesheet">
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
    
            <div class="container-fluid" style="margin-top:100px">
                
                <!-- Row -->
                <div class="row">

                <div class="col-lg-4 offset-lg-4">
            <center><img src="<?=base_url().'media/'?>assets/images/logo.png" alt="users" width="200" class="d-none" /></center>
            <div style="margin-top: 100px;"></div>
</div>
                    <!-- Column -->
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card" style="background: none; color: #fff;">
                            <div class="card-body">
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="alert alert-primary d-flex align-items-center d-none" role="alert" id="alertprimary">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
    User registration successful.
  </div>
</div>
<div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    User registration successful.
  </div>
</div>
<div class="alert alert-warning d-flex align-items-center d-none" role="alert" id="alertwarning">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    User registration failed, please try again.
  </div>
</div>
<div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    <?=$this->session->flashdata('RegisterFailed');?>
  </div>
</div>
                                <h2 class="text-center" style="margin-bottom: 20px">Register Here</h2>
                                <form class="form-horizontal form-material mx-2" action="<?=site_url().'administrator/user_save'?>" id="frmRegister" method="post">
                                    <?=$this->routines->InsertCSRF()?>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="txtFullname" class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Full Name"
                                                        class="form-control form-control-line" required="required" name="txtFullname" id="txtFullname" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtCollege" class="col-md-12">College</label>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="txtCollege" required="required" id="txtCollege">
                                                        <option value="" selected hidden>&lt;Select College&gt;</option>
                                                        <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                                                        foreach ($query->result() as $row) : ?>
                                                            <option value="<?=$row->CollegeID;?>"><?=$row->College;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtCourse" class="col-md-12">Course</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Course"
                                                        class="form-control form-control-line" required="required" name="txtCourse" id="txtCourse" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtYearSec" class="col-md-12">Year & Section</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Year & Section"
                                                        class="form-control form-control-line" required="required" name="txtYearSec" id="txtYearSec" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtBiologicalSex" class="col-md-12">Biological Sex</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Biological Sex"
                                                        class="form-control form-control-line" required="required" name="txtBiologicalSex" id="txtBiologicalSex" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 offset-lg-2">
                                            <div class="form-group">
                                                <label for="txtIdentifiedGender" class="col-md-12">Identified Gender</label>
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-line" name="txtIdentifiedGender" required="required" id="txtIdentifiedGender">
                                                        <option value="" selected hidden>&lt;Select Identified Gender&gt;</option>
                                                        <option value="0">Female</option>
                                                        <option value="1">Male</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtEmail" class="col-md-12">School Email</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Email"
                                                        class="form-control form-control-line" required="required" name="txtEmail" id="txtEmail" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtAddress" class="col-md-12">Address</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Address"
                                                        class="form-control form-control-line" required="required" name="txtAddress" id="txtAddress" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtPassword" class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" placeholder="Password" value=""
                                                        class="form-control form-control-line" required="required" name="txtPassword" id="txtPassword" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtConfirmPassword" class="col-md-12">Confirm Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" placeholder="Confirm Password" value=""
                                                        class="form-control form-control-line" required="required" name="txtConfirmPassword" id="txtConfirmPassword" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 mt-4">
                                            <center><button class="btn btn-primary text-white" type="submit" style="width: 180px; background: #5271ff;">REGISTER</button><br></br>Already have an account? <a href="<?=site_url().'administrator/login'?>" class="text-white" style="width: 150px;">Sign In</a></center>
                                        </div>
                                        <div class="col-sm-12 mt-4">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=base_url().'media/'?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url().'media/'?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url().'media/'?>dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url().'media/'?>dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url().'media/'?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url().'media/'?>dist/js/custom.js"></script>

    <script type="text/javascript">
        function successful() {
           // $('#alertsuccess').removeClass('d-none');
           //  setTimeout(function(){
           //     $('#alertsuccess').addClass('d-none');
           //  }, 5000);
            document.querySelector('#alertsuccess').classList.remove('d-none');
            setTimeout(function(){
               document.querySelector('#alertsuccess').classList.add('d-none');
            }, 5000);
        }
        function failed() {
           // $('#alertsuccess').removeClass('d-none');
           //  setTimeout(function(){
           //     $('#alertsuccess').addClass('d-none');
           //  }, 5000);
            document.querySelector('#alertdanger').classList.remove('d-none');
            setTimeout(function(){
               document.querySelector('#alertdanger').classList.add('d-none');
            }, 5000);
        }
    </script>

    <?php if($this->session->flashdata('RegisterSuccess') != '') : ?>
        <script>
        successful();
        </script>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('RegisterFailed') != '') : ?>
        <script>
        failed();
        </script>
    <?php endif; ?>
</body>

</html>
