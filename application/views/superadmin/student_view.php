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

$UserID = $this->uri->segment(3);
$query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '$UserID'");

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
  <div class="col-12">
    <div class="card">
      <div class="card-body" style="font-size: 16px;">
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Student View</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p><strong>First Name:</strong> <?= $first_name ?></p>
            <p><strong>Middle Name:</strong> <?= $middle_name ?></p>
            <p><strong>Last Name:</strong> <?= $last_name ?></p>
            <p><strong>Email:</strong> <?= $Email ?></p>
            <p><strong>School ID:</strong> <?= $SchoolID ?></p>
            <p><strong>Course:</strong> <?= $Course ?></p>
            <p><strong>Year and Section:</strong> <?= $YearSec ?></p>
          </div>
          <div class="col-6">
            <p><strong>College:</strong> <?= $this->routines->getCollege($CollegeID) ?></p>
            <p><strong>Civil Status:</strong> <?= $CivilStatus ?></p>
            <p><strong>Place of Birth:</strong> <?= $PlaceBirth ?></p>
            <p><strong>Birth Day:</strong> <?= $DateBirth ?></p>
            <p><strong>Gender:</strong> <?= $Gender ?></p>
            <p><strong>Address:</strong> <?= $Address ?></p>
            <p><strong>Mobile no.:</strong> <?= $MobileNo ?></p>

          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-6">
            <p><strong>Religion:</strong> <?= $Religion ?></p>
            <p><strong>Living arrangement:</strong> <?= $LivingArrangement ?></p>

            <?php if ($MinorityGroup) : ?>
              <p><strong>If member of a minority group/indigenous people:</strong> <?= $MinorityGroup ?></p>
            <?php endif; ?>

            <p><strong>Guardian's name/ Spouse:</strong> <?= $GuardianName ?></p>
            <p><strong>Contact Number of Guardian/ Spouse:</strong> <?= $GuardianContactNumber ?></p>
            <p><strong>Occupation of Guardian/ Spouse:</strong> <?= $GuardianOccupation ?></p>
            <p><strong>Office or Address of Guardian/ Spouse:</strong> <?= $GuardianOfficeAddress ?></p>
          </div>

          <div class="col-6">
            <p><strong>Estimated Family Annual Income:</strong> <?= $EstAnnualIncome ?></p>
            <p><strong>Source of income:</strong> <?= $SourceOfIncome ?></p>

            <?php if ($Disability) : ?>
              <p><strong>Physical disabilities/ defects:</strong> <?= $Disability ?></p>
            <?php endif; ?>

            <p><strong>General Condition of Health:</strong> <?= $GeneralCondition ?></p>
            <?php if ($GeneralConditionReason) : ?>
              <p><strong>if not good reason:</strong> <?= $GeneralConditionReason ?></p>
            <?php endif; ?>

            <p><strong>Facebook profile link:</strong> <?= $FBLink ?></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>