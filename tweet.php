<?php
function tweet($statusMessage)

{
	$consumerKey    = '6TnS8NdtU9S013dro4sBA';
	$consumerSecret = 'rjsayYnF781t6cj7GxjwWQrjwmkBR5Pb1h17vAHdZyM';
	$oAuthToken     = '419296357-TA8UP2k8EHuSG7gJ3e4X4EJQORCFb3Kp3SFfK6vA';
	$oAuthSecret    = 'AYqvOERNUljAV4NJycyAnisMtKylMQKi25lyujaFI';

	require_once('twitteroauth.php');

// twitteroauth.php points to OAuth.php
// all files are in the same dir
// create a new instance

	$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
	$tweet->post('statuses/update', array('status' => $statusMessage));
}

?>