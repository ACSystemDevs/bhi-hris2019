<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
 
require_once APPPATH."/third_party/php_tcpdf/tcpdf.php";
 
class CI_tcpdf extends TCPDF {
    public function __construct()
	{
		parent::__construct();
        
    }
}
?>