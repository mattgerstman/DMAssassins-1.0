<?php

session_start();
?>

<?php
include_once("connectToServer.php");
connect();

if ($_POST['pw']=="5f4dcc3b5aa765d61d8327deb882cf99")
{
	$way = $_POST['way'];
	$team = $_POST['team'];
	$pin = $_POST['pin'];
	$delete = $_POST['delete'];
	echo($pin);
	if ($delete==1)
	{
		$sql0 = "DELETE FROM tweets where method = '$way'";
		mysql_query($sql0);
	}
	else
	{
		echo("<br />else");
		$sql1 = "UPDATE tweets SET method = '$way', team = $team WHERE pin = $pin";
		mysql_query($sql1);
	}
}

echo('<SCRIPT LANGUAGE="JavaScript">redirURL = "listOfWays.php?pw=password";self.location.href = redirURL;</script>');

?>




</body>
</html>