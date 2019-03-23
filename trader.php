<html>

<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

?>

<head>


<title> Bittrex Pump & Dump Tool </title>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

<script>
function UpdatePriceFunction(elem) {
var orderprice = document.getElementById("orderprice");
var factor = document.getElementById(elem.id);
var factorValue = factor.value;
var orderpriceValue = orderprice.value;
var orderpriceUpdate =  factorValue * orderpriceValue;
orderprice.value = orderpriceUpdate.toFixed(8);
}
    

function UpdateOrderAmountBTCFunction(elem) {
var orderamountbtc = document.getElementById("orderamountbtc");
var factor = document.getElementById(elem.id);
var factorValue = factor.value;
var orderamountbtcValue = orderamountbtc.value;
var orderamountbtcUpdate =  factorValue * orderamountbtcValue;
orderamountbtc.value = orderamountbtcUpdate.toFixed(8);
}

function UpdateOrderAmountALTFunction(elem) {
var orderamountalt = document.getElementById("orderamountalt");
var factor = document.getElementById(elem.id);
var factorValue = factor.value;
var orderamountaltValue = orderamountalt.value;
var orderamountaltUpdate =  factorValue * orderamountaltValue;
orderamountalt.value = orderamountaltUpdate.toFixed(8);
}

function precise(elem) {
    elem.value = Number(elem.value).toFixed(8);
  }


</script>
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

</head>
<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


if(isset($_GET['market'])){
$market= "BTC-" . $_GET['market'];	

$marketrequest = array('market' => $market);

require_once './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$resticker = $kraken->QueryPublic('getticker',$marketrequest); 


?>



<body>

 <div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10 text-center">
  <br>
<center> <h1 style="text-decoration:none;"><a style="text-decoration:none;" href='./' >Bittrex Pump & Dump Trading Tool </a></h1> <br>


</center>
  <br>
  
  <center> <div id="markettitle"><h3> <?php echo $market; ?> </h3></div> </center>
  <br>
  
   <div class="row">
  <div class="col-sm-2 text-center " id="pricehistory" >
  
  
  </div>
  <div class="col-sm-10 text-center">

     <div class="row">
	  <div class="col-sm-6 text-center">
  
  <div class="well well-sm text-center" ><h4><div id="btcbalance" class="btcbalance"></div> </h4></div></div>
  
  <div class="col-sm-6 text-center">
  <div class="well well-sm text-center" ><h4><div id="altbalance" class="altbalance"></div> </h4></div></div></div>

     <div class="row">

  <div class="col-sm-4 text-center">

 <div class="row">
	  <div class="col-sm-6 text-center">

	  
<div class="btn-group-vertical">
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+250" value="3.5">+250%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+150" value="2.5">+150%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+100" value="2">+100%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+50" value="1.5">+50%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+25" value="1.25">+25%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor+10" value="1.1">+10%</button>
</div> 
</div> 

	  <div class="col-sm-6 text-center">
	  
<div class="btn-group-vertical">
  <button type="button" class="btn btn-danger btn-block" onclick="UpdatePriceFunction(this)" id="factor+10" value="1.1">+10%</button>
  <button type="button" class="btn btn-danger btn-block" onclick="UpdatePriceFunction(this)" id="factor-10" value="0.9">-10%</button>
  <button type="button" class="btn btn-info btn-block">buy +100%</button>
  <button type="button" class="btn btn-info btn-block">buy +50%</button>
  <button type="button" class="btn btn-info btn-block">buy +25%</button>
  <button type="button" class="btn btn-info btn-block">buy +10%</button>
</div> 
</div> 
</div> 

</div>
  <div class="col-sm-4 text-center">
<div class="form-group text-center">
  <label for="inputlg"></label>
  <input oninput='precise(this)' type="number" class="form-control input-lg text-center" id="orderprice" placeholder="order price" name="orderprice" value="<?php echo $resticker['result']['Last']; ?>" autofocus> <br>
  
  <button type="button" class="btn btn-warning btn-lg btn-lastbid">LAST BID</button> 
  <button type="button" class="btn btn-warning btn-lg btn-lastfill">LAST FILL</button> 
  <button type="button" class="btn btn-warning btn-lg btn-lastask">LAST ASK</button> 
  <br>
  <br>
  <div class="row"> 
  
       <div class="col-sm-3 text-center"> 
	  <div class="btn-group-vertical">
  <button type="button" class="btn btn-default btn-block btn-xs 100btc">100%</button>
  <button type="button" class="btn btn-default btn-block btn-xs" onclick="UpdateOrderAmountBTCFunction(this)" id="factor.5" value="0.5">50%</button>
  <button type="button" class="btn btn-default btn-block btn-xs" onclick="UpdateOrderAmountBTCFunction(this)" id="factor.25" value="0.25">25%</button>
	   </div>
	  </div>
  
  
    <div class="col-sm-6 text-center"> 
  <input type="number" name="orderamountbtc" class="form-control input-lg text-center" id="orderamountbtc" value="" placeholder="amount btc" /> 
  
  </div>
  <div class="col-sm-3 text-center"> <h4>BTC </h4></div>
 
	  
	  </div>
	  <br>
  <div class="row"> 
    <div class="col-sm-3 text-center" id="markettitle">  <h4><?php echo $_GET['market']; ?> </h4></div>
    <div class="col-sm-6 text-center">
	  
  <input type="number" class="form-control input-lg text-center" id="orderamountalt" name="orderamountalt" placeholder="amount alt" value="" /></div>
        <div class="col-sm-3 text-center"> 
	  <div class="btn-group-vertical">
  <button type="button" class="btn btn-default btn-block btn-xs 100alt" >100%</button>
  <button type="button" class="btn btn-default btn-block btn-xs" onclick="UpdateOrderAmountALTFunction(this)" id="factor.5" value="0.5">50%</button>
  <button type="button" class="btn btn-default btn-block btn-xs" onclick="UpdateOrderAmountALTFunction(this)" id="factor.25" value="0.25">25%</button>
	   </div>
  
  
  </div>
  </div>

</div>
<div class="btn-group btn-group-justified">
 <div class="btn-group">
   <button type="button" class="btn btn-success btn-lg">BUY</button></div> 

  
  <div class="btn-group"> 
  <button type="button" class="btn btn-danger btn-lg">SELL</button></div> 
  
  
</div> 
</div> 



 
 <div class="col-sm-4 text-center">
 
     <div class="row">
	  <div class="col-sm-6 text-center">
  
  <div class="btn-group-vertical">
  <button type="button" class="btn btn-danger btn-block" onclick="UpdatePriceFunction(this)" id="factor+10" value="1.1">+10%</button>
  <button type="button" class="btn btn-danger btn-block" onclick="UpdatePriceFunction(this)" id="factor-10" value="0.9">-10%</button>
  <button type="button" class="btn btn-info btn-block">sell all 500%</button>
  <button type="button" class="btn btn-info btn-block">sell all 300%</button>
  <button type="button" class="btn btn-info btn-block">sell all 200%</button>
  <button type="button" class="btn btn-info btn-block">sell all 150%</button>
</div> 
</div> 
 <div class="col-sm-6 text-center">
  <div class="btn-group-vertical">
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor1000" value="10">1000%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor750" value="7.5">750%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor500" value="5">500%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor250" value="2.5">250%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor150" value="1.5">150%</button>
  <button type="button" class="btn btn-primary btn-block" onclick="UpdatePriceFunction(this)" id="factor125" value="1.25">125%</button>
</div> 
</div>
</div>
</div>

  </p>
  
  </div></div>
  
  <!-- closing divs middle area  -->
  </div>  
  </div>
    <!-- closing div middle area  -->
		
  <div class="col-sm-1"></div>
</div> 
<br><br><br>	


  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  
   <center> <h3> Server Log </h3>
<iframe name="messages" height="75" width="40%" style="border:2px solid grey;border-radius:10px;"></iframe></center>
    
<div id="openorders" name='openorders'> </div>

	
	<h3>About the Trading Tool</h3>
  <div class="well">

  <ul>
  <li> For optimale user experience use a resolution of 16:9.</li>
  </ul>
  
  </div>
  </div>
  <div class="col-sm-8"></div>
  </div>

</body>
<?php }; ?>

<script>
$('.btn-lastfill').click(function() {
	
	$.ajax({
  type: "GET",
  url: "./lastfill.php?market=<?php echo $market;?>",
   success: function(data) {
        $("#orderprice").val(data);
		
  }
  })	
		}); 

$('.btn-lastbid').click(function() {
	
	$.ajax({
  type: "GET",
  url: "./lastbid.php?market=<?php echo $market;?>",
  success: function(data) {
        $("#orderprice").val(data);
		
  }
  })	
		});  

$('.btn-lastask').click(function() {
	
	$.ajax({
  type: "GET",
  url: "./lastask.php?market=<?php echo $market;?>",
  success: function(data) {
        $("#orderprice").val(data);
		
  }
  })	
		});  

$('.100btc').click(function() {
	
	$.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=BTC",
  success: function(data) {
        $("#orderamountbtc").val(data);
		
  }
  })	
		});  

$('.100alt').click(function() {
	
	$.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=<?php echo $_GET['market']; ?>",
  success: function(data) {
        $("#orderamountalt").val(data);
		
  }
  })	
		});  		


var auto_refresh = setInterval(
function ()
{
$('#pricehistory').load('./markethistory.php?market=<?php echo $market; ?>'); //.hide().fadeIn(100);
$('#altbalance').load('./getaltbalance.php?currency=<?php echo $_GET['market']; ?>');
$('#btcbalance').load('./getaltbalance.php?currency=BTC');
$('#openorders').load('./openorders.php?market=<?php echo $market; ?>');

}, 2000);


$(document).ready(function() {
	
$.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=BTC",
  success: function(data) {
        $("#orderamountbtc").val(data);
		
  }
  })	
		

$.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=<?php echo $_GET['market']; ?>",
  success: function(data) {
        $("#orderamountalt").val(data);
		
  }
  })	
		
});  

var btcbalance = $('.btcbalance');
var orderamountbtc = $('#orderamountbtc');

	
btcbalance.click( function(){
var btcbalancevalue = $.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=BTC",
  success: function(data) {
  orderamountbtc.val(data);
  }
  })	

});

var altbalance = $('.altbalance');
var orderamountalt = $('#orderamountalt');

altbalance.click( function(){
var btcbalancevalue = $.ajax({
  type: "GET",
  url: "./getaltbalance.php?currency=<?php echo $_GET['market']; ?>",
  success: function(data) {
  orderamountalt.val(data);
  }
  })	

});

</script>

</html>