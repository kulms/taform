<?php
@session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '356108218864-ms61omi3k91shs28baukqr9c1pt8fouj.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'Wo-EK1sH6AtLw2nuH2wpR3Ku'; //Google client secret
// $redirectURL = 'http://127.0.0.1/examform/g-callback.php'; //Callback URL
//$redirectURL = 'http://158.108.40.234/eroom/googleOauth/'; //Callback URL
//$redirectURL = 'http://edocument.eng.ku.ac.th/eroom/googleOauth/'; //Callback URL
//$redirectURL = 'http://edocument.eng.ku.ac.th/otsystem/member/g-callback.php'; //Callback URL
$redirectURL = 'http://127.0.0.1/apsystem/member/g-callback.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to KU Google');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>