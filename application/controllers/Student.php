<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('main_model');
    $this->load->model('routines');
    $this->load->model('analyzer_model');
  }

  public function student_register()
  {
    $data['heading'] = 'Student Register';
    $data['sub_heading'] = 'Student Register';
    $data['content'] = 'student_register';
    $this->load->view('student/student_register', $data);
  }

  public function student_save()
  {
    // wvsu.edu.ph
    $email = $this->input->post('txtEmail');

    $SchoolID = $this->input->post('txtStudentId');
    $SchoolIDQuery = $this->db->query("SELECT * FROM tbluser WHERE SchoolID = '$SchoolID'");

    $isSchoolIdExist = false;

    if ($SchoolIDQuery->num_rows() > 0) {
      $isSchoolIdExist = true;
    }

    $hashPassword = hash("sha256", $this->input->post('txtPassword'));

    $error = false;

    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword') && !$error) {

      $this->session->set_flashdata('RegisterFailed', 'Password not match.');

      $error = true;
    } else if ($isSchoolIdExist && !$error) {

      $this->session->set_flashdata('RegisterFailed', 'Student ID is already exist.');

      $error = true;
    } else if (!$this->routines->validateEmail($email) && !$error) {

      $this->session->set_flashdata('RegisterFailed', 'The email was invalid only accepts wvsu.edu.ph email.');

      $error = true;
    } else {
      if ($this->routines->isEmailExist($email)) {
        $this->session->set_flashdata('updateFailed', 'The email already exist.');

        $error = true;
      } else {
        $data = array(
          "Email" => $email,
          "last_name" => ucfirst($this->input->post("txtLname")),
          "first_name" => ucfirst($this->input->post("txtFname")),
          "middle_name" => ucfirst($this->input->post("txtMname")),
          "SchoolID" => $this->input->post("txtStudentId"),
          "Course" => strtoupper($this->input->post("txtCourse")),
          "YearSec" => strtoupper($this->input->post("txtYearSec")),
          "CollegeID" => $this->input->post("txtCollege"),
          "Gender" => ucwords($this->input->post("txtGender")),
          "Address" => ucwords($this->input->post("txtAddress")),
          "UserType" => "Student",
          "Status" => "Inactive",
          "HashedPassword" => $hashPassword,
        );

        $userID = $this->main_model->insert_entry('tbluser', $data);
        $this->session->set_flashdata('RegisterSuccess', 'Registration was successfully saved.');
        $otp = $this->routines->generateOTP(6);
        $this->session->set_userdata("OTP", $otp);
        $send_email = $this->routines->sendEmail("Email verification", "Your OTP Code is: $otp", $email);
        redirect(site_url() . "student/email_verification/$userID");
      }
    }

    if ($error) {
      $this->session->set_flashdata('Email', $this->input->post('txtEmail'));
      $this->session->set_flashdata('last_name', $this->input->post('txtLname'));
      $this->session->set_flashdata('first_name', $this->input->post('txtFname'));
      $this->session->set_flashdata('middle_name', $this->input->post('txtMname'));
      $this->session->set_flashdata('SchoolID', $this->input->post('txtStudentId'));
      $this->session->set_flashdata('Course', $this->input->post('txtCourse'));
      $this->session->set_flashdata('YearSec', $this->input->post('txtYearSec'));
      $this->session->set_flashdata('CollegeID', $this->input->post('txtCollege'));
      $this->session->set_flashdata('Gender', $this->input->post('txtGender'));
      $this->session->set_flashdata('Address', $this->input->post('txtAddress'));
    }

    redirect(site_url() . 'student/student_register');
  }

  public function profile_edit()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Edit Profile';
    $data['sub_heading'] = 'Edit Profile';
    $data['content'] = 'profile_edit';
    $this->load->view('student/student_template', $data);
  }

  public function profile_edit_save()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data = array(
      'Fullname' => $this->input->post('txtFullname'),
      'CollegeID ' => $this->input->post('txtCollege'),
      'Course' => $this->input->post('txtCourse'),
      'YearSec' => $this->input->post('txtYearSec'),
      'BiologicalSex' => $this->input->post('txtBiologicalSex'),
      'IdentifiedGender' => $this->input->post('txtIdentifiedGender'),
      'Address' => $this->input->post('txtAddress'),
    );
    $this->main_model->update_entry('tbluser', $data, 'UserID', $this->session->userdata('StudentUserID'));
    redirect(site_url() . 'student/profile_edit');
  }

  public function change_password()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Change Password';
    $data['sub_heading'] = 'Change Password';
    $data['content'] = 'change_password';
    $this->load->view('student/student_template', $data);
  }

  public function change_password_save()
  {
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('pass_msg', 'Password not match.');
      redirect(site_url() . 'student/change_password');
    }

    $OldPassword = hash("sha256", $this->db->escape_str($this->input->post('txtOldPassword')));
    $hashPassword = hash("sha256", $this->input->post('txtPassword'));
    $Query = $this->db->query("SELECT * FROM tbluser WHERE UserID = '{$this->session->userdata('StudentUserID')}' AND HashedPassword = '{$OldPassword}';");
    if ($Query->num_rows() <> 0) {
      $data = array(
        'HashedPassword' => $hashPassword,
      );
      $this->main_model->update_entry('tbluser', $data, 'UserID', $this->session->userdata('StudentUserID'));
      $this->session->set_flashdata('pass_msg', 'Password was successfully changed.');
      redirect(site_url() . 'student/change_password');
    } else {
      $this->session->set_flashdata('pass_msg', 'Old password was incorrect.');
      redirect(site_url() . 'student/change_password');
    }
  }

  public function change_profile_picture()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Change Profile Picture';
    $data['sub_heading'] = 'Change Profile Picture';
    $data['content'] = 'change_profile_picture';
    $this->load->view('student/student_template', $data);
  }

  public function change_profile_picture_save()
  {
    $result = $this->routines->Upload('/uploads', 30, 'pdf|jpg|png');
    echo $result['file_name'];
    $ImageLoc = $result['file_name'];
    $data = array(
      'ImageLoc' => $ImageLoc
    );
    $this->main_model->update_entry('tbluser', $data, 'UserID', $this->session->userdata('StudentUserID'));
    $this->routines->del_image($this->session->userdata('StudentImageLoc'));
    $this->session->set_userdata('StudentImageLoc', $ImageLoc);
    redirect(site_url() . 'student/change_profile_picture');
  }

  // UPPER PART IS DONE ===================================================================================

  public function appointment_save()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {

      $data = array(
        'Referrer' => $this->input->post('txtReferrer'),
        'StudentName' => $this->input->post('txtStudentName'),
        'Email' => $this->input->post('txtEmail'),
        'CollegeID' => $this->session->userdata('StudentCollegeID'),
        'YearSection' => $this->input->post('txtYearSection'),
        'Address' => $this->input->post('txtAddress'),
        'PhoneNumber' => $this->input->post('txtPhoneNumber'),
        'OtherContact' => $this->input->post('txtOtherContact'),
        'Category' => $this->input->post('txtCategory'),
        'Platform' => $this->input->post('txtPlatform'),
        'PreferredTime' => $this->input->post('txtPreferredTime'),
        'SelectedDate' => $this->input->post('txtSelectedDate'),
        'CreatedBy' => $this->session->userdata('StudentUserID'),
        'AppointmentSchedID' => $this->input->post('txtAppointScheduleBy'),
      );
      if ($this->uri->segment(3) == '') {
        $this->main_model->insert_entry('tblappointment', $data);

        $updateData = array(
          "Status" => "Occupied"
        );
        $this->main_model->update_entry('tblappointmentsched', $updateData, 'AppointmentSchedID', $this->input->post('txtAppointScheduleBy'));
      } else {
        $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('AppointmentSuccess', 'true');
    } else {
      $this->session->set_flashdata('AppointmentSuccess', 'false');
    }
    redirect(site_url() . 'student/set_schedule_appointment');
  }

  public function index()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Profile';
    $data['sub_heading'] = 'Profile';
    $data['content'] = 'profile';
    $this->load->view('student/student_template', $data);
  }

  public function profile_save()
  {
    $email = $this->input->post('txtEmail');
    $txtSchoolId = $this->input->post('txtStudentId');
    $userId = $this->session->userdata('StudentUserID');

    $SchoolIDCount = $this->db->query("SELECT * FROM tbluser WHERE SchoolID ='$txtSchoolId' and UserID <> '$userId'")->num_rows();

    $error = false;

    if ($SchoolIDCount > 0 && !$error) {

      $this->session->set_flashdata('updateFailed', 'Student ID is already exist.');

      $error = true;
    } else if (!$this->routines->validateEmail($email) && !$error) {

      $this->session->set_flashdata('updateFailed', 'The email was invalid only accepts wvsu.edu.ph email.');

      $error = true;
    } else {

      if ($this->routines->isEmailExist($email, $userId)) {
        $this->session->set_flashdata('updateFailed', 'The email already exist.');

        $error = true;
      } else {
        $data = array(
          "Email" => $email,
          "last_name" => ucfirst($this->input->post("txtLname")),
          "first_name" => ucfirst($this->input->post("txtFname")),
          "middle_name" => ucfirst($this->input->post("txtMname")),
          "SchoolID" => $this->input->post("txtStudentId"),
          "Course" => strtoupper($this->input->post("txtCourse")),
          "YearSec" => strtoupper($this->input->post("txtYearSec")),
          "CollegeID" => $this->input->post("txtCollege"),
          "CivilStatus" => ucfirst($this->input->post("txtCivilStat")),
          "PlaceBirth" => ucwords($this->input->post("txtPlaceOfBirth")),
          "DateBirth" => $this->input->post("txtDateOfBirth"),
          "Gender" => ucwords($this->input->post("txtGender")),
          "Address" => ucwords($this->input->post("txtAddress")),
          "MobileNo" => $this->input->post("txtPhoneNumber"),
          "Religion" => ucwords($this->input->post("txtReligion")),
          "LivingArrangement" => ucwords($this->input->post("txtLivingArrangement")),
          "MinorityGroup" => ucwords($this->input->post("txtMinorityGroup")),
          "GuardianName" => ucwords($this->input->post("txtGuardianOrSpouseName")),
          "GuardianContactNumber" => $this->input->post("txtGuardianOrSpouseContact"),
          "GuardianOccupation" => ucwords($this->input->post("txtGuardianOrSpouseOccupation")),
          "GuardianOfficeAddress" => ucwords($this->input->post("txtGuardianOrSpouseOfficeAddress")),
          "EstAnnualIncome" => $this->input->post("txtEstAnnualIncome"),
          "SourceOfIncome" => $this->input->post("txtSourceOfIncome"),
          "Disability" => ucwords($this->input->post("txtDisability")),
          "GeneralCondition" => ucwords($this->input->post("txtGeneralCondition")),
          "GeneralConditionReason" => ucfirst($this->input->post("txtGeneralConditionReason")),
          "FBLink" => $this->db->escape_str($this->input->post("txtProfileLink")),
        );

        $this->main_model->update_entry('tbluser', $data, 'UserID', $userId);

        $this->session->set_flashdata('updateSuccess', 'Profile Updated successfully.');

        $this->session->set_userdata('StudentFullname', $this->routines->getUserFullName($userId));
        $this->session->set_userdata('StudentEmail', $email);
        $this->session->set_userdata('StudentCollegeID', $this->input->post("txtCollege"));
        $this->session->set_userdata('StudentSchoolID',  $this->input->post("txtStudentId"));
      }
    }

    redirect(site_url() . 'student');
  }

  public function wellness_checks()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Wellness Check';
    $data['sub_heading'] = 'Wellness Check';
    $data['content'] = 'wellness_checks';
    $this->load->view('student/student_template', $data);
  }

  public function wellness_check()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Wellness Check';
    $data['sub_heading'] = 'Wellness Check';
    $data['content'] = 'wellness_check';
    $this->load->view('student/student_template', $data);
  }

  public function save_wellness_check()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $AssessmentID = $this->uri->segment(3);
    $Assessment = '';
    $Semester = '';
    $NumberQuestion = 0;
    $NumberQuestionSent = 0;
    $TotalScoreMul = 0;
    $TotalScoreSent = 0;
    $result = $this->db->query("SELECT * FROM tblassessment WHERE AssessmentID = '" . $AssessmentID . "'");
    foreach ($result->result() as $row) {
      $Assessment = $row->Assessment;
      $Semester = $row->Semester;
      $NumberQuestion = $row->NumberQuestion;
      $NumberQuestionSent = $row->NumberQuestionSent;
    }
    for ($i = 1; $i <= $NumberQuestion; $i++) {
      $AnswerID = $this->db->query("SELECT * FROM tblanswer WHERE AssessmentID = '" . $AssessmentID . "' AND QuestionNumber = '" . $i . "' AND Category = 'MultipleChoice';")->row();
      if (isset($AnswerID->AnswerID)) {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestionMul' . $i),
          'Category' => $this->input->post('txtCategoryMul' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('StudentUserID'),
          'Answer' => $this->input->post('choices' . $i),
          'Score' => $this->input->post('choices' . $i),
        );
        $TotalScoreMul = $TotalScoreMul + $this->input->post('choices' . $i);
        $this->main_model->update_entry('tblanswer', $data, 'AnswerID', $AnswerID->AnswerID);
      } else {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestionMul' . $i),
          'Category' => $this->input->post('txtCategoryMul' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('StudentUserID'),
          'Answer' => $this->input->post('choices' . $i),
          'Score' => $this->input->post('choices' . $i),
        );
        $AnswerID = $this->main_model->insert_entry('tblanswer', $data);
      }
    }
    for ($i = 1; $i <= $NumberQuestionSent; $i++) {
      $AnswerResult = $this->analyzer_model->CheckData($this->input->post('txtAnswer' . $i));
      $TotalScoreSent = $TotalScoreSent + $AnswerResult['compound'];
      $AnswerID = $this->db->query("SELECT * FROM tblanswer WHERE AssessmentID = '" . $AssessmentID . "' AND QuestionNumber = '" . $i . "' AND Category = 'SentanceBased';")->row();
      if (isset($AnswerID->AnswerID)) {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestion' . $i),
          'Category' => $this->input->post('txtCategory' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('StudentUserID'),
          'Answer' => $this->input->post('txtAnswer' . $i),
          'Score' => $AnswerResult['compound'],
        );
        $this->main_model->update_entry('tblanswer', $data, 'AnswerID', $AnswerID->AnswerID);
      } else {
        $data = array(
          'QuestionNumber' => $i,
          'Question' => $this->input->post('txtQuestion' . $i),
          'Category' => $this->input->post('txtCategory' . $i),
          'AssessmentID' => $AssessmentID,
          'CreatedBy' => $this->session->userdata('StudentUserID'),
          'Answer' => $this->input->post('txtAnswer' . $i),
          'Score' => $AnswerResult['compound'],
        );
        $AnswerID = $this->main_model->insert_entry('tblanswer', $data);
      }
    }

    $data['TotalScoreMul'] = $TotalScoreMul;
    $data['TotalScoreSent'] = $TotalScoreSent;
    $data['heading'] = 'Wellness Check Results';
    $data['sub_heading'] = 'Wellness Check Results';
    $data['content'] = 'wellness_check_results';
    $this->load->view('student/student_template', $data);
  }

  public function set_schedule_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'New Schedule Appointment';
    $data['sub_heading'] = 'New Schedule Appointment';
    $data['content'] = 'set_schedule_appointment';
    $this->load->view('student/student_template', $data);
  }

  public function set_schedule_date()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');

    if ($this->uri->segment(3) == '') {
      redirect(site_url() . 'student/set_schedule_date');
    } else {
      $query = $this->db->query("SELECT * FROM tblappointmentsched WHERE AppointmentSchedID = '" . $this->uri->segment(3) . "'");
      $rowdata = $query->row();

      $this->session->set_userdata('AppointmentDate', $rowdata->AppointmentDate);
      $this->session->set_userdata('AppointmentTime', $rowdata->AppointmentTime);
      $this->session->set_userdata('AppointmentSchedID', $rowdata->AppointmentSchedID);
      redirect(site_url() . 'student/schedule_appointment/');
    }
  }

  public function schedule_appointment()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Schedule Appointment';
    $data['sub_heading'] = 'Schedule Appointment';
    $data['content'] = 'schedule_appointment';
    $this->load->view('student/student_template', $data);
  }

  public function schedule_appointment_save()
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
        'Category' => $this->input->post('txtCategory'),
        'Email' => $this->input->post('txtEmail'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      if ($this->uri->segment(3) == '') {
        $this->main_model->insert_entry('tblappointment', $data);
      } else {
        $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('Success', 'Appointment data was successfully saved.');

      $data = array(
        'Status' => 'Occupied',
      );
      $this->main_model->update_entry('tblappointmentsched', $data, 'AppointmentSchedID', $this->session->userdata('AppointmentSchedID'));
    } else {
      $this->session->set_flashdata('Failed', 'Appointment data was failed.');
    }
    echo "<script>alert('New appointment was successfully saved.');window.location='" . site_url() . 'user/select_date_refer/' . $this->uri->segment(3) . "'</script>";
  }

  public function save_wellness_check2()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    // Get tblwellnesscheck
    $Title = '';
    $WellnessType = '';
    $NumberQuestion = '';
    $EndDate = '';
    $CreatedOn = '';
    $WellnessCheckID = $this->uri->segment(3);
    $result = $this->db->query("SELECT * FROM tblwellnesscheck WHERE WellnessCheckID = '" . $WellnessCheckID . "'");
    foreach ($result->result() as $row) {
      $Title = $row->Title;
      $WellnessType = $row->WellnessType;
      $NumberQuestion = $row->NumberQuestion;
      $EndDate = $row->EndDate;
      $CreatedOn = date('Y-m-d', strtotime($row->CreatedOn));
    }

    // Decision
    if ($WellnessCheckID != 0) {
      if ($WellnessType == 'Quantitative') {
        // Variables
        $NumberQuestionCategory = 0;
        $TotalIdealScoreCategory = 0;
        $TotalScoreCategory = 0;
        $TotalOverall = 0;

        // Get All Category in tblwellnessquestion
        $tblwellnessquestionCategory = $this->db->query("SELECT DISTINCT Category FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "';");
        if ($tblwellnessquestionCategory->num_rows() <> 0) {
          // Insert / Update Results
          $data = array(
            'Remarks' => '',
            'WellnessCheckID' => $WellnessCheckID,
            'QScore' => 0,
            'SScore' => 0,
            'CreatedBy' => $this->session->userdata('StudentUserID'),
          );
          $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='" . $WellnessCheckID . "' AND CreatedBy='" . $this->session->userdata('StudentUserID') . "';");
          if ($tblresult->num_rows() <> 0) {
            $tblresult = $tblresult->row();
            $ResultID = $tblresult->ResultID;
            $this->main_model->update_entry('tblresult', $data, 'ResultID', $tblresult->ResultID);
          } else {
            $ResultID = $this->main_model->insert_entry('tblresult', $data);
          }
          foreach ($tblwellnessquestionCategory->result() as $CategoryRow) :
            $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "' AND Category='" . $CategoryRow->Category . "';");
            foreach ($tblwellnessquestion->result() as $row) :
              $NumberQuestionCategory++;
              $data = array(
                'QuestionID' => $row->QuestionID,
                'Question' => $row->Question,
                'Category' => $row->Category,
                'WellnessType' => $WellnessType,
                'WellnessCheckID' => $WellnessCheckID,
                'Answer' => $this->input->post('choices' . $row->QuestionID) + 0,
                'Score' => $this->input->post('choices' . $row->QuestionID) + 0,
                'Negative' => 0,
                'Neutral' => 0,
                'Positive' => 0,
                'Compound' => 0,
                'CreatedBy' => $this->session->userdata('StudentUserID'),
                'ResultID' => $ResultID,
              );
              $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='" . $row->QuestionID . "';");
              if ($tblanswer->num_rows() <> 0) {
                $tblanswer = $tblanswer->row();
                $AnswerID = $tblanswer->AnswerID;
                $this->main_model->update_entry('tblanswer', $data, 'AnswerID', $tblanswer->AnswerID);
              } else {
                $AnswerID = $this->main_model->insert_entry('tblanswer', $data);
              }
              $TotalScoreCategory = $TotalScoreCategory + $this->input->post('choices' . $row->QuestionID);
            endforeach;
            $TotalIdealScoreCategory = $NumberQuestionCategory * 4;
            $data = array(
              'WellnessCheckID' => $WellnessCheckID,
              'ResultID' => $ResultID,
              'Category' => $CategoryRow->Category,
              'IdealScore' => $TotalIdealScoreCategory,
              'Score' => $TotalScoreCategory,
              'CreatedBy' => $this->session->userdata('StudentUserID'),
            );
            $tblresultquan = $this->db->query("SELECT * FROM tblresultquan WHERE WellnessCheckID='" . $WellnessCheckID . "' AND ResultID='" . $ResultID . "' AND CreatedBy='" . $this->session->userdata('StudentUserID') . "';");
            if ($tblresultquan->num_rows() <> 0) {
              $tblresultquan = $tblresultquan->row();
              $ResultQuanID = $tblresultquan->ResultQuanID;
              $this->main_model->update_entry('tblresultquan', $data, 'ResultQuanID', $tblresultquan->ResultQuanID);
            } else {
              $ResultQuanID = $this->main_model->insert_entry('tblresultquan', $data);
            }
            $TotalOverall = $TotalOverall + $TotalScoreCategory;
            $TotalScoreCategory = 0;
            $NumberQuestionCategory = 0;
          endforeach;
          $data = array(
            'QScore' => $TotalOverall,
            'Results' => '',
          );
          $this->main_model->update_entry('tblresult', $data, 'ResultID', $ResultID);
        }
      } else {
        // Variables
        $TotalNegative = 0;
        $TotalNeutral = 0;
        $TotalPositive = 0;
        $TotalCompound = 0;
        $SScore = 0;
        $Results = 'N/A';

        $tblwellnessquestion = $this->db->query("SELECT * FROM tblwellnessquestion WHERE WellnessCheckID='" . $WellnessCheckID . "' AND Category='NONE';");
        $data = array(
          'Remarks' => '',
          'WellnessCheckID' => $WellnessCheckID,
          'QScore' => 0,
          'SScore' => 0,
          'CreatedBy' => $this->session->userdata('StudentUserID'),
        );
        $tblresult = $this->db->query("SELECT * FROM tblresult WHERE WellnessCheckID='" . $WellnessCheckID . "' AND CreatedBy='" . $this->session->userdata('StudentUserID') . "';");
        if ($tblresult->num_rows() <> 0) {
          $tblresult = $tblresult->row();
          $ResultID = $tblresult->ResultID;
          $this->main_model->update_entry('tblresult', $data, 'ResultID', $tblresult->ResultID);
        } else {
          $ResultID = $this->main_model->insert_entry('tblresult', $data);
        }
        if ($tblwellnessquestion->num_rows() <> 0) {
          foreach ($tblwellnessquestion->result() as $row) :
            $AnswerResult = $this->analyzer_model->CheckData($this->input->post('txtAnswer' . $row->QuestionID));
            $TotalNegative = $TotalNegative + $AnswerResult['neg'];
            $TotalNeutral = $TotalNeutral + $AnswerResult['neu'];
            $TotalPositive = $TotalPositive + $AnswerResult['pos'];
            $TotalCompound = $TotalCompound + $AnswerResult['compound'];

            if ($TotalNegative >= $SScore) {
              $SScore = $TotalNegative;
              $Results = 'Negative';
            }
            if ($TotalNeutral >= $SScore) {
              $SScore = $TotalNeutral;
              $Results = 'Neutral';
            }
            if ($TotalPositive >= $SScore) {
              $SScore = $TotalPositive;
              $Results = 'Positive';
            }
            $data = array(
              'QuestionID' => $row->QuestionID,
              'Question' => $WellnessCheckID,
              'Category' => $row->Category,
              'WellnessType' => $WellnessType,
              'WellnessCheckID' => $WellnessCheckID,
              'Answer' => $this->input->post('txtAnswer' . $row->QuestionID),
              'Score' => 0,
              'Negative' => $AnswerResult['neg'],
              'Neutral' => $AnswerResult['neu'],
              'Positive' => $AnswerResult['pos'],
              'Compound' => $AnswerResult['compound'],
              'CreatedBy' => $this->session->userdata('StudentUserID'),
              'ResultID' => $ResultID,
            );
            $tblanswer = $this->db->query("SELECT * FROM tblanswer WHERE QuestionID='" . $row->QuestionID . "';");
            if ($tblanswer->num_rows() <> 0) {
              $tblanswer = $tblanswer->row();
              $AnswerID = $tblanswer->AnswerID;
              $this->main_model->update_entry('tblanswer', $data, 'AnswerID', $tblanswer->AnswerID);
            } else {
              $AnswerID = $this->main_model->insert_entry('tblanswer', $data);
            }
          endforeach;
          $data = array(
            'SScore' => $SScore,
            'Results' => $Results,
          );
          $this->main_model->update_entry('tblresult', $data, 'ResultID', $ResultID);
        }
      }
    }

    redirect(site_url() . 'student/wellness_check_results/' . $WellnessCheckID);

    // $data['TotalScoreMul']=$TotalScoreMul;
    // $data['TotalScoreSent']=$TotalScoreSent;
  }

  public function wellness_check_results()
  {
    $data['heading'] = 'Wellness Check Results';
    $data['sub_heading'] = 'Wellness Check Results';
    $data['content'] = 'wellness_check_results';
    $this->load->view('student/student_template', $data);
  }

  public function notification()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'Notification';
    $data['sub_heading'] = 'Notification';
    $data['content'] = 'notification';
    $this->load->view('student/student_template', $data);
  }

  public function history()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), site_url() . 'student/login');
    $data['heading'] = 'History';
    $data['sub_heading'] = 'History';
    $data['content'] = 'history';
    $this->load->view('student/student_template', $data);
  }

  public function login()
  {
    $this->routines->ifLogin($this->session->userdata('StudentUserID'), $this->session->userdata('StudentLocation'), false);
    $data['heading'] = 'Student Login';
    $this->load->view('student/login', $data);
  }

  public function student_login()
  {
    if (!$this->input->post('txtUsername')) {
      redirect(site_url() . 'student/login');
    }

    $UserType = $this->db->escape_str('Student');
    $username = $this->db->escape_str($this->input->post('txtUsername'));
    $password = hash("sha256", $this->db->escape_str($this->input->post('txtPassword')));
    $Query = $this->db->query("SELECT * FROM tbluser WHERE SchoolID = '{$username}' AND HashedPassword = '{$password}' AND UserType = '{$UserType}' LIMIT 1;");
    if ($Query->num_rows() <> 0) {
      $rowdata = $Query->row();
      if ($rowdata->Status == 'Inactive') {
        $this->session->set_flashdata('Failed', 'Login authentication failed, please verify your email.');
        redirect(site_url() . 'student/login');
      }
      $this->session->set_userdata('StudentUserID', $rowdata->UserID);
      $this->session->set_userdata('StudentUserType', $rowdata->UserType);
      $this->session->set_userdata('StudentFullname', $this->routines->getUserFullName($rowdata->UserID));
      $this->session->set_userdata('StudentEmail', $rowdata->Email);
      $this->session->set_userdata('StudentCollegeID', $rowdata->CollegeID);
      $this->session->set_userdata('StudentSchoolID', $rowdata->SchoolID);
      $this->session->set_userdata('StudentImageLoc', $rowdata->ImageLoc);
      $this->session->set_userdata('StudentLocation', site_url() . 'student');
      redirect(site_url() . 'student');
    } else {
      $this->session->set_flashdata('Failed', 'Login Authentication Failed.');
      redirect(site_url() . 'student/login');
      // echo '<script>alert("Login Authentication Failed.");window.location="' . site_url().'admin/login' . '";</script>';
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(site_url() . 'student/login');
  }

  public function email_verification()
  {
    $data['heading'] = 'Student Email Verification';
    $this->load->view('student/email_verification', $data);
  }

  public function student_verify()
  {
    $userID = $this->uri->segment(3);
    if ($this->input->post("txtOTPCode") != "") {
      if ($this->input->post("txtOTPCode") == $this->session->userdata("OTP")) {
        $data = array(
          'Status' => 'Active',
        );
        $this->main_model->update_entry('tbluser', $data, 'UserID', $userID);
        $this->session->set_flashdata('Success', "Your email is verified.\nPlease remain for the system will redirect you to the login page.");
      } else {
        $this->session->set_flashdata('Failed', "OTP Code not match.");
      }
    } else {
      $this->session->set_flashdata('Failed', "We didn't get your OTP Code.\nPlease try again.");
    }
    redirect(site_url() . "student/email_verification/$userID");
  }

  public function testdata()
  {
    echo '<pre>';
    print_r($this->analyzer_model->CheckData("Bill will join swimming classes this summer."));
    $data = $this->analyzer_model->CheckData("Bill will join swimming classes this summer.");
    echo $data['pos'];
    echo '<br>MAX: ' . max($this->analyzer_model->CheckData("Bill will join swimming classes this summer."));
  }

  public function refer_appointment()
  {
    $data['heading'] = 'Reffer An Appointment';
    $this->load->view('admin/refer_appointment', $data);
  }

  public function assessments()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Assessments';
    $data['content'] = 'assessments';
    $this->load->view('admin_template', $data);
  }

  public function students()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Student List';
    $data['content'] = 'students';
    $this->load->view('admin_template', $data);
  }

  public function admin_lists()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Admin List';
    $data['content'] = 'admin_lists';
    $this->load->view('admin_template', $data);
  }

  public function admin_list()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Admin Details';
    $data['content'] = 'admin_details';
    $this->load->view('admin_template', $data);
  }

  public function admin_portal()
  {
    $data['heading'] = 'Admin Register';
    $this->load->view('admin/admin_register', $data);
  }

  public function admin_portal_save()
  {
    // wvsu.edu.ph
    if ($this->input->post('txtPassword') <> $this->input->post('txtConfirmPassword')) {
      $this->session->set_flashdata('RegisterFailed', 'Password not match.');
      redirect(site_url() . 'admin/admin_portal');
    }

    $SchoolID = $this->db->query("SELECT * FROM tbluser WHERE SchoolID = '" . $this->input->post('txtSchoolID') . "';")->row()->SchoolID;


    if ($SchoolID != '') {
      $this->session->set_flashdata('RegisterFailed', 'Admin ID is already exist.');
      redirect(site_url() . 'admin/admin_portal');
    }

    $hashPassword = hash("sha256", $this->input->post('txtPassword'));
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {
      if ($this->uri->segment(3) == '') {
        $data = array(
          'HashedPassword' => $hashPassword,
          'Fullname' => $this->input->post('txtFullname'),
          'UserType' => 'Admin',
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
          'Status' => 'Active',
        );
        $this->main_model->insert_entry('tbluser', $data);
      } else {
        $data = array(
          'HashedPassword' => $hashPassword,
          'Fullname' => $this->input->post('txtFullname'),
          'UserType' => 'Student',
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
          'Status' => 'Active',
        );
        $this->main_model->update_entry('tbluser', $data, 'UserID', $this->uri->segment(3));
      }
      $this->session->set_flashdata('RegisterSuccess', 'Registration was successfully saved.');
    } else {
      $this->session->set_flashdata('RegisterFailed', 'The email was invalid only accepts wvsu.edu.ph email.');
    }
    redirect(site_url() . 'admin/admin_portal');
    // echo '<script>alert("Registration was successfully saved.");window.location="' . site_url().'admin/student_register' . '";</script>';
    // redirect(site_url().'admin/users');
  }

  public function completed_appointment()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Completed Appointment List';
    $data['content'] = 'completed_appointment';
    $this->load->view('admin_template', $data);
  }

  public function pending_appointment()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Appointment List';
    $data['content'] = 'pending_appointment';
    $this->load->view('admin_template', $data);
  }

  public function assessment()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Assessment';
    $data['content'] = 'assessment';
    $this->load->view('admin_template', $data);
  }

  public function save_assessment()
  {
    $AssessmentID = 0;
    if ($this->uri->segment(3) == '') {
      $data = array(
        'Assessment' => $this->input->post('txtAssessment'),
        'Semester' => $this->input->post('txtSemester'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $AssessmentID = $this->main_model->insert_entry('tblassessment', $data);
    } else {
      $data = array(
        'Assessment' => $this->input->post('txtAssessment'),
        'Semester' => $this->input->post('txtSemester'),
        'NumberQuestion' => $this->input->post('txtNumberQuestion'),
      );
      $this->main_model->update_entry('tblassessment', $data, 'AssessmentID', $this->uri->segment(3));
      $AssessmentID = $this->uri->segment(3);
    }
    $this->session->set_userdata('TotalQuestion', $this->input->post('txtTotalQuestion'));
    $this->session->set_userdata('AssessmentID', $AssessmentID);
    redirect(site_url() . 'admin/question/' . $AssessmentID);
  }

  public function save_questions()
  {
    $AssessmentID = $this->uri->segment(3);
    $Assessment = '';
    $Semester = '';
    $NumberQuestion = 0;
    $result = $this->db->query("SELECT * FROM tblassessment WHERE AssessmentID = '" . $AssessmentID . "'");
    foreach ($result->result() as $row) {
      $Assessment = $row->Assessment;
      $Semester = $row->Semester;
      $NumberQuestion = $row->NumberQuestion;
    }
    for ($i = 1; $i <= $NumberQuestion; $i++) {
      $data = array(
        'QuestionNumber' => $i,
        'Question' => $this->input->post('txtQuestion' . $i),
        'Category' => $this->input->post('txtCategory' . $i),
        'AssessmentID' => $AssessmentID,
        'CreatedBy' => $this->session->userdata('UserID'),
      );
      $QuestionID = $this->main_model->insert_entry('tblquestion', $data);
    }

    redirect(site_url() . 'admin/assessments');
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
    redirect(site_url() . 'admin/assessments');
  }

  public function question()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Question';
    $data['content'] = 'question';
    $this->load->view('admin_template', $data);
  }

  public function colleges()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Colleges';
    $data['content'] = 'colleges';
    $this->load->view('admin_template', $data);
  }

  public function college()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'College';
    $data['content'] = 'college';
    $this->load->view('admin_template', $data);
  }

  public function save_college()
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
    redirect(site_url() . 'admin/college/' . $this->uri->segment(3));
  }

  public function delete_college()
  {
    if ($this->uri->segment(3) == '') {
    } else {
      $this->main_model->delete_entry('tblcollege', 'CollegeID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'College data was successfully deleted.');
    redirect(site_url() . 'admin/colleges');
  }

  public function appointments()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Appointments';
    $data['content'] = 'appointments';
    $this->load->view('admin_template', $data);
  }

  public function schedule()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Create Schedule';
    $data['content'] = 'schedule';
    $this->load->view('admin_template', $data);
  }

  public function save_schedule()
  {
    $data = array(
      'AppointmentDate' => $this->input->post('txtAppointmentDate'),
      'AppointmentTime' => $this->input->post('txtAppointmentTime'),
      'Status' => 'Active',
      'CreatedOn' => $this->routines->getCurrentDateTime(),
      'CreatedBy' => $this->session->userdata('UserID'),
    );
    if ($this->uri->segment(3) == '') {
      $this->main_model->insert_entry('tblappointmentsched', $data);
    } else {
      $this->main_model->update_entry('tblappointmentsched', $data, 'AppointmentSchedID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'Appointment schedule data was successfully saved.');
    redirect(site_url() . 'admin/schedule/' . $this->uri->segment(3));
  }

  public function appointment()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Appointment';
    $data['content'] = 'appointment';
    $this->load->view('admin_template', $data);
  }

  public function view_appointment()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'View Appointment';
    $data['content'] = 'view_appointment';
    $this->load->view('admin_template', $data);
  }

  public function save_appointment()
  {
    $email = $this->input->post('txtEmail');

    if ($this->routines->validateEmail($email)) {
      $data = array(
        'Referrer' => $this->input->post('txtReferrer'),
        'StudentName' => $this->input->post('txtStudentName'),
        'CollegeID' => $this->input->post('txtCollege'),
        'YearSection' => $this->input->post('txtYearSection'),
        'Address' => $this->input->post('txtAddress'),
        'PhoneNumber' => $this->input->post('txtPhoneNumber'),
        'OtherContact' => $this->input->post('txtOtherContact'),
        'Category' => $this->input->post('txtCategory'),
        'Platform' => $this->input->post('txtPlatform'),
        'PreferredTime' => $this->input->post('txtPreferredTime'),
        'SelectedDate' => $this->input->post('txtSelectedDate'),
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
    redirect(site_url() . 'admin/appointment/' . $this->uri->segment(3));
  }

  public function appointment_reports()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Appointment Reports';
    $data['content'] = 'appointment_reports';
    $this->load->view('admin_template', $data);
  }

  public function assessment_reports()
  {
    $this->routines->checkCurrentLogin();
    $data['heading'] = 'Assessment Reports';
    $data['content'] = 'assessment_reports';
    $this->load->view('admin_template', $data);
  }

  public function delete_appointment()
  {
    if ($this->uri->segment(3) == '') {
    } else {
      $this->main_model->delete_entry('tblappointment', 'AppointmentID', $this->uri->segment(3));
    }
    $this->session->set_flashdata('Success', 'Appointment data was successfully deleted.');
    redirect(site_url() . 'admin/appointments');
  }

  public function update_status()
  {
    $data = array(
      'Status' => ''
    );
    if ($this->uri->segment(3) == '') {
    } else {
      $data = array(
        'Status' => urldecode($this->uri->segment(4))
      );
      $this->main_model->update_entry('tblappointment', $data, 'AppointmentID', $this->uri->segment(3));
      //send email
      $sendemail = $this->routines->sendEmail("Appointment Status", "Your appointment was " . urldecode($this->uri->segment(4)), $this->session->userdata('AppointmentEmail'));
    }
    $this->session->set_flashdata('Success', 'Appointment data was successfully saved.');
    redirect(site_url() . 'admin/view_appointment/' . $this->uri->segment(3));
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
