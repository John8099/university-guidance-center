<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Referrer='';
$StudentName='';
$Email='';
$YearSection='';
$CollegeID='';
$Address='';
$PhoneNumber='';
$OtherContact='';
$Platform='';
$PreferredTime='';
$SelectedDate='';
$Status='';
$AppointmentID=$this->uri->segment(3);
$query=$this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '".$AppointmentID."'");
foreach($query->result() as $row){
$Referrer=$row->Referrer;
$StudentName=$row->StudentName;
$Email=$row->Email;
$YearSection=$row->YearSection;
$CollegeID=$row->CollegeID;
$Address=$row->Address;
$PhoneNumber=$row->PhoneNumber;
$OtherContact=$row->OtherContact;
$Platform=$row->Platform;
$PreferredTime=$row->PreferredTime;
$SelectedDate=$row->SelectedDate;
$Status=$row->Status;
}
$College='';
$College=$this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '{$CollegeID}';")->row()->College;
?>
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Appointment Details</h4>
                <hr>
                <ul class="list-group">
                    <?php if ($Referrer!=''): ?>
                    <li class="list-group-item"><strong>Referrer: </strong><?=$Referrer;?></li>
                    <?php endif; ?>
                    <li class="list-group-item"><strong>Student Name: </strong><?=$StudentName;?></li>
                    <li class="list-group-item"><strong>Student Email: </strong><?=$Email;?></li>
                    <li class="list-group-item"><strong>College: </strong><?=$College;?></li>
                    <li class="list-group-item"><strong>Course Year and Section: </strong><?=$YearSection;?></li>
                    <li class="list-group-item"><strong>Address: </strong><?=$Address;?></li>
                    <li class="list-group-item"><strong>Phone Number: </strong><?=$PhoneNumber;?></li>
                    <li class="list-group-item"><strong>Other Contact Information: </strong><?=$OtherContact;?></li>
                    <li class="list-group-item"><strong>Platform: </strong><?=$Platform;?></li>
                    <li class="list-group-item"><strong>Preferred Time: </strong><?=$PreferredTime;?></li>
                    <li class="list-group-item"><strong>Select Date: </strong><?=$SelectedDate;?></li>
                    <li class="list-group-item"><strong>Status: </strong><?=$Status;?></li>
                </ul>
                <?php
                    $this->session->set_userdata('AppointmentEmail', $Email);
                ?>
                <?php if ($Status=='Pending'): ?>
                    <hr>
                    <a style="width: 170px;" href="<?=site_url().'administrator/update_status/'.$row->AppointmentID.'/Approved';?>" class="btn btn-primary btn-sm" title="Approve Appointment">Approve</a>
                    <a style="width: 170px;" href="<?=site_url().'administrator/update_status/'.$row->AppointmentID.'/Endorsed';?>" class="btn btn-secondary btn-sm" title="Endorsed">Endorsed</a>
                <?php endif; ?>
                <?php if ($Status=='Approved'): ?>
                    <hr>
                    <a style="width: 170px;" href="<?=site_url().'administrator/update_status/'.$row->AppointmentID.'/Completed';?>" class="btn btn-danger text-white btn-sm" title="Complete Appointment">Complete</a>
                    <a style="width: 170px;" href="<?=site_url().'administrator/update_status/'.$row->AppointmentID.'/Follow Up';?>" class="btn btn-info btn-sm" title="Follow Up Appointment">Follow Up</a>
                    <a style="width: 170px;" href="<?=site_url().'administrator/update_status/'.$row->AppointmentID.'/Rescheduled';?>" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>