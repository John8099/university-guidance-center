<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Wellness Check Question List</h4>
                    </div>
                    <div class="ms-auto">
                        <a href="<?=site_url().'superadmin/wellness_check';?>" type="button" class="btn btn-outline-success btn-sm" title="Create Wellness Check" style="width: 100px;">Create</a>
                    </div>
                </div>
                <!-- title -->
            </div>
            <div class="table-responsive">
                
            <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = $this->db->query("SELECT tblwellnessquestion.QuestionID,tblwellnesscheck.WellnessCheckID,tblwellnessquestion.Question,tblwellnesscheck.WellnessType,tblwellnesscheck.CreatedOn,tblwellnessquestion.Status FROM tblwellnessquestion LEFT JOIN tblwellnesscheck ON tblwellnesscheck.WellnessCheckID=tblwellnessquestion.WellnessCheckID;");

foreach ($query->result() as $row) : ?>
    <tr>
        <td><?=$row->Question;?></td>
        <td><?=$row->WellnessType;?></td>
        <td><?=date('Y-m-d', strtotime($row->CreatedOn));?></td>
        <td><?=$row->Status;?></td>
        <td>
            <?php if($row->Status=='Disable') : ?>
                <a href="<?=site_url().'superadmin/wellness_check_question_status/'.$row->QuestionID.'/Enable';?>" class="btn btn-outline-warning btn-sm" title="Set Enable" style="width: 100px;">Set Enable</a>
            <?php else: ?>
                <a href="<?=site_url().'superadmin/wellness_check_question_status/'.$row->QuestionID.'/Disable';?>" class="btn btn-outline-warning btn-sm" title="Set Disable" style="width: 100px;">Set Disable</a>
            <?php endif; ?>
            <?php if ($row->Status=='Disable'): ?>
            <a href="<?=site_url().'superadmin/wellness_check/'.$row->WellnessCheckID;?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px;">Edit</a>
            <a href="<?=site_url().'superadmin/wellness_check_question_confirm/'.$row->QuestionID.'/'.$row->WellnessCheckID;?>" class="btn btn-outline-danger btn-sm" title="Delete" style="width: 100px;">Delete</a>
            <?php else: ?>
            <button class="btn btn-outline-primary btn-sm" style="width: 100px;" disabled>Edit</button>
            <button class="btn btn-outline-danger btn-sm" style="width: 100px;" disabled>Delete</button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php

if ($this->session->flashdata('isPublish')=='true') {
    $tblwellnessquestion=$this->db->query("SELECT * FROM tblwellnessquestion WHERE IsPublish = '0';");
    if($tblwellnessquestion->num_rows()<>0) {
        if(!$this->routines->isWellnessCheckQuestionPublish()) {
        echo $this->routines->callSweetAlertYesNo("Data was successfully saved","Do you want to publish this on email?","info","Quit","Publish",site_url().'superadmin/wellness_question_publish');
        }
    }
}
if ($this->session->flashdata('isPublish')=='false') {
    echo $this->routines->callSweetAlert("Data was successfully saved");
}
if ($this->session->flashdata('isUpdateStatus')=='true') {
    echo $this->routines->callSweetAlert("Wellness check status updated");
}
if ($this->session->flashdata('isQuestionDelete')=='true') {
    echo $this->routines->callSweetAlertYesNo("Are you sure you want to delete this question?","","warning","No","Yes",site_url().'superadmin/wellness_check_question_delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4),site_url().'superadmin/wellness_question_list');
}
if ($this->session->flashdata('QuestionDeleted')=='true') {
    echo $this->routines->callSweetAlert("Wellness check question deleted");
}
if ($this->session->flashdata('QuestionDeleted')=='false') {
    echo $this->routines->callSweetAlert("Wellness check question unable to delete");
}
if ($this->session->flashdata('QuestionIsPublish')=='true') {
    echo $this->routines->callSweetAlert("Wellness check questions published");
}
?>