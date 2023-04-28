<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Assessment='';
$Semester='';
$NumberQuestion='';
$NumberQuestionSent ='';
$AssessmentID=$this->uri->segment(3);
$result=$this->db->query("SELECT * FROM tblassessment WHERE AssessmentID = '".$AssessmentID."'");
foreach($result->result() as $row){
$Assessment=$row->Assessment;
$Semester=$row->Semester;
$NumberQuestion=$row->NumberQuestion;
$NumberQuestionSent=$row->NumberQuestionSent;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'superadmin/save_assessment/'.$AssessmentID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <div class="form-group">
                        <label class="col-md-12">Assessment Name</label>
                        <div class="col-md-12">
                            <input name='txtAssessment' type="text" placeholder="Enter assessment name here" class="form-control form-control-line" value="<?=$Assessment;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Semester</label>
                        <div class="col-md-12">
                            <input name='txtSemester' type="text" placeholder="Enter semester here" class="form-control form-control-line" value="<?=$Semester;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Total Quantitative Questions</label>
                        <div class="col-md-12">
                            <input name='txtNumberQuestion' type="number" placeholder="Enter total number of questions here" class="form-control form-control-line" value="<?=$NumberQuestion;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Total Qualitative Questions</label>
                        <div class="col-md-12">
                            <input name='txtNumberQuestionSent' type="number" placeholder="Enter total number of questions here" class="form-control form-control-line" value="<?=$NumberQuestionSent;?>" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>