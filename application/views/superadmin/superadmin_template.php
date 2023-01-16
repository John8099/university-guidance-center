<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual-and-Remote-Guidance-Counselling-System | <?=$heading;?></title>
    <!-- Calendar CSS -->
    <link href="<?=base_url().'media/'?>fullcalendar/lib/main.css" rel="stylesheet">
    <script src='https://github.com/mozilla-comm/ical.js/releases/download/v1.4.0/ical.js'></script>
    <script src='<?=base_url().'media/'?>fullcalendar/lib/main.js'></script>
    <script src='<?=base_url().'media/'?>fullcalendar/packages/icalendar/main.global.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var data = [];
<?php
$query = $this->db->query("SELECT * FROM tblappointmentsched WHERE Status='Active';");
$Appointment='';
foreach ($query->result() as $row) :
    $Fullname = '';
    $User=$this->db->query("SELECT * FROM tbluser WHERE UserID = '".$row->CreatedBy."';")->row();
    if(isset($User->UserID)) {
        $Fullname = $User->Fullname;
    }
    $Appointment=$row->AppointmentTime.'<br>'.$Fullname;
?>
    appointment='<?=$Appointment;?>';
    data.push(
    {
      title: appointment,
      url: '<?=site_url().'superadmin/set_schedule_date/'.$row->AppointmentSchedID;?>',
      start: '<?=$row->AppointmentDate;?>'
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
  });
</script>
    <!-- Custom CSS -->
    <link href="<?=base_url().'media/'?>assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="<?=base_url().'media/'?>dist/css/style.min.css" rel="stylesheet">
    <link href="<?=base_url().'media/'?>global.css" rel="stylesheet">
    <script src="<?=base_url().'media/'?>assets/libs/sweetalert/sweetalert.min.js"></script>
    <style type="text/css">

/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
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
.select-items div,.select-selected {
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

.select-items div:hover, .same-as-selected {
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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="<?=site_url().'admin'?>">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                        <img src="<?=base_url().'media/'?>assets/images/logo-1.png" alt="homepage" style="margin-top:-50px;margin-bottom:-50px" />
                        </b>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
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
                        <li class="nav-item search-box d-none"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="dropdown-item text-danger" href="<?=site_url().'superadmin/logout'?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
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
                                <div class="user-pic"><img src="<?=base_url('uploads/').$this->session->userdata('ImageLoc');?>" alt="users"
                                        class="rounded-circle" width="200" /></div>
                                <div class="user-content hide-menu m-l-10 text-center">
                                    <a href="#" class="" id="Userdd" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h6 class="m-b-0 m-t-20 user-name font-small">University Guidance Counsellor <i
                                                class="fa fa-angle-down"></i></h6>
                                        <span class="op-5 user-email">Superadmin</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">
<a class="dropdown-item" href="<?=site_url().'superadmin/admin_lists';?>"><i class="ti-user m-r-5 m-l-5"></i> Admin List</a>
<a class="dropdown-item" href="<?=site_url().'superadmin/change_password';?>"><i class="ti-user m-r-5 m-l-5"></i> Change Password</a>
<a class="dropdown-item" href="<?=site_url().'superadmin/change_profile_picture';?>"><i class="ti-user m-r-5 m-l-5"></i> Change Profile Picture</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <!-- User Profile-->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/';?>" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Student Inventory</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/dashboard';?>" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item d-none">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/assessments';?>" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Create assessment</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/wellness_checks';?>" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Wellness Check</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/colleges';?>" aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">College</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/appointments';?>" aria-expanded="false"><i class="mdi mdi-calendar-multiple-check"></i><span class="hide-menu">Appointment list</span>
                            </a>
                        </li>

                        <li class="sidebar-item d-none">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/appointment_reports';?>" aria-expanded="false"><i class="mdi mdi-chart-histogram"></i><span class="hide-menu">Monthly Reports</span>
                            </a>
                        </li>

                        <li class="sidebar-item d-none">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=site_url().'superadmin/assessment_reports';?>" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span class="hide-menu">Assessment Reports</span>
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
                        <h4 class="page-title"><i class="mdi mdi-view-dashboard"></i> <?=$sub_heading;?></h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=site_url();?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?=$sub_heading;?></li>
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
                <?php if(isset($content)) : ?>
                    <?php if($content=='student_inventory') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='dashboard') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='wellness_question_list') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='colleges') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='appointments') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='college') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='view_appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='appointment_reports') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='assessments') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='assessment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='question') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='schedule') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='students') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='completed_appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='admin_lists') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='admin_list') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='pending_appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='assessment_reports') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='question_banks') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='question_bank') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='student_view') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='wellness_checks') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='wellness_check') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='wellness_question') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='set_schedule_appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='schedule_appointment') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='wellness_question_update') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='change_password') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>

                    <?php elseif($content=='change_profile_picture') : ?>
                        <?php $this->load->view('superadmin/'.$content); ?>
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
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?=base_url().'media/'?>assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?=base_url().'media/'?>assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="<?=base_url().'media/'?>dist/js/pages/dashboards/dashboard1.js"></script>
    <script src="<?=base_url().'media/'?>dist/js/chart.js"></script>

    <script src="<?=base_url().'media/'?>datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url().'media/'?>datatables/dataTables.buttons.min.js"></script>
    <script src="<?=base_url().'media/'?>datatables/buttons.print.min.js"></script>
    <script src="<?=base_url().'media/'?>datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url().'media/'?>datatables/dataTables.responsive.min.js"></script>
    <script src="<?=base_url().'media/'?>datatables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('.fc-event-title.fc-sticky').each(function(data){
            $(this).html($(this).text());
        });
            $('#datatable').DataTable({
                scrollX: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        customize: function (win) {
                            $(win.document.body).find('h1').css('font-size', '12pt');
                        }
                    }
                ],
                "paging":   false,
            });
        } );
        $('#SelectCollegeAppointmentReports').change(function() {
            window.location = '<?=site_url().'superadmin/appointment_reports/';?>'+$('#SelectCollegeAppointmentReports').val();
        });
    </script>

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

    <?php if($this->session->flashdata('Success') != '') : ?>
        <script>
        successful();
        </script>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('Failed') != '') : ?>
        <script>
        failed();
        </script>
    <?php endif; ?>

<?php

// if($this->uri->segment(3)>0) {
//    $CollegeID=$this->uri->segment(3);
//    $January=0;
//    $January=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=01 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $February=0;
//    $February=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=02 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $March=0;
//    $March=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=03 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $April=0;
//    $April=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=04 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $May=0;
//    $May=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=05 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $June=0;
//    $June=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=06 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $July=0;
//    $July=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=07 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $August=0;
//    $August=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=08 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $September=0;
//    $September=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=09 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $October=0;
//    $October=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=10 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $Novermber=0;
//    $Novermber=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=11 AND CollegeID='".$CollegeID."';")->row()->Total;
//    $December=0;
//    $December=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=12 AND CollegeID='".$CollegeID."';")->row()->Total;
// } else {
// $January=0;
// $January=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=01;")->row()->Total;
// $February=0;
// $February=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=02;")->row()->Total;
// $March=0;
// $March=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=03;")->row()->Total;
// $April=0;
// $April=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=04;")->row()->Total;
// $May=0;
// $May=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=05;")->row()->Total;
// $June=0;
// $June=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=06;")->row()->Total;
// $July=0;
// $July=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=07;")->row()->Total;
// $August=0;
// $August=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=08;")->row()->Total;
// $September=0;
// $September=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=09;")->row()->Total;
// $October=0;
// $October=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=10;")->row()->Total;
// $Novermber=0;
// $Novermber=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=11;")->row()->Total;
// $December=0;
// $December=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=12;")->row()->Total;
// }
?>
<?php
// $JanuaryNEG=0;
// $JanuaryNEU=0;
// $JanuaryPOS=0;
// $JanuaryNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JanuaryNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JanuaryPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $FebruaryNEG=0;
// $FebruaryNEU=0;
// $FebruaryPOS=0;
// $FebruaryNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $FebruaryNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $FebruaryPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MarchNEG=0;
// $MarchNEU=0;
// $MarchPOS=0;
// $MarchNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MarchNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MarchPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AprilNEG=0;
// $AprilNEU=0;
// $AprilPOS=0;
// $AprilNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AprilNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AprilPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MayNEG=0;
// $MayNEU=0;
// $MayPOS=0;
// $MayNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MayNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $MayPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JuneNEG=0;
// $JuneNEU=0;
// $JunePOS=0;
// $JuneNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JuneNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JunePOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JulyNEG=0;
// $JulyNEU=0;
// $JulyPOS=0;
// $JulyNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JulyNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $JulyPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AugustNEG=0;
// $AugustNEU=0;
// $AugustPOS=0;
// $AugustNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AugustNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $AugustPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $SeptemberNEG=0;
// $SeptemberNEU=0;
// $SeptemberPOS=0;
// $SeptemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $SeptemberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $SeptemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $OctoberNEG=0;
// $OctoberNEU=0;
// $OctoberPOS=0;
// $OctoberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $OctoberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $OctoberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $NovermberNEG=0;
// $NovermberNEU=0;
// $NovermberPOS=0;
// $NovermberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $NovermberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $NovermberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $DecemberNEG=0;
// $DecemberNEU=0;
// $DecemberPOS=0;
// $DecemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Negative!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $DecemberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Neutral!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;
// $DecemberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Positive!=0 AND tbluser.CollegeID = '".$this->session->userdata('CollegeID')."';")->row()->Total;


// $JanuaryResultNEG=0;
// $JanuaryResultNEU=0;
// $JanuaryResultPOS=0;
// $JanuaryResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $JanuaryResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $JanuaryResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $FebruaryResultNEG=0;
// $FebruaryResultNEU=0;
// $FebruaryResultPOS=0;
// $FebruaryResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $FebruaryResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $FebruaryResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $MarchResultNEG=0;
// $MarchResultNEU=0;
// $MarchResultPOS=0;
// $MarchResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $MarchResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $MarchResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $AprilResultNEG=0;
// $AprilResultNEU=0;
// $AprilResultPOS=0;
// $AprilResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $AprilResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $AprilResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $MayResultNEG=0;
// $MayResultNEU=0;
// $MayResultPOS=0;
// $MayResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $MayResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $MayResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $JuneResultNEG=0;
// $JuneResultNEU=0;
// $JuneResultPOS=0;
// $JuneResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $JuneResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $JuneResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $JulyResultNEG=0;
// $JulyResultNEU=0;
// $JulyResultPOS=0;
// $JulyResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $JulyResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $JulyResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $AugustResultNEG=0;
// $AugustResultNEU=0;
// $AugustResultPOS=0;
// $AugustResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $AugustResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $AugustResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $SeptemberResultNEG=0;
// $SeptemberResultNEU=0;
// $SeptemberResultPOS=0;
// $SeptemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $SeptemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $SeptemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $OctoberResultNEG=0;
// $OctoberResultNEU=0;
// $OctoberResultPOS=0;
// $OctoberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $OctoberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $OctoberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $NovemberResultNEG=0;
// $NovemberResultNEU=0;
// $NovemberResultPOS=0;
// $NovemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $NovemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $NovemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $DecemberResultNEG=0;
// $DecemberResultNEU=0;
// $DecemberResultPOS=0;
// $DecemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Negative';")->row()->Total;
// $DecemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Neutral';")->row()->Total;
// $DecemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Positive';")->row()->Total;

// $SumNeg=0;
// $SumNeu=0;
// $SumPos=0;


// $SumNeg=$JanuaryResultNEG+$FebruaryResultNEG+$MarchResultNEG+$AprilResultNEG+$MayResultNEG+$JuneResultNEG+$JulyResultNEG+$AugustResultNEG+$SeptemberResultNEG+$OctoberResultNEG+$NovemberResultNEG+$DecemberResultNEG;
// $SumNeu=$JanuaryResultNEU+$FebruaryResultNEU+$MarchResultNEU+$AprilResultNEU+$MayResultNEU+$JuneResultNEU+$JulyResultNEU+$AugustResultNEU+$SeptemberResultNEU+$OctoberResultNEU+$NovemberResultNEU+$DecemberResultNEU;
// $SumPos=$JanuaryResultPOS+$FebruaryResultPOS+$MarchResultPOS+$AprilResultPOS+$MayResultPOS+$JuneResultPOS+$JulyResultPOS+$AugustResultPOS+$SeptemberResultPOS+$OctoberResultPOS+$NovemberResultPOS+$DecemberResultPOS;
?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Pie chart
      new Chart(document.getElementById("chartjs-pie"), {
        type: "pie",
        data: {
          labels: ["Negative", "ResultNeutral", "Positive"],
          datasets: [{
            data: [<?=$SumNeg?>,<?=$SumNeu?>,<?=$SumPos?>],
            backgroundColor: [
              window.theme.danger,
              '#fb8c00',
              window.theme.success,

            ],
            borderColor: "transparent"
          }]
        },
        options: {
          maintainAspectRatio: true,
          legend: {
            display: true
          }
        }
      });
    });
  </script>
   <script>
        January='<?=$January;?>';
        February='<?=$February;?>';
        March='<?=$March;?>';
        April='<?=$April;?>';
        May='<?=$May;?>';
        June='<?=$June;?>';
        July='<?=$July;?>';
        August='<?=$August;?>';
        September='<?=$September;?>';
        October='<?=$October;?>';
        Novermber='<?=$Novermber;?>';
        December='<?=$December;?>';
      document.addEventListener("DOMContentLoaded", function () {
         // Bar Chart
         var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novermber", "December"],
            datasets: [{
                  label: 'Monthly Appointments',
               backgroundColor: 'rgb(79,129,189)',
               borderColor: 'rgba(0, 158, 251, 1)',
               borderWidth: 1,
               data: [January, February, March, April, May, June, July, August, September, October, Novermber,December]
            }]
         };

         var ctx = document.getElementById('bargraph').getContext('2d');
         window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
               responsive: true,
               legend: {
                  display: false,
               }
            }
         });

      });
   </script>
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
<script type="text/javascript">
    let inumber=1;
    let qnumber=1;
    $(document).ready(function() {
        $('#btn_add_question').click(function(){
            question_input=`<div id="qinputremoveq`+inumber+`" class="row"><div class="col-lg-11 col-xlg-11 col-md-11">
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
                                        <button type="button" class="btn btn-success w-100 btn_add_question" id="removeq`+inumber+`">Remove</button>
                                    </div>
                                </div>
                            </div></div>`;
            $('#QuantitativeQuestions').append(question_input);
            inumber++;
        });

        $('#QuantitativeQuestions').on('click','.btn_add_question',function(){
            var button_id = $(this).attr('id');
            $('#qinput'+button_id+'').remove();
            inumber--;
        });

    $('#btn_add_category').click(function(){
        category_input=`
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
</script>
</body>

</html>