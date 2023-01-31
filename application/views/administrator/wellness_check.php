<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Title = '';
$WellnessType = '';
$NumberQuestion = '7';
$numberCategory = '';
$EndDate = '';
$CreatedOn = '';
$WellnessCheckID = $this->uri->segment(3);
$result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
foreach ($result->result() as $row) {
  $Title = $row->Title;
  $WellnessType = $row->WellnessType;
  $NumberQuestion = $row->NumberQuestion;
  $EndDate = $row->EndDate;
  $numberCategory = $row->numberOfCategory;
  $CreatedOn = date('Y-m-d', strtotime($row->CreatedOn));
}
?>
<div class="row">
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?= site_url() . 'administrator/wellness_check_save/' . $WellnessCheckID ?>" class="form-horizontal form-material mx-2">
          <?= $this->routines->InsertCSRF() ?>
          <div class="row">
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <div class="form-group">
                <label for="txtTitle" class="col-md-12">Title</label>
                <div class="col-md-12">
                  <input name='txtTitle' id="txtTitle" type="text" placeholder="Enter title here" class="form-control form-control-line" value="<?= $Title; ?>" required />
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <div class="form-group">
                <label class="col-md-12">Date</label>
                <div class="col-md-12">
                  <input name='txtDate' type="date" class="form-control form-control-line" value="<?= $CreatedOn; ?>" required />
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <div class="form-group">
                <label class="col-md-12">Date</label>
                <div class="col-md-12">
                  <select class="form-control form-control-line" name="txtEndDate" required id="txtEndDate">
                    <option value="">Select End Date</option>
                    <option value="7" <?= ($EndDate == '7') ? 'selected' : ''; ?>>7 days</option>
                    <option value="15" <?= ($EndDate == '15') ? 'selected' : ''; ?>>15 days</option>
                    <option value="30" <?= ($EndDate == '30') ? 'selected' : ''; ?>>1 month</option>
                    <option value="60" <?= ($EndDate == '60') ? 'selected' : ''; ?>>2 months</option>
                    <option value="90" <?= ($EndDate == '90') ? 'selected' : ''; ?>>3 months</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xlg-12 col-md-12">
              <?php if ($WellnessType != '') : ?>
                <div class="form-group">
                  <label class="col-md-12">Type</label>
                  <div class="col-md-12">
                    <input name='txtType' id="InputType" type="text" class="form-control form-control-line" value="<?= $WellnessType; ?>" readonly />
                  </div>
                </div>
              <?php else : ?>
                <div class="form-group">
                  <label for="txtType" class="col-md-12">Type</label>
                  <div class="col-md-12">
                    <select class="form-control form-control-line" name="txtType" required id="InputType">
                      <option value="">Select Type</option>
                      <option value="Qualitative" <?= ($WellnessType == 'Qualitative') ? 'selected' : ''; ?>>Qualitative</option>
                      <option value="Quantitative" <?= ($WellnessType == 'Quantitative') ? 'selected' : ''; ?>>Quantitative</option>
                    </select>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-lg-12 col-xlg-12 col-md-12" style="display: none" id="divCategory">
              <div class="form-group">
                <label class="col-md-12">Number of Category</label>

                <div class="col-md-12">
                  <input name='textNumberCategory' min="1" max="7" type="number" placeholder="Enter total number of category here" class="form-control form-control-line" value="<?= $numberCategory; ?>" required />
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-xlg-12 col-md-12" style="display: none" id="divNumQuestions">
              <div class="form-group">
                <label class="col-md-12">Number of Questions</label>

                <div class="col-md-12">
                  <input name='txtNumberQuestion' min="1" type="number" placeholder="Enter total number of questions here" class="form-control form-control-line" value="<?= $NumberQuestion; ?>" required />
                </div>
              </div>
            </div>


            <?php
            $count = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='$WellnessCheckID'")->num_rows();
            if ($count == 0) :
            ?>
              <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="form-group">
                  <label class="col-md-12">&nbsp;</label>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success w-100">Add Question</button>
                  </div>
                </div>
              </div>
            <?php
            endif;
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $("#InputType").ready(function() {
    if ($("#InputType").val().toLowerCase() === "quantitative") {
      $("input[name='txtNumberQuestion']").prop("required", false)
      $("input[name='txtNumberQuestion']").val("7")

      $("input[name='textNumberCategory']").prop("required", true)

      $("#divCategory").show();
      $("#divNumQuestions").hide();

    } else if ($("#InputType").val().toLowerCase() === "qualitative") {
      $("input[name='textNumberCategory']").prop("required", false)
      $("input[name='textNumberCategory']").val("")

      $("input[name='txtNumberQuestion']").prop("required", true)

      $("#divCategory").hide();
      $("#divNumQuestions").show();


    } else {
      $("#divCategory").hide();
      $("#divNumQuestions").hide();

      $("input[name='textNumberCategory']").prop("required", false)
      $("input[name='txtNumberQuestion']").prop("required", false)

    }
  })

  $("#InputType").on("change", function(e) {
    if (e.target.value.toLowerCase() === "quantitative") {
      $("input[name='txtNumberQuestion']").prop("required", false)
      $("input[name='txtNumberQuestion']").val("7")

      $("input[name='textNumberCategory']").prop("required", true)

      $("#divCategory").show();
      $("#divNumQuestions").hide();

    } else {
      $("input[name='txtNumberQuestion']").prop("required", true)
      $("input[name='txtNumberQuestion']").val("")

      $("input[name='textNumberCategory']").prop("required", false)

      $("#divCategory").hide();
      $("#divNumQuestions").show();

    }
  })
</script>
<?php
if ($WellnessCheckID != 0) {
  if ($WellnessType == 'Quantitative') {
    $tblwellnessquestionCategory = $this->db->query("SELECT DISTINCT Category FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "';");
    if ($tblwellnessquestionCategory->num_rows() <> 0) {

      foreach ($tblwellnessquestionCategory->result() as $CategoryRow) :
?>
        <div class="row">
          <!-- column -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                  <div>
                    <h4 class="card-title"><?= $CategoryRow->Category; ?> Questions</h4>
                  </div>
                </div>
                <!-- title -->
              </div>
              <div class="table-responsive">

                <table id="" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Question</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "' AND Category='" . $CategoryRow->Category . "';");
                    foreach ($tblwellnessquestion->result() as $row) : ?>
                      <tr>
                        <td><?= $row->Question; ?></td>
                        <td>
                          <a href="<?= site_url() . 'administrator/wellness_question_update/' . $WellnessCheckID . '/' . $row->QuestionID; ?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px; margin: .25rem">Edit</a>
                          <a href="<?= site_url() . 'administrator/wellness_question_delete/' . $WellnessCheckID . '/' . $row->QuestionID; ?>" class="btn btn-outline-danger btn-sm" title="Delete" style="width: 100px; margin: .25rem">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php
      endforeach;
    }
  } else {
    $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "' AND Category='NONE';");

    if ($tblwellnessquestion->num_rows() <> 0) {
      ?>
      <div class="row">
        <!-- column -->
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <!-- title -->
              <div class="d-md-flex">
                <div>
                  <h4 class="card-title">Qualitative Questions</h4>
                </div>
              </div>
              <!-- title -->
            </div>
            <div class="table-responsive">

              <table id="" class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($tblwellnessquestion->result() as $row) : ?>
                    <tr>
                      <td><?= $row->Question; ?></td>
                      <td>
                        <a href="<?= site_url() . 'administrator/wellness_question_update/' . $WellnessCheckID . '/' . $row->QuestionID; ?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px; margin: .25rem">Edit</a>
                        <a href="<?= site_url() . 'administrator/wellness_question_delete/' . $WellnessCheckID . '/' . $row->QuestionID; ?>" class="btn btn-outline-danger btn-sm" title="Delete" style="width: 100px; margin: .25rem">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?php
    }
  }
}
?>