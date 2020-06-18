<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
 
require_once APPPATH."/third_party/php_fpdf/fpdf.php";
 
class CI_fpdf extends fpdf {
    public function __construct() {
        parent::__construct();
    }
}
?>