<?
session_start();
$pw = md5($_GET['pw']);
if (($_SESSION['DM1-username'] != "mgerstman") && ($_SESSION['DM1-username'] != "sgiordano") && $_SESSION['DM1-usertype']!=-1)
{
	header("Location: index.php");
}

include_once("connectToServer.php");
connect();

echo('<div><p class="special">Keep in mind when you select a team for a tweet it won\'t use that tweet on a player from that team.<br />
For example we don\'t want "THEIRNAME died after insulting a Morale captain. THEIR forgot that Morale ALWAYS travels in packs."<br />
being used on a Morale captain because that wouldn\'t make sense</p><br /><br />');

$result = mysql_query("SELECT * FROM tweetTest");

if (mysql_num_rows($result)==0)
{
	echo('There are no submissions waiting approval.<br />');
}

while ($row = mysql_fetch_array($result))
{

	$method = $row["method"];
	echo($method. '<br /><form action="processApproval.php" method="post">
		<input type="hidden" name="pw" value ="5f4dcc3b5aa765d61d8327deb882cf99"/>
		<input type="hidden" name="way" value ="'.$method.'"/>
		<input type="radio" name="ap" value="1" Checked/> Approve<br />
		<input type="radio" name="ap" value="0"/> Deny<br />
		Team: <select name="team">
		<option value="NULL">None</option>
		<option value="00">	Community Events</option>
		<option value="01">	Dancer Relations</option>
		<option value="02">	Entertainment</option>
		<option value="03">	Family Relations</option>
		<option value="04">	Finance</option>
		<option value="05">	Hospitality</option>
		<option value="06">	Marketing</option>
		<option value="07">	Morale</option>
		<option value="08">	Operations</option>
		<option value="09">	Public Relations</option>
		<option value="10">	Recruitment</option>
		<option value="11">	Technology</option>
	</select><br />
	<input type="submit" value="Submit" /></form>
	<br /><br />');

}

echo($_SESSION['DM1-approve']);

?>

<br />Direct Submissions:<br/>
<form action='processApproval.php' method="POST">
<input type="hidden" name="pw" value ="5f4dcc3b5aa765d61d8327deb882cf99" />
<input type="hidden" name="ap" value = 2 />
<input type="text" name="way" /><br />
	Team: <select name="team">
	<option value="-1">None</option>
	<option value="00">	Community Events</option>
	<option value="01">	Dancer Relations</option>
	<option value="02">	Entertainment</option>
	<option value="03">	Family Relations</option>
	<option value="04">	Finance</option>
	<option value="05">	Hospitality</option>
	<option value="06">	Marketing</option>
	<option value="07">	Morale</option>
	<option value="08">	Operations</option>
	<option value="09">	Public Relations</option>
	<option value="10">	Recruitment</option>
	<option value="11">	Technology</option>
</select><br />
<br /><input type="submit" value="Submit" /></form>
<?php
echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);
?>
</div>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>
