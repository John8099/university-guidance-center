<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'superadmin/change_password_save'?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <div class="form-group">
                        <label for="txtOldPassword" class="col-md-12">Old Password</label>
                        <div class="col-md-12">
                            <input type="password" placeholder="Enter you old password here"
                                class="form-control form-control-line" required="required" name="txtOldPassword" id="txtOldPassword" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtPassword" class="col-md-12">New Password</label>
                        <div class="col-md-12">
                            <input type="password" placeholder="Enter you new password here"
                                class="form-control form-control-line" required="required" name="txtPassword" id="txtPassword" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtConfirmPassword" class="col-md-12">Confirm Password</label>
                        <div class="col-md-12">
                            <input type="password" placeholder="Enter you confirm password here"
                                class="form-control form-control-line" required="required" name="txtConfirmPassword" id="txtConfirmPassword" value="" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('pass_msg')!='') {
    echo $this->routines->callSweetAlert($this->session->flashdata('pass_msg'));
}
?>