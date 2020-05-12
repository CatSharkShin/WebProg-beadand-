<?php 
	if(isset($_GET['result'])){
		if($_GET['result'] == "success")
			echo "Your order has been placed.";
		else if($_GET['result'] == "fail")
			echo "There was a problem placing your order. Please try again.";
	}else{
		echo "Seems like there's no result to let you know about";
	}
 ?>