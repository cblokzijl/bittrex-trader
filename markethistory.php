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

$resmarkethistory = $kraken->QueryPublic('getmarkethistory',$marketrequest); 

}
?>


<table class="table table-striped">
    <thead>
      <tr>
        <th>Price Development</th>

      </tr>
    </thead>
    <tbody>
        <tr  class="success">
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][0]['Price']); ?></td>

      </tr>
      <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][1]['Price']); ?></td>

      </tr>
      <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][2]['Price']); ?></td>

      </tr> 
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][3]['Price']); ?></td>

      </tr> 
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][4]['Price']); ?></td>
		
      </tr>
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][5]['Price']); ?></td>

      </tr>	  
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][6]['Price']); ?></td>

      </tr>	  
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][7]['Price']); ?></td>

      </tr>	  
	  <tr>
        <td><?php echo sprintf('%.8f',$resmarkethistory['result'][8]['Price']); ?></td>

      </tr>
	  
	  
    </tbody>
  </table>