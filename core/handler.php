<?
unset($_error);
if($_REQUEST['antipovtor']!=$_SESSION['antipovtor'] OR !isset($_REQUEST['antipovtor'])){	
$_SESSION['antipovtor']=$_REQUEST['antipovtor'];

if($id=='0' OR $id<0){
	?>
	<script type="text/javascript">
	location.replace("/?page=exit");
	</script>
	<noscript>
	<meta http-equiv="refresh" content="0; url=/?page=exit">
	</noscript>
	<?	
	exit();
}

if(isset($_POST['do']) && $_POST['do']=='toaccount' && $itworks==1){
$stopit = 0;
$_POST_wallet = strtoupper(trim(sf($_POST['wallet'])));
if($stopit!=1){
if(!empty($_COOKIE['ref'])){
$referer=(int)$_COOKIE['ref'];
}
if($referer<=$adminid OR empty($referer)){$referer=1;}

if(empty($_POST_wallet)){
	$_error = "Вы не ввели кошелек";
}
if($_POST_wallet[0]!='P'){
	$_error = "Кошелек Payeer имеет неверный формат!";	
}


}
if(empty($_error)){
	
$nofoot = 1;
$nohead = 1;	

$_POST_ip=getRealIP();

if(!empty($_COOKIE['ref'])){
	$referer=(int)$_COOKIE['ref'];
}
if(!empty($_SESSION['ref'])){
$referer=(int)$_SESSION['ref'];
}
$came=sf($_SESSION['came']);
toaccount($_POST_wallet, $_POST_ip, $came, $referer);
?>
	<script type="text/javascript">
	location.replace("/?page=my");
	</script>
	<noscript>
	<meta http-equiv="refresh" content="0; url=/?page=my">
	</noscript>
<?
exit();
}
}
if(isset($_POST['do']) && $_POST['do']=='payeer_pay'){
$m_amount = $_POST['m_amount'];
if($m_amount>0 AND $m_amount>=$mindep AND $m_amount<=$maxdep){
$m_amount = number_format($m_amount, 2, '.', '');
$m_desc = base64_encode($m_desc);
$m_orderid = $id;
$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc,
	$m_key
);
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>
					<div style="display:none">
                        <form method="GET" id="payeer_form_real" action="//payeer.com/merchant/">
                        <input type="hidden" name="m_shop" value="<?=$m_shop?>">
                        <input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
                        <input type="hidden" name="m_amount" value="<?=$m_amount?>">
                        <input type="hidden" name="m_curr" value="RUB">
                        <input type="hidden" name="m_desc" value="<?=$m_desc?>">
                        <input type="hidden" name="m_sign" value="<?=$sign?>">
                        <input type="submit" name="m_process"  value="Payeer" />
                        </form>
                    </div>
Redirecting...
<script>
document.getElementById('payeer_form_real').submit();
</script>


<?
$_success='Please wait...';

exit;
}else{
	if($m_amount<=0){
	$_error = "Вы не указали сумму";
	}else{
	$_error = "Вы указали неверную сумму (минимальная - ".$mindep."<i class=\"fa fa-rub\"></i>, максимальная - ".$maxdep."<i class=\"fa fa-rub\"></i>)";		
	}
}
}
}
?>