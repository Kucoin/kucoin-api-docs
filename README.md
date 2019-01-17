---
title: KuCoin API Documentation

language_tabs: # must be one of https://git.io/vQNgJ

toc_footers:
  - <a href='https://www.kucoin.com'>Sign Up for KuCoin</a>

includes:

search: true
---

# Introduction

Welcome to KuCoin trader and developer documentation. These documents outline exchange functionality, market details, and APIs.

APIs are separated into two categories: trading and feed. Trading APIs require authentication and provide access to placing orders and other account information. Feed APIs provide market data and are public.

# General
General information of KuCoin System and API.

# Matching Engine

## Order Lifecycle

Valid orders sent to the matching engine are confirmed immediately and are in the received state. If an order executes against another order immediately, the order is considered done. An order can execute in part or whole. Any part of the order not filled immediately, will be considered open. Orders will stay in the open state until canceled or subsequently filled by new orders. Orders that are no longer eligible for matching (filled or canceled) are in the done state.



## Self-Trade Prevention

When you specify the **stp** parameter when placing an order, this order will not fill your other orders. You can specify the self-trade prevention behavior.

### DECREMENT AND CANCEL(DC)

**Market order is currently not supported for DC**. When two orders from the same user cross, the smaller order will be canceled and the larger order size will be decremented by the smaller order size. If the two orders are the same size, both will be canceled.

### CANCEL OLDEST(CO)

Cancel the older (resting) order in full. The new order continues to execute.

### CANCEL NEWEST(CN)

Cancel the newer (taking) order in full. The old resting order remains on the order book.

### CANCEL BOTH(CB)

Immediately cancel both orders.

### NOTES FOR MARKET ORDERS

When a **market** order using **DC** self-trade prevention encounters an open limit order, the behavior depends on which fields for the market order message were specified. If **funds** and **size** are specified for a buy order, then **size** for the market order will be decremented internally within the matching engine and **funds** will remain unchanged. The intent is to offset your target size without limiting your buying power. If **size** is not specified, then funds will be decremented. For a market sell, the size will be decremented when encountering existing limit orders.

# Client Libraries

Client libraries can help you integrate with our API quickly.

**OFFICIAL**

- [Java SDK](https://github.com/Kucoin/KuCoin-Java-SDK)
- [PHP SDK](https://github.com/Kucoin/KuCoin-PHP-SDK)

**UNOFFICIAL**

If you are a developer, [submit](/) your sdk to us and get KCS rewards.

- - -

# Sandbox
**Sandbox is the test environment**, used for testing API connection and web trading, and provides all the functionalities for exchanges. In sandbox, you could use fake funds for exchange tests.  
The login session and API key in sandbox environment are completely separated from the production environment. You may use the web interface in sandbox environment to create API key.  
Notice: The deposit is not supported in sandbox environment. You may contact our technical personnels through support channel to **deposit** for you in the sandbox environment. Currently, only BTC and KCS deposit are supported in the sandbox environment on our platform.

Sandbox URLs for API test:

Website:
**https://sandbox.kucoin.com**

REST API:
**https://openapi-sandbox.kucoin.com**


# REST API

## Base URL

The REST API has endpoints for account and order management as well as public market data.

Base url is  **https://openapi-v2.kucoin.com**

Request URL needs to be determined by BASE and specific endpoint combination. 

e.g. For "[Time](#time)", the endpoint of this api is **/api/v1/timestamp**, so final request url is **https://openapi-v2.kucoin.com/api/v1/timestamp**

# Request
All requests and responses are **application/json** content type.  

Unless otherwise stated, all timestamp parameters should in milliseconds. e.g. **1544657947759**

## Errors

Errors to bad requests will respond with HTTP error code or system error code. The body will also contain a message parameter indicating the cause.

###HTTP error status codes###

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
403 | Forbidden -- The requested is hidden for administrators only.
404 | Not Found -- The specified resource could not be found.
405 | Method Not Allowed -- You tried to access the resource with an invalid method.
429 | Too Many Requests -- Exceeded the access frequency
500 | Internal Server Error -- We had a problem with our server. Try again later.
503 | Service Unavailable -- We're temporarily offline for maintenance. Please try again later.



###System error codes###

Code | Meaning
---------- | -------
403000 | No Auth -- The requested is forbidden for current API key.
404000 | Url Not Found -- The request resource could not be found
400100 | Parameter Error -- You tried to access the resource with invalid parameters
411100 | User are frozen -- User are frozen, please contact us via support center.
500000 | Internal Server Error -- We had a problem with our server. Try again later.

While http status code is 200, the error occurs when business failed, you can find api specific business error codes under api detail



## Success

A successful response is indicated by HTTP status code 200 and system code 200000. the success payload is as follows:

```
{
  "code": "200000",
  "data": "1544657947759"
}
```

The response may contain an optional data. If the response has a data it will be documented under each resource below.

## Pagination

KuCoin uses pagination for all REST requests which return arrays. Pagination allows for fetching results with the current page and is well suited for realtime data. Endpoints like /api/v1/trades, /api/v1/fills, /api/v1/orders, return the latest items by default. To retrieve more results subsequent requests should specify which direction to paginate based on the data previously returned.


### PARAMETERS ###

Parameter | Default | Description
---------- | ------- | ------
currentPage | 1 | Current request page.
pageSize | 50 | Number of results per request.

###EXAMPLE###
**GET /api/v1/orders?currentPage=1&pageSize=50**


# Types #

## Timestamps ##

Unless otherwise specified, all timestamps from API are returned in milliseconds. Most modern languages and libraries will handle this without issues. for example:

**1546658861000**

## Numbers ##
Decimal numbers are returned as strings to preserve full precision across platforms. When making a request, it is recommended that you also convert your numbers to strings to avoid truncation and precision errors.

Integer numbers (like trade id and sequence) are unquoted.


## Rate Limit ##

When a rate limit is exceeded, a status of **429 Too Many Requests** will be returned.

When the rate limit is exceeded multiple times, your IP or account may be suspended. The time range is from 2 minutes to 7 days.

###REST API Rate Limit###
####PUBLIC ENDPOINTS####
We throttle public endpoints by IP: 30 requests per ten seconds.

####PRIVATE ENDPOINTS####
We throttle private endpoints by user ID: 50 requests per ten seconds.

###WEBSOCKET Rate Limit###
#### connect
* 2 times per minutes

#### subscribe 
* 10 times per minutes

#### unsubscribe 
* 10 times per minutes


# Private

You need to sign the request to use the private API.

# Authentication

## Generating an API Key

Before being able to sign any requests, you must create an API key via the KuCoin website. Upon creating a key you will have 3 pieces of information which you must remember:

* Key
* Secret
* Passphrase

The Key and Secret will be randomly generated and provided by KuCoin; the Passphrase will be provided by you to further secure your API access. KuCoin stores the salted hash of your passphrase for verification, but cannot recover the passphrase if you forget it.

## Permissions

You can restrict the functionality of API keys. Before creating the key, you must choose what permissions you would like the key to have. The permissions are:

* **View** - Allows a key read permissions. This includes all GET endpoints.
* **Transfer** - Allows a key to transfer currency on behalf of an account, including deposits and withdraws. Enable with caution - API key transfers WILL BYPASS two-factor authentication.
* **Trade** - Allows a key to create orders, as well as retrieve trade data. This includes POST /orders and several GET endpoints.

Please refer to documentation below to see what API key permissions are required for a specific route.

## Creating a Request

All REST requests must contain the following headers:

* **KC-API-KEY** The api key as a string.
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
          
          $timestamp = $timestamp ? $timestamp : time();

          $what = $timestamp . $method . $request_path . $body;

          return base64_encode(hash_hmac("sha256", $what, $this->secret, true));
        }
    }
    ?> 
```

The **KC-API-SIGN** header is generated by creating a sha256 HMAC using the secret key on the prehash string **timestamp** + **method** + **requestEndpoint** + **body** (JSON string, need to be the same as the parameters passed by the API) and base64-encode the output. The timestamp value is the same as the **KC-API-TIMESTAMP** header.

The body is the request body string or omitted if there is no request body (typically for GET requests).

The method should be **UPPER CASE**.

<aside class="notice">Remember to base64-encode the digest output before sending in the header.</aside>


```python
#Example for Get Deposit Address

curl -H "Content-Type:application/json" -H "KC-API-KEY:5c2db93503aa674c74a31734" -H "KC-API-TIMESTAMP:1547015186532" -H "KC-API-PASSPHRASE:Abc123456" -H "KC-API-SIGN:9IzcFtvQ4kAK/UrnQBbzfya2FGjFvZiB1ehl7/BMY/E=" 
-X POST -d '{"currency":"EOS"}' http://openapi-v2.kucoin.com/api/v1/deposit-addresses

KC-API-KEY = 5c2db93503aa674c74a31734
KC-API-SECRET = f03a5284-5c39-4aaa-9b20-dea10bdcf8e3
KC-API-PASSPHRASE = Abc123456
TIMESTAMP = 1547015186532
METHOD = POST
ENDPOINT = /api/v1/deposit-addresses
STRING-TO-SIGN = 1547015186532POST/api/v1/deposit-addresses{"currency":"EOS"}
KC-API-SIGN = 9IzcFtvQ4kAK/UrnQBbzfya2FGjFvZiB1ehl7/BMY/E=
```
## Selecting a Timestamp

The **KC-API-TIMESTAMP** header MUST be number of seconds since Unix Epoch in UTC. Decimal values are allowed.

Your timestamp must be within **5 seconds** of the api service time or your request will be considered expired and rejected. We recommend using the time endpoint to query for the API server time if you believe there many be time skew between your server and the API servers.

# Accounts

## List Accounts

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

Your accounts are separate from your KuCoin accounts. See the Deposits section for documentation on how to deposit funds to begin trading.

###HTTP REQUEST###
**GET /api/v1/accounts?currency=\<currency\>&type=\<type\>**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
currency | string | *[optional]* The code of the currency 
type | string | *[optional]* Account type ，**main** or **trade** 

### Responses
Field | Description
--------- | ------- 
id | The id of the account 
currency | The currency of the account 
type | Account type ，**main** or **trade** 
balance | Total funds in the account 
available | Funds available to withdraw or trade 
holds | Funds on hold (not available for use) 

###ACCOUNT TYPE###
For a currency, you have two types of accounts: **main** and **trade**. You can easily transfer assets between two accounts for free.

The main account is mainly used for the storage, withdrawal and deposit of funds. The assets in the main account cannot be directly involved in the trading. The assets can be transferred to the trading account and then traded.

The trading account is mainly used for trading. When you place a order, system will use the balance of the trading account. The balance of trading account cannot be used for withdrawal.

###FUNDS ON HOLD###
When you place an order, the funds for the order are placed on hold. They cannot be used for other orders or withdrawn. Funds will remain on hold until the order is filled or canceled.

###API KEY PERMISSIONS###
This endpoint requires the **"view"** permission.

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
accountId | string | id of the account

### Responses
Field | Description
--------- | ------- 
currency | The currency of the account 
balance | Total funds in the account 
holds | Funds on hold (not available for use) 
available | Funds available to withdraw or trade 

###API KEY PERMISSIONS###
This endpoint requires the "view" permission.



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
id | Return the id of the new account

###API KEY PERMISSIONS###
This endpoint requires the "transfer" permission.



## Get Account History ##

List account activity. Account activity either increases or decreases your account balance. Items are paginated and sorted latest first. See the Pagination section for retrieving additional entries after the first page.

```json
{
    "currentPage": 1,
    "pageSize": 10,
    "totalNum": 2,
    "totalPage": 1,
    "items": [
        {
            "currency": "KCS",
            "amount": "0.0998",
            "fee": "0",
            "balance": "1994.040596",
            "bizType": "withdraw",
            "direction": "in",
            "createdAt": 1540296039000,
            "context": {
                 "orderId": "5bc7f080b39c5c03286eef8a",
                 "currency": "BTC"
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
accountId | string | Id of the account 
startAt | long | Start time. unix timestamp calculated in seconds, the creation time queried shall posterior to the start time 
endAt | long | End time.  unix timestamp calculated in seconds, the creation time queried shall prior to the end time. 

###ENTRY TYPES###
Entry type indicates the reason for the account change.

### Responses
Type | Description
--------- | ------- 
currency | The currency of the account 
amount | Total amount of assets (fees included) involved in assets changes such as transaction, withdrawal and bonus distribution.
fee | Fees generated in transaction, withdrawal, etc.
balance | Remaining funds after transaction
bizType | Business type leading to the changes in funds, such as transaction, withdrawal, etc.
direction | **out** or **in**
createdAt | Time of the event
context | Business involved information such as order ID, serial No., etc.

###context###
If an entry is the result of a trade (match, fee), the **context** field will contain additional information about the trade.

###API KEY PERMISSIONS###
This endpoint requires the **"view"** permission.

<aside class="notice">This request is paginated.</aside>

## Get Holds ##
Holds are placed on an account for any active orders or pending withdraw requests. As an order is filled, the hold amount is updated. If an order is canceled, any remaining hold is removed. For a withdraw, once it is completed, the hold is removed.

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
            "bizType": "Withdraw",
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

###HTTP REQUEST###
**GET /api/v1/accounts/\<accountId\>/holds**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
accountId | string | Id of the account 

###ENTRY TYPES###
Entry type indicates the reason for the account hold.

### Responses
Type | Description
--------- | -------
currency | the currency of the account
holdAmount | Remaining funds freezed (remaining funds freezed = Initial funds freezed – Funds unfreezed)
bizType | Business type leading to the freezing of the funds, such as transaction, withdrawal etc.
orderId | ID of funds freezed order (only recognized identity)
createdAt | Time of the event
updatedAt | Update time

###orderId###
The orderId field contains the id of the order or withdraw which created the hold.

###API KEY PERMISSIONS###
This endpoint requires the **"view"** permission.

<aside class="notice">This request is paginated.</aside>

## Inner Tranfer

```json
{
    "orderId": "5bd6e9286d99522a52e458de"
}
```

The inner transfer interface is used for assets transfer among the accounts of a user and is free of charges on the platform. For example, a user could transfer assets for free form the main account to the trading account on the platform. 

###HTTP REQUEST###
**POST /api/v1/accounts/inner-transfer**

### Parameters

Param | Type | Description
--------- | ------- | ------- 
clientOid | string | Request id
payAccountId | string | Account id of payer 
recAccountId | string | Account id of receiver 
amount | string | Transfer amount,  a multiple and positive number of the amount precision. 

### Responses
Type | Description
--------- | ------- 
orderId | ID of funds transfer order

###API KEY PERMISSIONS###
This endpoint requires the **"transfer"** permission.


# Orders

## Place a new order

```json
{
  "orderId": "5bd6e9286d99522a52e458de"
}
```

You can place two types of orders: **limit** and **market**. Orders can only be placed if your account has sufficient funds. Once an order is placed, your account funds will be put on hold for the duration of the order. How much and which funds are put on hold depends on the order type and parameters specified. See the Holds details below. 

###Place Order Limitations:###

The maximum matching orders for a single trading pair in one account is **50** (stop limit order included). 

### HTTP Request

**POST /api/v1/orders**



### Parameters

Param | type | Description
--------- | ------- | ------- 
clientOid | string | Unique order id  selected by you to identify your order  e.g. UUID 
type | string | *[optional]* limit or market (default is limit)
side | string | **buy** or **sell**
symbol | string | a valid trading symbol code. e.g. ETH-BTC
remark | string | *[optional]* remark for the order, length cannot exceed 100 utf8 characters 
stop | string | *[optional]* Either **loss** or **entry**. Requires **stopPrice** to be defined 
stopPrice | string | *[optional]* Only if **stop** is defined. Sets trigger price for stop order 
stp | string | *[optional]*  self trade protect , **CN**, **CO**, **CB** or **DC** 
#### LIMIT ORDER PARAMETERS

Param | type | Description
--------- | ------- | ------- 
price | string | price per base currency 
size  | string | amount of base currency to buy or sell 
timeInForce | string | *[optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**)
cancelAfter | long | *[optional]* * cancel after **n** seconds 
postOnly | boolean | *[optional]* ** Post only flag 

\* Requires **timeInForce** to be **GTT**

** Invalid when **timeInForce** is **GTC**, **IOC** or **FOK**

#### MARKET ORDER PARAMETERS

Param | type | Description
--------- | ------- | -----------
size | string | *[optional]*  Desired amount in base currency
funds | string | *[optional]*  Desired amount of quote currency to use

* One of **size** or **funds** is required.

###Advanced Description###

###SYMBOL###

The symbol must match a valid trading symbol. The symbols list is available via the /api/v1/symbols endpoint.

###CLIENT ORDER ID###

The optional client_oid field must be a unique id (e.g UUID) generated by your trading application. This field value will be return in order detail. You can use this field to identify your orders in the public feed.

The client_oid is different than the server-assigned order id. You should record the server-assigned order_id as it will be used for future order status updates.

The server-assigned order id is also returned as the id field to this HTTP POST request.

###TYPE###
When placing an order, you can specify the order type. The order type you specify will influence which other order parameters are required as well as how your order will be executed by the matching engine. If type is not specified, the order will default to a **limit** order.

**limit orders** are both the default and basic order type. A limit order requires specifying a **price** and **size**. The size is the number of bitcoin to buy or sell, and the price is the price per bitcoin. The limit order will be filled at the price specified or better. A sell order can be filled at the specified price per bitcoin or a higher price per bitcoin and a buy order can be filled at the specified price or a lower price depending on market conditions. If market conditions cannot fill the limit order immediately, then the limit order will become part of the open order book until filled by another incoming order or canceled by the user.

**market orders** differ from limit orders in that they provide no pricing guarantees. They however do provide a way to buy or sell specific amounts of bitcoin or fiat without having to specify the price. Market orders execute immediately and no part of the market order will go on the open order book. Market orders are always considered takers and incur taker fees. When placing a market order you can specify **funds** and/or **size**. Funds will limit how much of your quote currency account balance is used and size will limit the bitcoin amount transacted.

###STOP ORDERS###
Stop orders become active and wait to trigger based on the movement of the last trade price. There are two types of stop orders, stop loss and stop entry:

**stop: 'loss':** Triggers when the last trade price changes to a value at or below the stopPrice.

**stop: 'entry':** Triggers when the last trade price changes to a value at or above the stopPrice.

The last trade price is the last price at which an order was filled. This price can be found in the latest match message. Note that not all match messages may be received due to dropped messages.

Note that when triggered, stop orders execute as either market or limit orders, depending on the type. They are therefore subject to holds.

###PRICE###
The price must be specified in priceIncrement symbol units. The price increment is the smallest unit of price. For the BTC-USD symbol, the price increment is 0.01 or 1 penny. Prices less than 1 penny will not be accepted, and no fractional penny prices will be accepted. Not required for market orders.

###SIZE###
The size must be greater than the baseMinSize for the symbol and no larger than the baseMaxSize. The size must be specified in baseIncrement symbol units. size indicates the amount of BTC (or base currency) to buy or sell.

###FUNDS###
The funds field is optionally used for market orders. When specified it indicates how much of the symbol quote currency to buy or sell. For example, a market buy for BTC-USD with funds specified as 150.00 will spend 150 USD to buy BTC (including any fees). If the funds field is not specified for a market buy order, size must be specified and Kucoin will use available funds in your account to buy bitcoin.

A market sell order can also specify the funds. If funds is specified, it will limit the sell to the amount of funds specified. You can use funds with sell orders to limit the amount of quote currency funds received.

The funds must be greater than the quoteMinSize for the symbol and no larger than the quoteMaxSize. The size must be specified in quoteIncrement symbol units. funds indicates the amount of USDT (or quote currency) to buy or sell.

###TIME IN FORCE###
Time in force policies provide guarantees about the lifetime of an order. There are four policies: good till canceled **GTC**, good till time **GTT**, immediate or cancel **IOC**, and fill or kill **FOK**.

**GTC** Good till canceled orders remain open on the book until canceled. This is the default behavior if no policy is specified.

**GTT** Good till time orders remain open on the book until canceled or the allotted cancelAfter is depleted on the matching engine. GTT orders are guaranteed to cancel before any other order is processed after the cancelAfter seconds placed in order book.

**IOC** Immediate or cancel orders instantly cancel the remaining size of the limit order instead of opening it on the book.

**FOK** Fill or kill orders are rejected if the entire size cannot be matched.

* Note, match also refers to self trades.

###POST ONLY###
The post-only flag indicates that the order should only make liquidity. If any part of the order results in taking liquidity, the order will be rejected and no part of it will execute.

###HOLDS###
For limit buy orders, we will hold price x size USD. For sell orders, we will hold the number of Bitcoin you wish to sell. Actual fees are assessed at time of trade. If you cancel a partially filled or unfilled order, any remaining funds will be released from hold.

For market buy orders where funds is specified, the funds amount will be put on hold. If only size is specified, all of your account balance (in the quote account) will be put on hold for the duration of the market order (usually a trivially short time). For a sell order, the size in BTC will be put on hold. If size is not specified (and only funds is specified), your entire BTC balance will be on hold for the duration of the market order.

###SELF-TRADE PREVENTION###

Two orders from the same user will not be allowed to match with one another. To change the self-trade behavior, specify the stp flag. 

| Flag | Name                          |
| ---- | ----------------------------- |
| DC   | Decrease and Cancel           |
| CO   | Cancel oldest                 |
| CN   | Cancel newest                 |
| CB   | Cancel both                   |

###ORDER LIFECYCLE###
The HTTP Request will respond when an order is either rejected (insufficient funds, invalid parameters, etc) or received (accepted by the matching engine). A **200** response indicates that the order was received and is active. **Active** orders may execute immediately (depending on price and market conditions) either partially or fully. A partial execution will put the remaining size of the order in the open state. An order that is filled completely, will go into the **done** state.

Users listening to streaming market data are encouraged to use the order id field to identify their received messages in the feed.


###RESPONSE###
A successful order will be assigned an order id. A successful order is defined as one that has been accepted by the matching engine.

<aside class="notice">Open orders do not expire and will remain open until they are either filled or canceled.</aside>

## Cancel an order

```json
{
     "cancelledOrderIds": [
      "5bd6e9286d99522a52e458de"
    ]
}
```

Cancel a previously placed order.

### HTTP REQUEST ###
**DELETE /api/v1/orders/\<order-id\>**



### API KEY PERMISSIONS ###
This endpoint requires the "trade" permission.

<aside class="notice">The <b>order id</b> is the server-assigned order id and not the passed clientOid.</aside>

### CANCEL REJECT ###
If the order could not be canceled (already filled or previously canceled, etc), then an error response will indicate the reason in the **message** field.

## Cancel all orders

```json
{
   "cancelledOrderIds": [
      "5bd6e9286d99522a52e458de"
   ]
}
```

With best effort, cancel all open orders. The response is a list of ids of the canceled orders.

###HTTP REQUEST###
**DELETE /api/v1/orders**



###API KEY PERMISSIONS###
This endpoint requires the "trade" permission.

###PARAMETERS###
You can delete specific symbol using query parameters.

Param | Type | Description
--------- | ------- | -----------
symbol | string | *[optional]*Only cancel orders open for a specific symbol 


## List orders

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
        "iceberge": false,
        "visibleSize": "0",
        "cancelAfter": 0,
        "channel": "IOS",
        "clientOid": null,
        "remark": null,
        "tags": null,
        "isActive": false,
        "cancelExist": false,
        "createdAt": 1547026471000
      }
    ]
 }
```

List your current orders.

###HTTP REQUEST###
**GET /api/v1/orders**


###API KEY PERMISSIONS###
This endpoint requires the "trade" permission.

###PARAMETERS###
You can request for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
status | string |[optional] active or done,  done as default, Only list orders for a specific status .
symbol |string|[optional] Only list orders for a specific symbol.
side | string | [optional] **buy** or **sell** 
type | string | [optional] limit, market, limit_stop or market_stop 
startAt | long |  [optional] Start time. unix timestamp calculated in milliseconds, the creation time queried shall posterior to the start time. 
endAt | long |  [optional] End time.  unix timestamp calculated in milliseconds, the creation time queried shall prior to the end time. 

<aside class="notice">This request is paginated.</aside>

###ORDER STATUS AND SETTLEMENT###
Orders which are resting on the order book, will be marked with the **active** status. Orders which are no longer resting on the order book, will be marked with the **done** status. There is a small window between an order being done and settled. An order is settled when all of the fills have settled and the remaining holds (if any) have been removed.

For order checking, after inputting the correct parameters, you could check the orders in all **status**. But if the **status** parameter is not input into the **orders** interface, the system would return the orders of **done** status to you by default.

###POLLING###
For high-volume trading it is strongly recommended that you maintain your own list of open orders and use one of the streaming market data feeds to keep it updated. You should poll the open orders endpoint once when you start trading to obtain the current state of any open orders.

<aside class="notice">Open orders may change state between the request and the response depending on market conditions.</aside>

## Get an order

Get a single order by order id.

###HTTP REQUEST###
**GET /api/v1/orders/\<order-id\>**

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
    "iceberge": false,
    "visibleSize": "0",
    "cancelAfter": 0,
    "channel": "IOS",
    "clientOid": null,
    "remark": null,
    "tags": null,
    "isActive": false,
    "cancelExist": false,
    "createdAt": 1547026471000
 }
```

###API KEY PERMISSIONS###
This endpoint requires either the "view" or "trade" permission.

<aside class="notice">Open orders may change state between the request and the response depending on market conditions.</aside>

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

Get a list of recent fills.

###HTTP REQUEST###
**GET /api/v1/fills**

###API KEY PERMISSIONS###
This endpoint requires the "trade" permission.

###PARAMETERS###
You can request fills for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
orderId | string | [optional] Limit list of fills to this orderId 
symbol | string | [optional] Limit list of fills to this symbol 
side | string | [optional] **buy** or **sell** 
type | string | [optional] limit, market, limit_stop or market_stop 
startAt | long |  [optional] Start time. unix timestamp calculated in milliseconds, the creation time queried shall posterior to the start time. 
endAt | long |  [optional] End time.  unix timestamp calculated in milliseconds, the creation time queried shall prior to the end time. 

**Settlement**

The settlement contains two parts: 1) **Transactional settlement** and 2) **Fee settlement**. After an order is matched, the transactional and fee settlement data would be updated in the data store. Once the data is updated, the system would enable the settlement process and deduct the fees from your pre-frozen assets. After that, the currency would be transferred to the account of the user. 

**Fees**

With the leading matching engine system in the market, users placing orders on KuCoin platform are classified into two types: **taker** and **maker**. **Taker**s, as the taker in the market, would be charged with taker fees; while **maker**s as the maker in the market, would be charged with less fees than the taker, or even get maker fees from KuCoin （The exchange platform would compensate the transaction fees for you）. 

After placing orders on the KuCoin platform, to ensure the execution of these orders, the system would pre-freeze your assets based on the taker fee charges (because the system could not predict the order types you may choose).

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

# Deposits

## Create Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d"
}
```

Create deposit address of currency for deposit.
You can just create one deposit address.

###HTTP REQUEST###
**POST /api/v1/deposit-addresses**

###API KEY PERMISSIONS
This endpoint requires the "transfer" permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency

### Responses
Type | Description
--------- | ------- | -----------
address | Deposit address
memo | Address remark. If there’s no remark, it is empty.


## Get Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d"
}
```

Get deposit address of currency for deposit. If return data is null , you may need create a deposit address first.

###HTTP REQUEST###
**GET /api/v1/deposit-addresses**

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency 

### Responses
Type | Description
--------- | ------- | -----------
address | Deposit address
memo | Address remark. If there’s no remark, it is empty.

## Get deposit page list

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

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency 
startAt | long | Start time. unix timestamp calculated in milliseconds, the creation time queried shall posterior to the start time. 
endAt | long | End time.  unix timestamp calculated in milliseconds, the creation time queried shall prior to the end time. 
status | string | Status. Available value: PROCESSING, SUCCESS, and FAILURE

### Responses
Type | Description
--------- | ------- | -----------
address | Deposit address
memo | Remark to the deposit address
amount | Deposit amount
fee | deposit fee
currency | Currency code
isInner | Internal deposit or not
walletTxId | Wallet Txid
status | Status
createdAt | Creation time of the database record
updatedAt | Update time of the database record

<aside class="notice">This request is paginated.</aside>

# Withdrawals


## Check Withdrawals List

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

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | Currency code
status | string | Status. Available value: PROCESSING, WALLET_PROCESSING, SUCCESS, and FAILURE
startAt | long | Start time. unix timestamp calculated in milliseconds, the creation time queried shall posterior to the start time. 
endAt | long | End time.  unix timestamp calculated in milliseconds, the creation time queried shall prior to the end time. 

### Responses
Type | Description
--------- | ------- 
id | Unique identity 
address | Withdrawal address
memo | Remark to the withdrawal address
currency | Currency 
amount | Withdrawal amount
fee | Withdrawal fee 
walletTxId | Wallet Txid
isInner | Internal withdrawal or not
status | status 
createdAt | Creation time
updatedAt | Update time

<aside class="notice">This request is paginated.</aside>

##  Get withdrawal quotas

```json
{
	"currency": "ETH",
	"availableAmount": 2.9719999,
	"remainAmount": 2.9719999,
	"withdrawMinSize": 0.1000000,
	"limitBTCAmount": 2.0,
	"innerWithdrawMinFee": 0.00001,
	"isWithdrawEnabled": true,
	"withdrawMinFee": 0.0100000,
	"precision": 7
}

```

###HTTP REQUEST###
**GET /api/v1/withdrawals/quotas**

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | string | currency. e.g. BTC

### Responses
Type | Description
--------- | ------- | -----------
currency | Currency
availableAmount | Current available withdrawal amount
remainAmount | Remaining amount available to withdraw the day
withdrawMinSize | Minimum withdrawal amount
limitBTCAmount | Total BTC amount available to withdraw the day
innerWithdrawMinFee | Fees for internal withdrawal
isWithdrawEnabled | Available to withdraw or not
withdrawMinFee | Minimum withdrawal amount
precision | Precision

## Apply Withdraw

```json
{
  "withdrawalId": "5bffb63303aa675e8bbe18f9"
}
```

###HTTP REQUEST###
**POST /api/v1/withdrawals**

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency  | string | Currency
address   | string | Withdrawal address
memo   | string | Remark to the withdrawal address
amount | number | Withdrawal amount,  a multiple and positive number of the amount precision (fees excluded) 
isInner | boolean | Internal withdrawal or not. Default setup: false
remark | string | Remark

### Responses
Type | Description
--------- | ------- 
withdrawalId | Withdrawal id

For currency withdrawal, the transaction fee is excluded from the withdrawal amount. Therefore, before the operation, you need to ensure that the balance in your account is sufficient to support the transaction fee, that is, the value of your balance should be greater than the fees needed for **innerWithdrawMinFee** or **withdrawMinFee**. If your balance is not available to afford the fees, the system would prompt out the “Insufficient balance” notice. In this case, you are suggested to reduce the withdrawal amount to ensure that the withdrawal process is going on smoothly and the balance is sufficient to support the fee charges.      

For example:

Suppose you are going to withdraw 1 BTC from KuCoin platform (transaction fee: 0.0001BTC), if the system rejected your request after the withdrawal request is submitted, it may probably lead by the insufficient balance. You should reduce the withdrawal amount to ensure that the balance is sufficient to support the charges.

## Cancel Withdrawal

Only withdrawals in processing status could be cancelled.


###HTTP REQUEST###
**DELETE /api/v1/withdrawals/\<withdrawalId\>**

### Parameters

Param | Type | Description
--------- | ------- | -----------
withdrawalId | string | unique identity for withdrawal order 


# Market Data

Market data is public and can be used without a signed request.

# Symbols

## Get Symbols
Get a list of available currency pairs for trading.

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
    "enableTrading": true
  }
]
```

###HTTP REQUEST###
**GET /api/v1/symbols**

###DETAILS###

Field | Type | Description
--------- | ------- | -----------
symbol | string | unique code of symbol, it would not change after  renaming 
name | string | Name of trading pair, it would change after renaming 
baseCurrency | string | Base currency
quoteCurrency | string | Quote currency
baseMinSize | string | Minimum order quantity
quoteMinSize | string | Minimum order amount
baseMaxSize | string | Maximum order quantity
quoteMaxSize | string | Maximum order amount
baseIncrement | string | Market order: quantity increment
quoteIncrement | string | Market order: amount increment
priceIncrement | string | Limit order: price increment
enableTrading | boolean | Available for transaction or not

The **baseMinSize** and **baseMaxSize** fields define the min and max order size. The **priceIncrement** field specifies the min order price as well as the price increment.This also applies to **quote** currency. 

The order price must be a multiple of this increment (i.e. if the increment is 0.01, order prices of 0.001 or 0.021 would be rejected).

<aside class="notice">Code will not change once assigned to a symbol but the min/max/quote sizes and base/quote/price increments can be updated in the future.</aside>

## Get Ticker



Ticker include only the inside (i.e. best) bid and ask data , last price and last trade size.

###HTTP REQUEST###
**GET /api/v1/market/orderbook/level1?symbol=\<symbol\>**



```json
{
  "sequence": "1545825031840",      //now sequence
  "price": "3494.367783",           //last trade price
  "size": "0.05027185",             //last trade size
  "bestBid": "3494.367783",         //best bid price
  "bestBidSize": "2.60323254",      //size at best bid price
  "bestAsk": "3499.12",             //best ask pirce
  "bestAskSize": "0.01474011"       //size at best ask price
}
```





## Get Part Order Book(aggregated)

```json
{
    "sequence": "3262786978",
    "bids": [["6500.12", "0.45054140"],
             ["6500.11", "0.45054140"]],  //[price，size]
    "asks": [["6500.16", "0.57753524"],
             ["6500.15", "0.57753524"]]   
}
```

Get a list of open orders for a symbol.

Level-2 order book includes all bids and asks (**aggregated by price**), this level return only one size for each active price (as if there was only a single order for that size at the level).

This API will return a part of Order Book within **100 depth** for each side(ask or bid).

It is recommended to use in most cases, it is the fastest Order Book API, and reduces traffic usage.

To maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#level-2-market-data).


###HTTP REQUEST###
**GET /api/v1/market/orderbook/level2_100?symbol=\<symbol\>**


## Get Full Order Book(aggregated)

```json
{
    "sequence": "3262786978",
    "bids": [["6500.12", "0.45054140"],
             ["6500.11", "0.45054140"]],  //[price，size]
    "asks": [["6500.16", "0.57753524"],
             ["6500.15", "0.57753524"]]  
}
```

Get a list of open orders for a symbol.

Level-2 order book includes all bids and asks (**aggregated by price**), this level return only one size for each active price (as if there was only a single order for that size at the level).

This API will return data with **full depth**.

It is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#level-2-market-data).

###HTTP REQUEST###
**GET /api/v1/market/orderbook/level2?symbol=\<symbol\>**


## Get Full Order Book(atomic)


```json
 {
        "sequence": "1545896707028",
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

Level 3 is **non-aggregated** and returns the **entire order book**.

This API is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To Maintain up-to-date Order Book in real time, please use it with [Websocket Feed](#full-matchengine-data-level-3).

###HTTP REQUEST###
**GET /api/v1/market/orderbook/level3?symbol=\<symbol\>**

## Get Trade Histories

List the latest trades for a symbol.

###HTTP REQUEST###
**GET /api/v1/market/histories?symbol=\<symbol\>**

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


###SIDE###
The trade **side** indicates the taker order side. The taker order is the order that was  match with orders opened on the order book. **buy** side indicates a up-tick because the taker was a buy order and their order was received. Conversely, **sell** side indicates an down-tick.

## Get Historic Rates

Historic rates for a symbol. Rates are returned in grouped buckets based on requested **type**.

<aside class="notice"> Historical rate data may be incomplete. No data is published for intervals where there are no ticks.</aside>

<aside class="warning"> Historical rates should not be polled frequently. If you need real-time information, use the trade and book endpoints along with the websocket feed.</aside>

###HTTP REQUEST###
**GET /api/v1/market/candles?symbol=\<symbol\>**

Param | Description
--------- | -------
startAt | Start time, unix timestamp calculated in **seconds not millisecond** 
endAt | End time, unix timestamp calculated in **seconds not millisecond** 
type | Type of candlestick patterns

###DETAILS###
For each query, the system would return at most 1500 pieces of data. To obtain more data, please page the data by time.

The type field must be one of the following values:
{"1min","3min","5min","15min","30min","1hour","2hour","4hour","6hour","8hour", "12hour", "1day","1week"}.


The json data format is as shown below.

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

###RESPONSE ITEMS###
Each bucket is an array of the following information:

* **time** bucket start time
* **open** opening price (first trade) in the bucket interval
* **close** closing price (last trade) in the bucket interval
* **high** highest price during the bucket interval
* **low** lowest price during the bucket interval
* **volume** volume of trading activity during the bucket interval
* **turnover** Turnover of a period of time. The turnover is the sum of the transaction volumes of all orders (Turnover of each order=price*quantity).

## Get 24hr Stats

Get 24 hr stats for the symbol. volume is in base currency units. open, high, low are in quote currency units.

```json
 {
    "symbol": "BTC-USDT",
    "changeRate": "0.0128", //24h change rate
    "changePrice": "0.8", //24h rises and falls in price (if the change rate is a negative number, the price rises; if the change rate is a positive number, the price falls.) 
    "open": 61, //Opening price
    "close": 63.6, //Closing price
    "high": "63.6", //Highest price filled
    "low": "61", //Lowest price filled
    "vol": "244.78", //Transaction quantity
    "volValue": "15252.0127" //Transaction amount
  }

```

###HTTP REQUEST###
**GET /api/v1/market/stats/<symbol>

# Currencies

## Get currencies

List known currencies.

```json

[{
  "currency": "BTC",
  "name": "BTC",
  "fullName": "Bitcoin",
  "precision": 8
},
{
  "currency": "ETH",
  "name": "ETH",
  "fullName": "Ethereum",
  "precision": 7
}]

```

###HTTP REQUEST###
**GET /api/v1/currencies**

<aside class="notice">Not all currencies may be currently in use for trading.</aside>

**Response**

|field | description|
-----|-----
|currency| Unique and never change|
|name| The currency name would change after renaming |
|fullName| The currency full name would change after renaming |
|precision| Currency precision |

**CURRENCY CODES**

Currency codes will conform to the ISO 4217 standard where possible. Currencies which have or had no representation in ISO 4217 may use a custom code.

Code | Description
--------- | -------  
BTC | Bitcoin
ETH | Ethereum
KCS | Kucoin Shares

For a coin, the "**currency**" is a fixed value and works as the only recognized identity of the coin. As the "**name**", "**fullnane**" and "**precision**" of a coin are values modifiable, when the "**name**" of a coin is changed, you should use "**currency**" to get the coin. 

For example:

The "**currency**" of XRB is "XRB", if the "**name**" of XRB is changed into "**Nano**", you should use "XRB" (the currency of XRB) to search the coin. 

## Get currency detail

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
|currency| Unique and never change|
|name| The currency name would change after renaming |
|fullName| The currency full name would change after renaming |
|precision| Currency precision |
|withdrawalMinSize| Minimum withdrawal amount |
|withdrawalMinFee| Minimum withdrawal fees |
|isWithdrawEnabled| Support withdrawal or not |
|isDepositEnabled| Support deposit or not |

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

## Apply connect token

```json
{
    "code": "200000",
    "data": {
        "instanceServers": [
            {
                "pingInterval": 50000,
                "endpoint": "wss://push1-v2.kucoin.net/endpoint",
                "protocol": "websocket",
                "encrypt": true,
                "pingTimeout": 10000
            }
        ],
        "token": "vYNlCtbz4XNJ1QncwWilJnBtmmfe4geLQDUA62kKJsDChc6I4bRDQc73JfIrlFaVYIAE0Gv2--MROnLAgjVsWkcDq_MuG7qV7EktfCEIphiqnlfpQn4Ybg==.IoORVxR2LmKV7_maOR9xOg=="
    }
}
```

You need to apply for a token to create a websocket connection. You only need to choose one of the below two tokens.

### Public token (No authentication required):

If you only use public channels（e.g. All public market data), please make request as follows to obtain the server list and temporary public token:

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

For request some additional private channels and messages (e.g. Account balance notice), please make request as follows after authorization to obtain the server list and authorized token.

#### HTTP REQUEST

**POST /api/v1/bullet-private**

## Create connection

```javascript
var socket = new WebSocket("wss://push1.kucoin.com/endpoint?token=xxx&[connectId=xxxxx]");
```

When the connection is successfully established, the system will send a welcome message.


```json
{
  "id":"hQvf8jkno",
  "type":"welcome"
}
```

The connectId is connection id, a unique value taken from the client side. Both the id of the welcome message sent by system after the connection succeed as well as the id of the error message are connectId.


## Ping
```json
{
  "id":"1545910590801",
  "type":"ping"
}
```

To prevent the TCP link being disconnected by the server, the client side needs to send ping messages to the server to keep alive the link.

After the ping message is sent to the server, the system would return a pong message to the client side.

```json
{
  "id":"1545910590801",
  "type":"pong"
}
```

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

To subscribe channel messages from certain server, the client side should send subscription message to the server.

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
For some specific topics (e.g. /market/level3), **privateChannel** is available. The default value of **privateChannel** is **false**. If the **privateChannel** is set to **true**, the user will only receive messages related himself on the topic. The format of the **topic** field in the returned data is **{topic}:privateChannel:{userId}**.

#### response
If the response is set as ture, the system would return the ack messages after the unsubscription succeed.

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

### Parameters

#### id
Unique string to mark the request.

#### topic
The topic you want to subscribe to.

#### privateChannel
For some specific **public** topics (e.g. /market/level3), **privateChannel** is available. The default value of **privateChannel** is **false**. If the **privateChannel** is set to **true**, the user will only receive messages related himself on the topic. The format of the **topic** field in the returned data is **{topic}:privateChannel:{userId}**.

#### response
If the response is set as ture, the system would return the ack messages after the unsubscription succeed.


```json
{
  "id": "1545910840805",
  "type": "ack"
}
```

## Sequence Numbers
The sequence field exists in order book, trade history and snapshot messages by default and the level 3 and level 2 data works to ensure the full connection of the sequence. If the sequence is non-sequential, please enable the calibration logic.

## General Logic for Message Judgement in Client Side
1.Judge message type. There are three types of messages at present: message (the commonly used messages for push), notice (the notices general used), and command (consecutive command).

2.Judge messages by userId. Messages with userId are private messages, messages without userId are common messages.

3.Judge messages by topic. You could judge the message type through topic. 

4.Judge messages by subject. For the same type of messages with the same topic, you could judge the type of messages through their subjects. 

# Public Channels

## Ticker 

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
Subscribe this topic to get the realtime push of BBO changes.

The ticker channel provides real-time price updates every time a match happens. It batches updates in case of cascading matches, greatly reducing bandwidth requirements.

Please note that more information will be added to messages from this channel in the near future.

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

Subscribe this topic to get Level2 order book data.

After the conducts, the system would send the increment change data pushed by websocket to you.

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

   2.Initiate REST (GET /market/orderbook/level2?symbol=\<symbol\>) request to get the snapshot data of l2 order book.

   3.Playback the cached l2update data flow and find the sequence of the snapshot (range of location: sequence_start to sequence_end in l2update ). Discard all the l2update prior to sequence_start, then playback the change to snapshot.

   4.Put the new l2update data flow to the local snapshot to ensure that the sequence_start of the new l2update link up with the sequence_end of the previous l2update.

   5.Update the level2 full data based on sequence according to the size. If the price is 0, ignore the messages and update the sequence. If the size=0, update the sequence and remove the price of which the size is 0 out of level 2.  For other cases, please update price.



Subsequent updates will have the type l2update. The changes property of l2updates is an array with [price, size，sequence] tuples. Please note that size is the updated size at that price level, not a delta. A size of "0" indicates the price level can be removed.

**Example**

Take BTC/USDT as an example, suppose the current order book data in level 2 is as follows:

After subscribing the channel, you would receive changes as follows:

"asks":[

  ["3988.62","8", 15],

  ["3988.61","0", 18],

  ["3988.59","3", 16],

]

"bids":[

  ["3988.50", "44", "17"]

]

<aside class="notice">Description: the message format is [Price, Size, Sequence].</aside>

Get the snapshot of the order book through **REST** request ([Get Order Book](#get-part-order-book-aggregated)) to build a local order book. Suppose we get the data as follows:

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

The current data on local order book is as follows:

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

In the beginning, the sequence of your local order book is **16**. Discard the feed data of sequence below or equal to **16**, apply playback the sequence **[17,18]** to update the snapshot of the local order book. Now the sequence of your local order book is **18** and your local order book is up-to-date.

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

Subscribe this topic to obtain the matching event data flow of Level 3.

For each order traded, the system would send you the match messages in the format as follows.

```json
{
  "id":"5c24c5da03aa673885cd67aa",
  "type":"message",
  "topic":"/market/match:BTC-USDT",
  "subject":"trade.l3match",
  "sn":1545896669145,
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

## Full MatchEngine Data(Level 3)

Topic: **/market/level3:{symbol},{symbol}...**

For this topic, **privateChannel** is available.

```json
{
    "id": 1545910660742,                          
    "type": "subscribe",
    "topic": "/market/level3:BTC-USDT",
    "privateChannel": false,                      
    "response": true                              
}
```

Subsribe this topic to fully get the updata data for orders and trades.

The full channel provides real-time updates on orders and trades. These updates can be applied on to a level 3 order book snapshot to maintain an accurate and up-to-date copy of the exchange order book.

<aside class="notice">Note: If you are maintaining a level 2 order book, please consider switching to the level 2 channel.</aside>

An algorithm to maintain an up-to-date level 3 order book is described below. Please note that you will rarely need to implement this yourself.

1. Send a subscribe message for the product(s) of interest and the full channel.
2. Queue any messages received over the websocket stream.
3. Make a REST request for the order book snapshot from the REST feed.
4. Playback queued messages, discarding sequence numbers before or equal to the snapshot sequence number.
5. Apply playback messages to the snapshot as needed (see below).
6. After playback is complete, apply real-time stream messages as they arrive.

<aside class="notice">All open and match messages will always result in a change to the order book. Not all done or change messages will result in changing the order book. These messages will be sent for received orders which are not yet on the order book. Do not alter the order book for such messages, otherwise your order book will be incorrect.</aside>

The following messages are sent over the websocket stream in JSON format when subscribing to the full channel:


###RECEIVED###
When matching engine receives an order command, the system would send a received message to user.

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3received",
  "data":{
    "sequence":"1545896669147",
    "symbol":"BTC-USDT",
    "side":"sell",
    "size":"1",
    "orderId":"5c24c72503aa6772d55b378d",
    "price":"4.00000000000000000000",
    "time":"1545914149935808589",
    "type":"received",
    "orderType":"limit"
  }
}
```

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3received",
  "data":{
    "sequence":"1545896669100",
    "symbol":"BTC-USDT",
    "side":"sell",
    "size":"1",
    "orderId":"5c24c72503aa6772d55b178d",
    "time":"1545914149835808589",
    "type":"received",
    "orderType":"market",
    "funds":"100"
  }
}
```

###OPEN###
When the remaining part in a limit order enters the order book, the system would send an open message to user.

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3open",
  "data":{
    "sequence":"1545896669148",
    "symbol":"BTC-USDT",
    "side":"sell",
    "size":"1",
    "orderId":"5c24c72503aa6772d55b378d",
    "price":"6.00000000000000000000",
    "time":"1545914149935808632",
    "type":"open",
    "remainSize":"1"
  }
}
```

###DONE###
When the matching life cycle of an order ended, the order would no longer be displayed on the order book and the system will send a done message to user.

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
    "reason":"canceled",
    "side":"buy",
    "orderId":"5c24c96103aa6772d55b381b",
    "time":"1545914730696797106",
    "type":"done",
    "size": "1.12340000000000000000"
  }
}
```
When the matching life cycle of an order ended, the order would no longer be displayed on the order book and the system will send a done message to user.

###MATCH###

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3match",
  "data":{
    "sequence":"1545896669291",
    "symbol":"BTC-USDT",
    "side":"buy",
    "size":"0.07600000000000000000",
    "price":"0.08300000000000000000",
    "takerOrderId":"5c24ca2e03aa6772d55b38bf",
    "time":"1545914933083576866",
    "type":"match",
    "makerOrderId":"5c20492a03aa677bd099ce9d",
    "tradeId":"5c24ca3503aa673885cd67ef"
  }
}
```
When two orders become matched, the system would send a match message to user. The Side always indicates the taker, namely the direction of the match triggered.

###CHANGE###

```json
{
  "type":"message",
  "topic":"/market/level3:BTC-USDT",
  "subject":"trade.l3change",
  "data":{
    "sequence":"1545896669656",
    "symbol":"BTC-USDT",
    "side":"buy",
    "orderId":"5c24caff03aa671aef3ca170",
    "price":"1.00000000000000000000",
    "newSize":"0.15722222000000000000",
    "time":"1545915145402532254",
    "type":"change",
    "oldSize":"0.18622222000000000000"
  }
}
```

When an order is changed due to STP, the system would send a change message to user.

# Private Channels

##Order activate event###

```json
{
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

When a stop-limit order is triggered, you would receive an activate message which means that this order started the matching life cycle.

## Account balance notice
```json
{
	"available": "88",
	"availableChange": "88",
	"currency": "KCS",
	"hold": "0",
	"holdChange": "0",
	"relationEvent": "wallet.deposit",
	"relationEventId": "test_123456818",
	"time": "2018-12-25T15:05:33.549 +0800",
	"total": "88"
}
```
You will receive this message when an account balance changes. The message contains the details of the change.
