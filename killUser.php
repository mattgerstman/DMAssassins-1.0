<?php
include('checkAdmin.php');
checkAdmin();

include('connectToServer.php');
connect();

$username = $_GET['username'];
$table = "users";

// get info of user to be killed
$result = mysql_query("SELECT * FROM $table where username = '$username'");
$hisTarget = mysql_result($result,0,"target");
$killedPin = mysql_result($result,0,"pin");

//change target of the user's assassins to the user's target and update kills
$result = mysql_query("SELECT * FROM $table where target = $killedPin");
$kills = mysql_result($result,0,"killed") + 1;
$username = mysql_result($result,0,"username");
$result = mysql_query("UPDATE $table SET target = $hisTarget, killed = $kills where username = '$username'");

//kill User
$result = mysql_query("UPDATE $table SET target = 0 where pin = $killedPin");

//email the assassin that they have a new target.
$result =  mysql_query("SELECT * FROM $table where target = $hisTarget");
$name = mysql_result($result,0,"name");
$email = mysql_result($result,0,"email");


	$subject = 'You Have A New Target';
	$message = "Hello $name,
	
	Your overall has manually killed your target. You may view your new target information on your account at http://sgiordano.info/assassins
	
FTK!
The Assassins Staff";
	$headers = 'From: assassins@floridadm.org' . "\r\n" .'X-Mailer: PHP/' . phpversion();


	mail($email, $subject, $message, $headers);

if($result)
{
	include('killTweet.php');
	killTweet($killedPin);
$_SESSION['status']="<br />User Deleted";

}
else
{

 $_SESSION['status']="<p>An error occurred when trying to delete the user. <br /> Please contact Matt Gerstman at <a href='mailto:MattGerstman@gmail.com'>MattGerstman@gmail.com</a></p>";

}
echo('<SCRIPT LANGUAGE="JavaScript">history.go(-1);</script>');

?>