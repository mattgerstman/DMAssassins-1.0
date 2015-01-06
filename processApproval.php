<?php

session_start();
?>

<?php
include_once("connectToServer.php");
connect();

if ($_POST['pw']=="5f4dcc3b5aa765d61d8327deb882cf99")
{
	$way = $_POST['way'];
	$ap = $_POST['ap'];
	$team = $_POST['team'];
	if ($ap == 2)
	{
		if (strlen($way)<110)
		{
			$sql1 = "INSERT INTO tweets SET method = '$way', used =0, team= $team";
			mysql_query($sql1);
		}
		else
			$_SESSION['DM1-status'] = "<p>That tweet was over 110 characters.</p>";
	}
	else if ($ap==1)
	{
		$sql1 = "INSERT INTO tweets SET method = '$way', used =0, team= $team";
		mysql_query($sql1);
		$sql2 = "DELETE FROM tweetTest where method = '$way'";
		mysql_query($sql2);
		$_SESSION['DM1-approve']="Submission approved.";
	}
	else if ($ap==0)
	{
			$sql2 = "DELETE FROM tweetTest where method = '$way'";
			mysql_query($sql2);
	}
}

?>


<SCRIPT LANGUAGE="JavaScript">

redirURL = "needsApproval.php?pw=password";
self.location.href = redirURL;

</script>

</body>
</html>
