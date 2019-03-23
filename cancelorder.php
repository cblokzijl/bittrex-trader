<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_POST['uuid'])){
	
$uuid = $_POST['uuid'];

$marketrequest = array('uuid' => $uuid);

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

//$kraken->QueryMarket('cancel',$marketrequest); 

$resticker = $kraken->QueryMarket('cancel',$marketrequest); 

//print_r($resticker);

if ($resticker['success'] == true) {echo 'order ' . $uuid . ' successfully cancelled';}
else {echo 'cancel failed';}
} else { echo 'uuid not set in post data';}






?>