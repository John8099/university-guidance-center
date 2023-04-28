<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php

if ($this->uri->segment(3) > 0) {
  $CollegeID = $this->uri->segment(3);
  $January = 0;
  $January = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=01 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $February = 0;
  $February = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=02 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $March = 0;
  $March = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=03 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $April = 0;
  $April = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=04 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $May = 0;
  $May = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=05 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $June = 0;
  $June = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=06 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $July = 0;
  $July = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=07 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $August = 0;
  $August = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=08 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $September = 0;
  $September = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=09 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $October = 0;
  $October = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=10 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $Novermber = 0;
  $Novermber = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=11 AND CollegeID='" . $CollegeID . "';")->row()->Total;
  $December = 0;
  $December = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=12 AND CollegeID='" . $CollegeID . "';")->row()->Total;
} else {
  $January = 0;
  $January = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=01;")->row()->Total;
  $February = 0;
  $February = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=02;")->row()->Total;
  $March = 0;
  $March = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=03;")->row()->Total;
  $April = 0;
  $April = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=04;")->row()->Total;
  $May = 0;
  $May = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=05;")->row()->Total;
  $June = 0;
  $June = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=06;")->row()->Total;
  $July = 0;
  $July = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=07;")->row()->Total;
  $August = 0;
  $August = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=08;")->row()->Total;
  $September = 0;
  $September = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=09;")->row()->Total;
  $October = 0;
  $October = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=10;")->row()->Total;
  $Novermber = 0;
  $Novermber = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=11;")->row()->Total;
  $December = 0;
  $December = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE MONTH(SelectedDate)=12;")->row()->Total;
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
          <a class="btn btn-sm elevation-2" href="#" data-toggle="modal" data-target="#add" style="margin-top: 20px;margin-left: 10px;background-color: rgba(131,219,214);"><i class="fa fa-file-excel"></i> export</a>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                  <select class="form-select shadow-none" id="SelectCollegeAppointmentReports">
                    <option value="" selected hidden>Select College</option>
                    <option value="0">All College</option>
                    <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                    foreach ($query->result() as $row) : ?>
                      <option value="<?= $row->CollegeID; ?>"><?= $row->College; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <br>
              <?php if ($this->uri->segment(3) > 0) :
                $CollegeName = $this->db->query("SELECT College FROM tblcollege WHERE CollegeID='" . $this->uri->segment(3) . "';")->row()->College;
              ?>
                <h1><?= $CollegeName; ?></h1>
              <?php else : ?>
                <h1>All College</h1>
              <?php endif; ?>
              <table class="table table-bordered mytable">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Number of Appointments</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>January</td>
                    <td><?= $January; ?></td>
                  </tr>
                  <tr>
                    <td>February</td>
                    <td><?= $February; ?></td>
                  </tr>
                  <tr>
                    <td>March</td>
                    <td><?= $March; ?></td>
                  </tr>
                  <tr>
                    <td>April</td>
                    <td><?= $April; ?></td>
                  </tr>
                  <tr>
                    <td>May</td>
                    <td><?= $May; ?></td>
                  </tr>
                  <tr>
                    <td>June</td>
                    <td><?= $June; ?></td>
                  </tr>
                  <tr>
                    <td>July</td>
                    <td><?= $July; ?></td>
                  </tr>
                  <tr>
                    <td>August</td>
                    <td><?= $August; ?></td>
                  </tr>
                  <tr>
                    <td>September</td>
                    <td><?= $September; ?></td>
                  </tr>
                  <tr>
                    <td>October</td>
                    <td><?= $October; ?></td>
                  </tr>
                  <tr>
                    <td>November</td>
                    <td><?= $Novermber; ?></td>
                  </tr>
                  <tr>
                    <td>December</td>
                    <td><?= $December; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-8 col-xl-8">
          <div class="card">
            <div class="card-body">
              <canvas id="bargraph" height="250"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>