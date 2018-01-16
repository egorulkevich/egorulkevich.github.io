<?
if(empty($id)){?>
<center>Для доступа к данному разделу Вам необходимо пройти авторизацию!</center>
<?}else{?>

<div class="title">Партнерская программа</div>
<div class="text">
<center>Приглашая в проект своих друзей и знакомый, Вы будете получать <b><?=$refpercent;?>%</b> от каждого их вклада сразу на Ваш Payeer кошелёк!
Ваша партнерская ссылка: <input value=" <?=$http_s?>://<?=$host?>/?ref=<?=$id?>" onClick="select()" size="30" type="text"></center>
</div>
<?
$ihr = $db->getOne("SELECT i_have_refs_as_curator FROM ss_users WHERE id=?i",$id);

$refsprofit = $db->query("SELECT SUM(summa) as payed FROM deposits WHERE curatorid=?i",$id);
$refsprofit = $db->fetch($refsprofit);
$payed = $refsprofit['payed']*($refpercent/100);

$refsprofit = $db->query("SELECT SUM(summa) as waited FROM deposits WHERE status=?i AND curatorid=?i",0,$id);
$refsprofit = $db->fetch($refsprofit);
$waited = $refsprofit['waited']*($refpercent/100);
?>
<br>
<table class="table">
	<tbody>
		<tr>
			<td>РЕФЕРАЛОВ</td>
			<td>РЕФЕРАЛЬНЫЙ ДОХОД</td>
			<td>В ОЖИДАНИИ ВЫПЛАТ</td>
		</tr>
		<tr>
			<td><b><font color="#000;"><?=$ihr?> чел.</b></td>
			<td><b><font color="#000;"><b><?=$payed?> <i class="fa fa-rub"></i></b></td>
			<td><b><font color="#000;"><b><?=$waited?> <i class="fa fa-rub"></i></b></td>
		</tr>
	</tbody>
</table>
<br>
<? if($ihr>0){
$myrefsrow=$db->query("SELECT * FROM ss_users WHERE curator=?i ORDER BY id DESC",$id); 
while($myrefs=$db->fetch($myrefsrow)){
	$refprofit=$db->query("SELECT SUM(summa) as personalprofit FROM deposits WHERE userid=?i",$myrefs['id']);
	$refprofit=$db->fetch($refprofit);
	?> 
	<table class="table">
		<tbody>
			<tr>
				<td>ЛОГИН</td>
				<td>ДАТА РЕГИСТАРЦИИ</td>
				<td>ДОХОД ОТ ПАРТНЁРА</td>
			</tr>
			<tr>
				<td><?=$myrefs['wallet']?></td>
				<td><?=date('d.m.Y H:i:s',$myrefs['reg_unix'])?> <i class="fa fa-calendar"></i></td>
				<td><?=($refprofit['personalprofit']*($refpercent/100))?> <i class="fa fa-rub"></i></td>
			</tr>
		</tbody>
	</table>
<?}
}else{?>
<center>У вас нет рефералов</center>
<?}?>
<br>













<?}?>
