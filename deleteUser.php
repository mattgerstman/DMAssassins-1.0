<?php
include('checkAdmin.php');
checkAdmin();

require('connectToServer.php');
connect();

$username = $_GET['username'];
$table = "users";

// get info of user to be deleted
$result = mysql_query("SELECT * FROM $table where username = '$username'");
$hisTarget = mysql_result($result,0,"target");
$deletedPin = mysql_result($result,0,"pin");

//change target of the user's assassins to the user's target
$result  = mysql_query("UPDATE $table SET target = $hisTarget where target = $deletedPin");
mysql_query("DELETE FROM $table where username = '$username'");


//email the assassin that they have a new target.
$result =  mysql_query("SELECT * FROM $table where target = $hisTarget");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,

	Due to unforeseen circumstances we have assigned you a new target. You may view your new target's information on your account at http://sgiordano.info/assassins

FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
if ($hisTarget)
{//assures that the game has started before sending the email
	mail($email, $subject, $message, $headers);
}

if($result)
{

$_SESSION['DM1-status']="<br />User Deleted";

}
else
{

 $_SESSION['DM1-status']="<p>An error occurred when trying to delete the user. <br /> Please contact Matt Gerstman at <a href='mailto:MattGerstman@gmail.com'>MattGerstman@gmail.com</a></p>";

}
echo('<SCRIPT LANGUAGE="JavaScript">history.go(-1);</script>');

?>
