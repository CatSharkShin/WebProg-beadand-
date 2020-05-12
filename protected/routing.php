<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'home';

switch ($_GET['P']) {
	case 'home': require_once PROTECTED_DIR.'normal/home.php'; break;
	case 'test': require_once PROTECTED_DIR.'normal/permission_test.php'; break;


	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;

	case 'register': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;

	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;

	case 'users': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/user_list.php' : header('Location: index.php'); break;

	case 'products': IsUserLoggedIn() ? require_once PROTECTED_DIR.'webshop/products.php' : header('Location: index.php'); break;

	case 'ordermanager': IsUserLoggedIn() ? require_once PROTECTED_DIR.'webshop/ordermanager.php' : header('Location: index.php'); break;

	case 'orders': IsUserLoggedIn() ? require_once PROTECTED_DIR.'webshop/orders.php' : header('Location: index.php'); break;

	case 'webshop': require_once PROTECTED_DIR.'webshop/webshop.php'; break;

	case 'orderresult': require_once PROTECTED_DIR.'webshop/orderresult.php'; break;

	case 'cart': require_once PROTECTED_DIR.'webshop/cart.php'; break;
	default: require_once PROTECTED_DIR.'normal/404.php'; break;
}

?>