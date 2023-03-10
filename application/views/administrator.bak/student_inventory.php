<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">List of Students</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Student Name</th>
                            <th scope="col">College</th>
                            <th scope="col">Course Year and Section</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = $this->db->query("SELECT * FROM tbluser WHERE UserType='Student' AND CollegeID='".$this->session->userdata('AdminCollegeID')."';");

foreach ($query->result() as $row) : ?>
    <tr>
        <td><a href="<?=site_url().'administrator/student_view/'.$row->UserID;?>"><?=$row->Fullname;?></a></td>
        <td><?=$this->routines->getCollege($row->CollegeID);?></td>
        <td><?=$row->Course;?> <?=$row->YearSec;?></td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>