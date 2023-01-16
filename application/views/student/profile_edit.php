<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Fullname='';
$CollegeID='';
$Course='';
$YearSec='';
$IdentifiedGender='';
$BiologicalSex='';
$Address='';
$UserID=$this->session->userdata('StudentUserID');
$query=$this->db->query("SELECT * FROM tbluser WHERE UserID = '".$UserID."'");
foreach($query->result() as $row){
$Fullname=$row->Fullname;
$CollegeID=$row->CollegeID;
$Course=$row->Course;
$YearSec=$row->YearSec;
$IdentifiedGender=$row->IdentifiedGender;
$BiologicalSex=$row->BiologicalSex;
$Address=$row->Address;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'student/profile_edit_save/'.$UserID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <input type="hidden" name="form_location" value="edit_profile">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="txtFullname" class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Full Name"
                                            class="form-control form-control-line" required="required" name="txtFullname" id="txtFullname" value="<?=$Fullname;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtCollege" class="col-md-12">College</label>
                                    <div class="col-md-12">
                                        <div class="custom-select">
                                        <select class="form-control form-control-line" name="txtCollege" required="required" id="txtCollege">
                                            <option value="" selected hidden>Select College</option>
                                            <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                                            foreach ($query->result() as $row) : ?>
                                                <option value="<?=$row->CollegeID;?>" <?=($CollegeID==$row->CollegeID) ? ' selected': '';?>><?=$row->College;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtCourse" class="col-md-12">Course</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Course"
                                                    class="form-control form-control-line" required="required" name="txtCourse" id="txtCourse" value="<?=$Course;?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="txtYearSec" class="col-md-12">Year & Section</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Year & Section"
                                                    class="form-control form-control-line" required="required" name="txtYearSec" id="txtYearSec" value="<?=$YearSec;?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 offset-lg-2">
                                <div class="form-group">
                                    <label for="txtBiologicalSex" class="col-md-12">Biological Sex</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Biological Sex"
                                            class="form-control form-control-line" required="required" name="txtBiologicalSex" id="txtBiologicalSex" value="<?=$BiologicalSex;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtIdentifiedGender" class="col-md-12">Identified Gender</label>
                                    <div class="col-md-12">
                                        <div class="custom-select">
                                        <select class="form-control form-control-line" name="txtIdentifiedGender" required="required" id="txtIdentifiedGender">
                                            <option value="" selected hidden>Select Identified Gender</option>
                                            <option value="0" <?=($IdentifiedGender==0) ? ' selected': '';?>>Female</option>
                                            <option value="1" <?=($IdentifiedGender==1) ? ' selected': '';?>>Male</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtAddress" class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Address"
                                            class="form-control form-control-line" required="required" name="txtAddress" id="txtAddress" value="<?=$Address;?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary w-100 text-white">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>