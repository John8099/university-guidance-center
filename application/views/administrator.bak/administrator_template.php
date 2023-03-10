<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Virtual-and-Remote-Guidance-Counselling-System | <?= $heading; ?></title>
  <!-- Calendar CSS -->
  <link href="<?= base_url() . 'media/' ?>fullcalendar/lib/main.css" rel="stylesheet">
  <script src='https://github.com/mozilla-comm/ical.js/releases/download/v1.4.0/ical.js'></script>
  <script src='<?= base_url() . 'media/' ?>fullcalendar/lib/main.js'></script>
  <script src='<?= base_url() . 'media/' ?>fullcalendar/packages/icalendar/main.global.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var data = [];
      <?php
      $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE Status='Active';");

      foreach ($query->result() as $row) :
        $Fullname = '';
        $User = $this->db->query("SELECT * FROM tbluser WHERE UserID = '" . $row->CreatedBy . "';")->row();
        if (isset($User->UserID)) {
          $Fullname = $User->Fullname;
        }
      ?>
        data.push({
          title: '<?= $row->AppointmentTime . " - " . $Fullname; ?>',
          url: '<?= site_url() . 'administrator/set_schedule_date/' . $row->AppointmentSchedID; ?>',
          start: '<?= $row->AppointmentDate; ?>'
        });
      <?php endforeach; ?>
      var calendar = new FullCalendar.Calendar(calendarEl, {
        displayEventTime: false,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
        },
        events: data,
        loading: function(bool) {
          document.getElementById('loading').style.display =
            bool ? 'block' : 'none';
        }
      });

      calendar.render();

      $('.fc-prev-button').on("click", function() {
        $('.fc-event-title').each(function(data) {
          $(this).html($(this).text());
        });
      });

      $('.fc-next-button').on("click", function() {
        $('.fc-event-title').each(function(data) {
          $(this).html($(this).text());
        });
      });
    });
  </script>
  <!-- Custom CSS -->
  <link href="<?= base_url() . 'media/' ?>assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
  <link href="<?= base_url() . 'media/' ?>dist/css/style.min.css" rel="stylesheet">
  <link href="<?= base_url() . 'media/' ?>global.css" rel="stylesheet">
  <script src="<?= base_url() . 'media/' ?>assets/libs/sweetalert/sweetalert.min.js"></script>
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
      border: 1px solid #e9ecef !important;
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
      border: 1px solid #e9ecef !important;
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


<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="<?= site_url() . 'admin' ?>">
            <!-- Logo icon -->
            <b class="logo-icon">
              <img src="<?= base_url() . 'media/' ?>assets/images/logo-1.png" alt="homepage" style="margin-top:-50px;margin-bottom:-50px" />
            </b>
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-start me-auto">
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <li class="nav-item search-box d-none"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
              <form class="app-search position-absolute">
                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
              </form>
            </li>
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-end">
            <li class="nav-item dropdown">
              <a class="dropdown-item text-danger" href="<?= site_url() . 'administrator/logout' ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <!-- User Profile-->
            <li>
              <!-- User Profile-->
              <div class="user-profile dropdown m-t-20">
                <div class="user-pic d-flex justify-content-center">
                  <img src="<?= base_url('uploads/') . $this->session->userdata('ImageLoc'); ?>" alt="users" class="rounded-circle" width="100" />
                </div>
                <div class="user-content hide-menu m-l-10 text-center">
                  <a href="#" class="" id="Userdd" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h6 class="m-b-0 m-t-20 user-name font-small">
                      <?= $this->session->userdata("AdminFullname") ?>
                      <i class="fa fa-angle-down"></i>
                    </h6>
                    <span class="op-5 user-email">
                      <?= $this->session->userdata("AdminUserType") ?>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">

                    <a class="dropdown-item" href="<?= site_url() . 'administrator/change_password'; ?>"><i class="ti-user m-r-5 m-l-5"></i> Change Password</a>
                    <a class="dropdown-item" href="<?= site_url() . 'administrator/change_profile_picture'; ?>"><i class="ti-user m-r-5 m-l-5"></i> Change Profile Picture</a>
                  </div>
                </div>
              </div>
              <!-- End User Profile-->
            </li>
            <!-- User Profile-->
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/'; ?>" aria-expanded="false">
                <i class="mdi mdi-account-circle"></i><span class="hide-menu">Student Inventory</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/dashboard'; ?>" aria-expanded="false">
                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="sidebar-item d-none">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/assessments'; ?>" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Create assessment</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/wellness_question_list'; ?>" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Wellness Check</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/colleges'; ?>" aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">College</span>
              </a>
            </li>


            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/appointments'; ?>" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Appointment list</span>
              </a>
            </li>

            <li class="sidebar-item d-none">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/appointment_reports'; ?>" aria-expanded="false"><i class="mdi mdi-chart-histogram"></i><span class="hide-menu">Monthly Reports</span>
              </a>
            </li>

            <li class="sidebar-item d-none">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/assessment_reports'; ?>" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span class="hide-menu">Assessment Reports</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row align-items-center">
          <div class="col-5">
            <h4 class="page-title"><i class="mdi mdi-view-dashboard"></i> <?= $sub_heading; ?></h4>
            <div class="d-flex align-items-center">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $sub_heading; ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <?php if (isset($content)) : ?>
          <?php if ($content == 'student_inventory') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'dashboard') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'wellness_question_list') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'colleges') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'appointments') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'college') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'view_appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'appointment_reports') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'assessments') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'assessment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'question') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'schedule') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'students') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'completed_appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'admin_lists') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'admin_list') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'pending_appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'assessment_reports') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'question_banks') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'question_bank') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'student_view') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'wellness_checks') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'wellness_check') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'wellness_question') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'set_schedule_appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'schedule_appointment') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'change_password') : ?>
            <?php $this->load->view('administrator/' . $content); ?>

          <?php elseif ($content == 'change_profile_picture') : ?>
            <?php $this->load->view('administrator/' . $content); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
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
  <!--This page JavaScript -->
  <!--chartis chart-->
  <script src="<?= base_url() . 'media/' ?>assets/libs/chartist/dist/chartist.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>dist/js/pages/dashboards/dashboard1.js"></script>
  <script src="<?= base_url() . 'media/' ?>dist/js/chart.js"></script>

  <script src="<?= base_url() . 'media/' ?>datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables/buttons.print.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables/responsive.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        buttons: [{
          customize: function(win) {
            $(win.document.body).find('h1').css('font-size', '12pt');
          }
        }],
        "paging": false,
      });
    });
    $('#SelectCollegeAppointmentReports').change(function() {
      window.location = '<?= site_url() . 'administrator/appointment_reports/'; ?>' + $('#SelectCollegeAppointmentReports').val();
    });
  </script>

  <script type="text/javascript">
    function successful() {
      // $('#alertsuccess').removeClass('d-none');
      //  setTimeout(function(){
      //     $('#alertsuccess').addClass('d-none');
      //  }, 5000);
      document.querySelector('#alertsuccess').classList.remove('d-none');
      setTimeout(function() {
        document.querySelector('#alertsuccess').classList.add('d-none');
      }, 5000);
    }

    function failed() {
      // $('#alertsuccess').removeClass('d-none');
      //  setTimeout(function(){
      //     $('#alertsuccess').addClass('d-none');
      //  }, 5000);
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
  <script>
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