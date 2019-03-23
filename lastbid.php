<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_GET['market'])){
$market= $_GET['market'];	

$marketrequest = array('market' => $market);

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resticker = $kraken->QueryPublic('getticker',$marketrequest); 

$lastbid = $resticker['result']['Bid'];  
 
echo $lastbid;

}

?>