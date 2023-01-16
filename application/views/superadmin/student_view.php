<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$Fullname='';
$DateBirth='';
$PlaceBirth='';
$SexualOrientation='';
$SexBirth='';
$Nationality='';
$Religion='';
$CivilStatus='';
$Email='';
$MobileNo='';
$TelephoneNo='';
$DSWDHouseholdNo='';
$Disability='';
$Region='';
$Province='';
$MunicipalityCity='';
$Address='';
$Barangay='';
$ZipCode='';
$ACRNo='';
$PlacedIssued='';
$DateIssued='';
$AuthorizedStay='';
$PassportNo='';
$PassportExpixy='';
$DateArrival='';
$VisaType='';
$VisaStatus='';
$IdentifiedGender='';
$BiologicalSex='';
$Course='';
$YearSec='';
$SchoolID='';
$Status='';
$CreatedOn='';
$CreatedBy='';
$CollegeID='';
$UserID=$this->uri->segment(3);
$query=$this->db->query("SELECT * FROM tbluser WHERE UserID = '".$UserID."'");
foreach($query->result() as $row){
$Fullname=$row->Fullname;
$DateBirth=$row->DateBirth;
$PlaceBirth=$row->PlaceBirth;
$SexualOrientation=$row->SexualOrientation;
$SexBirth=$row->SexBirth;
$Nationality=$row->Nationality;
$Religion=$row->Religion;
$CivilStatus=$row->CivilStatus;
$Email=$row->Email;
$MobileNo=$row->MobileNo;
$TelephoneNo=$row->TelephoneNo;
$DSWDHouseholdNo=$row->DSWDHouseholdNo;
$Disability=$row->Disability;
$Region=$row->Region;
$Province=$row->Province;
$MunicipalityCity=$row->MunicipalityCity;
$Address=$row->Address;
$Barangay=$row->Barangay;
$ZipCode=$row->ZipCode;
$ACRNo=$row->ACRNo;
$PlacedIssued=$row->PlacedIssued;
$DateIssued=$row->DateIssued;
$AuthorizedStay=$row->AuthorizedStay;
$PassportNo=$row->PassportNo;
$PassportExpixy=$row->PassportExpixy;
$DateArrival=$row->DateArrival;
$VisaType=$row->VisaType;
$VisaStatus=$row->VisaStatus;
$IdentifiedGender=$row->IdentifiedGender;
$BiologicalSex=$row->BiologicalSex;
$Course=$row->Course;
$YearSec=$row->YearSec;
$SchoolID=$row->SchoolID;
$Status=$row->Status;
$CreatedOn=$row->CreatedOn;
$CreatedBy=$row->CreatedBy;
$CollegeID=$row->CollegeID;
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="font-size: 16px;">
                <div class="d-md-flex">
                    <div>
                        <h4 class="card-title">Student View</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><strong>Full Name:</strong> <?=$Fullname?></p>
                        <p><strong>Date of Birth:</strong> <?=$DateBirth?></p>
                        <p><strong>Sex at Birth:</strong> <?=$SexBirth?></p>
                        <p><strong>Place of Birth:</strong> <?=$PlaceBirth?></p>
                        <p><strong>Sexual Orientation:</strong> <?=$SexualOrientation?></p>
                        <p><strong>Nationality:</strong> <?=$Nationality?></p>
                        <p><strong>Religion:</strong> <?=$Religion?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Civil Status:</strong> <?=$CivilStatus?></p>
                        <p><strong>Mobile No.:</strong> <?=$MobileNo?></p>
                        <p><strong>Telephone No.:</strong> <?=$TelephoneNo?></p>
                        <p><strong>Email Address:</strong> <?=$Email?></p>
                        <p><strong>DSWD Household No:</strong> <?=$DSWDHouseholdNo?></p>
                        <p><strong>Disability:</strong> <?=$Disability?></p>
                    </div>
                </div>
                <hr>
                <div>
                    <h4 class="card-title">Permanent Address</h4>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><strong>Region:</strong> <?=$Region?></p>
                        <p><strong>Province:</strong> <?=$DateBirth?></p>
                        <p><strong>Municipality / City:</strong> <?=$MunicipalityCity?></p>
                        <p><strong>Complete Address:</strong> <?=$Address?></p>
                        <p><strong>Barangay:</strong> <?=$Barangay?></p>
                        <p><strong>Zip Code:</strong> <?=$ZipCode?></p>
                    </div>
                </div>
                <hr>
                <div>
                    <h4 class="card-title">For Foreign Student Only</h4>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p><strong>If alien, ACR No.:</strong> <?=$ACRNo?></p>
                        <p><strong>Placed Issued:</strong> <?=$PlacedIssued?></p>
                        <p><strong>Date Issued:</strong> <?=$DateIssued?></p>
                        <p><strong>Authorized Stay:</strong> <?=$AuthorizedStay?></p>
                        <p><strong>Passport No.:</strong> <?=$PassportNo?></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Passport Expixy:</strong> <?=$PassportExpixy?></p>
                        <p><strong>Date of Arrival:</strong> <?=$DateArrival?></p>
                        <p><strong>Visa Type:</strong> <?=$VisaType?></p>
                        <p><strong>Visa Status:</strong> <?=$VisaStatus?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>