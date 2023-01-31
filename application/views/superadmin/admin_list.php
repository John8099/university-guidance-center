<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php

$SchoolID = $this->routines->generateAdminID();
$UserID = $this->uri->segment(3);
$result = $this->db->query("SELECT * FROM tbluser WHERE UserID = '$UserID'");

$fname = $this->session->flashdata('first_name');
$mname = $this->session->flashdata('middle_name');
$lname = $this->session->flashdata('last_name');
$CollegeID = $this->session->flashdata('CollegeID');
$Email = $this->session->flashdata('Email');
$Gender = $this->session->flashdata('Gender');
$SchoolID = $this->session->flashdata('SchoolID');

foreach ($result->result() as $row) {
  $fname = $row->first_name;
  $mname = $row->middle_name;
  $lname = $row->last_name;
  $CollegeID = $row->CollegeID;
  $Email = $row->Email;
  $Gender = $row->Gender;
  $SchoolID = $row->SchoolID;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
            <?= $this->session->flashdata('admin_list_save'); ?>
          </div>
        </div>
        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
          </svg>
          <div>
            <?= $this->session->flashdata('invalid'); ?>
          </div>
        </div>
        <form method="post" action="<?= site_url() . 'superadmin/admin_list_save/' . $UserID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <input type="hidden" name="txtRegisterType" value="Superadmin" />
          <div class="form-group">
            <label for="txtSchoolID" class="col-md-12">Admin ID</label>
            <div class="col-md-12">
              <input type="text" placeholder="Admin ID" class="form-control form-control-line" required="required" name="txtSchoolID" id="txtSchoolID" value="<?= $SchoolID; ?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">First Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="First Name" class="form-control form-control-line" required="required" name="txtFname" id="txtFname" value="<?= $fname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">Middle Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="Middle Name" class="form-control form-control-line" required="required" name="txtMname" id="txtMname" value="<?= $mname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">Last Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="Last Name" class="form-control form-control-line" required="required" name="txtLname" id="txtLname" value="<?= $lname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtCollege" class="col-md-12">College</label>
            <div class="col-md-12">
              <select class="form-select form-control-line" name="txtCollege" required="required">
                <option value="" selected hidden>Select College</option>
                <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                foreach ($query->result() as $row) : ?>
                  <option value="<?= $row->CollegeID; ?>" <?= ($CollegeID == $row->CollegeID) ? 'selected' : ''; ?>><?= $row->College; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="txtEmail" class="col-md-12">School Email</label>
            <div class="col-md-12">
              <input type="text" placeholder="Email" class="form-control form-control-line" required="required" name="txtEmail" id="txtEmail" value="<?= $Email; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtIdentifiedGender" class="col-md-12"> Gender</label>
            <div class="col-md-12">
              <select name="txtGender" class="form-select form-control-line">
                <option value="" selected disabled>Select Gender</option>
                <?php
                $genders = array(
                  "Male",
                  "Female",
                  "Gay",
                  "Lesbian",
                  "Bisexual",
                  "Prefer not to say"
                );
                foreach ($genders as $genderList) :
                ?>
                  <option value="<?= $genderList ?>" <?= $Gender == $genderList ? "selected" : "" ?>><?= $genderList ?></option>
                <?php endforeach; ?>

              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Save</button>
          <a href="<?= site_url() . 'superadmin/admin_lists'; ?>" class="btn btn-danger">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function successful() {
    // $('#alertsuccess').removeClass('d-none');
    //  setTimeout(function(){
    //     $('#alertsuccess').addClass('d-none');
    //  }, 5000);
    document.querySelector('#alertsuccess').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertsuccess').classList.add('d-none');
    }, 5000);
  }

  function failed() {
    // $('#alertsuccess').removeClass('d-none');
    //  setTimeout(function(){
    //     $('#alertsuccess').addClass('d-none');
    //  }, 5000);
    document.querySelector('#alertdanger').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertdanger').classList.add('d-none');
    }, 5000);
  }
</script>

<?php if ($this->session->flashdata('admin_list_save') != '') : ?>
  <script>
    successful();
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('invalid') != '') : ?>
  <script>
    failed();
  </script>
<?php endif; ?>