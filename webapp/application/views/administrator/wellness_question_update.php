<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Question = '';
$Category = '';
$WellnessType = '';
$WellnessCheckID = $this->uri->segment(3);
$QuestionID = $this->uri->segment(4);
$result = $this->db->query("SELECT * FROM tblwellnessquestion WHERE QuestionID = '" . $QuestionID . "'");
foreach ($result->result() as $row) {
  $Question = $row->Question;
  $Category = $row->Category;
  $WellnessType = $row->WellnessType;
}
?>

<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?= site_url() . 'administrator/wellness_question_update_save/' . $WellnessCheckID . '/' . $QuestionID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <?php if ($WellnessType == 'Quantitative') : ?>
            <h2>Quantitative Questions</h2>
            <div class="form-group">
              <label class="col-md-12">Category</label>
              <div class="col-md-12">
                <select class="form-select form-control-line" name="txtCategory" required id="txtCategory">
                  <option value="">Select Category</option>
                  <option value="Emotional Wellness" <?= ($Category == 'Emotional Wellness') ? 'selected' : ''; ?>>Emotional Wellness</option>
                  <option value="Environmental Wellness" <?= ($Category == 'Environmental Wellness') ? 'selected' : ''; ?>>Environmental Wellness</option>
                  <option value="Intellectual Wellness" <?= ($Category == 'Intellectual Wellness') ? 'selected' : ''; ?>>Intellectual Wellness</option>
                  <option value="Occupational Wellness" <?= ($Category == 'Occupational Wellness') ? 'selected' : ''; ?>>Occupational Wellness</option>
                  <option value="Physical Wellness" <?= ($Category == 'Physical Wellness') ? 'selected' : ''; ?>>Physical Wellness</option>
                  <option value="Social Wellness" <?= ($Category == 'Social Wellness') ? 'selected' : ''; ?>>Social Wellness</option>
                  <option value="Spiritual Wellness" <?= ($Category == 'Spiritual Wellness') ? 'selected' : ''; ?>>Spiritual Wellness</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Question</label>
              <div class="col-md-12">
                <select class="form-control form-control-line" name="txtQuestion" required id="quantiQuestion">
                  <?php
                  $questionQ = $this->db->query("SELECT * FROM tblquestionbank WHERE  Category='Quantitative Questions' and `Status`=1");
                  $hasSelectedQuanti = false;
                  foreach ($questionQ->result() as $quantiQ) {
                    if (strtolower($quantiQ->Question) == strtolower($Question)) {
                      echo "<option value='$quantiQ->Question' selected> " . (ucfirst($quantiQ->Question)) . "</option>";
                      $hasSelectedQuanti = true;
                    } else {
                      echo "<option value='$quantiQ->Question'>" . (ucfirst($quantiQ->Question)) . "</option>";
                    }
                  }
                  ?>
                </select>

              </div>
              <script>
                $("#quantiQuestion").editableSelect();
                const hasSelectedQuestionQuanti = <?= $hasSelectedQuanti ? "true" : "false" ?>;
                if (!hasSelectedQuestionQuanti) {
                  $("#quantiQuestion").val('<?= $Question ?>')
                }
              </script>
            </div>
          <?php else : ?>
            <h2>Qualitative Questions</h2>
            <div class="form-group">
              <label class="col-md-12">Question </label>
              <div class="col-md-12">
                <select class="form-control form-control-line" name="txtQuestion" required id="qualitativeQuestions">
                  <?php
                  $questionQualitativeQ = $this->db->query("SELECT * FROM tblquestionbank WHERE  Category='Sentiment Analysis Questions' and `Status`=1");
                  $hasSelected = false;
                  foreach ($questionQualitativeQ->result() as $qualitativeQuestion) {
                    if (strtolower($qualitativeQuestion->Question) == strtolower($Question)) {
                      echo "<option value='$qualitativeQuestion->Question' selected> " . (ucfirst($qualitativeQuestion->Question)) . "</option>";
                      $hasSelected = true;
                    } else {
                      echo "<option value='$qualitativeQuestion->Question'>" . (ucfirst($qualitativeQuestion->Question)) . "</option>";
                    }
                  }
                  ?>
                </select>
              </div>
              <script>
                $("#qualitativeQuestions").editableSelect();
                const hasSelectedQuestion = <?= $hasSelected ? "true" : "false" ?>;
                if (!hasSelectedQuestion) {
                  $("#qualitativeQuestions").val('<?= $Question ?>')
                }
              </script>
            </div>
          <?php endif; ?>
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" onclick="return window.history.back()">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>