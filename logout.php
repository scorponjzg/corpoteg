<?php
session_start();

// remove all session variables
//$_SESSION = array();
session_unset();
// si no funciona el anterior unset($_SESSION);
// destroy the session 
session_destroy();

header("Location: index.php"); /* Redirect browser */
	
exit();
?>