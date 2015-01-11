<?php
function tweet($statusMessage)

{
	$consumerKey    = '';
	$consumerSecret = '';
	$oAuthToken     = '';
	$oAuthSecret    = '';

	if(file_exists('twitterpassword.php'))
		require_once('twitterpassword.php');
	
	require_once('twitteroauth.php');

// twitteroauth.php points to OAuth.php
// all files are in the same dir
// create a new instance

	$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
	$tweet->post('statuses/update', array('status' => $statusMessage));
}

?>