<?php
require('connectToServer.php');
connect();

session_start();

$table='users';
$j = 0;
$result = mysql_query("SELECT * FROM users where alive = 1 AND killed=0");
while ($row = mysql_fetch_array($result))
{	
	$j++;	
	$name = $row['name'];
	$email = $row["email"];
	$subject = 'Assassins Update';
	$message = "Hello $name,
			
	In order to narrow down the finalists for DM Assassins, we have decided to eliminate those still in the game that haven't made a kill tomorrow (12/8) at Noon. We have also decided to extend the game through Sunday night at midnight. If you haven't hit your target yet, do so before tomorrow to avoid being eliminated.

	When those contestants are eliminated at Noon tomorrow, the remaining assassins will be assigned new targets. Good luck!
				
FTK,
The Assassins Team";
		$headers = 'From: assassins@floridadm.org' . "\r\n" .'X-Mailer: PHP/' . phpversion();

	mail($email, $subject, $message, $headers);
	echo("Sent email to $email<br />");
}

echo("$j users have been emailed.");

?>