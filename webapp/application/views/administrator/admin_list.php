<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Fullname = $this->session->flashdata('Fullname');
$CollegeID = $this->session->flashdata('CollegeID');
$Email = $this->session->flashdata('Email');
$IdentifiedGender = $this->session->flashdata('IdentifiedGender');
$SchoolID = $this->routines->generateAdminID();
$UserID = $this->uri->segment(3);
$result = $this->db->query("SELECT * FROM tbluser WHERE UserID = '" . $UserID . "'");

$fname = "";
$mname = "";
$lname = "";

foreach ($result->result() as $row) {
  $fname = $row->first_name;
  $mname = $row->middle_name;
  $lname = $row->last_name;
  $CollegeID = $row->CollegeID;
  $Email = $row->Email;
  $IdentifiedGender = $row->IdentifiedGender;
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
        <form method="post" action="<?= site_url() . 'administrator/admin_list_save/' . $UserID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <input type="hidden" name="txtRegisterType" value="Administrator" />
          <div class="form-group">
            <label for="txtSchoolID" class="col-md-12">Admin ID</label>
            <div class="col-md-12">
              <input type="text" placeholder="Admin ID" class="form-control form-control-line" required="required" name="txtSchoolID" id="txtSchoolID" value="<?= $SchoolID; ?>" readonly />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">First Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="First Name" class="form-control form-control-line" required="required" name="txtFname" id="txtFullname" value="<?= $fname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">Middle Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="Middle Name" class="form-control form-control-line" required="required" name="txtMname" id="txtFullname" value="<?= $mname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtFullname" class="col-md-12">Last Name</label>
            <div class="col-md-12">
              <input type="text" placeholder="Last Name" class="form-control form-control-line" required="required" name="txtLname" id="txtFullname" value="<?= $lname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtCollege" class="col-md-12">College</label>
            <div class="col-md-12">
              <div class="custom-select">
                <select class="form-control form-control-line" name="txtCollege" required="required">
                  <option value="" selected hidden>Select College</option>
                  <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                  foreach ($query->result() as $row) : ?>
                    <option value="<?= $row->CollegeID; ?>" <?= ($CollegeID == $row->CollegeID) ? 'selected' : ''; ?>><?= $row->College; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="txtEmail" class="col-md-12">School Email</label>
            <div class="col-md-12">
              <input type="text" placeholder="Email" class="form-control form-control-line" required="required" name="txtEmail" id="txtEmail" value="<?= $Email; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label for="txtIdentifiedGender" class="col-md-12">Identified Gender</label>
            <div class="col-md-12">
              <div class="custom-select">
                <select class="form-control form-control-line" name="txtIdentifiedGender" required="required">
                  <option value="" selected hidden>Select Identified Gender</option>
                  <option value="0" <?= ($IdentifiedGender == 0) ? 'selected' : ''; ?>>Female</option>
                  <option value="1" <?= ($IdentifiedGender == 1) ? 'selected' : ''; ?>>Male</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Save</button>
          <a href="<?= site_url() . 'administrator/admin_lists'; ?>" class="btn btn-danger">Back</a>
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