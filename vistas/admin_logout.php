<?php
	session_destroy();
	
	if(headers_sent()){
		echo "<script> window.location.href='index.php?vista=admin_login'; </script>";
	}else{
		header("Location: index.php?vista=admin_login");
	}