<?php

include './APIkeys.php';

class BittrexAPIException extends \ErrorException {};

class BittrexAPI
{
    protected $key;     // API key
    protected $secret;  // API secret
    protected $url;     // API base URL
    protected $version; // API version
    protected $curl;    // curl handle

 /**
     * Constructor for BittrexAPI
     *
     * @param string $key API key
     * @param string $secret API secret
     * @param string $url base URL for Bittrex API
     * @param string $version API version
     * @param bool $sslverify enable/disable SSL peer verification.  disable if using beta.api.Bittrex.com
     */
    function __construct($key, $secret, $url='https://bittrex.com/api/v1.1/', $version='', $sslverify=true)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->url = $url;
        $this->version = $version;
        $this->curl = curl_init();

			curl_setopt_array($this->curl, array(
            CURLOPT_SSL_VERIFYPEER => $sslverify,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'Bittrex PHP API Agent',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true)
        );
    }

    function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * Query public methods
     *
     * @param string $method method name
     * @param array $request request parameters
     * @return array request result on success
     * @throws BittrexAPIException
     */
    function QueryPublic($method, array $request = array())
    
    {
        // build the POST data string
        $postdata = http_build_query($request, '', '&');

        // make request
        curl_setopt($this->curl, CURLOPT_URL, $this->url . '/' . $this->version . '/public/' . $method);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array());
        $result = curl_exec($this->curl);
        if($result===false)
            throw new BittrexAPIException('CURL error: ' . curl_error($this->curl));

        // decode results
        $result = json_decode($result, true);
        if(!is_array($result))
            throw new BittrexAPIException('JSON decode error');

        return $result;
    }

    /**
     * Query private methods
     *
     * @param string $method method path
     * @param array $request request parameters
     * @return array request result on success
     * @throws BittrexAPIException
     */
    function QueryPrivate($method, array $request = array())
    {
       include './APIkeys.php';
				
       // generate a 64 bit nonce using a timestamp at microsecond resolution
       // string functions are used to avoid problems on 32 bit systems
       $nonce = time();
       //$request['nonce'] = $nonce;
     

        // build the POST data string
        $postdata = http_build_query($request, '', '&');

		$path='https://bittrex.com/api/v1.1/account/' . $method . '?'. $postdata . '&apikey='.$key.'&nonce='.$nonce;
		
		$sign=hash_hmac('sha512',$path,$secret);
		
		static $curlHandler = null;
	
		if (is_null($curlHandler)) {
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
		curl_setopt($curlHandler, CURLOPT_HTTPGET, true);
		curl_setopt($curlHandler, CURLOPT_URL, $path);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, TRUE);
	}
		
		$execResult = curl_exec($curlHandler);
	
        if($execResult===false)
           throw new BittrexAPIException('CURL error: ' . curl_error($this->curl));

        // decode results
        $result = json_decode($execResult,true);
		
        if(!$result)
           throw new BittrexAPIException('JSON decode error');

        return $result;
      
    }
	
	function QueryMarket($method, array $request = array())
    {
       include './APIkeys.php';
				
       // generate a 64 bit nonce using a timestamp at microsecond resolution
       // string functions are used to avoid problems on 32 bit systems
       $nonce = time();
       //$request['nonce'] = $nonce;
     

        // build the POST data string
        $postdata = http_build_query($request, '', '&');

		$path='https://bittrex.com/api/v1.1/market/' . $method . '?'. $postdata . '&apikey='.$key.'&nonce='.$nonce;
		
		$sign=hash_hmac('sha512',$path,$secret);
		
		static $curlHandler = null;
	
		if (is_null($curlHandler)) {
		$curlHandler = curl_init();
		curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
		curl_setopt($curlHandler, CURLOPT_HTTPGET, true);
		curl_setopt($curlHandler, CURLOPT_URL, $path);
		curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, TRUE);
	}
		
		$execResult = curl_exec($curlHandler);
	
        if($execResult===false)
           throw new BittrexAPIException('CURL error: ' . curl_error($this->curl));

        // decode results
        $result = json_decode($execResult,true);
		
        if(!$result)
           throw new BittrexAPIException('JSON decode error');

        return $result;
      
    }
};
?>