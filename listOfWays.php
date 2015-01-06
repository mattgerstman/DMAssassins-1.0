<?
session_start();

$pw = md5($_GET['pw']);
if (($_SESSION['DM1-username'] != "mgerstman") && ($_SESSION['DM1-username'] != "sgiordano") && $_SESSION['DM1-usertype']!=-1 && $_SESSION['DM1-usertype']!=1)
{
	header("Location: index.php");
}

echo('<div><p class="special">Keep in mind when you select a team for a tweet it won\'t use that tweet on a player from that team.<br />
For example we don\'t want "THEIRNAME died after insulting a Morale captain. THEIR forgot that Morale ALWAYS travels in packs."<br />
being used on a Morale captain because that wouldn\'t make sense</p><br /><br />');

include_once("connectToServer.php");
connect();
$result = mysql_query("SELECT COUNT(method), SUM(used) FROM tweets");
$total = mysql_result($result,0,'COUNT(method)');
$used =  mysql_result($result,0,'SUM(used)');
$unused = $total - $used;
if ($needed < 123)
	$needed = 123 - $total;
else
	$needed = 0;

echo("Total Tweets: $total<br/>Used Tweets: $used<br />Unused Tweets: $unused<br />Needed: $needed<br /><br />");

$result = mysql_query("SELECT * FROM tweets");

while ($row = mysql_fetch_array($result))
{
	$method = $row["method"];
	$pin = $row['pin'];
	$team = $row['team'];

	for ($i=-1; $i<12; $i++)
	{
		$selectVal[$i]='"' . $i. '"';
		if ($i == $team)
		{
			$selectVal[$i] = $i . ' selected';
		}
	}


	echo($pin.") ".$method.' <form action="processEditTweet.php" method="post">
		<input type="hidden" name="pin" value ='.$pin.' />
		<input type="hidden" name="pw" value ="5f4dcc3b5aa765d61d8327deb882cf99"/>
		<input type="input" name="way" value ="'.$method.'"/>
		&nbsp;Team: <select name="team">
		<option value='.$selectVal[-1].'>None</option>
		<option value='.$selectVal[0].'>Community Events</option>
		<option value='.$selectVal[1].'>Dancer Relations</option>
		<option value='.$selectVal[2].'>Entertainment</option>
		<option value='.$selectVal[3].'>Family Relations</option>
		<option value='.$selectVal[4].'>Finance</option>
		<option value='.$selectVal[5].'>Hospitality</option>
		<option value='.$selectVal[6].'>Marketing</option>
		<option value='.$selectVal[7].'>Morale</option>
		<option value='.$selectVal[8].'>Operations</option>
		<option value='.$selectVal[9].'>Public Relations</option>
		<option value='.$selectVal[10].'>Recruitment</option>
		<option value='.$selectVal[11].'>Technology</option>
	</select>
	&nbsp;Delete:<input type="checkbox" name="delete" value="1" />
	<input type="submit" value="Submit" /></form>');

}

?>
</div>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>
