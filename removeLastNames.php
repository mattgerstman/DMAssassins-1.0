<pre>
<?php
require('connectToServer.php');
connect();

$sql1 = "SELECT * FROM users";
$users = mysql_query($sql1);

$num   = mysql_num_rows($users);

for ($i=0; $i<$num; $i++) {
	$pin = mysql_result($users, $i, 'pin');
	$name = mysql_result($users, $i, 'name');
	$name = preg_replace('/\s+/', ' ', $name);
	$nameParts = preg_split("/\s/", $name);
	$firstName = $nameParts[0];
	$lastName = $nameParts[1];
	$username = strtolower($firstName . $lastName[0]);
	$sql = "UPDATE users SET username = \"$username\", name = \"$firstName\" WHERE pin = $pin;\n";
	echo $sql;
}
?>
