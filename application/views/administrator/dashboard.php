<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$TotalAppointments=0;
$TotalAppointments=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE Status!='Completed' AND CollegeID='".$this->session->userdata('AdminCollegeID')."';")->row()->Total;
$CompletedAppointments=0;
$CompletedAppointments=$this->db->query("SELECT COUNT(AppointmentID) AS Total FROM tblappointment WHERE Status='Completed' AND CollegeID='".$this->session->userdata('AdminCollegeID')."';")->row()->Total;
$TotalStudents=0;
$TotalStudents=$this->db->query("SELECT COUNT(UserID) AS Total FROM tbluser WHERE UserType='Student' AND CollegeID='".$this->session->userdata('AdminCollegeID')."';")->row()->Total;
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Feeds</h4>
                                <div class="feed-widget">
                                    <ul class="list-style-none feed-body m-0 p-b-20">
                                        <a href="<?=site_url().'administrator/pending_appointment';?>" class="text-info">
                                        <li class="feed-item">
                                            <div class="feed-icon bg-info"><i class="mdi mdi-calendar-multiple-check"></i></div>Number of Appointments<span class="ms-auto font-12 text-muted"><?=$TotalAppointments;?></span>
                                        </li>
                                        </a>
                                        
                                        <a href="<?=site_url().'administrator/completed_appointment';?>" class="text-success">
                                        <li class="feed-item">
                                            <div class="feed-icon bg-success"><i class="mdi mdi-alarm-check"></i></div> Number of Completed Appointment<span class="ms-auto font-12 text-muted"><?=$CompletedAppointments;?></span>
                                        </li>
                                        </a>
                                        
                                        <a href="<?=site_url().'administrator/students';?>" class="text-danger">
                                        <li class="feed-item">
                                            <div class="feed-icon bg-danger"><i class="mdi mdi-account-multiple"></i></div> Number of registered students<span class="ms-auto font-12 text-muted"><?=$TotalStudents;?></span>
                                        </li>
                                        </a>
                                        
                                        <a href="<?=site_url().'administrator/students';?>" class="text-warning">
                                        <li class="feed-item">
                                            <div class="feed-icon bg-warning"><i class="mdi mdi-emoticon"></i></div> Number of Students taken the Wellness Check<span class="ms-auto font-12 text-muted"><?=$TotalStudents;?></span>
                                        </li>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Appointment List</h4>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="dl">
                                            <select class="form-select shadow-none d-none">
                                                <option value="0" selected>Monthly</option>
                                                <option value="1">Daily</option>
                                                <option value="2">Weekly</option>
                                                <option value="3">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                
                            <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">School ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">College</th>
                                            <th scope="col">Course Year and Section</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Platform</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$query = $this->db->query("SELECT tblappointment.AppointmentID, tblappointment.CreatedBy AS 'AUser', tblappointment.StudentName, tblcollege.College, tblappointment.YearSection, tblappointment.SelectedDate, tblappointment.PreferredTime, tblappointment.Platform, tblappointment.Status FROM tblappointment INNER JOIN tblcollege ON tblcollege.CollegeID=tblappointment.CollegeID WHERE tblappointment.CollegeID='".$this->session->userdata('AdminCollegeID')."';");

foreach ($query->result() as $row) : ?>
<?php
$SchoolID = $this->db->query("SELECT * FROM tbluser WHERE UserID='".$row->AUser."';")->row()->SchoolID;
?>
    <tr>
        <td><?=$SchoolID;?></td>
        <td><?=$row->StudentName;?></td>
        <td><?=$row->College;?></td>
        <td><?=$row->YearSection;?></td>
        <td><?=$row->SelectedDate;?></td>
        <td><?=$row->PreferredTime;?></td>
        <td><?=$row->Platform;?></td>
        <td><label class="label <?=($row->Status=='Pending') ? 'label-warning':'';?><?=($row->Status=='Approved') ? 'label-primary':'';?><?=($row->Status=='Endorsed') ? 'label-secondary':'';?><?=($row->Status=='Completed') ? 'label-danger':'';?><?=($row->Status=='Follow Up') ? 'label-orange':'';?><?=($row->Status=='Rescheduled') ? 'label-info':'';?>"><?=$row->Status;?></label></td>
    </tr>
<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>