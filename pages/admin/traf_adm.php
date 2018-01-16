<div class="title">Сайты, с которых пришли зарегистрированные пользователи</div>
<center>
<?
$sql = "SELECT COUNT(DISTINCT came) AS countid FROM `ss_users`";
$res = $db->query($sql); 
$row=$db->fetch($res);
$maxid=$row["countid"];

$limit=20;

$p=(int)$_GET['p'];
if (!empty($_GET['p'])){$start=$limit*$p;}else{$start=0;}

$allpages=ceil($maxid/$limit);

$sql = "select came from `ss_users` GROUP BY came ORDER BY came ASC LIMIT ".$start.",".$limit;
$res = $db->query($sql); 
$i=0;
while($row=$db->fetch($res))
{
	$came=$row["came"]; 
		$sql2 = "select count(id) as countid from `ss_users` WHERE came='".$came."'";
		$res2 = $db->query($sql2); 
		$row2=$db->fetch($res2);
		$count=$row2["countid"]; 
		if($came!='Не определено' AND !empty($came)){
			echo "<a href='http://".$came."/' target='_blank'>".$came." <i>[".$count."]</i></a><br>";
		}else{
			echo $came." <i>[".$count."]</i><br>";
		}	
}
?><br><?
if($allpages>1){
?>СТРАНИЦА: <?
$i=0;
while($i<$allpages)
{
$p=$i+1;
	echo "<a href='/?page=".$adminadress."&action=traf&p=".$i."'>".$p."</a>&nbsp;";
	$i++;
}
}
?>
</center>
</div>