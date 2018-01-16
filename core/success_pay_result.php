<?php
$referer=$db->getOne("SELECT curator FROM `ss_users` WHERE id=?i", $id);
$db->query("INSERT INTO deposits (userid, curatorid, summa, unixtime) VALUES(?i,?i,?s,?s)", $id, $referer, $sum, time());	

$adminid=$db->getOne("SELECT id FROM `ss_users` WHERE wallet=?s", $koshelek_admina);
$adminsum=$sum*($admpercent/100);
addUserStat($adminid, "<!--stat--><!--whithdraw--><!--admin-->Выплата", "<!--stat--><!--whithdraw--><!--admin-->Выплата админских (".$adminsum." руб.)");
?>
