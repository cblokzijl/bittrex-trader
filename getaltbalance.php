<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_GET['currency'])){
$currency= $_GET['currency'];
//$currency = 'BTC';	

$currencyrequest = array('currency' => $currency);
//$currencyrequest = array();

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resbalance = $kraken->QueryPrivate('getbalance',$currencyrequest); 

$currentbalance = $resbalance['result']['Available'];  
 
echo sprintf('%.8f',$currentbalance);

//echo 'Current balance of ' . $currency . " = " . $currentbalance;


}

?>