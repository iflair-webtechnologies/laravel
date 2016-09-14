<?php 
class PaymentController extends Controller
{
	var $conf = array();
	var $Type,$InvoiceCode,$OrderCode,$Amount;
	
	function __construct() {
		//construct
		define("IDEAL_EMAIL","http://192.168.1.193/test/test/ideal/");
		$this->OrderCode = 'A123';
		$this->Amount = 15;
	}
	
	public function loadConf() {
		$this->conf['MerchantID'] = '2537447683';
		$this->conf['Password'] = 'b3e72b555d316cde8f3a32fdccff34c8a550b5db';
	}
}	
?>