<?
$opened = $db->numRows($db->query("SELECT id FROM deposits WHERE status=?i",0));
$closed = $db->numRows($db->query("SELECT id FROM deposits WHERE status=?i",1));
$users = $db->numRows($db->query("SELECT id FROM ss_users"));

if($balance_ == true){
	require_once('core/classes/cpayeer.php');
	$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
	if($payeer->isAuth()){
		$balance = $payeer->getBalance();
		$balance = $balance["balance"]["RUB"]["DOSTUPNO"] . ' <i class="fa fa-rub"></i>';
	}else{
		$balance = '<font color="red">ERROR</font>';
	}
}else{
	$balance = $db->fetch($db->query("SELECT SUM(summa) AS Summa FROM deposits WHERE status=?i",0));
}
?>
<html>
<head>
	<title>Инвестиции | <?=$sitename;?></title>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.png">
	<link rel="stylesheet" href="/media/css/style.css">
	<link rel="stylesheet" href="/media/css/font-awesome.css">
	<script type="text/javascript" src="/media/js/jquery-1.7.2.js"></script>
</head>
<body>
	<div id="wrap">
	<div id="_content">
		<div id="header">
			<div class="_menu">
				<div class="menu">
				<ul class="logo">
					<a href="/">
					<li id="logo"><img src="/media/svg/logo.svg" alt="<?=$sitename;?>" height="54" width="54"/></li>
					<li><?=$sitename;?></li>
					</a>
				</ul>
				<ul class="navigation">
					<a href="/?page=about"><li>О ПРОЕКТЕ</li></a>
					<a href="/?page=rules"><li>СОГЛАШЕНИЕ</li></a>
					<a href="/?page=faq"><li>FAQ</li></a>
					<a href="/?page=payments"><li>ВЫПЛАТЫ</li></a>
				</ul>
				</div>
			</div>
			<div class="stats">
				<div class="stats_"><div class="sname">ИНВЕСТОРОВ</div><div class="sinfo"><?=$users+9;?></div></div>
				<div class="stats_"><div class="sname">ОТКРЫТЫХ ДЕПОЗИТОВ</div><div class="sinfo"><?=$opened;?></div></div>
				<div class="stats_"><div class="sname">ВЫПЛАТ</div><div class="sinfo"><?=$closed;?></div></div>
				<div class="stats_"><div class="sname">БАЛАНС СИСТЕМЫ</div><div class="sinfo"><?if($balance_==1){echo $balance;}else{if(empty($balance['Summa'])){echo $balance['Summa']+1;}else{echo $balance['Summa'];}}?></div></div>
			</div>
			<div class="tape_">			
<?if(empty($id)){?>						
	<form action="" method="post">
		<input type="hidden" name="do" value="toaccount">
		<input type="hidden" name="antipovtor" value="<?=time();?>">					
		<input name="wallet" required class="login_" placeholder="Кошелёк PAYEER"/><button class="_login" type="submit">АВТОРИЗАЦИЯ</button>
	</form>	
<?}else{?>
	<form action="" method="post">
		<input type="hidden" name="do" value="payeer_pay">
		<input type="hidden" name="antipovtor" value="<?=time();?>">					
		<input name="m_amount" required class="deposit_" placeholder="СУММА ВКЛАДА"/><button class="_deposit" type="submit">СДЕЛАТЬ ВКЛАД</button>
	</form>
	<a href="/?page=exit"><button class="button_">ВЫХОД</button></a>
	<a href="/?page=payments"><button class="button_">ВЫПЛАТЫ ПРОЕКТА</button></a>
	<a href="/?page=my"><button class="button_">МОИ ДЕПОЗИТЫ</button></a>
	<a href="/?page=referals"><button class="button_">РЕФЕРАЛЫ</button></a>
<?}?>
			</div>
		</div>
	<div id="content">