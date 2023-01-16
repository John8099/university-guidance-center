<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <!-- column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Wellness Check List</h4>
                    </div>
                    <div class="ms-auto">
                        <a href="<?=site_url().'administrator/assessment';?>" type="button" class="btn btn-outline-success btn-sm" title="Create Wellness Check" style="width: 100px;">Create</a>
                    </div>
                </div>
                <!-- title -->
            </div>
            <div class="table-responsive">
                
            <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Assessment Name</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = $this->db->query("SELECT * FROM tblassessment;");

foreach ($query->result() as $row) : ?>
    <tr>
        <td><?=$row->Assessment;?></td>
        <td><?=$row->Semester;?></td>
        <td><?=$row->Status;?></td>
        <td>
        <?php if($row->Status=='Active') : ?>
            <a href="<?=site_url().'administrator/set_status_assessment/'.$row->AssessmentID.'/Inactive';?>" class="btn btn-outline-warning btn-sm" title="Set Inactive" style="width: 100px;">Set Inactive</a>
        <?php else: ?>
            <a href="<?=site_url().'administrator/set_status_assessment/'.$row->AssessmentID.'/Active';?>" class="btn btn-outline-warning btn-sm" title="Set Active" style="width: 100px;">Set Active</a>
        <?php endif; ?>
            <a href="<?=site_url().'administrator/assessment/'.$row->AssessmentID;?>" class="btn btn-outline-primary btn-sm" title="Edit" style="width: 100px;">Edit</a>
        </td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>