<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Routines extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}
	
	function getCurrentDateTime()
	{
	$time = time();
	$datestring = "%Y-%m-%d %H:%i:%s";
	return mdate($datestring, $time);
	}
	function InsertCSRF()
	{
		return '<input type="hidden" id="'.$this->security->get_csrf_token_name().'" name="'.$this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'"/>';	
	}

    function checkAdminLogin() {
        if($this->session->userdata('UserID')!=null) {
        	if($this->session->userdata('UserType')=='Administrator') {
            	redirect(site_url().'admin');
        	} elseif($this->session->userdata('UserType')=='Councilor') {
            	redirect(site_url().'councilor');
        	} else {
            	redirect(site_url().'user');
        	}
        }
    }

    function createNotification($Notification,$NotificationTo,$CreatedBy) {
        $data = array(
            'Notification' => $Notification,
            'NotificationTo' => $NotificationTo,
            'CreatedBy' => $CreatedBy
        );
        $NotificationID=$this->main_model->insert_entry('tblnotification',$data);
    }

    function isWellnessCheckQuestionPublish() {
        $isPublish=false;
        $WeekP=$this->db->query("SELECT MAX(CreatedOn) AS 'WeekP' FROM tblwellnessquestionpublish;")->row()->WeekP;
        $mondaythisweek=date('Y-m-d', strtotime('monday this week', now()));
        $WeekP=date('Y-m-d', strtotime($WeekP));
        $WeekPYear=date('Y', strtotime($WeekP));
        $WeekPMonth=date('m', strtotime($WeekP));
        $WeekPDay=date('d', strtotime($WeekP));
        $mondaythisweekpublish=date('Y-m-d', strtotime('monday this week', mktime(0,0,0, $WeekPMonth, $WeekPDay, $WeekPYear)));
        if($mondaythisweek==$mondaythisweekpublish) {
            $isPublish=true;
        }
        return $isPublish;
    }

    function callSweetAlert($title,$type='info',$msg='') {
    	return '<script type="text/javascript">swal("'.$title.'", "'.$msg.'", "'.$type.'");</script>';
    }

	//$this->routines->callSweetAlertYesNo("Are you sure?","Once deleted, you will not be able to recover this imaginary file!","info","Oh noez!","Aww yiss!",site_url().'superadmin/wellness_checks',site_url().'superadmin/wellness_checks');

    function callSweetAlertYesNo($title,$text,$icon,$button1,$button2,$link1='',$link2='',$dangermode='false') {
    	return '<script type="text/javascript">
			swal({
			  title: "'.$title.'",
			  text: "'.$text.'",
			  icon: "'.$icon.'",
			  dangerMode: '.$dangermode.',
			  buttons: ["'.$button1.'", "'.$button2.'"],
			})
			.then((result) => {
			  if (result) {
			  	link1="'.$link1.'";
			  	if(link1!="") {
			    	window.location="'.$link1.'";
			  	}
			  } else {
			  	link2="'.$link2.'";
			  	if(link2!="") {
			    	window.location="'.$link2.'";
			  	}
			  }
			});
    	</script>';
    }

    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function getWellnessResult($type, $score, $totalquestions=0) {
    	$idealscore=$totalquestions*4;
    	$percentscore=round(($score/$idealscore)*100, 0);
    	if($type=='Quantitative') {
    		if($percentscore>=80) {
    			return 'Awesome! Your answers indicate that you\'re making positive steps in this dimension of wellness. Even though you achieved a high overall score for this dimension, you may want to check for low scores on individual items to see if there are more specific areas that you might want to address. Consider focusing on another area where your scores weren\'t so high.';
    		} elseif($percentscore<=79 && $percentscore>=50) {
    			return 'Caution! Your behaviours in this area are good, but there is room for improvement. Take a look at the items on which you scored lower. What changes might you make it to improve your score?';
    		} elseif($percentscore<=49 && $percentscore>=0) {
    			return 'Danger! Your answers indicate some potential health and well-being risks. Review those areas where you scored lower.';
    		}
    	} else {

    	}
    }

    function getCollege($college_id) {
	    $College = '';
	    $tblcollege=$this->db->query("SELECT * FROM tblcollege WHERE CollegeID = '".$college_id."';")->row();
	    if(isset($tblcollege->College)) {
	        $College = $tblcollege->College;
	    }
	    return $College;
    }

    function getUserFullname($user_id) {
	    $UserFullname = '';
	    $tbluser=$this->db->query("SELECT * FROM tbluser WHERE UserID = '".$user_id."';")->row();
	    if(isset($tbluser->Fullname)) {
	        $UserFullname = $tbluser->Fullname;
	    }
	    return $UserFullname;
    }

    function generateAdminID($length = 1) {
	    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

		$AUTO_INCREMENT = $this->db->query("SELECT AUTO_INCREMENT AS ID FROM information_schema.tables WHERE table_name = 'tbluser' and table_schema = '".$this->db->database."';")->row();
	    return date('Y') . $randomString . str_pad($AUTO_INCREMENT->ID, 5, '0', STR_PAD_LEFT);
	}

    function isAdminLogin() {
        if($this->session->userdata('UserID')==null) {
            redirect(site_url().'admin/login');
        }
    }
	
	function AppName()
	{
		$app = explode('/',base_url());
		return $app[count($app)-2];		
	}

	//$dir=/uploads/requirements
	//$allowed='pdf|jpg|png'
	function Upload($dir,$maxfilesize,$allowed)
	{
		$Root=$_SERVER['DOCUMENT_ROOT'].'/'.$this->AppName();
		$mb=$maxfilesize;
		$config['upload_path']          = $Root.$dir;
		$config['allowed_types']        = $allowed;
		$config['max_size']             = 1024 * $mb;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		
		if (!$this->upload->do_upload('File'))
		{
			$error = array('error' => $this->upload->display_errors());
			//print_r ($error);
			$res['status']='error';
			$res['error']=$error;
			$res['file_name']='';
			$res['file_ext']='';						
		}
		else
		{			
			$data = $this->upload->data();			
			$res['status']='success';
			$res['error']='';
			$res['file_name']=$data['file_name'];
			$res['file_ext']=$data['file_ext'];			
		}
		
		return $res;
	}

    function del_image($image_name) {
        $Root=$_SERVER['DOCUMENT_ROOT'].'/'.$this->AppName();
        $img=$Root.'/uploads/'.$image_name;
        if($image_name!='dummy-profile-pic.png') {
            if(file_exists($img)) {
                unlink($img);
            }
        }
    }

	public function getAge($birthDate) {
	    $currentDate = date("Y-m-d");
	    $age = date_diff(date_create($birthDate), date_create($currentDate));
	    return $age->format("%y");
	}

	public function validateEmail($email) {
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3}+(\.)+[a-zA-Z]{2,3})$/";
	    $result = preg_match($regex, $email) ? true : false;
	    if($result) {
		    $email = trim($email);
		    $result = mb_substr($email, -12) === '@wvsu.edu.ph';
	    }
	    return $result;
	}

// Online
// public function sendEmail($subject, $content, $email) {
//         /* Load PHPMailer library */
//         $this->load->library('phpmailer_lib');
       
//         /* PHPMailer object */
//         $mail = $this->phpmailer_lib->load();
       
//         /* SMTP configuration */
//         $mail->isSMTP();
//         $mail->Host     = 'smtpout.secureserver.net';
//         $mail->SMTPAuth = false;
//         $mail->SMTPAutoTLS = false;
//         $mail->Username = 'wvsu@wvsuguidance.online';
//         $mail->Password = 'Qwerty123!';
//         $mail->Port     = 465;
       
//         $mail->setFrom('no-reply@princejo.store', 'Mail');
//         $mail->addReplyTo('no-reply@princejo.store', 'Mail');
       
//         /* Add a recipient */
//         $mail->addAddress($email);
       
//         /* Add cc or bcc */
//         // $mail->addCC('cc@example.com');
//         // $mail->addBCC('bcc@example.com');
       
//         /* Email subject */
//         $mail->Subject = $subject;
       
//         /* Set email format to HTML */
//         $mail->isHTML(true);
       
//         /* Email body content */
//         $mail->Body = $content;
       
//        	$result = '';
//         /* Send email */
//         if(!$mail->send()){
//             $result = 'Mail could not be sent. '.'Mailer Error: ' . $mail->ErrorInfo;
//         }else{
//             $result = 'Mail has been sent';
//         }
//         return $result;
// 	}
	public function sendEmail($subject, $content, $email) {
        /* Load PHPMailer library */
        $this->load->library('phpmailer_lib');
       
        /* PHPMailer object */
        $mail = $this->phpmailer_lib->load();
       
        /* SMTP configuration */
        $mail->isSMTP();
        $mail->Host     = 'localhost';
        $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = true;
        $mail->Username = 'wvsu@wvsuguidance.xyz';
        $mail->Password = 'Y=1o9qi4#N';
        $mail->Port     = 25;
        $mail->SMTPSecure = 'tls';
       
        $mail->setFrom('wvsu@wvsuguidance.xyz', 'Mail');
        $mail->addReplyTo('wvsu@wvsuguidance.xyz', 'Mail');
       
        /* Add a recipient */
        $mail->addAddress($email);
       
        /* Add cc or bcc */
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
       
        /* Email subject */
        $mail->Subject = $subject;
       
        /* Set email format to HTML */
        $mail->isHTML(true);
       
        /* Email body content */
        $mail->Body = $content;
       
       	$result = '';
        /* Send email */
        if(!$mail->send()){
            $result = 'Mail could not be sent. '.'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            $result = 'Mail has been sent';
        }
        return $result;
	}

	public function loginAuth($user_id, $location, $login_location) {
        if($user_id != null) {
            redirect($location);
        } else {
            redirect($login_location);
        }
	}

	public function ifLogin($user_id, $location, $isLogin = true) {
		if($isLogin) {
	        if($user_id == null) {
	            redirect($location);
	        }
		} else {
	        if($user_id != null) {
	            redirect($location);
	        }
		}
	}

    function checkCurrentLogin() {
        if($this->session->userdata('UserID')!=null) {
        	$page=$this->uri->segment(1);
        	$userType=$this->session->userdata('UserType');
        	if($page=='') {
	        	if($userType=='Administrator') {
        			redirect(site_url().'superadmin');
	        	} elseif($userType=='Admin') {
        			redirect(site_url().'admin');
	        	} else {
        			redirect(site_url().'user');
	        	}
        	} else {
        		if($userType=='Administrator') {
        			if($page!='superadmin') {
        				redirect(site_url().'superadmin');
        			}
        		} elseif($userType=='Admin') {
        			if($page!='admin') {
        				redirect(site_url().'admin');
        			}
        		} else {
        			if($page!='user') {
        				redirect(site_url().'user');
        			}
        		}
        	}
        } else {
            redirect(site_url().'admin/login');
        }
    }
}