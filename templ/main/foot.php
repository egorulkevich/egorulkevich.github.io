		<div id="footer">
			<div class="tfooter"><?=$sitename;?> 2017 <i class="fa fa-copyright"></i> Все права защищены | <?=$adminmail;?></div><div class="ifooter"><img src="/media/images/payeer.png"/></div>
		</div>
		<?if(!empty($_error)){?><div class="message" id="error"><?=$_error?></div><?}?>
		<?if(!empty($_success)){?><div class="message" id="ok"><?=$_success?></div><?}?>
	</div>
	</div>
</body>
</html>