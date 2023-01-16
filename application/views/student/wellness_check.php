<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Title='';
$WellnessType='';
$NumberQuestion='';
$EndDate='';
$CreatedOn ='';
$WellnessCheckID=$this->uri->segment(3);
$result=$this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '".$WellnessCheckID."'");
foreach($result->result() as $row){
$Title=$row->Title;
$WellnessType=$row->WellnessType;
$NumberQuestion=$row->NumberQuestion;
$EndDate=$row->EndDate;
$CreatedOn=date('Y-m-d', strtotime($row->CreatedOn));
}
$Remarks='';
$QScore='';
$SScore='';
$Results='';
$ResultID=$this->uri->segment(3);
$tblresult=$this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID = '".$WellnessCheckID."' AND CreatedBy='".$this->session->userdata('StudentUserID')."'");
foreach($tblresult->result() as $row){
$Remarks=$row->Remarks;
$QScore=$row->QScore;
$SScore=$row->SScore;
$Results=$row->Results;
}
?>
<div class="row">
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="text-center"><?=$Title;?><br><?=$CreatedOn;?><br><?=$WellnessType;?> Assessment</p>

<?php
if ($WellnessCheckID!=0) {
    if ($WellnessType=='Quantitative') {
        $tblwellnessquestionCategory = $this->db->query("SELECT DISTINCT Category FROM tblwellnessquestion WHERE WellnessCheckID='".$WellnessCheckID."';");
        if($tblwellnessquestionCategory->num_rows()<>0) {
?>
                <form method="post" action="<?=site_url().'student/save_wellness_check2/'.$WellnessCheckID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <?php foreach ($tblwellnessquestionCategory->result() as $CategoryRow): ?>
                        <h4 class="card-title"><?=$CategoryRow->Category;?> Questions</h4>
                        <?php
                        $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='".$WellnessCheckID."' AND Category='".$CategoryRow->Category."';");
                        $AnswerData='';
                        foreach ($tblwellnessquestion->result() as $row):
                            $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='".$row->QuestionID."';");
                            if($tblanswer->num_rows()<>0) {
                                $tblanswer=$tblanswer->row();
                                $AnswerData=$tblanswer->Answer;
                            }
                        ?>
    <p><strong><?=$row->Question;?></strong></p>
    <div class="form-group">
        <label class="containeroption-wellnes" for="never<?=$row->QuestionID;?>" style="min-width: 100px;">
            <input name='choices<?=$row->QuestionID;?>' id='never<?=$row->QuestionID;?>' type="radio" value="1" class="input-hidden" <?=($AnswerData==1) ? 'checked' : ''?> />
            Never
            <span class="checkmark-wellnes"></span>
            <img src="<?=base_url().'media/'?>emoj/1.webp" class="img-wellnes" style="width:100px; margin: auto 20px;" />
        </label>
        <label class="containeroption-wellnes" for="rarely<?=$row->QuestionID;?>" style="min-width: 100px;">
            <input name='choices<?=$row->QuestionID;?>' id='rarely<?=$row->QuestionID;?>' type="radio" value="2" class="input-hidden" <?=($AnswerData==2) ? 'checked' : ''?> />
            Rarely
            <span class="checkmark-wellnes"></span>
            <img src="<?=base_url().'media/'?>emoj/2.webp" class="img-wellnes" style="width:100px; margin: auto 20px;" />
        </label>
        <label class="containeroption-wellnes" for="sometimes<?=$row->QuestionID;?>" style="min-width: 100px;">
            <input name='choices<?=$row->QuestionID;?>' id='sometimes<?=$row->QuestionID;?>' type="radio" value="3" class="input-hidden" <?=($AnswerData==3) ? 'checked' : ''?> />
            Sometimes
            <span class="checkmark-wellnes"></span>
            <img src="<?=base_url().'media/'?>emoj/3.webp" class="img-wellnes" style="width:100px; margin: auto 20px;" />
        </label>
        <label class="containeroption-wellnes" for="usually<?=$row->QuestionID;?>" style="min-width: 100px;">
            <input name='choices<?=$row->QuestionID;?>' id='usually<?=$row->QuestionID;?>' type="radio" value="4" class="input-hidden" <?=($AnswerData==4) ? 'checked' : ''?> />
            Usually
            <span class="checkmark-wellnes"></span>
            <img src="<?=base_url().'media/'?>emoj/4.webp" class="img-wellnes" style="width:100px; margin: auto 20px;" />
        </label>
    </div>
    <hr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="col-md-12">&nbsp;</label>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100">Submit</button>
                        </div>
                    </div>
                </form>
<?php
        }
    } else {
        $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='".$WellnessCheckID."' AND Category='NONE';");
        
        if($tblwellnessquestion->num_rows()<>0) {
?>
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form method="post" action="<?=site_url().'student/save_wellness_check2/'.$WellnessCheckID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <input name='txtCategory' type="hidden" value="NONE" />
                    <?php
                        $AnswerData='';
                        foreach ($tblwellnessquestion->result() as $row) :
                            $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='".$row->QuestionID."';");
                            if($tblanswer->num_rows()<>0) {
                                $tblanswer=$tblanswer->row();
                                $AnswerData=$tblanswer->Answer;
                            }
                        ?>
                        <div class="form-group">
                            <label for="txtAnswer<?=$row->QuestionID;?>" class="col-md-12"><?=$row->Question;?></label>
                            <div class="col-md-12">
                                <input name='txtAnswer<?=$row->QuestionID;?>' type="text" placeholder="Enter your answer here" class="form-control form-control-line" value="<?=($AnswerData != '') ? $AnswerData : ''?>" required />
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="col-md-12">&nbsp;</label>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        }
    }
}
?>
            </div>
        </div>
    </div>
</div>
