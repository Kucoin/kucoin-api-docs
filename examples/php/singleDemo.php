<?php

$host = 'https://api.kucoin.com'; //production

//$host = 'https://openapi-sandbox.kucoin.com'; //sandbox

// Put your key here.
$key = '';
$secret = '';
$passphrase = '';

function http_request($method = 'GET', $url, $headers = [], $data = null)
{

    echo "send {$method} request to {$url}:\n";

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, TRUE);

    if ($method == 'POST') {
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    if ($method == 'DELETE') {
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    if(!empty($headers)) {
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}

function signature($request_path='', $body='', $timestamp = false, $method='GET') {
    global $secret;

    $body = is_array($body) ? json_encode($body) : $body;
    $timestamp = $timestamp ? $timestamp : time();

    $what = $timestamp.$method.$request_path.$body;

    return base64_encode(hash_hmac("sha256", $what, $secret, true));
}

function testGetAccounts(){

    global $host;
    global $key;
    global $passphrase;

    $endpoint = '/api/v1/accounts';
    $body = '';
    $timestamp = intval(microtime(true) * 1000);

    $headers = [];
    $headers[] = "Content-Type:application/json";
    $headers[] = "KC-API-KEY:".$key;
    $headers[] = "KC-API-TIMESTAMP:".$timestamp;
    $headers[] = "KC-API-PASSPHRASE:".$passphrase;
    $headers[] = "KC-API-SIGN:".signature($endpoint, $body, $timestamp, 'GET');

    $requestPath = $host . $endpoint;

    $response = http_request('GET', $requestPath, $headers, $body);

    var_dump($response);

}

function testGetDepositAddress(){

    global $host;
    global $key;
    global $passphrase;

    $endpoint = '/api/v1/deposit-addresses?currency=BTC';
    $body = '';
    $timestamp = intval(microtime(true) * 1000);

    $headers = [];
    $headers[] = "Content-Type:application/json";
    $headers[] = "KC-API-KEY:".$key;
    $headers[] = "KC-API-TIMESTAMP:".$timestamp;
    $headers[] = "KC-API-PASSPHRASE:".$passphrase;
    $headers[] = "KC-API-SIGN:".signature($endpoint, $body, $timestamp, 'GET');

    $requestPath = $host . $endpoint;

    $response = http_request('GET', $requestPath, $headers, $body);

    var_dump($response);

}

function testPostOrder(){

    global $host;
    global $key;
    global $passphrase;

    $endpoint = '/api/v1/orders';
    $body ='{"side":"buy","symbol":"ETH-BTC","type":"limit","price":"0.03504700","size":"0.3577891","clientOid":"'.microtime(true).'"}';

    $timestamp = intval(microtime(true) * 1000);

    $headers = [];
    $headers[] = "Content-Type:application/json";
    $headers[] = "KC-API-KEY:".$key;
    $headers[] = "KC-API-TIMESTAMP:".$timestamp;
    $headers[] = "KC-API-PASSPHRASE:".$passphrase;
    $headers[] = "KC-API-SIGN:".signature($endpoint, $body, $timestamp, 'POST');

    $requestPath = $host . $endpoint;

    $response = http_request('POST', $requestPath, $headers, $body);

    var_dump($response);

}

function testDeleteOrder(){

    global $host;
    global $key;
    global $passphrase;

    $orderId = "5c714d17cdaba40702ea1abd";

    $endpoint = "/api/v1/orders/{$orderId}";

    $timestamp = intval(microtime(true) * 1000);

    $body = '';
    $headers = [];
    $headers[] = "Content-Type:application/json";
    $headers[] = "KC-API-KEY:".$key;
    $headers[] = "KC-API-TIMESTAMP:".$timestamp;
    $headers[] = "KC-API-PASSPHRASE:".$passphrase;
    $headers[] = "KC-API-SIGN:".signature($endpoint, $body, $timestamp, 'DELETE');

    $requestPath = $host . $endpoint;

    $response = http_request('DELETE', $requestPath, $headers, $body);

    var_dump($response);

}


function testListFills(){

    global $host;
    global $key;
    global $passphrase;

    $endpoint = '/api/v1/orders?status=active&symbol=BTC-USDT';
    $body ='';

    $timestamp = intval(microtime(true) * 1000);

    $headers = [];
    $headers[] = "Content-Type:application/json";
    $headers[] = "KC-API-KEY:".$key;
    $headers[] = "KC-API-TIMESTAMP:".$timestamp;
    $headers[] = "KC-API-PASSPHRASE:".$passphrase;
    $headers[] = "KC-API-SIGN:".signature($endpoint, $body, $timestamp, 'GET');

    $requestPath = $host . $endpoint;

    $response = http_request('GET', $requestPath, $headers, $body);

    var_dump($response);

}

testListFills();

//testGetAccounts();

//testGetDepositAddress();

//testPostOrder();

//testDeleteOrder();

