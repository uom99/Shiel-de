<!-- 세션 관리 -->
<?php
	session_start();
	if (isset($_SESSION["userid"])) {
		$userid = $_SESSION["userid"];
	}else{
		$userid = "";
	}if (isset($_SESSION["useruname"])){
		$username = $_SESSION["useruname"];
	}else{
		$username = "";
	}if (isset($_SESSION["role"])){ // 사용자, 관리자 구분 용도
		$role = $_SESSION["role"];
	}else{
		$role = "";
	}if (isset($_SESSION["usernick"])) {
		$usernick = $_SESSION["usernick"];
	}else{
		$usernick = "";
	}
	if (isset($_SESSION["usernum"])) {
		$usernum = $_SESSION["usernum"];
	}else{
		$usernum = "";
	}
	if (isset($_SESSION["userpass"])){
		$userpass = $_SESSION["userpass"];
	}else{
		$userpass = "";
	}


	
?>