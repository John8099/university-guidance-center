<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Title = '';
$WellnessType = '';
$NumberQuestion = 0;
$WellnessCheckID = $this->uri->segment(3);
$result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
foreach ($result->result() as $row) {
  $Title = $row->Title;
  $WellnessType = $row->WellnessType;
  $NumberQuestion = $row->NumberQuestion;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?= site_url() . 'administrator/wellness_question_save/' . $WellnessCheckID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <?php if ($WellnessType == 'Quantitative') : ?>
            <h2>Quantitative Questions</h2>
            <?php for ($i = 1; $i <= $NumberQuestion; $i++) : ?>
              <?php
              $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID = '" . $WellnessCheckID . "' AND QuestionNumber = '" . $i . "' AND WellnessType = '" . $WellnessType . "';")->row();
              ?>
              <div class="form-group">
                <label class="col-md-12">Question <?= $i; ?></label>
                <div class="col-md-12">
                  <input name='txtQuestion<?= $i; ?>' type="text" placeholder="Enter Question <?= $i; ?> here" class="form-control form-control-line" value="<?= (isset($tblwellnessquestion->Question) ? $tblwellnessquestion->Question : ''); ?>" required />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-12">Category for Question <?= $i; ?></label>
                <div class="col-md-12">
                  <input name='txtCategory<?= $i; ?>' type="text" placeholder="Enter Category for Question <?= $i; ?> here" class="form-control form-control-line" value="<?= (isset($tblwellnessquestion->Category) ? $tblwellnessquestion->Category : ''); ?>" />
                </div>
              </div>
              <hr>
            <?php endfor; ?>
          <?php else : ?>
            <h2>Qualitative Questions</h2>
            <?php for ($i = 1; $i <= $NumberQuestion; $i++) : ?>
              <?php
              $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID = '" . $WellnessCheckID . "' AND QuestionNumber = '" . $i . "' AND WellnessType = '" . $WellnessType . "';")->row();
              ?>
              <div class="form-group">
                <label class="col-md-12">Question <?= $i; ?></label>
                <div class="col-md-12">
                  <input name='txtQuestion<?= $i; ?>' type="text" placeholder="Enter Question <?= $i; ?> here" class="form-control form-control-line" value="<?= (isset($tblwellnessquestion->Question) ? $tblwellnessquestion->Question : ''); ?>" required />
                </div>
              </div>
              <div class="form-group d-none">
                <label class="col-md-12">Category for Question <?= $i; ?></label>
                <div class="col-md-12">
                  <input name='txtCategory<?= $i; ?>' type="text" placeholder="Enter Category for Question <?= $i; ?> here" class="form-control form-control-line" value="<?= (isset($tblwellnessquestion->Category) ? $tblwellnessquestion->Category : 'None'); ?>" />
                </div>
              </div>
              <hr>
            <?php endfor; ?>
          <?php endif; ?>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>