<?
$query = $db->query("SELECT SUM(summa) as summabatches FROM `batches` WHERE 1");	
$qqq=$db->fetch($query);
$summabatches=$qqq['summabatches'];


$query = $db->query("SELECT COUNT(id) as allusers FROM `ss_users` WHERE 1");	
$qqq=$db->fetch($query);
$allusers=$qqq['allusers'];

$query = $db->query("SELECT SUM(summa) as summawthd FROM `deposits` WHERE status=0");	
$qqq=$db->fetch($query);
$allin=$qqq['summawthd']*2;

$query = $db->query("SELECT SUM(summa) as summawthd FROM `deposits` WHERE status=1");	
$qqq=$db->fetch($query);
$allout=$qqq['summawthd']*2;

$query = $db->query("SELECT SUM(summa) as summawthd FROM `deposits` WHERE status=2");	
$qqq=$db->fetch($query);
$allerr=$qqq['summawthd']*2;
?>
<div class="text">
Всего пользователей: <?=$allusers?><br>
Всего введено в систему: <?=number_format($summabatches,2,'.',' ');?> <?=$m_curr?><br>
Выплат в ожидании <?=number_format($allout,2,'.',' ');?> <?=$m_curr?><br>
Всего выплачено <?=number_format($allout,2,'.',' ');?> <?=$m_curr?><br>
Ошибок выплат <?=number_format($allerr,2,'.',' ');?> <?=$m_curr?><br>
<form action="" method="POST">
<input type="hidden" name="antipovtor_adm" value="<?=time()?>">
<input type="hidden" name="admintoken" value="<?=md5($admintoken.$adminname.date('d.m.Y'))?>">
<input type="hidden" name="do" value="repay">
<input type="submit" name="submit" value="Вернуть ошибки в общую очередь">
</form>
<br>
Резерв проекта: <?=number_format(($summabatches-$allout),2,'.',' ');?> <?=$m_curr?><br>
</div>