<?php 
$classvalue = array();
$info = "";
$productregion = '';
$accountadvt = '';
$balance = '';
$changepassword = '';
$segment =  Request::segment(2);  
if($segment == 'mijn-villato'){
	$classvalue[$segment] = 'active';
}elseif ($segment == 'productregion') {
	$productregion = 'active';
}elseif ($segment == 'accountadvt') {
	 $accountadvt = 'active';
}elseif ($segment == 'balance') {
	$balance = 'active';
}elseif ($segment == 'changepassword') {
	$changepassword = 'active';
}else{
	$info = 'active';
}
?>
<ul class="egmenu">
  <li class="<?php echo $info; ?>"><a href="{{ route('global.account.index') }}">Informatie</a></li>
  <li class="<?php echo $productregion; ?>"><a href="{{ route('global.account.productregion') }}">Regio & producten</a> </li>
  <li class="<?php echo $accountadvt; ?>"><a href="{{ route('global.account.accountadvt') }}">Advertenties</a></li>
  <li class="<?php echo $balance; ?>"><a href="{{ route('global.account.balance') }}">Saldo</a></li>
  <li class="<?php echo $changepassword; ?>"><a href="{{ route('global.account.changepassword') }}">Wachtwoord</a></li>
</ul>