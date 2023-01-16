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
$UserID=$this->session->userdata('StudentUserID');
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
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?=site_url().'student/profile_save/'.$UserID?>" class="form-horizontal form-material mx-2">
                    <?=$this->routines->InsertCSRF()?>
                    <!-- First Section -->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtFullname" class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input name='txtFullname' type="text" placeholder="Enter full name here" class="form-control form-control-line" value="<?=$Fullname;?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDateBirth" class="col-md-12">Date of Birth</label>
                            <div class="col-md-12">
                                <input name='txtDateBirth' type="date" placeholder="Enter date of birth here" class="form-control form-control-line" value="<?=$DateBirth;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtSexBirth" class="col-md-12">Sex at Birth</label>
                            <label class="containeroption">Male
                                <input type="radio" <?=($SexBirth=='Male') ? 'checked="checked"' : '';?> name="txtSexBirth" value='Male'>
                                <span class="checkmark"></span>
                            </label>
                            <label class="containeroption">Female
                                <input type="radio" <?=($SexBirth=='Female') ? 'checked="checked"' : '';?> name="txtSexBirth"value='Female'>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="txtPlaceBirth" class="col-md-12">Place of Birth</label>
                            <div class="col-md-12">
                                <input name='txtPlaceBirth' type="text" placeholder="Enter place of birth here" class="form-control form-control-line" value="<?=$PlaceBirth;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtSexualOrientation" class="col-md-12">Sexual Orientation</label>
                            <div class="col-md-12">
                                <div class="custom-select">
                                <select class="form-control form-control-line" name="txtSexualOrientation">
                                    <option value="" selected hidden>Select Sexual Orientation</option>
                                    <option value="Straight" <?=($SexualOrientation=='Straight') ? ' selected' : '';?>>Straight</option>
                                    <option value="Lesbian" <?=($SexualOrientation=='Lesbian') ? ' selected' : '';?>>Lesbian</option>
                                    <option value="Gay" <?=($SexualOrientation=='Gay') ? ' selected' : '';?>>Gay</option>
                                    <option value="Bi-Sexual" <?=($SexualOrientation=='"Bi-Sexual') ? ' selected' : '';?>>Bi-Sexual</option>
                                    <option value="Transgender" <?=($SexualOrientation=='Transgender') ? ' selected' : '';?>>Transgender</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtNationality" class="col-md-12">Nationality</label>
                            <div class="col-md-12">
                                <input name='txtNationality' type="text" placeholder="Enter nationality here" class="form-control form-control-line" value="<?=$Nationality;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtReligion" class="col-md-12">Religion</label>
                            <div class="col-md-12">
                                <input name='txtReligion' type="text" placeholder="Enter religion here" class="form-control form-control-line" value="<?=$Religion;?>" />
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtCivilStatus" class="col-md-12">Civil Status</label>
                            <div class="col-md-12">
                                <input name='txtCivilStatus' type="text" placeholder="Enter civil status here" class="form-control form-control-line" value="<?=$CivilStatus;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtMobileNo" class="col-md-12">Mobile No.</label>
                            <div class="col-md-12">
                                <input name='txtMobileNo' type="text" placeholder="Enter Mobile No. here" class="form-control form-control-line" value="<?=$MobileNo;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtTelephoneNo" class="col-md-12">Telephone No.</label>
                            <div class="col-md-12">
                                <input name='txtTelephoneNo' type="text" placeholder="Enter Telephone No. here" class="form-control form-control-line" value="<?=$TelephoneNo;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtEmail" class="col-md-12">Email Address</label>
                            <div class="col-md-12">
                                <input name='txtEmail' type="text" placeholder="Enter email here" class="form-control form-control-line" value="<?=$Email;?>" readonly="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDSWDHouseholdNo" class="col-md-12">DSWD Household No.</label>
                            <div class="col-md-12">
                                <input name='txtDSWDHouseholdNo' type="text" placeholder="Enter DSWD Household No. here" class="form-control form-control-line" value="<?=$DSWDHouseholdNo;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDisability" class="col-md-12">Disability</label>
                            <div class="col-md-12">
                                <input name='txtDisability' type="text" placeholder="Enter Disability here" class="form-control form-control-line" value="<?=$Disability;?>" />
                            </div>
                        </div>
                      </div>
                    </div>
                    <br></br>
                    <div class="row">
                      <div class="col-md-6">
                        <h3>Permanent Address</h3>
                        <div class="form-group">
                            <label for="txtRegion" class="col-md-12">Region</label>
                            <div class="col-md-12">
                                <input name='txtRegion' type="text" placeholder="Enter Region here" class="form-control form-control-line" value="<?=$Region;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtProvince" class="col-md-12">Province</label>
                            <div class="col-md-12">
                                <input name='txtProvince' type="text" placeholder="Enter Province here" class="form-control form-control-line" value="<?=$Province;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtMunicipalityCity" class="col-md-12">Municipality / City</label>
                            <div class="col-md-12">
                                <input name='txtMunicipalityCity' type="text" placeholder="Enter Municipality / City here" class="form-control form-control-line" value="<?=$MunicipalityCity;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtAddress" class="col-md-12">Complete Address</label>
                            <div class="col-md-12">
                                <input name='txtAddress' type="text" placeholder="Enter Complete Address here" class="form-control form-control-line" value="<?=$Address;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtBarangay" class="col-md-12">Barangay</label>
                            <div class="col-md-12">
                                <input name='txtBarangay' type="text" placeholder="Enter Barangay here" class="form-control form-control-line" value="<?=$Barangay;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtZipCode" class="col-md-12">Zip Code</label>
                            <div class="col-md-12">
                                <input name='txtZipCode' type="text" placeholder="Enter Zip Code here" class="form-control form-control-line" value="<?=$ZipCode;?>" />
                            </div>
                        </div>
                      </div>
                    </div>
                    <br></br>
                    <div class="row">
                      <div class="col-md-6">
                        <h3>For Foreign Student Only</h3>
                        <div class="form-group">
                            <label for="txtACRNo" class="col-md-12">If alien, ACR No.</label>
                            <div class="col-md-12">
                                <input name='txtACRNo' type="text" placeholder="Enter ACR No. here" class="form-control form-control-line" value="<?=$ACRNo;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPlacedIssued" class="col-md-12">Placed Issued</label>
                            <div class="col-md-12">
                                <input name='txtPlacedIssued' type="text" placeholder="Enter Placed Issued here" class="form-control form-control-line" value="<?=$PlacedIssued;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDateIssued" class="col-md-12">Date Issued</label>
                            <div class="col-md-12">
                                <input name='txtDateIssued' type="text" placeholder="Enter Date Issued here" class="form-control form-control-line" value="<?=$DateIssued;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtAuthorizedStay" class="col-md-12">Authorized Stay</label>
                            <div class="col-md-12">
                                <input name='txtAuthorizedStay' type="text" placeholder="Enter Authorized Stay here" class="form-control form-control-line" value="<?=$AuthorizedStay;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPassportNo" class="col-md-12">Passport No.</label>
                            <div class="col-md-12">
                                <input name='txtPassportNo' type="text" placeholder="Enter Passport No. here" class="form-control form-control-line" value="<?=$PassportNo;?>" />
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtPassportExpixy" class="col-md-12">Passport Expixy</label>
                            <div class="col-md-12">
                                <input name='txtPassportExpixy' type="text" placeholder="Enter Passport Expixy here" class="form-control form-control-line" value="<?=$PassportExpixy;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDateArrival" class="col-md-12">Date of Arrival</label>
                            <div class="col-md-12">
                                <input name='txtDateArrival' type="text" placeholder="Enter Date of Arrival here" class="form-control form-control-line" value="<?=$DateArrival;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtVisaType" class="col-md-12">Visa Type</label>
                            <div class="col-md-12">
                                <input name='txtVisaType' type="text" placeholder="Enter Visa Type here" class="form-control form-control-line" value="<?=$VisaType;?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtVisaStatus" class="col-md-12">Visa Status</label>
                            <div class="col-md-12">
                                <input name='txtVisaStatus' type="text" placeholder="Enter Visa Status here" class="form-control form-control-line" value="<?=$VisaStatus;?>" />
                            </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 text-white">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>