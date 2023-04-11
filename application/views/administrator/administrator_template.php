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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var data = [];
      <?php
      $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE Status='Active';");
      $Appointment = '';
      foreach ($query->result() as $row) :
        $Fullname = '';
        $User = $this->db->query("SELECT * FROM tbluser WHERE UserID = '" . $row->CreatedBy . "';")->row();
        if (isset($User->UserID)) {
          $Fullname = $this->routines->getUserFullName($User->UserID);
        }
        $Appointment = $row->AppointmentTime . '<br>' . $Fullname;
      ?>
        appointment = '<?= $Appointment; ?>';
        data.push({
          title: appointment,
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
          const loadingEl = document.getElementById('loading');
          if (loadingEl) {
            loadingEl.style.display = bool ? 'block' : 'none'
          }
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

  <link rel="stylesheet" href="<?= base_url() . 'media/' ?>datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() . 'media/' ?>datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.3.4/css/searchBuilder.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() . 'media/' ?>datatables-datetime/css/dataTables.dateTime.min.css">

  <script src="<?= base_url() . 'media/' ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>sweetalert2/sweetalert2.all.min.js"></script>

  <link rel="stylesheet" href="<?= base_url() . 'media/' ?>jquery-editable-select/css/jquery-editable-select.css">
  <script src="<?= base_url() . 'media/' ?>jquery-editable-select/js/jquery-editable-select.js"></script>

  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url() . 'media/' ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="<?= base_url() . 'media/' ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script> -->
  <script src="<?= base_url() . 'media/' ?>dist/js/app-style-switcher.js"></script>
  <!--Wave Effects -->
  <script src="<?= base_url() . 'media/' ?>dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="<?= base_url() . 'media/' ?>dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="<?= base_url() . 'media/' ?>dist/js/custom.js"></script>
  <!--This page JavaScript -->

  <script src="<?= base_url() . 'media/' ?>datatables/jquery.dataTables.min.js"></script>

  <script src="<?= base_url() . 'media/' ?>datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>jszip/jszip.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-buttons/js/buttons.colVis.min.js"></script>

  <script src="<?= base_url() . 'media/' ?>datatables-searchbuilder/js/dataTables.searchBuilder.js"></script>
  <script src="<?= base_url() . 'media/' ?>datatables-datetime/js/dataTables.dateTime.min.js"></script>
  <style type="text/css">
    .fc-day-today {
      background: #d1e0ef !important;
    }

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

    .dataTables_filter {
      display: flex;
      justify-content: flex-end !important;
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
    <aside class="left-sidebar" data-sidebarbg="skin6" id="leftSideBar">
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
                  <img src="<?= base_url('uploads/') . $this->session->userdata('ImageLoc'); ?>" alt="users" class="rounded-circle" id="leftSideProfile" />
                </div>
                <div class="user-content hide-menu m-l-10 text-center">
                  <a href="#" class="" id="Userdd" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <h6 class="m-b-0 m-t-20 user-name font-small">
                      <?= $this->session->userdata("Fullname") ?>
                      <i class="fa fa-angle-down"></i>
                    </h6>
                    <span class="op-5 user-email">
                      <?= $this->session->userdata("UserType") ?>
                      <?= $this->routines->getCollege($this->session->userdata("CollegeID")) ?>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">
                    <a class="dropdown-item" href="<?= site_url() . 'administrator/admin_lists'; ?>"><i class="ti-user m-r-5 m-l-5"></i> Admin List</a>
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
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/wellness_checks'; ?>" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Assessment list</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/question_banks'; ?>" aria-expanded="false"><i class="mdi mdi-bank"></i><span class="hide-menu">Question bank</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/appointments'; ?>" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Manage Appointment</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url() . 'administrator/appointment_list'; ?>" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">Appointment List</span>
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

        <?php if (isset($content)) {
          if ($content == 'student_inventory') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'dashboard') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'wellness_question_list') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'appointments') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'college') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'view_appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'appointment_reports') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'assessments') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'assessment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'question') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'schedule') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'students') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'completed_appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'admin_lists') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'admin_list') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'pending_appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'assessment_reports') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'question_banks') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'question_bank') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'student_view') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'wellness_checks') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'wellness_check') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'wellness_question') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'set_schedule_appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'schedule_appointment') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'wellness_question_update') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'change_password') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'change_profile_picture') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'appointment_list') :
            $this->load->view('administrator/' . $content);

          elseif ($content == 'question_banks') :
            $this->load->view('administrator/' . $content);

          endif;
        }
        ?>

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


  <script type="text/javascript">
    try {
      $(document).ready(function() {
        $('.fc-event-title.fc-sticky').each(function(data) {
          $(this).html($(this).text());
        });

        const tableConfig = {
          "paging": true,
          "lengthChange": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,

          "buttons": [
            "searchBuilder",
          ],
          language: {
            searchBuilder: {
              button: 'Advance search',
            }
          },
        }

        var table = $("#dashboardTable").DataTable(tableConfig)
        var assessmentTable = $("#assessmentTable").DataTable(tableConfig)

        table.buttons().container().appendTo('#dashboardTable_wrapper .col-md-6:eq(0)');
        assessmentTable.buttons().container().appendTo('#assessmentTable_wrapper .col-md-6:eq(0)');
      });

      $('#SelectCollegeAppointmentReports').change(function() {
        window.location = '<?= site_url() . 'administrator/appointment_reports/'; ?>' + $('#SelectCollegeAppointmentReports').val();
      });
    } catch (err) {
      console.error(err)
    }

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
    try {
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

      let inumber = 1;
      let qnumber = 1;
      $(document).ready(function() {
        $('#btn_add_question').click(function() {
          question_input = `<div id="qinputremoveq` + inumber + `" class="row"><div class="col-lg-11 col-xlg-11 col-md-11">
                                <div class="form-group">
                                    <label for="txtQuestion[]" class="col-md-12">Question</label>
                                    <div class="col-md-12">
                                        <input name='txtQuestion[]' id="txtQuestion[]" type="text" placeholder="Enter title here" class="form-control form-control-line" value="" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-1 col-xlg-1 col-md-1">
                                <div class="form-group">
                                    <div class="col-md-12">
                                    <label for="txtQuestion[]" class="col-md-12">&nbsp;</label>
                                        <button type="button" class="btn btn-success w-100 btn_add_question" id="removeq` + inumber + `">Remove</button>
                                    </div>
                                </div>
                            </div></div>`;
          $('#QuantitativeQuestions').append(question_input);
          inumber++;
        });

        $('#QuantitativeQuestions').on('click', '.btn_add_question', function() {
          var button_id = $(this).attr('id');
          $('#qinput' + button_id + '').remove();
          inumber--;
        });

        $('#btn_add_category').click(function() {
          category_input = `
    <div class="row">
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-xlg-2 col-md-2">
                            <div class="form-group">
                                <label class="col-md-12">Category</label>
                                <div class="col-md-12">
                                    <select class="form-control form-control-line" name="txtCategory" required id="txtCategory">
                                      <option value="">Select Category</option>
                                      <option value="Emotional Wellness">Emotional Wellness</option>
                                      <option value="Environmental Wellness">Environmental Wellness</option>
                                      <option value="Intellectual Wellness">Intellectual Wellness</option>
                                      <option value="Occupational Wellness">Occupational Wellness</option>
                                      <option value="Physical Wellness">Physical Wellness</option>
                                      <option value="Social Wellness">Social Wellness</option>
                                      <option value="Spiritual Wellness">Spiritual Wellness</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="QuantitativeQuestions">
                            <div class="row">
                                <div class="col-lg-11 col-xlg-11 col-md-11">
                                    <div class="form-group">
                                        <label for="txtQuestion[]" class="col-md-12">Question</label>
                                        <div class="col-md-12">
                                            <input name='txtQuestion[]' id="txtQuestion[]" type="text" placeholder="Enter title here" class="form-control form-control-line" value="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-xlg-2 col-md-2">
                            <div class="form-group">
                                <label class="col-md-12">&nbsp;</label>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success w-100" id="btn_add_question">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
          $('#QuantitativeCategory').append(category_input);
          qnumber++;
        });
      });


      const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

      function getNumberWithOrdinal(n) {
        var s = ["th", "st", "nd", "rd"],
          v = n % 100;
        return n + (s[(v - 20) % 10] || s[v] || s[0]);
      }

      let lineData, barData;
      let barChart, lineChart;
      const d = new Date();

      if (document.querySelector("#barChart")) {
        $.get(
          `<?= site_url() . 'administrator/get_bar_data/' ?>`,
          (res, status) => {
            barData = JSON.parse(res)
            console.log(barData)
            let filterBarData = months.map((d) => {
              if (barData.some((a) => a.SelectedDate === d)) {
                const selectedBarData = barData.filter((b) => b.SelectedDate === d)
                if (selectedBarData) {
                  return Number(selectedBarData[0].CountPerMonth)
                }
                return 0
              }
              return 0
            })

            barChartOptions = {
              series: [{
                name: 'Student Count',
                data: filterBarData
              }],
              title: {
                text: "Monthly Student Appointment"
              },
              chart: {
                height: 350,
                type: 'bar',
              },
              plotOptions: {
                bar: {
                  borderRadius: 10,
                  dataLabels: {
                    position: 'top', // top, center, bottom
                  },
                }
              },
              dataLabels: {
                enabled: true,
                formatter: (val) => val,
                offsetY: -20,
                style: {
                  fontSize: '12px',
                  colors: ["#304758"]
                }
              },
              tooltip: {
                y: {
                  formatter: (val) => val
                }
              },
              xaxis: {
                categories: months,
                position: 'bottom',
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false
                },
                crosshairs: {
                  fill: {
                    type: 'gradient',
                    gradient: {
                      colorFrom: '#D8E3F0',
                      colorTo: '#BED1E6',
                      stops: [0, 100],
                      opacityFrom: 0.4,
                      opacityTo: 0.5,
                    }
                  }
                },

              },
              yaxis: {
                labels: {
                  formatter: (val) => val
                },
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false,
                },
              },

            }

            barChart = new ApexCharts(document.querySelector("#barChart"), barChartOptions);

            barChart.render();

          })

        $("#barFilterBy").on("change", function(e) {
          switch (e.target.value) {
            case "course":
              $("#barDivCourse").show();
              $("#barDivGender").hide();
              $("#barDivStudentYear").hide();
              break;
            case "gender":
              $("#barDivCourse").hide();
              $("#barDivGender").show();
              $("#barDivStudentYear").hide();
              break;
            case "studentYear":
              $("#barDivCourse").hide();
              $("#barDivGender").hide();
              $("#barDivStudentYear").show();
              break;
            default:
              $("#barDivCourse").hide();
              $("#barDivGender").hide();
              $("#barDivStudentYear").hide();
          }
          $("#btnBarClear").show();
        })

        $("#barCourseFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'administrator/get_bar_data?filterBy=course&&filterByValue=' ?>${value}`,
            (res, status) => {
              barData = JSON.parse(res)
              let filterBarData = months.map((d) => {
                if (barData.some((a) => a.SelectedDate === d)) {
                  const selectedBarData = barData.filter((b) => b.SelectedDate === d)
                  if (selectedBarData) {
                    return Number(selectedBarData[0].CountPerMonth)
                  }
                  return 0
                }
                return 0
              })
              barChart.updateSeries([{
                name: 'Student Count',
                data: filterBarData
              }])
            })
        })

        $("#barGenderFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'administrator/get_bar_data?filterBy=gender&&filterByValue=' ?>${value}`,
            (res, status) => {
              barData = JSON.parse(res)
              let filterBarData = months.map((d) => {
                if (barData.some((a) => a.SelectedDate === d)) {
                  const selectedBarData = barData.filter((b) => b.SelectedDate === d)
                  if (selectedBarData) {
                    return Number(selectedBarData[0].CountPerMonth)
                  }
                  return 0
                }
                return 0
              })
              barChart.updateSeries([{
                name: 'Student Count',
                data: filterBarData
              }])
            })
        })

        $("#barStudentYearFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'administrator/get_bar_data?filterBy=studentYear&&filterByValue=' ?>${value}`,
            (res, status) => {
              barData = JSON.parse(res)
              let filterBarData = months.map((d) => {
                if (barData.some((a) => a.SelectedDate === d)) {
                  const selectedBarData = barData.filter((b) => b.SelectedDate === d)
                  if (selectedBarData) {
                    return Number(selectedBarData[0].CountPerMonth)
                  }
                  return 0
                }
                return 0
              })
              barChart.updateSeries([{
                name: 'Student Count',
                data: filterBarData
              }])
            })
        })

        function handleBarClear() {
          $.get(
            `<?= site_url() . 'administrator/get_bar_data/' ?>`,
            (res, status) => {
              barData = JSON.parse(res)
              let filterBarData = months.map((d) => {
                if (barData.some((a) => a.SelectedDate === d)) {
                  const selectedBarData = barData.filter((b) => b.SelectedDate === d)
                  if (selectedBarData) {
                    return Number(selectedBarData[0].CountPerMonth)
                  }
                  return 0
                }
                return 0
              })
              barChart.updateSeries([{
                name: 'Student Count',
                data: filterBarData
              }])

              $("#barFilterBy").val("");
              $("#barCourseFilter").val("");
              $("#barGenderFilter").val("");
              $("#barStudentYearFilter").val("");
              $("#barDivCourse").hide();
              $("#barDivGender").hide();
              $("#barDivStudentYear").hide();
              $("#btnBarClear").hide()
            })
        }
      }

      if (document.querySelector("#lineChart")) {
        $.get(
          `<?= site_url() . 'administrator/get_line_data/' ?>`,
          (res, status) => {

            lineData = JSON.parse(res)
            console.log(lineData)

            let posCountData = []
            let neutralCountData = []
            let negCountData = []

            lineData.forEach((d) => {
              switch (d.Results) {
                case "Positive":
                  const posData = lineData.filter((d) => d.Results === "Positive")
                  if (posCountData.length === 0) {
                    for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                      posCountData.push(0)
                    }
                  }
                  posCountData[d.WeekNumber - 1]++
                  break;
                case "Neutral":
                  const neuData = lineData.filter((d) => d.Results === "Neutral")
                  if (neutralCountData.length === 0) {
                    for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                      neutralCountData.push(0)
                    }
                  }
                  neutralCountData[d.WeekNumber - 1]++
                  break;
                case "Negative":
                  const negData = lineData.filter((d) => d.Results === "Negative")
                  if (negCountData.length === 0) {
                    for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                      negCountData.push(0)
                    }
                  }
                  negCountData[d.WeekNumber - 1]++

                  break;
                default:
                  null;
              }
            })

            let lineCategory = []

            for (let i = 1; i <= 52; i++) {
              lineCategory.push(getNumberWithOrdinal(i))
            }

            lineChartOptions = {
              series: [{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }],
              title: {
                text: `${months[d.getMonth()]} Weekly Sentiment Report`
              },
              markers: {
                size: 5,
              },
              chart: {
                height: 350,
                type: 'line',
                zoom: {
                  enabled: false
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'straight',
              },
              grid: {
                row: {
                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                  opacity: 0.5
                },
              },
              tooltip: {
                y: {
                  formatter: (val) => val === undefined ? 0 : val
                }
              },
              xaxis: {
                categories: lineCategory,
              },
              yaxis: {
                labels: {
                  formatter: (val) => val === undefined ? 0 : val
                },
                min: 0
              },
            }

            lineChart = new ApexCharts(document.querySelector("#lineChart"), lineChartOptions);
            lineChart.render();

          })

        $("#lineFilterBy").on("change", function(e) {
          switch (e.target.value) {
            case "month":
              $("#lineDivMonth").show();
              $("#lineDivCourse").hide();
              $("#lineDivGender").hide();
              $("#lineDivStudentYear").hide();
              break;
            case "course":
              $("#lineDivMonth").hide();
              $("#lineDivCourse").show();
              $("#lineDivGender").hide();
              $("#lineDivStudentYear").hide();
              break;
            case "gender":
              $("#lineDivMonth").hide();
              $("#lineDivCourse").hide();
              $("#lineDivGender").show();
              $("#lineDivStudentYear").hide();
              break;
            case "studentYear":
              $("#lineDivMonth").hide();
              $("#lineDivCourse").hide();
              $("#lineDivGender").hide();
              $("#lineDivStudentYear").show();
              break;
            default:
              $("#lineDivMonth").hide();
              $("#lineDivCourse").hide();
              $("#lineDivGender").hide();
              $("#lineDivStudentYear").hide();
          }
          $("#btnLineClear").show();
        })

        $("#lineMonthFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'administrator/get_line_data?filterBy=month&&filterByValue=' ?>${value}`,
            (res, status) => {
              const d = new Date();
              lineData = JSON.parse(res)
              console.log(lineData)

              let posCountData = []
              let neutralCountData = []
              let negCountData = []

              lineData.forEach((d) => {
                switch (d.Results) {
                  case "Positive":
                    const posData = lineData.filter((d) => d.Results === "Positive")
                    if (posCountData.length === 0) {
                      for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                        posCountData.push(0)
                      }
                    }
                    posCountData[d.WeekNumber - 1]++
                    break;
                  case "Neutral":
                    const neuData = lineData.filter((d) => d.Results === "Neutral")
                    if (neutralCountData.length === 0) {
                      for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                        neutralCountData.push(0)
                      }
                    }
                    neutralCountData[d.WeekNumber - 1]++
                    break;
                  case "Negative":
                    const negData = lineData.filter((d) => d.Results === "Negative")
                    if (negCountData.length === 0) {
                      for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                        negCountData.push(0)
                      }
                    }
                    negCountData[d.WeekNumber - 1]++

                    break;
                  default:
                    null;
                }
              })

              lineChart.updateOptions({
                title: {
                  text: `${months[Number(e.target.value) - 1]} Weekly Sentiment Report`
                }
              })

              lineChart.updateSeries([{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }])

            })


        })

        $("#lineCourseFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'administrator/get_line_data?filterBy=course&&filterByValue=' ?>${value}`,
            (res, status) => {
              const d = new Date();
              lineData = JSON.parse(res)
              console.log(lineData)

              let posCountData = []
              let neutralCountData = []
              let negCountData = []

              lineData.forEach((d) => {
                switch (d.Results) {
                  case "Positive":
                    const posData = lineData.filter((d) => d.Results === "Positive")
                    if (posCountData.length === 0) {
                      for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                        posCountData.push(0)
                      }
                    }
                    posCountData[d.WeekNumber - 1]++
                    break;
                  case "Neutral":
                    const neuData = lineData.filter((d) => d.Results === "Neutral")
                    if (neutralCountData.length === 0) {
                      for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                        neutralCountData.push(0)
                      }
                    }
                    neutralCountData[d.WeekNumber - 1]++
                    break;
                  case "Negative":
                    const negData = lineData.filter((d) => d.Results === "Negative")
                    if (negCountData.length === 0) {
                      for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                        negCountData.push(0)
                      }
                    }
                    negCountData[d.WeekNumber - 1]++

                    break;
                  default:
                    null;
                }
              })

              lineChart.updateSeries([{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }])

            })
        })

        $("#lineCourseFilter").on("change", function(e) {
          const value = e.target.value


          // lineChart.updateSeries([{
          //   name: 'Neutral',
          //   data: neutralCountData
          // }, {
          //   name: 'Positive',
          //   data: posCountData
          // }, {
          //   name: 'Negative',
          //   data: negCountData
          // }])
        })

        $("#lineCourseFilter").on("change", function(e) {
          const value = e.target.value

        })

        $("#lineGenderFilter").on("change", function(e) {
          const value = e.target.value

        })

        $("#lineStudentYearFilter").on("change", function(e) {
          const value = e.target.value
        })

        function handleLineClear() {
          $.get(
            `<?= site_url() . 'administrator/get_line_data/' ?>`,
            (res, status) => {
              const d = new Date();
              lineData = JSON.parse(res)
              console.log(lineData)

              let posCountData = []
              let neutralCountData = []
              let negCountData = []

              lineData.forEach((d) => {
                switch (d.Results) {
                  case "Positive":
                    const posData = lineData.filter((d) => d.Results === "Positive")
                    if (posCountData.length === 0) {
                      for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                        posCountData.push(0)
                      }
                    }
                    posCountData[d.WeekNumber - 1]++
                    break;
                  case "Neutral":
                    const neuData = lineData.filter((d) => d.Results === "Neutral")
                    if (neutralCountData.length === 0) {
                      for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                        neutralCountData.push(0)
                      }
                    }
                    neutralCountData[d.WeekNumber - 1]++
                    break;
                  case "Negative":
                    const negData = lineData.filter((d) => d.Results === "Negative")
                    if (negCountData.length === 0) {
                      for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                        negCountData.push(0)
                      }
                    }
                    negCountData[d.WeekNumber - 1]++

                    break;
                  default:
                    null;
                }
              })

              lineChart.updateSeries([{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }])

              lineChart.updateOptions({
                title: {
                  text: `${months[d.getMonth()]} Weekly Sentiment Report`
                }
              })

              $("#lineMonthFilter").val("");
              $("#lineFilterBy").val("");
              $("#lineCourseFilter").val("");
              $("#lineGenderFilter").val("");
              $("#lineStudentYearFilter").val("");
              $("#lineDivMonth").hide();
              $("#lineDivCourse").hide();
              $("#lineDivGender").hide();
              $("#lineDivStudentYear").hide();
              $("#btnLineClear").hide()

            })
        }

      }

      if (document.querySelector("#individualBarChart")) {
        $.get(
          `<?= site_url() . 'superadmin/get_bar_data/' . $this->uri->segment(3) ?>`,
          (res, status) => {
            individualBarChartData = JSON.parse(res)
            console.log(individualBarChartData)
            let filterBarData = months.map((d) => {
              if (individualBarChartData.some((a) => a.SelectedDate === d)) {
                const selectedBarData = individualBarChartData.filter((b) => b.SelectedDate === d)
                if (selectedBarData) {
                  return Number(selectedBarData[0].CountPerMonth)
                }
                return 0
              }
              return 0
            })

            individualBarChartOptions = {
              series: [{
                name: 'Count',
                data: filterBarData
              }],
              title: {
                text: "Monthly Appointment"
              },
              chart: {
                height: 350,
                type: 'bar',
              },
              plotOptions: {
                bar: {
                  borderRadius: 10,
                  dataLabels: {
                    position: 'top', // top, center, bottom
                  },
                }
              },
              dataLabels: {
                enabled: true,
                formatter: (val) => val,
                offsetY: -20,
                style: {
                  fontSize: '12px',
                  colors: ["#304758"]
                }
              },
              tooltip: {
                y: {
                  formatter: (val) => val
                }
              },

              xaxis: {
                categories: months,
                position: 'bottom',
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false
                },
                crosshairs: {
                  fill: {
                    type: 'gradient',
                    gradient: {
                      colorFrom: '#D8E3F0',
                      colorTo: '#BED1E6',
                      stops: [0, 100],
                      opacityFrom: 0.4,
                      opacityTo: 0.5,
                    }
                  }
                },

              },
              yaxis: {
                labels: {
                  formatter: (val) => val
                },
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false,
                },
              },

            }

            individualBarChart = new ApexCharts(document.querySelector("#individualBarChart"), individualBarChartOptions);
            individualBarChart.render();

          })

      }

      if (document.querySelector("#individualLineChart")) {
        $.get(
          `<?= site_url() . 'superadmin/get_line_data/' . $this->uri->segment(3) ?>`,
          (res, status) => {

            individualLineChartData = JSON.parse(res)
            console.log(individualLineChartData)

            let posCountData = []
            let neutralCountData = []
            let negCountData = []

            individualLineChartData.forEach((d) => {
              switch (d.Results) {
                case "Positive":
                  const posData = individualLineChartData.filter((d) => d.Results === "Positive")
                  if (posCountData.length === 0) {
                    for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                      posCountData.push(0)
                    }
                  }
                  posCountData[d.WeekNumber - 1]++
                  break;
                case "Neutral":
                  const neuData = individualLineChartData.filter((d) => d.Results === "Neutral")
                  if (neutralCountData.length === 0) {
                    for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                      neutralCountData.push(0)
                    }
                  }
                  neutralCountData[d.WeekNumber - 1]++
                  break;
                case "Negative":
                  const negData = individualLineChartData.filter((d) => d.Results === "Negative")
                  if (negCountData.length === 0) {
                    for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                      negCountData.push(0)
                    }
                  }
                  negCountData[d.WeekNumber - 1]++

                  break;
                default:
                  null;
              }
            })

            let individualLineCategory = []

            for (let i = 1; i <= 52; i++) {
              individualLineCategory.push(getNumberWithOrdinal(i))
            }

            individualLineChartOptions = {
              series: [{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }],
              title: {
                text: `${months[d.getMonth()]} Weekly Sentiment Report`
              },
              markers: {
                size: 5,
              },
              chart: {
                height: 350,
                type: 'line',
                zoom: {
                  enabled: false
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'straight',
              },
              grid: {
                row: {
                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                  opacity: 0.5
                },
              },
              tooltip: {
                y: {
                  formatter: (val) => val === undefined ? 0 : val
                }
              },
              xaxis: {
                categories: individualLineCategory,
              },
              yaxis: {
                labels: {
                  formatter: (val) => val === undefined ? 0 : val
                },
                min: 0
              },
            }

            individualLineChart = new ApexCharts(document.querySelector("#individualLineChart"), individualLineChartOptions);
            individualLineChart.render();

          })

        $("#lineFilterBy").on("change", function(e) {
          switch (e.target.value) {
            case "month":
              $("#lineDivMonth").show();
              break;
            default:
              $("#lineDivMonth").hide();
              break;
          }
          $("#btnLineClear").show();
        })

        $("#lineMonthFilter").on("change", function(e) {
          const value = e.target.value
          $.get(
            `<?= site_url() . 'superadmin/get_line_data/' . ($this->uri->segment(3)) . '?filterBy=month&&filterByValue=' ?>${value}`,
            (res, status) => {
              const d = new Date();
              lineData = JSON.parse(res)
              console.log(lineData)

              let posCountData = []
              let neutralCountData = []
              let negCountData = []

              lineData.forEach((d) => {
                switch (d.Results) {
                  case "Positive":
                    const posData = lineData.filter((d) => d.Results === "Positive")
                    if (posCountData.length === 0) {
                      for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                        posCountData.push(0)
                      }
                    }
                    posCountData[d.WeekNumber - 1]++
                    break;
                  case "Neutral":
                    const neuData = lineData.filter((d) => d.Results === "Neutral")
                    if (neutralCountData.length === 0) {
                      for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                        neutralCountData.push(0)
                      }
                    }
                    neutralCountData[d.WeekNumber - 1]++
                    break;
                  case "Negative":
                    const negData = lineData.filter((d) => d.Results === "Negative")
                    if (negCountData.length === 0) {
                      for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                        negCountData.push(0)
                      }
                    }
                    negCountData[d.WeekNumber - 1]++

                    break;
                  default:
                    null;
                }
              })

              individualLineChart.updateOptions({
                title: {
                  text: `${months[Number(e.target.value) - 1]} Weekly Sentiment Report`
                }
              })

              individualLineChart.updateSeries([{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }])

            })


        })


        function handleLineClear() {
          $.get(
            `<?= site_url() . 'superadmin/get_line_data/' . $this->uri->segment(3) ?>`,
            (res, status) => {
              const d = new Date();
              lineData = JSON.parse(res)
              console.log(lineData)

              let posCountData = []
              let neutralCountData = []
              let negCountData = []

              lineData.forEach((d) => {
                switch (d.Results) {
                  case "Positive":
                    const posData = lineData.filter((d) => d.Results === "Positive")
                    if (posCountData.length === 0) {
                      for (let i = 0; i < Math.max(...posData.map(o => o.WeekNumber)); i++) {
                        posCountData.push(0)
                      }
                    }
                    posCountData[d.WeekNumber - 1]++
                    break;
                  case "Neutral":
                    const neuData = lineData.filter((d) => d.Results === "Neutral")
                    if (neutralCountData.length === 0) {
                      for (let i = 0; i < Math.max(...neuData.map(o => o.WeekNumber)); i++) {
                        neutralCountData.push(0)
                      }
                    }
                    neutralCountData[d.WeekNumber - 1]++
                    break;
                  case "Negative":
                    const negData = lineData.filter((d) => d.Results === "Negative")
                    if (negCountData.length === 0) {
                      for (let i = 0; i < Math.max(...negData.map(o => o.WeekNumber)); i++) {
                        negCountData.push(0)
                      }
                    }
                    negCountData[d.WeekNumber - 1]++

                    break;
                  default:
                    null;
                }
              })

              individualLineChart.updateSeries([{
                name: 'Neutral',
                data: neutralCountData
              }, {
                name: 'Positive',
                data: posCountData
              }, {
                name: 'Negative',
                data: negCountData
              }])

              individualLineChart.updateOptions({
                title: {
                  text: `${months[d.getMonth()]} Weekly Sentiment Report`
                }
              })

              $("#lineMonthFilter").val("");
              $("#lineFilterBy").val("");

              $("#lineDivMonth").hide();
              $("#btnLineClear").hide()

            })
        }

      }

    } catch (err) {}
  </script>
</body>

</html>