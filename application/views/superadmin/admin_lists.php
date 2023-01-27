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
          <!-- <div class="ms-auto">
            <a target="_blank" href="<?= site_url() . 'superadmin/admin_register'; ?>" title="<?= site_url() . 'superadmin/admin_register'; ?>"><?= site_url() . 'superadmin/admin_register'; ?></a>
          </div> -->
          <div class="ms-auto">
            <a href="<?= site_url() . 'superadmin/admin_list'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Admin">Create Admin</a>
          </div>
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
              <th scope="col">Identified Gender</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT UserID,College,Email,IdentifiedGender,SchoolID FROM tbluser INNER JOIN tblcollege ON tblcollege.CollegeID=tbluser.CollegeID WHERE tbluser.UserType = 'Administrator';");

            foreach ($query->result() as $row) : ?>
              <tr>
                <td><?= $row->SchoolID; ?></td>
                <td><?= $this->routines->getUserFullName($row->UserID); ?></td>
                <td><?= $row->College; ?></td>
                <td><?= $row->Email; ?></td>
                <td><?= ($row->IdentifiedGender == 1) ? 'Male' : 'Female'; ?></td>
                <td>
                  <a href="<?= site_url() . 'superadmin/admin_list/' . $row->UserID; ?>" class="btn btn-outline-primary btn-sm" title="View Details">View Details</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>