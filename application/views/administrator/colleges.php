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
            <h4 class="card-title">College List</h4>
          </div>
          <div class="ms-auto">
            <a href="<?= site_url() . 'administrator/college'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create College">Create</a>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive">

        <table id="datatable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">College</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td><?= $row->College; ?></td>
                <td><a href="<?= site_url() . 'administrator/college/' . $row->CollegeID; ?>" class="btn btn-outline-warning btn-sm" title="Update College">Update</a> <a href="<?= site_url() . 'administrator/college_delete/' . $row->CollegeID; ?>" type="button" class="btn btn-outline-primary btn-sm" title="Delete College">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>