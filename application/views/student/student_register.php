<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Email = $this->session->flashdata("Email");
$last_name = $this->session->flashdata("last_name");
$first_name = $this->session->flashdata("first_name");
$middle_name = $this->session->flashdata("middle_name");
$SchoolID = $this->session->flashdata("SchoolID");
$Course = $this->session->flashdata("Course");
$YearSec = $this->session->flashdata("YearSec");
$CollegeID = $this->session->flashdata("CollegeID");
$Gender = $this->session->flashdata("Gender");
$Address = $this->session->flashdata("Address");

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

  <div class="container-fluid" style="margin-top:100px">

    <!-- Row -->
    <div class="row">
      <!-- Column -->
      <div class="col-lg-8 offset-lg-2" style="margin-top: 50px;">
        <div class="card" style="background: none; color: #fff;">
          <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
              <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
              </symbol>
              <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
              </symbol>
              <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </symbol>
            </svg>

            <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                <?= $this->session->flashdata('RegisterSuccess'); ?>
              </div>
            </div>
            <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?= $this->session->flashdata('RegisterFailed'); ?>
              </div>
            </div>
            <h2 class="text-center" style="margin-bottom: 20px">Register Here</h2>
            <form class="form-horizontal form-material mx-2" action="<?= site_url() . 'student/student_save' ?>" id="frmRegister" method="post">
              <?= $this->routines->InsertCSRF() ?>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="col-md-12">Fist name</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" placeholder="Fist name" required name="txtFname" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Middle name</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" placeholder="Middle name" required name="txtMname" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Last name</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" placeholder="Last name" required name="txtLname" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtCollege" class="col-md-12">College</label>
                    <div class="col-md-12">
                      <select class="form-select form-control-line" name="txtCollege" required id="txtCollege">
                        <option value="" selected hidden>Select College</option>
                        <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                        foreach ($query->result() as $row) : ?>
                          <option value="<?= $row->CollegeID; ?>" <?= ($CollegeID == $row->CollegeID) ? ' selected' : ''; ?>><?= $row->College; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="txtCourse" class="col-md-12">Course</label>
                        <div class="col-md-12">
                          <input type="text" placeholder="Course" class="form-control form-control-line" required name="txtCourse" id="txtCourse" value="<?= $Course; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="txtYearSec" class="col-md-12">Year & Section</label>
                        <div class="col-md-12">
                          <input type="text" placeholder="Year & Section" class="form-control form-control-line" required name="txtYearSec" id="txtYearSec" value="<?= $YearSec; ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 offset-lg-2">
                  <div class="form-group">
                    <label class="col-md-12 control-label">Gender</label>
                    <div class="col-md-12">
                      <select name="txtGender" class="form-select form-control-line">
                        <option value="" selected disabled>Select Gender</option>
                        <?php
                        $genders = array(
                          "Male",
                          "Female",
                          "Gay",
                          "Lesbian",
                          "Bisexual",
                          "Prefer not to say"
                        );
                        foreach ($genders as $genderList) :
                        ?>
                          <option value="<?= $genderList ?>" <?= $Gender == $genderList ? "selected" : "" ?>><?= $genderList ?></option>
                        <?php endforeach; ?>

                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="txtEmail" class="col-md-12">School Email</label>
                        <div class="col-md-12">
                          <input type="text" placeholder="Email" class="form-control form-control-line" required name="txtEmail" id="txtEmail" value="<?= $Email; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-12">Student ID</label>
                        <div class="col-md-12">
                          <input type="text" placeholder="Student ID" class="form-control form-control-line" required name="txtStudentId" value="<?= $SchoolID; ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtAddress" class="col-md-12">Address</label>
                    <div class="col-md-12">
                      <input type="text" placeholder="Address" class="form-control form-control-line" required name="txtAddress" id="txtAddress" value="<?= $Address; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtPassword" class="col-md-12">Password</label>
                    <div class="col-md-12">
                      <input type="password" placeholder="Password" value="" class="form-control form-control-line" required name="txtPassword" id="txtPassword" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtConfirmPassword" class="col-md-12">Confirm Password</label>
                    <div class="col-md-12">
                      <input type="password" placeholder="Confirm Password" value="" class="form-control form-control-line" required name="txtConfirmPassword" id="txtConfirmPassword" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12 mt-4">
                  <center>
                    <button class="btn btn-primary" type="submit" style="width: 180px; background: #5271ff;">
                      REGISTER
                    </button>
                    <br>
                    <br>
                    <span class="text-dark">
                      Already have an account?
                    </span>
                    <a href="<?= site_url() . 'student/login' ?>" class="text-default" style="width: 150px;">Sign In</a>
                  </center>
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
    function successful() {

      document.querySelector('#alertsuccess').classList.remove('d-none');
      setTimeout(function() {
        document.querySelector('#alertsuccess').classList.add('d-none');
      }, 5000);
    }

    function failed() {

      document.querySelector('#alertdanger').classList.remove('d-none');
      setTimeout(function() {
        document.querySelector('#alertdanger').classList.add('d-none');
      }, 5000);
    }
  </script>

  <?php if ($this->session->flashdata('RegisterSuccess') != '') : ?>
    <script>
      successful();
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('RegisterFailed') != '') : ?>
    <script>
      failed();
    </script>
  <?php endif; ?>
  <script type="text/javascript">
    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /* For each element, create a new DIV that will act as the selected item: */
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /* For each element, create a new DIV that will contain the option list: */
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < ll; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
          /* When an item is clicked, update the original select box,
          and the selected item: */
          var y, i, k, s, h, sl, yl;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          sl = s.length;
          h = this.parentNode.previousSibling;
          for (i = 0; i < sl; i++) {
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              yl = y.length;
              for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
          }
          h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }

    function closeAllSelect(elmnt) {
      /* A function that will close all select boxes in the document,
      except the current select box: */
      var x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }

    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);
  </script>
</body>

</html>