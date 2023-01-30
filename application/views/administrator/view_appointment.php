<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
$Referrer = '';
$StudentName = '';
$Email = '';
$YearSection = '';
$CollegeID = '';
$Address = '';
$PhoneNumber = '';
$OtherContact = '';
$Category = '';
$Platform = '';
$PreferredTime = '';
$SelectedDate = '';
$Status = '';
$Remarks = '';
$adminId = '';
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT 
                          ta.*, 
                          tas.CreatedBy AS adminID 
                          FROM tblappointment ta 
                          INNER JOIN tblappointmentsched tas 
                          ON 
                          ta.AppointmentSchedID = tas.AppointmentSchedID  
                          WHERE 
                          ta.AppointmentID = '$AppointmentID'
                          ");
foreach ($query->result() as $row) {
  $Referrer = $row->Referrer;
  $StudentName = $row->StudentName;
  $Email = $row->Email;
  $YearSection = $row->YearSection;
  $CollegeID = $row->CollegeID;
  $Address = $row->Address;
  $PhoneNumber = $row->PhoneNumber;
  $OtherContact = $row->OtherContact;
  $Category = $row->Category;
  $Platform = $row->Platform;
  $PreferredTime = $row->PreferredTime;
  $SelectedDate = $row->SelectedDate;
  $Status = $row->Status;
  $Remarks = $row->Remarks;
  $adminId = $row->adminID;
}
$College = '';
$College = $this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '{$CollegeID}';")->row()->College;
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="alert alert-success d-flex align-items-center d-none" role="alert" id="alertsuccess">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                <?= $this->session->flashdata('Success'); ?>
              </div>
            </div>
            <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="alertdanger">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?= $this->session->flashdata('Failed'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="d-md-flex">

          <div>
            <h4 class="card-title">
              Appointment Details

            </h4>
          </div>
          <div class="ms-auto">
            <button type="button" class="btn btn-default btn-sm" onclick="return window.history.back()">
              Go back
            </button>
          </div>
        </div>

        <hr>
        <ul class="list-group">
          <?php if ($Referrer != '') : ?>
            <li class="list-group-item"><strong>Referrer: </strong><?= $Referrer; ?></li>
          <?php endif; ?>
          <li class="list-group-item"><strong>Student Name: </strong><?= $StudentName; ?></li>
          <li class="list-group-item"><strong>Student Email: </strong><?= $Email; ?></li>
          <li class="list-group-item"><strong>College: </strong><?= $College; ?></li>
          <li class="list-group-item"><strong>Course Year and Section: </strong><?= $YearSection; ?></li>
          <li class="list-group-item"><strong>Address: </strong><?= $Address; ?></li>
          <li class="list-group-item"><strong>Phone Number: </strong><?= $PhoneNumber; ?></li>
          <li class="list-group-item"><strong>Other Contact Information: </strong><?= $OtherContact; ?></li>
          <li class="list-group-item"><strong>Category: </strong><?= $Category; ?></li>
          <li class="list-group-item"><strong>Platform: </strong><?= $Platform; ?></li>
          <li class="list-group-item"><strong>Preferred Time: </strong><?= $PreferredTime; ?></li>
          <li class="list-group-item"><strong>Select Date: </strong><?= $SelectedDate; ?></li>
          <li class="list-group-item"><strong>Status: </strong><?= $Status; ?></li>
        </ul>
        <?php
        $this->session->set_userdata('AppointmentEmail', $Email);
        if ($adminId != "" && $adminId == $this->session->userdata('UserID')) :
        ?>
          <?php if ($Status == 'Pending') : ?>
            <hr>

            <!-- Approve Button -->
            <a style="width: 170px;" onclick="approveClick($(this), '<?= $Platform; ?>')" href="#" class="btn btn-primary btn-sm" title="Approve Appointment">Approve</a>

            <!-- Reschedule -->
            <!-- <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Rescheduled'; ?>" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a> -->
            <a style="width: 170px;" data-bs-toggle="modal" data-bs-target="#rescheduleModal" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>



          <?php endif; ?>
          <?php if ($Status == 'Approved') : ?>
            <hr>
            <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Completed'; ?>" class="btn btn-danger text-white btn-sm" title="Complete Appointment">Complete</a>

            <a style="width: 170px;" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalFollowUp" title="Follow Up Appointment">Follow Up</a>

            <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Endorsed'; ?>" class="btn btn-secondary btn-sm" title="Endorsed">Endorsed</a>
          <?php endif; ?>

          <?php if ($Status == 'Completed') : ?>
            <br>
            <form method="post" action="<?= site_url() . 'administrator/appointment_remarks_save/' . $AppointmentID ?>" class="form-horizontal form-material mx-2">
              <?= $this->routines->InsertCSRF() ?>
              <div class="form-group">
                <label class="col-md-12">Remarks</label>
                <div class="col-md-12">
                  <textarea class="form-control" rows="3" name='txtRemarks' type="text" placeholder="Enter remarks here" required><?= $Remarks; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          <?php endif; ?>
          <?php if ($Status == 'Follow Up') : ?>
            <hr>
            <!-- <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Accept'; ?>" class="btn btn-danger text-white btn-sm" title="Accept Appointment">Accept</a>
            <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Decline'; ?>" class="btn btn-info btn-sm" title="Decline Appointment">Decline</a> -->

            <a style="width: 170px;" href="<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Completed'; ?>" class="btn btn-danger text-white btn-sm" title="Complete Appointment">Complete</a>

            <a style="width: 170px;" data-bs-toggle="modal" data-bs-target="#rescheduleModal" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>
        <?php endif;
        endif; ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function successful() {
    document.querySelector('#alertsuccess').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertsuccess').classList.add('d-none');
    }, 5000);
  }

  function failed() {
    document.querySelector('#alertdanger').classList.remove('d-none');
    setTimeout(function() {
      document.querySelector('#alertdanger').classList.add('d-none');
    }, 5000);
  }
</script>

<?php if ($this->session->flashdata('Success') != '') : ?>
  <script>
    successful();
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('Failed') != '') : ?>
  <script>
    failed();
  </script>
<?php endif; ?>

<!-- Modal Reschedule -->
<div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rescheduled</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="height: 80vh;">
          <div id="calendarReschedule"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT
                                      apnt.AppointmentID AS appointmentID,
                                      aschd.AppointmentSchedID as appointmentSchedID,
                                      aschd.AppointmentDate AS appointmentDate,
                                      aschd.AppointmentTime AS appointmentTime,
                                      aschd.Status AS selectedAppointmentStatus,
                                      aschd.CreatedBy AS adminID,
                                      apnt.CreatedBy AS studentID,
                                      apnt.Status AS studentAppointmentStatus
                                      FROM tblappointmentsched aschd
                                      LEFT JOIN tblappointment apnt
                                      ON 
                                      aschd.AppointmentSchedID = apnt.AppointmentSchedID
                                      ");

$data = [];
foreach ($query->result() as $res) {
  $appointmentStat = $res->studentAppointmentStatus != null ? $res->studentAppointmentStatus : $res->selectedAppointmentStatus;
  $titleAppoint = $res->appointmentTime . '<br>' . $this->routines->getUserFullName($res->adminID) . "<br>" . $appointmentStat . ($res->appointmentID == $AppointmentID ? "<br> Current Appointment" : "");
  array_push(
    $data,
    array(
      "title" => $titleAppoint,
      "start" => $res->appointmentDate,
    )
  );
}
?>

<script>
  const appointmentData = <?= json_encode($data) ?>;
  const data = appointmentData != null ? appointmentData : []

  var calendarRescheduleEl = document.getElementById('calendarReschedule');
  var calendarReschedule = new FullCalendar.Calendar(calendarRescheduleEl, {
    displayEventTime: false,
    selectable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
    },
    events: data,
    dateClick: function(info) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const selectedDate = new Date(info.dateStr);
      selectedDate.setHours(0, 0, 0, 0);

      if (today <= selectedDate) {
        swal.fire({
          title: 'Select Appointment Time',
          input: 'select',
          inputOptions: {
            "8:00 AM - 9:00 AM": "8:00 AM - 9:00 AM",
            "9:00 AM - 10:00 AM": "9:00 AM - 10:00 AM",
            "10:00 AM - 11:00 AM": "10:00 AM - 11:00 AM",
            "11:00 AM - 12:00 PM": "11:00 AM - 12:00 PM",
            "12:00 PM - 1:00 PM": "12:00 PM - 1:00 PM",
            "1:00 PM - 2:00 PM": "1:00 PM - 2:00 PM",
            "2:00 PM - 3:00 PM": "2:00 PM - 3:00 PM",
            "3:00 PM - 4:00 PM": "3:00 PM - 4:00 PM",
            "4:00 PM - 5:00 PM": "4:00 PM - 5:00 PM"
          },
          inputPlaceholder: 'Select time',
          showCancelButton: true,
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value === '') {
                resolve("Please select appointment time")
              }
              resolve()
            })
          }
        }).then((res) => {
          if (res.isConfirmed) {
            $(".preloader").show();

            const selectedStrDate = info.dateStr;
            const time = res.value;
            const rescheduleUrl = "<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Rescheduled'; ?>";

            saveReschedule(rescheduleUrl, selectedStrDate, time)
          }

        })
      } else {
        swal.fire({
          title: "Error",
          text: "The Date selected is in the past",
          icon: "error"
        })
      }
    }
  });

  function saveReschedule(reScheduleLink, selectedDate, time) {

    $.post(
      reScheduleLink, {
        dateSched: selectedDate,
        timeSched: time,
        <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
      },
      (data, status) => {

        if (status === "success") {
          const redirect = '<?= site_url() . "administrator/view_appointment/" . $this->uri->segment(3) ?>'
          window.location.href = redirect
        }

      }).fail(function(e) {
      $(".preloader").hide();

      swal.fire({
        title: 'Error!',
        text: e.statusText,
        icon: 'error',
      })
    });
  }

  $('#rescheduleModal').on('shown.bs.modal', function() {
    calendarReschedule.render();
    $('.fc-event-title').each(function(data) {
      $(this).html($(this).text());
    });
  });
</script>


<!-- Modal Follow up -->
<div class="modal fade" id="modalFollowUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set follow up date</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container" style="height: 80vh;">
          <div id="calendarFollowUp"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
$queryFollowUp = $this->db->query("SELECT
                                      apnt.AppointmentID AS appointmentID,
                                      aschd.AppointmentSchedID as appointmentSchedID,
                                      aschd.AppointmentDate AS appointmentDate,
                                      aschd.AppointmentTime AS appointmentTime,
                                      aschd.Status AS selectedAppointmentStatus,
                                      aschd.CreatedBy AS adminID,
                                      apnt.CreatedBy AS studentID,
                                      apnt.Status AS studentAppointmentStatus
                                      FROM tblappointmentsched aschd
                                      LEFT JOIN tblappointment apnt
                                      ON 
                                      aschd.AppointmentSchedID = apnt.AppointmentSchedID
                                      ");

$followUpData = [];
foreach ($queryFollowUp->result() as $res) {
  $appointmentStat = $res->studentAppointmentStatus != null ? $res->studentAppointmentStatus : $res->selectedAppointmentStatus;
  $titleFollowUp = $res->appointmentTime . '<br>' . $this->routines->getUserFullName($res->adminID) . "<br>" . $appointmentStat . ($res->appointmentID == $AppointmentID ? "<br> Current Appointment" : "");
  array_push(
    $followUpData,
    array(
      "title" => $titleFollowUp,
      "start" => $res->appointmentDate,
    )
  );
}
?>

<script>
  const followUpJsonData = <?= json_encode($followUpData) ?>;
  const followUpData = followUpJsonData != null ? followUpJsonData : []

  var calendarFollowUpEl = document.getElementById('calendarFollowUp');
  var calendarFollowUp = new FullCalendar.Calendar(calendarFollowUpEl, {
    displayEventTime: false,
    selectable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
    },
    events: followUpData,
    dateClick: function(info) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const selectedDate = new Date(info.dateStr);
      selectedDate.setHours(0, 0, 0, 0);

      if (today <= selectedDate) {
        swal.fire({
          title: 'Select Follow up Time',
          input: 'select',
          inputOptions: {
            "8:00 AM - 9:00 AM": "8:00 AM - 9:00 AM",
            "9:00 AM - 10:00 AM": "9:00 AM - 10:00 AM",
            "10:00 AM - 11:00 AM": "10:00 AM - 11:00 AM",
            "11:00 AM - 12:00 PM": "11:00 AM - 12:00 PM",
            "12:00 PM - 1:00 PM": "12:00 PM - 1:00 PM",
            "1:00 PM - 2:00 PM": "1:00 PM - 2:00 PM",
            "2:00 PM - 3:00 PM": "2:00 PM - 3:00 PM",
            "3:00 PM - 4:00 PM": "3:00 PM - 4:00 PM",
            "4:00 PM - 5:00 PM": "4:00 PM - 5:00 PM"
          },
          inputPlaceholder: 'Select time',
          showCancelButton: true,
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value === '') {
                resolve("Please select follow up time")
              }
              resolve()
            })
          }
        }).then((res) => {
          if (res.isConfirmed) {
            $(".preloader").show();

            const selectedStrDate = info.dateStr;
            const time = res.value;
            const rescheduleUrl = "<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Follow Up'; ?>";

            saveFollowUp(rescheduleUrl, selectedStrDate, time)
          }

        })
      } else {
        swal.fire({
          title: "Error",
          text: "The Date selected is in the past",
          icon: "error"
        })
      }
    }
  });

  function saveFollowUp(followUpLink, selectedDate, time) {

    $.post(
      followUpLink, {
        dateSched: selectedDate,
        timeSched: time,
        <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
      },
      (data, status) => {

        if (status === "success") {
          const redirect = '<?= site_url() . "administrator/view_appointment/" . $this->uri->segment(3) ?>'
          window.location.href = redirect
        }

      }).fail(function(e) {
      $(".preloader").hide();

      swal.fire({
        title: 'Error!',
        text: e.statusText,
        icon: 'error',
      })
    });
  }

  $('#modalFollowUp').on('shown.bs.modal', function() {
    calendarFollowUp.render();
    $('.fc-event-title').each(function(data) {
      $(this).html($(this).text());
    });
  });

  function approveClick(e, platform) {

    const approveLink = "<?= site_url() . 'administrator/update_status/' . $row->AppointmentID . '/Approved'; ?>"
    if (platform.toLowerCase().includes("google meet")) {
      Swal.fire({
        input: 'url',
        inputPlaceholder: 'Place your google meet link here...',
        showDenyButton: true,
        confirmButtonText: 'Submit',
        denyButtonText: 'Cancel',
      }).then((res) => {
        if (res.isConfirmed && res.value) {
          saveApprove(res.value, approveLink)
        }
      })

    } else {
      window.location.href = approveLink;
    }
  }

  function saveApprove(googleLink, approvedLink) {
    swal.showLoading()
    $.post(
      approvedLink, {
        google_link: googleLink,
        <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
      },
      (data, status) => {
        if (status === "success") {
          const redirect = '<?= site_url() . "administrator/view_appointment/" . $this->uri->segment(3) ?>'
          window.location.href = redirect
        }

      }).fail(function(e) {
      swal.fire({
        title: 'Error!',
        text: e.statusText,
        icon: 'error',
      })
    });
  }
</script>