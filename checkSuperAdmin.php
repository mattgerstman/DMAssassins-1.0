<?php
include('checkAdmin.php');

function checkSuperAdmin()
{
	//check if admin
	checkAdmin();
	
	include_once("connectToServer.php");
	connect();
	
	$username = $_SESSION['username'];
	$table = "users";
	
	if ($_SESSION['team'] == -1 || $_SESSION['username'] == "mgerstman" || $_SESSION['username'] == "sgiordano")
	{
	}
	else
	{//checks if on the admin team
  		header('Location: index.php');
  		exit;
	}
}



?>