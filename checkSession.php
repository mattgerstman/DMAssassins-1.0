<?php
function check()

{
	session_start();
	if(!(isset($_SESSION['DM1-username'])))
	{//checks if session is set, if not redirect to login
  		// Not logged in
  		header('Location: login.php');
  		exit;
	}
}

?>
