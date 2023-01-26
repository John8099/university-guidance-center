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
            <a href="<?= site_url() . 'superadmin/set_schedule_appointment'; ?>" type="button" class="d-none btn btn-outline-success btn-sm" title="Create Appointment">Create Appointment</a>
            <a href="<?= site_url() . 'superadmin/schedule'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Schedule">Create Schedule</a>
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
            $query = $this->db->query("SELECT ta.AppointmentID, ta.StudentName, tc.College, ta.YearSection, ta.SelectedDate, ta.PreferredTime, ta.Platform, ta.Status, ta.Remarks FROM tblappointment ta INNER JOIN tblcollege tc ON tc.CollegeID=ta.CollegeID WHERE ta.Status<>'Completed' ORDER BY FIELD(ta.Status, 'Pending') DESC;");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td><a href="<?= site_url() . 'superadmin/view_appointment/' . $row->AppointmentID; ?>"><?= $row->StudentName; ?></a></td>
                <td><?= $row->College; ?></td>
                <td><?= $row->YearSection; ?></td>
                <td><?= $row->SelectedDate; ?></td>
                <td><?= $row->PreferredTime; ?></td>
                <td><?= $row->Platform; ?></td>
                <td><?= $row->Status; ?></td>
                <td><a href="<?= site_url() . 'superadmin/view_appointment/' . $row->AppointmentID; ?>" class="btn btn-outline-info btn-sm" title="View Appointment">Change Status</a></td>
                <td><?php #if ($row->Status == 'Completed') : 
                    ?>
                  <!-- <a href="<?= site_url() . 'superadmin/view_appointment/' . $row->AppointmentID; ?>" class="btn btn-outline-info btn-sm" title="View Appointment">Add Remarks</a> -->
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