<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Wellness Check List</h4>
          </div>
        </div>
      </div>
      <div class="table-responsive">

        <table id="example" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Type</th>
              <th scope="col">Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Created</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT * FROM tblwellnesscheck WHERE Status='Enable';");

            $IsWellnessTaken = false;
            foreach ($query->result() as $row) :
              $wellnessCheckId = $row->WellnessCheckID;
              $studentUserId = $this->session->userdata('StudentUserID');
              $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='$wellnessCheckId' and CreatedBy='$studentUserId'");
              if ($tblresult->num_rows() <> 0) {
                $IsWellnessTaken = true;
              }
            ?>
              <tr>
                <td><a <?= ($IsWellnessTaken) ? '' : 'href="' . site_url("student/wellness_check/" . $row->WellnessCheckID) . '"' ?>><?= $row->Title; ?></a></td>
                <td><?= $row->WellnessType; ?></td>
                <td><?= date('Y-m-d', strtotime($row->CreatedOn)); ?></td>
                <td><?= $row->EndDate; ?></td>
                <td><?= $this->routines->getUserFullName($row->CreatedBy); ?></td>
              </tr>
            <?php
              $IsWellnessTaken = false;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php

if ($this->session->flashdata('isPublish') == 'true') {
  echo $this->routines->callSweetAlertYesNo("Data was successfully saved", "Do you want to publish this on email?", "info", "Quit", "Publish", site_url() . 'superadmin/question_publish');
}
if ($this->session->flashdata('isPublish') == 'false') {
  echo $this->routines->callSweetAlert("Data was successfully saved");
}
if ($this->session->flashdata('isUpdateStatus') == 'true') {
  echo $this->routines->callSweetAlert("Wellness Check Status Updated");
}
?>