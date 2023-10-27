<?php
	session_start();
	//session_unset();
	unset($_SESSION['adminID']);
    unset($_SESSION['adminFullname']);
    unset($_SESSION['adminEmail']);
    unset($_SESSION['adminPhoto']);
	header("Location: index.php");
?>