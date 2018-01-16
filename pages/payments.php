<table class="table">
	<tbody>
		<tr>
			<td>ДАТА ВКЛАДА</td>
			<td>СИСТЕМА</td>
			<td>КОШЕЛЁК</td>
			<td>ВЫПЛАТА</td>
			<td>СТАТУС</td>
		</tr>
<? 
$depositsrow=$db->query("SELECT * FROM `deposits` WHERE status='1' ORDER BY id DESC LIMIT 100");
while($deposits=$db->fetch($depositsrow)){
	$wallet=substr($db->getOne("SELECT wallet FROM `ss_users` WHERE id=?i",$deposits['userid']), 0, -3); 	
	?> 
	<tr>
		<td><?=date('d.m.Y H:i',$deposits['unixtime'])?> <i class="fa fa-calendar"></i></td>
		<td><b>PAY<font color="#008cf0">EER</b></font></td>
		<td><?=$wallet?><font color="#CD0000">XXX</font></td>
		<td><?=(round($deposits['summa']+($deposits['summa']*($percent_u/100)),2));?> <i class="fa fa-rub"></i></td>
		<td><font color="#30630c"><b>ВЫПЛАЧЕНО</b></font></td>
	</tr>
<?}?>
	</tbody>
</table>