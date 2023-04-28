<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Title='';
$WellnessType='';
$NumberQuestion='';
$CreatedOn ='';
$WellnessCheckID=$this->uri->segment(3);
$result=$this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '".$WellnessCheckID."'");
foreach($result->result() as $row){
$Title=$row->Title;
$WellnessType=$row->WellnessType;
$NumberQuestion=$row->NumberQuestion;
$CreatedOn=date('Y-m-d', strtotime($row->CreatedOn));
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/wellness_check_save/'.$WellnessCheckID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <div class="form-group">
                        <label for="txtTitle" class="col-md-12">Title</label>
                        <div class="col-md-12">
                            <input name='txtTitle' id="txtTitle" type="text" placeholder="Enter title here" class="form-control form-control-line" value="<?=$Title;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtType" class="col-md-12">Type</label>
                        <div class="col-md-12">
                          <div class="custom-select">
                            <select class="form-control form-control-line" name="txtType" required id="txtType">
                              <option value="">Select Type</option>
                              <option value="Qualitative" <?=($WellnessType=='Qualitative') ? 'selected':'';?>>Qualitative</option>
                              <option value="Quantitative" <?=($WellnessType=='Quantitative') ? 'selected':'';?>>Quantitative</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Total Questions</label>
                        <div class="col-md-12">
                            <input name='txtNumberQuestion' min="1" type="number" placeholder="Enter total number of questions here" class="form-control form-control-line" value="<?=$NumberQuestion;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Date</label>
                        <div class="col-md-12">
                            <input name='txtDate' type="date" class="form-control form-control-line" value="<?=$CreatedOn;?>" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>