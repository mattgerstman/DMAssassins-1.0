<?

include("tweet.php");

function killTweet($pin)
{

$table = "users";
$fun = "blankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblank";
while (strlen($fun)>139)	
{	
	$result = mysql_query("SELECT * FROM tweets WHERE used = 0 ORDER BY RAND() LIMIT 1");
	$method = mysql_result($result,0,"method");
	$tweetTeam = mysql_result($result,0,"team");
	
	$result = mysql_query("SELECT * FROM $table where pin = $pin");
	$name = mysql_result($result,0,"name");
	$deadTeam = mysql_result($result,0,"team");
	
	while (($deadTeam == $tweetTeam) && $tweetTeam != -1)
	{
		$result = mysql_query("SELECT * FROM tweets WHERE used = 0 ORDER BY RAND() LIMIT 1");
		$method = mysql_result($result,0,"method");
		$tweetTeam = mysql_result($result,0,"team");
	}
	
	$firstname = "";
	
	$numNames = str_word_count($name,0) - 1;
	$nameList = str_word_count($name,1);


	for ($j=0; $j<$numNames; $j++)
	{
		$firstname = $firstname ." ". $nameList[$j];
	}
	$fun = str_replace("THEIRNAME",$name, $method);
	$fun = str_replace("THEIR",$firstname, $fun);
	$fun = htmlspecialchars($fun, ENT_QUOTES);
}
	mysql_query('UPDATE tweets set used = 1 where method = "'.$method.'"');
	tweet($fun);
}


?>