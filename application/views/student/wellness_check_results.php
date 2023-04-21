<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Title = '';
$WellnessType = '';
$NumberQuestion = '';
$EndDate = '';
$CreatedOn = '';
$WellnessCheckID = $this->uri->segment(3);
$result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
foreach ($result->result() as $row) {
  $Title = $row->Title;
  $WellnessType = $row->WellnessType;
  $NumberQuestion = $row->NumberQuestion;
  $EndDate = $row->EndDate;
  $CreatedOn = date('Y-m-d', strtotime($row->CreatedOn));
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <p class="text-center"><?= $Title; ?><br><?= $CreatedOn; ?><br><?= $WellnessType; ?> Assessment</p>

        <?php
        if ($WellnessCheckID != 0) {
          if ($WellnessType == 'Quantitative') {
            $tblresultquan = $this->db->query("SELECT * FROM tblresultquan WHERE WellnessCheckID='" . $WellnessCheckID . "';");
            if ($tblresultquan->num_rows() <> 0) {
        ?>
              <h4 class="text-center">Thank you for taking the Wellness Assessment! Here are your assessment results.</h4>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Wellness Dimension</th>
                    <th scope="col">Ideal Score</th>
                    <th scope="col">Your Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tblresultquan->result() as $row) :
                  ?>
                    <tr>
                      <td><?= $row->Category; ?></td>
                      <td>28</td>
                      <td><strong><?= $row->Score; ?></strong></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php
            }
            ?>
            <div class="row justify-content-center" style="margin-top: 20px">
              <div class="col-md-8 ">
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
            <?php
          } else {
            $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='$WellnessCheckID'");
            if ($tblresult->num_rows() <> 0) {
              $row = $tblresult->row();
            ?>
              <div class="row">
                <!-- column -->
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="results text-center">
                        <?php if ($row->Results == 'Negative') : ?>
                          <img src="<?= base_url() . 'media/emoj/' ?>Negative.png" alt="Negative" />
                          <p style="width: 500px; margin: auto;">
                            We understand that you may be feeling overwhelmed, frustrated, or upset. We want to ensure that you are supported and have the resources to improve your wellbeing. Please let us know if there is anything we can do to help. You can schedule an appointment with us.
                          </p>
                        <?php elseif ($row->Results == 'Neutral') : ?>
                          <img src="<?= base_url() . 'media/emoj/' ?>Neutral.png" alt="Neutral" />
                          <p style="width: 500px; margin: auto;">
                            We hope that you are doing well,we are always here if you want to schedule an appointment with us. Have a Good Day!
                          </p>
                        <?php elseif ($row->Results == 'Positive') : ?>
                          <img src="<?= base_url() . 'media/emoj/' ?>Positive.png" alt="Positive" />
                          <p style="width: 500px; margin: auto;">
                          We are pleased to hear that you are doing well! Our hope is for you to maintain and enhance your well-being. You are invited to book an appointment with us at any time, including right now if you so desire
                          </p>
                        <?php else : ?>
                          <h4 style="text-transform: uppercase;">No Results</h4>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <?php
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>