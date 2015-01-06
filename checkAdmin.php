<?php
include('checkSession.php');

function checkAdmin()
{
	//check if logged in
	check();

	//then check if admin
	if(($_SESSION['DM1-usertype'] || $_SESSION['DM1-username'] == "mgerstman"))
	{

	}
	else
	{
  		// Not an admin
  		header('Location: index.php');
  		exit;
	}
}



?>
