<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$College='';
$CollegeID=$this->uri->segment(3);
$Qcolleges=$this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '".$CollegeID."'");
foreach($Qcolleges->result() as $rQcolleges){
$College=$rQcolleges->College;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/college_save/'.$CollegeID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <div class="form-group">
                        <label class="col-md-12">College</label>
                        <div class="col-md-12">
                            <input name='txtCollege' type="text" placeholder="Enter college here" class="form-control form-control-line" value="<?=$College;?>" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>