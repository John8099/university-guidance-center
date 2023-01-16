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
                        <h4 class="card-title">Student List</h4>
                    </div>
                    <div class="ms-auto">
                        <a href="<?=site_url().'administrator/assessment';?>" type="button" class="d-none btn btn-outline-success btn-sm" title="Create Assessment">Create</a>
                    </div>
                </div>
                <!-- title -->
            </div>
            <div class="table-responsive">
                
            <table id="datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Student Name</th>
                            <th scope="col">College</th>
                            <th scope="col">Course</th>
                            <th scope="col">Year & Section</th>
                            <th scope="col">Email</th>
                            <th scope="col">Identified Gender</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = $this->db->query("SELECT * FROM tbluser WHERE UserType = 'Student' AND CollegeID='".$this->session->userdata('AdminCollegeID')."';");

foreach ($query->result() as $row) : 

?>
    <tr>
        <td><?=$row->Fullname;?></td>
        <td><?=$this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '".$row->CollegeID."';")->row()->College;?></td>
        <td><?=$row->Course;?></td>
        <td><?=$row->YearSec;?></td>
        <td><?=$row->Email;?></td>
        <td><?=($row->IdentifiedGender==1) ? 'Male' : 'Female';?></td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>