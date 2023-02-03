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
              <?php
              $studentUserId = $this->session->userdata('StudentUserID');
              $query = $this->db->query("SELECT 
                                                u.UserID AS CreatedBy,
                                                wc.Title AS assessmentTitle,
                                                wc.WellnessType AS wellnessType,
                                                r.CreatedOn AS dateTaken,
                                                r.CreatedBy AS studentId,
                                                wc.CreatedBy AS CreatedById,
                                                r.Remarks as remarks,
                                                wc.WellnessCheckID AS wellnessCheckId,
                                                r.ResultID AS resultId,
                                                r.QScore AS QScore,
                                                r.SScore AS SScore,
                                                r.Results AS Results
                                                FROM
                                                tblresult r
                                                INNER JOIN 
                                                tblwellnesscheck wc
                                                ON
                                                r.WellnessCheckID = wc.WellnessCheckID
                                                INNER JOIN
                                                tbluser u
                                                ON
                                                u.UserID = wc.CreatedBy
                                                WHERE
                                                r.CreatedBy = '$studentUserId'
                                                ");

              foreach ($query->result() as $row) :
              ?>
                <tr data-bs-toggle="modal" data-bs-target="#historyModal<?= $row->resultId ?>">
                  <td>
                    <?= date('Y-m-d', strtotime($row->dateTaken)); ?>
                  </td>
                  <td><?= $row->remarks; ?></td>
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
                  <td><?= $row->CreatedById == "" ? "" : $this->routines->getUserFullName($row->CreatedById); ?></td>

                </tr>
                <div class="modal fade" id="historyModal<?= $row->resultId ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?= $this->routines->getUserFullName($row->studentId) ?> Results</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <?php if ($row->wellnessType == "Quantitative") :
                          $wellnessQCategory = $this->db->query("SELECT DISTINCT Category FROM tblwellnessquestion WHERE WellnessCheckID='$row->wellnessCheckId'");
                        ?>
                          <div class="row">
                            <div class="col-12">
                              <?php
                              foreach ($wellnessQCategory->result() as $CategoryRow) : ?>
                                <h4 class="card-title"><?= $CategoryRow->Category; ?> Questions</h4>
                                <?php

                                $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='$row->wellnessCheckId' AND Category='$CategoryRow->Category'");
                                $AnswerData = '';

                                foreach ($tblwellnessquestion->result() as $wellnessQRow) :
                                  $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='$wellnessQRow->QuestionID'");

                                  if ($tblanswer->num_rows() <> 0) {
                                    $tblanswer = $tblanswer->row();
                                    $AnswerData = $tblanswer->Answer;
                                  }

                                ?>
                                  <p><strong><?= $wellnessQRow->Question; ?></strong></p>
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-3">
                                        <div class="d-flex justify-content-center">
                                          <img src="<?= base_url() . 'media/' ?>emoj/1.webp" style="width:<?= ($AnswerData == 1) ? '60' : '45' ?>px; margin: auto 20px;" />
                                        </div>
                                        <div class="text-center <?= ($AnswerData != 1) ? 'mt-3' : '' ?>">
                                          Never
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex justify-content-center">
                                          <img src="<?= base_url() . 'media/' ?>emoj/2.webp" style="width:<?= ($AnswerData == 2) ? '60' : '45' ?>px; margin: auto 20px;" />
                                        </div>
                                        <div class="text-center <?= ($AnswerData != 2) ? 'mt-3' : '' ?>">
                                          Rarely
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex justify-content-center">
                                          <img src="<?= base_url() . 'media/' ?>emoj/3.webp" style="width:<?= ($AnswerData == 3) ? '60' : '45' ?>px; margin: auto 20px;" />
                                        </div>
                                        <div class="text-center <?= ($AnswerData != 3) ? 'mt-3' : '' ?>">
                                          Sometimes
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="d-flex justify-content-center">
                                          <img src="<?= base_url() . 'media/' ?>emoj/4.webp" style="width:<?= ($AnswerData == 4) ? '60' : '45' ?>px; margin: auto 20px;" />
                                        </div>
                                        <div class="text-center <?= ($AnswerData != 4) ? 'mt-3' : '' ?>">
                                          Usually
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                <?php endforeach; ?>
                              <?php endforeach; ?>
                            </div>
                            <div class="col-12">
                              <?php
                              $tblresultquan = $this->db->query("SELECT * FROM tblresultquan WHERE WellnessCheckID='$row->wellnessCheckId'");
                              if ($tblresultquan->num_rows() <> 0) :
                              ?>
                                <div class="container" style="text-align: center; margin-top: 20px">
                                  <div class="row">
                                    <div class="col-4">Wellness Dimension</div>
                                    <div class="col-4">Ideal Score</div>
                                    <div class="col-4">Score</div>
                                  </div>
                                  <?php foreach ($tblresultquan->result() as $rowResQuantitative) : ?>
                                    <div class="row" style="margin-top: 10px;">
                                      <div class="col-4"><strong><?= $rowResQuantitative->Category; ?></strong></div>
                                      <div class="col-4"><strong><?= $rowResQuantitative->IdealScore; ?></strong></div>
                                      <div class="col-4"><strong><?= $rowResQuantitative->Score; ?></strong></div>
                                    </div>
                                  <?php endforeach; ?>
                                  <div class="row justify-content-center" style="margin-top: 20px; text-align: left;">
                                    <div class="col-md-8">
                                      <p>
                                        <strong>Scores of 20-28:</strong>
                                        <br>
                                        Awesome! Your answers indicate that you're making
                                        positive steps in this dimension of wellness. Even though you achieved a high
                                        overall score for this dimension, you may want to check for low scores on
                                        individual items to see if there are more specific areas that you might want to
                                        address. Consider focusing on another area where your scores weren't so high.
                                        <br><br>
                                        <strong>Scores of 15-19:</strong>
                                        <br>
                                        Caution! Your behaviours in this area are good, but there is room
                                        for improvement. Take a look at the items on which you scored lower. What changes
                                        might you make it to improve your score?
                                        <br><br>
                                        <strong>Scores of 14 and below:</strong>
                                        <br>
                                        Danger! Your answers indicate some potential health and
                                        well-being risks. Review those areas where you scored lower.

                                      </p>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              endif;
                              ?>
                            </div>
                          </div>
                        <?php else : ?>
                          <div class="row">
                            <div class="col-12">
                              <div class="text-center">
                                <h3 class="mb-3">Sentiment:</h3>
                                <?php if ($row->Results == 'Negative') : ?>
                                  <!-- <h4 style="text-transform: uppercase;"><?= $row->Results ?></h4> -->
                                  <img src="<?= base_url() . 'media/emoj/' ?>Negative.png" alt="Negative" />
                                  <p>
                                    We understand that you may be feeling overwhelmed, frustrated, or upset. We want to ensure that you are supported and have the resources to improve your wellbeing. Please let us know if there is anything we can do to help. You can schedule an appointment with us.
                                  </p>
                                <?php elseif ($row->Results == 'Neutral') : ?>
                                  <!-- <h4 style="text-transform: uppercase;"><?= $row->Results ?></h4> -->
                                  <img src="<?= base_url() . 'media/emoj/' ?>Neutral.png" alt="Neutral" />
                                  <p>
                                    We hope that you are doing well,we are always here if you want to schedule an appointment with us. Have a Good Day!
                                  </p>
                                <?php elseif ($row->Results == 'Positive') : ?>
                                  <!-- <h4 style="text-transform: uppercase;"><?= $row->Results ?></h4> -->
                                  <img src="<?= base_url() . 'media/emoj/' ?>Positive.png" alt="Positive" />
                                  <p>
                                    We are happy to know that you are doing well! We hope that you will be able to continue and improve your wellbeing. You are always welcome to schedule an appointment with us, even right now if you wish.
                                  </p>
                                <?php else : ?>
                                  <h4 style="text-transform: uppercase;">No Results</h4>
                                <?php endif; ?>
                              </div>
                            </div>
                            <div class="col-12">
                              <h4>Questions</h4>
                              <?php
                              $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $row->wellnessCheckId . "' AND Category='NONE';");

                              if ($tblwellnessquestion->num_rows() <> 0) :

                                $AnswerData = '';
                                foreach ($tblwellnessquestion->result() as $wellnessQuestion) :
                                  $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='" . $wellnessQuestion->QuestionID . "';");
                                  if ($tblanswer->num_rows() <> 0) {
                                    $tblanswer = $tblanswer->row();
                                    $AnswerData = $tblanswer->Answer;
                                  }
                              ?>
                                  <div class="form-group">
                                    <label for="txtAnswer<?= $wellnessQuestion->QuestionID; ?>" class="col-md-12"><?= $wellnessQuestion->Question; ?></label>
                                    <div class="col-md-12">
                                      <input name='txtAnswer<?= $wellnessQuestion->QuestionID; ?>' type="text" placeholder="Enter your answer here" class="form-control form-control-line" value="<?= ($AnswerData != '') ? $AnswerData : '' ?>" readonly />
                                    </div>
                                  </div>
                              <?php endforeach;
                              endif;
                              ?>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>