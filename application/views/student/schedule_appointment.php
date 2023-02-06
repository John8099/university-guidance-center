<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$studentName = "";
$email = "";
$college = "";
$course = "";
$yearSec = "";
$address = "";
$number = "";

$PreferredTime = $this->session->userdata('AppointmentTime');
$SelectedDate = $this->session->userdata('AppointmentDate');

$appointScheduleCreatedBy = $this->uri->segment(3);
$OtherContact = "";
$Category = "";
$Platform = "";

$appointmentId = $this->uri->segment(4);
if ($appointmentId != "") {
  $queryAppointment = $this->db->query("SELECT * FROM tblappointment WHERE AppointmentID='$appointmentId'");

  if ($queryAppointment->num_rows() > 0) {
    $resAppointment = $queryAppointment->row();

    $OtherContact = $resAppointment->OtherContact;
    $Category = $resAppointment->Category;
    $Platform = $resAppointment->Platform;
    $appointScheduleCreatedBy = $resAppointment->CreatedBy;
  }

  if ($appointScheduleCreatedBy != "") {

    $query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '$appointScheduleCreatedBy'");

    if ($query->num_rows() > 0) {
      $res = $query->row();

      $studentName = $this->routines->getUserFullName($res->UserID);
      $email = $res->Email;
      $college = $this->routines->getCollege($res->CollegeID);
      $course = $res->Course;
      $yearSec = $res->YearSec;
      $address = $res->Address;
      $number = $res->MobileNo;
    }
  }
} else {
  $userID = $this->session->userdata("StudentUserID");
  $query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '$userID'");

  if ($query->num_rows() > 0) {
    $res = $query->row();

    $studentName = $this->routines->getUserFullName($res->UserID);
    $email = $res->Email;
    $college = $this->routines->getCollege($res->CollegeID);
    $course = $res->Course;
    $yearSec = $res->YearSec;
    $address = $res->Address;
    $number = $res->MobileNo;
  }
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </symbol>
          <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
          </symbol>
          <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </symbol>
        </svg>

        <div class="alert alert-primary d-flex align-items-center d-none" role="alert" id="alertprimary">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
          </svg>
          <div>
            Student referral successful.
          </div>
        </div>
        <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
          </svg>
          <div>
            Student referral successful.
          </div>
        </div>
        <div class="alert alert-warning d-flex align-items-center d-none" role="alert" id="alertwarning">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
            <use xlink:href="#exclamation-triangle-fill" />
          </svg>
          <div>
            Student referral failed, please try again.
          </div>
        </div>
        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
          </svg>
          <div>
            Student referral failed, please try again.
          </div>
        </div>

        <form method="post" id="formAppointmentSave" action="<?= site_url() . 'student/appointment_save/' . $appointmentId ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <input type="text" name="txtAppointScheduleBy" value="<?= $appointScheduleCreatedBy ?>"  readonly>

          <div class="form-group">
            <label class="col-md-12">Student Name</label>
            <div class="col-md-12">
              <input name='txtStudentName' type="text" placeholder="Enter student name here" class="form-control form-control-line" value="<?= $studentName; ?>" required readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Student Email</label>
            <div class="col-md-12">
              <input name='txtEmail' type="text" placeholder="Enter student email here" class="form-control form-control-line" value="<?= $email; ?>" required readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">College</label>
            <div class="col-md-12">
              <div class="custom-select">
                <input name='txtCollege' type="text" placeholder="Enter student email here" class="form-control form-control-line" value="<?= $college; ?>" required readonly />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Course Year and Section</label>
            <div class="col-md-12">
              <input name='txtYearSection' type="text" placeholder="Enter year and section here" class="form-control form-control-line" value="<?= $course . " " . $yearSec; ?>" required readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Address</label>
            <div class="col-md-12">
              <input name='txtAddress' type="text" placeholder="Enter address here" class="form-control form-control-line" value="<?= $address; ?>" required readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Phone Number</label>
            <div class="col-md-12">
              <input name='txtPhoneNumber' type="text" placeholder="Enter phone number here" class="form-control form-control-line" value="<?= $number; ?>" required readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Other Contact Information</label>
            <div class="col-md-12">
              <textarea name='txtOtherContact' class="form-control form-control-line" placeholder="Enter other contact info here" required <?= $appointmentId == "" ? "" : "readonly" ?>><?= $OtherContact; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Category</label>

            <div class="col-md-12">
              <?php if ($appointmentId == "") : ?>
                <select class="form-select form-control-line" name="txtCategory" required>
                  <option value="" selected hidden>Select Platform</option>
                  <option value="Personal" <?= ($Category == 'Personal') ? 'selected' : ''; ?>>Personal</option>
                  <option value="Social" <?= ($Category == 'Social') ? 'selected' : ''; ?>>Social</option>
                  <option value="Academic" <?= ($Category == 'Academic') ? 'selected' : ''; ?>>Academic</option>
                </select>
              <?php else : ?>
                <input name='txtCategory' type="text" class="form-control form-control-line" value="<?= $Category; ?>" readonly />
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Platform</label>
            <div class="col-md-12">
              <?php if ($appointmentId == "") : ?>
                <select class="form-select form-control-line" name="txtPlatform" required>
                  <option value="" selected hidden>Select Platform</option>
                  <option value="Facebook Messenger" <?= ($Platform == 'Facebook Messenger') ? 'selected' : ''; ?>>Facebook Messenger</option>
                  <option value="Google Meet" <?= ($Platform == 'Google Meet') ? 'selected' : ''; ?>>Google Meet</option>
                  <option value="Telecounseling" <?= ($Platform == 'Telecounseling') ? 'selected' : ''; ?>>Telecounseling</option>
                  <option value="Face to Face" <?= ($Platform == 'Face to Face') ? 'selected' : ''; ?>>Face to Face</option>
                </select>
              <?php else : ?>
                <input name='txtPlatform' type="text" class="form-control form-control-line" value="<?= $Platform; ?>" readonly />
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Preferred Time</label>
            <div class="col-md-12">
              <input name='txtPreferredTime' type="text" placeholder="Select preferred time here" class="form-control form-control-line" value="<?= $PreferredTime; ?>" id="selectedTime" readonly />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">Select Date</label>
            <div class="col-md-12">
              <input name='txtSelectedDate' type="date" placeholder="Select date here" class="form-control form-control-line" value="<?= $SelectedDate; ?>" id="selectedDate" readonly />
            </div>
          </div>
          <?php if ($appointmentId == "") : ?>
            <button type="button" class="btn btn-primary w-100 text-white" data-bs-toggle="modal" data-bs-target="#studentaddModal">
              Save
            </button>
          <?php else : ?>
            <button type="button" class="btn btn-default w-100 text-white" onclick="return window.history.back()">
              Go back
            </button>
          <?php endif; ?>
          <div class="modal fade" id="studentaddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Saving new appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label>This Privacy Notice is hereby observed in compliance with Republic Act No. 10173 of the Data Privacy Act of 2012 (DPA), implementing its rules and regulations, and other relevant policies, including issuances of the National Privacy Commission. WVSU respects and values your data privacy rights, and makes sure that all personal data collected from you, our stakeholders, are processed in adherence to the general principles of transparency, legitimate purpose, and proportionality. Your information is limited on these purposes only. WVSU will never provide your personal information to third parties for any other purpose. Do you Agree with the data privacy notice?</label>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <!-- <button name="submit" class="btn btn-primary">I agree</button> -->
                  <button type="submit" onclick="return $('#formAppointmentSave').submit()" class="btn btn-primary text-white">I agree</button>
                </div>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $("#selectedTime").val(sessionStorage.getItem("selectedTime"));
  $("#selectedDate").val(sessionStorage.getItem("selectedDate"));
</script>