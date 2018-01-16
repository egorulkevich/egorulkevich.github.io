<?php 
if(!empty($_POST['adminsecretcode'])){
	$_SESSION['adminsecretcode']=sf($_POST['adminsecretcode']);
	?>
<script type="text/javascript">
	location.replace("/?page=<?=$adminadress?>&action=log");
</script>
<noscript>
	<meta http-equiv="refresh" content="0; url=/?page=<?=$adminadress?>&action=log">
</noscript>
	<?}?>
<center>
<form action="" method="POST">
<input type="text" name="adminsecretcode" placeholder="Секретная фраза"> <input type="submit" value="Продолжить">
</form>
</center>