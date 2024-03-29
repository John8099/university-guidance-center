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
$Age = "";
$CollegeID = "";
$CivilStatus = "";
$ifMarried = "";
$SpouseName = "";
$SpouseContact = "";
$PlaceBirth = "";
$DateBirth = "";
$Gender = "";
$Address = "";
$HomeAddress = "";
$MobileNo = "";
$Religion = "";
$LivingArrangement = "";
$MinorityGroup = "";
$GuardianName = "";
$GuardianAge = "";
$GuardianContactNumber = "";
$GuardianOccupation = "";
$GuardianOfficeAddress = "";
$SiblingsNameAge = "";
$sibling = "";
$EstAnnualIncome = "";
$ChildrenNameAge = ""; 
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
  $Age = $row->Age;
  $CollegeID = $row->CollegeID;
  $CivilStatus = $row->CivilStatus;
  $ifMarried = $row->ifMarried; 
  $SpouseName = $row->SpouseName;
  $SpouseContact = $row->SpouseContact;
  $PlaceBirth = $row->PlaceBirth;
  $DateBirth = $row->DateBirth;
  $Gender = $row->Gender;
  $Address = $row->Address;
  $HomeAddress = $row->HomeAddress;
  $MobileNo = $row->MobileNo;
  $Religion = $row->Religion;
  $LivingArrangement = $row->LivingArrangement;
  $MinorityGroup = $row->MinorityGroup;
  $GuardianName = $row->GuardianName;
  $GuardianAge = $row->GuardianAge;
  $GuardianContactNumber = $row->GuardianContactNumber;
  $GuardianOccupation = $row->GuardianOccupation;
  $GuardianOfficeAddress = $row->GuardianOfficeAddress;
  $SiblingsNameAge = $row->SiblingsNameAge;
  $sibling = $row->sibling;
  $EstAnnualIncome = $row->EstAnnualIncome;
  $ChildrenNameAge = $row->ChildrenNameAge;
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
            <div class="col-md-12">
              <div class="row" style="display: flex; align-items: flex-end;">
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <div id="individualBarChart"></div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <div class="input-group">
                        <div class="form-outline" style="margin: .2rem">
                          <select id="lineFilterBy" class="form-select">
                            <option value="" selected disabled>Filter by</option>
                            <option value="month">Month</option>
                          </select>
                        </div>

                        <div id="lineDivMonth" style="margin: .2rem; display:none">
                          <select id="lineMonthFilter" class="form-select">
                            <option value="" selected disabled>select month</option>
                            <?php
                            $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                            foreach ($months as $month) {
                              $indexOfMonth = array_search($month, $months) + 1;
                              echo "<option value='$indexOfMonth'>$month</option>";
                            }
                            ?>
                          </select>
                        </div>


                        <div class="form-outline" style="margin: .2rem">
                          <button type="button" class="btn btn-secondary btn-sm" id="btnLineClear" style="height: 35px; display: none" onclick="handleLineClear()">
                            Clear
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div id="individualLineChart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group required">
                <label class="col-md-12 ">Email</label>
                <div class="col-md-12">
                  <input type="email" class="form-control form-control-line" required value="<?= $Email ?>" name="txtEmail" readonly />
                </div>
              </div>
                            

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Last Name</label>
                    <div class="col-md-12">
                      <input type="text"   value="<?= $last_name ?>"class="form-control form-control-line" required name="txtLname" readonly />
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">First Name</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $first_name ?>" class="form-control form-control-line" required name="txtFname" readonly/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Middle Name</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $middle_name ?>" class="form-control form-control-line" required name="txtMname" readonly/>
              </div>
              </div>
                </div>
                          
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Student ID #</label>
                    <div class="col-md-12">
                      <input type="text" placeholder="Student ID" class="form-control form-control-line" value="<?= $SchoolID ?>" required name="txtStudentId" readonly />
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Course</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $Course ?>" class="form-control form-control-line" required name="txtCourse" readonly/>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Year & Section</label>
                    <div class="col-md-12">
                      <input type="text" value="<?= $YearSec ?>" class="form-control form-control-line" required name="txtYearSec" readonly/>
              </div>
              </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Age</label>
                    <div class="col-md-12">
                    <input type="text" value="<?= $Age ?>" class="form-control form-control-line" required name="txtAge" readonly />
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">College</label>
                    <div class="col-md-12">
                    <input type="text" value="<?= $this->routines->getCollege($CollegeID) ?>" readonly class="form-control form-control-line">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Civil Status</label>
                    <div class="col-md-12">
                    <input type="text" value="<?= $CivilStatus ?>" readonly class="form-control form-control-line">
              </div>
              </div>
                </div>

                <div class="row">
                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Spouse's Name</label>
                    <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $SpouseName ?>" required name="txtSpouseName" readonly />
            
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group required">
                    <label class="col-md-12 control-label">Spouse's Contact</label>
                    <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $SpouseContact ?>" required name="txtSpouseContact" readonly />
                  </div>
                </div>

              </div>
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

              <div class="form-group required">
                <label class="col-md-12 ">Home/Provincial Address</label>
                <div class="col-md-12">
                  <input type="text" class="form-control form-control-line" required value="<?= $HomeAddress ?>" name="txtHomeAddress" readonly readonly />
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
                  <input type="text" class="form-control form-control-line" value="<?= $MinorityGroup ?>"  required name="txtMinorityGroup" readonly />
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

                <div class="form-group">
                <div class="form-group required">
           <label class="col-md-12 control-label">Names and ages of siblings</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control form-control-line" required value="<?= $SiblingsNameAge ?>" name="txtSiblingsNameAge" readonly/>
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
                  <label class="col-md-12 control-label">Name of Children and age, if married/ with family</label>
                  <div class="col-md-12">
                    <input type="text" class="form-control form-control-line" value="<?= $ChildrenNameAge ?>" name="txtChildrenNameAge" readonly />
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