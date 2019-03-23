<title> Buy Sell Test </title>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type='number'] {
    -moz-appearance:textfield;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}

.btn-lastbid, .btn-lastask,.btn-lastfill{margin:5px;}

	
#markettitle{
	text-transform: uppercase;
	}


</style>
  
<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//if(isset($_GET['market'])){
//$market= $_GET['market'];	

$market='BTC-PTC';

$marketrequest = array('market' => $market);
//$marketrequest = array();

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$bittrex = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resopenorders = $bittrex->QueryMarket('getopenorders',$marketrequest); 

$orders = $resopenorders['result'];  

//echo '<Br>';
//print_r($orders);

//}

?>

     <div class="row">
	  <div class="col-sm-4 text-center"></div>
	  <div class="col-sm-4 text-center">
	  

<br><br>

	  <form class="form-inline" action="" method="post" target="messages" name="placeorder" id='placeorder'>
Price Rate <input class="form-control" type='number' name='price' id='price' step="0.00000001" > <br><br>

Amount ALT <input class="form-control" type='number' name='amountalt' id='amountalt'  step="0.00000001"> <br><br>

Amount BTC <input class="form-control" type='number' name='amountbtc' id='amountbtc'  step="0.00000001"> <br><br>


	  
<button type="submit" class="btn btn-success btn-buy" id="btn-buy" onclick="placeorder.action='./buyorder.php?market=<?php echo $market; ?>'">BUY</button>


<button type="submit" class="btn btn-danger btn-sell" id="btn-sell" onclick="placeorder.action='./sellorder.php?market=<?php echo $market; ?>'">SELL</button>


</form>
<h3> Server Log </h3>
  <iframe name="messages" height="100" width="100%" style="border:2px solid grey;border-radius:10px;"></iframe>
  
  <br><br>
  
  <div id="messages" height="100px" width="100%" style="border:2px solid grey;border-radius:10px;"></div>


</div>
  <div class="col-sm-4 text-center"></div>
</div>



<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
    
<div id="openorders" name='openorders'> </div>

  </div>

  <div class="col-sm-8"></div>
  </div>
  
  <script>
  
  
  
  var auto_refresh = setInterval(
function ()
{

$('#openorders').load('./openorders.php?market=<?php echo $market; ?>');


}, 1000);


$('#placeorder').submit(function () {	
    //$.post('./sellorder.php?market=<?php echo $market; ?>', $('#placeorder').serialize(), function (data, textStatus) {
    $.post(document.getElementById("placeorder").action, $('#placeorder').serialize(), function (data, textStatus) {
         $('#messages').append(data +'<br>');
    });
    return false;
	
});


	

</script>
