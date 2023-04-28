<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$JanuaryNEG=0;
$JanuaryNEU=0;
$JanuaryPOS=0;
$JanuaryNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Negative!=0;")->row()->Total;
$JanuaryNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Neutral!=0;")->row()->Total;
$JanuaryPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.Positive!=0;")->row()->Total;
$FebruaryNEG=0;
$FebruaryNEU=0;
$FebruaryPOS=0;
$FebruaryNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Negative!=0;")->row()->Total;
$FebruaryNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Neutral!=0;")->row()->Total;
$FebruaryPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.Positive!=0;")->row()->Total;
$MarchNEG=0;
$MarchNEU=0;
$MarchPOS=0;
$MarchNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Negative!=0;")->row()->Total;
$MarchNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Neutral!=0;")->row()->Total;
$MarchPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.Positive!=0;")->row()->Total;
$AprilNEG=0;
$AprilNEU=0;
$AprilPOS=0;
$AprilNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Negative!=0;")->row()->Total;
$AprilNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Neutral!=0;")->row()->Total;
$AprilPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.Positive!=0;")->row()->Total;
$MayNEG=0;
$MayNEU=0;
$MayPOS=0;
$MayNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Negative!=0;")->row()->Total;
$MayNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Neutral!=0;")->row()->Total;
$MayPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.Positive!=0;")->row()->Total;
$JuneNEG=0;
$JuneNEU=0;
$JunePOS=0;
$JuneNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Negative!=0;")->row()->Total;
$JuneNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Neutral!=0;")->row()->Total;
$JunePOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.Positive!=0;")->row()->Total;
$JulyNEG=0;
$JulyNEU=0;
$JulyPOS=0;
$JulyNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Negative!=0;")->row()->Total;
$JulyNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Neutral!=0;")->row()->Total;
$JulyPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.Positive!=0;")->row()->Total;
$AugustNEG=0;
$AugustNEU=0;
$AugustPOS=0;
$AugustNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Negative!=0;")->row()->Total;
$AugustNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Neutral!=0;")->row()->Total;
$AugustPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.Positive!=0;")->row()->Total;
$SeptemberNEG=0;
$SeptemberNEU=0;
$SeptemberPOS=0;
$SeptemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Negative!=0;")->row()->Total;
$SeptemberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Neutral!=0;")->row()->Total;
$SeptemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.Positive!=0;")->row()->Total;
$OctoberNEG=0;
$OctoberNEU=0;
$OctoberPOS=0;
$OctoberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Negative!=0;")->row()->Total;
$OctoberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Neutral!=0;")->row()->Total;
$OctoberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.Positive!=0;")->row()->Total;
$NovermberNEG=0;
$NovermberNEU=0;
$NovermberPOS=0;
$NovermberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Negative!=0;")->row()->Total;
$NovermberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Neutral!=0;")->row()->Total;
$NovermberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.Positive!=0;")->row()->Total;
$DecemberNEG=0;
$DecemberNEU=0;
$DecemberPOS=0;
$DecemberNEG=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Negative!=0;")->row()->Total;
$DecemberNEU=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Neutral!=0;")->row()->Total;
$DecemberPOS=$this->db->query("SELECT COUNT(tblresult.ResultID) AS Total FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.Positive!=0;")->row()->Total;


$JanuaryResultNEG=0;
$JanuaryResultNEU=0;
$JanuaryResultPOS=0;
$JanuaryResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Negative';")->row()->Total;
$JanuaryResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$JanuaryResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=01 AND tblresult.PolarityScore='Positive';")->row()->Total;

$FebruaryResultNEG=0;
$FebruaryResultNEU=0;
$FebruaryResultPOS=0;
$FebruaryResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Negative';")->row()->Total;
$FebruaryResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$FebruaryResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=02 AND tblresult.PolarityScore='Positive';")->row()->Total;

$MarchResultNEG=0;
$MarchResultNEU=0;
$MarchResultPOS=0;
$MarchResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Negative';")->row()->Total;
$MarchResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$MarchResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=03 AND tblresult.PolarityScore='Positive';")->row()->Total;

$AprilResultNEG=0;
$AprilResultNEU=0;
$AprilResultPOS=0;
$AprilResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Negative';")->row()->Total;
$AprilResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$AprilResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=04 AND tblresult.PolarityScore='Positive';")->row()->Total;

$MayResultNEG=0;
$MayResultNEU=0;
$MayResultPOS=0;
$MayResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Negative';")->row()->Total;
$MayResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$MayResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=05 AND tblresult.PolarityScore='Positive';")->row()->Total;

$JuneResultNEG=0;
$JuneResultNEU=0;
$JuneResultPOS=0;
$JuneResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Negative';")->row()->Total;
$JuneResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$JuneResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=06 AND tblresult.PolarityScore='Positive';")->row()->Total;

$JulyResultNEG=0;
$JulyResultNEU=0;
$JulyResultPOS=0;
$JulyResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Negative';")->row()->Total;
$JulyResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$JulyResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=07 AND tblresult.PolarityScore='Positive';")->row()->Total;

$AugustResultNEG=0;
$AugustResultNEU=0;
$AugustResultPOS=0;
$AugustResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Negative';")->row()->Total;
$AugustResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$AugustResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=08 AND tblresult.PolarityScore='Positive';")->row()->Total;

$SeptemberResultNEG=0;
$SeptemberResultNEU=0;
$SeptemberResultPOS=0;
$SeptemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Negative';")->row()->Total;
$SeptemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$SeptemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=09 AND tblresult.PolarityScore='Positive';")->row()->Total;

$OctoberResultNEG=0;
$OctoberResultNEU=0;
$OctoberResultPOS=0;
$OctoberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Negative';")->row()->Total;
$OctoberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$OctoberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=10 AND tblresult.PolarityScore='Positive';")->row()->Total;

$NovemberResultNEG=0;
$NovemberResultNEU=0;
$NovemberResultPOS=0;
$NovemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Negative';")->row()->Total;
$NovemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$NovemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=11 AND tblresult.PolarityScore='Positive';")->row()->Total;

$DecemberResultNEG=0;
$DecemberResultNEU=0;
$DecemberResultPOS=0;
$DecemberResultNEG=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Negative';")->row()->Total;
$DecemberResultNEU=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Neutral';")->row()->Total;
$DecemberResultPOS=$this->db->query("SELECT COUNT(tblresult.AssessmentID) AS Total, tblresult.AssessmentID FROM tblresult INNER JOIN tbluser ON tbluser.UserID=tblresult.CreatedBy WHERE MONTH(tblresult.CreatedOn)=12 AND tblresult.PolarityScore='Positive';")->row()->Total;
?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="row">
                  <div class="col-12 col-md-5 col-lg-5 col-xl-5">
                        <a class="btn btn-sm elevation-2" href="#" data-toggle="modal"
                        data-target="#add" style="margin-top: 20px;margin-left: 10px;background-color: rgba(131,219,214);"><i
                        class="fa fa-file-excel"></i> export</a>
                     <div class="card">
                        <div class="card-body">
                           <table class="table table-bordered mytable">
                               <thead>
                                 <tr>
                                    <th>Month</th>
                                    <th>Negative</th>
                                    <th>Neutral</th>
                                    <th>Positive</th>
                                 </tr>
                                </thead>
                              <tbody>
                                 <tr>
                                    <td>January</td>
                                    <td><?=$JanuaryResultPOS;?></td>
                                    <td><?=$JanuaryResultPOS;?></td>
                                    <td><?=$JanuaryResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>February</td>
                                    <td><?=$FebruaryResultNEG;?></td>
                                    <td><?=$FebruaryResultNEU;?></td>
                                    <td><?=$FebruaryResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>March</td>
                                    <td><?=$MarchResultNEG;?></td>
                                    <td><?=$MarchResultNEU;?></td>
                                    <td><?=$MarchResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>April</td>
                                    <td><?=$AprilResultNEG;?></td>
                                    <td><?=$AprilResultNEU;?></td>
                                    <td><?=$AprilResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>May</td>
                                    <td><?=$MayResultNEG;?></td>
                                    <td><?=$MayResultNEU;?></td>
                                    <td><?=$MayResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>June</td>
                                    <td><?=$JuneResultNEG;?></td>
                                    <td><?=$JuneResultNEU;?></td>
                                    <td><?=$JuneResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>July</td>
                                    <td><?=$JulyResultNEG;?></td>
                                    <td><?=$JulyResultNEU;?></td>
                                    <td><?=$JulyResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>August</td>
                                    <td><?=$AugustResultNEG;?></td>
                                    <td><?=$AugustResultNEU;?></td>
                                    <td><?=$AugustResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>September</td>
                                    <td><?=$SeptemberResultNEG;?></td>
                                    <td><?=$SeptemberResultNEU;?></td>
                                    <td><?=$SeptemberResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>October</td>
                                    <td><?=$OctoberResultNEG;?></td>
                                    <td><?=$OctoberResultNEU;?></td>
                                    <td><?=$OctoberResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>November</td>
                                    <td><?=$NovemberResultNEG;?></td>
                                    <td><?=$NovemberResultNEU;?></td>
                                    <td><?=$NovemberResultPOS;?></td>
                                 </tr>
                                 <tr>
                                    <td>December</td>
                                    <td><?=$DecemberResultNEG;?></td>
                                    <td><?=$DecemberResultNEU;?></td>
                                    <td><?=$DecemberResultPOS;?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-md-7 col-lg-7 col-xl-7">
                     <div class="card">
                        <div class="card-body">
                           <canvas id="chartjs-pie" height="250"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
                        </div>
                    </div>
                </div>