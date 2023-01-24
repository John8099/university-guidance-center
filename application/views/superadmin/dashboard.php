<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$TotalAppointments = 0;
$TotalAppointments = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE Status!='Completed';")->row()->Total;
$CompletedAppointments = 0;
$CompletedAppointments = $this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE Status='Completed';")->row()->Total;
$TotalStudents = 0;
$TotalStudents = $this->db->query("SELECT COUNT(UserID) AS Total FROM tbluser WHERE UserType='Student';")->row()->Total;
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Feeds</h4>
        <div class="feed-widget">
          <ul class="list-style-none feed-body m-0 p-b-20">
            <a href="<?= site_url() . 'superadmin/pending_appointment'; ?>" class="text-info">
              <li class="feed-item">
                <div class="feed-icon bg-info"><i class="mdi mdi-calendar-multiple-check"></i></div>Number of Appointments<span class="ms-auto font-12 text-muted"><?= $TotalAppointments; ?></span>
              </li>
            </a>

            <a href="<?= site_url() . 'superadmin/completed_appointment'; ?>" class="text-success">
              <li class="feed-item">
                <div class="feed-icon bg-success"><i class="mdi mdi-alarm-check"></i></div> Number of Completed Appointment<span class="ms-auto font-12 text-muted"><?= $CompletedAppointments; ?></span>
              </li>
            </a>

            <a href="<?= site_url() . 'superadmin/students'; ?>" class="text-danger">
              <li class="feed-item">
                <div class="feed-icon bg-danger"><i class="mdi mdi-account-multiple"></i></div> Number of registered students<span class="ms-auto font-12 text-muted"><?= $TotalStudents; ?></span>
              </li>
            </a>

            <a href="<?= site_url() . 'superadmin/students'; ?>" class="text-warning">
              <li class="feed-item">
                <div class="feed-icon bg-warning"><i class="mdi mdi-emoticon"></i></div> Number of Students taken the Wellness Check<span class="ms-auto font-12 text-muted"><?= $TotalStudents; ?></span>
              </li>
            </a>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <div id="barChart"></div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <div id="lineChart"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Appointment List</h4>
          </div>
          <div class="ms-auto">
            <div class="dl">
              <select class="form-select shadow-none d-none">
                <option value="0" selected>Monthly</option>
                <option value="1">Daily</option>
                <option value="2">Weekly</option>
                <option value="3">Yearly</option>
              </select>
            </div>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive" style="padding: 20px !important;">

        <table id="dashboardTable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">School ID</th>
              <th scope="col">Student Name</th>
              <th scope="col">College</th>
              <th scope="col">Course Year and Section</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Platform</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $this->db->query("SELECT tblappointment.AppointmentID, tblappointment.CreatedBy AS 'AUser', tblappointment.StudentName, tblcollege.College, tblappointment.YearSection, tblappointment.SelectedDate, tblappointment.PreferredTime, tblappointment.Platform, tblappointment.Status FROM tblappointment INNER JOIN tblcollege ON tblcollege.CollegeID=tblappointment.CollegeID;");

            foreach ($query->result() as $row) : ?>
              <?php
              $SchoolID = $this->db->query("SELECT * FROM tbluser WHERE UserID='" . $row->AUser . "';");
              if ($SchoolID->num_rows() <> 0) {
              ?>
                <tr>
                  <td><?= $SchoolID->row()->SchoolID; ?></td>
                  <td><?= $row->StudentName; ?></td>
                  <td><?= $row->College; ?></td>
                  <td><?= $row->YearSection; ?></td>
                  <td><?= $row->SelectedDate; ?></td>
                  <td><?= $row->PreferredTime; ?></td>
                  <td><?= $row->Platform; ?></td>
                  <td><label class="label <?= ($row->Status == 'Pending') ? 'label-warning' : ''; ?><?= ($row->Status == 'Approved') ? 'label-primary' : ''; ?><?= ($row->Status == 'Endorsed') ? 'label-secondary' : ''; ?><?= ($row->Status == 'Completed') ? 'label-danger' : ''; ?><?= ($row->Status == 'Follow Up') ? 'label-orange' : ''; ?><?= ($row->Status == 'Rescheduled') ? 'label-info' : ''; ?>"><?= $row->Status; ?></label></td>
                </tr>
            <?php
              }
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <!-- title -->
        <div class="d-md-flex">
          <div>
            <h4 class="card-title">Students taken the wellness check assessment</h4>
          </div>
        </div>
        <!-- title -->
      </div>
      <div class="table-responsive" style="padding: 20px !important;">

        <table id="assessmentTable" class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Student name</th>
              <th scope="col">Title</th>
              <th scope="col">Type</th>
              <th scope="col">Date taken</th>
              <th scope="col">Created By</th>
              <th scope="col">Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $assessmentQ = $this->db->query("SELECT 
                                        u.Fullname AS CreatedBy,
                                        wc.Title AS assessmentTitle,
                                        wc.WellnessType AS wellnessType,
                                        r.CreatedOn AS dateTaken,
                                        (SELECT Fullname FROM tbluser WHERE UserID = r.CreatedBy) AS studentFullName,
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
                                        ");

            foreach ($assessmentQ->result() as $row) : ?>
              <tr data-bs-toggle="modal" data-bs-target="#historyModal<?= $row->resultId ?>">
                <td><?= $row->studentFullName; ?></td>
                <td><?= $row->assessmentTitle; ?></td>
                <td><?= $row->wellnessType; ?></td>
                <td><?= date("M d, Y h:i:s A", strtotime($row->dateTaken)) ?></td>
                <td><?= $row->CreatedBy; ?></td>
                <td><?= $row->remarks ? substr($row->remarks, 0, 70) . "..." : "" ?></td>
              </tr>


              <div class="modal fade" id="historyModal<?= $row->resultId ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><?= $row->studentFullName ?> Results</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php if ($row->wellnessType == "Quantitative") :
                        $wellnessQCategory = $this->db->query("SELECT DISTINCT Category FROM tblwellnessquestion WHERE WellnessCheckID='" . $row->wellnessCheckId . "';");
                      ?>
                        <div class="row">
                          <div class="col-12">
                            <?php
                            foreach ($wellnessQCategory->result() as $CategoryRow) : ?>
                              <h4 class="card-title"><?= $CategoryRow->Category; ?> Questions</h4>
                              <?php

                              $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $row->wellnessCheckId . "' AND Category='" . $CategoryRow->Category . "';");
                              $AnswerData = '';
                              foreach ($tblwellnessquestion->result() as $wellnessQRow) :
                                $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='" . $wellnessQRow->QuestionID . "';");
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
                        </div>
                        <h3 style="text-align: right;">Score: <?= $row->QScore ?></h3>
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

            <?php
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>