<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form enctype="multipart/form-data" method="post" action="<?= site_url() . 'administrator/change_profile_picture_save' ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <div class="form-group">
            <label for="txtImage" class="col-md-12">Upload Image</label>
            <div class="col-md-12">
              <input type="file" placeholder="Enter you old password here" class="form-control form-control-line" required="required" name="File" id="txtImage" />
            </div>
          </div>
          <button type="submit" class="btn btn-success">Change Image</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if ($this->session->flashdata('pass_msg') != '') {
  echo $this->routines->callSweetAlert($this->session->flashdata('pass_msg'));
}
?>