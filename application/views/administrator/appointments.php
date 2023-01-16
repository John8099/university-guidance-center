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
                        <h4 class="card-title">Appointment List</h4>
                    </div>
                    <div class="ms-auto">
                        <a href="<?=site_url().'administrator/set_schedule_appointment';?>" type="button" class="btn btn-outline-success btn-sm" title="Create Appointment">Create Appointment</a>
                        <a href="<?=site_url().'administrator/schedule';?>" type="button" class="btn btn-outline-success btn-sm" title="Create Schedule">Create Schedule</a>
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
                            <th scope="col">Course Year and Section</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Platform</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$query = $this->db->query("SELECT tblappointment.AppointmentID, tblappointment.StudentName, tblcollege.College, tblappointment.YearSection, tblappointment.SelectedDate, tblappointment.PreferredTime, tblappointment.Platform, tblappointment.Status FROM tblappointment INNER JOIN tblcollege ON tblcollege.CollegeID=tblappointment.CollegeID WHERE tblappointment.CollegeID='".$this->session->userdata('AdminCollegeID')."';");

foreach ($query->result() as $row) : ?>
    <tr>
        <td><?=$row->StudentName;?></td>
        <td><?=$row->College;?></td>
        <td><?=$row->YearSection;?></td>
        <td><?=$row->SelectedDate;?></td>
        <td><?=$row->PreferredTime;?></td>
        <td><?=$row->Platform;?></td>
        <td><?=$row->Status;?></td>
        <td><a href="<?=site_url().'administrator/view_appointment/'.$row->AppointmentID;?>" class="btn btn-outline-warning btn-sm" title="View Appointment">View</a></td>
    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('AppointmentSuccess')=='true') {
    echo $this->routines->callSweetAlert("Appointment data successfully saved.");
}
if ($this->session->flashdata('AppointmentSuccess')=='false') {
    echo $this->routines->callSweetAlert("Appointment email data was invalid, please try again.");
}
?>