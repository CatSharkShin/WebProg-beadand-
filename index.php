<?php session_start(); ?>
<?php require_once 'protected/config.php'; ?>
<?php require_once USER_MANAGER; ?>
<?php require_once PRODUCT_MANAGER; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WebProg2 - Távoktatás 1</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- Saját CSS -->
	<link rel="stylesheet" type="text/css" href="<?=PUBLIC_DIR.'style.css?'.date('YmdHis', filemtime(PUBLIC_DIR.'style.css'))?>">
</head>
<body>
	<div class="container-fluid">
		<div class="top">
		<header><?php include_once PROTECTED_DIR.'header.php'; ?></header>
		<nav><?php require_once PROTECTED_DIR.'nav.php'; ?></nav>
		</div>
		<content><?php require_once PROTECTED_DIR.'routing.php'; ?></content>
		<footer><?php include_once PROTECTED_DIR.'footer.php'; ?></footer>
	</div>
</body>
</html>