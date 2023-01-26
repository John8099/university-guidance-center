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
$AppointmentID = $this->uri->segment(3);
$query = $this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '" . $AppointmentID . "'");
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
}
$College = '';
$College = $this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '{$CollegeID}';")->row()->College;
?>
<div class="row">
  <!-- column -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
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
        ?>
        <?php if ($Status == 'Pending') : ?>
          <hr>
          <a style="width: 170px;" onclick="approveClick($(this), '<?= $Platform; ?>')" href="#" class="btn btn-primary btn-sm" title="Approve Appointment">Approve</a>
          <script>
            function approveClick(e, platform) {

              const approveLink = "<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Approved'; ?>"
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
                    const redirect = '<?= site_url() . "superadmin/view_appointment/" . $this->uri->segment(3) ?>'
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
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Rescheduled'; ?>" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>
          <!-- <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Endorsed'; ?>" class="btn btn-secondary btn-sm" title="Endorsed">Endorsed</a> -->
        <?php endif; ?>
        <?php if ($Status == 'Approved') : ?>
          <hr>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Completed'; ?>" class="btn btn-danger text-white btn-sm" title="Complete Appointment">Complete</a>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Follow Up'; ?>" class="btn btn-info btn-sm" title="Follow Up Appointment">Follow Up</a>

        <?php endif; ?>
        <?php if ($Status == 'Endorsed') : ?>
          <hr>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Approved'; ?>" class="btn btn-danger text-white btn-sm" title="Accept Appointment">Accept</a>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Pending'; ?>" class="btn btn-info btn-sm" title="Decline Appointment">Decline</a>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Rescheduled'; ?>" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>
        <?php endif; ?>
        <?php if ($Status == 'Completed') : ?>
          <br>
          <form method="post" action="<?= site_url() . 'superadmin/appointment_remarks_save/' . $AppointmentID ?>" class="form-horizontal form-material mx-2">
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
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Accept'; ?>" class="btn btn-danger text-white btn-sm" title="Accept Appointment">Accept</a>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Decline'; ?>" class="btn btn-info btn-sm" title="Decline Appointment">Decline</a>
          <a style="width: 170px;" href="<?= site_url() . 'superadmin/update_status/' . $row->AppointmentID . '/Rescheduled'; ?>" class="btn btn-orange btn-sm text-white" title="Rescheduled Appointment">Rescheduled</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>