<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Title='';
$WellnessType='';
$NumberQuestion='';
$EndDate='';
$CreatedOn ='';
$WellnessCheckID=$this->uri->segment(3);
$result=$this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '".$WellnessCheckID."'");
foreach($result->result() as $row){
    $Title=$row->Title;
    $WellnessType=$row->WellnessType;
    $NumberQuestion=$row->NumberQuestion;
    $EndDate=$row->EndDate;
    $CreatedOn=date('Y-m-d', strtotime($row->CreatedOn));
}
$TotalIdealScore=0;
?>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <p class="text-center"><?=$Title;?><br><?=$CreatedOn;?><br><?=$WellnessType;?> Assessment</p>

<?php
if ($WellnessCheckID!=0) {
    if ($WellnessType=='Quantitative') {
        $tblresultquan = $this->db->query("SELECT * FROM tblresultquan WHERE WellnessCheckID='".$WellnessCheckID."';");
        if($tblresultquan->num_rows()<>0) {
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
                    <?php foreach ($tblresultquan->result() as $row):
                        $TotalIdealScore=$TotalIdealScore+$row->IdealScore;
                    ?>
                    <tr>
                        <td><?=$row->Category;?></td>
                        <td><?=$row->IdealScore;?></td>
                        <td><?=$row->Score;?></td>
                    </tr>
                    <?php endforeach; ?>
                        </tbody>
                </table>
<?php
        }
        $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='".$WellnessCheckID."';");
        if($tblresult->num_rows()<>0) {
            echo '<h1>Total: '.$tblresult->row()->QScore.'</h1>';
            $totalres=$tblresult->row()->QScore/$TotalIdealScore;
            $totalres=round($totalres*100);
            if($totalres>=80 && $totalres<=100) {
                echo '<h4>Awesome! Your answers indicate that you\'re making positive steps in this dimension of wellness. Even though you achieved a high overall score for this dimension, you may want to check for low scores on individual items to see if there are more specific areas that you might want to address. Consider focusing on another area where your scores weren\'t so high.</h4>';
            } elseif($totalres>=30 && $totalres<=79) {
                echo '<h4>Caution! Your behaviours in this area are good, but there is room
                        for improvement. Take a look at the items on which you scored lower. What changes
                        might you make it to improve your score?</h4>';

            } else {
                echo '<h4>Danger! Your answers indicate some potential health and
                        well-being risks. Review those areas where you scored lower.</h4>';

            }
        }
    } else {
        $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='".$WellnessCheckID."';");
        if($tblresult->num_rows()<>0) {
            $row=$tblresult->row();
?>
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="results text-center">
                    <?php if ($row->Results=='Negative'): ?>
                        <h4 style="text-transform: uppercase;">Your result is</h4>
                        <img src="<?=base_url().'media/emoj/'?>Negative.png" alt="Negative" />
                    <?php elseif($row->Results=='Neutral'): ?>
                        <h4 style="text-transform: uppercase;">Your result is</h4>
                        <img src="<?=base_url().'media/emoj/'?>Neutral.png" alt="Neutral" />
                    <?php elseif($row->Results=='Positive'): ?>
                        <h4 style="text-transform: uppercase;">Your result is</h4>
                        <img src="<?=base_url().'media/emoj/'?>Positive.png" alt="Positive" />
                    <?php else: ?>
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