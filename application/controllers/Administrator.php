<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('main_model');
    $this->load->model('routines');
    $this->load->model('analyzer_model');
  }

  public function login()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), $this->session->userdata('Location'), false);
    $data['heading'] = 'Administrator Login';
    $this->load->view('administrator/login', $data);
  }

  public function administrator_login()
  {
    if (!$this->input->post('txtUsername')) {
      redirect(site_url() . 'administrator/login');
    }

    $UserType = $this->db->escape_str($this->input->post('txtUserType'));
    $username = $this->db->escape_str($this->input->post('txtUsername'));
    $password = hash("sha256", $this->db->escape_str($this->input->post('txtPassword')));
    $Query = $this->db->query("SELECT * FROM tbluser WHERE SchoolID = '{$username}' AND HashedPassword = '{$password}' AND UserType = '{$UserType}';");
    if ($Query->num_rows() <> 0) {
      $rowdata = $Query->row();
      if ($rowdata->Status == 'Inactive') {
        $this->session->set_flashdata('Failed', 'Login authentication failed, please verify your email.');
        redirect(site_url() . 'administrator/login');
      }

      $this->session->set_userdata('UserID', $rowdata->UserID);
      $this->session->set_userdata('UserType', $rowdata->UserType);
      $this->session->set_userdata('Fullname', $this->routines->getUserFullName($rowdata->UserID));
      $this->session->set_userdata('Email', $rowdata->Email);
      $this->session->set_userdata('CollegeID', $rowdata->CollegeID);
      $this->session->set_userdata('SchoolID', $rowdata->SchoolID);
      $this->session->set_userdata('ImageLoc', $rowdata->ImageLoc);
      $this->session->set_userdata('Location', site_url() . 'administrator');
      
      if ($rowdata->isNew == '1') {
        redirect(site_url() . 'administrator/change_password');
      } else {
        redirect(site_url() . 'administrator');
      }
    } else {
      $this->session->set_flashdata('Failed', 'Login Authentication Failed.');
      redirect(site_url() . 'administrator/login');
    }
  }

  public function admin_lists()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Admin List';
    $data['content'] = 'admin_lists';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function admin_list()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Create Admin';
    $data['content'] = 'admin_list';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function admin_list_save()
  {
    // wvsu.edu.ph
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('admin_list_save', 'Password not match.');
      redirect(site_url() . 'administrator/admin_list');
    }

    $email = $this->input->post('txtEmail');
    $ranpass = $this->routines->generateRandomString(8);
    $hashPassword = hash("sha256", $email);

    $data = array(
      'Fullname' => $this->input->post('txtFullname'),
      'UserType' => 'Administrator',
      'Address' => '',
      'IdentifiedGender' => $this->input->post('txtIdentifiedGender'),
      'BiologicalSex' => '',
      'Course' => '',
      'YearSec' => '',
      'Email' => $email,
      'SchoolID ' => $this->input->post('txtSchoolID'),
      'CollegeID ' => $this->input->post('txtCollege'),
      'CreatedOn' => $this->routines->getCurrentDateTime(),
      'CreatedBy' => 0,
      'Status' => 'Active',
    );
    if ($this->routines->validateEmail($email)) {

      if ($this->uri->segment(3) == '') {
        $data['HashedPassword'] = $hashPassword;
        $data["isNew"] = 1;

        $this->main_model->insert_entry('tbluser', $data);

        // SEND EMAIL VERIFICATION
        $msg = 'Your username: ' . $this->input->post('txtSchoolID') . ' password: ' . $ranpass . '';
        $sendemail = $this->routines->sendEmail("Temporary Account", $msg, $email);
      } else {
        $this->main_model->update_entry('tbluser', $data, 'UserID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('admin_list_save', 'Registration was successfully saved.');
    } else {
      $this->session->set_flashdata('Fullname', $this->input->post('txtFullname'));
      $this->session->set_flashdata('IdentifiedGender', $this->input->post('txtIdentifiedGender'));
      $this->session->set_flashdata('CollegeID', $this->input->post('txtCollege'));
      $this->session->set_flashdata('SchoolID', $this->input->post('txtSchoolID'));
      $this->session->set_flashdata('Email', $email);
      $this->session->set_flashdata('invalid', 'The email was invalid only accepts wvsu.edu.ph email.');
    }

    if ($this->input->post('txtRegisterType') == 'Superadmin') {
      redirect(site_url() . 'administrator/admin_list/' . $this->uri->segment(3));
    } else {
      redirect(site_url() . 'administrator/admin_portal/' . $this->uri->segment(3));
    }
  }

  public function admin_register()
  {
    $data['heading'] = 'Admin Register';
    $data['sub_heading'] = 'Admin Register';
    $data['content'] = 'admin_register';
    $this->load->view('administrator/admin_register', $data);
  }

  public function admin_save()
  {
    // wvsu.edu.ph
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('RegisterFailed', 'Password not match.');
      redirect(site_url() . 'administrator/admin_register');
    }

    $SchoolID = $this->db->query("SELECT * FROM tbluser WHERE SchoolID = '" . $this->input->post('txtSchoolID') . "';")->row()->SchoolID;


    if ($SchoolID != '') {
      $this->session->set_flashdata('RegisterFailed', 'Admin ID is already exist.');
      redirect(site_url() . 'administrator/admin_register');
    }

    $hashPassword = hash("sha256", $this->input->post('txtPassword'));
    $email = $this->input->post('txtEmail');

    $data = array(
      'HashedPassword' => $hashPassword,
      'Fullname' => $this->input->post('txtFullname'),
      'UserType' => 'Administrator',
      'Address' => '',
      'IdentifiedGender' => $this->input->post('txtIdentifiedGender'),
      'BiologicalSex' => '',
      'Course' => '',
      'YearSec' => '',
      'Email' => $email,
      'SchoolID' => $this->input->post('txtSchoolID'),
      'CollegeID ' => $this->input->post('txtCollege'),
      'CreatedOn' => $this->routines->getCurrentDateTime(),
      'CreatedBy' => 0,
      'Status' => 'Inactive',
    );
    if ($this->routines->validateEmail($email)) {
      if ($this->uri->segment(3) == '') {
        $this->main_model->insert_entry('tbluser', $data);
      } else {
        $this->main_model->update_entry('tbluser', $data, 'UserID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('RegisterSuccess', 'Registration was successfully saved.');
    } else {
      $this->session->set_flashdata('RegisterFailed', 'The email was invalid only accepts wvsu.edu.ph email.');
    }
    redirect(site_url() . 'administrator/admin_register');
  }

  public function change_password()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Change Password';
    $data['content'] = 'change_password';
    $this->load->view('administrator/change_password');
  }

  public function change_password_save()
  {
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('pass_msg', 'Password not match.');
      redirect(site_url() . 'administrator/change_password');
    }

    $OldPassword = hash("sha256", $this->db->escape_str($this->input->post('txtOldPassword')));
    $hashPassword = hash("sha256", $this->input->post('txtPassword'));
    $Query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '{$this->session->userdata('UserID')}' AND HashedPassword = '{$OldPassword}';");
    if ($Query->num_rows() <> 0) {
      $data = array(
        'HashedPassword' => $hashPassword,
        "isNew" => 0
      );
      $this->main_model->update_entry('tbluser', $data, 'UserID', $this->session->userdata('UserID'));
      $this->session->set_flashdata('pass_msg', 'Password was successfully changed.');
      redirect(site_url() . 'administrator');
    } else {
      $this->session->set_flashdata('pass_msg', 'Old password was incorrect.');
      redirect(site_url() . 'administrator/change_password');
    }
  }

  public function change_profile_picture()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Change Profile Picture';
    $data['content'] = 'change_profile_picture';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function appointment_list()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'List of All Appointments';
    $data['content'] = 'appointment_list';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function change_profile_picture_save()
  {
    $result = $this->routines->Upload('/uploads', 30, 'pdf|jpg|png');
    echo $result['file_name'];
    $ImageLoc = $result['file_name'];
    $data = array(
      'ImageLoc' => $ImageLoc
    );
    $this->main_model->update_entry('tbluser', $data, 'UserID', $this->session->userdata('UserID'));
    $this->routines->del_image($this->session->userdata('ImageLoc'));
    $this->session->set_userdata('ImageLoc', $ImageLoc);
    redirect(site_url() . 'administrator/change_profile_picture');
  }

  public function schedule_save()
  {
    $CreatedBy = $this->session->userdata('UserID');
    if ($this->uri->segment(3) != '') {
      $CreatedBy = $this->uri->segment(3);
    }
    if ($this->isDuplicateAppointment($this->input->post('txtAppointmentDate'), $this->input->post('txtAppointmentTime'))) {
      $this->session->set_flashdata('Error', 'Appointment schedule conflicts with other schedule.');
    } else {
      $data = array(
        'AppointmentDate' => $this->input->post('txtAppointmentDate'),
        'AppointmentTime' => $this->input->post('txtAppointmentTime'),
        'Status' => 'Active',
        'CreatedOn' => $this->routines->getCurrentDateTime(),
        'CreatedBy' => $CreatedBy,
      );
      $this->main_model->insert_entry('tblappointmentsched', $data);
      $this->session->set_flashdata('Success', 'Appointment schedule data was successfully saved.');
    }
    redirect(site_url() . 'administrator/schedule/' . $this->uri->segment(3));
  }
  public function isDuplicateAppointment($date, $time)
  {
    $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE AppointmentDate='$date' and AppointmentTime='$time'");

    if ($query->num_rows() > 0) {
      return true;
    }
    return false;
  }

  public function update_status()
  {
    $StudentName = '';
    $Remarks = '';
    $PreferredTime = '';
    $SelectedDate = '';
    $AppointmentSchedID = '';
    $CreatedBy = '';

    $googleLink = $this->input->post('google_link');
    $phoneNumber = "";
    $platform = "";
    $tableAppointmentStatus = "";

    $AppointmentID = $this->uri->segment(3);

    $query = $this->db->query("SELECT * FROM tblappointment WHERE AppointmentID = '" . $AppointmentID . "'");

    foreach ($query->result() as $row) {
      $StudentName = $this->routines->getUserFullName($row->CreatedBy);
      $Remarks = $row->Remarks;
      $PreferredTime = $row->PreferredTime;
      $SelectedDate = $row->SelectedDate;
      $AppointmentSchedID = $row->AppointmentSchedID;
      $CreatedBy = $row->CreatedBy;
      $phoneNumber = $row->PhoneNumber;
      $platform = $row->Platform;
      $tableAppointmentStatus = $row->Status;
    }

    $CreatedBySchedule = '';
    $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE AppointmentSchedID = '" . $AppointmentSchedID . "'");
    foreach ($query->result() as $row) {
      $CreatedBySchedule = $row->CreatedBy;
    }

    $dateSched = $this->input->post('dateSched');
    $timeSched = $this->input->post('timeSched');

    $hasError = false;

    if ($dateSched != "" && $timeSched != "") {
      if ($this->isDuplicateAppointment($dateSched, $timeSched)) {
        $this->session->set_flashdata('Failed', 'Appointment schedule conflicts with other schedule.');
        $hasError = true;
      }
    }

    if (!$hasError) {

      if ($this->uri->segment(3) == '') {
      } else {

        if (urldecode($this->uri->segment(4)) == 'Rescheduled') {
          $dataAppoint = array(
            "PreferredTime" => "$timeSched",
            "SelectedDate" => "$dateSched"
          );

          if ($tableAppointmentStatus == "Endorsed") {
            $dataAppointSchedule = array(
              "CreatedBy" => $this->session->userdata("UserID"),
              "AppointmentDate" => "$dateSched",
              "AppointmentTime" => "$timeSched"
            );
          } else {
            $dataAppointSchedule = array(
              "CreatedBy" => $this->session->userdata("UserID"),
              "AppointmentDate" => "$dateSched",
              "AppointmentTime" => "$timeSched"
            );
          }


          $this->main_model->update_entry('tblappointment', $dataAppoint, 'AppointmentID', $this->uri->segment(3));
          $this->main_model->update_entry('tblappointmentsched', $dataAppointSchedule, 'AppointmentSchedID', $AppointmentSchedID);
        } else if (urldecode($this->uri->segment(4)) == 'Follow Up') {

          $dataAppoint = array(
            "PreferredTime" => "$timeSched",
            "SelectedDate" => "$dateSched",
            "Status" => "Follow Up"
          );

          if ($tableAppointmentStatus == "Endorsed") {
            $dataAppointSchedule = array(
              "CreatedBy" => $this->session->userdata("UserID"),
              "AppointmentDate" => "$dateSched",
              "AppointmentTime" => "$timeSched"
            );
          } else {
            $dataAppointSchedule = array(
              "CreatedBy" => $this->session->userdata("UserID"),
              "AppointmentDate" => "$dateSched",
              "AppointmentTime" => "$timeSched"
            );
          }


          $this->main_model->update_entry('tblappointment', $dataAppoint, 'AppointmentID', $this->uri->segment(3));
          $this->main_model->update_entry('tblappointmentsched', $dataAppointSchedule, 'AppointmentSchedID', $AppointmentSchedID);
        } else {

          $data = array(
            'Status' => urldecode($this->uri->segment(4))
          );
          $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
        }

        $Notification = '';

        $firstSentence = "Hello $StudentName, Your appointment for (" . date("F d, Y", strtotime($SelectedDate)) . " at $PreferredTime) has been approved.";

        $secondSentence = array(
          "Facebook Messenger" => "Please ensure that the Facebook profile link in your student profile is yours, as we will be contacting you there. We look forward to hearing from you soon. Have a great day!",
          "Google Meet" => "Below you will find the link to the Google Meet. Please join the meeting as scheduled.\n\nThis is the link to the Google Meet: <a href='$googleLink'  target='_blank'>$googleLink</a>",
          "Telecounseling" => "Please ensure that the phone number indicated in your student profile is yours, the number is $phoneNumber as we will contact you there. Have a great day!",
          "Face to Face" => "Kindly arrive at the faculty office to have your counseling. We look forward to seeing you soon. Have a great day!"
        );

        if (urldecode($this->uri->segment(4)) == 'Approved') {

          $Notification = $firstSentence . " " . nl2br($secondSentence[$platform]);
          $this->routines->createNotification($Notification, $CreatedBy, $this->session->userdata('UserID'));
        }

        $adminFullName = $this->routines->getUserFullName($CreatedBySchedule);
        if (urldecode($this->uri->segment(4)) == 'Rescheduled') {
          $Notification = "Hello $StudentName! Your scheduled appointment on " . (date("F d, Y", strtotime($SelectedDate))) . " $PreferredTime with $adminFullName is rescheduled to " . (date("F d, Y", strtotime($dateSched))) . " $timeSched.";
          if ($googleLink != "") {
            $Notification .= " " . nl2br($secondSentence["Google Meet"]);
          }

          $this->routines->createNotification($Notification, $CreatedBy, $this->session->userdata('UserID'));
        }

        if (urldecode($this->uri->segment(4)) == 'Follow Up') {
          $Notification = "Hello $StudentName! You have scheduled follow up on " . (date("F d, Y", strtotime($dateSched))) . " $timeSched with $adminFullName.";

          if ($googleLink != "") {
            $Notification .= " " . nl2br($secondSentence["Google Meet"]);
          }

          $this->routines->createNotification($Notification, $CreatedBy, $this->session->userdata('UserID'));
        }

        if ($Notification == "") {
          $Notification = "Hello $StudentName! Your scheduled appointment on $SelectedDate $PreferredTime with $adminFullName was " . (urldecode($this->uri->segment(4))) . ".";
        }

        //send email
        $sendemail = $this->routines->sendEmail("Appointment Status", "$Notification", $this->session->userdata('AppointmentEmail'));
      }

      $this->session->set_flashdata('Success', 'Appointment data was successfully saved.');
      if (urldecode($this->uri->segment(4)) == 'Completed' || urldecode($this->uri->segment(4)) == 'Endorsed') {
        redirect(site_url() . "superadmin/view_appointment/" . $this->uri->segment(3));
      }
    }
  }

  // UPPER PART IS DONE ===================================================================================
  public function index()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Student Inventory';
    $data['content'] = 'student_inventory';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function student_view()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Student View';
    $data['content'] = 'student_view';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function dashboard()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Dashboard';
    $data['content'] = 'dashboard';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function completed_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Completed Appointment List';
    $data['content'] = 'completed_appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function pending_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Appointment List';
    $data['content'] = 'pending_appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function students()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Student List';
    $data['content'] = 'students';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_question_list()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check Question List';
    $data['content'] = 'wellness_question_list';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_checks()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check';
    $data['content'] = 'wellness_checks';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_checks_delete()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $this->main_model->delete_entry('tblwellnesscheck', 'WellnessCheckID', $this->uri->segment(3));
    $this->main_model->delete_entry('tblwellnessquestion', 'WellnessCheckID', $this->uri->segment(3));
    redirect(site_url() . 'administrator/wellness_checks');
  }

  public function wellness_check()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check';
    $data['content'] = 'wellness_check';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_check_save()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $WellnessCheckID = 0;
    if ($this->uri->segment(3) == '') {
      $data = array(
        'Title' => $this->input->post('txtTitle'),
        'WellnessType' => $this->input->post('txtType'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
        'numberOfCategory' => $this->input->post('textNumberCategory') == null ? NULL : $this->input->post('textNumberCategory'),
        'CreatedOn' => $this->input->post('txtDate'),
        'EndDate' => $this->input->post('txtEndDate'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $WellnessCheckID = $this->main_model->insert_entry('tblwellnesscheck', $data);
    } else {
      $data = array(
        'Title' => $this->input->post('txtTitle'),
        'WellnessType' => $this->input->post('txtType'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
        'numberOfCategory' => $this->input->post('textNumberCategory') == null ? NULL : $this->input->post('textNumberCategory'),
        'CreatedOn' => $this->input->post('txtDate'),
        'EndDate' => $this->input->post('txtEndDate'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $this->main_model->update_entry('tblwellnesscheck', $data, 'WellnessCheckID', $this->uri->segment(3));
      $WellnessCheckID = $this->uri->segment(3);
    }
    redirect(site_url() . 'administrator/wellness_question/' . $WellnessCheckID);
  }

  public function wellness_question_no()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
    } else {
      $data = array(
        'NumberQuestion' => $this->uri->segment(4) + 1,
      );
      $this->main_model->update_entry('tblwellnesscheck', $data, 'WellnessCheckID', $this->uri->segment(3));
    }
    redirect(site_url() . 'administrator/wellness_check/' . $this->uri->segment(3));
  }

  public function wellness_check_status()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
    } else {
      $data = array(
        'Status' => $this->uri->segment(4),
      );
      $this->main_model->update_entry('tblwellnesscheck', $data, 'WellnessCheckID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('isUpdateStatus', 'true');
    redirect(site_url() . 'administrator/wellness_checks');
  }

  public function wellness_check_question_status()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
    } else {
      $data = array(
        'Status' => $this->uri->segment(4),
      );
      $this->main_model->update_entry('tblwellnessquestion', $data, 'QuestionID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('isUpdateStatus', 'true');
    redirect(site_url() . 'administrator/wellness_question_list');
  }

  public function wellness_check_question_confirm()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $this->session->set_flashdata('isQuestionDelete', 'true');
    redirect(site_url() . 'administrator/wellness_question_list/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));
  }

  public function wellness_check_question_delete()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
      $this->session->set_flashdata('QuestionDeleted', 'false');
    } else {
      $tblwellnesscheck = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $this->uri->segment(4) . "';")->row();
      $NumberQuestion = $tblwellnesscheck->NumberQuestion - 1;
      $data = array(
        'NumberQuestion' => $NumberQuestion,
      );
      $this->main_model->update_entry('tblwellnesscheck', $data, 'WellnessCheckID', $this->uri->segment(4));
      $this->main_model->delete_entry('tblwellnessquestionpublish', 'QuestionID', $this->uri->segment(3));
      $this->main_model->delete_entry('tblwellnessquestion', 'QuestionID', $this->uri->segment(3));
      // update numberquestion of wellnessquestion
      $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID = '" . $this->uri->segment(4) . "'");
      $i = 1;
      foreach ($tblwellnessquestion->result() as $row) {
        $data = array(
          'QuestionNumber' => $i,
        );
        $this->main_model->update_entry('tblwellnessquestion', $data, 'QuestionID', $row->QuestionID);
        $i++;
      }
      $this->session->set_flashdata('QuestionDeleted', 'true');
    }
    redirect(site_url() . 'administrator/wellness_question_list');
  }

  public function wellness_question_publish()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $WeekP = $this->db->query("SELECT IFNULL(MAX(WeekPublish), 0) AS 'WeekP' FROM tblwellnessquestionpublish;")->row()->WeekP;
    $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE IsPublish = '0';");
    foreach ($tblwellnessquestion->result() as $row) {
      $data = array(
        'IsPublish' => 1,
      );
      $this->main_model->update_entry('tblwellnessquestion', $data, 'QuestionID', $row->QuestionID);
      $data = array(
        'QuestionID' => $row->QuestionID,
        'WeekPublish' => $WeekP + 1,
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $QuestionID = $this->main_model->insert_entry('tblwellnessquestionpublish', $data);
    }
    $this->session->set_flashdata('QuestionIsPublish', 'true');
    redirect(site_url() . 'administrator/wellness_check/' . $this->uri->segment(3));
  }

  public function wellness_question()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check Questions';
    $data['content'] = 'wellness_question';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_question_update()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check Questions';
    $data['content'] = 'wellness_question_update';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function wellness_question_delete()
  {
    $WellnessCheckID = $this->uri->segment(3);
    $QuestionID = $this->uri->segment(4);
    $this->main_model->delete_entry('tblwellnessquestion', 'QuestionID', $QuestionID);
    redirect(site_url() . 'administrator/wellness_check/' . $WellnessCheckID);
  }

  public function wellness_question_update_save()
  {
    $QuestionID = $this->uri->segment(4);

    $Title = '';
    $WellnessType = '';
    $NumberQuestion = 0;
    $WellnessCheckID = $this->uri->segment(3);
    $result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
    foreach ($result->result() as $row) {
      $Title = $row->Title;
      $WellnessType = $row->WellnessType;
      $NumberQuestion = $row->NumberQuestion;
    }
    if ($WellnessType == 'Qualitative') {
      $this->session->set_flashdata('isPublish', 'true');
    } else {
      $this->session->set_flashdata('isPublish', 'false');
    }
    $QuestionID = $this->uri->segment(4);
    $data = array(
      'Question' => $this->input->post('txtQuestion'),
      'Category' => $this->input->post('txtCategory'),
    );
    $this->main_model->update_entry('tblwellnessquestion', $data, 'QuestionID', $QuestionID);
    redirect(site_url() . 'administrator/wellness_check/' . $WellnessCheckID);
  }

  public function wellness_question_save()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $WellnessCheckID = $this->uri->segment(3);
    $Title = '';
    $WellnessType = '';
    $NumberQuestion = 0;
    $numberOfCategory = 0;

    $type = "";

    $result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
    foreach ($result->result() as $row) {
      $Title = $row->Title;
      $WellnessType = $row->WellnessType;
      $NumberQuestion = $row->NumberQuestion;
      $numberOfCategory = $row->numberOfCategory;
    }

    if ($WellnessType == 'Qualitative') {
      $this->session->set_flashdata('isPublish', 'true');
      $type = "Sentiment Analysis Questions";
    } else {
      $this->session->set_flashdata('isPublish', 'false');
      $type = "Quantitative Questions";
    }

    $questions = $this->input->post('txtQuestion');
    $category = $this->input->post('txtCategory');

    if (is_array($questions) && is_array($category)) {
      for ($a = 0; $a < $numberOfCategory; $a++) {
        $questionCount = 1;
        foreach ($questions as $question) {
          $data = array(
            'QuestionNumber' => $questionCount,
            'Question' => $question,
            'Category' => $this->input->post('txtCategory')[$a],
            'WellnessCheckID' => $WellnessCheckID,
            'WellnessType' => $WellnessType,
            'CreatedBy' => $this->session->userdata('UserID'),
          );
          $QuestionID = $this->main_model->insert_entry('tblwellnessquestion', $data);
          if ($QuestionID) {
            $this->checkAndInsertInQuestionBank($question, $type);
            $questionCount++;
          }
        }
      }
    } else {
      for ($i = 1; $i <= $NumberQuestion; $i++) {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestion' . $i),
          'Category' => $this->input->post('txtCategory'),
          'WellnessCheckID' => $WellnessCheckID,
          'WellnessType' => $WellnessType,
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $QuestionID = $this->main_model->insert_entry('tblwellnessquestion', $data);
        if ($QuestionID) {
          $this->checkAndInsertInQuestionBank($this->input->post('txtQuestion' . $i), $type);
        }
      }
    }

    redirect(site_url() . 'administrator/wellness_check/' . $WellnessCheckID);
  }

  public function checkAndInsertInQuestionBank($question, $type)
  {
    $questionQ = $this->db->query("SELECT * FROM tblquestionbank WHERE LOWER(Question) LIKE LOWER('%$question%')");
    $resQuestion = $questionQ->result();
    if ($questionQ->num_rows() == 0) {
      $data = array(
        'Question' => $question,
        'Category' => $type,
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $QuestionID = $this->main_model->insert_entry('tblquestionbank', $data);
    }
  }

  public function question_bank()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Question Bank';
    $data['content'] = 'question_bank';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function question_bank_save()
  {
    $QuestionID = 0;
    if ($this->uri->segment(3) == '') {
      $data = array(
        'Question' => $this->input->post('txtQuestion'),
        'Category' => $this->input->post('txtType'),
        'CreatedOn' => $this->input->post('txtDate'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $QuestionID = $this->main_model->insert_entry('tblquestionbank', $data);
    } else {
      $QuestionID = $this->uri->segment(3);
      if ($this->input->post('txtStatus') == 0) {
        $data = array(
          'Question' => $this->input->post('txtQuestion'),
          'Category' => $this->input->post('txtType'),
          'CreatedOn' => $this->input->post('txtDate'),
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $this->main_model->update_entry('tblquestionbank', $data, 'QuestionID', $this->uri->segment(3));
      } else {
        $this->session->set_flashdata('question_bank_save_result', 'Unable to update question, please set disable first the question.');
      }
    }
    redirect(site_url() . 'administrator/question_bank/' . $QuestionID);
  }

  public function question_banks()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Question Bank';
    $data['content'] = 'question_banks';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function question_bank_update_status()
  {
    if ($this->uri->segment(4) == 2) {
      $this->session->set_flashdata('question_bank_save_result', 'Unable to delete question, please set disable first the question.');
      redirect(site_url() . 'administrator/question_banks');
    }
    $QuestionID = 0;
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
    } else {
      $data = array(
        'Status' => $this->uri->segment(4),
      );
      $this->main_model->update_entry('tblquestionbank', $data, 'QuestionID', $this->uri->segment(3));
    }
    redirect(site_url() . 'administrator/question_banks');
  }

  public function assessments()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Wellness Check';
    $data['content'] = 'assessments';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function assessment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Assessment';
    $data['content'] = 'assessment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function save_assessment()
  {
    $AssessmentID = 0;
    if ($this->uri->segment(3) == '') {
      $data = array(
        'Assessment' => $this->input->post('txtAssessment'),
        'Semester' => $this->input->post('txtSemester'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
        'NumberQuestionSent' => $this->input->post('txtNumberQuestionSent'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $AssessmentID = $this->main_model->insert_entry('tblassessment', $data);
    } else {
      $data = array(
        'Assessment' => $this->input->post('txtAssessment'),
        'Semester' => $this->input->post('txtSemester'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
        'NumberQuestionSent' => $this->input->post('txtNumberQuestionSent'),
      );
      $this->main_model->update_entry('tblassessment', $data, 'AssessmentID', $this->uri->segment(3));
      $AssessmentID = $this->uri->segment(3);
    }
    $this->session->set_userdata('TotalQuestion', $this->input->post('txtTotalQuestion'));
    $this->session->set_userdata('AssessmentID', $AssessmentID);
    redirect(site_url() . 'administrator/question/' . $AssessmentID);
  }

  public function question()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Question';
    $data['content'] = 'question';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function save_questions()
  {
    $AssessmentID = $this->uri->segment(3);
    $Assessment = '';
    $Semester = '';
    $NumberQuestion = 0;
    $NumberQuestionSent = 0;
    $result = $this->db->query("SELECT * FROM tblassessment WHERE AssessmentID = '" . $AssessmentID . "'");
    foreach ($result->result() as $row) {
      $Assessment = $row->Assessment;
      $Semester = $row->Semester;
      $NumberQuestion = $row->NumberQuestion;
      $NumberQuestionSent = $row->NumberQuestionSent;
    }
    for ($i = 1; $i <= $NumberQuestionSent; $i++) {
      $QuestionID = $this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '" . $AssessmentID . "' AND QuestionNumber = '" . $i . "' AND Category = 'SentanceBased';")->row();
      if (isset($QuestionID->QuestionID)) {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestion' . $i),
          'Category' => $this->input->post('txtCategory' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $this->main_model->update_entry('tblquestion', $data, 'QuestionID', $QuestionID->QuestionID);
      } else {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestion' . $i),
          'Category' => $this->input->post('txtCategory' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $QuestionID = $this->main_model->insert_entry('tblquestion', $data);
      }
    }
    for ($i = 1; $i <= $NumberQuestion; $i++) {
      $QuestionID = $this->db->query("SELECT * FROM tblquestion WHERE AssessmentID = '" . $AssessmentID . "' AND QuestionNumber = '" . $i . "' AND Category = 'MultipleChoice';")->row();
      if (isset($QuestionID->QuestionID)) {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestionMul' . $i),
          'Category' => $this->input->post('txtCategoryMul' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $this->main_model->update_entry('tblquestion', $data, 'QuestionID', $QuestionID->QuestionID);
      } else {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestionMul' . $i),
          'Category' => $this->input->post('txtCategoryMul' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('UserID'),
        );
        $QuestionID = $this->main_model->insert_entry('tblquestion', $data);
      }
    }
    // send the question in the email
    redirect(site_url() . 'administrator/assessments');
  }

  public function set_status_assessment()
  {
    $query = $this->db->query("UPDATE tblassessment SET Status='Inactive';");
    $AssessmentID = 0;
    if ($this->uri->segment(3) == '' && $this->uri->segment(4) == '') {
    } else {
      $data = array(
        'Status' => $this->uri->segment(4),
      );
      $this->main_model->update_entry('tblassessment', $data, 'AssessmentID', $this->uri->segment(3));
    }
    redirect(site_url() . 'administrator/assessments');
  }

  public function colleges()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Colleges';
    $data['content'] = 'colleges';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function college()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'College';
    $data['content'] = 'college';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function college_save()
  {
    if ($this->uri->segment(3) == '') {
      $data = array(
        'College' => $this->input->post('txtCollege')
      );
      $this->main_model->insert_entry('tblcollege', $data);
    } else {
      $data = array(
        'College' => $this->input->post('txtCollege')
      );
      $this->main_model->update_entry('tblcollege', $data, 'CollegeID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'College data was successfully saved.');
    redirect(site_url() . 'administrator/college/' . $this->uri->segment(3));
  }

  public function college_delete()
  {
    if ($this->uri->segment(3) == '') {
    } else {
      $this->main_model->delete_entry('tblcollege', 'CollegeID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'College data was successfully deleted.');
    redirect(site_url() . 'administrator/colleges');
  }

  public function appointments()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Appointments';
    $data['content'] = 'appointments';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function view_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'View Appointment';
    $data['content'] = 'view_appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Appointment';
    $data['content'] = 'appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function appointment_save()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {
      $data = array(
        'Referrer' => $this->input->post('txtReferrer'),
        'StudentName' => $this->input->post('txtStudentName'),
        'Email' => $this->input->post('txtEmail'),
        'CollegeID' => $this->input->post('txtCollege'),
        'YearSection' => $this->input->post('txtYearSection'),
        'Address' => $this->input->post('txtAddress'),
        'PhoneNumber' => $this->input->post('txtPhoneNumber'),
        'OtherContact' => $this->input->post('txtOtherContact'),
        'Category' => $this->input->post('txtCategory'),
        'Platform' => $this->input->post('txtPlatform'),
        'PreferredTime' => $this->input->post('txtPreferredTime'),
        'SelectedDate' => $this->input->post('txtSelectedDate'),
        'CreatedBy' => $this->session->userdata('UserID'),
        'AppointmentSchedID' => $this->session->userdata('AppointmentSchedID'),
      );
      if ($this->uri->segment(3) == '') {
        $this->main_model->insert_entry('tblappointment', $data);
      } else {
        $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
      }
      $data = array(
        'Status' => 'Occupied',
      );
      $this->main_model->update_entry('tblappointmentsched', $data, 'AppointmentSchedID', $this->session->userdata('AppointmentSchedID'));
      $this->session->set_flashdata('AppointmentSuccess', 'true');
    } else {
      $this->session->set_flashdata('AppointmentSuccess', 'false');
    }
    redirect(site_url() . 'administrator/appointments');
  }

  public function appointment_remarks_save()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data = array(
      'Remarks' => $this->input->post('txtRemarks'),
    );
    $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
    redirect(site_url() . 'administrator/view_appointment/' . $this->uri->segment(3));
  }

  public function set_schedule_date()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');

    if ($this->uri->segment(3) == '') {
      redirect(site_url() . 'administrator/set_schedule_date');
    } else {
      $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE AppointmentSchedID = '" . $this->uri->segment(3) . "'");
      $rowdata = $query->row();

      $this->session->set_userdata('AppointmentDate', $rowdata->AppointmentDate);
      $this->session->set_userdata('AppointmentTime', $rowdata->AppointmentTime);
      $this->session->set_userdata('AppointmentSchedID', $rowdata->AppointmentSchedID);
      redirect(site_url() . 'administrator/schedule_appointment/');
    }
  }

  public function schedule_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Schedule Appointment';
    $data['sub_heading'] = 'Schedule Appointment';
    $data['content'] = 'schedule_appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function set_schedule_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'New Schedule Appointment';
    $data['sub_heading'] = 'New Schedule Appointment';
    $data['content'] = 'set_schedule_appointment';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function schedule()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Create Schedule';
    $data['content'] = 'schedule';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function appointment_reports()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Appointment Reports';
    $data['content'] = 'appointment_reports';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function assessment_reports()
  {
    $this->routines->ifLogin($this->session->userdata('UserID'), site_url() . 'administrator/login');
    $data['heading'] = 'Administrator';
    $data['sub_heading'] = 'Assessment Reports';
    $data['content'] = 'assessment_reports';
    $this->load->view('administrator/administrator_template', $data);
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(site_url() . 'administrator/login');
  }

  public function register()
  {
    $data['heading'] = 'User Register';
    $this->load->view('administrator/register', $data);
  }

  public function testdata()
  {
    echo '<pre>';
    print_r($this->analyzer_model->CheckData("love"));
  }

  public function refer_appointment()
  {
    $data['heading'] = 'Reffer An Appointment';
    $this->load->view('administrator/refer_appointment', $data);
  }

  public function user_save()
  {
    // wvsu.edu.ph
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('RegisterFailed', 'Password not match.');
      redirect(site_url() . 'administrator/register');
    }

    $hashPassword = hash("sha256", $this->input->post('txtPassword'));
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {
      if ($this->uri->segment(3) == '') {
        $data = array(
          'HashedPassword' => $hashPassword,
          'Fullname' => $this->input->post('txtFullname'),
          'UserType' => 'Student',
          'Address' => $this->input->post('txtAddress'),
          'IdentifiedGender' => $this->input->post('txtIdentifiedGender'),
          'BiologicalSex' => $this->input->post('txtBiologicalSex'),
          'Course' => $this->input->post('txtCourse'),
          'YearSec' => $this->input->post('txtYearSec'),
          'Email' => $email,
          'CollegeID ' => $this->input->post('txtCollege'),
          'CreatedOn' => $this->routines->getCurrentDateTime(),
          'CreatedBy' => 0,
          'Status' => 'Active',
        );
        $this->main_model->insert_entry('tbluser', $data);
      } else {
        $data = array(
          'HashedPassword' => $hashPassword,
          'Fullname' => $this->input->post('txtFullname'),
          'UserType' => 'Student',
          'Address' => $this->input->post('txtAddress'),
          'IdentifiedGender' => $this->input->post('txtIdentifiedGender'),
          'BiologicalSex' => $this->input->post('txtBiologicalSex'),
          'Course' => $this->input->post('txtCourse'),
          'YearSec' => $this->input->post('txtYearSec'),
          'Email' => $email,
          'CollegeID ' => $this->input->post('txtCollege'),
          'CreatedOn' => $this->routines->getCurrentDateTime(),
          'CreatedBy' => 0,
          'Status' => 'Active',
        );
        $this->main_model->update_entry('tbluser', $data, 'UserID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('RegisterSuccess', 'Registration was successfully saved.');
    } else {
      $this->session->set_flashdata('RegisterFailed', 'The email was invalid only accepts wvsu.edu.ph email.');
    }
    redirect(site_url() . 'administrator/register');
    // echo '<script>alert("Registration was successfully saved.");window.location="' . site_url().'administrator/register' . '";</script>';
    // redirect(site_url().'administrator/users');
  }

  public function save_appointment_refer()
  {
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {
      $data = array(
        'Referrer' => $this->input->post('txtReferrer'),
        'StudentName' => $this->input->post('txtStudentName'),
        'CourseID' => $this->input->post('txtCourse'),
        'YearSection' => $this->input->post('txtYearSection'),
        'Address' => $this->input->post('txtAddress'),
        'PhoneNumber' => $this->input->post('txtPhoneNumber'),
        'OtherContact' => $this->input->post('txtOtherContact'),
        'Platform' => $this->input->post('txtPlatform'),
        'PreferredTime' => $this->input->post('txtPreferredTime'),
        'SelectedDate' => $this->input->post('txtSelectedDate'),
        'Reason' => $this->input->post('txtReason'),
        'Email' => $this->input->post('txtEmail'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      if ($this->uri->segment(3) == '') {
        $this->main_model->insert_entry('tblappointment', $data);
      } else {
        $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('Success', 'Appointment data was successfully saved.');
    } else {
      $this->session->set_flashdata('Failed', 'Appointment data was failed.');
    }
    redirect(site_url() . 'administrator/refer_appointment/' . $this->uri->segment(3));
  }

  public function delete_appointment()
  {
    if ($this->uri->segment(3) == '') {
    } else {
      $this->main_model->delete_entry('tblappointment', 'AppointmentID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'Appointment data was successfully deleted.');
    redirect(site_url() . 'administrator/appointments');
  }

  public function sendemail()
  {
    echo $this->routines->sendEmail("Appointment Status", "Your appointment was approved", "princejomino@gmail.com");


    // $from_email = "princejomino@gmail.com";
    // $to_email = "pmino6679@gmail.com";
    // //Load email library
    // $this->load->library('email');

    // $config = array();
    // $config['protocol'] = 'smtp';
    // $config['smtp_host'] = 'localhost';
    // $config['smtp_user'] = 'princejomino@gmail.com';
    // $config['smtp_pass'] = 'jotham1401!';
    // $config['smtp_port'] = 587;
    // $this->email->initialize($config);

    // $this->email->from($from_email, 'Identification');
    // $this->email->to($to_email);
    // $this->email->subject('Send Email Codeigniter');
    // $this->email->message('The email send using codeigniter library');
    // //Send mail
    // if($this->email->send()) {
    //     echo "success";
    // } else {
    //     echo "failed";
    // }
  }
}
