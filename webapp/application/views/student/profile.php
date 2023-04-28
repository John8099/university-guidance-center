<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Email = "";
$last_name = "";
$first_name = "";
$middle_name = "";
$SchoolID = "";
$Course = "";
$YearSec = "";
$CollegeID = "";
$CivilStatus = "";
$PlaceBirth = "";
$DateBirth = "";
$Gender = "";
$Address = "";
$MobileNo = "";
$Religion = "";
$LivingArrangement = "";
$MinorityGroup = "";
$GuardianName = "";
$GuardianContactNumber = "";
$GuardianOccupation = "";
$GuardianOfficeAddress = "";
$EstAnnualIncome = "";
$SourceOfIncome = "";
$Disability = "";
$GeneralCondition = "";
$GeneralConditionReason = "";
$FBLink = "";

$UserID = $this->session->userdata('StudentUserID');
$query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '" . $UserID . "'");

foreach ($query->result() as $row) {
  $Email = $row->Email;
  $last_name = $row->last_name;
  $first_name = $row->first_name;
  $middle_name = $row->middle_name;
  $SchoolID = $row->SchoolID;
  $Course = $row->Course;
  $YearSec = $row->YearSec;
  $CollegeID = $row->CollegeID;
  $CivilStatus = $row->CivilStatus;
  $PlaceBirth = $row->PlaceBirth;
  $DateBirth = $row->DateBirth;
  $Gender = $row->Gender;
  $Address = $row->Address;
  $MobileNo = $row->MobileNo;
  $Religion = $row->Religion;
  $LivingArrangement = $row->LivingArrangement;
  $MinorityGroup = $row->MinorityGroup;
  $GuardianName = $row->GuardianName;
  $GuardianContactNumber = $row->GuardianContactNumber;
  $GuardianOccupation = $row->GuardianOccupation;
  $GuardianOfficeAddress = $row->GuardianOfficeAddress;
  $EstAnnualIncome = $row->EstAnnualIncome;
  $SourceOfIncome = $row->SourceOfIncome;
  $Disability = $row->Disability;
  $GeneralCondition = $row->GeneralCondition;
  $GeneralConditionReason = $row->GeneralConditionReason;
  $FBLink = $row->FBLink;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="container">
          <h6>
            <strong>Note:</strong>
          </h6>
          <p>
            This e- document is confidential. All gathered information about students using this form will be solely utilized by the university guidance center and college guidance offices for guidance and counseling purposes only. Please prepare 2x2 photo and e-signature to be uploaded in this form.
          </p>
          <p>
            The name and photo associated with your wvsu account will be recorded when you upload files and submit this form.
          </p>
          <p>
            Any files that are uploaded will be shared with the organization they belong to.
          </p>
        </div>
      </div>
      <div class="card-body">

        <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
            <?= $this->session->flashdata('updateSuccess'); ?>
          </div>
        </div>
        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
          </svg>
          <div>
            <?= $this->session->flashdata('updateFailed'); ?>
          </div>
        </div>

        <form method="post" action="<?= site_url() . 'student/profile_save/' . $UserID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <div class="row">
            <div class="col-md-6">

              <div class="form-group required">
                <label class="col-md-12 ">Email</label>
                <div class="col-md-12">
                  <input type="email" class="form-control form-control-line" required value="<?= $Email ?>" name="txtEmail" readonly />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Last name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $last_name ?>" name="txtLname" readonly />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">First name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $first_name ?>" name="txtFname" readonly />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Middle name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $middle_name ?>" name="txtMname" readonly />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Student ID #</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $SchoolID ?>" name="txtStudentId" readonly />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Course</label>
                    <div class="col-md-12">
                      <input type="text" placeholder="Course" class="form-control form-control-line" value="<?= $Course ?>" required name="txtCourse" readonly />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Year & Section</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $YearSec ?>" class="form-control form-control-line" required name="txtYearSec" readonly />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">College</label>
                <div class="col-md-12">
                  <input type="text" value="<?= $this->routines->getCollege($CollegeID) ?>" readonly class="form-control form-control-line">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group required">
                <label class="col-md-12 ">Civil Status</label>
                <div class="col-md-12">
                  <input type="text" value="<?= $CivilStatus ?>" readonly class="form-control form-control-line">

                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Date of Birth</label>
                    <div class="col-md-12">
                      <input type="date" class="form-control form-control-line" value="<?= $DateBirth ?>" required name="txtDateOfBirth" readonly />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Place of Birth</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" required value="<?= $PlaceBirth ?>" name="txtPlaceOfBirth" readonly />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Gender</label>
                <div class="col-md-12">
                  <input type="text" value="<?= $Gender ?>" readonly class="form-control form-control-line">
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Address</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $Address ?>" name="txtAddress" readonly readonly />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Phone Number</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" value="<?= $MobileNo ?>" required name="txtPhoneNumber" readonly />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 ">Religion</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" required value="<?= $Religion ?>" name="txtReligion" readonly />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 ">Living arrangement</label>
                <div class="col-md-12">
                  <input type="text" value="<?= $LivingArrangement ?>" readonly class="form-control form-control-line">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12 ">If member of a minority group/indigenous people</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" value="<?= $MinorityGroup ?>" placeholder="Please specify here" required name="txtMinorityGroup" readonly />
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Guardian's name/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianName ?>" name="txtGuardianOrSpouseName" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Contact Number of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianContactNumber ?>" name="txtGuardianOrSpouseContact" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Occupation of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianOccupation ?>" name="txtGuardianOrSpouseOccupation" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Office or Address of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianOfficeAddress ?>" name="txtGuardianOrSpouseOfficeAddress" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Estimated Family Annual Income</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $EstAnnualIncome ?>" name="txtEstAnnualIncome" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 ">Source of income</label>
                      <div class="col-md-12">
                        <input type="text" value="<?= $SourceOfIncome ?>" readonly class="form-control form-control-line">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group ">
                  <label class="col-md-12 ">Physical disabilities/ defects, if any</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $Disability ?>" name="txtDisability" readonly />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group required">
                      <label class="col-md-12 ">General Condition of Health (e.g. good; ) </label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" value="<?= $GeneralCondition ?>" name="txtGeneralCondition" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group ">
                      <label class="col-md-12 ">if not good why?</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" value="<?= $GeneralConditionReason ?>" name="txtGeneralConditionReason" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group required">
                  <label class="col-md-12 ">Facebook profile link</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $FBLink ?>" name="txtProfileLink" required readonly />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-100 text-end">
            <button type="button" onclick="return window.location.href = '<?= site_url() . 'student/profile_edit' ?>'" class="btn btn-primary text-white">Edit Profile</button>

            <button type="button" onclick="return window.location.href = '<?= site_url() . 'student/change_profile_picture' ?>'" class="btn btn-default text-white">Upload Photo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function successful() {

    document.querySelector('#alertsuccess').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertsuccess').classList.add('d-none');
    }, 5000);
  }

  function failed() {

    document.querySelector('#alertdanger').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertdanger').classList.add('d-none');
    }, 5000);
  }
</script>

<?php if ($this->session->flashdata('updateSuccess') != '') : ?>
  <script>
    successful();
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('updateFailed') != '') : ?>
  <script>
    failed();
  </script>
<?php endif; ?>