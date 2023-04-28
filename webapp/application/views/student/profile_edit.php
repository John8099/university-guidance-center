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
                <label class="col-md-12 control-label">Email</label>
                <div class="col-md-12">
                  <input type="email" class="form-control form-control-line" required value="<?= $Email ?>" name="txtEmail" />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Last name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $last_name ?>" name="txtLname" />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">First name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $first_name ?>" name="txtFname" />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Middle name</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $middle_name ?>" name="txtMname" />
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Student ID #</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $SchoolID ?>" name="txtStudentId" />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Course</label>
                    <div class="col-md-12">
                      <input type="text" placeholder="Course" class="form-control form-control-line" value="<?= $Course ?>" required name="txtCourse" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Year & Section</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $YearSec ?>" class="form-control form-control-line" required name="txtYearSec" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">College</label>
                <div class="col-md-12">
                  <select class="form-select" name="txtCollege" required>
                    <option value="" selected disabled>Select College</option>
                    <?php $query = $this->db->query("SELECT CollegeID, College FROM tblcollege;");
                    foreach ($query->result() as $row) : ?>
                      <option value="<?= $row->CollegeID; ?>" <?= ($CollegeID == $row->CollegeID) ? ' selected' : ''; ?>><?= $row->College; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group required">
                <label class="col-md-12 control-label">Civil Status</label>
                <div class="col-md-12">
                  <select class="form-select" name="txtCivilStat" required>
                    <option value="" selected disabled>Select Civil Status</option>
                    <?php
                    $civilStats = array("Single", "Married", "Divorced");
                    foreach ($civilStats as $civilStat) :
                    ?>
                      <option value="<?= $civilStat ?>" <?= $CivilStatus == $civilStat ? "selected" : "" ?>><?= $civilStat ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Date of Birth</label>
                    <div class="col-md-12">
                      <input type="date" class="form-control form-control-line" value="<?= $DateBirth ?>" required name="txtDateOfBirth" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Place of Birth</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" required value="<?= $PlaceBirth ?>" name="txtPlaceOfBirth" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Gender</label>
                <div class="col-md-12">
                  <select name="txtGender" class="form-select form-control-line">
                    <option value="" selected disabled>Select Gender</option>
                    <?php
                    $genders = array(
                      "Male",
                      "Female",
                      "Gay",
                      "Lesbian",
                      "Bisexual",
                      "Prefer not to say"
                    );
                    foreach ($genders as $genderList) :
                    ?>
                      <option value="<?= $genderList ?>" <?= $Gender == $genderList ? "selected" : "" ?>><?= $genderList ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Address</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $Address ?>" name="txtAddress" />
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Phone Number</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" value="<?= $MobileNo ?>" required name="txtPhoneNumber" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Religion</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control form-control-line" required value="<?= $Religion ?>" name="txtReligion" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-md-12 control-label">Living arrangement</label>
                <div class="col-md-12">
                  <select name="txtLivingArrangement" class="form-select">
                    <option value="" selected disabled>Select Living arrangement</option>
                    <?php
                    $livingArrangements = array("Living with parents", "Living with relatives", "Others");
                    foreach ($livingArrangements as $living) :
                    ?>
                      <option value="<?= $living ?>" <?= $LivingArrangement == $living ? "selected" : "" ?>><?= $living ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12 control-label">If member of a minority group/indigenous people</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" value="<?= $MinorityGroup ?>" placeholder="Please specify here" required name="txtMinorityGroup" />
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
                      <label class="col-md-12 control-label">Guardian's name/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianName ?>" name="txtGuardianOrSpouseName" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">Contact Number of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianContactNumber ?>" name="txtGuardianOrSpouseContact" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">Occupation of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianOccupation ?>" name="txtGuardianOrSpouseOccupation" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">Office or Address of Guardian/ Spouse if married</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $GuardianOfficeAddress ?>" name="txtGuardianOrSpouseOfficeAddress" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">Estimated Family Annual Income</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $EstAnnualIncome ?>" name="txtEstAnnualIncome" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">Source of income</label>
                      <div class="col-md-12">
                        <select name="txtSourceOfIncome" class="form-select" required>
                          <option value="" selected disabled>Select source of income</option>
                          <?php
                          $sourceOfIncomes = array(
                            "Salaries/ Wages",
                            "Business",
                            "Allowance",
                            "Others"
                          );
                          foreach ($sourceOfIncomes as $source) :
                          ?>
                            <option value="<?= $source ?>" <?= $SourceOfIncome == $source ? "selected" : "" ?>><?= $source ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group ">
                  <label class="col-md-12 control-label">Physical disabilities/ defects, if any</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $Disability ?>" name="txtDisability" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group required">
                      <label class="col-md-12 control-label">General Condition of Health (e.g. good; ) </label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" value="<?= $GeneralCondition ?>" name="txtGeneralCondition" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group ">
                      <label class="col-md-12 control-label">if not good why?</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" value="<?= $GeneralConditionReason ?>" name="txtGeneralConditionReason" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group required">
                  <label class="col-md-12 control-label">Facebook profile link</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $FBLink ?>" name="txtProfileLink" required />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-100 text-end">
            <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#dataPrivacy" style=" background: #5271ff;">
              Save
            </a>
            <button type="button" onclick="return window.location.href = '<?= site_url() . 'student/change_profile_picture' ?>'" class="btn btn-default text-white">Upload Photo</button>
          </div>

          <div class="modal fade" id="dataPrivacy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">DATA PRIVACY NOTICE</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>
                    This Privacy Notice is hereby observed in compliance with Republic Act No. 10173 of the Data Privacy Act of 2012 (DPA), implementing its rules and regulations, and other relevant policies, including issuances of the National Privacy Commission.
                  </p>
                  <p>
                    WVSU respects and values your data privacy rights, and makes sure that all personal data collected from you, our stakeholders are processed in adherence to the general principles of transparency, legitimate purpose, and proportionality. Your information is limited on these purposes only.
                  </p>
                  <p>
                    WVSU will never provide your personal information to third parties for any other purpose.
                  </p>
                  <p>
                  <h6>Do you agree with this data privacy notice?</h6>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default">Yes, I Agree and Save</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
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