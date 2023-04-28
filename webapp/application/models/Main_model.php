<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();       
		$this->load->database();
        date_default_timezone_set('Asia/Manila');
    }
	
	function gender($val)
	{
		if ($val==0) {
			return 'Female';
		} else {	
			return 'Male';
		}
	}		
	
    function insert_entry($table,$data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function delete_entry($table,$field,$id){
        $this->db->where($field, $id);
        $this->db->delete($table); 
    }
    
    function update_entry($table,$data,$id_name,$id)
    {
        $this->db->where($id_name,$id);
        $this->db->update($table, $data);
    }
	
	function SysConfig($Field)
	{
		$Query=$this->db->query("SELECT * FROM tblconfig WHERE Active = '1'");
		foreach($Query->result() as $rQuery)
			{
			return $rQuery->$Field;
			}
	}	
	
	function del_rec($table,$field,$id,$cbfld,$cbval)
	{
		$Query=$this->db->query("SELECT * FROM ".$table." WHERE ".$cbfld." = '".$cbval."'");
		if($Query->num_rows()<>0){
			$this->delete_entry($table,$field,$id);	
		}
	}
	
	function update_rec($table,$data,$id_name,$id,$cbfld,$cbval)
	{
		$Query=$this->db->query("SELECT * FROM ".$table." WHERE ".$cbfld." = '".$cbval."'");
		if($Query->num_rows()<>0){
			$this->update_entry($table,$data,$id_name,$id);	
		}
	}

	function generate_key_string($tokens,$segment_chars,$num_segments,$key_string) {
	 
/*		$tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$segment_chars = 5;
		$num_segments = 5;
		$key_string = '';*/
	 
		for ($i = 0; $i < $num_segments; $i++) {
	 
			$segment = '';
	 
			for ($j = 0; $j < $segment_chars; $j++) {
					$segment .= $tokens[rand(0, 35)];
			}
	 
			$key_string .= $segment;
	 
			if ($i < ($num_segments - 1)) {
					$key_string .= '-';
			}
	 
		}
	 
		return $key_string;
	 
	}
	
	function ActivationCodeURL(){
 		$tokens = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$segment_chars = 30;
		$num_segments = 1;
		$key_string = '';
		return $this->generate_key_string($tokens,$segment_chars,$num_segments,$key_string);		
	}
	
	function DisplayUserImage($dir)
	{	
		if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/reinc'.$dir)){
			$dir=base_url().'/media/accounts/no_image.gif';
		} else {
			$dir=base_url().$dir;
		}
		return '<img src="'.$dir.'" class="img-circle" alt="user image" width="62"/>';
		
	}

	function download_file($file_dir,$filename,$file_title)
	{				
			$DocTitle = $file_title;
			$FN = $filename;
			$CurrentFileDir = $file_dir;
		
			$f=explode(".",$FN);
			$ft=$f[count($f)-1];
			$DocTitle=$DocTitle.'.'.$ft;
			
			$File_Name=$FN;			
			$ContentType = "";
			$File_Path=$this->routines->FormatDir($CurrentFileDir);
			$File_Location=$File_Path.$File_Name;
			$DocTitle=str_replace(' ','_',$DocTitle);

			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . $DocTitle . "\""); 			
			readfile($File_Location);
		
	}

	function pdf_print($view,$psize,$orientation)
	{
		$this->load->library('pdf');
		$html = $this->load->view($view,NULL,TRUE);
		$this->pdf->loadHTML($html);
		
		$part=explode('/',$view);
		
		//PH LONG
		if($psize=='ph'){
			if($orientation=='portrait'){
				$customPaper = array(0,0,612.00,936.0);
			} else {
				$customPaper = array(0,0,936.0,612.00);
			}
			$this->pdf->set_paper($customPaper);			
		} else {
			$this->pdf->set_paper($psize, $orientation);
		}

		//$this->pdf->set_paper('8.5x11', 'landscape');		
		
		$this->pdf->set_option("isPhpEnabled", true);
		$this->pdf->render();
		$this->pdf->stream($part[2].".pdf",array("Attachment"=>0));		
	}
		
}
?>