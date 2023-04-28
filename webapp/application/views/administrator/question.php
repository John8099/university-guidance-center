<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Assessment='';
$Semester='';
$NumberQuestion=0;
$NumberQuestionSent=0;
$AssessmentID=$this->session->userdata('AssessmentID');
$result=$this->db->query("SELECT * FROM tblassessment WHERE AssessmentID = '".$AssessmentID."'");
foreach($result->result() as $row){
$Assessment=$row->Assessment;
$Semester=$row->Semester;
$NumberQuestion=$row->NumberQuestion;
$NumberQuestionSent=$row->NumberQuestionSent;
}
?>

<?php
$HasQuestion=false;
$resultQuestion=$this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '".$AssessmentID."'");
foreach($resultQuestion->result() as $row){
$HasQuestion=true;
}
?>

<?php if ($HasQuestion): ?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/save_questions/'.$AssessmentID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <h2>Quantitative Questions</h2>
                    <?php for ($i=1; $i <= $NumberQuestion; $i++): ?>
                    <?php
                        $tblquestion=$this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '".$AssessmentID."' AND QuestionNumber = '".$i."' AND Category = 'MultipleChoice';")->row();
                    ?>
                        <div class="form-group">
                            <label class="col-md-12">Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtQuestionMul<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Question) ? $tblquestion->Question : '');?>" required />
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label class="col-md-12">Category for Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtCategoryMul<?=$i;?>' type="text" placeholder="Enter Category for Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Category) ? $tblquestion->Category : 'MultipleChoice');?>" />
                            </div>
                        </div>
                        <hr>
                    <?php endfor; ?>
                    <h2>Qualitative Questions</h2>
                    <?php for ($i=1; $i <= $NumberQuestionSent; $i++): ?>
                    <?php
                        $tblquestion=$this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '".$AssessmentID."' AND QuestionNumber = '".$i."' AND Category = 'SentanceBased';")->row();
                    ?>
                        <div class="form-group">
                            <label class="col-md-12">Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtQuestion<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Question) ? $tblquestion->Question : '');?>" required />
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label class="col-md-12">Category for Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtCategory<?=$i;?>' type="text" placeholder="Enter Category for Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Category) ? $tblquestion->Category : 'SentanceBased');?>" />
                            </div>
                        </div>
                        <hr>
                    <?php endfor; ?>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/save_questions/'.$AssessmentID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <h2>Quantitative Questions</h2>
                    <?php for ($i=1; $i <= $NumberQuestion; $i++): ?>
                    <?php
                        $tblquestion=$this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '".$AssessmentID."' AND QuestionNumber = '".$i."' AND Category = 'MultipleChoice';")->row();
                    ?>
                        <div class="form-group">
                            <label class="col-md-12">Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtQuestionMul<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Question) ? $tblquestion->Question : '');?>" required />
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label class="col-md-12">Category for Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtCategoryMul<?=$i;?>' type="text" placeholder="Enter Category for Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Category) ? $tblquestion->Category : 'MultipleChoice');?>" />
                            </div>
                        </div>
                        <hr>
                    <?php endfor; ?>
                    <h2>Qualitative Questions</h2>
                    <?php for ($i=1; $i <= $NumberQuestionSent; $i++): ?>
                    <?php
                        $tblquestion=$this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '".$AssessmentID."' AND QuestionNumber = '".$i."' AND Category = 'SentanceBased';")->row();
                    ?>
                        <div class="form-group">
                            <label class="col-md-12">Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtQuestion<?=$i;?>' type="text" placeholder="Enter Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Question) ? $tblquestion->Question : '');?>" required />
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <label class="col-md-12">Category for Question <?=$i;?></label>
                            <div class="col-md-12">
                                <input name='txtCategory<?=$i;?>' type="text" placeholder="Enter Category for Question <?=$i;?> here" class="form-control form-control-line" value="<?=(isset($tblquestion->Category) ? $tblquestion->Category : 'SentanceBased');?>" />
                            </div>
                        </div>
                        <hr>
                    <?php endfor; ?>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>