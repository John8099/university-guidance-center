<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row">
  <!-- Column -->
  <div class="col-lg-12 col-xlg-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div class="ms-auto">
            <a href="<?= site_url() . 'superadmin/set_schedule_appointment'; ?>" type="button" class="d-none btn btn-outline-success btn-sm" title="Create Appointment">Create Appointment</a>
            <a href="<?= site_url() . 'superadmin/schedule'; ?>" type="button" class="btn btn-outline-success btn-sm" title="Create Schedule">Create Schedule</a>
          </div>
        </div>
        <div class="fullcalendar" style="margin-top: 20px">

          <div id='calendarAdmin'></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT
                          apnt.AppointmentID AS appointmentID,
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
                          LEFT JOIN tbluser u
                          ON u.UserID = aschd.CreatedBy
                          ");

// $result = $query->num_rows() == 0 ? null : json_encode($query->result_object());
$data = [];
foreach ($query->result() as $res) {
  $adminFullName = $this->routines->getUserFullName($res->adminID);
  $appointmentStat = $res->studentAppointmentStatus != null ? $res->studentAppointmentStatus : $res->selectedAppointmentStatus;

  $colorAppoint = "";
  if ($appointmentStat == "Approved" || $appointmentStat == "Endorsed" || $appointmentStat == "Completed") {
    $colorAppoint = "rgb(38 157 65)";
  } else if ($appointmentStat == "Pending") {
    $colorAppoint = "rgb(203 155 14)";
  } else if ($appointmentStat == "Follow Up") {
    $colorAppoint = "rgb(26 161 183)";
  } else {
    $colorAppoint = "rgb(6 93 187)";
  }

  array_push(
    $data,
    array(
      "title" => "$res->appointmentTime <br> $adminFullName <br> $appointmentStat",
      "url" => $res->appointmentID != null ? site_url() . 'superadmin/view_appointment/' . $res->appointmentID : null,
      "start" => $res->appointmentDate,
      "color" => $colorAppoint
    )
  );
}
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendarAdmin');

    const appointmentData = <?= json_encode($data) ?>;
    const data = appointmentData != null ? appointmentData : []

    console.log(data)
    var calendarAppointment = new FullCalendar.Calendar(calendarEl, {
      displayEventTime: false,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
      },
      events: data,
      eventClick: function(e) {
        e.jsEvent.preventDefault(); // don't let the browser navigate
        const titleSplitted = e.event.title.split(" <br> ")
        const status = titleSplitted[titleSplitted.length - 1];

        if (status === "Active") {
          swal.fire({
            text: "No student yet appointed to this schedule",
            icon: "warning"
          })
        } else if (e.event.url !== null) {
          window.location.href = (e.event.url);
        }
      }
    });

    calendarAppointment.render();

    $('.fc-prev-button').on("click", function() {
      $('.fc-event-title').each(function(data) {
        $(this).html($(this).text());
      });
    });

    $('.fc-next-button').on("click", function() {
      $('.fc-event-title').each(function(data) {
        $(this).html($(this).text());
      });
    });
  });
</script>