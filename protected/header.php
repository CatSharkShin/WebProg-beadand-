<center>
	<h3>
		Rubik's cube webshop
	</h3>
	<?php if(IsUserLoggedIn()): ?>
	<h4>Hey, <?=$_SESSION['fname']?></h4>
	<?php endif; ?>
</center>