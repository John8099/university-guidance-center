<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">List of Students</h4>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table id="datatable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">School ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Middle Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">College</th>
              <th scope="col">Course Year and Section</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $collegeID = $this->session->userdata('CollegeID');
            $query = $this->db->query("SELECT * FROM tbluser WHERE UserType='Student' AND CollegeID='$collegeID'");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td>
                  <a href="<?= site_url() . 'superadmin/student_view/' . $row->UserID; ?>">
                    <?= $row->SchoolID ?>
                  </a>
                </td>
                <td><?= $row->first_name ?></td>
                <td><?= $row->middle_name ?></td>
                <td><?= $row->last_name ?></td>
                <td><?= $this->routines->getCollege($row->CollegeID); ?></td>
                <td><?= $row->Course; ?> <?= $row->YearSec; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>