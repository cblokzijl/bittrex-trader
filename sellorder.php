<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_GET['market']) && isset($_POST['price']) && isset($_POST['amountalt']) ){

$market= $_GET['market'];	
$quantity = $_POST['amountalt'];
$rate = $_POST['price'];

$marketrequest = array('market' => $market, 'rate' => $rate, 'quantity' => $quantity );

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resticker = $kraken->QueryMarket('selllimit',$marketrequest); 

if ($resticker['success'] == true) {echo 'sellorder successfully placed';}
else {echo 'sell order failed';}

} else { echo 'sell order failed, postdata not correct';} 


?>