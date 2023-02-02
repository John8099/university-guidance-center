<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Referrer = '';
$StudentName = '';
$Email = $this->session->userdata('Email');
$YearSection = '';
$CourseID = '';
$Address = '';
$PhoneNumber = '';
$OtherContact = '';
$Platform = '';
$PreferredTime = '';
$SelectedDate = '';
$Category = '';
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '" . $AppointmentID . "'");
foreach ($query->result() as $row) {
  $Referrer = $row->Referrer;
  $StudentName = $row->StudentName;
  $Email = $row->Email;
  $YearSection = $row->YearSection;
  $CourseID = $row->CourseID;
  $Address = $row->Address;
  $PhoneNumber = $row->PhoneNumber;
  $OtherContact = $row->OtherContact;
  $Platform = $row->Platform;
  $PreferredTime = $row->PreferredTime;
  $SelectedDate = $row->SelectedDate;
  $Category = $row->Category;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Appointment Details</h4>
          </div>
        </div>
        <!-- title -->
        <div class="table-responsive">
          <table id="datatable" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Appointment Schedule</th>
                <th scope="col">Guidance Counselor</th>
                <th scope="col">Status</th>
                <th scope="col">Platform</th>
                <th scope="col">Remarks</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $studentCollegeId = $this->session->userdata('StudentCollegeID');
              $studentUserId = $this->session->userdata('StudentUserID');
              $query = $this->db->query("SELECT 
                                        a.AppointmentID, 
                                        a.StudentName, 
                                        c.College, 
                                        a.YearSection, 
                                        a.SelectedDate, 
                                        a.PreferredTime, 
                                        a.Platform, 
                                        a.Status, 
                                        a.Remarks, 
                                        a.CreatedBy, 
                                        a.AppointmentSchedID 
                                        FROM tblappointment a 
                                        INNER JOIN tblcollege c
                                        ON 
                                        c.CollegeID=a.CollegeID 
                                        WHERE 
                                        a.CollegeID='$studentCollegeId' and
                                        a.CreatedBy = '$studentUserId' and
                                        a.Status = 'Completed'
                                        ");
              foreach ($query->result() as $row) :
                $tblappointmentsched = $this->db->query("SELECT * FROM tblappointmentsched WHERE AppointmentSchedID='" . $row->AppointmentSchedID . "';");
              ?>
                <tr>
                  <td><?= $row->SelectedDate . ' - ' . $row->PreferredTime; ?></td>
                  <td><?= $this->routines->getUserFullName($tblappointmentsched->row()->CreatedBy); ?></td>
                  <td><?= $row->Status; ?></td>
                  <td><?= $row->Platform; ?></td>
                  <td><?= $row->Remarks; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <br></br>
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Wellness Check Details</h4>
          </div>
        </div>
        <!-- title -->
        <div class="table-responsive">
          <table id="datatable2" class="table">
            <thead>
              <tr>
                <th scope="col">Date Taken</th>
                <th scope="col">Wellness Level</th>
                <th scope="col">Sentiment</th>
                <th scope="col">Guidance Counselor</th>
                <th scope="col">Remarks</th>
              </tr>
            </thead>
            <tbody>
              <?php $query = $this->db->query("SELECT * FROM tblresult WHERE CreatedBy=" . $this->session->userdata('StudentUserID') . ";");
              foreach ($query->result() as $row) :
                $wellnessQ = $this->db->query("SELECT * FROM tblwellnesscheck WHERE CreatedBy='$row->WellnessCheckID'");
                $guidanceID = "";
                if ($wellnessQ->num_rows() > 0) {
                  $guidanceID = $wellnessQ->row()->CreatedBy;
                }
              ?>
                <tr>
                  <td><a href="<?= site_url("student/wellness_check/$row->WellnessCheckID/$row->ResultID"); ?>"><?= date('Y-m-d', strtotime($row->CreatedOn)); ?></a></td>
                  <td><?= $row->Remarks; ?></td>
                  <td>
                    <?php if ($row->Results == 'Negative') : ?>
                      <img src="<?= base_url() . 'media/emoj/' ?>Negative.png" alt="Negative" style="width: 100px" />
                    <?php elseif ($row->Results == 'Neutral') : ?>
                      <img src="<?= base_url() . 'media/emoj/' ?>Neutral.png" alt="Neutral" style="width: 100px" />
                    <?php elseif ($row->Results == 'Positive') : ?>
                      <img src="<?= base_url() . 'media/emoj/' ?>Positive.png" alt="Positive" style="width: 100px" />
                    <?php else : ?>
                    <?php endif; ?>
                  </td>
                  <td><?= $guidanceID == "" ? "" : $this->routines->getUserFullName($guidanceID); ?></td>
                  <td><?= $row->Remarks; ?></td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>