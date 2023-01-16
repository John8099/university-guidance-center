<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Referrer='';
$StudentName='';
$Email='';
$CollegeID='';
$YearSection='';
$Address='';
$PhoneNumber='';
$OtherContact='';
$Category='';
$Platform='';
$PreferredTime=$this->session->userdata('AppointmentTime');
$SelectedDate=$this->session->userdata('AppointmentDate');
$AppointmentID=$this->uri->segment(3);
$query=$this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '".$AppointmentID."'");
foreach($query->result() as $row){
$Referrer=$row->Referrer;
$StudentName=$row->StudentName;
$Email=$row->Email;
$CollegeID=$row->CollegeID;
$YearSection=$row->YearSection;
$Address=$row->Address;
$PhoneNumber=$row->PhoneNumber;
$OtherContact=$row->OtherContact;
$Category=$row->Category;
$Platform=$row->Platform;
$PreferredTime=$row->PreferredTime;
$SelectedDate=$row->SelectedDate;
}
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'administrator/appointment_save/'.$AppointmentID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <div class="form-group">
                        <label class="col-md-12">Referrer</label>
                        <div class="col-md-12">
                            <input name='txtReferrer' type="text" placeholder="Enter referrer here" class="form-control form-control-line" value="<?=$Referrer;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Student Name</label>
                        <div class="col-md-12">
                            <input name='txtStudentName' type="text" placeholder="Enter student name here" class="form-control form-control-line" value="<?=$StudentName;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Student Email</label>
                        <div class="col-md-12">
                            <input name='txtEmail' type="text" placeholder="Enter student email here" class="form-control form-control-line" value="<?=$Email;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">College</label>
                        <div class="col-md-12">
                            <div class="custom-select">
                            <select class="form-control form-control-line" name="txtCollege" required="required">
                                <option value="" selected hidden>Select College</option>
                                <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                                foreach ($query->result() as $row) : ?>
                                    <option value="<?=$row->CollegeID;?>" <?=($CollegeID==$row->CollegeID) ? 'selected':'';?>><?=$row->College;?></option>
                                <?php endforeach; ?>
                            </select>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Course Year and Section</label>
                        <div class="col-md-12">
                            <input name='txtYearSection' type="text" placeholder="Enter year and section here" class="form-control form-control-line" value="<?=$YearSection;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Address</label>
                        <div class="col-md-12">
                            <input name='txtAddress' type="text" placeholder="Enter address here" class="form-control form-control-line" value="<?=$Address;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Phone Number</label>
                        <div class="col-md-12">
                            <input name='txtPhoneNumber' type="text" placeholder="Enter phone number here" class="form-control form-control-line" value="<?=$PhoneNumber;?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Other Contact Information</label>
                        <div class="col-md-12">
                            <textarea name='txtOtherContact' class="form-control form-control-line" placeholder="Enter other contact info here"><?=$OtherContact;?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category</label>
                        <div class="col-md-12">
                            <div class="custom-select">
                            <select class="form-control form-control-line" name="txtCategory" required="required">
                                <option value="" selected hidden>Select Platform</option>
                                <option value="Personal" <?=($Category=='Personal') ? 'selected':'';?>>Personal</option>
                                <option value="Social" <?=($Category=='Social') ? 'selected':'';?>>Social</option>
                                <option value="Academic" <?=($Category=='Academic') ? 'selected':'';?>>Academic</option>
                            </select>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Platform</label>
                        <div class="col-md-12">
                            <div class="custom-select">
                            <select class="form-control form-control-line" name="txtPlatform" required="required">
                                <option value="" selected hidden>Select Platform</option>
                                <option value="Facebook Messenger" <?=($Platform=='Facebook Messenger') ? 'selected':'';?>>Facebook Messenger</option>
                                <option value="Google Meet" <?=($Platform=='Google Meet') ? 'selected':'';?>>Google Meet</option>
                                <option value="Telecounseling" <?=($Platform=='Telecounseling') ? 'selected':'';?>>Telecounseling</option>
                                <option value="Face to Face" <?=($Platform=='Face to Face') ? 'selected':'';?>>Face to Face</option>
                            </select>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Preferred Time</label>
                        <div class="col-md-12">
                            <input name='txtPreferredTime' type="text" placeholder="Select preferred time here" class="form-control form-control-line" value="<?=$PreferredTime;?>" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Select Date</label>
                        <div class="col-md-12">
                            <input name='txtSelectedDate' type="date" placeholder="Select date here" class="form-control form-control-line" value="<?=$SelectedDate;?>" readonly />
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100 text-white" data-bs-toggle="modal" data-bs-target="#studentaddModal">Save</button>

<div class="modal fade" id="studentaddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Saving new appointment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form>
      <div class="modal-body">

      
          <div class="form-group">
              <label>This Privacy Notice is hereby observed in compliance with Republic Act No. 10173 of the Data Privacy Act of 2012 (DPA), implementing its rules and regulations, and other relevant policies, including issuances of the National Privacy Commission. WVSU respects and values your data privacy rights, and makes sure that all personal data collected from you, our stakeholders, are processed in adherence to the general principles of transparency, legitimate purpose, and proportionality. Your information is limited on these purposes only. WVSU will never provide your personal information to third parties for any other purpose. Do you Agree with the data privacy notice?</label>
            
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button name="submit" class="btn btn-primary">I agree</button> -->
        <button type="submit" class="btn btn-primary text-white">I agree</button>
      </div>
      </form>

    </div>
  </div>
</div>
                </form>
            </div>
        </div>
    </div>
</div>