<?php
include('checkAdmin.php');

function checkSuperAdmin()
{
	//check if admin
	checkAdmin();

	include_once("connectToServer.php");
	connect();

	$username = $_SESSION['DM1-username'];
	$table = "users";

	if ($_SESSION['DM1-team'] == -1 || $_SESSION['DM1-username'] == "mgerstman" || $_SESSION['DM1-username'] == "sgiordano")
	{
	}
	else
	{//checks if on the admin team
  		header('Location: index.php');
  		exit;
	}
}



?>
