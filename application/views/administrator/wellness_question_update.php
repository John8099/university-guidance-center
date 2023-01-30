<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Question='';
$Category='';
$WellnessType='';
$WellnessCheckID=$this->uri->segment(3);
$QuestionID=$this->uri->segment(4);
$result=$this->db->query("SELECT * FROM tblwellnessquestion WHERE QuestionID = '".$QuestionID."'");
foreach($result->result() as $row){
$Question=$row->Question;
$Category=$row->Category;
$WellnessType=$row->WellnessType;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/wellness_question_update_save/'.$WellnessCheckID.'/'.$QuestionID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <?php if ($WellnessType=='Quantitative'): ?>
                        <h2>Quantitative Questions</h2>
                        <div class="form-group">
                            <label class="col-md-12">Category</label>
                            <div class="col-md-12">
                                <select class="form-control form-control-line" name="txtCategory" required id="txtCategory">
                                  <option value="">Select Category</option>
                                  <option value="Emotional Wellness" <?=($Category=='Emotional Wellness') ? 'selected':'';?>>Emotional Wellness</option>
                                  <option value="Environmental Wellness" <?=($Category=='Environmental Wellness') ? 'selected':'';?>>Environmental Wellness</option>
                                  <option value="Intellectual Wellness" <?=($Category=='Intellectual Wellness') ? 'selected':'';?>>Intellectual Wellness</option>
                                  <option value="Occupational Wellness" <?=($Category=='Occupational Wellness') ? 'selected':'';?>>Occupational Wellness</option>
                                  <option value="Physical Wellness" <?=($Category=='Physical Wellness') ? 'selected':'';?>>Physical Wellness</option>
                                  <option value="Social Wellness" <?=($Category=='Social Wellness') ? 'selected':'';?>>Social Wellness</option>
                                  <option value="Spiritual Wellness" <?=($Category=='Spiritual Wellness') ? 'selected':'';?>>Spiritual Wellness</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Question</label>
                            <div class="col-md-12">
                                <input name='txtQuestion' type="text" placeholder="Enter Question here" class="form-control form-control-line" value="<?=$Question;?>" required />
                            </div>
                        </div>
                        <hr>
                    <?php else: ?>
                        <h2>Qualitative Questions</h2>
                        <div class="form-group">
                            <label class="col-md-12">Question </label>
                            <div class="col-md-12">
                                <input name='txtQuestion' type="text" placeholder="Enter Question here" class="form-control form-control-line" value="" required />
                            </div>
                        </div>
                        <hr>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
