<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Referrer = '';
$StudentName = '';
$Email = $this->session->userdata('Email');
$YearSection = '';
$CourseID = '';
$Address = '';
$PhoneNumber = '';
$OtherContact = '';
$Platform = '';
$PreferredTime = '';
$SelectedDate = '';
$Category = '';
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '" . $AppointmentID . "'");
foreach ($query->result() as $row) {
  $Referrer = $row->Referrer;
  $StudentName = $row->StudentName;
  $Email = $row->Email;
  $YearSection = $row->YearSection;
  $CourseID = $row->CourseID;
  $Address = $row->Address;
  $PhoneNumber = $row->PhoneNumber;
  $OtherContact = $row->OtherContact;
  $Platform = $row->Platform;
  $PreferredTime = $row->PreferredTime;
  $SelectedDate = $row->SelectedDate;
  $Category = $row->Category;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="fullcalendar">

          <div id='calendar'></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if ($this->session->flashdata('AppointmentSuccess') == 'true') {
  echo $this->routines->callSweetAlert("Appointment data successfully saved.");
}
if ($this->session->flashdata('AppointmentSuccess') == 'false') {
  echo $this->routines->callSweetAlert("Appointment email data was invalid, please try again.");
}
?>