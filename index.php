<html>
<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
?>

<head>

<title> Bittrex Pump & Dump Tool </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     
   <style>
a[role=button]{margin:5px;}
</style>
  
</head>

<body>
<?php

include './BittrexAPIClient.php';

$beta = false; 
$url = $beta ? 'https://bittrex.com/api/v1.1/' : 'https://bittrex.com/api/v1.1/';
$sslverify = false;
$version = '';

$kraken = new BittrexAPI($key, $secret, $url, $version, $sslverify);

$res = $kraken->QueryPublic('getmarkets'); 

$btcmarkets = array();


for ($i = 0; $i < sizeof($res['result']); $i++){
	if ($res['result'][$i]['BaseCurrency'] == 'BTC'){
	array_push($btcmarkets,$res['result'][$i]['MarketCurrency']);
	
	
}}

sort($btcmarkets);

$jsbtcmarkets = json_encode($btcmarkets);

?>

<script>
  $( function() {
    var availableTags = <?php echo $jsbtcmarkets; ?>;//["ANS","VOX", "ESP"];
	
 	$("#atags").autocomplete({
    source: function(request, response) {
        var results = $.ui.autocomplete.filter(availableTags, request.term);

        response(results.slice(0, 10));
		}});
	 });
 </script>


<br>
  <center> <h1>Bittrex Pump & Dump Trading Tool </h1> </center>
  <br>
 <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8 text-center">


 <div class="row">
  <div class="col-sm-4 "></div>
<form class="form-horizontal" method="get" action="./trader.php">
      <div class="col-sm-4 text-center">
        <input type="text" class="form-control text-center input-lg" placeholder="Search for Currency Pair" id="tags" name="market" autofocus>
      </div>

    </form>
	  <div class="col-sm-4 "></div></div>
	
<br><br>



<?php

foreach ($btcmarkets as $value) {
   echo "<a href='./trader.php?market=$value' role='button' class='btn btn-primary btn-md'> $value </a>  ";
}

?>

</div>


<script>
var $cells = $("a");

$("#tags").keyup(function() {
    var val = $.trim(this.value).toUpperCase();
    if (val === "")
        $cells.show();
    else {
        $cells.hide();
        $cells.filter(function() {
            return -1 != $(this).text().toUpperCase().indexOf(val); }).show();
    }
});

</script>



 <div class="col-sm-2"></div>

	
</div>	


</body>
</html>