<?php 
session_start();
if(!defined('SCRIPT_BY_SIRGOFFAN')){
echo ('Выявлена попытка взлома!');
exit();
}

if($_SESSION['adminsecretcode']!=$adminsecretcode){	
	include_once('admin/login_adm.php');
}else{
define ("ADMIN_SIBHYIP_".$admintoken , "ZONDED");
$admintempldir='admin';
if(empty($_GET['action'])){$_GET['action']='log';}
if($_GET['action']=='stats'){
	$pagename_adm='Статистика';
	$description_adm='Основная статистика';
	include('admin/stats_adm.php');
}else
if($_GET['action']=='log'){
	$pagename_adm='Финансы';
	$description_adm='Здесь показаны все обращения к файлу-обработчику платежей<br>Если у блока зеленый фон, то значит платеж прошел и будет указано кто, сколько и с какой платежной системы оплатил<br>Еесли фон красный - значит ошибка платежа: неверные настройки или попытка накрутки системы. В данном случае будет показан логин того, кто пытался оплатить, а так же ответ платежной системы<br>Если фон серый - это данные полученные в режиме отладки';
	include_once('admin/log_adm.php');		
}else
if($_GET['action']=='traf'){
	$pagename_adm='Источники трафика';
	$description_adm='Слева показаны виджеты стороней статистики<br>Справа показаны сайты, с которых пришли пользователи<br>В квадратных скобках указано количество пришедших людей.';
	include('admin/traf_adm.php');
}else{
	$pagename_adm='МЕНЮ';
	$description_adm='';
	include('admin/dashboard_adm.php');	
	
}
if(!($_GET['action']=='bemail' AND isset($_GET['type']) AND $_GET['do']=='downloadmails')){
?>
<script type="text/javascript">
function printtitleblock(){
var titleblock = document.getElementById('titleblock'),
pagemane='<?=$pagename_adm?>';
titleblock.innerHTML = pagemane;

var descriptionblock = document.getElementById('descriptionblock'),
pagemane='<?=$description_adm?>';
descriptionblock.innerHTML = pagemane;

}
printtitleblock();
</script>
<?}}?>