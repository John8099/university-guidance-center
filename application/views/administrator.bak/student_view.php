<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Fullname='';
$Address='';
$IdentifiedGender='';
$BiologicalSex='';
$Course='';
$YearSec='';
$Email='';
$SchoolID='';
$UserID=$this->uri->segment(3);
$tbluser=$this->db->query("SELECT * FROM tbluser WHERE UserID = '".$UserID."'");
foreach($tbluser->result() as $row){
$Fullname=$row->Fullname;
$Address=$row->Address;
$IdentifiedGender=$row->IdentifiedGender;
$BiologicalSex=$row->BiologicalSex;
$Course=$row->Course;
$YearSec=$row->YearSec;
$Email=$row->Email;
$SchoolID=$row->SchoolID;
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Student View</h4>
                    </div>
                </div>
                <p><strong>Full Name:</strong> <?=$Fullname?></p>
            </div>
        </div>
    </div>
</div>