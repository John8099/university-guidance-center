<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <h4 class="card-title">Admin List</h4>
        </div>
      </div>
      <div class="table-responsive">

        <table id="datatable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Admin ID</th>
              <th scope="col">Full Name</th>
              <th scope="col">College</th>
              <th scope="col">Email</th>
              <th scope="col"> Gender</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT UserID,College,Email,Gender,SchoolID FROM tbluser INNER JOIN tblcollege ON tblcollege.CollegeID=tbluser.CollegeID WHERE tbluser.UserType = 'Administrator';");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td><?= $row->SchoolID; ?></td>
                <td><?= $this->routines->getUserFullName($row->UserID); ?></td>
                <td><?= $row->College; ?></td>
                <td><?= $row->Email; ?></td>
                <td><?= $row->Gender ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>