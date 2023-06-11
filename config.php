<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
//Set the OAuth 2.0 Client ID
$google_client->setClientId('1081023771988-u9pjotluhq182bdd0c1oearcu8gs13q4.apps.googleusercontent.com');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://technoyus.my.id');

$google_client->addScope('email');
$google_client->addScope('profile');
