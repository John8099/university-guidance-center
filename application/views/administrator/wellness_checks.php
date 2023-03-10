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
            <h4 class="card-title">Wellness Check Assessment List</h4>
          </div>
          <div class="ms-auto">
            <a href="<?= site_url() . 'administrator/wellness_check'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Wellness Check" style="width: 100px;">Create</a>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive">

        <table id="datatable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Type</th>
              <th scope="col">Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Created</th>
              <th scope="col">Status</th>
              <th style="width: 10%;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT * FROM tblwellnesscheck;");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td><?= $row->Title; ?></td>
                <td><?= $row->WellnessType; ?></td>
                <td><?= date('Y-m-d', strtotime($row->CreatedOn)); ?></td>
                <td><?= $row->EndDate; ?></td>
                <td><?= $this->routines->getUserFullName($row->CreatedBy); ?></td>
                <td><?= $row->Status; ?></td>
                <td>
                  <?php if ($row->Status == 'Disable') : ?>
                    <a href="<?= site_url() . 'administrator/wellness_check_status/' . $row->WellnessCheckID . '/Enable'; ?>" class="btn btn-outline-warning btn-sm" title="Set Enable" style="width: 100px; margin: .25rem">Set Enable</a>
                  <?php else : ?>
                    <a href="<?= site_url() . 'administrator/wellness_check_status/' . $row->WellnessCheckID . '/Disable'; ?>" class="btn btn-outline-warning btn-sm" title="Set Disable" style="width: 100px; margin: .25rem">Set Disable</a>
                  <?php endif; ?>
                  <?php if ($row->Status == 'Disable') : ?>
                    <a href="<?= site_url() . 'administrator/wellness_check/' . $row->WellnessCheckID; ?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px; margin: .25rem">Edit</a>
                    <a href="<?= site_url() . 'administrator/wellness_checks_delete/' . $row->WellnessCheckID; ?>" class="btn btn-outline-danger btn-sm" title="Delete" style="width: 100px; margin: .25rem">Delete</a>
                  <?php else : ?>
                    <button class="btn btn-outline-primary btn-sm" style="width: 100px; margin: .25rem" disabled>Edit</button>
                    <button class="btn btn-outline-danger btn-sm" style="width: 100px; margin: .25rem" disabled>Delete</button>
                  <?php endif; ?>
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

if ($this->session->flashdata('isPublish') == 'true') {
  echo $this->routines->callSweetAlertYesNo("Data was successfully saved", "Do you want to publish this on email?", "info", "Quit", "Publish", site_url() . 'administrator/question_publish');
}
if ($this->session->flashdata('isPublish') == 'false') {
  echo $this->routines->callSweetAlert("Data was successfully saved");
}
if ($this->session->flashdata('isUpdateStatus') == 'true') {
  echo $this->routines->callSweetAlert("Wellness Check Status Updated");
}
?>