---
title: title

language_tabs: # must be one of https://git.io/vQNgJ


toc_footers:
  - <a href='https://www.kucoin.com'>Sign Up for KuCoin</a>

includes:

search: true
---

# Getting Started

## Introduction 

Welcome to KuCoin’s trader and developer documentation. These documents outline the exchange functionality, market details, and APIs.

Our APIs are separated into two parts: REST API and Websocket feed.

The REST API contains four categories: User(private) , Trade(private), Market Data(public), Others(public)

The WebSocket contains two categories: Public Channels and Private Channels

Private APIs require authentication and provide access to placing orders and other account information. 

WebSocket APIs provide market data, most of them are public.

## Reading Guide

1. Read [Sandbox](#sandbox) to learn how to debug the API in the test environment.
2. Read [REST API](#rest-api) to learn how to build a request.
3. Read [Time](#time) if you want to make a test request (and receive a sample response) without having to authorize.
4. Read [Authentication](#authentication) to learn how to make an authorized request.
5. Read [Inner Transfer](#inner-transfer) to see how to transfer assets.
6. Read [List Accounts](#list-accounts) to test your authorized request.
7. Read [Place a new order](/#place-a-new-order) to see how to place an order.
8. Read [Order Book](#get-part-order-book-aggregated) to get a snapshot of the order book.
9. Read [Websocket Feed](#websocket-feed) to learn how to establish a websocket connection.
10. Read [Level-2 Market Data](#level-2-market-data) to see how to build a local real-time order book with websocket. 
11. Read [Account balance notice](#account-balance-notice) to see how to get a private websocket feed and get realtime notice of balance changes.

## Market Making Incentive Scheme

KuCoin offers a Market Making Incentive Scheme for professional liquidity providers. Key benefits of this program include:

- Market Maker rebate.
- Quarterly rewards as many as 100,000 KCS for the market maker with the best performance.
- Direct Market Access and Co-location service.

Users with good maker strategies and huge trading volume are welcome to participate in this long-term program. If your account has a trading volume of more than 5000 BTC in the last 30 days on any exchange, please send the following information via email to **mm@kucoin.com**, with subject "Spot Market Maker Application":

- One KuCoin account ID (a non-referred account is required).
- Proof of volume traded on any exchange within the past 30 days. Proof of a VIP level is also acceptable.
- A brief explanation of your market making method (NO detail is needed), as well as estimation of maker orders’ percentage.

## VIP Fast Track

KuCoin now provides a VIP fast track to users with a large trading volume in crypto. If your accounts on different platforms have a total trading volume of more than 1000 BTC in the last 30 days, please send the following information via email to **vip@kucoin.com**, with subject "VIP Fast Track Application":

KuCoin account ID.
Proof of trading volume on other platforms within the past 30 days. Proof of a VIP level is also acceptable.

We will offer you a jumpstart (e.g. a VIP level which matches your volume on other exchanges even though you are not trading as much on KuCoin) for 30 days. After 30 days, your VIP level will be calculated based on your actual trading volume on KuCoin.

For more information on the VIP fee, you can read ourplease click: [Tiered Trading Fee Discount Program](https://www.kucoin.com/news/en-fee).

## Sub-accounts

Sub-accounts can be used to isolate asset and trading. Asset can be transferred between master-account and sub-accounts, then sub-accounts user can trade with asset in sub-accounts only. Asset cannot be withdraw from sub-accounts directly.

Sub-accounts API can access all reference data and market data endpoints. In addition, sub-accounts API can also access below listed endpoints.

Request Method | Description
---------- | -------
[List Accounts](#place-a-new-order) | Get the status of an account.
[Get an Account](#get-an-account) | Get the balance of an account.
[Create an Account](#create-an-account) | Create an Account.
[Get Account Ledgers](#get-account-ledgers) | Get the fund details of an account.
[Get Holds](#get-holds) | Get the hold details of an account.
[Inner Transfer](#inner-transfer) | Transferring assets between the accounts of main and trade.
[Place a new order](#place-a-new-order) | Place an order.
[Cancel an order](#cancel-an-order) | Request to cancel an order.
[Cancel all orders](#cancel-all-orders) | Request to cancel all orders.
[List Orders](#list-orders) | Search for a group of orders.
[Recent Orders](#recent-orders) | Search for a group of orders(up to 1000).
[Get an order](#get-an-order) | Get the details of an order.
[List Fills](#list-fills) | Get detail match results of orders.
[Recent Fills](#recent-fills) | Get detail match results of orders(up to 1000).

Sub-accounts user can transfer with asset in sub-accounts only and the sub-accounts shares the same fee level with the master-accounts. (P.S. The fee level will be calculated based on the total transaction amount of the sub-accounts and the master account or the holding amount of KCS ).

The sub-account needs to transfer funds from the main account to the trade account before trading.

<aside class="notice">Sub-accounts do not support for deposit and withdrawal.</aside>

# Upcoming Changes

In order to receive the latest API change notifications, you can click ‘Watch’ on our [KuCoin Docs Github](https://github.com/Kucoin/kucoin-api-docs).

**4/24/19**: 

- Delete "size" and "funds" field to [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)) which protects hidden orders when you subscribe to the "received" messages through private channels.
- Delete "remainSize" field to [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)) which protects hidden orders when you subscribe to the "open" messages through private channels. 
- Add [Get User Info of all Sub-Accounts](#get-user-info-of-all-sub-accounts).
- Add [Get Account Balance of a Sub-Account](#get-account-balance-of-a-sub-account).
- Add [Get the Aggregated Balance of all Sub-Accounts of the Current User](#get-the-aggregated-balance-of-all-sub-accounts-of-the-current-user).
- Add [Transfer between Master account and Sub-Account](#transfer-between-master-account-and-sub-account).

**3/27/19** : 

- Add **feeCurrency** field to [Get Symbols List](#get-symbols-list).

**3/25/19** : 

- Add **volValue** field to [Get All Tickers](#get-all-tickers).
- Add **clientOid** field to [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)) which allows you to filter your order info by clientOid when you subscribe to the "received " messages through private channels.
Add accountId field to Account balance notice so that you can trace the change of your account information when you subscribe to “Account balance notice”.
. 
- Add **accountId** field to [Account balance notice](#account-balance-notice) when subscribe "Account balance notice" through private channels.

**3/13/19** : 

- Modify the maximum matching orders for a single trading pair in one account is 200 (stop orders included).

**3/6/19** : 

- Add the description of order system and matching engine time using **nanoseconds**

**2/28/19** : 

- Modify [Get Symbols List](#get-symbols-list) response description
- Add [Get V1 Historical Deposits List](#get-v1-historical-deposits-list)
- Add [Get V1 Historical Withdrawals List](#get-v1-historical-withdrawals-list)
- Add [Get V1 Historical Orders List](#get-v1-historical-orders-list)
- Add partial API JSON field description
- Delete "sn" field to [Match Execution Data](#match-execution-data) 
- Modify [Get Fiat Price](#get-fiat-price) parameter description
- Add "acceptUsermessage" option when connecting to the WebSocke.
- Modify the get historic rate API name to [Get Klines](#get-klines)  

**2/22/19** : 

- Add **volValue** fields to [Get 24hr Stats](#get-24hr-stats)

**2/21/19** : 

- Add [Get Full Order Book(aggregated) v2](#get-full-order-book-aggregated) 
- Add **time** field to Level-1,2,3 Data 
- Add **detail** fields to [Get Currencies](#get-currencies)
- Add [Get Fiat Price](#get-fiat-price)

**2/20/19** : 

- Add **time** field to [Get All Tickers](#get-all-tickers) and [Get Ticker](#get-ticker) 

**2/19/19** : 

- Add [Get All Tickers](#get-all-tickers)

**2/18/19** : 

- Add [Recent Orders](#recent-orders)
- Add [Recent Fills](#recent-fills)

**2/16/19** : 

- Add [All Symbols Ticker](#all-symbols-ticker) subscription
- Modify [Permissions](#permissions)

**1/30/19** : 

- Add SDK official provider [CCXT](#client-libraries)

**1/25/19** : 

- Add [Get Market List](#get-market-list)
- Add [Symbol Snapshot Feed](#symbol-snapshot)
- Add [Market Snapshot Feed](#market-snapshot)
- Add official [Java & Go SDK](#client-libraries)


# General
Here follows the general information for the KuCoin System and API.

# Matching Engine

## Order Lifecycle

Valid orders sent to the matching engine are confirmed immediately and are in the received state. If an order executes against another order immediately, the order is considered done. An order can execute in part or whole. Any part of the order not filled immediately, will be considered open. Orders will stay in the open state until canceled or subsequently filled by new orders. Orders that are no longer eligible for matching (filled or canceled) are in the done state.

## Self-Trade Prevention

The **Self-Trade Prevention** is **an option** (set as not-selected by default) in advanced settings. When you specify **STP** when placing orders, your order will not fill your other orders. On the contrary, if you did not choose **STP** in Advanced, your order might be filled by your own orders.

### DECREMENT AND CANCEL(DC)

**Market orders are currently not supported for DC**. When two orders from the same user cross, the smaller order will be canceled and the larger order will be decremented by the size of the smaller order. If the two orders are the same size, both will be canceled.

### CANCEL OLDEST(CO)

Cancel the older (resting) order in full. The new order continues to execute.

### CANCEL NEWEST(CN)

Cancel the newer (taking) order in full. The old resting order remains on the order book.

### CANCEL BOTH(CB)

Immediately cancel both orders.

# Client Libraries

Client libraries can help you integrate with our API quickly.

**OFFICIAL**

- [Java SDK](https://github.com/Kucoin/KuCoin-Java-SDK)
- [PHP SDK](https://github.com/Kucoin/KuCoin-PHP-SDK)
- [Go SDK](https://github.com/Kucoin/KuCoin-Go-SDK)
- [Python SDK](https://github.com/Kucoin/python-kucoin)

CCXT is our official SDK provider and you may access the KuCoin API through CCXT. For more information, please visit: [https://ccxt.trade](https://ccxt.trade).

**UNOFFICIAL**

Thanks to the great community contributors, these are the open source SDKs contributed by community developers. Since each library is updated frequently, KuCoin does not review all source code and does not rigorously test it. KuCoin is not responsible for the security of the SDK. Please conduct a basic code review and assess the risks before use.

- Python [sammchardy/python-kucoin](https://github.com/sammchardy/python-kucoin)
- .NET [mscheetz/KuCoinApi.Net](https://github.com/mscheetz/KuCoinApi.Net/tree/v2.0)

If you are a developer, [submit](https://github.com/Kucoin) your sdk to us and get KCS rewards.

**Examples**

- PHP Single File Example (GET & POST & DELETE)  [Github Link](https://github.com/Kucoin/kucoin-api-docs/tree/master/examples/php)

- - -

# Sandbox
**Sandbox is the test environment**, used for testing an API connection or web trading. It provides all the functionalities of the live exchange. All funds and transactions there are simulated for testing purposes.
 
The login session and the API key in the sandbox environment are completely separated from the production environment. You may use the web interface in the sandbox environment to create an API key. 

Notice: After registering in the sandbox environment, you will receive a nummber amount of fake funds (BTC, ETH or KCS) automatically released by the system in your account. If you want to **trade**, please transfer assets from the  **main**  account to the  **trade** account. The funds are only for test purposes and cannot be withdrawn.

Sandbox URLs for API test:

Website:
**[https://sandbox.kucoin.com](https://sandbox.kucoin.com)**

REST API:
**https://openapi-sandbox.kucoin.com**


# Rate Limit

When a rate limit is exceeded, a status of **429 Too Many Requests** will be returned.

When the rate limit is exceeded multiple times, your IP or account may be suspended. The suspension time ranges from 2 minutes to 7 days.

If you are a professional trader or market maker and need a higher limit, please contact us at [api@kucoin.com](mailto:api@kucoin.com). In your message, please provide us with your KuCoin account username, describe your usage of the API and tell us your approximate trading volume.

##REST API##
###PUBLIC ENDPOINTS###

Public endpoints are throttled by IP: 100 requests per ten seconds.

###PRIVATE ENDPOINTS###

Private endpoints are throttled by the user ID: 200 requests per ten seconds.

####Hard-Limits####

[List Fills](#list-fills): 50 requests per 10 seconds(block 10 seconds)

[List orders](#list-orders): 150 requests per 10 seconds(block 10 seconds)


###WEBSOCKET###

The number of connections established at the same time cannot exceed **10**.

#### connect
* 30 times per minutes

#### subscribe 
* 120 times per minutes

#### unsubscribe 
* 120 times per minutes

<aside class="notice">Subscribe to a maximum of 100 topics.</aside>

# REST API

## Base URL

The REST API has endpoints for account and order management as well as public market data.

The base url is **https://api.kucoin.com**.  

The request URL needs to be determined by BASE and specific endpoint combination. 

## Endpoint

Each interface has its own endpoint, described by field **HTTP REQUEST** in the docs. 

For the **GET METHOD** API, the endpoint needs to contain the query parameters string.

e.g. For "[List Accounts](#accounts)", the default endpoint of this API is **/api/v1/accounts**. 
If you pass the "currency" parameter(BTC), the endpoint is  **/api/v1/accounts?currency=BTC** and the final request url is **https://openapi-v2.kucoin.com/api/v1/accounts?currency=BTC**.

# Request
All requests and responses are **application/json** content type.  

Unless otherwise stated, all timestamp parameters should in milliseconds. e.g. **1544657947759**

## Parameters

For the **GET, DELETE** request, all query parameters need to be included in the request url. (**e.g. /api/v1/accounts?currency=BTC**)

For the **POST, PUT** request, all query parameters need to be included in the request body with JSON. (**e.g. {"currency":"BTC"}**). **Do not include extra spaces in JSON strings.**

## Data Parameters

All interfaces may add new parameters in the future, existing parameters will not change, please pay attention to compatibility during programming.

## Errors

Errors forto bad requests will respond with an HTTP error code or system error code. The body will also contain a message parameter indicating the cause.

### HTTP error status codes

```
{
  "code": "400100",
  "msg": "Invalid Parameter."
}

```

Code | Meaning
---------- | -------
400 | Bad Request -- Invalid request format
401 | Unauthorized -- Invalid API Key
403 | Forbidden -- The requested data can be accessed by for administrators only.
404 | Not Found -- The specified resource could not be found.
405 | Method Not Allowed -- You tried to access the resource with an invalid method.
415 | Unsupported Media Type. You need to use: application/json.
429 | Too Many Requests -- Exceeded the access frequency limit.
500 | Internal Server Error -- We had a problem with our server. Try again later.
503 | Service Unavailable -- We're temporarily offline for maintenance. Please try again later.


###System error codes###

Code | Meaning
---------- | -------
400001 | Any of KC-API-KEY, KC-API-SIGN, KC-API-TIMESTAMP, KC-API-PASSPHRASE is missing in your request header
400002 | KC-API-TIMESTAMP Invalid -- Your time differs from the server time by more than 5 seconds
400003 | KC-API-KEY doesn’t exist
400004 | KC-API-PASSPHRASE error
400005 | Signature error -- Please check your signature
400006 | The requested IP address is not in the API whitelist
400007 | Access Denied -- Your API-key does not have sufficient permissions to access the URL
404000 | Url Not Found -- The requested resource could not be found
400100 | Parameter Error -- You tried to access the resource with invalid parameters
411100 | User is frozen -- The user is frozen, please contact us via support center.
500000 | Internal Server Error -- We had a problem with our server. Try again later.


## Success

A successful response is indicated by an HTTP status code 200 and system code 200000. The success payload is as follows:

```
{
  "code": "200000",
  "data": "1544657947759"
}
```

The response may contain optional data. If the response has data it will be documented under each resource below.

Although the HTTP status code is 200, the business request content is incorrect. In this case, you need to check the corresponding business error code.

## Pagination

KuCoin uses pagination for all REST requests which return arrays. Pagination allows for fetching results with the current page and is well suited for real-time data. Endpoints like /api/v1/trades, /api/v1/fills, /api/v1/orders, return the latest items by default. To retrieve more results, subsequent requests should specify the direction in which to paginate, based on the data previously returned.

### PARAMETERS ###

Parameter | Default | Description
---------- | ------- | ------
currentPage | 1 | Current request page.
pageSize | 50 | Number of results per request.The minimum pageSize is **10** and maximum is **500**.


### EXAMPLE
**GET /api/v1/orders?currentPage=1&pageSize=50**


# Types 

## Timestamps 

Unless otherwise specified, all timestamps from API are returned in **milliseconds**(e.g. **1546658861000**). Most modern languages and libraries will handle this without issues. 

But you need to be aware that the timestamps between the **matching engine** and the **order** system are in nanoseconds.

## Numbers 
Decimal numbers are returned as strings in order to preserve the full precision across platforms. When making a request, it is recommended that you also convert your numbers to strings to avoid truncation and precision errors.

Integer numbers (like trade ID and sequence) are unquoted.

# Authentication

## Generating an API Key

Before being able to sign any requests, you must create an API key via the KuCoin website. Upon creating a key you will have 3 pieces of information which you must remember:

* Key
* Secret
* Passphrase

The Key and Secret will be randomly generated and provided by KuCoin. The passphrase is filled in when you create the API. be cautious as the passphrase you create cannot be recovered if forgotten, you can only apply for a new API key again. KuCoin stores a salted hash of your passphrase for verification.

## Permissions

You can restrict the functionality of API keys. Before creating the key, you must choose what permissions you would like the key to have. The permissions are:

* **General** - Allows key general permissions. This includes all GET endpoints.
* **Trade** - Allows a key to create orders, as well as retrieve trade data. This includes POST /api/v1/orders and several GET endpoints.
* **Transfer** - Allows a key to transfer currency on behalf of an account, including deposits and withdraws. Enable with caution - API key transfers WILL BYPASS two-factor authentication.

Please refer to the documentation below to see what API key permissions are required for a specific route.

## Creating a Request

All REST requests must contain the following headers:

* **KC-API-KEY** The API key as a string.
* **KC-API-SIGN** The base64-encoded signature (see Signing a Message).
* **KC-API-TIMESTAMP** A timestamp for your request.
* **KC-API-PASSPHRASE** The passphrase you specified when creating the API key.

## Signing a Message

```php
    <?php
    class API {
        public function __construct($key, $secret, $passphrase) {
          $this->key = $key;
          $this->secret = $secret;
          $this->passphrase = $passphrase;
        }

        public function signature($request_path = '', $body = '', $timestamp = false, $method = 'GET') {
          
          $body = is_array($body) ? json_encode($body) : $body; // Body must be in json format
          
          $timestamp = $timestamp ? $timestamp : time() * 1000;

          $what = $timestamp . $method . $request_path . $body;

          return base64_encode(hash_hmac("sha256", $what, $this->secret, true));
        }
    }
    ?> 
```

```python
    #Example for get balance of accounts in python
    
    api_key = "api_key"
    api_secret = "api_secret"
    api_passphrase = "api_passphrase"
    url = 'https://openapi-sandbox.kucoin.com/api/v1/accounts'
    now = int(time.time() * 1000)
    str_to_sign = str(now) + 'GET' + '/api/v1/accounts'
    signature = base64.b64encode(
        hmac.new(api_secret.encode('utf-8'), str_to_sign.encode('utf-8'), hashlib.sha256).digest())
    headers = {
        "KC-API-SIGN": signature,
        "KC-API-TIMESTAMP": str(now),
        "KC-API-KEY": api_key,
        "KC-API-PASSPHRASE": api_passphrase
    }
    response = requests.request('get', url, headers=headers)
    print(response.status_code)
    print(response.json())
    
    #Example for create deposit addresses in python
    url = 'https://openapi-sandbox.kucoin.com/api/v1/deposit-addresses'
    now = int(time.time() * 1000)
    data = {"currency": "BTC"}
    data_json = json.dumps(data)
    str_to_sign = str(now) + 'POST' + '/api/v1/deposit-addresses' + data_json
    signature = base64.b64encode(
        hmac.new(api_secret.encode('utf-8'), str_to_sign.encode('utf-8'), hashlib.sha256).digest())
    headers = {
        "KC-API-SIGN": signature,
        "KC-API-TIMESTAMP": str(now),
        "KC-API-KEY": api_key,
        "KC-API-PASSPHRASE": api_passphrase,
        "Content-Type": "application/json" # specifying content type or using json=data in request
    }
    response = requests.request('post', url, headers=headers, data=data_json)
    print(response.status_code)
    print(response.json())
```

The **KC-API-SIGN** header is generated by creating a sha256 HMAC using the secret key on the prehash string **timestamp** + **method** + **requestEndpoint** + **body** (JSON string, needs to be the same as the parameters passed by the API) and **base64-encode** the output. The timestamp value is the same as the **KC-API-TIMESTAMP** header.

The method should be **UPPER CASE**.

For **GET, DELETE** request, the **requestEndpoint** needs to contain the query string. e.g. **/api/v1/deposit-addresses?currency=BTC**，the body is the request body string or omitted if there is no request body (typically for GET requests).

<aside class="notice">Remember to base64-encode the digest output before sending in the header.</aside>


```python
#Example for Create Deposit Address

curl -H "Content-Type:application/json" -H "KC-API-KEY:5c2db93503aa674c74a31734" -H "KC-API-TIMESTAMP:1547015186532" -H "KC-API-PASSPHRASE:Abc123456" -H "KC-API-SIGN:7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4=" 
-X POST -d '{"currency":"BTC"}' http://openapi-v2.kucoin.com/api/v1/deposit-addresses

KC-API-KEY = 5c2db93503aa674c74a31734
KC-API-SECRET = f03a5284-5c39-4aaa-9b20-dea10bdcf8e3
KC-API-PASSPHRASE = Abc123456
TIMESTAMP = 1547015186532
METHOD = POST
ENDPOINT = /api/v1/deposit-addresses
STRING-TO-SIGN = 1547015186532POST/api/v1/deposit-addresses{"currency":"BTC"}
KC-API-SIGN = 7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4=
```

<aside class="spacer16"></aside>
<aside class="spacer8"></aside>

## Selecting a Timestamp

The **KC-API-TIMESTAMP** header MUST be number of **milliseconds** since Unix Epoch in UTC. Decimal values are allowed, e.g. 1547015186532. But you need to be aware that timestamp between match and order is **nanosecond**.

Your timestamp must be within **5 seconds** of the API service time or your request will be considered expired and rejected. We recommend using the time endpoint to query for the API [server time](/#time) if you believe there many be a time difference between your server and the API servers.


# User
You need to sign the request to use the private user API.


# User Info

##Get User Info of all Sub-Accounts##

```json
[{
		"userId": "5cbd31ab9c93e9280cd36a0a",  //subUserId
		"subName": "kucoin1",
		"remarks": "kucoin1"
	},
	{
		"userId": "5cbd31b89c93e9280cd36a0d",
		"subName": "kucoin2",
		"remarks": "kucoin2"
	}
]
```

You can get the user info of all sub-users via this interface.

###HTTP REQUEST###

**Get /api/v1/sub/user**

### Parameters
No parameter is needed for this endpoint.

### Responses

Field | Description
--------- | ------- 
userId | The user ID of the sub-user
subName | The username of the sub-user
remarks | Remark

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

# Accounts

##List Accounts##

```json
[{
    "id": "5bd6e9286d99522a52e458de",
    "currency": "BTC",
    "type": "main",
    "balance": "237582.04299",
    "available": "237582.032",
    "holds": "0.01099"
},
{
    "id": "5bd6e9216d99522a52e458d6",
    "currency": "BTC",
    "type": "trade",
    "balance": "1234356",
    "available": "1234356",
    "holds": "0"
}]

```
Get a list of accounts.

See the Deposits section for documentation on how to deposit funds in order to begin trading.

###HTTP REQUEST###
**GET /api/v1/accounts**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
currency | string | *[optional]* The code of the currency 
type | string | *[optional]* Account type, valid values: **main** or **trade** 

### Responses
Field | Description
--------- | ------- 
id | The id of the account 
currency | The currency of the account 
type | Account type, **main** or **trade** 
balance | Total funds in the account 
available | Funds available to withdraw or trade 
holds | Funds on hold (not available for use) 

###ACCOUNT TYPE###
For a currency, you have two types of accounts: **main** and **trade**. You can easily transfer assets between two accounts for free.

The main account isused for the storage, withdrawal, and deposit of funds. The assets in the main account cannot be directly involved in any trading. The assets can be transferred to the trading account and then be traded.

The trading account isused for trading. When you place an order, the system will use the balance of the trading account. The funds in the trading account cannot be used for withdrawal.

###FUNDS ON HOLD###
When you place an order, the funds for the order are placed on hold. They cannot be used for other orders or withdrawn. Funds will remain on hold until the order is filled or canceled.

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

##Get an Account##
```json
{
    "currency": "KCS",
    "balance": "1000000060.6299",
    "available": "1000000060.6299",
    "holds": "0"
}
```
Information for a single account. Use this endpoint when you know the accountId.

###HTTP REQUEST###
**GET /api/v1/accounts/\<accountId\>**

### Parameters

Param | Type | Description
--------- | ------- | ---------
accountId | string | Id of the account

### Responses
Field | Description
--------- | ------- 
currency | The currency of the account 
balance | Total funds in the account 
holds | Funds on hold (not available for use) 
available | Funds available to withdraw or trade 

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.



##Create an Account##
```json
{
    "id": "5bd6e9286d99522a52e458de"
}
```

###HTTP REQUEST###
**POST /api/v1/accounts**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
type | string | Account type，**main** or **trade** 
currency | string | Currency code 

### Responses
Field | Description
--------- | ------- 
id | Return the ID of the new account

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

If an asset is deposited, the system will automatically create an account. But if you can't get an account for the asset through the API, you need to create an account.

In order to use the API more quickly and conveniently, it is recommended that you create an account on the **website** first.


## Get Account Ledgers ##

List account activity. Account activity either increases or decreases your account balance. Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

```json
{
	"currentPage": 1,
	"pageSize": 10,
	"totalNum": 3,
	"totalPage": 1,
	"items": [{
			"currency": "KCS",
			"amount": "0.0998",
			"fee": "0",
			"balance": "1994.040596",
			"bizType": "Withdraw",  //business type
			"direction": "in",     //side
			"createdAt": 1540296039000,
			"context": {          //Business core parameters
				"orderId": "5bc7f080b39c5c03286eef8a",
				"txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
			}
		},
		{
			"currency": "KCS",
			"amount": "0.0998",
			"fee": "0",
			"balance": "1994.140396",
			"bizType": "Deposit",
			"direction": "in",
			"createdAt": 1540296039000,
			"context": {
				"orderId": "5bc7f080b39c5c03286eef8a",
				"txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
			}
		},
		{
			"currency": "KCS",
			"amount": "0.0998",
			"fee": "0",
			"balance": "1994.140396",
			"bizType": "trade exchange",
			"direction": "in",
			"createdAt": 1540296039000,
			"context": {
				"orderId": "5bc7f080b39c5c03286eef8e",
				"tradeId": "5bc7f080b3949c03286eef8a",
				"symbol": "BTC-USD"
			}
		}
	]
}
```

###HTTP REQUEST###
**GET /api/v1/accounts/\<accountId\>/ledgers**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
accountId | string | ID of the account 
startAt | long | *[optional]*  Start time. Start time. Unix timestamp calculated in seconds, will return only items which were created after the start time. 
endAt | long | *[optional]*  End time. Unix timestamp calculated in seconds, will return only items which were created before the end time. 

###ENTRY TYPES###
Entry type indicates the reason for the account change.

### Responses
Field | Description
--------- | ------- 
currency | The currency of the account 
amount | The total amount of assets (fees included) involved in assets changes such as transaction, withdrawal and bonus distribution. 
fee | Fees generated in transaction, withdrawal, etc.
balance | Remaining funds after the transaction.
bizType | Business type leading to the changes in funds, such as exchange, withdrawal, deposit,  KUCOIN_BONUS, REFERRAL_BONUS etc. 
direction | **out** or **in**
createdAt | Time of the event
context | Business related information such as order ID, serial No., etc.

###context###
If an entry is the result of a trade (match, fee), the **context** field will contain additional information about the trade.

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

## Get Holds ##

```json
{
    "currentPage": 1,
    "pageSize": 10,
    "totalNum": 2,
    "totalPage": 1,
    "items": [
        {
            "currency": "ETH",
            "holdAmount": "5083",
            "bizType": "Withdraw",     //business type
            "orderId": "5bc7f080b39c5c03286eef8e",
            "createdAt": 1545898567000,
            "updatedAt": 1545898567000
        },
        {
            "currency": "ETH",
            "holdAmount": "1452",
            "bizType": "Withdraw",
            "orderId": "5bc7f518b39c5c033818d62d",
            "createdAt": 1545898567000,
            "updatedAt": 1545898567000
        }
    ]
}
```

Holds are placed on an account for any active orders or pending withdraw requests. As an order is filled, the hold amount is updated. If an order is canceled, any remaining hold is removed. For a withdraw, once it is completed, the hold is removed.

###HTTP REQUEST###
**GET /api/v1/accounts/\<accountId\>/holds**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
accountId | string | ID of the account. 

###ENTRY TYPES###
Entry type indicates the reason for the account hold.

### Responses
Field | Description
--------- | -------
currency | the currency of the account
holdAmount | Remaining funds frozen (calculated by subtracting any unfrozen funds from the initial frozen funds))
bizType | Business type which led to the freezing of the funds, such as transaction, withdrawal etc.
orderId | ID of funds freezed order (this ID is unique to the frozen asset order) 
createdAt | Time of the event
updatedAt | Update time

###orderId###
The orderId field contains the ID of the order or the withdraw request which created the hold.

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

## Get Account Balance of a Sub-Account

```json
{
	"subUserId": "5caefba7d9575a0688f83c45",
	"subName": "sdfgsdfgsfd",
	"mainAccounts": [{
		"currency": "BTC",
		"balance": "8",
		"available": "8",
		"holds": "0"
	}],
	"tradeAccounts": [{
		"currency": "BTC",
		"balance": "1000",
		"available": "1000",
		"holds": "0"
	}]
}
```

This endpoint returns the account info of a sub-user specified by the subUserId.

###HTTP REQUEST###

**GET /api/v1/sub-accounts/\<subUserId\>**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
subUserId | string | The subUserId can be found via ‘/api/v1/sub/user’ endpoint.

### Responses

Field | Description
--------- | ------- 
subUserId | The user ID of the sub-user.
subName | The username of the sub-user.
currency | The currency of the account.
balance | Total funds in the account.
available | Funds available to withdraw or trade.
holds | Funds on hold (not available for use).
 
###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

## Get the Aggregated Balance of all Sub-Accounts of the Current User


```json
[{
		"subUserId": "5caefba7d9575a0688f83c45",
		"subName": "kucoin1",
		"mainAccounts": [{
			"currency": "BTC",
			"balance": "6",
			"available": "6",
			"holds": "0"
		}],
		"tradeAccounts": [{
			"currency": "BTC",
			"balance": "1000",
			"available": "1000",
			"holds": "0"
		}]
	},
	{
		"subUserId": "5caf0e2fd9575a0688f83ceb",
		"subName": "kucoin2",
		"mainAccounts": [{
			"currency": "BTC",
			"balance": "13",
			"available": "13",
			"holds": "0"
		}],
		"tradeAccounts": []
	}
]
```

This endpoint returns the account info of all sub-users.

###HTTP REQUEST###

**GET /api/v1/sub-accounts**

### Parameters

No parameter is needed for this endpoint.

### Responses

Field | Description
--------- | ------- 
subUserId | The user ID of the sub-user.
subName | The username of the sub-user.
currency | The currency of the account.
balance | Total funds in the account.
available | Funds available to withdraw or trade.
holds | Funds on hold (not available for use).
 
###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

## Transfer between Master account and Sub-Account 


```json
{
	"orderId": "5cbd870fd9575a18e4438b9a"
}
```
This endpoint is used for transferring the assets between the master user and the sub-user. 

<aside class="notice">This only supports the main account.</aside>

###HTTP REQUEST###

**POST /api/v1/accounts/sub-transfer**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
clientOid | string | A unique ID generated by client.
amount | string | Transfer amount, a quantity that exceeds the precision of the currency(You can get the precision of the currency via ‘/api/v1/currencies’ endpoint).
direction | string | OUT — the master user to sub user;IN — the sub user to the master user.
subUserId | string | The subUserId can be found by ‘/api/v1/sub/user’ endpoint.

### Responses

Field | Description
--------- | ------- 
orderId | The unique order ID of a sub-transfer.
 
###API KEY PERMISSIONS###
This endpoint requires the **"Trade"** permission.


## Inner Transfer

```json
{
    "orderId": "5bd6e9286d99522a52e458de"
}
```

The inner transfer interface is used for transferring assets between the accounts of a user and is free of charges. For example, a user could transfer assets from their main account to their trading account on the platform. 

<aside class="notice">The sub-account needs to transfer funds from the main account to the trade account before trading.</aside>

###HTTP REQUEST###
**POST /api/v1/accounts/inner-transfer**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
clientOid | string | Request ID
payAccountId | string | Account ID of payer 
recAccountId | string | Account ID of receiver 
amount | string | Transfer amount, a quantity that exceeds the precision of the currency（ Obtained through the currencies interface ）. 

### Responses
Field | Description
--------- | ------- 
orderId | The order ID of a funds transfer

###API KEY PERMISSIONS###
This endpoint requires the **"Trade"** permission.


# Deposits

## Create Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d"   //tag
}
```

Create a deposit address for the currency you intend to deposit.
You can create only one deposit address per currency. 

###HTTP REQUEST###
**POST /api/v1/deposit-addresses**

###API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency

### Responses
Field | Description
--------- | ------- | -----------
address | Deposit address
memo | Address remark. If there’s no remark, it is empty.  When you withdraw from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.


## Get Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d"        //tag
}
```

Get a deposit address for the currency you intend to deposit. If the returned data is null, you may need to create a deposit address first.

###HTTP REQUEST###
**GET /api/v1/deposit-addresses?currency=\<currency\>**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency 

### Responses
Field | Description
--------- | ------- | -----------
address | Deposit address
memo | Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.

## Get Deposit List

```json
{
  "currentPage": 1,
  "pageSize": 5,
  "totalNum": 2,
  "totalPage": 1,
	"items": [{
		"address": "0x5f047b29041bcfdbf0e4478cdfa753a336ba6989",
		"memo": "5c247c8a03aa677cea2a251d",   
		"amount": 1,
		"fee": 0.0001,
		"currency": "KCS",
		"isInner": false,
		"walletTxId": "5bbb57386d99522d9f954c5a@test004",
		"status": "SUCCESS",
		"createdAt": 1544178843000,
		"updatedAt": 1544178891000
	}, {
		"address": "0x5f047b29041bcfdbf0e4478cdfa753a336ba6989",
		"memo": "5c247c8a03aa677cea2a251d",
		"amount": 1,
		"fee": 0.0001,
		"currency": "KCS",
		"isInner": false,
		"walletTxId": "5bbb57386d99522d9f954c5a@test003",
		"status": "SUCCESS",
		"createdAt": 1544177654000,
		"updatedAt": 1544178733000
	}]
}
```

Get deposit page list.

###HTTP REQUEST###
**GET /api/v1/deposits**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | *[optional]*  Currency 
startAt | long | *[optional]*  Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time. 
endAt | long | *[optional]*  End time. Unix timestamp calculated in milliseconds will return only items which were created before the end time.
status | string | *[optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### Responses
Field | Description
--------- | ------- | -----------
address | Deposit address
memo | The note which was left on the deposit address. When you withdraw from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
amount | Deposit amount
fee | Deposit fee
currency | Currency code
isInner | Internal deposit or not
walletTxId | Wallet Txid
status | Status
createdAt | Creation time of the database record
updatedAt | Update time of the database record

<aside class="notice">This request is paginated.</aside>

## Get V1 Historical Deposits List

```json
{
"currentPage": 1,
"pageSize": 1,
"totalNum": 9,
"totalPage": 9,
"items": [{
"currency": "BTC",
"createAt": 1528536998,
"amount": "0.03266638",
"walletTxId": "55c643bc2c68d6f17266383ac1be9e454038864b929ae7cee0bc408cc5c869e8@12ffGWmMMD1zA1WbFm7Ho3JZ1w6NYXjpFk@234",
"isInner": false,
"status": "SUCCESS",
"remark": null
}]
}
```

List of KuCoin V1 historical deposits.

<aside class="notice">Default query for one month of data.</aside>

###HTTP REQUEST###
**GET /api/v1/hist-deposits**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currentPage | int | *[optional]*  The current page.
pageSize | int | *[optional]*  Number of entries per page.  
currency | string | *[optional]*  Currency code.
startAt | long | *[optional]*  Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time. 
endAt | long | *[optional]*  End time. Unix timestamp calculated in milliseconds  will return only items which were created before the end time.  
status | string | *[optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### Responses
Field | Description
--------- | ------- | -----------
amount | Deposit amount
currency | Currency code
isInner | Internal deposit or not
walletTxId | Wallet Txid
remark | remark
createAt | Creation time of the database record
status | Status

<aside class="notice">This request is paginated.</aside>


# Withdrawals


## Get Withdrawals List

```json
{
  "currentPage": 1,
  "pageSize": 10,
  "totalNum": 1,
  "totalPage": 1,
	"items": [{
	  "id": "5c2dc64e03aa675aa263f1ac",
		"address": "0x5bedb060b8eb8d823e2414d82acce78d38be7fe9",
		"memo": "",
		"currency": "ETH",
		"amount": 1.0000000,
        "fee": 0.0100000,
		"walletTxId": "3e2414d82acce78d38be7fe9",
		"isInner": false,
		"status": "FAILURE",
		"createdAt": 1546503758000,
		"updatedAt": 1546504603000
	}]
}
```

###HTTP REQUEST###
**GET /api/v1/withdrawals**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | *[optional]*  Currency code
status | string | *[optional]*  Status. Available value: PROCESSING, WALLET_PROCESSING, SUCCESS, and FAILURE
startAt | long | *[optional]*  Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time.
endAt | long | *[optional]*  End time. Unix timestamp calculated in milliseconds  will return only items which were created before the end time. 

### Responses
Field | Description
--------- | ------- 
id | Unique identity 
address | Withdrawal address
memo | The note that is left on  the withdrawal address. When you withdraw from KuCoin to other platforms, you need to fill in memo(tag). If you don't fill in memo(tag), your withdrawal may not be available.
currency | Currency 
amount | Withdrawal amount
fee | Withdrawal fee 
walletTxId | Wallet Txid
isInner | Internal withdrawal or not
status | status 
createdAt | Creation time
updatedAt | Update time

<aside class="notice">This request is paginated.</aside>


## Get V1 Historical Withdrawals List

```json
{
"currentPage": 1,
"pageSize": 1,
"totalNum": 2,
"totalPage": 2,
"items": [{
"currency": "BTC",
"createAt": 1526723468,
"amount": "0.534",
"address": "33xW37ZSW4tQvg443Pc7NLCAs167Yc2XUV",
"walletTxId": "aeacea864c020acf58e51606169240e96774838dcd4f7ce48acf38e3651323f4",
"isInner": false,
"status": "SUCCESS"
}]
}
```
List of KuCoin V1 historical withdrawals.

<aside class="notice">Default query for one month of data.</aside>

###HTTP REQUEST###
**GET /api/v1/hist-withdrawals**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currentPage | int | *[optional]*  The current page.
pageSize | int | *[optional]*  Number of entries per page.  
currency | string | *[optional]*  Currency code.
startAt | long | *[optional]*  Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time.
endAt | long | *[optional]*  End time. Unix timestamp calculated in milliseconds will return only items which were created before the end time. 
status | string | *[optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### Responses
Field | Description
--------- | ------- | -----------
amount | Deposit amount
currency | Currency code
isInner | Internal deposit or not
walletTxId | Wallet Txid
remark | remark
createAt | Creation time of the database record
status | Status

<aside class="notice">This request is paginated.</aside>


##  Get Withdrawal Quotas

```json
{
	"currency": "KCS",
	"limitBTCAmount": "2.0",
	"usedBTCAmount": "0",
	"limitAmount": "75.67567568",
	"remainAmount": "75.67567568",
	"availableAmount": "9697.41991348",
	"withdrawMinFee": "0.93000000",
	"innerWithdrawMinFee": "0.00000000",
	"withdrawMinSize": "1.4",
	"isWithdrawEnabled": true,
	"precision": 8   //withdrawal precision
}
```

###HTTP REQUEST###
**GET /api/v1/withdrawals/quotas**

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | currency. e.g. BTC

### Responses
Field | Description
--------- | ------- | -----------
currency | Currency
availableAmount | Current available withdrawal amount
remainAmount | Remaining amount available to withdraw the current day
withdrawMinSize | Minimum withdrawal amount
limitBTCAmount | Total BTC amount available to withdraw the current day
innerWithdrawMinFee | Fees for internal withdrawal
usedBTCAmount | The estimated BTC amount (based on the fiat daily limit) that can be withdrawn within the current day
isWithdrawEnabled | Is the withdraw function enabled or not
withdrawMinFee | Minimum withdrawal amount
precision | Floating point precision. 

## Apply Withdraw

```json
{
  "withdrawalId": "5bffb63303aa675e8bbe18f9"
}
```

###HTTP REQUEST###
**POST /api/v1/withdrawals**

###API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency  | string | Currency
address   | string | Withdrawal address
amount | number | Withdrawal amount, a positive number which is a multiple of the amount precision (fees excluded) 
memo   | string | *[optional]*  The note that is left on the withdrawal address. When you withdraw from KuCoin to other platforms, you need to fill in memo(tag). If you don't fill in memo(tag), your withdrawal may not be available.
isInner | boolean | *[optional]*  Internal withdrawal or not. Default setup: false
remark | string | *[optional]*  Remark

### Responses
Field | Description
--------- | ------- 
withdrawalId | Withdrawal id

For cryptocurrency withdrawal, KuCoin supports internal and external transaction fee deduction, which means when the balance in your main account is sufficient to support the withdrawal, the system will initially deduct the transaction fees from your main account. But if the balance in your main account is not sufficient to support the withdrawal, the system will deduct the fees from your withdrawal amount.

For example:

Suppose you are going to withdraw 1 BTC from the KuCoin platform (transaction fee: 0.0001BTC), if the balance in your main account is insufficient, the system will deduct the transaction fees from your withdrawal amount. In this case, you will be receiving 0.9999BTC.

## Cancel Withdrawal

Only withdrawals which are still in a processing status can be canceled.


###HTTP REQUEST###
**DELETE /api/v1/withdrawals/\<withdrawalId\>**

###API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
withdrawalId | string | unique identity for a withdrawal order 

# Trade

You need to sign the request to use the private trade API.

# Orders

## Place a new order

```json
{
  "orderId": "5bd6e9286d99522a52e458de"
}
```

You can place two types of orders: **limit** and **market**. Orders can only be placed if your account has sufficient funds. Once an order is placed, your account funds will be put on hold for the duration of the order. How much and which funds are put on hold depends on the order type and parameters specified. See the Holds details below. 

Please, note that the system will deduct the fees from the orders that entered the order book in advance. Read [List Fills](#list-fills) to learn more.

Before placing an order, please read the [Get Symbol List](#get-symbols-list) to understand the requirements for the quantity parameters for each trading pair.

**Do not include extra spaces in JSON strings**.

###Place Order Limitations:###

The maximum matching orders for a single trading pair in one account is **200** (stop orders included). 


### HTTP Request

**POST /api/v1/orders**

###API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters

| Param     | type   | Description                                                  |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | string | Unique order id  selected by you to identify your order  e.g. UUID |
| side      | string | **buy** or **sell**                                          |
| symbol    | string | a valid trading symbol code. e.g. ETH-BTC                    |
| type      | string | *[optional]* **limit** or **market** (default is **limit**)          |
| remark    | string | *[optional]* leave a note for the order, the length of the note cannot exceed 100 utf8 characters |
| stop      | string | *[optional]* Either **loss** or **entry**. Requires **stopPrice** to be defined |
| stopPrice | string | *[optional]* Only if **stop** is defined, sets trigger price for stop order |
| stp       | string | *[optional]*  self trade prevention , **CN**, **CO**, **CB** or **DC**|

#### LIMIT ORDER PARAMETERS

| Param       | type    | Description                                                  |
| ----------- | ------- | ------------------------------------------------------------ |
| price       | string  | price per base currency                                      |
| size        | string  | amount of base currency to buy or sell                       |
| timeInForce | string  | *[optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**), read [Time In Force](#time-in-force).   |
| cancelAfter | long    | *[optional]*  cancel after **n** seconds, requires **timeInForce** to be **GTT**                   |
| postOnly    | boolean | *[optional]*  Post only flag, invalid when **timeInForce** is **IOC** or **FOK**                               |
| hidden      | boolean | *[optional]*  Order will not be displayed in the order book |
| iceberg    | boolean | *[optional]*  Only aportion of the order is displayed in the order book |
| visibleSize | string  | *[optional]*  The maximum visible size of an iceberg order   |


#### MARKET ORDER PARAMETERS

Param | type | Description
--------- | ------- | -----------
size | string | *[optional]*  Desired amount in base currency
funds | string | *[optional]*  The desired amount of quote currency to use

* It is required that you use one of the two parameters, **size** or **funds**.

###Advanced Description###

###SYMBOL###

The symbol must match a valid trading symbol. The symbols list is available via the /api/v1/symbols endpoint.

###CLIENT ORDER ID###

The optional client_oid field must be a unique ID (e.g UUID) generated by your trading application. This field value will be returned in the order details. You can use this field to identify your orders in the public feed.

The client_oid is different than the server-assigned order ID. You should record the server-assigned order_id as it will be used for future order status updates.

The server-assigned order ID is also returned as the ID field to this HTTP POST request.

<aside class="notice">Please do not repeat the setting of your client_oid and the max size of the client_oid cannot exceed 40 English characters.
</aside>

###TYPE###
When placing an order, you can specify the order type. The order type you specify will determine which other order parameters are required as well as how your order will be executed by the matching engine. If the type is not specified, the order will default to a **limit** order.

The default **limit orders** can be described as a very basic order.. A limit order requires specifying a **price** and **size**. The size is the number of currency you wish to buy or sell, and the price is the price per  a unit of your currency. The limit order will be filled at the price specified or better. A sell order can be filled at the specified price per unit or a higher price per unit. Likewise, a buy order can be filled at the specified price or a lower price, depending on the market conditions. If the market  cannot fill the limit order immediately, then the limit order will become a part of the open order book until filled by another incoming order or canceled by the user.

**Market orders** differ from limit orders in that they provide no pricing guarantees. However, they do provide a way to buy or sell specific amounts of digital assets or fiat without having to specify the price. Market orders execute immediately and will not be shown on the open orders book. Market orders are always considered takers and incur taker fees. When placing a market order you can specify **funds** or **size**. Funds will limit how much of your quote currency account balance is used and size will limit the bitcoin amount transacted.

###STOP ORDERS###
Stop orders wait to be triggered based on the movement of the last trade price. There are two types of stop orders, stop loss and stop entry:

**stop: 'loss':** Triggers when the last trade price changes to a value at or below the stopPrice.

**stop: 'entry':** Triggers when the last trade price changes to a value at or above the stopPrice.

The last trade price is the last price at which an order was filled. This price can be found in the latest match message. Note that not all match messages may be received due to dropped messages.

Note that when triggered, stop orders execute as either market or limit orders, depending on the type. 

When placing a stop loss order, the system will pre-freeze the assets in your account for the order. **When you are going to place a stop market order, we recommend you to specify the specific fund for the order when trading**.

###PRICE###
The price must be specified in priceIncrement symbol units. The priceIncrement is the smallest unit of price. For the BTC-USDT symbol, the priceIncrement is 0.00001000. Prices less than 0.00001000 will not be accepted, The price for the placed order should be multiple numbers of priceIncrement, or the system would report an error when you place the order. Not required for market orders. 

###SIZE###
The size must be greater than the baseMinSize for the symbol and no larger than the baseMaxSize. The size must be specified in baseIncrement symbol units. Size indicates the amount of BTC (or base currency) to buy or sell.

###FUNDS###
The funds field is optionally used for market orders. When specified it indicates how much of the quote currency you wish to buy or sell. For example, a market buy for BTC-USDT with funds specified as 150.00 will spend 150 USD to buy BTC (including any fees). If the funds field is not specified for a market buy order, then size must be specified and KuCoin will use the available funds in your account to buy bitcoin.

A market sell order can also specify the funds. If funds is specified, it will limit the sell to the amount of funds specified. You can use funds with sell orders to limit the amount of quote currency funds received.

The funds must be greater than the quoteMinSize for the symbol and no larger than the quoteMaxSize. The size must be specified in quoteIncrement symbol units. Funds indicates the amount of USDT (or quote currency) to buy or sell.

###TIME IN FORCE###
Time in force policies provide guarantees about the lifetime of an order. There are four policies: Good Till Canceled **GTC**, Good Till Time **GTT**, Immediate Or Cancel **IOC**, and Fill Or Kill **FOK**.

**GTC** Good Till Canceled orders remain open on the book until canceled. This is the default behavior if no policy is specified.

**GTT** Good Till Time orders remain open on the book until canceled or the allotted cancelAfter is depleted on the matching engine. GTT orders are guaranteed to cancel before any other order is processed after the cancelAfter seconds placed in order book.

**IOC** Immediate Or Cancel orders instantly cancel the remaining size of the limit order instead of opening it on the book.

**FOK** Fill Or Kill orders are rejected if the entire size cannot be matched.

* Note, match also refers to self trades.

###POST ONLY###
The post-only flag indicates that the order should only make liquidity. If any part of the order results in taking liquidity, the order will be rejected and no part of it will execute.

### HIDDEN AND ICEBERG###

The **Hidden** and **iceberg Orders** are two **options** in advanced settings (note: the iceberg order is a special form of the hidden order). You may select “Hidden” or “iceberg” as the policy when placing a limit or stop limit order.

If you ticked “**Hidden**” when placing orders, your orders would be filled without being displayed on the orderbook. But please note that your order could still be viewed in the transaction history when it is filled. 

The **iceberg** order is a special form of the hidden order, it is divided into a visible portion and an invisible portion. Iceberg orders can be split into **20** equal parts and you need to set  how many of those parts will be visible. The maximum visible size for an iceberg order is 20, which means that all parts will be shown in the order book.  The minimum visible size for an iceberg order is 1/20 of the total order amount which means that only one of the 20 parts will be displayed in the order book. 

**Note**: The minimum visible size shall be greater than the minimum order size.   

The visible portion of an iceberg order would be executed after being matched. After the execution, new portions of the iceberg order will come out until the order is fully filled.

Iceberg and hidden orders do not mean that they default to taker orders. When an iceberg order or a hidden order enters the life cycle and is immediately matched by the matching engine, then the order is a taker order.But if the order is not matched by the matching engine, the order will be treated as a maker which is waiting to be merged. In the meantime, the order will be a maker order after being matched, but we only charge the taker fee.

**Note**: 1)The system would charge **taker fees** for **hidden** and **iceberg orders**.2)If both "iceberg" and "hidden" are selected, your order will be filled as an **iceberg order** by default.

###HOLDS###
For limit buy orders, we will hold the needed portion from your funds (price x size of the order). Likewise, on sell orders, we will also hold the amount of assets that you wish to sell. Actual fees are assessed at the time of a trade. If you cancel a partially filled or unfilled order, any remaining funds will be released from being held.

For market buy or sell orders where the funds are specified, the funds amount will be put on hold. If only size is specified, all of your account balance (in the quote account) will be put on hold for the duration of the market order (usually a trivially short time). 

###SELF-TRADE PREVENTION###

The **Self-Trade Prevention** is **an option (set as not-selected by default)** in advanced settings. When you specify **STP** when placing orders, your order will not fill your other orders. On the contrary, if you did not choose **STP** in Advanced, your order can be filled by your own orders.

**Market order is currently not supported for DC**. When *timeInForce* is **FOK**, the stp flag will be forced to be specified as **CN**.

| Flag | Name                          |
| ---- | ----------------------------- |
| DC   | Decrease and Cancel           |
| CO   | Cancel oldest                 |
| CN   | Cancel newest                 |
| CB   | Cancel both                   |

###ORDER LIFECYCLE###
The HTTP Request will respond when an order is either rejected (insufficient funds, invalid parameters, etc) or received (accepted by the matching engine). A **200** response indicates that the order was received and is active. **Active** orders may execute immediately (depending on price and market conditions) either partially or fully. A partial execution will put the remaining size of the order in the open state. An order that is filled completely, will go into the **done** state.

Users listening to streaming market data are encouraged to use the order ID field to identify their received messages in the feed.


###RESPONSE###
A successful order will be assigned an order ID. A successful order is defined as one that has been accepted by the matching engine.

<aside class="notice">Open orders do not expire and will remain open until they are either filled or canceled.</aside>

## Cancel an order

```json
{
     "cancelledOrderIds": [
      "5bd6e9286d99522a52e458de"   //orderId
    ]
}
```

Cancel a previously placed order.

You will receive the request return once the system has received the cancellation request. The cancellation request will be processed by the matching engine in sequence. To know if the request is processed(successfully or not), you may check the order status or the update message from the pushes.


### HTTP REQUEST ###
**DELETE /api/v1/orders/\<order-id\>**

### API KEY PERMISSIONS ###
This endpoint requires the **"Trade"** permission.

<aside class="notice">The <b>order ID</b> is the server-assigned order id and not the passed clientOid.</aside>

### CANCEL REJECT ###
If the order could not be canceled (was already filled or previously canceled, etc), then an error response will indicate the reason in the **message** field.

## Cancel all orders

```json
{
   "cancelledOrderIds": [
      "5c52e11203aa677f33e493fb",  //orderId
      "5c52e12103aa677f33e493fe",
      "5c52e12a03aa677f33e49401",
      "5c52e1be03aa677f33e49404",
      "5c52e21003aa677f33e49407",
      "5c6243cb03aa67580f20bf2f",
      "5c62443703aa67580f20bf32",
      "5c6265c503aa676fee84129c",
      "5c6269e503aa676fee84129f",
      "5c626b0803aa676fee8412a2"
    ]
}
```

Attempt to cancel all open orders. The response is a list of ids of the canceled orders.

###HTTP REQUEST###
**DELETE /api/v1/orders**

###EXAMPLE###
**DELETE /api/v1/orders?symbol=ETH-BTC**

###API KEY PERMISSIONS###
This endpoint requires the **"Trade"** permission.

###PARAMETERS###
You can delete a specific symbol using query parameters.

Param | Type | Description
--------- | ------- | -----------
symbol | string | *[optional]* Only cancel orders open for a specific symbol 


## List Orders

```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 153408,
    "totalPage": 153408,
    "items": [
      {
        "id": "5c35c02703aa673ceec2a168",   //orderid
        "symbol": "BTC-USDT",   //symbol
        "opType": "DEAL",      // operation type,deal is pending order,cancel is cancel order
        "type": "limit",       // order type,e.g. limit,markrt,stop_limit.
        "side": "buy",         // transaction direction,include buy and sell
        "price": "10",         // order price
        "size": "2",           // order quantity
        "funds": "0",          // order funds
        "dealFunds": "0.166",  // deal funds
        "dealSize": "2",       // deal quantity
        "fee": "0",            // fee
        "feeCurrency": "USDT", // charge fee currency
        "stp": "",             // self trade prevention,include CN,CO,DC,CB
        "stop": "",            // stop type
        "stopTriggered": false,  // stop order is triggered
        "stopPrice": "0",      // stop price
        "timeInForce": "GTC",  // time InForce,include GTC,GTT,IOC,FOK
        "postOnly": false,     // postOnly
        "hidden": false,       // hidden order
        "iceberg": false,      // iceberg order
        "visibleSize": "0",    // display quantity for iceberg order
        "cancelAfter": 0,      // cancel orders time，requires timeInForce to be GTT
        "channel": "IOS",      // order source
        "clientOid": "",       // user-entered order unique mark
        "remark": "",          // remark
        "tags": "",            // tag order source        
        "isActive": false,     // status before unfilled or uncancelled 
        "cancelExist": false,   // order cancellation transaction record
        "createdAt": 1547026471000  // time
      }
    ]
 }
```

Provides you with a list of your current orders, based on several parameters.

### HTTP REQUEST
**GET /api/v1/orders**

### EXAMPLE
GET **/api/v1/orders?status=active** for retrieving all active orders

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

###PARAMETERS###
You can pinpoint the results with the following query paramaters.

Param | Type | Description
--------- | ------- | -----------
status | string |*[optional]* **active** or **done**(done as default), Only list orders with a specific status .
symbol |string|*[optional]* Only list orders for a specific symbol.
side | string | *[optional]* **buy** or **sell** 
type | string | *[optional]* **limit**, **market**, **limit_stop** or **market_stop** 
startAt | long | *[optional]* Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time. 
endAt | long | *[optional]* End time. Unix timestamp calculated in milliseconds will return only items which were created before the end time.  

<aside class="notice">This request is paginated.</aside>

###ORDER STATUS AND SETTLEMENT###
The open orders in the order book are marked with the active status.. Orders which are no longer resting on the order book, will be marked with the done status. There is a small window between an order being done and settled. An order is settled when all of the fills have settled and the remaining holds (if any) have been removed.

When checking your orders, you can search for any kind of status, based on the parameters you input. Bear in mind, that if you don’t use any parameters the system will return only the orders with the done status by default.

When you query orders, there is no time frame limit for active orders. But when you query for your done orders you can only query data within a time range of one week (the start and end time range cannot exceed 24*7 hours). If it exceeds one week, the system will prompt that you exceed the time limit. If you point out the start time when querying orders but do not specify the end time, the system will automatically present you the maximum one week window and vice versa.

The history for cancelled orders is only kept for **one month**. You will not be able to query for cancelled orders that have happened more than a month ago.


###POLLING###
For high-volume trading it is strongly recommended that you maintain your own list of open orders and use one of the streaming market data feeds to keep it updated. You should poll the open orders endpoint onceyou start trading to obtain the current state of any open orders.

<aside class="notice">Open orders may change their state between the request and the response depending on the market conditions.</aside>


## Get V1 Historical Orders List

```json
{
"currentPage": 1,
"pageSize": 50,
"totalNum": 1,
"totalPage": 1,
"items": [{
"symbol": "SNOV-ETH",
"dealPrice": "0.0000246",
"dealValue": "0.018942",
"amount": "770",
"fee": "0.00001137",
"side": "sell",
"createdAt": 1540080199
}]
}
```

List of KuCoin V1 historical orders.

<aside class="notice">Default query for one month of data.</aside>

###HTTP REQUEST###
**GET /api/v1/hist-orders**

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

###PARAMETERS###
You can request for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
currentPage | int | *[optional]*  The current page.
pageSize | int | *[optional]*  Number of entries per page.  
symbol | string | *[optional]* a valid trading symbol code. e.g. ETH-BTC.
startAt | long | *[optional]*  Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time. 
endAt | long | *[optional]*  End time. Unix timestamp calculated in milliseconds will return only items which were created before the end time. 
side | string | *[optional]*  **buy** or **sell**

<aside class="notice">This request is paginated.</aside>


## Recent Orders

```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 153408,
    "totalPage": 153408,
    "items": [
      {
        "id": "5c35c02703aa673ceec2a168",
        "symbol": "BTC-USDT",
        "opType": "DEAL",
        "type": "limit",
        "side": "buy",
        "price": "10",
        "size": "2",
        "funds": "0",
        "dealFunds": "0.166",
        "dealSize": "2",
        "fee": "0",
        "feeCurrency": "USDT",
        "stp": "",
        "stop": "",
        "stopTriggered": false,
        "stopPrice": "0",
        "timeInForce": "GTC",
        "postOnly": false,
        "hidden": false,
        "iceberg": false,
        "visibleSize": "0",
        "cancelAfter": 0,
        "channel": "IOS",
        "clientOid": "",
        "remark": "",
        "tags": "",
        "isActive": false,
        "cancelExist": false,
        "createdAt": 1547026471000
      }
    ]
 }
```

Get a list of 1000 orders in the last 24 hours.

###HTTP REQUEST###
**GET /api/v1/limit/orders**

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## Get an order

```json
{
    "id": "5c35c02703aa673ceec2a168",
    "symbol": "BTC-USDT",
    "opType": "DEAL",
    "type": "limit",
    "side": "buy",
    "price": "10",
    "size": "2",
    "funds": "0",
    "dealFunds": "0.166",
    "dealSize": "2",
    "fee": "0",
    "feeCurrency": "USDT",
    "stp": "",
    "stop": "",
    "stopTriggered": false,
    "stopPrice": "0",
    "timeInForce": "GTC",
    "postOnly": false,
    "hidden": false,
    "iceberg": false,
    "visibleSize": "0",
    "cancelAfter": 0,
    "channel": "IOS",
    "clientOid": "",
    "remark": "",
    "tags": "",
    "isActive": false,
    "cancelExist": false,
    "createdAt": 1547026471000
 }
```

Get a single order by order ID.

###HTTP REQUEST###
**GET /api/v1/orders/\<order-id\>**

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

<aside class="notice">Open orders may change their state between the time of your request and the response from our server, depending on market conditions.</aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# Fills

## List Fills

```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":251915,
    "totalPage":251915,
    "items":[
        {
            "symbol":"BTC-USDT",    //symbol
            "tradeId":"5c35c02709e4f67d5266954e",   //trade id
            "orderId":"5c35c02703aa673ceec2a168",   //order id
            "counterOrderId":"5c1ab46003aa676e487fa8e3",  //counter order id
            "side":"buy",   //transaction direction,include buy and sell
            "liquidity":"taker",  //include taker and maker
            "forceTaker":true,  //forced to become taker
            "price":"0.083",   //order price
            "size":"0.8424304",  //order quantity
            "funds":"0.0699217232",  //order funds
            "fee":"0",  //fee
            "feeRate":"0",  //fee rate
            "feeCurrency":"USDT",  // charge fee currency
            "stop":"",        // stop type
            "type":"limit",  // order type,e.g. limit,markrt,stop_limit.
            "createdAt":1547026472000  //time
        }
    ]
}
```

Get a list of recent fills.

###HTTP REQUEST###
**GET /api/v1/fills**

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

###PARAMETERS###
You can request fills for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
orderId | string |*[optional]* Limit the list of fills to this orderId（If you specify orderId, ignore other conditions） 
symbol | string |*[optional]* Limit the list of fills to this symbol 
side | string |*[optional]* **buy** or **sell** 
type | string |*[optional]* **limit**, **market**, **limit_stop** or **market_stop** 
startAt | long |*[optional]* Start time. Unix timestamp calculated in milliseconds will return only items which were created after the start time.
endAt | long |*[optional]* End time. Unix timestamp calculated in milliseconds will return only items which were created before the end time. 

**Data time range**

You can retrieve data within a one week time range (the default is the latest week.) The start and end time range cannot exceed 24*7 hours, 604800000 milliseconds. If it exceeds one week, the system will prompt that you exceed the time limit. If you set a start or end time only, without specifying a certain period, the system will show you the maximum possible period of one week.

**Settlement**

The settlement contains two parts: 1) **Transactional settlement** and 2) **Fee settlement**. After an order is matched, the transactional and fee settlement data will be updated in the data store. Once the data is updated, the system would enable the settlement process and will deduct the fees from your pre-frozen assets. After that, the currency will be transferred to the account of the user.  

**Fees**

With the leading matching engine system in the market, users placing orders on KuCoin platform are classified into two types: **taker** and **maker**. **Taker**s, as the taker in the market, would be charged with taker fees; while **maker**s as the maker in the market, would be charged with less fees than the taker, or even get maker fees from KuCoin （The exchange platform would compensate the transaction fees for you）. 

After placing orders on the KuCoin platform, to ensure the execution of these orders, the system would pre-freeze your assets based on the taker fee charges (because the system could not predict the order types you may choose). Please be noted that the system would deduct the fees from the orders entered the orderbook in advance.

If your order is market order, the system would charge taker fees from you.

If your order is limit order and is immediately matched and executed, the system would charge **taker fees** from you. On the contrary, if the order or part or your order is not executed immediately and enters into the order book, the system would charge **maker** **fees** from you if it is executed before being cancelled

After the order is executed and when the left order funds are **0**, the transaction is completed. If the remaining funds is not sufficient to support the minimum product (min.: 0.00000001), then the left part in the order would be cancelled.

If your order is a maker order, the system would return the left pre-frozen **taker** fees to you.

Notice: For a **hidden**/**iceberg** order, if it is not executed immediately and becomes a maker order, the system would still charge **taker fees** from you.

For example:

Take **BTC/USDT** as the trading pair, if you plan to buy **1 BTC** in market price, suppose the fee charge is **0.1%** and the data on the order book is as follows:

| Price（USDT） | Size（BTC） | Side |
| ------------- | ----------- | ---- |
| 4200.00       | 0.18412309  | sell |
| 4015.60       | 0.56849308  | sell |
| 4011.32       | 0.24738383  | sell |
| 3995.64       | 0.84738383  | buy  |
| 3988.60       | 0.20484000  | buy  |
| 3983.85       | 1.37584908  | buy  |

 When you placed a buy order in market price, the order would be executed immediately. The transaction detail is as follows:

| Price（USDT） | Size（BTC） | Fee（BTC） |
| ------------- | ----------- | ---------- |
| 4011.32       | 0.24738383  | 0.00024738 |
| 4015.60       | 0.56849308  | 0.00056849 |
| 4200.00       | 0.18312409  | 0.00018312 |

###LIQUIDITY###
The liquidity field indicates if the fill was the result of a liquidity provider or liquidity taker.

###PAGINATION###
Fills are returned sorted by descending fill time.

<aside class="notice">This request is paginated.</aside>

## Recent Fills

```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":251915,
    "totalPage":251915,
    "items":[
        {
            "symbol":"BTC-USDT",
            "tradeId":"5c35c02709e4f67d5266954e",
            "orderId":"5c35c02703aa673ceec2a168",
            "counterOrderId":"5c1ab46003aa676e487fa8e3",
            "side":"buy",
            "liquidity":"taker",
            "forceTaker":true,
            "price":"0.083",
            "size":"0.8424304",
            "funds":"0.0699217232",
            "fee":"0",
            "feeRate":"0",
            "feeCurrency":"USDT",
            "stop":"",
            "type":"limit",
            "createdAt":1547026472000
        }
    ]
}
```

Get a list of 1000 fills in the last 24 hours.

###HTTP REQUEST###
**GET /api/v1/limit/fills**

###API KEY PERMISSIONS###
This endpoint requires the **"General"** permission.

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# Market Data

Market data is public and can be used without a signed request.

# Symbols & Ticker

## Get Symbols List

```json
[
  {
    "symbol": "BTC-USDT",
    "name": "BTC-USDT",
    "baseCurrency": "BTC",
    "quoteCurrency": "USDT",
    "baseMinSize": "0.00000001",
    "quoteMinSize": "0.01",
    "baseMaxSize": "10000",
    "quoteMaxSize": "100000",
    "baseIncrement": "0.00000001",
    "quoteIncrement": "0.01",
    "priceIncrement": "0.00000001",
    "feeCurrency": "USDT",
    "enableTrading": true
  }
]
```

Get a list of available currency pairs for trading. This API is used to query related configuration information. If you want to get the market information of the trading symbol, please use [Get All Tickers](#get-all-tickers).

###HTTP REQUEST###
**GET /api/v1/symbols**

###PARAMETERS###
You can query all symbols through *market* parameter.

Param | Type | Description
--------- | ------- | -----------
market | string |*[optional]* The trading market.

###Response###

Field | Type | Description
--------- | ------- | -----------
symbol | string | unique code of a symbol, it would not change after renaming 
name | string | Name of trading pairs, it would change after renaming 
baseCurrency | string | Base currency,e.g. BTC.
quoteCurrency | string | Quote currency,e.g. USDT.
baseMinSize | string | Use when placing a quantity order, the minimum order quantity must satisfy baseMinSize.
quoteMinSize | string | Use when placing a funds order, the minimum order funds must satisfy quoteMinSize.
baseMaxSize | string | Use when placing a quantity order, the maximum order quantity must satisfy baseMaxSize.
quoteMaxSize | string | Use when placing a funds order, the maximum order funds must satisfy quoteMaxSize.
baseIncrement | string | The value is used for placing a quantity order and size must satisfy an integer multiple of baseIncrement when placing a quantity order.
quoteIncrement | string | The value is used for placing a funds order and funds/quote must satisfy an integer multiple of quoteIncrement when placing the funds order.
priceIncrement | string | The value is used when entering the price. The price must satisfy an integer multiple of priceIncrement.
feeCurrency | string | Transaction to charge fee currency.
enableTrading | boolean | Available for transaction or not.

The **baseMinSize** and **baseMaxSize** fields define the min and max order size. The **priceIncrement** field specifies the min order price as well as the price increment.This also applies to **quote** currency. 

The order price must be a multiple of this increment (i.e. if the increment is 0.01, order prices of 0.001 or 0.021 would be rejected).

**priceIncrement** and **quoteIncrement** may be adjusted in the future. We will notify you by email and site notifications before adjustment.

<aside class="notice">The code will not change once assigned to a symbol but the min/max/quote sizes and base/quote/price increments can be updated in the future.
</aside>

## Get Ticker

```json
//Get Ticker
{
    "sequence": "1550467636704",
    "bestAsk": "0.03715004",
    "size": "0.17",
    "price": "0.03715005",
    "bestBidSize": "3.803",
    "bestBid": "0.03710768",
    "bestAskSize": "1.788",
    "time": 1550653727731

}
```

This query will include only the inside (i.e. best) buy and sell(buy and sell represent bestBid and bestAsk) data, last price and last trade size. 

###HTTP REQUEST###
**GET /api/v1/market/orderbook/level1?symbol=\<symbol\>**

<aside class="spacer2"></aside>


## Get All Tickers

```json
{
    "time": 1550653727731,
    "ticker": [
      {
        "symbol": "LOOM-BTC",
        "buy": "0.00001191",
        "sell": "0.00001206",
        "changeRate": "0.057",
        "changePrice": "0.00000065",
        "high": "0.0000123",
        "low": "0.00001109",
        "vol": "45161.5073",
        "volValue": "2127.28693026”, 
        "last": "0.00001204"
      },
      {
        "symbol": "BCD-BTC",
        "buy": "0.00018564",
        "sell": "0.0002",
        "changeRate": "-0.0753",
        "changePrice": "-0.00001522",
        "high": "0.00021489",
        "low": "0.00018351",
        "vol": "72.99679763",
        "volValue": "2127.28693026”, 
        "last": "0.00018664"
      }
    ]
  }
```

Request market tickers for all the trading pairs in the market (including 24h volume).

###HTTP REQUEST###
**GET /api/v1/market/allTickers**

<aside class="spacer8"></aside>

## Get 24hr Stats

```json
//Get 24hr Stats
{
    "symbol": "ETH-BTC",    // symbol
    "high": "0.03736329",   // 24h highest price
    "vol": "2127.286930263025",  // 24h volume，the aggregated trading volume in ETH
    "volValue": "43.58567564",  // 24h total, the trading volume in base currency of last 24 hours
    "last": "0.03713983",   // last price
    "low": "0.03651252",    // 24h lowest price
    "buy": "0.03712118",    // bestAsk
    "sell": "0.03713983",   // bestBid
    "changePrice": "0.00037224",  // 24h change price
    "time": 1550847784668,  //time
    "changeRate": "0.0101" // 24h change rate
}
```  

Get 24 hr stats for the symbol. The volume is in base currency units. Open, high and low are in quote currency units.

###HTTP REQUEST###
**GET /api/v1/market/stats?symbol=\<symbol\>**

<aside class="spacer2"></aside>

## Get Market List

```json
//Get Market List
{
	"data":[
    "BTC",
    "ETH",
    "USDT"
  ]
}
```  

Get the transaction currency for the entire trading market.


###HTTP REQUEST###
**GET /api/v1/markets**

<aside class="spacer2"></aside>

# Order Book

## Get Part Order Book(aggregated)

```json
{
    "sequence": "3262786978",
    "time": 1550653727731,
    "bids": [["6500.12", "0.45054140"],
             ["6500.11", "0.45054140"]],  //[price，size]
    "asks": [["6500.16", "0.57753524"],
             ["6500.15", "0.57753524"]]   
}
```

Get a list of open orders for a symbol.

Level-2 order book includes all bids and asks (**aggregated by price**), this level returns only one size for each active price (as if there was only a single order for that size at the level).

This API will return a part of Order Book within **20 depth** or **100 depth** for each side(ask or bid). Let us remind you that the L2_20 and L2_100 APIs have a different rate limit.

In most cases it is recommended that you use the Order Book API as it is the fastest and reduces traffic usage.

To maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#level-2-market-data).


###HTTP REQUEST###

**GET /api/v1/market/orderbook/level2_20?symbol=\<symbol\>**

**GET /api/v1/market/orderbook/level2_100?symbol=\<symbol\>**

### Data Sort ###

**Asks**: Sort price from low to high

**Bids**: Sort price from high to low


## Get Full Order Book(aggregated)

```json
{
    "sequence": "3262786978",
    "time": 1550653727731,
    "bids": [["6500.12", "0.45054140"],
             ["6500.11", "0.45054140"]],  //[price，size]
    "asks": [["6500.16", "0.57753524"],
             ["6500.15", "0.57753524"]]  
}
```

Get a list of open orders for a symbol.

The Level-2 order book includes all bids and asks (**aggregated by price**), this level returns only one size for each active price (as if there was only a single order for that size at the level).

This API will return data with **full** depth.

It is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#level-2-market-data).

###HTTP REQUEST###

**GET /api/v1/market/orderbook/level2?symbol=\<symbol\>**  (Will be deprecated on December 31, 2019)

**GET /api/v2/market/orderbook/level2?symbol=\<symbol\>**  (Recommend)

### Data Sort ###

**Asks**: Sort price from low to high (v2)

**Asks**: Sort price from high to low (v1)

**Bids**: Sort price from high to low (v1 & v2)


## Get Full Order Book(atomic)


```json
 {
        "sequence": "1545896707028",
        "time": 1550653727731,
        "bids": [
            [
                "5c2477e503aa671a745c4057",           //orderId
                "6",                                  //price
                "0.999"                               //size
            ],
            [
                "5c2477e103aa671a745c4054",
                "5",
                "0.999"
            ]
        ],
        "asks": [
            [
                "5c24736703aa671a745c401e",           
                "200",                               
                "1"                                 
            ],
            [
                "5c2475c903aa671a745c4033",
                "201",
                "1"
            ]
        ]
    }
```

Get a list of open orders for a symbol. Level-3 order book includes all bids and asks (non-aggregated, each item in Level-3 means a single order). 

Level 3 is **non-aggregated** and returns the entire order book.

This API is generally used by professional traders because it uses more server resources and traffic, and we have a strict access frequency control.

To Maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#full-matchengine-data-level-3).

###HTTP REQUEST###
**GET /api/v1/market/orderbook/level3?symbol=\<symbol\>**

### Data Sort ###

**Asks**: Sort price from low to high

**Bids**: Sort price from high to low

<aside class="spacer4"></aside>

# Histories

## Get Trade Histories

```json
[
  {
      "sequence": "1545896668571",
      "price": "0.07",                      //Filled price
      "size": "0.004",                      //Filled amount
      "side": "buy",                        //Filled side. The filled side is set to the taker by default.
      "time": 1545904567062140823           //Transaction time
  },
  {
      "sequence": "1545896668578",
      "price": "0.054",
      "size": "0.066",
      "side": "buy",
      "time": 1545904581619888405
  }
]
```
List the latest trades for a symbol.

###HTTP REQUEST###
**GET /api/v1/market/histories?symbol=\<symbol\>**

###SIDE###
The trade **side** indicates the taker order side. The taker order is the order that was matched with open orders opened in the order book. The **buy** side is indicated by an up-tick because the taker had a buy order and their order was received. Conversely, the **sell** side is indicated by a down-tick.

<aside class="spacer2"></aside>

## Get Klines

```json
[
  [
      "1545904980",             //Start time of the candle cycle
      "0.058",                  //opening price
      "0.049",                  //closing price
      "0.058",                  //highest price
      "0.049",                  //lowest price
      "0.018",                  //Transaction amount
      "0.000945"                //Transaction volume
  ],
  [
      "1545904920",
      "0.058",
      "0.072",
      "0.072",
      "0.058",
      "0.103",
      "0.006986"
  ]
]
```
Klines for a symbol. Data are returned in grouped buckets based on requested **type**.

<aside class="notice"> Klines data may be incomplete. No data is published for intervals where there are no ticks.</aside>

<aside class="warning"> Klines should not be polled frequently. If you need real-time information, use the trade and book endpoints along with the websocket feed.</aside>

###HTTP REQUEST###
**GET /api/v1/market/candles?symbol=\<symbol\>**

Param | Description
--------- | -------
startAt | Start time. Unix timestamp is calculated in **seconds not millisecond** 
endAt | End time. Unix timestamp is calculated in **seconds not millisecond** 
type | Type of candlestick patterns: **1min, 3min, 5min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week**

###DETAILS###
For each query, the system would return at most **1500** pieces of data. To obtain more data, please page the data by time.

###RESPONSE ITEMS###
Each bucket is an array of the following information:

* **time** bucket start time
* **open** opening price (first trade) in the bucket interval
* **close** closing price (last trade) in the bucket interval
* **high** highest price during the bucket interval
* **low** lowest price during the bucket interval
* **volume** volume of trading activity during the bucket interval
* **turnover** Turnover of a period of time. The turnover is the sum of the transaction volumes of all orders (Turnover of each order=price*quantity).


###HTTP REQUEST###
**GET /api/v1/market/stats**


# Currencies

These interfaces are public and do not require authentication.

## Get Currencies

```json

[{
    "currency": "BTC",
    "name": "BTC",
    "fullName": "Bitcoin",
    "precision": 8,
    "withdrawalMinSize": "0.002",
    "withdrawalMinFee": "0.0005",
    "isWithdrawEnabled": true,   
    "isDepositEnabled": true
},
{

    "currency": "ETH",
    "name": "ETH",
    "fullName": "Ethereum",
    "precision": 8,
    "withdrawalMinSize": "0.02",
    "withdrawalMinFee": "0.01",
    "isWithdrawEnabled": true,
    "isDepositEnabled": true
  
}]

```

List known currencies.

###HTTP REQUEST###
**GET /api/v1/currencies**

<aside class="notice">Not all currencies may be currently in use for trading.</aside>

**Response**

|field | description|
-----|-----
|currency| Unique and never changes|
|name| The currency name would change after renaming |
|fullName| The currency full name would change after renaming |
|precision| Currency precision |
|withdrawalMinSize| Minimum withdrawal amount |
|withdrawalMinFee| Minimum withdrawal fees |
|isWithdrawEnabled| Support withdrawal or not |
|isDepositEnabled| Support deposit or not |

**CURRENCY CODES**

Currency codes will conform to the ISO 4217 standard where possible. Currencies which have or had no representation in ISO 4217 may use a custom code.

Code | Description
--------- | -------  
BTC | Bitcoin
ETH | Ethereum
KCS | Kucoin Shares

For a coin, the "**currency**" is a fixed value and works as the only recognized identity of the coin. As the "**name**", "**fullnane**" and "**precision**" of a coin are modifiable values, when the "**name**" of a coin is changed, you should use "**currency**" to get the coin. 

For example:

The "**currency**" of XRB is "XRB", if the "**name**" of XRB is changed into "**Nano**", you should use "XRB" (the currency of XRB) to search the coin. 

## Get Currency Detail

Get single currency detail

```json
{
    "currency": "BTC",
    "name": "BTC",
    "fullName": "Bitcoin",
    "precision": 8,
    "withdrawalMinSize": "0.002",
    "withdrawalMinFee": "0.0005",
    "isWithdrawEnabled": true,
    "isDepositEnabled": true
  }
```

###HTTP REQUEST###
**GET /api/v1/currencies/{currency}**

<aside class="notice">Details of the currency.</aside>

**Response**

|field | description|
-----|-----
|currency| Unique and never changes|
|name| The currency name would change after renaming |
|fullName| The currency full name would change after renaming |
|precision| Currency precision |
|withdrawalMinSize| Minimum withdrawal amount |
|withdrawalMinFee| Minimum withdrawal fees |
|isWithdrawEnabled| Support withdrawal or not |
|isDepositEnabled| Support deposit or not |

## Get Fiat Price
Get fiat price for currency

<aside class="notice">Get only tradable currency prices.</aside>

```json
{
    "code": "200000",
    "data": {
        "BTC": "3911.28000000",
        "ETH": "144.55492453",
        "LTC": "48.45888179",
        "KCS": "0.45546856"
    }
}
```
###HTTP REQUEST###
**GET /api/v1/prices**

**Request**

|field | description|
-----|-----
|base| *[optional]* Enter the three-letter ticker of your preferred base currency,eg.USD,EUR. Default is USD |
| currencies | *[optional]* Enter a list of comma-separated cryptocurrencies to limit output currencies,eg.BTC,ETH. Default is all |

# Others
Here are some comprehensive interfaces.

# Time

## Server Time

```json
{  
  "code":"200000",
  "msg":"success",
  "data":1546837113087
}
```

Get the API server time.

### HTTP REQUEST
**GET /api/v1/timestamp**

EPOCH
The epoch field represents decimal seconds since [Unix Epoch](http://en.wikipedia.org/wiki/Unix_time)

# Websocket Feed

REST API has a strict call frequency limit, Websocket is the most recommended and the fastest way to get real-time data. 

<aside class="notice">The recommended way is to just create a websocket connection and subscribe to multiple channels.</aside>

## Apply connect token

```json
{
    "code": "200000",
    "data": {
        "instanceServers": [
            {
                "pingInterval": 50000,
                "endpoint": "wss://push1-v2.kucoin.com/endpoint",
                "protocol": "websocket",
                "encrypt": true,
                "pingTimeout": 10000
            }
        ],
        "token": "vYNlCtbz4XNJ1QncwWilJnBtmmfe4geLQDUA62kKJsDChc6I4bRDQc73JfIrlFaVYIAE0Gv2--MROnLAgjVsWkcDq_MuG7qV7EktfCEIphiqnlfpQn4Ybg==.IoORVxR2LmKV7_maOR9xOg=="
    }
}
```

You need to apply for a token to create a websocket connection. You need to choose one of the two tokens below.

### Public token (No authentication required):

If you only use public channels（e.g. All public market data), please make the following request  to obtain the server list and a temporary public token:

#### HTTP REQUEST

**POST /api/v1/bullet-public**

### Private channels (Authentication request required):

```json
{
    "code": "200000",
    "data": {
        "instanceServers": [
            {
                "pingInterval": 50000,
                "endpoint": "wss://push1-v2.kucoin.com/endpoint",
                "protocol": "websocket",
                "encrypt": true,
                "pingTimeout": 10000
            }
        ],
        "token": "vYNlCtbz4XNJ1QncwWilJnBtmmfe4geLQDUA62kKJsDChc6I4bRDQc73JfIrlFaVYIAE0Gv2--MROnLAgjVsWkcDq_MuG7qV7EktfCEIphiqnlfpQn4Ybg==.IoORVxR2LmKV7_maOR9xOg=="
    }
}
```

If you wish to request some additional private channels and messages (e.g. Account balance notice), please make a request, as follows, after authorization to obtain the server list and an authorized token.

#### HTTP REQUEST

**POST /api/v1/bullet-private**


### Response instanceServers

|field | description|
-----|-----
|pingInterval| It is recommended to set the ping interval in milliseconds |
|pingTimeout| Set the time (in milliseconds) that will be considered as being disconnected if you don’t receive a pong. |
|endpoint| Websocket server address for establishing a connection |
|protocol| The supported protocol |
|encrypt| Indicates whether SSL encryption is used |

## Create connection

```javascript
var socket = new WebSocket("wss://push1-v2.kucoin.com/endpoint?token=xxx&[connectId=xxxxx]");
```

When the connection is successfully established, the system will send a welcome message.


```json
{
  "id":"hQvf8jkno",
  "type":"welcome"
}
```

ConnectId is the connection ID, which is a unique value taken from the client side. The connectId consists of both the ID of the welcome message sent by system after the connection succeed as well as the ID of the error message. 

If you add the parameter below when creating the websocket connection:
**acceptUserMessage="true"**.
You will receive all private events (including their order changes, balance changes and login events).

<aside class="spacer2"></aside>

## Ping
```json
{
  "id":"1545910590801",
  "type":"ping"
}
```

To prevent the TCP link being disconnected by the server, the client side needs to send ping messages to the server to keep the link alive.

After the ping message is sent to the server, the system will return a pong message to the client side.

If the server has not received the ping from the client for **60 seconds**, the server will disconnect.

```json
{
  "id":"1545910590801",
  "type":"pong"
}
```
<aside class="spacer3"></aside>
## Subscribe

```json
{
    "id": 1545910660739,                          //The id should be an unique value
    "type": "subscribe",
    "topic": "/market/ticker:BTC-USDT,ETH-USDT",  //Topic needs to be subscribed. Some topics support to divisional subscribe the informations of multiple trading pairs through ",".
    "privateChannel": false,                      //Adopted the private channel or not. Set as false by default.
    "response": true                              //Whether the server needs to return the receipt information of this subscription or not. Set as false by default.
}
```

To subscribe to channel messages from a certain server, the client side should send a subscription message to the server.

If the subscription succeed, the system would send ack messages to you. When the response is set as true.


```json
{
  "id":"1545910660739",
  "type":"ack"
}
```

While there are topic messages generated, the system would send the corresponding messages to the client side. For details about the message format, please check the definitions of topics.

### Parameters

#### id
Unique string to mark the request.

#### topic
The topic you want to subscribe to.

#### privateChannel
For some specific topics (e.g. /market/level3), **privateChannel** is available. The default value of **privateChannel** is **false**. If the **privateChannel** is set to **true**, the user will only receive messages related to them on the topic. The format of the **topic** field in the returned data is **{topic}:privateChannel:{userId}**.

#### response
If the response is set as true, the system will return the ack messages after the subscriptions succeed.

## UnSubscribe
Unsubscribe from topics you have subscribed to.

```json
{
    "id": "1545910840805",                            //The id should be an unique value
    "type": "unsubscribe",
    "topic": "/market/ticker:BTC-USDT,ETH-USDT",      //Topic needs to be unsubscribed. Some topics support to divisional unsubscribe the informations of multiple trading pairs through ",".
    "privateChannel": false, 
    "response": true,                                  //Whether the server needs to return the receipt information of this subscription or not. Set as false by default.
}
```

```json
{
  "id": "1545910840805",
  "type": "ack"
}
```

### Parameters

#### id
Unique string to mark the request.

#### topic
The topic you want to subscribe to.

#### privateChannel
For some specific **public** topics (e.g. /market/level3), **privateChannel** is available. The default value of **privateChannel** is **false**. If the **privateChannel** is set to **true**, the user will only receive messages related himself on the topic. The format of the **topic** field in the returned data is **{topic}:privateChannel:{userId}**.

#### response
If the response is set as true, the system would return the ack messages after the unsubscription succeed.

## Multiplex

With one physical connection, you could open different multiplex tunnels to subscribe to different **topics** for different data.

For example, enter the command below to open **bt1** multiple tunnel :

 {"id": "1Jpg30DEdU", "type": "openTunnel", "newTunnelId": "bt1", "response": true}

Add “**tunnelId**” in the command: 

{"id": "1JpoPamgFM", "type": "subscribe", "topic": "/market/ticker:KCS-BTC"，"tunnelId": "bt1", "response": true}

You would then, receive messages corresponding to the id **tunnelIId**:  

{"id": "1JpoPamgFM", "type": "message", "topic": "/market/ticker:KCS-BTC", "subject": "trade.ticker", "tunnelId": "bt1", "data": {...}}

To close the **tunnel**, you can enter the command below: 

{"id": "1JpsAHsxKS", "type": "closeTunnel", "tunnelId": "bt1", "response": true}

##### Limitations

1. The multiplex **tunnel** is provided for API users only. 
2. The maximum multiplex tunnels available: **5**.


## Sequence Numbers
The sequence field exists in the order book, the trade history and the snapshot messages by default and the level 3 and level 2 data works to ensure the full connection of the sequence. If the sequence is non-sequential, please enable the calibration logic.

## General Logic for Message Judgement in Client Side
1.Judge message type. There are three types of messages at present: message (the commonly used messages for push), notice (the notices generally used), and command (consecutive command).

2.Judge messages by userId. Messages with userId are private messages, messages without userId are common messages.

3.Judge messages by topic. You could judge the message type through the topic. 

4.Judge messages by subject. For the same type of messages with the same topic, you could judge the type of messages through their subjects. 

# Public Channels

## Symbol Ticker 

```json

{
    "id": 1545910660739,                          
    "type": "subscribe",
    "topic": "/market/ticker:BTC-USDT",
    "response": true                              
}
```
Topic: **/market/ticker:{symbol},{symbol}...**

```json
{
  "type":"message",
  "topic":"/market/ticker:BTC-USDT",
  "subject":"trade.ticker",
  "data":{
    "sequence":"1545896668986",
    "bestAsk":"0.08",
    "size":"0.011",
    "bestBidSize":"0.036",
    "price":"0.08",
    "bestAskSize":"0.18",
    "bestBid":"0.049"
  }
}
```
Subscribe to this topic to get the realtime push of BBO changes.

The ticker channel provides real-time price updates every time a match happens. It batches updates in case of cascading matches, greatly reducing bandwidth requirements.

Please note that more information will be added to messages in this channel in the near future.

<aside class="spacer2"></aside> 
<aside class="spacer4"></aside> 


## All Symbols Ticker

```json

{
    "id": 1545910660739,                          
    "type": "subscribe",
    "topic": "/market/ticker:all",
    "response": true                              
}
```
Topic: **/market/ticker:all**

```json
{
  "type":"message",
  "topic":"/market/ticker:all",
  "subject":"BTC-USDT",
  "data":{
    "sequence":"1545896668986",
    "bestAsk":"0.08",
    "size":"0.011",
    "bestBidSize":"0.036",
    "price":"0.08",
    "bestAskSize":"0.18",
    "bestBid":"0.049"
  }
}
```
Subscribe to this topic to get the realtime push of all market symbols BBO change.

The ticker channel provides real-time price updates every 1 second.

<aside class="spacer2"></aside> 
<aside class="spacer4"></aside> 


## Symbol Snapshot

```json
{
	"data": {
		"sequence": "1545896669291",
		"data": [{
			"trading": true,
			"symbol": "KCS-BTC",
			"buy": 0.00011,
			"sell": 0.00012,
			"sort": 100,
			"volValue": 3.13851792584,
			"baseCurrency": "KCS",
			"market": "BTC",
			"quoteCurrency": "BTC",
			"symbolCode": "KCS-BTC",
			"datetime": 1548388122031,
			"high": 0.00013,
			"vol": 27514.34842,
			"low": 0.0001,
			"changePrice": -1.0e-5,
			"changeRate": -0.0769,
			"lastTradedPrice": 0.00012,
			"board": 0,
			"mark": 0
		}]
	},
	"subject": "trade.snapshot",
	"topic": "\/market\/snapshot:BTC",
	"type": "message"
}
```

Topic: **/market/snapshot:{symbol}**

Subscribe to get snapshot data for a single symbol.

The snapshot data is pushed at **2 second** intervals.

<aside class="spacer4"></aside> 
<aside class="spacer4"></aside> 
<aside class="spacer"></aside> 

## Market Snapshot

```json
{
	"data": {
		"sequence": "1545896669291",
		"data": {
			"trading": true,
			"symbol": "KCS-BTC",
			"buy": 0.00011,
			"sell": 0.00012,
			"sort": 100,
			"volValue": 3.13851792584,   //total
			"baseCurrency": "KCS",
			"market": "BTC",
			"quoteCurrency": "BTC",
			"symbolCode": "KCS-BTC",
			"datetime": 1548388122031,
			"high": 0.00013,
			"vol": 27514.34842,
			"low": 0.0001,
			"changePrice": -1.0e-5,
			"changeRate": -0.0769,
			"lastTradedPrice": 0.00012,
			"board": 0,
			"mark": 0
		}
	},
	"subject": "trade.snapshot",
	"topic": "\/market\/snapshot:KCS-BTC",
	"type": "message"
}
```

Topic: **/market/snapshot:{market}**

Subscribe to get the snapshot data for the entire market.

You can get a market list by [Get Market List](#get-market-list).

The snapshot data is pushed at **2 seconds** intervals.

<aside class="spacer4"></aside> 
<aside class="spacer4"></aside> 
<aside class="spacer"></aside> 

## Level-2 Market Data

```json
{
    "id": 1545910660740,                          
    "type": "subscribe",
    "topic": "/market/level2:BTC-USDT",
    "response": true                              
}
```

Topic: **/market/level2:{symbol},{symbol}...**

Subscribe to this topic to get Level2 order book data.

When the websocket subscription is successful,  the system would send the increment change data pushed by the websocket to you.

```json
{
  "type":"message",
  "topic":"/market/level2:BTC-USDT",
  "subject":"trade.l2update",
  "data":{
    "sequenceStart":1545896669105,
    "sequenceEnd":1545896669106,
    "symbol":"BTC-USDT",
    "changes":{
      "asks":[["6","1","1545896669105"]],           //price, size, sequence
      "bids":[["4","1","1545896669106"]]
    }
  }
}
```

Calibration procedure：

   1.After receiving the websocket l2update data flow, cache the data.

2.Initiate a REST (GET /api/v1/market/orderbook/level2_100?symbol=<symbol>) request to get the snapshot data of l2 order book.

3.Playback  the cached l2update data flow and find the sequence of the snapshot (range of location: sequence_start to sequence_end in l2update ). Discard all the l2update prior to sequence_start, then playback the change to snapshot. 

4.Put the new l2update data flow to the local snapshot to ensure that the sequence_start of the new l2update links up with the sequence_end of the previous l2update.

5.Update the level2 full data based on sequence according to the size. If the price is 0, ignore the messages and update the sequence. If the size=0, update the sequence and remove the price of which the size is 0 out of level 2. For other cases, please update the price.

Subsequent updates will have the type l2update. The property changes of l2updates is an array with [price, size,sequence] tuples. Please note that size is the updated size at that price level, not a delta. A size of "0" indicates the price level can be removed.

**Example**

Take BTC/USDT as an example, suppose the current order book data in level 2 is as follows:

After subscribing to the channel, you would receive changes as follows:

"asks":[

  ["3988.62","8", 15],

  ["3988.61","0", 18],

  ["3988.59","3", 16],

]

"bids":[

  ["3988.50", "44", "17"]

]

<aside class="notice">Description: the message format is [Price, Size, Sequence].</aside>

Get a snapshot of the order book through a **REST** request ([Get Order Book](#get-part-order-book-aggregated)) to build a local order book. Suppose we get the data as follows:

Sequence：**16**

Data：

"asks":[

  ["3988.62","8"],

  ["3988.61","32"],

  ["3988.60","47"],

  ["3988.59","3"],

]

"bids":[

  ["3988.51","56"],

  ["3988.50","15"],

  ["3988.49","100"],

  ["3988.48","10"]

]

The current data on the local order book is as follows:

| Price   | Size | Side |
| ------- | ---- | ---- |
| 3988.62 | 8    | Sell |
| 3988.61 | 32   | Sell |
| 3988.60 | 47   | Sell |
| 3988.59 | 3    | Sell |
| 3988.51 | 56   | Buy  |
| 3988.50 | 15   | Buy  |
| 3988.49 | 100  | Buy  |
| 3988.48 | 10  | Buy  |

In the beginning, the sequence of your local order book is **16**. Discard the feed data of sequence below or equal to **16**, apply playback with sequence **[17,18]** to update the snapshot of the local order book. Now the sequence of your local order book is **18** and your local order book is up-to-date.

**Diff:**

1.**Update size of 3988.50 to 44 (Sequence 17)**

2.**Remove 3988.61 (Sequence 18)**

Now your current order book is up-to-date and final data is as follows:

| Price   | Size | Side |
| ------- | ---- | ---- |
| 3988.62 | 8    | Sell |
| 3988.60 | 47   | Sell |
| 3988.59 | 3    | Sell |
| 3988.51 | 56   | Buy  |
| 3988.50 | 44   | Buy  |
| 3988.49 | 100  | Buy  |
| 3988.48 | 10  | Buy  |

## Match Execution Data

```json
{
    "id": 1545910660741,                          
    "type": "subscribe",
    "topic": "/market/match:BTC-USDT",
    "privateChannel": false,                      
    "response": true                              
}
```
Topic: **/market/match:{symbol},{symbol}...**

For this topic, **privateChannel** is available.

Subscribe to this topic to obtain the matching event data flow of Level 3.

For each order traded, the system would send you the match messages in the following format.

```json
{
  "id":"5c24c5da03aa673885cd67aa",
  "type":"message",
  "topic":"/market/match:BTC-USDT",
  "subject":"trade.l3match",
  "data":{
    "sequence":"1545896669145",
    "symbol":"BTC-USDT",
    "side":"buy",
    "size":"0.01022222000000000000",
    "price":"0.08200000000000000000",
    "takerOrderId":"5c24c5d903aa6772d55b371e",
    "time":"1545913818099033203",
    "type":"match",
    "makerOrderId":"5c2187d003aa677bd09d5c93",
    "tradeId":"5c24c5da03aa673885cd67aa"
  }
}
```
<aside class="spacer8"></aside>
<aside class="spacer"></aside>

## Full MatchEngine Data(Level 3)

```json
{
    "id": 1545910660742,                          
    "type": "subscribe",
    "topic": "/market/level3:BTC-USDT",
    "privateChannel": false,                      
    "response": true                              
}
```

Topic: **/market/level3:{symbol},{symbol}...**

For this topic, **privateChannel** is available.

Subscribe to this topic to fully get the updated data for orders and trades.

The full channel provides real-time updates on orders and trades. These updates can be applied on to a level 3 order book snapshot to maintain an accurate and up-to-date copy of the exchange order book.

<aside class="notice">Note: If you are maintaining a level 2 order book, please consider switching to the level 2 channel.</aside>

An algorithm to maintain an up-to-date level 3 order book is described below. Please note that you will rarely need to implement this yourself.

1. Send a subscribe message for the symbol(s) of interest and the full channel.
2. Queue any messages received over the websocket stream.
3. Make a REST request for the [full atomic order book](#get-full-order-book-atomic) from the REST feed.
4. Playback queued messages, discarding sequence numbers before or equal to the snapshot sequence number.
5. Apply playback messages to the snapshot as needed (see below).
6. After playback is complete, apply real-time stream messages as they arrive.

<aside class="notice">All open and match messages will always result in a change to the order book. Not all done or change messages will result in changing the order book. These messages will be sent for received orders which are not yet on the order book. Do not alter the order book for such messages, otherwise your order book will be incorrect.</aside>

The following messages(**RECEIVED, OPEN, DONE, MATCH, CHANGE**) are sent over the websocket stream in JSON format when subscribing to the full channel:


###RECEIVED###

```json
{
	"type": "message",
	"topic": "/market/level3:BTC-USDT",
	"subject": "trade.l3received",
	"data": {
		"sequence": "1545896669147",
		"symbol": "BTC-USDT",
		"side": "sell",  //side, include buy and sell
		"orderId": "5c24c72503aa6772d55b378d",  //order id
		"price": "4.00000000000000000000", 
		"time": "1545914149935808589",  //timestamp, timestamps is nanosecond
		"clientOid": "",   //unique order id is selected by you to identify your order, e.g. UUID
		"type": "received",  //L3 messege type. If it is a received message, the update is ended.		
		"orderType": "limit" // order type,e.g. limit,markrt,stop_limit
	}
}
```

```json
{
	"type": "message",
	"topic": "/market/level3:BTC-USDT",
	"subject": "trade.l3received",
	"data": {
		"sequence": "1545896669100",
		"symbol": "BTC-USDT",
		"side": "sell",
		"orderId": "5c24c72503aa6772d55b178d",
		"time": "1545914149835808589",
		"clientOid": "",
		"type": "received",
		"orderType": "market"
	}
}
```

When the matching engine receives an order command, the system would send a confirmation message to the user.

This will mean that a valid order has been received and is now with an active status. This message is emitted for every single valid order as soon as the matching engine receives it whether it fills immediately or not.

The received message does not indicate a resting order on the orderbook. It simply indicates a new incoming order which has been accepted by the matching engine for processing. Received orders may cause match messages to follow if they are being filled immediately (i.e if you made a ‘taker’ order). Self-trade prevention may also trigger change messages to follow if the order size needs to be adjusted. Orders which are not fully filled or canceled due to self-trade prevention result in an open message and become resting orders on the orderbook.

<aside class="notice">You can filter your orders through clientOid, but it will be posted to L3 message (it may cause your orders strategy to be known for others), it is recommended that you can use UUID as clientOid.
</aside>

<aside class="spacer8"></aside>
<aside class="spacer4"></aside>


###OPEN###

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3open",
  "data":{
    "sequence":"1545896669148",
    "symbol":"BTC-USDT",
    "side":"sell",  //side, include buy and sell
    "size":"1", //order quantity
    "orderId":"5c24c72503aa6772d55b378d",  //order id
    "price":"6.00000000000000000000",
    "time":"1545914149935808632", //timestamp, timestamps is nanosecond
    "type":"open"  //L3 messege type. If it is an open message, add the corresponding buy or sell order built by orderid, price and size
  }
}
```

When the remaining part in a limit order enters the order book, the system will send an open message to the user.

This will mean that the order is now open on the order book. This message will only be sent for orders which are not fully filled immediately. remaining_size will indicate how much of the order is unfilled and going on the book.

<aside class="notice">When price="" is received, size=0 is hidden.</aside>

<aside class="spacer4"></aside>
<aside class="spacer"></aside>

###DONE###

When the matching life cycle of an order ends, the order will no longer be displayed on the order book and the system will send a done message to the user.

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3done",
  "data":{
    "sequence":"1545896669226",
    "symbol":"BTC-USDT",
    "reason":"filled",
    "side":"buy",
    "orderId":"5c24c96103aa6772d55b380b",
    "time":"1545914730696727106",
    "type":"done"
  }
}
```

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3done",
  "data":{
    "sequence":"1545896669227",
    "symbol":"BTC-USDT",
    "reason":"canceled",  //Order completion status, include canceled and filled
    "side":"buy",  //side, include buy and sell
    "orderId":"5c24c96103aa6772d55b381b",  //order id
    "time":"1545914730696797106",  //timestamp, timestamps is nanosecond
    "type":"done", //L3 messege type. If it is a done message, remove the buy or sell order corresponding to the orderid
    "size": "1.12340000000000000000"  //order quantity
  }
}
```

This will mean that the order is no longer on the order book. The message is sent for all orders for which there was a received message. This message can result from an order being canceled or filled. There will be no more messages for this order_id after a done message. remain_size indicates how much of the order went unfilled; this will be 0 for filled orders.

market orders will not have a remaining_size or price field as they are never on the open order book at a given price.

<aside class="spacer8"></aside>
<aside class="spacer3"></aside>

###MATCH###

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3match",
  "data":{
    "sequence":"1545896669291",
    "symbol":"BTC-USDT",
    "side":"buy",  //side, include buy and sell
    "size":"0.07600000000000000000",  //order quantity
    "price":"0.08300000000000000000",  
    "takerOrderId":"5c24ca2e03aa6772d55b38bf",  //Extract liquidity user order id
    "time":"1545914933083576866",  //timestamp, timestamps is nanosecond
    "type":"match",  //L3 messege type. If it is a match message, reduce the number of order corresponding to the markerOrderId
    "makerOrderId":"5c20492a03aa677bd099ce9d",  //Provide liquidity user order id
    "tradeId":"5c24ca3503aa673885cd67ef"  //match_id，a match to generate two orderids when orders were matched
  }
}
```
When two orders become matched, the system will send a match message to user.

The match message indicates that a trade occurred between two orders. The aggressor or taker order is the one executing immediately after being received and the maker order is a resting order on the book. The side field indicates the maker order side. If the side is sell this indicates the maker was a sell order and the match is considered an up-tick. Respectively, a buy side match is a down-tick.

<aside class="notice">Before entering the orderbook, the iceberg or hidden order is the same as the ordinary order when it is matched as taker(it has a takerOrderId).</aside>

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

###CHANGE###

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3change",
  "data":{
    "sequence":"1545896669656",
    "symbol":"BTC-USDT",
    "side":"buy",  //side, include buy and sell
    "orderId":"5c24caff03aa671aef3ca170",  //order id
    "price":"1.00000000000000000000",
    "newSize":"0.15722222000000000000",  //Updated order quantity
    "time":"1545915145402532254",  //timestamp, timestamps is nanosecond
    "type":"change",  //L3 messege type. If it is a change message, modify the number of buy or sell order corresponding to the orderid
    "oldSize":"0.18622222000000000000"  //order quantity before update
  }
}
```

When an order is changed due to STP, the system would send a change message to the user.
This is the result of self-trade prevention adjusting the order size or available funds. Orders can only decrease in size or funds. Change messages are always sent when an order changes in size; this includes resting orders (open) as well as received but not yet open orders. Change messages are also sent when a new market order goes through self trade prevention and the funds for the market order have changed.

<aside class="spacer8"></aside>
<aside class="spacer4"></aside>

### How to manage a local L3 orderbook correctly###

1.Use the websocket channel: **/market/level3:{symbol}** to subscribe to the level3 incremental data and cache all incremental data received.

2.Get the snapshot data of level3 through the rest interface **https://api.kucoin.com/api/v1/market/orderbook/level3?symbol={symbol}**.

3.Verify the data that you received. The sequence of the snapshot should not  be less than the minimum sequence of all increments of the cache. If this condition is not met, start from the first step.

4.Playback all cached incremental data:

4.1 If the sequence of the incremental data is less or equal to the sequence of the current snapshot, discard the incremental data and end the update; otherwise proceed to 4.2.

4.2 If the sequence of incremental data = sequence+1 of the current snapshot, proceed to 4.2.1 logical update, otherwise proceed to step 4.3.

4.2.1 Update the sequence of the current snapshot to the sequence of the incremental data.

4.2.2 If it is a received message, end the update logic. (because now the received message does not affect the level3 data).

4.2.3 If it is an open message, add the corresponding buy or sell order built by orderid, price and size.

4.2.4 If it is a done message, remove the buy or sell order corresponding to the orderid.

4.2.5 If it is a change message, modify the number of buy or sell order corresponding to the orderid.

4.2.6 If it is a match message, reduce the number of order corresponding to the markerOrderId.

4.3 In this case, the sequence is not continuous. Perform step 2 and re-pull the snapshot data to ensure that the sequence is not missing.

5.Receive the new incremental data push and go to step 4.

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# Private Channels

Subscribe to private channels require **privateChannel=“true”**.

## Stop order received event

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3received",
  "data": {
    "sequence":"1545738118241",
    "symbol":"BTC-USDT",
    "side":"buy",
    "orderId":"5c21e80303aa677bd09d7dff",
    "stopType":"entry",
    "funds":"1.00000000000000000000",
    "time":"1545743136994328401",
    "type":"stop"
  }
}
```
Topic: **/market/level3:{symbol},{symbol}...**

When a stop-limit order is received by the system, you will receive a stop message which means that this order entered the stop queue and waited to be triggered.

<aside class="spacer4"></aside>
<aside class="spacer"></aside>

##Stop order activate event

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3received",
  "data": {
    "sequence":"1545738118241",
    "symbol":"BTC-USDT",
    "side":"buy",
    "orderId":"5c21e80303aa677bd09d7dff",
    "stopType":"entry",
    "funds":"1.00000000000000000000",
    "time":"1545743136994328401",
    "type":"activate"
  }
}
```
Topic: **/market/level3:{symbol},{symbol}...**

When a stop-limit order is triggered, you will receive an activate message which means that this order started the matching life cycle.

<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Account balance notice
```json
{
	"type": "message",
	"topic": "/account/balance",
	"subject": "account.balance",
	"data": {
		"total": "88",
		"available": "88",
		"availableChange": "88",
		"currency": "KCS",
		"hold": "0",
		"holdChange": "0",
		"relationEvent": "main.deposit",
		"relationEventId": "5c21e80303aa677bd09d7dff",
		"time": "1545743136994",
		"accountId": "5bd6e9286d99522a52e458de"
	}
}

```
Topic: **/account/balance**

You will receive this message when an account balance changes. The message contains the details of the change.

<aside class="notice">You can monitor assets change through accountId.</aside>
