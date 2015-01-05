<?php 

function connect() //connects to the mysql server and opens the assassins database
{
	$connect = @mysql_connect("localhost", "root");

//connect to server

	if (!$connect) {
  		echo( "<P>Unable to connect to the assassins database at this time.</P>" );
  		exit();
	}

	
//select the assassins database

	if (! @mysql_select_db("dmassassins1") ) {
    	echo( "<P>Unable to locate the assassins database at this time.</P>" );
    exit();
  	}
}
?>