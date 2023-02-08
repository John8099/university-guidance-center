<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Manage Appointments</h4>
          </div>
          <div class="ms-auto">
            <a href="<?= site_url() . 'administrator/set_schedule_appointment'; ?>" type="button" class="d-none btn btn-outline-success btn-sm" title="Create Appointment">Create Appointment</a>
            <a href="<?= site_url() . 'administrator/schedule'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Schedule">Create Schedule</a>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive">

        <table id="datatable" class="table table-striped">
          <thead>
            <tr>
              <th width="150">Student Name</th>
              <th width="100">College</th>
              <th width="170">Course Year and Section</th>
              <th width="150">Date</th>
              <th width="150">Time</th>
              <th width="150">Platform</th>
              <th width="150">Status</th>
              <th width="150">Action</th>
              <th width="350">Remarks</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $adminId = $this->session->userdata("UserID");
            $adminCollegeID = $this->session->userdata('CollegeID');
            $query = $this->db->query("SELECT
                                      apnt.AppointmentID AS appointmentID,
                                      apnt.CreatedBy AS studentID,
                                      aschd.AppointmentDate AS appointmentDate,
                                      aschd.AppointmentTime AS appointmentTime,
                                      apnt.Status AS appointmentStatus,
                                      apnt.Platform AS Platform,
                                      apnt.Remarks AS Remarks,
                                      apnt.YearSection AS YearSection,
                                      aschd.CreatedBy AS adminID,
                                      apnt.Status AS studentAppointmentStatus
                                      FROM tblappointmentsched aschd
                                      LEFT JOIN tblappointment apnt
                                      ON 
                                      aschd.AppointmentSchedID = apnt.AppointmentSchedID
                                      LEFT JOIN tbluser u
                                      ON u.UserID = aschd.CreatedBy
                                      WHERE 
                                      apnt.Status<>'Completed' and apnt.CollegeID='$adminCollegeID' and aschd.CreatedBy='$adminId'
                                      ORDER BY FIELD(apnt.Status, 'Pending') DESC
                                      ");
            // $query = $this->db->query("SELECT ta.AppointmentID, ta.StudentName, tc.College, ta.YearSection, ta.SelectedDate, ta.PreferredTime, ta.Platform, ta.Status, ta.Remarks FROM tblappointment ta INNER JOIN tblcollege tc ON tc.CollegeID=ta.CollegeID WHERE ta.Status<>'Completed' ORDER BY FIELD(ta.Status, 'Pending') DESC;");

            foreach ($query->result() as $row) :
              $studentData = $this->routines->getUserData($row->studentID);
            ?>
              <tr>
                <td>
                  <a href="<?= site_url() . 'administrator/view_appointment/' . $row->appointmentID; ?>">
                    <?= $this->routines->getUserFullName($row->studentID) ?>
                  </a>
                </td>
                <td><?= $this->routines->getCollege($studentData->CollegeID); ?></td>
                <td><?= "$studentData->Course $studentData->YearSec" ?></td>
                <td><?= $row->appointmentDate ?></td>
                <td><?= $row->appointmentTime ?></td>
                <td><?= $row->Platform ?></td>
                <td><?= $row->appointmentStatus ?></td>
                <td>
                  <a href="<?= site_url() . 'administrator/view_appointment/' . $row->appointmentID; ?>" class="btn btn-outline-info btn-sm" title="View Appointment">
                    Change Status
                  </a>
                </td>
                <td>
                  <?php #if ($row->Status == 'Completed') : 
                  ?>
                  <!-- <a href="<?= site_url() . 'administrator/view_appointment/' . $row->appointmentID; ?>" class="btn btn-outline-info btn-sm" title="View Appointment">Add Remarks</a> -->
                  <?php #endif; 
                  ?>
                  <?= $row->Remarks ? substr($row->Remarks, 0, 70) . "..." : "" ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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