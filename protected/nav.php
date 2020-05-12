<hr>

<a href="index.php">Home</a>
<?php if(!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">Login</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">Register</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=webshop">Webshop</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=cart">Cart</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=orders">Orders</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Permission test</a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=ordermanager">Order Manager</a>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=users">User list</a>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=products">Product Manager</a>
		<span> &nbsp; || &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout">Logout</a>
<?php endif; ?>

<hr>