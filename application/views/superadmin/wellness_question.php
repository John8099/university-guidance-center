<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Title='';
$WellnessType='';
$NumberQuestion=0;
$WellnessCheckID=$this->uri->segment(3);
$result=$this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '".$WellnessCheckID."'");
foreach($result->result() as $row){
$Title=$row->Title;
$WellnessType=$row->WellnessType;
$NumberQuestion=$row->NumberQuestion;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'superadmin/wellness_question_save/'.$WellnessCheckID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <?php if ($WellnessType=='Quantitative'): ?>
                        <h2>Quantitative Questions</h2>
                        <div class="form-group">
                            <label class="col-md-12">Category</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name="txtCategory" required id="txtCategory">
                                  <option value="">Select Category</option>
                                  <option value="Emotional Wellness">Emotional Wellness</option>
                                  <option value="Environmental Wellness">Environmental Wellness</option>
                                  <option value="Intellectual Wellness">Intellectual Wellness</option>
                                  <option value="Occupational Wellness">Occupational Wellness</option>
                                  <option value="Physical Wellness">Physical Wellness</option>
                                  <option value="Social Wellness">Social Wellness</option>
                                  <option value="Spiritual Wellness">Spiritual Wellness</option>
                                </select>
                            </div>
                        </div>
                        <?php for ($i=1; $i <= $NumberQuestion; $i++): ?>
                            <div class="form-group">
                                <label class="col-md-12">Question <?=$i;?></label>
                                <div class="col-md-12">
                                    <input name='txtQuestion<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="" required />
                                </div>
                            </div>
                            <hr>
                        <?php endfor; ?>
                    <?php else: ?>
                        <input name='txtCategory' type="hidden" value="NONE" />
                        <h2>Qualitative Questions</h2>
                        <?php for ($i=1; $i <= $NumberQuestion; $i++): ?>
                            <div class="form-group">
                                <label class="col-md-12">Question <?=$i;?></label>
                                <div class="col-md-12">
                                    <input name='txtQuestion<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="" required />
                                </div>
                            </div>
                            <hr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success">Submit</button>
                    
                        <a href="<?=site_url().'superadmin/wellness_check/'.$WellnessCheckID;?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                </form>
            </div>
        </div>
    </div>
</div>
