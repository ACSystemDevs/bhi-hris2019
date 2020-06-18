<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
 
require_once APPPATH."/third_party/php_zklib/zklib/ZKLib.php";
 
class CI_zklib extends ZKLib {
    public function __construct()
	{
		parent::__construct();
        
    }
}
?>