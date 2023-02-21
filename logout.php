<?php

include('config.php');

$accesstoken = $_SESSION['access_token'];

//Unset token and user data from session    
unset($_SESSION['access_token']);
unset($_SESSION['userData']);

//Reset OAuth access token    
$google_client->revokeToken(['refresh_token' => $accesstoken]);

//Destroy entire session    
session_destroy();
header('Location:Home');
?>