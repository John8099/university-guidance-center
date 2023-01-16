<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'third_party/vendor/autoload.php';
use Sentiment\Analyzer;

class Analyzer_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

    function CheckData($text) {
        $obj=new Analyzer;
        return $obj->getSentiment($text);
    }
}