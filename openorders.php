
<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(isset($_GET['market'])){
$market= $_GET['market'];	

//$market= 'BTC-'. $_GET['market'];	

$marketrequest = array('market' => $market);

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$bittrex = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resopenorders = $bittrex->QueryMarket('getopenorders',$marketrequest); 

$orders = $resopenorders['result']; 


?>

<div class="container">


  <h3>Open Orders</h3>
        
  <table class="table table-striped table-condensed table-hover">
    <thead>
      <tr>
        <th>Market</th>
		<th>Type</th>
		<th>Price</th>		
        <th>Quantity</th>
        <th>Cancel</th>
      </tr>
    </thead>
    <tbody>
	
<?php

foreach ($orders as $order) {


 echo '<tr>';
 
 echo '<td>'.$market.'</td>';
 
 
 echo '<td>';
 
 if($order['OrderType'] == 'LIMIT_SELL'){ echo 'SELL';}
 elseif($order['OrderType'] == 'LIMIT_BUY'){ echo 'BUY';}
 else { echo $order['OrderType'];}
 
 echo'</td>';
 
 
 echo '<td>'. sprintf('%.8f',$order['Limit']).'</td>';
 echo '<td>'.$order['Quantity'].'</td>';
 echo '<td> <form class="form-horizontal" id="cancelorder" name="cancelorder" action="./cancelorder.php" method="post" target="messages"><button class="btn btn-danger" type="submit" name="uuid" value='.$order['OrderUuid'].'>X</button></form> </td>';

echo '</tr>';

}
}
?>



    </tbody>
  </table>
 
 <script>
 
 $('#cancelorder').submit(function () {	
    //$.post('./sellorder.php?market=<?php echo $market; ?>', $('#placeorder').serialize(), function (data, textStatus) {
    $.post(document.getElementById("cancelorder").action, $('#cancelorder').serialize(), function (data, textStatus) {
         $('#messages').append(data +'<br>');
    });
    return false;
	
});

</script>

  
 </div>