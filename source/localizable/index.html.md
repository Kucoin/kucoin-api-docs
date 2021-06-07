---
title: title

language_tabs: # must be one of https://git.io/vQNgJ


toc_footers:
  - <a href='https://www.kucoin.com'>Sign Up for KuCoin</a>

includes:

search: true
---

# General

## Introduction

Welcome to KuCoin’s trader and developer documentation. These documents outline the exchange functionality, market details, and APIs.

The whole documentation is divided into two parts: REST API and Websocket feed.

The REST API contains four sections: User(private) , Trade(private), Market Data(public), Margin Trade and Others(public).

The WebSocket contains two sections: Public Channels and Private Channels

## Upcoming Changes

To get the latest updates in API, you can click ‘Watch’ on our [KuCoin Docs Github](https://github.com/Kucoin/kucoin-api-docs).

**To reinforce the security of the API, KuCoin upgraded the API key to version 2.0, the validation logic has also been changed. It is recommended to [create](https://www.kucoin.com/account/api) and update your API key to version 2.0. The API key of version 1.0 will be still valid until May 1, 2021. [Check new signing method](#signing-a-message)**

**06/04/21**:

- Modify the query of the lifetime for the order by clientOid [Get Single Order by clientOid](#get-single-active-order-by-clientoid)
- Modify the timestamp to millisecond [Get an order](#get-an-order)

**04/26/21**:

- Add [Get Full Order Book(aggregated)](#get-full-order-book-aggregated),[Get Full Order Book(atomic)](#get-full-order-book-atomic) endpoints(V3 version), these endpoints requires the "General" permission
- Deprecate [Get Full Order Book(aggregated)](#get-full-order-book-aggregated-deprecated),[Get Full Order Book(atomic)](#get-full-order-book-atomic-deprecated) endpoints(V2 version)
- Add [Get Deposit Addresses(V2)](#get-deposit-addresses-v2)

**02/24/21**  

- Add [Place a margin order](#place-a-margin-order) 

**11/05/20**:

- Add [Trade Fee](#trade-fee) module，[Basic user fee](#basic-user-fee),[Actual fee rate of the trading pair](#actual-fee-rate-of-the-trading-pair)
- Add [Get Account Ledgers](#get-account-ledgers)，and deprecate [Get Account Ledgers(deprecated)](#get-account-ledgers-deprecated)

**10/28/20**:

- Add the Basic Taker Fee,Basic Maker Fee,Taker Fee Coefficient,Maker Fee Coefficient for [Get 24hr Stats](#get-24hr-stats),[Get All Tickers](#get-all-tickers).
- Add [Transfer between Master user and Sub-user](#transfer-between-master-user-and-sub-user) Added types of account that support transfer.
- Add [Inner Transfer](#inner-transfer) Added types of account that support transfer.
- Deprecate '/api/v1/accounts/sub-transfer' endpoint for [Transfer between Master user and Sub-user](#transfer-between-master-user-and-sub-user).
- Add REST API [Stop Order](#stop-order)
- Add websocket [Stop Order Event](#stop-order-event)，and deprecate [Stop Order Received Event](#stop-order-received-event), [Stop Order Activate Event](#stop-order-activate-event)


**08/12/20**:

- Add [Cancel Single Order by clientOid](#cancel-single-order-by-clientoid)；
- Add [Get Single Active Order by clientOid](#get-single-active-order-by-clientoid)；


**07/13/20**:

- Add [Private Order Change Events](#private-order-change-events)，[Full MatchEngine Data (revision) (Level 3)](#full-matchengine-data-revision-level-nbsp-3)，[Level2 - 5 best ask/bid orders](#level2-5-best-askbid-orders)，[Level2 - 50 best ask/bid orders](#level2-50-best-askbid-orders)；
- Add [Get Full Order Book(atomic)(revision)](#get-full-order-book-atomic-revision)；

**06/12/20**:

- Add channelType field: public(public channel, default), private(private channel), session(session channel) for Websocket.
- Deprecate ({topic}:privateChannel:{userId}) and userId in private messages after three months.

**05/28/20**:

- Add unique key for [Get Account Ledgers](#get-account-ledgers)

**04/22/20**:

- Deprecate [Get Holds](#get-holds) on 10th May 2020.
- Add the **relationContext** field for [Account Balance Notice](#account-balance-notice).
- Modify the default chain of USDT into ERC20.

**04/09/20**:

- Add the **pool** type for [List Accounts](#list-accounts).
- Add the **pool** type for [Inner Transfer](#inner-transfer).
- Add the **POOL** type for [Get the Transferable](#get-the-transferable).
- Deprecate the **balance** field for [Get Account Ledgers](#get-account-ledgers) and set **balance** 0 by default.

**03/27/20**:

- Add the request parameters: **bizType** and **direction** for [Get Account Ledgers](#get-account-ledgers)

**03/11/20**:

- Add [Service Status](#service-status).

**02/03/20**:

- Add [Place bulk orders](#place-bulk-orders).

**01/03/20**:

- Add the description of **postOnly** for [Place a new order](#place-a-new-order).


**27/02/20**:

- Add the **price protection mechanism** for [Place a new order](#place-a-new-order).


**02/01/20**:

- Add the **time** field to [Get Full Order Book(atomic)](#get-full-order-book(atomic)).
- Add **reason** field in the subscription for [Stop Order Activate Event](#stop-order-activate-event).

**10/20/19**:

- Deprecate '/api/v1/accounts/inner-transfer' endpoint for [Inner Transfer](#inner-transfer).
- Add the **margin** type for [List Accounts](#list-accounts).
- Support the margin account for [Get an Account](#get-an-account).
- Add the **margin** type for [Create an Account](#create-an-account).
- Add the extra bizType for margin via [Get Account Ledgers](#get-account-ledgers).
- Add the extra bizType for margin via [Get Holds](#get-holds)
- Add the margin account via [Get Account Balance of a Sub-Account](#get-account-balance-of-a-sub-account)
- Support the margin account for [Get the Aggregated Balance of all Sub-Accounts](#get-the-aggregated-balance-of-all-sub-accounts)
- Add the **MARGIN** type for [Transfer between Master user and Sub-user](#transfer-between-master-user-and-sub-user)
- Add the **margin** type for [Inner Transfer](#inner-transfer)
- Add [Get the Transferable](#get-the-transferable).
- Add [Place a new order](#place-a-new-order) **tradeType** field.
- Add [Cancel all orders](#cancel-all-orders) **tradeType** field.
- Add **tradeType** field for [List Orders](#list-orders), [Recent Orders](#recent-orders), [Get an order](#get-an-order).
- Add **tradeType** field for [List Fills](#list-fills), [Recent Fills](#recent-fills).
- Add [Get Symbols List](#get-symbols-list)**isMarginEnabled** field.
- Add [Get Currencies](#get-currencies) and [Get Currency Detail](#get-currency-detail) **isMarginEnabled**, **isDebitEnabled** field.
- Add [Margin Trade](#margin-trade) module.

**10/17/19**:

- Add the **remark** field to [Get Deposit List](#get-deposit-list) and [Get Withdrawals List](#get-withdrawals-list)

**10/12/19**:

- Merge [Get Market List](get-market-list) ETH、NEO、TRX three markets into ALTS.

**9/27/19**

- Add **symbolName** response to [Get All Tickers](#get-all-tickers).

**6/19/19**:

- Modify [Transfer between Master user and Sub-user](#transfer-between-master-user-and-sub-user)

**6/13/19**:

- Add [FAQ](#faq) for Open API.
- Add the advantage descriptions for [Level-3](#matchengine-data).

**5/28/19**:

- Modify [Get Market List](#Get-Market-List) SC changed to USDS.
- Add one new endpoint for [Inner Transfer](#inner-transfer), the original interface will expire after three months (8/28/19).
- Add the usage description to the favorite withdrawal address [Apply Withdraw](#apply-withdraw).
- Add **averagePrice** field to [Get 24hr Stats](#get-24hr-stats).


**5/8/19** :

- Add **chain** field to [Create Deposit Address](#create-deposit-address), [Get Deposit Address](#get-deposit-address), [Get Currency Detail](#get-currency-detail), [Get Withdrawal Quotas](#get-withdrawal-quotas) and [Apply Withdraw](#apply-withdraw).
-  Add the description of how to transfer assets in the [Inner Transfer](#inner-transfer) interface.
- Add **L3 SDK** to [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)).
- modify the strategy of [Rate Limit](#request-rate-limit).

**4/24/19**:

- Delete the "size" and "funds" fields of the “received” message in the subscription for [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)) via the public channels, therefore protecting the hidden orders. These fields in the private channels remain unchangeds.
- Delete the “remainSize” field of the “open” messages in the subscription for [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3)) via the public channels, therefore protecting the hidden orders. These fileds in the private channels remain unchanged.
- Add [Get User Info of all Sub-Accounts](#get-user-info-of-all-sub-accounts).
- Add [Get Account Balance of a Sub-Account](#get-account-balance-of-a-sub-account).
- Add [Get the Aggregated Balance of all Sub-Accounts of the Current User](#get-the-aggregated-balance-of-all-sub-accounts-of-the-current-user).
- Add [Transfer between Master account and Sub-Account](#transfer-between-master-account-and-sub-account).

**3/27/19** :

- Add **feeCurrency** field to [Get Symbols List](#get-symbols-list).

**3/25/19** :

- Add **volValue** field to [Get All Tickers](#get-all-tickers).
- Add **clientOid** field to [Full MatchEngine Data(Level 3)](#full-matchengine-data(level-3))which allows you to filter your order info by clientOid when you subscribe to the "received " messages through private channels.
- Add **accountId** field in the subscription for [Account balance notice](#account-balance-notice).

**3/13/19** :

- Modify the maximum matching orders for a single trading pair in one account is 200 (stop orders included).

**3/6/19** :

- Add **nanoseconds** as the time unit of the order system and matching engine.

**2/28/19** :

- Modify [Get Symbols List](#get-symbols-list) response description
- Add [Get V1 Historical Deposits List](#get-v1-historical-deposits-list)
- Add [Get V1 Historical Withdrawals List](#get-v1-historical-withdrawals-list)
- Add [Get V1 Historical Orders List](#get-v1-historical-orders-list)
- Add explanation to part of the API JSON field
- Delete "sn" field in [Match Execution Data](#match-execution-data)
- Modify [Get Fiat Price](#get-fiat-price) parameter description

**2/22/19** :

- Add **volValue** field to [Get 24hr Stats](#get-24hr-stats)

**2/21/19** :

- Add [Get Full Order Book(aggregated) v2](#get-full-order-book-aggregated)
- Add **time** field to Level-1,2,3 Data
- Add [Get Fiat Price](#get-fiat-price)

**2/20/19** :

- Add **time** field to [Get All Tickers](#get-all-tickers) and [Get Ticker](#get-ticker)

**2/19/19** :

- Add [Get All Tickers](#get-all-tickers)

**2/18/19** :

- Add [Recent Orders](#recent-orders)
- Add [Recent Fills](#recent-fills)

**2/16/19** :

- Add [All Symbols Ticker](#all-symbols-ticker)
- Modify [Permissions](#permissions)

**1/30/19** :

- Add SDK official provider [CCXT](#client-libraries)

**1/25/19** :

- Add [Get Market List](#get-market-list)
- Add [Symbol Snapshot Feed](#symbol-snapshot)
- Add [Market Snapshot Feed](#market-snapshot)
- Add official [Java & Go SDK](#client-libraries)

## Reading Guide

1. Read [Sandbox](#sandbox) to learn how to debug API in a test environment.
2. Read [REST API](#rest-api) to learn how to build a request.
3. Read [Time](#server-time) if you want to make a test request (and receive a sample response) without having to authorize.
4. Read [Service Status](#service-status) to maintain your trading strategy based on service status
5. Read [Authentication](#authentication) to learn how to make an authorized request.
6. Read [Inner Transfer](#inner-transfer) to see how to transfer assets.
7. Read [List Accounts](#list-accounts) to learn how to get the data of your account balance.
8. Read [Place a new order](/#place-a-new-order) to see how to place an order.
9. Read [Order Book](#get-part-order-book-aggregated) to get a snapshot of the order book.
10. Read [Websocket Feed](#websocket-feed) to learn how to establish a websocket connection.
11. Read [Level-2 Market Data](#level-2-market-data) to see how to build a local real-time order book with websocket.
12. Read [Account balance notice](#account-balance-notice) to see how to get a private websocket feed and get real time notice of balance changes.

## Sub-account

You can create a sub-account and its API key on the web end.

A sub-account can be used to separate the funds for crypto tradings and the funds can be transferred between the master account and the sub-account. Please note that the funds in sub-account is limited for sub-account crypto trading only and the funds cannot be withdrawn directly from the sub-account.

The API of a sub-account is available to access all the public endpoints. Besides this, traders can access the following private endpoints via the API key of a sub-account:


Endpoints | Description
---------- | -------
[List Accounts](#place-a-new-order) | Get the status of an account.
[Get an Account](#get-an-account) | Get the info of an account.
[Create an Account](#create-an-account) | Create an Account.
[Get Account Ledgers](#get-account-ledgers) | Get the funds details of an account.
[Get Holds](#get-holds) | Get the hold details of an account.
[Inner Transfer](#inner-transfer) | Transferring assets between the accounts of main and trade.
[Place a new order](#place-a-new-order) | Place an order.
[Cancel an order](#cancel-an-order) | Request to cancel an order.
[Cancel all orders](#cancel-all-orders) | Request to cancel all orders.
[List Orders](#list-orders) | Get orders details.
[Recent Orders](#recent-orders) | Get order details of the last 24 hours(up to 1000).
[Get an order](#get-an-order) | Get the details of a single order.
[List Fills](#list-fills) | Get the order execution details.
[Recent Fills](#recent-fills) | Get order execution details of the last 24 hours(up to 1000).
[Cancel Single Order by clientOid](#cancel-single-order-by-clientoid) | Cancel Single Order by clientOid.
[Get Single Active Order by clientOid](#get-single-active-order-by-clientoid) | Get Single Active Order by clientOid.

 A sub-account shares the same fee level as its master-account. (The fee level will be calculated based on the total transaction amount of the sub-account and the master account or the holding amount of KCS.)

The sub-account needs to transfer funds from the main account to the trade account before trading.

<aside class="notice">The withdrawal and deposit is not supported for sub-account.</aside>


## Matching Engine

### Order Lifecycle

Valid orders sent to the matching engine are confirmed immediately and are in the **received** state. If an order executes against another order immediately, the order is considered **done**. An order can execute in part or whole. Any part of the order not filled immediately, will be considered **open**. Orders will stay in the open state until canceled or subsequently filled by new orders. Orders that are no longer eligible for matching (filled or canceled) are in the **done** state.

### Self-Trade Prevention

**Self-Trade Prevention** is an option in advanced settings.It is not selected by default. If you specify STP when placing orders, your order won't be matched by another one which is also yours. On the contrary, if STP is not specified in advanced, your order can be matched by another one of your own orders. It should be noted that only the taker's protection strategy is effective.


#### DECREMENT AND CANCEL(DC)

**Market orders are currently not supported for DC**. When two orders from the same user cross, the smaller order will be canceled and the larger order will be decremented by the size of the smaller order. If the two orders are the same size, both will be canceled.

#### CANCEL OLDEST(CO)

Cancel the older (resting) order in full. The new order continues to execute.

#### CANCEL NEWEST(CN)

Cancel the newer (taking) order in full. The old resting order remains on the order book.

#### CANCEL BOTH(CB)

Immediately cancel both orders.

### MatchEngine Data

#### Level-3 Market Data（Recommend）

The data pushed by the matching engine is the information of each order, which is the market data of Level-3.<br/>
The Level-3 market data is more suitable for high-frequency traders.<br/>

You can subscribe [Level-3 Market Data] (#full-matchengine-data-level-3) via WebSocket:

* Get real-time market information in the market faster (push speed: Level-3 >= Level-2)
* Can be used to build and maintain order book
* Can get the reason for the quantity change of a single order
* Get real-time access to orders
* Can completely replace most of the pull API function of the Rest API (There is a strict rate limit on Rest request)


For the processing of different types of information, please refer to [Level-3 SDK] (#client-libraries) or [Message Type] (#full-matchengine-data-level-3) of Level-3 below.



## Client Libraries

Client libraries can help you integrate with our API quickly.

**Official SDK of KuCoin**

- [Java SDK](https://github.com/Kucoin/KuCoin-Java-SDK)
- [PHP SDK](https://github.com/Kucoin/KuCoin-PHP-SDK)
- [Go SDK](https://github.com/Kucoin/KuCoin-Go-SDK)
- [Level3-SDK](https://github.com/Kucoin/kucoin-level3-sdk)
- [Python SDK](https://github.com/Kucoin/kucoin-python-sdk)
- [Nodejs SDK](https://github.com/Kucoin/kucoin-node-sdk)


CCXT is our authorized SDK provider and you may access the KuCoin API through CCXT. For more information, please visit: [https://ccxt.trade](https://ccxt.trade).


**Examples**

- PHP File Example (GET & POST & DELETE)  [Github Link](https://github.com/Kucoin/kucoin-api-docs/tree/master/examples/php)

- - -

## Sandbox


**Sandbox is the test environment**, used for testing an API connection or web trading. It provides all the functionalities of the live exchange. All funds and transactions there are simulated for testing purposes.

The login session and the API key in the sandbox environment are completely separated from the production environment. You may use the web interface in the sandbox environment to create an API key.

Notice: After registering in the sandbox environment, you will receive a nummber amount of fake funds (BTC, ETH or KCS) automatically released by the system in your account. If you want to **trade**, please transfer assets from the  **main**  account to the  **trade** account. The funds are only for test purposes and cannot be withdrawn.


Sandbox URLs for API test:

Website:
**[https://sandbox.kucoin.com](https://sandbox.kucoin.com)**

REST API:
**https://openapi-sandbox.kucoin.com**


## Request Rate Limit

When a rate limit is exceeded, a status of **403 Forbidden** or **429 Too Many Request** will be returned.
If the rate limit is exceeded multiple times, the system will restrict your use of your IP and account for at least 1 minute. Your remaining request times will be returned in the results.

###REST API

The access limit for REST API is applied per API key. For average users, the request limit for each API key is **1800 requests per minute**. The limit strategy is applicable for both public and private endpoints

####Hard-Limits

[List Fills](#list-fills): 100 requests per 10 seconds(will be restricted for 10 seconds if the limit is exceeded)

[List orders](#list-orders): 200 requests per 10 seconds(will be restricted for 10 seconds if the limit is exceeded)

[Place bulk orders](#place-bulk-orders): 10 requests per 10 seconds(will be restricted for 10 seconds if the limit is exceeded)

###WEBSOCKET


### Number of Connections
Number of connections per user ID:   ≤ 50

### Connection Times
Connection Limit: 30 per minute


### Number of Uplink Messages
Message limit sent to the server: 100 per 10 seconds


### Topic Subscription Limit
Maximum number of batch subscriptions at a time: 100 topics

Subscription limit for each connection: 300 topics



### Apply for Higher Request Rate Limit
If you are a professional trader or market maker and need a higher limit, please send your KuCoin account, reason and approximate trading volume to [api@kucoin.com](mailto:api@kucoin.com).


## Market Making Incentive Scheme

KuCoin offers a Market Making Incentive Scheme for professional liquidity providers. Key benefits of this program include:

- Market Maker rebate.
- Monthly rewards up to 30,000 KCS for the market maker with the best performance.
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


## FAQ

### Invalid Signature


* Check if your API-KEY, API-SECRET and API-PASSPHRASE are correct
* Check if the string sequence is correct: timestamp + method + requestEndpoint + body
* Check whether the timestamp in header is the same with the content above
* Check whether you are using the correct encoding in your signature, e.g. base64
* Check whether the **GET** request is submitted as a form
* Check whether the content-type of your POST request is in application/json form and is encoded by charset=utf-8

### Apply Withdraw
* memo


For currencies without memo, the memo field is not required. Please do not pass the parameter when you are applying to withdraw via API, or the system will return: **kucoin incorrect withdrawal address**.<br/>

* amount


The precision of the **amount** field shall satisfy the withdrawal precision requirements of the currency. The precision requirements for the currencies can be obtained by [Withdrawals Quotas](#get-withdrawal-quotas).
The withdrawal amount must be an integer multiple of the withdrawal accuracy. If the withdrawal accuracy is 0, the withdrawal amount it can only be an integer.


### .net SDK
* Invalid Signature on POST Request

{"code":"400005", "msg":"Invalid KC-API-SIGN"}<br/>
There is a bug in the code:<br/>
 var response = body == null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);<br/>
After fixing:<br/>
 var response = body != null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);

### WebSocket
* Subscription limit for each connection: 300 topics;
* Validity period for token: 24 hours;
* Number of connections per user: ≤ 50
* Number of Messages of the client side: 100 per 10 seconds;
* Subscribing one symbol means subscribing a topic; (e.g.Topic: /market/level3:{symbol},{symbol}...)

### 403  Error

If an error occurs as follows:
403 "The request could not be satisfied. Bad Request" from Amazon CloudFront<br/>

* Check whether the request is HTTPS
* Remove the RequestBody from the GET request





# REST API

## Base URL

The REST API has endpoints for account and order management as well as public market data.

The base url is **https://api.kucoin.com**.  

The request URL needs to be determined by BASE and specific endpoint combination.

## Endpoint of the Interface


Each interface has its own endpoint, described by field **HTTP REQUEST** in the docs.

For the **GET METHOD** API, the endpoint needs to contain the query parameters string.

E.G. For "List Accounts", the default endpoint of this API is **/api/v1/accounts**. If you pass the "currency" parameter(BTC), the endpoint will become **/api/v1/accounts?currency=BTC** and the final request URL will be **https://api.kucoin.com/api/v1/accounts?currency=BTC**.


## Request
All requests and responses are **application/json** content type.  

Unless otherwise stated, all timestamp parameters should in milliseconds. e.g. **1544657947759**

### Parameters

For the **GET, DELETE** request, all query parameters need to be included in the request url. (**e.g. /api/v1/accounts?currency=BTC**)

For the **POST, PUT** request, all query parameters need to be included in the request body with JSON. (**e.g. {"currency":"BTC"}**). **Do not include extra spaces in JSON strings.**

### Errors

When errors occur, the HTTP error code or system error code will be returned. The body will also contain a message parameter indicating the cause.

#### HTTP error status codes

```
{
  "code": "400100",
  "msg": "Invalid Parameter."
}

```

Code | Meaning
---------- | -------
400 | Bad Request -- Invalid request format.
401 | Unauthorized -- Invalid API Key.
403 | Forbidden or Too Many Requests -- The request is forbidden or Access limit breached.
404 | Not Found -- The specified resource could not be found.
405 | Method Not Allowed -- You tried to access the resource with an invalid method.
415 | Unsupported Media Type. You need to use: application/json.
500 | Internal Server Error -- We had a problem with our server. Try again later.
503 | Service Unavailable -- We're temporarily offline for maintenance. Please try again later.


#### System error codes

| Code | Meaning |
| ---------- | ------- |
| 200001 | Order creation for this pair suspended       |
| 200002 | Order cancel for this pair suspended     |
| 200003 | Number of orders breached the limit      |
| 200009 | Please complete the KYC verification before you trade XX |
| 200004 | Balance insufficient                           |
| 400001 | Any of KC-API-KEY, KC-API-SIGN, KC-API-TIMESTAMP, KC-API-PASSPHRASE is missing in your request header |
| 400002 | KC-API-TIMESTAMP Invalid      |
| 400003 | KC-API-KEY not exists                      |
| 400004 | KC-API-PASSPHRASE error             |
| 400005 | Signature error     |
| 400006 | The requested ip address is not in the api whitelist |
| 400007 | Access Denied        |
| 404000 | Url Not Found                              |
| 400100 | Parameter Error                            |
| 400200 | Forbidden to place an order              |
| 400500 | Your located country/region is currently not supported for the trading of this token |
| 400700 | Transaction restricted, there's a risk problem in your account |
| 400800 | Leverage order failed                          |
| 411100 | User are frozen |
| 500000 | Internal Server Error              |
| 900001 | symbol not exists                              |

If the returned HTTP status code is 200, whereas the operation failed, an error will occur. You can check the above error code for details.

### Success

A successful response is indicated by an HTTP status code 200 and system code 200000. The success response is as follows:


```json
{
  "code": "200000",
  "data": "1544657947759"
}
```



### Pagination

Pagination allows for fetching results with the current page and is well suited for real time data. Endpoints like /api/v1/deposits, /api/v1/orders, /api/v1/fills, will return the latest items by default (50 pages in total). To retrieve more results, users should specify the currentPage number in the subsequent requests to turn the page based on the data previously returned.

#### PARAMETERS

Parameter | Default | Description
---------- | ------- | ------
currentPage | 1 | Current request page.
pageSize | 50 | Number of results per request. Minimum is 10, maximum is 500. 


#### Example
**GET /api/v1/orders?currentPage=1&pageSize=50**


## Types

### Timestamps

Unless otherwise specified, all timestamps from API are returned in **milliseconds**(e.g. **1546658861000**). Most modern languages and libraries will handle this without issues.

But please note that the timestamps between the **matching engine** and the **order** system are in nanoseconds.

### Numbers
Decimal numbers are returned as strings in order to preserve the full precision across platforms. When making a request, it is recommended that you also convert your numbers to strings to avoid truncation and precision errors.

## Authentication

### Generating an API Key

Before being able to sign any requests, you must create an API key via the KuCoin website. Upon creating a key you need to write down 3 pieces of information:


* Key
* Secret
* Passphrase

The Key and Secret are generated and provided by KuCoin and the Passphrase refers to the one you used to create the KuCoin API. Please note that these three pieces of information can not be recovered once lost. If you lost this information, please create a new API KEY.

### API KEY PERMISSIONS

You can manage the API permission on KuCoin’s official website. The permissions are:


* **General** - General - Allows a key general permissions. This includes most of the GET endpoints.
* **Trade** -  Allows a key to create orders.
* **Transfer** -  Allows a key to transfer funds (including deposit and withdrawal). Please note a sub-account is not authorized this permission. Enable with caution - API key transfers WILL BYPASS two-factor authentication.


Please refer to the documentation below to see what API key permissions are required for a specific route.

### Creating a Request

All private REST requests must contain the following headers:

* **KC-API-KEY** The API key as a string.
* **KC-API-SIGN** The base64-encoded signature (see Signing a Message).
* **KC-API-TIMESTAMP** A timestamp for your request.
* **KC-API-PASSPHRASE** The passphrase you specified when creating the API key.
* **KC-API-KEY-VERSION** You can check the version of API key on the page of [API Management](https://www.kucoin.com/account/api)

### Signing a Message

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
    passphrase = base64.b64encode(hmac.new(api_secret.encode('utf-8'), api_passphrase.encode('utf-8'), hashlib.sha256).digest())
    headers = {
        "KC-API-SIGN": signature,
        "KC-API-TIMESTAMP": str(now),
        "KC-API-KEY": api_key,
        "KC-API-PASSPHRASE": passphrase,
        "KC-API-KEY-VERSION": 2
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
    passphrase = base64.b64encode(
        hmac.new(api_secret.encode('utf-8'), api_passphrase.encode('utf-8'), hashlib.sha256).digest())
    headers = {
        "KC-API-SIGN": signature,
        "KC-API-TIMESTAMP": str(now),
        "KC-API-KEY": api_key,
        "KC-API-PASSPHRASE": passphrase,
        "KC-API-KEY-VERSION": 2
        "Content-Type": "application/json" # specifying content type or using json=data in request
    }
    response = requests.request('post', url, headers=headers, data=data_json)
    print(response.status_code)
    print(response.json())
```

For the header of **KC-API-KEY**:

* Use API-Secret to encrypt the prehash string {timestamp+method+endpoint+body} with sha256 HMAC. The request body is a JSON string and need to be the same with the parameters passed by the API.
* After that, use base64-encode to encrypt the result in step 1 again.

For the **KC-API-PASSPHRASE** of the header:

* For API key-V1.0, please pass requests in plaintext.
* For API key-V2.0, please Specify **KC-API-KEY-VERSION** as **2** --> Encrypt passphrase with HMAC-sha256 via API-Secret --> Encode contents by base64 before you pass the request."

Notice:

* The encrypted timestamp shall be consistent with the KC-API-TIMESTAMP field in the request header.
* The body to be encrypted shall be consistent with the content of the Request Body.  
* The Method should be UPPER CASE.
* For GET, DELETE request, the endpoint needs to contain the query string. e.g. /api/v1/deposit-addresses?currency=XBT. The body is "" if there is no request body (typically for GET requests).



```python
#Example for Create Deposit Address

curl -H "Content-Type:application/json" -H "KC-API-KEY:5c2db93503aa674c74a31734" -H "KC-API-TIMESTAMP:1547015186532" -H "KC-API-PASSPHRASE:QWIxMjM0NTY3OCkoKiZeJSQjQA==" -H "KC-API-SIGN:7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4=" -H "KC-API-KEY-VERSION:2"
-X POST -d '{"currency":"BTC"}' http://openapi-v2.kucoin.com/api/v1/deposit-addresses

KC-API-KEY = 5c2db93503aa674c74a31734
KC-API-SECRET = f03a5284-5c39-4aaa-9b20-dea10bdcf8e3
KC-API-PASSPHRASE = QWIxMjM0NTY3OCkoKiZeJSQjQA==
KC-API-KEY-VERSION = 2
TIMESTAMP = 1547015186532
METHOD = POST
ENDPOINT = /api/v1/deposit-addresses
STRING-TO-SIGN = 1547015186532POST/api/v1/deposit-addresses{"currency":"BTC"}
KC-API-SIGN = 7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4=
```

<aside class="spacer16"></aside>
<aside class="spacer8"></aside>

### Selecting a Timestamp

The **KC-API-TIMESTAMP** header MUST be number of **milliseconds** since Unix Epoch in UTC. e.g. 1547015186532

Decimal values are allowed, e.g. 1547015186532. But you need to be aware that timestamp between match and order is **nanosecond**.

The difference between your timestamp and the API service time must be less than **5 seconds** , or your request will be considered expired and rejected. We recommend using the time endpoint to query for the API [server time](#server-time) if you believe there may be time skew between your server and the API server.




# User
Signature is required for this part.


# User Info

##Get User Info of all Sub-Accounts

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

### HTTP REQUEST

**Get /api/v1/sub/user**


### Example
GET /api/v1/sub/user

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### RESPONSES

Field | Description
--------- | -------
userId | The user ID of your sub-account
subName | The username of your sub-account
remarks | Remark



# Account

## Create an Account
```json
{
    "id": "5bd6e9286d99522a52e458de"  //accountId
}
```

### HTTP REQUEST
**POST /api/v1/accounts**

### Example
POST /api/v1/accounts


### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
type | String | Account type: **main**, **trade**, **margin**
currency | String | [Currency](#get-currencies)

### RESPONSES
Field | Description
--------- | -------
id | accountId, ID of an account


## List Accounts

```json
[
  {
    "id": "5bd6e9286d99522a52e458de",  //accountId
    "currency": "BTC",  //Currency
    "type": "main",     //Account type, including main and trade
    "balance": "237582.04299",  //Total assets of a currency
    "available": "237582.032",  //Available assets of a currency
    "holds": "0.01099" //Hold assets of a currency
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

Please deposit funds to the main account firstly, then transfer the funds to the trade account via [Inner Transfer](#inner-transfer) before transaction.

### HTTP REQUEST
**GET /api/v1/accounts**

### Example
GET /api/v1/accounts

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
currency | String | *[Optional]* [Currency](#get-currencies)
type | String | *[Optional]* Account type: **main**, **trade**, **margin** or **pool**

### RESPONSES
Field | Description
--------- | -------
id | The ID of the account
currency | Currency
type | Account type: **main**, **trade**, **margin** or **pool**  
balance | Total funds in the account
available | Funds available to withdraw or trade
holds | Funds on hold (not available for use)

### ACCOUNT TYPE
There are three types of accounts: 1) **main** account 2) **trade** account 3) **margin** account.

No fees will be charged for the funds transfer between these account.

The main account is used for the storage, withdrawal, and deposit of the funds. The assets in the main account cannot be directly used for trading. To trade cryptos, you need to transfer funds from the main account to the trade account.

The trading account is used for transaction. When you place an order, the system will use the balance of the  trade account. You can’t withdraw funds directly from a trade account. To withdraw the funds, you need to transfer the funds from the trade account to the main account firstly.

The margin account is used to borrow assets and leverage transactions.

### FUNDS ON HOLD
When placing an order, the funds for the order will be freezed. The freezed funds cannot be used for other order placement or withdrawal and will remain on hold until the order is filled or cancelled.



## Get an Account
```json
{
    "currency": "KCS",  //Currency
    "balance": "1000000060.6299",  //Total assets of a currency
    "available": "1000000060.6299",  //Available assets of a currency
    "holds": "0" //Hold assets of a currency
}
```
Information for a single account. Use this endpoint when you know the accountId.

### HTTP REQUEST
**GET /api/v1/accounts/{accountId}**

### Example
GET /api/v1/accounts/5bd6e9286d99522a52e458de

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.


### Parameters

Param | Type | Description
--------- | ------- | ---------
accountId | String | **Path parameter.** ID of the account

### RESPONSES
Field | Description
--------- | -------
currency | The currency of the account
balance | Total funds in the account
holds | Funds on hold (not available for use)
available | Funds available to withdraw or trade



## Get Account Ledgers(deprecated)

***It's deprecated, please use [Get Account Ledgers](#get-account-ledgers) instead.***


Request via this endpoint to get the account ledgers.

Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.


```json
{
    "currentPage": 1,
    "pageSize": 10,
    "totalNum": 3,
    "totalPage": 1,
    "items": [
        {
            "id": "5bc7f080b39c5c03486eef8c",//unique key
            "currency": "KCS",  //Currency
            "amount": "0.0998", //Change amount of the funds
            "fee": "0",  //Deposit or withdrawal fee
            "balance": "0",  //Total assets of a currency
            "bizType": "Withdraw",  //business type
            "direction": "in",     //side, in or out
            "createdAt": 1540296039000,  //Creation time
            "context": {          //Business core parameters

                "orderId": "5bc7f080b39c5c03286eef8a",
                "txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
            }
        },
        {
            "id": "5bc7f080b39c5c03486def8c",//unique key
            "currency": "KCS",
            "amount": "0.0998",
            "fee": "0",
            "balance": "0",
            "bizType": "Deposit",
            "direction": "in",
            "createdAt": 1540296039000,
            "context": {

                "orderId": "5bc7f080b39c5c03286eef8a",
                "txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
            }
        },
        {
            "id": "5bc7f080b39c5c03486def8a",//unique key
            "currency": "KCS",
            "amount": "0.0998",
            "fee": "0",
            "balance": "0",
            "bizType": "trade exchange",
            "direction": "in",
            "createdAt": 1540296039000,
            "context": {

                "tradeId": "5bc7f080b3949c03286eef8a",
                "orderId": "5bc7f080b39c5c03286eef8e",
                "symbol": "BTC-USD"
            }
        }
    ]
}
```

### HTTP REQUEST
**GET /api/v1/accounts/{accountId}/ledgers**

### Example
GET /api/v1/accounts/5bd6e9286d99522a52e458de/ledgers


### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

### Parameters

Param | Type | Description
--------- | ------- | -------
accountId | String | ID of the account
direction | String | *[Optional]*  Side: **in** - Receive, **out** - Send
bizType   | String | *[Optional]*  Business type: **DEPOSIT**, **WITHDRAW**, **TRANSFER**, **SUB_TRANSFER**,**TRADE_EXCHANGE**, **MARGIN_EXCHANGE**, **KUCOIN_BONUS**.
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)

### RESPONSES
Field | Description
--------- | -------
id | unique key
currency | The currency of an account
amount | The total amount of assets (fees included) involved in assets changes such as transaction, withdrawal and bonus distribution.
fee | Fees generated in transaction, withdrawal, etc.
balance | Remaining funds after the transaction.
bizType | Business type leading to the changes in funds, such as exchange, withdrawal, deposit,  KUCOIN_BONUS, REFERRAL_BONUS, Lendings etc.
direction | Side, **out** or **in**
createdAt | Time of the event
context | Business related information such as order ID, serial No., etc.

### context
If the returned value under bizType is **“trade exchange”**, the additional info. (such as order ID and trade ID, trading pair, etc.) of the trade will be returned in field **context**.


## Get Account Ledgers

This interface is for the history of deposit/withdrawal of all accounts, supporting inquiry of various currencies. 

Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

```json
{
    "currentPage": 1,
    "pageSize": 10,
    "totalNum": 3,
    "totalPage": 1,
    "items": [
        {
            "id": "5bc7f080b39c5c03486eef8c",//unique key
            "currency": "KCS",  //Currency
            "amount": "0.0998", //Change amount of the funds
            "fee": "0",  //Deposit or withdrawal fee
            "balance": "0",  //Total assets of a currency
            "bizType": "Withdraw",  //business type
            "direction": "in",     //side, in or out
            "createdAt": 1540296039000,  //Creation time
            "context": {          //Business core parameters

                "orderId": "5bc7f080b39c5c03286eef8a",
                "txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
            }
        },
        {
            "id": "5bc7f080b39c5c03486def8c",//unique key
            "currency": "KCS",
            "amount": "0.0998",
            "fee": "0",
            "balance": "0",
            "bizType": "Deposit",
            "direction": "in",
            "createdAt": 1540296039000,
            "context": {

                "orderId": "5bc7f080b39c5c03286eef8a",
                "txId": "bf848bfb6736780b930e12c68721ea57f8b0484a4af3f30db75c93ecf16905c9"
            }
        },
        {
            "id": "5bc7f080b39c5c03486def8a",//unique key
            "currency": "KCS",
            "amount": "0.0998",
            "fee": "0",
            "balance": "0",
            "bizType": "trade exchange",
            "direction": "in",
            "createdAt": 1540296039000,
            "context": {

                "tradeId": "5bc7f080b3949c03286eef8a",
                "orderId": "5bc7f080b39c5c03286eef8e",
                "symbol": "BTC-USD"
            }
        }
    ]
}
```

### HTTP REQUEST
**GET /api/v1/accounts/ledgers**


### Example
GET /api/v1/accounts/ledgers?currency=BTC&startAt=1601395200000

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>


### Parameters

Param | Type | Description
--------- | ------- | -------
currency | String | *[Optional]* Currency ( you can choose more than one currency). You can specify 10 currencies at most for one time. If not specified, all currencies will be inquired by default.
direction | String | *[Optional]*  Side: **in** - Receive, **out** - Send
bizType   | String | *[Optional]*  Business type: **DEPOSIT**, **WITHDRAW**, **TRANSFER**, **SUB_TRANSFER**,**TRADE_EXCHANGE**, **MARGIN_EXCHANGE**, **KUCOIN_BONUS**.
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)

### RESPONSES
Field | Description
--------- | -------
id | unique key
currency | The currency of an account
amount | The total amount of assets (fees included) involved in assets changes such as transaction, withdrawal and bonus distribution.
fee | Fees generated in transaction, withdrawal, etc.
balance | Remaining funds after the transaction.
bizType | Business type leading to the changes in funds, such as exchange, withdrawal, deposit,  KUCOIN_BONUS, REFERRAL_BONUS, Lendings etc.
direction | Side, **out** or **in**
createdAt | Time of the event
context | Business related information such as order ID, serial No., etc.

### context
If the returned value under bizType is **“trade exchange”**, the additional info. (such as order ID and trade ID, trading pair, etc.) of the trade will be returned in field **context**.

### BizType Description
Field | Description
--------- | -------
Assets Transferred in After Upgrading | Assets Transferred in After V1 to V2 Upgrading
Deposit  | Deposit 
Withdrawal  | Withdrawal
Transfer | Transfer
Trade_Exchange | Trade
Vote for Coin | Vote for Coin
KuCoin Bonus | KuCoin Bonus
Referral Bonus | Referral Bonus
Rewards | Activities Rewards
Distribution  | Distribution, such as get GAS by holding NEO
Airdrop/Fork  | Airdrop/Fork
Other rewards | Other rewards, except Vote, Airdrop, Fork
Fee Rebate | Fee Rebate
Buy Crypto | Use credit card to buy crypto
Sell Crypto | Use credit card to sell crypto
Public Offering Purchase | Public Offering Purchase for Spotlight
Send red envelope | Send red envelope
Open red envelope  | Open red envelope
Staking  | Staking 
LockDrop Vesting | LockDrop Vesting
Staking Profits | Staking Profits
Redemption | Redemption
Refunded Fees | Refunded Fees
KCS Pay Fees | KCS Pay Fees
Margin Trade | Margin Trade
Loans   | Loans
Borrowings  | Borrowings
Debt Repayment   | Debt Repayment
Loans Repaid  | Loans Repaid
Lendings  | Lendings
Pool transactions  | Pool-X transactions
Instant Exchange  | Instant Exchange
Sub-account transfer  | Sub-account transfer
Liquidation Fees   | Liquidation Fees 
Soft Staking Profits  | Soft Staking Profits
Voting Earnings  | Voting Earnings on Pool-X
Redemption of Voting  | Redemption of Voting on Pool-X
Voting  | Voting on Pool-X
Convert to KCS   | Convert to KCS 

## Get Account Balance of a Sub-Account

```json
{
    "subUserId":"5caefba7d9575a0688f83c45",
    "subName":"sdfgsdfgsfd",
    "mainAccounts":[
        {
            "currency":"BTC",
            "balance":"8",
            "available":"8",
            "holds":"0",
            "baseCurrency":"BTC",
            "baseCurrencyPrice":"1",
            "baseAmount":"1.1"
        }
    ],
    "tradeAccounts":[
        {
            "currency":"BTC",
            "balance":"1000",
            "available":"1000",
            "holds":"0",
            "baseCurrency":"BTC",
            "baseCurrencyPrice":"1",
            "baseAmount":"1.1"
        }
    ],
    "marginAccounts":[
        {
            "currency":"BTC",
            "balance":"1.1",
            "available":"1.1",
            "holds":"0",
            "baseCurrency":"BTC",
            "baseCurrencyPrice":"1",
            "baseAmount":"1.1"
        }
    ]
}
```

This endpoint returns the account info of a sub-user specified by the subUserId.

### HTTP REQUEST

**GET /api/v1/sub-accounts/{subUserId}**

### Example
GET /api/v1/sub-accounts/5caefba7d9575a0688f83c45

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
subUserId | String | the [user ID](#get-user-info-of-all-sub-accounts) of a sub-account.

### RESPONSES

Field | Description
--------- | -------
subUserId | The user ID of a sub-user.
subName | The username of a sub-user.
currency | Currency
balance | Total funds in an account.
available | Funds available to withdraw or trade.
holds | Funds on hold (not available for use).
baseCurrency | Calculated on this currency.
baseCurrencyPrice | The base currency price.
baseAmount | The base currency amount.


## Get the Aggregated Balance of all Sub-Accounts


```json
[
    {
        "subUserId":"5caefba7d9575a0688f83c45",
        "subName":"kucoin1",
        "mainAccounts":[
            {
                "currency":"BTC",
                "balance":"6",
                "available":"6",
                "holds":"0",
                "baseCurrency":"BTC",
                "baseCurrencyPrice":"1",
                "baseAmount":"1.1"
            }
        ],
        "tradeAccounts":[
            {
                "currency":"BTC",
                "balance":"1000",
                "available":"1000",
                "holds":"0",
                "baseCurrency":"BTC",
                "baseCurrencyPrice":"1",
                "baseAmount":"1.1"
            }
        ],
        "marginAccounts":[
            {
                "currency":"BTC",
                "balance":"1.1",
                "available":"1.1",
                "holds":"0",
                "baseCurrency":"BTC",
                "baseCurrencyPrice":"1",
                "baseAmount":"1.1"
            }
        ]
    }
]
```

This endpoint returns the account info of all sub-users.

### HTTP REQUEST

**GET /api/v1/sub-accounts**

### Example
GET /api/v1/sub-accounts

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### RESPONSES

Field | Description
--------- | -------
subUserId | The user ID of the sub-user.
subName | The username of the sub-user.
currency | The currency of the account.
balance | Total funds in the account.
available | Funds available to withdraw or trade.
holds | Funds on hold (not available for use).
baseCurrency | Calculated on this currency.
baseCurrencyPrice | The base currency price.
baseAmount | The base currency amount.


## Get the Transferable

```json
 {
    "currency": "KCS",
    "balance": "0",
    "available": "0",
    "holds": "0",
    "transferable": "0"
}
```
This endpoint returns the transferable balance of a specified account.


### HTTP REQUEST
**GET /api/v1/accounts/transferable**

### Example
GET /api/v1/accounts/transferable?currency=BTC&type=MAIN

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
currency | String | [currency](#Get-Currencies)
type | String | The account type: **MAIN**, **TRADE**, **MARGIN** or **POOL**


### RESPONSES

Field | Description
--------- | -------
currency | Currency 
balance | Total funds in an account.
available | Funds available to withdraw or trade.
holds | Funds on hold (not available for use).
transferable | Funds available to transfer.


## Transfer between Master user and Sub-user


```json
{
	"orderId": "5cbd870fd9575a18e4438b9a"
}
```
Funds in the main account, trading account and margin account of a Master Account can be transferred to the main account, trading account, futures account and margin account of its Sub-Account. The futures account of both the Master Account and Sub-Account can only accept funds transferred in from the main account, trading account and margin account and cannot transfer out to these accounts.

### HTTP REQUEST

**POST /api/v2/accounts/sub-transfer**

<aside class="notice">**Recommended for use**</aside>


### Example
POST /api/v2/accounts/sub-transfer


### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
clientOid | String | Unique order id created by users to identify their orders, e.g. UUID.
currency | String | [currency](#Get-Currencies)
amount | String | Transfer amount, the amount is a positive integer multiple of the [currency precision](#get-currencies).
direction | String | OUT — the master user to sub user<br/>IN — the sub user to the master user.
accountType | String | *[Optional]* The account type of the master user: **MAIN**, **TRADE**, **MARGIN** or **CONTRACT**
subAccountType | String | *[Optional]* The account type of the sub user: **MAIN**, **TRADE**, **MARGIN** or **CONTRACT**, default is **MAIN**.
subUserId | String | the [user ID](#get-user-info-of-all-sub-accounts) of a sub-account.


### RESPONSES

Field | Description
--------- | -------
orderId | The order ID of a master-sub assets transfer.


## Inner Transfer

```json
{
    "orderId": "5bd6e9286d99522a52e458de"
}
```

This interface is used to transfer fund among accounts on the platform. Users can transfer among main account, trading account, margin account and Pool-X account for free. Users can also transfer funds from other accounts to futures account, however funds cannot be transferred out from futures account.

### HTTP REQUEST

**POST /api/v2/accounts/inner-transfer**

### Example
POST /api/v2/accounts/inner-transfer

### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -------
clientOid | String | Unique order id created by users to identify their orders, e.g. UUID.
currency | String | [currency](#Get-Currencies)
from | String | Account type of payer: **main**, **trade**, **margin** or **pool**
to | String | Account type of payee: **main**, **trade**, **margin** , **contract** or **pool**
amount | String | Transfer amount, the amount is a positive integer multiple of the [currency precision](#get-currencies).


### RESPONSES
Field | Description
--------- | -------
orderId | The order ID of a funds transfer


# Deposit

## Create Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d",   //tag
	"chain": "OMNI"
}
```
Request via this endpoint to create a deposit address for a currency you intend to deposit.

### HTTP REQUEST
**POST /api/v1/deposit-addresses**

### Example
POST /api/v1/deposit-addresses

### API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | Currency
chain | String | *[Optional]* The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency. 

### RESPONSES
Field | Description
--------- | ------- 
address | Deposit address
memo | Address remark. If there’s no remark, it is empty. When you [withdraw](#apply-withdraw) from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
chain | The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. 

## Get Deposit Addresses(V2)

```json
[
  {
    "address": "bc1qaj6kkv85w5d6lr8p8h7tckyce5hnwmyq8dd84d",
    "memo": "",
    "chain": "BTC-Segwit",
    "contractAddress": ""
  },
  {
    "address": "3HwsFot9TW6jL4K4EUHxDSyL8myttxV7Av",
    "memo": "",
    "chain": "BTC",
    "contractAddress": ""
  },
  {
    "address": "TUDybru26JmozStbg2cJGDbR9EPSbQaAie",
    "memo": "",
    "chain": "TRC20",
    "contractAddress": ""
  }
]
```

Get all deposit addresses for the currency you intend to deposit. If the returned data is empty, you may need to create a deposit address first.

### HTTP REQUEST
**GET /api/v2/deposit-addresses**

### Example
GET /api/v2/deposit-addresses?currency=BTC

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### PARAMETERS
Param | Type | Description
--------- | -------  | -------
currency | String | The currency

### RESPONSES
Field | Description
--------- | ------- 
address | Deposit address
memo | Address remark. If there’s no remark, it is empty. When you [withdraw](#apply-withdraw) from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
chain | The chain name of currency.
contractAddress | The token contract address.

## Get Deposit Address

```json
{
	"address": "0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
	"memo": "5c247c8a03aa677cea2a251d",        //tag
	"chain": "OMNI"
}
```

Get a deposit address for the currency you intend to deposit. If the returned data is null, you may need to create a deposit address first.

### HTTP REQUEST
**GET /api/v1/deposit-addresses**

### Example
GET /api/v1/deposit-addresses

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | Currency
chain | String | *[Optional]* The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. This only apply for multi-chain currency, and there is no need for single chain currency. 

### RESPONSES
Field | Description
--------- | ------- 
address | Deposit address
memo | Address remark. If there’s no remark, it is empty. When you [withdraw](#apply-withdraw) from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
chain | The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. The available value for BTC are Native, Segwit, TRC20, the parameters are bech32, btc, trx, default is Native. 


## Get Deposit List

```json
{
    "currentPage":1,
    "pageSize":5,
    "totalNum":2,
    "totalPage":1,
    "items":[
        {
            "address":"0x5f047b29041bcfdbf0e4478cdfa753a336ba6989",
            "memo":"5c247c8a03aa677cea2a251d",
            "amount":1,
            "fee":0.0001,
            "currency":"KCS",
            "isInner":false,
            "walletTxId":"5bbb57386d99522d9f954c5a@test004",
            "status":"SUCCESS",
            "remark":"test",
            "createdAt":1544178843000,
            "updatedAt":1544178891000
        },
        {
            "address":"0x5f047b29041bcfdbf0e4478cdfa753a336ba6989",
            "memo":"5c247c8a03aa677cea2a251d",
            "amount":1,
            "fee":0.0001,
            "currency":"KCS",
            "isInner":false,
            "walletTxId":"5bbb57386d99522d9f954c5a@test003",
            "status":"SUCCESS",
            "remark":"test",
            "createdAt":1544177654000,
            "updatedAt":1544178733000
        }
    ]
}
```

Request via this endpoint to get deposit list
Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.


### HTTP REQUEST
**GET /api/v1/deposits**

### Example
GET /api/v1/deposits

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | *[Optional]*  Currency
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)
status | String | *[Optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### RESPONSES
Field | Description
--------- | ------- | -----------
address | Deposit address
memo |Address remark. If there’s no remark, it is empty. When you [withdraw](#apply-withdraw) from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
amount | Deposit amount
fee | Fees charged for deposit
currency | Currency
isInner | Internal deposit or not
walletTxId | Wallet Txid
status | Status
remark | remark
createdAt | Creation time of the database record
updatedAt | Update time of the database record



## Get V1 Historical Deposits List

```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":9,
    "totalPage":9,
    "items":[
        {
            "currency":"BTC",
            "createAt":1528536998,
            "amount":"0.03266638",
            "walletTxId":"55c643bc2c68d6f17266383ac1be9e454038864b929ae7cee0bc408cc5c869e8@12ffGWmMMD1zA1WbFm7Ho3JZ1w6NYXjpFk@234",
            "isInner":false,
            "status":"SUCCESS"
        }
    ]
}
```

Request via this endpoint to get the V1 historical deposits list on KuCoin.
<aside class="notice">The data of the latest one month will be queried by default.</aside>

### HTTP REQUEST
**GET /api/v1/hist-deposits**

### Example
GET /api/v1/hist-deposits

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | *[Optional]*  [Currency](#get-currencies).
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)
status | String | *[Optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### RESPONSES
Field | Description
--------- | ------- | -----------
amount | Deposit amount
currency | Currency
isInner | Internal deposit or not
walletTxId | Wallet Txid
createAt | Creation time of the database record
status | Status




# Withdrawals


## Get Withdrawals List

```json
{
    "currentPage":1,
    "pageSize":10,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "id":"5c2dc64e03aa675aa263f1ac",
            "address":"0x5bedb060b8eb8d823e2414d82acce78d38be7fe9",
            "memo":"",
            "currency":"ETH",
            "amount":1,
            "fee":0.01,
            "walletTxId":"3e2414d82acce78d38be7fe9",
            "isInner":false,
            "status":"FAILURE",
            "remark":"test",
            "createdAt":1546503758000,
            "updatedAt":1546504603000
        }
    ]
}
```

### HTTP REQUEST
**GET /api/v1/withdrawals**

### Example
GET /api/v1/withdrawals

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | *[Optional]*  [Currency](#get-currencies)
status | String | *[Optional]*  Status. Available value: PROCESSING, WALLET_PROCESSING, SUCCESS, and FAILURE
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)

### RESPONSES
Field | Description
--------- | -------
id | Unique identity
address | Withdrawal address
memo |  Address remark. If there’s no remark, it is empty. When you [withdraw](#apply-withdraw) from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
currency | Currency
amount | Withdrawal amount
fee | Withdrawal fee
walletTxId | Wallet Txid
isInner | Internal withdrawal or not
status | status
remark | remark
createdAt | Creation time
updatedAt | Update time




## Get V1 Historical Withdrawals List

```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":2,
    "totalPage":2,
    "items":[
        {
            "currency":"BTC",
            "createAt":1526723468,
            "amount":"0.534",
            "address":"33xW37ZSW4tQvg443Pc7NLCAs167Yc2XUV",
            "walletTxId":"aeacea864c020acf58e51606169240e96774838dcd4f7ce48acf38e3651323f4",
            "isInner":false,
            "status":"SUCCESS"
        }
    ]
}
```
List of KuCoin V1 historical withdrawals.

<aside class="notice">Default query for one month of data.</aside>

### HTTP REQUEST
**GET /api/v1/hist-withdrawals**

### Example
GET /api/v1/hist-withdrawals


### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>

### Parameters

Param | Type | Description
--------- | ------- | -----------
currentPage | int | *[Optional]*  The current page.
pageSize | int | *[Optional]*  Number of entries per page.  
currency | String | *[Optional]*  [Currency](#get-currencies).
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)
status | String | *[Optional]*  Status. Available value: PROCESSING, SUCCESS, and FAILURE

### RESPONSES
Field | Description
--------- | ------- | -----------
amount | Withdrawal amount
currency | Currency
isInner | Internal deposit or not
walletTxId | Wallet Txid
createAt | Creation time of the database record
status | Status




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
	"precision": 8,   //withdrawal precision
	"chain": "OMNI"
}
```

### HTTP REQUEST
**GET /api/v1/withdrawals/quotas**

### Example
GET /api/v1/withdrawals/quotas?currency=BTC


### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency | String | currency. e.g. BTC
chain | String | *[Optional]* The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. This only apply for multi-chain currency, and there is no need for single chain currency.

### RESPONSES
Field | Description
--------- | ------- | -----------
currency | Currency
availableAmount | Current available withdrawal amount
remainAmount | Remaining amount available to withdraw the current day
withdrawMinSize | Minimum withdrawal amount
limitBTCAmount | Total BTC amount available to withdraw the current day
innerWithdrawMinFee | Fees for internal withdrawal
usedBTCAmount | The estimated BTC amount (based on the daily fiat limit) that can be withdrawn within the current day
isWithdrawEnabled | Is the withdraw function enabled or not
withdrawMinFee | Minimum withdrawal fee
precision | Floating point precision.
chain | The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20.

## Apply Withdraw

```json
{
  "withdrawalId": "5bffb63303aa675e8bbe18f9"
}
```

### HTTP REQUEST
**POST /api/v1/withdrawals**

<aside class="notice">On the WEB end, you can open the switch of specified favorite addresses for withdrawal, and when it is turned on, it will verify whether your withdrawal address is a favorite address.</aside>

### Example
POST /api/v1/withdrawals

### API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
currency  | String | Currency
address   | String | Withdrawal address
amount | number | Withdrawal amount, a positive number which is a multiple of the amount precision (fees excluded)
memo   | String | *[Optional]*   Address remark. If there’s no remark, it is empty. When you withdraw from other platforms to the KuCoin, you need to fill in memo(tag). If you do not fill memo (tag), your deposit may not be available, please be cautious.
isInner | boolean | *[Optional]*  Internal withdrawal or not. Default setup: false
remark | String | *[Optional]*  Remark
chain | String | *[Optional]* The chain name of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20, default is ERC20. This only apply for multi-chain currency, and there is no need for single chain currency.

### RESPONSES
Field | Description
--------- | -------
withdrawalId | Withdrawal id

For cryptocurrency withdrawal, KuCoin supports internal and external transaction fee deduction, which means when the balance in your main account is sufficient to support the withdrawal, the system will initially deduct the transaction fees from your main account. But if the balance in your main account is not sufficient to support the withdrawal, the system will deduct the fees from your withdrawal amount.

For example:

Suppose you are going to withdraw 1 BTC from the KuCoin platform (transaction fee: 0.0001BTC), if the balance in your main account is insufficient, the system will deduct the transaction fees from your withdrawal amount. In this case, you will be receiving 0.9999BTC.

## Cancel Withdrawal

Only withdrawals requests of **PROCESSING** status could be canceled.

### HTTP REQUEST
**DELETE /api/v1/withdrawals/{withdrawalId}**

### Example
DELETE /api/v1/withdrawals/5bffb63303aa675e8bbe18f9

### API KEY PERMISSIONS
This endpoint requires the **"Transfer"** permission.

### Parameters

Param | Type | Description
--------- | ------- | -----------
withdrawalId | String | Path parameter, a unique ID for a withdrawal order


# Trade Fee

## Basic user fee

This interface is for the basic fee rate of users

```json
{
    "code": "200000",
    "data": {
        "takerFeeRate": "0.001",
        "makerFeeRate": "0.001"
    }
}
```

### HTTP REQUEST
**GET /api/v1/base-fee**

### Example
GET /api/v1/base-fee

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

###RESPONSES
Field | Description
--------- | -------
takerFeeRate | Base taker fee rate
makerFeeRate | Base maker fee rate

## Actual fee rate of the trading pair

This interface is for the actual fee rate of the trading pair. You can inquire about fee rates of 10 trading pairs each time at most. The fee rate of your sub-account is the same as that of the master account.  

```json
{
    "code": "200000",
    "data": [
        {
            "symbol": "BTC-USDT",
            "takerFeeRate": "0.001",
            "makerFeeRate": "0.001"
        },
        {
            "symbol": "KCS-USDT",
            "takerFeeRate": "0.002",
            "makerFeeRate": "0.0005"
        }
    ]
}
```

### HTTP REQUEST
**GET /api/v1/trade-fees**

### Example
GET /api/v1/trade-fees?symbols=BTC-USDT,KCS-USDT

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.


### Parameters

Param | Type | Description
--------- | ------- | -------
symbols| String | Trading pair (optional, you can inquire fee rates of 10 trading pairs each time at most)


###RESPONSES
Field | Description
--------- | -------
symbol | The unique identity of the trading pair and will not change even if the trading pair is renamed
takerFeeRate | Actual taker fee rate of the trading pair
makerFeeRate | Actual maker fee rate of the trading pair

# Trade

Signature is required for this part.

# Orders

## Place a new order

```json
{
  "orderId": "5bd6e9286d99522a52e458de"
}
```

You can place two types of orders: **limit** and **market**. Orders can only be placed if your account has sufficient funds. Once an order is placed, your account funds will be put on hold for the duration of the order. How much and which funds are put on hold depends on the order type and parameters specified. See the Holds details below.

<aside class="notice">Placing an order will enable price protection. When the price of the limit order is outside the threshold range, the price protection mechanism will be triggered, causing the order to fail.</aside>


Please note that the system will frozen the fees from the orders that entered the order book in advance. Read [List Fills](#list-fills) to learn more.

Before placing an order, please read [Get Symbol List](#get-symbols-list) to understand the requirements for the quantity parameters for each trading pair.

**Do not include extra spaces in JSON strings**.

###Place Order Limit

The maximum matching orders for a single trading pair in one account is **200** (stop orders included).


### HTTP Request
**POST /api/v1/orders**

### Example
POST /api/v1/orders


### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters

| Param     | type   | Description  |
| --------- | ------ |-------------------------------- |
| clientOid | String | Unique order id created by users to identify their orders, e.g. UUID. |
| side      | String | **buy** or **sell**      |
| symbol    | String | a valid trading symbol code. e.g. ETH-BTC     |
| type      | String | *[Optional]* **limit** or **market** (default is **limit**)          |
| remark    | String | *[Optional]*  remark for the order, length cannot exceed 100 utf8 characters|
| stp       | String | *[Optional]*  self trade prevention , **CN**, **CO**, **CB** or **DC**|
| tradeType | String | *[Optional]* The type of trading : **TRADE**（Spot Trade）, **MARGIN_TRADE** (Margin Trade). Default is **TRADE**. **Note: To improve the system performance and to accelerate order placing and processing, KuCoin has added a new interface for order placing of margin. For traders still using the current interface, please move to the new one as soon as possible. The current one will no longer accept margin orders by May 1st, 2021 (UTC). At the time, KuCoin will notify users via the announcement, please pay attention to it.** |

#### LIMIT ORDER PARAMETERS

| Param       | type    | Description                                                  |
| ----------- | ------- | ------------------- |
| price       | String  | price per base currency          |
| size        | String  | amount of base currency to buy or sell         |
| timeInForce | String  | *[Optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**), read [Time In Force](#time-in-force).   |
| cancelAfter | long    | *[Optional]*  cancel after **n** seconds, requires **timeInForce** to be **GTT**                   |
| postOnly    | boolean | *[Optional]*  Post only flag, invalid when **timeInForce** is **IOC** or **FOK**                               |
| hidden      | boolean | *[Optional]*  Order will not be displayed in the order book |
| iceberg    | boolean | *[Optional]*  Only aportion of the order is displayed in the order book |
| visibleSize | String  | *[Optional]*  The maximum visible size of an iceberg order   |


#### MARKET ORDER PARAMETERS

Param | type | Description
--------- | ------- | -----------
size | String | *[Optional]*  Desired amount in base currency
funds | String | *[Optional]*  The desired amount of quote currency to use

* It is required that you use one of the two parameters, **size** or **funds**.

###Advanced Description

###SYMBOL

The symbol must match a valid trading [symbol](#get-symbols-list).

###CLIENT ORDER ID

Generated by yourself, the optional clientOid field must be a unique id (e.g UUID). Only numbers, characters, underline(_) and separator(-) are allowed. The value will be returned in order detail. You can use this field to identify your orders via the public feed. The client_oid is different from the server-assigned order id. Please do not send a repeated client_oid. The length of the client_oid cannot exceed 40 characters. You should record the server-assigned order_id as it will be used for future query order status.


###TYPE

The order type you specify may decide whether other optional parameters are required, as well as how your order will be executed by the matching engine. If order type is not specified, the order will be a **limit** order by default.

**Price** and **size** are required to be specified for a **limit order**.  The order will be filled at the price specified or better, depending on the market condition.   If a limit order cannot be filled immediately, it will be outstanding in the open order book until matched by another order, or canceled by the user.


A **market order** differs from a limit order in that the execution price is not guaranteed. Market order, however, provides a way to buy or sell specific size of order without having to specify the price. Market orders will be executed immediately, and no orders will enter the open order book afterwards. Market orders are always considered takers and incur taker fees.

###TradeType
The platform currently supports spot (**TRADE**) and margin (**MARGIN_TRADE**) . The system will freeze the funds of the specified account according to your parameter type. If this parameter is not specified, the funds in your trade account will be frozen by default. **Note: To improve the system performance and to accelerate order placing and processing, KuCoin has added a new interface for order placing of margin. For traders still using the current interface, please move to the new one as soon as possible. The current one will no longer accept margin orders by May 1st, 2021 (UTC). At the time, KuCoin will notify users via the announcement, please pay attention to it.** 

###PRICE
The price must be specified in priceIncrement symbol units. The priceIncrement is the smallest unit of price. For the BTC-USDT symbol, the priceIncrement is 0.00001000. Prices less than 0.00001000 will not be accepted, The price for the placed order should be multiple numbers of priceIncrement, or the system would report an error when you place the order. Not required for market orders.

###SIZE
The size must be greater than the baseMinSize for the symbol and no larger than the baseMaxSize. The size must be specified in baseIncrement symbol units. Size indicates the amount of BTC (or base currency) to buy or sell.

###FUNDS
The funds field indicates the how much of the quote currency you wish to buy or sell. The size of the funds must be specified in quoteIncrement symbol units and the size of funds in order shall be a positive integer multiple of quoteIncrement, ensuring the funds is greater than the quoteMinSize for the symbol but no larger than the quoteMaxSize.


###TIME IN FORCE
Time in force policies provide guarantees about the lifetime of an order. There are four policies: Good Till Canceled **GTC**, Good Till Time **GTT**, Immediate Or Cancel **IOC**, and Fill Or Kill **FOK**.

**GTC** Good Till Canceled orders remain open on the book until canceled. This is the default behavior if no policy is specified.

**GTT** Good Till Time orders remain open on the book until canceled or the allotted cancelAfter is depleted on the matching engine. GTT orders are guaranteed to cancel before any other order is processed after the cancelAfter seconds placed in order book.

**IOC** Immediate Or Cancel orders instantly cancel the remaining size of the limit order instead of opening it on the book.

**FOK** Fill Or Kill orders are rejected if the entire size cannot be matched.

* Note that self trades belong to match as well.

### POST ONLY
The post-only flag ensures that the trader always pays the maker fee and provides liquidity to the order book. If any part of the order is going to pay taker fee, the order will be fully rejected.

If a post only order will get executed immediately against the existing orders (except iceberg and hidden orders) in the market, the order will be cancelled.

* For post only orders, it will get executed immediately against the iceberg orders and hidden orders in the market. Users placing the post only order will be charged the maker fees and the iceberg and hidden orders will be charged the taker fees.


### HIDDEN AND ICEBERG


The **Hidden** and **iceberg Orders** are two **options** in advanced settings (note: the iceberg order is a special form of the hidden order). You may select “Hidden” or “Iceberg” when placing a limit or stop limit order.

A hidden order will enter but not display on the orderbook.

Different from the hidden order, an **iceberg order** is divided into visible portion and invisible portion. When placing an iceberg order, you need to set the **visible size**. The minimum visible size is 1/20 of the order size. The minimum visible size shall be greater than the minimum order size, or an error will occur.

In a matching event, the visible portion of an iceberg order will be executed first, and another visible portion will pop up until the order is fully filled.

**Note**:
- The system will charge **taker fees** for **Hidden** and **iceberg Orders**.

- If both "Iceberg" and "Hidden" are selected, your order will be filled as an **iceberg Order** by default.


###HOLDS
For limit buy orders, we will hold the needed portion from your funds (price x size of the order). Likewise, on sell orders, we will also hold the amount of assets that you wish to sell. Actual fees are assessed at the time of a trade. If you cancel a partially filled or unfilled order, any remaining funds will be released from being held.

For market buy or sell orders where the funds are specified, the funds amount will be put on hold. If only size is specified, all of your account balance (in the quote account) will be put on hold for the duration of the market order (usually a trivially short time).

### SELF-TRADE PREVENTION

**Self-Trade Prevention** is an option in advanced settings.It is not selected by default. If you specify **STP** when placing orders, your order won't be matched by another one which is also yours. On the contrary, if **STP** is not specified in advanced, your order can be matched by another one of your own orders.

**Market order is currently not supported for DC**. When the **timeInForce** is set to **FOK**, the **stp** flag will be forcely specified as **CN**.


**Market order is currently not supported for DC**. When *timeInForce* is **FOK**, the stp flag will be forced to be specified as **CN**.

| Flag | Name                          |
| ---- | ----------------------------- |
| DC   | Decrease and Cancel           |
| CO   | Cancel oldest                 |
| CN   | Cancel newest                 |
| CB   | Cancel both                   |

### ORDER LIFECYCLE
The HTTP Request will respond when an order is either rejected (insufficient funds, invalid parameters, etc) or received (accepted by the matching engine). A **200** response indicates that the order was received and is active. **Active** orders may execute immediately (depending on price and market conditions) either partially or fully. A partial execution will put the remaining size of the order in the open state. An order that is filled completely, will go into the **done** state.

Users listening to streaming market data are encouraged to use the order ID field to identify their received messages in the feed.

### PRICE PROTECTION MECHANISM

1. If there are contra orders against the market/limit orders placed by users in the order book, the system will detect whether the difference between the corresponding market price and the ask/bid price will exceed the threshold (you can request via the API symbol interface).
2. For limit orders, if the difference exceeds the threshold, the order placement would fail.
3. For market orders, the order will be partially executed against the existing orders in the market within the threshold and the remaining unfilled part of the order will be canceled immediately.
For example: If the threshold is 10%, when a user places a market order to buy 10,000 USDT in the KCS/USDT market (at this time, the current ask price is 1.20000), the system would determine that the final execution price would be 1.40000. As for (1.40000-1.20000)/1.20000=16.7%>10%, the threshold price would be 1.32000. Therefore, this market order will execute with the existing orders offering prices up to 1.32000 and the remaining part of the order will be canceled immediately.
Notice: There might be some deviations of the detection. If your order is not fully filled, it may probably be led by the unfilled part of the order exceeding the threshold.


###RESPONSES
Field | Description
--------- | -------
orderId | The ID of the order

A successful order will be assigned an order ID. A successful order is defined as one that has been accepted by the matching engine.

<aside class="notice">Open orders do not expire and will remain open until they are either filled or canceled.</aside>


## Place a margin order

```json
{
  "orderId": "5bd6e9286d99522a52e458de",
  "borrowSize":10.2,
  "loanApplyId":"600656d9a33ac90009de4f6f"
}
```

You can place two types of orders: **limit** and **market**. Orders can only be placed if your account has sufficient funds. Once an order is placed, your account funds will be put on hold for the duration of the order. How much and which funds are put on hold depends on the order type and parameters specified. See the Holds details below.

<aside class="notice">Placing an order will enable price protection. When the price of the limit order is outside the threshold range, the price protection mechanism will be triggered, causing the order to fail.</aside>


Please note that the system will frozen the fees from the orders that entered the order book in advance. Read [List Fills](#list-fills) to learn more.

Before placing an order, please read [Get Symbol List](#get-symbols-list) to understand the requirements for the quantity parameters for each trading pair.

**Do not include extra spaces in JSON strings**.

###Place Order Limit

The maximum matching orders for a single trading pair in one account is **200** (stop orders included).


### HTTP Request
**POST /api/v1/margin/order**

### Example
POST /api/v1/margin/order

### Parameters

| Param     | type   | Description  |
| --------- | ------ |-------------------------------- |
| clientOid | String | Unique order id created by users to identify their orders, e.g. UUID. |
| side      | String | **buy** or **sell**      |
| symbol    | String | a valid trading symbol code. e.g. ETH-BTC     |
| type      | String | *[Optional]* **limit** or **market** (default is **limit**)          |
| remark    | String | *[Optional]*  remark for the order, length cannot exceed 100 utf8 characters|
| stp       | String | *[Optional]*  self trade prevention , **CN**, **CO**, **CB** or **DC**|
| marginMode | String | *[Optional]*  The type of trading, including cross (cross mode) and isolated (isolated mode). It is set at cross by default. The isolated mode will be released soon, so stay tuned!|
| autoBorrow | boolean | *[Optional]*  Auto-borrow to place order. The system will first borrow you funds at the optimal interest rate and then place an order for you. |

#### LIMIT ORDER PARAMETERS

| Param       | type    | Description                                                  |
| ----------- | ------- | ------------------- |
| price       | String  | price per base currency          |
| size        | String  | amount of base currency to buy or sell         |
| timeInForce | String  | *[Optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**), read [Time In Force](#time-in-force).   |
| cancelAfter | long    | *[Optional]*  cancel after **n** seconds, requires **timeInForce** to be **GTT**                   |
| postOnly    | boolean | *[Optional]*  Post only flag, invalid when **timeInForce** is **IOC** or **FOK**                               |
| hidden      | boolean | *[Optional]*  Order will not be displayed in the order book |
| iceberg    | boolean | *[Optional]*  Only aportion of the order is displayed in the order book |
| visibleSize | String  | *[Optional]*  The maximum visible size of an iceberg order   |


#### MARKET ORDER PARAMETERS

Param | type | Description
--------- | ------- | -----------
size | String | *[Optional]*  Desired amount in base currency
funds | String | *[Optional]*  The desired amount of quote currency to use

* It is required that you use one of the two parameters, **size** or **funds**.

###Advanced Description


###MarginMode
There are two modes for API margin trading: 1) cross and 2) isolated. Currently, the platform only supports the cross mode and it is the default option for the margin trading. The isolated mode will be released soon, so stay tuned!

###AutoBorrow
This is the symbol of Auto-Borrow, if it is set to “true”, the system will automatically borrow the funds required for an order according to the order amount. By default, the symbol is set to “false”. When your order amount is too large, exceeding the max. borrowing amount via the max. leverage or the risk limit of margin, then you will fail in borrowing and order placing. 


###RESPONSES
Field | Description
--------- | -------
orderId | The ID of the order
borrowSize | Borrowed amount. The field is returned only after placing the order under the mode of Auto-Borrow. 
loanApplyId | ID of the borrowing response. The field is returned only after placing the order under the mode of Auto-Borrow.

A successful order will be assigned an order ID. A successful order is defined as one that has been accepted by the matching engine.

<aside class="notice">Open orders do not expire and will remain open until they are either filled or canceled.</aside>


## Place Bulk Orders

```json
{
    "success":true,
    "code":"200",
    "msg":"success",
    "retry":false,
    "data":{
        "data":[
            {
                "symbol":"BTC-USDT",
                "type":"limit",
                "side":"buy",
                "price":"9661",
                "size":"1",
                "funds":null,
                "stp":"",
                "stop":"",
                "stopPrice":"0",
                "timeInForce":"GTC",
                "cancelAfter":0,
                "postOnly":false,
                "hidden":false,
                "iceberge":false,
                "iceberg":false,
                "visibleSize":"0",
                "channel":"API",
                "id":null,
                "status":"fail",
                "failMsg":"error.createOrder.accountBalanceInsufficient",
                "clientOid":"5e42743514832d53d255d921"
            }
        ]
    }
}
```

Request via this endpoint to place 5 orders at the same time. The order type must be a limit order of the same symbol.
**The interface currently only supports spot trading**


### HTTP Request

**POST /api/v1/orders/multi**


### Example

```json
{
    "symbol":"BTC-USDT",
    "orderList":[
        {
            "clientOid":"5e42743514832d53d255d921",
            "price":9661,
            "side":"buy",
            "size":1,
            "symbol":"BTC-USDT",
            "type":"limit"
        }
    ]
}
```

POST /api/v1/orders/multi

### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters

| Param     | type   | Description  |
| --------- | ------ |-------------------------------- |
| clientOid | String | Unique order id created by users to identify their orders, e.g. UUID. |
| side      | String | **buy** or **sell**      |
| symbol    | String | a valid trading symbol code. e.g. ETH-BTC     |
| type      | String | *[Optional]* **limit** or **market** (default is **limit**)          |
| remark    | String | *[Optional]*  remark for the order, length cannot exceed 100 utf8 characters|
| stop      | String | *[Optional]* Either **loss** or **entry**. Requires **stopPrice** to be defined |
| stopPrice | String | *[Optional]* Need to be defined if stop is specified. |
| stp       | String | *[Optional]*  self trade prevention , **CN**, **CO**, **CB** or **DC**|
| tradeType | String | *[Optional]*  Default is **TRADE** |
| price       | String  | price per base currency          |
| size        | String  | amount of base currency to buy or sell         |
| timeInForce | String  | *[Optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**), read [Time In Force](#time-in-force).   |
| cancelAfter | long    | *[Optional]*  cancel after **n** seconds, requires **timeInForce** to be **GTT**                   |
| postOnly    | boolean | *[Optional]*  Post only flag, invalid when **timeInForce** is **IOC** or **FOK**                               |
| hidden      | boolean | *[Optional]*  Order will not be displayed in the order book |
| iceberg     | boolean | *[Optional]*  Only aportion of the order is displayed in the order book |
| visibleSize | String  | *[Optional]*  The maximum visible size of an iceberg order   |

### RESPONSES
Field | Description
--------- | -------
|status  |  status (success, fail) |
|failMsg |  the cause of failure   |


## Cancel an order

```json
{
     "cancelledOrderIds": [
      "5bd6e9286d99522a52e458de"   //orderId
    ]
}
```

Request via this endpoint to cancel a single order previously placed.

<aside class="notice">This interface is only for cancellation requests. The cancellation result needs to be obtained by querying the order status or subscribing to websocket. It is recommended that you DO NOT cancel the order until receiving the Open message, otherwise the order cannot be cancelled successfully.
</aside>


### HTTP REQUEST
**DELETE /api/v1/orders/{orderId}**

### Example
DELETE /api/v1/orders/5bd6e9286d99522a52e458de


### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters
Param | Type | Description
--------- | ------- | -----------
orderId | String | [Order ID](#list-orders), unique ID of the order.

### RESPONSES
Field | Description
--------- | -------
orderId | Unique ID of the cancelled order



<aside class="notice">The <b>order ID</b> is the server-assigned order id and not the passed clientOid.</aside>

### CANCEL REJECT
If the order could not be canceled (already filled or previously canceled, etc), then an error response will indicate the reason in the **message** field.

## Cancel Single Order by clientOid

```json
{
  "cancelledOrderId": "5f311183c9b6d539dc614db3",
  "clientOid": "6d539dc614db3"
}
```

Request via this interface to cancel an order via the clientOid.

### HTTP REQUEST

**DELETE /api/v1/order/client-order/{clientOid}**

### Example

DELETE /api/v1/order/client-order/6d539dc614db3

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

###RESPONSES###

| Param | Type | Description                            |
| ------- | ------ | ----------------------------- |
| clientOid | String | Unique order id created by users to identify their orders |

### RESPONSES

| Field | Description     |
| ----------------- | ------- |
| cancelledOrderId | Order ID of cancelled order |
| clientOid | Unique order id created by users to identify their orders |





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

Request via this endpoint to cancel all open orders. The response is a list of ids of the canceled orders.

### HTTP REQUEST
**DELETE /api/v1/orders**

### Example
**DELETE /api/v1/orders?symbol=ETH-BTC&tradeType=TRADE**

### API KEY PERMISSIONS
This endpoint requires the **"Trade"** permission.

### Parameters
|Param | Type | Description|
|--------- | ------- | -----------|
|symbol | String | *[Optional]* symbol, cancel the orders for the specified trade pair. |
| tradeType| String | *[Optional]* the type of trading, cancel the orders for the specified trading type, and the default is to cancel the spot trading order (**TRADE**).|

### RESPONSES
Field | Description
--------- | -------
orderId | Order ID, unique identifier of an order.



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
            "opType": "DEAL",      // operation type: DEAL
            "type": "limit",       // order type,e.g. limit,market,stop_limit.
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
            "createdAt": 1547026471000,  // create time
            "tradeType": "TRADE"
        }
     ]
 }
```

Request via this endpoint to get your current order list. Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

### HTTP REQUEST
**GET /api/v1/orders**

### Example
GET /api/v1/orders?status=active

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>


### PARAMETERS
You can pinpoint the results with the following query paramaters.

Param | Type | Description
--------- | ------- | -----------
status | String |*[Optional]* **active** or **done**(done as default), Only list orders with a specific status .
symbol |String|*[Optional]* Only list orders for a specific symbol.
side | String | *[Optional]* **buy** or **sell**
type | String | *[Optional]* **limit**, **market**, **limit_stop** or **market_stop**
tradeType | String |The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)

### RESPONSES
Field | Description
--------- | -------
id |  Order ID, the ID of an order.
symbol | symbol
opType |  Operation type: DEAL
type | order type,e.g. limit,market,stop_limit.
side | transaction direction,include buy and sell
price |  order price
size |  order quantity
funds | order funds
dealFunds |  executed size of funds
dealSize | executed quantity
fee | fee
feeCurrency | charge fee currency
stp |  self trade prevention,include CN,CO,DC,CB
stop |  stop type, include entry and loss
stopTriggered |  stop order is triggered or not
stopPrice |  stop price
timeInForce | time InForce,include GTC,GTT,IOC,FOK
postOnly | postOnly
hidden | hidden order
iceberg | iceberg order
visibleSize | displayed quantity for iceberg order
cancelAfter | cancel orders time，requires timeInForce to be GTT
channel | order source
clientOid | user-entered order unique mark
remark | remark
tags | tag order source
isActive |  order status, true and false. If true, the order is active, if false, the order is fillled or cancelled
cancelExist | order cancellation transaction record
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).

### ORDER STATUS AND SETTLEMENT
Any order on the exchange order book is in active status. Orders removed from the order book will be marked with done status. After an order becomes done, there may be a few milliseconds latency before it’s fully settled.

You can check the orders in any status. If the status parameter is not specified, orders of done status will be returned by default.

When you query orders in active status, there is no time limit. However, when you query orders in done status, the start and end time range cannot exceed 7* 24 hours. An error will occur if the specified time window exceeds the range. If you specify the end time only, the system will automatically calculate the start time as end time minus 7*24 hours, and vice versa.


The history for cancelled orders is only kept for **one month**. You will not be able to query for cancelled orders that have happened more than a month ago.

<aside class="notice">The total number of items retrieved cannot exceed 50,000. If it is exceeded, please shorten the query time range.</aside>

### POLLING
For high-volume trading, it is highly recommended that you maintain your own list of open orders and use one of the streaming market data feeds to keep it updated. You should poll the open orders endpoint to obtain the current state of any open order.



## Get V1 Historical Orders List

```json
{
    "currentPage":1,
    "pageSize":50,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "symbol":"SNOV-ETH",
            "dealPrice":"0.0000246",
            "dealValue":"0.018942",
            "amount":"770",
            "fee":"0.00001137",
            "side":"sell",
            "createdAt":1540080199
        }
    ]
}
```

Request via this endpoint to get your historical orders list of the KuCoin V1.
Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

<aside class="notice">Default query for one month of data.</aside>

### HTTP REQUEST
**GET /api/v1/hist-orders**

### Example
GET /api/v1/hist-orders

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>


### PARAMETERS
You can request for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
currentPage | int | *[Optional]*  The current page.
pageSize | int | *[Optional]*  Number of entries per page.  
symbol | String | *[Optional]* a valid trading [symbol code](#get-symbols-list). e.g. ETH-BTC.
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)
side | String | *[Optional]*  **buy** or **sell**

### RESPONSES
Field | Description
--------- | -------
symbol | symbol
dealPrice | Filled price
dealValue | Executed size of funds
side | transaction direction,include buy and sell.
amount |   Executed quantity
size |  Order quantity.
fee | Fee.
createdAt | Create time.



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
            "createdAt": 1547026471000,
            "tradeType": "TRADE"
        }
    ]
}
```

Request via this endpoint to get 1000 orders in the last 24 hours.
Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

### HTTP REQUEST
**GET /api/v1/limit/orders**

### Example
GET /api/v1/limit/orders

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.


###RESPONSES
Field | Description
--------- | -------
orderId | Order ID, unique identifier of an order.
symbol | symbol
opType |  Operation type: DEAL
type | order type, e.g. limit, market, stop_limit
side | transaction direction,include buy and sell
price |  order price
size |  order quantity
funds | order funds
dealFunds |  deal funds
dealSize | deal quantity
fee | fee
feeCurrency | charge fee currency
stp |  self trade prevention,include CN,CO,DC,CB
stop |  stop type, include entry and loss
stopTriggered |  stop order is triggered
stopPrice |  stop price
timeInForce | time InForce,include GTC,GTT,IOC,FOK
postOnly | postOnly
hidden | hidden order
iceberg | iceberg order
visibleSize | display quantity for iceberg order
cancelAfter | cancel orders time，requires timeInForce to be GTT
channel | order source
clientOid | user-entered order unique mark
remark | remark
tags | tag order source
isActive | order status, true and false. If true, the order is active, if false, the order is fillled or cancelled
cancelExist | order cancellation transaction record
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).




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
    "createdAt": 1547026471000,
    "tradeType": "TRADE"
 }
```
Request via this endpoint to get a single order info by order ID.

### HTTP REQUEST
**GET /api/v1/orders/{order-id}**

### Example
GET /api/v1/orders/5c35c02703aa673ceec2a168

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### PARAMETERS
Param | Type | Description
--------- | ------- | -----------
orderId | String | Order ID, unique identifier of an order, obtained via the [List orders](#list-orders).

###RESPONSES
Field | Description
--------- | -------
orderId | Order ID, the ID of an order
symbol | symbol
opType |  operation type,deal is pending order,cancel is cancel order
type | order type,e.g. limit,market,stop_limit.
side | transaction direction,include buy and sell
price |  order price
size |  order quantity
funds | order funds
dealFunds |  deal funds
dealSize | deal quantity
fee | fee
feeCurrency | charge fee currency
stp |  self trade prevention,include CN,CO,DC,CB
stop |  stop type, include entry and loss
stopTriggered |  stop order is triggered
stopPrice |  stop price
timeInForce | time InForce,include GTC,GTT,IOC,FOK
postOnly | postOnly
hidden | hidden order
iceberg | iceberg order
visibleSize | display quantity for iceberg order
cancelAfter | cancel orders time，requires timeInForce to be GTT
channel | order source
clientOid | user-entered order unique mark
remark | remark
tags | tag order source
isActive | order status, true and false. If true, the order is active, if false, the order is fillled or cancelled
cancelExist | order cancellation transaction record
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).



<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## Get Single Active Order by clientOid 

```json
{
  "id": "5f3113a1c9b6d539dc614dc6",
  "symbol": "KCS-BTC",
  "opType": "DEAL",
  "type": "limit",
  "side": "buy",
  "price": "0.00001",
  "size": "1",
  "funds": "0",
  "dealFunds": "0",
  "dealSize": "0",
  "fee": "0",
  "feeCurrency": "BTC",
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
  "channel": "API",
  "clientOid": "6d539dc614db312",
  "remark": "",
  "tags": "",
  "isActive": true,
  "cancelExist": false,
  "createdAt": 1597051810000,
  "tradeType": "TRADE"
}
```

Request via this interface to check the information of a single active order via clientOid. The system will prompt that the order does not exists if the order does not exist or has been settled.


### HTTP REQUEST

**GET /api/v1/order/client-order/{clientOid}**

### Example

GET /api/v1/order/client-order/6d539dc614db312

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### PARAMETERS

| Param | Type | Description                           |
| ------- | ------ | ----------------------------- |
| clientOid | String | Unique order id created by users to identify their orders |

###RESPONSES
Field | Description
--------- | -------
orderId | Order ID, the ID of an order
symbol | symbol
opType |  operation type,deal is pending order,cancel is cancel order
type | order type,e.g. limit,market,stop_limit.
side | transaction direction,include buy and sell
price |  order price
size |  order quantity
funds | order funds
dealFunds |  deal funds
dealSize | deal quantity
fee | fee
feeCurrency | charge fee currency
stp |  self trade prevention,include CN,CO,DC,CB
stop |  stop type, include entry and loss
stopTriggered |  stop order is triggered
stopPrice |  stop price
timeInForce | time InForce,include GTC,GTT,IOC,FOK
postOnly | postOnly
hidden | hidden order
iceberg | iceberg order
visibleSize | display quantity for iceberg order
cancelAfter | cancel orders time，requires timeInForce to be GTT
channel | order source
clientOid | user-entered order unique mark
remark | remark
tags | tag order source
isActive | order status, true and false. If true, the order is active, if false, the order is fillled or cancelled
cancelExist | order cancellation transaction record
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).



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
            "type":"limit",  // order type,e.g. limit,market,stop_limit.
            "createdAt":1547026472000,  //time
            "tradeType": "TRADE"
        }
    ]
}
```

Request via this endpoint to get the recent fills.

Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.


### HTTP REQUEST
**GET /api/v1/fills**

### Example
GET /api/v1/fills


### PERMISSIONS
This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>


### PARAMETERS
You can request fills for specific orders using query parameters.

Param | Type | Description
--------- | ------- | -----------
orderId | String |*[Optional]* Limit the list of fills to this orderId（If you specify orderId, ignore other conditions）
symbol | String |*[Optional]* Limit the list of fills to this symbol
side | String |*[Optional]* **buy** or **sell**
type | String |*[Optional]* **limit**, **market**, **limit_stop** or **market_stop**
startAt| long | *[Optional]*  Start time (milisecond)
endAt| long | *[Optional]* End time (milisecond)
tradeType | String |The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).


### RESPONSES
Field | Description
--------- | -------
symbol | symbol.
tradeId | trade id, it is generated by Matching engine.
orderId | Order ID, unique identifier of an order.
counterOrderId | counter order id.
side | transaction direction,include buy and sell.
price |  order price
size |  order quantity
funds | order funds
type | order type,e.g. limit,market,stop_limit.
fee | fee
feeCurrency | charge fee currency
stop |  stop type, include entry and loss
liquidity |  include taker and maker
forceTaker |  forced to become taker, include true and false
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).


**Data time range**

The system allows you to retrieve data up to one week (start from the last day by default). If the time period of the queried data exceeds one week (time range from the start time to end time exceeded 7*24 hours), the system will prompt to remind you that you have exceeded the time limit. If you only specified the start time, the system will automatically calculate the end time (end time = start time + 7 * 24 hours). On the contrary, if you only specified the end time, the system will calculate the start time (start time= end time - 7 * 24 hours) the same way.

<aside class="notice">The total number of items retrieved cannot exceed 50,000. If it is exceeded, please shorten the query time range.</aside>

**Settlement**

The settlement contains two parts:
- **Transactional settlement**
- **Fee settlement**


After an order is matched, the transactional and fee settlement data will be updated in the data store. Once the data is updated, the system would enable the settlement process and will deduct the fees from your pre-frozen assets. After that, the currency will be transferred to the account of the user.  

**Fees**

Orders on KuCoin platform are classified into two types， taker and maker. A taker order matches other resting orders on the exchange order book, and gets executed immediately after order entry. A maker order, on the contrary, stays on the exchange order book and awaits to be matched. Taker orders will be charged taker fees, while maker orders will receive maker rebates. Please note that market orders, iceberg orders and hidden orders are always charged taker fees.

The system will pre-freeze a predicted taker fee when you place an order.The liquidity field indicates if the fill was charged taker or maker fees.

With the leading matching engine system in the market, users placing orders on KuCoin platform are classified into two types: **taker** and **maker**. **Taker**s, as the taker in the market, would be charged with taker fees; while **maker**s as the maker in the market, would be charged with less fees than the taker, or even get maker fees from KuCoin （The exchange platform would compensate the transaction fees for you）.

After placing orders on the KuCoin platform, to ensure the execution of these orders, the system would pre-freeze your assets based on the taker fee charges (because the system could not predict the order types you may choose). Please be noted that the system would deduct the fees from the orders entered the orderbook in advance.

If your order is market order, the system would charge taker fees from you.

If your order is limit order and is immediately matched and executed, the system would charge **taker fees** from you. On the contrary, if the order or part or your order is not executed immediately and enters into the order book, the system would charge **maker** **fees** from you if it is executed before being cancelled

After the order is executed and when the left order funds is **0**, the transaction is completed. If the remaining funds is not sufficient to support the minimum product (min.: 0.00000001), then the left part in the order would be cancelled.

If your order is a maker order, the system would return the left pre-frozen **taker** fees to you.

Notice:

- For a **hidden**/**iceberg** order, if it is not executed immediately and becomes a maker order, the system would still charge **taker fees** from you.
- Post Only order will charge you maker fees. If a post only order would get executed immediately against the existing orders (except iceberg and hidden orders) in the market, the order will be cancelled. If the post only order will execute against an iceberg/hidden order immediately, you will get the maker fees.




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




## Recent Fills

```json
{
    "code":"200000",
    "data":[
        {
            "counterOrderId":"5db7ee769797cf0008e3beea",
            "createdAt":1572335233000,
            "fee":"0.946357371456",
            "feeCurrency":"USDT",
            "feeRate":"0.001",
            "forceTaker":true,
            "funds":"946.357371456",
            "liquidity":"taker",
            "orderId":"5db7ee805d53620008dce1ba",
            "price":"9466.8",
            "side":"buy",
            "size":"0.09996592",
            "stop":"",
            "symbol":"BTC-USDT",
            "tradeId":"5db7ee8054c05c0008069e21",
            "tradeType":"MARGIN_TRADE",
            "type":"market"
        },
        {
            "counterOrderId":"5db7ee4b5d53620008dcde8e",
            "createdAt":1572335207000,
            "fee":"0.94625",
            "feeCurrency":"USDT",
            "feeRate":"0.001",
            "forceTaker":true,
            "funds":"946.25",
            "liquidity":"taker",
            "orderId":"5db7ee675d53620008dce01e",
            "price":"9462.5",
            "side":"sell",
            "size":"0.1",
            "stop":"",
            "symbol":"BTC-USDT",
            "tradeId":"5db7ee6754c05c0008069e03",
            "tradeType":"MARGIN_TRADE",
            "type":"market"
        },
        {
            "counterOrderId":"5db69aa4688933000aab8114",
            "createdAt":1572248229000,
            "fee":"1.882148318525",
            "feeCurrency":"USDT",
            "feeRate":"0.001",
            "forceTaker":false,
            "funds":"1882.148318525",
            "liquidity":"maker",
            "orderId":"5db69a9c4e6d020008f03275",
            "price":"9354.5",
            "side":"sell",
            "size":"0.20120245",
            "stop":"",
            "symbol":"BTC-USDT",
            "tradeId":"5db69aa477d8de0008c1efac",
            "tradeType":"MARGIN_TRADE",
            "type":"limit"
        }
    ]
}

```


Request via this endpoint to get a list of 1000 fills in the last 24 hours.


### HTTP REQUEST
**GET /api/v1/limit/fills**

### Example
GET /api/v1/limit/fills


### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### RESPONSES
Field | Description
--------- | -------
symbol | symbol
tradeId | trade id, it is generated by Matching engine.
orderId | Order ID, unique identifier of an order.
counterOrderId | counter order id.
side | transaction direction,include buy and sell.
price |  order price
size |  order quantity
funds | order funds
type | order type,e.g. limit,market,stop_limit.
fee | fee
feeCurrency | charge fee currency
stop |  stop type, include entry and loss
liquidity |  include taker and maker
forceTaker |  forced to become taker, include true and false
createdAt | create time
tradeType | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading).



<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# Stop Order

A stop order is an order to buy or sell the specified amount of cryptos at the last traded price or pre-specified limit price once the order has traded at or through a pre-specified stopPrice. The order will be executed by the highest price first. For orders of the same price, the order will be executed in time priority.

**stop: 'loss'**: Triggers when the last trade price changes to a value at or below the stopPrice.

**stop: 'entry'**: Triggers when the last trade price changes to a value at or above the stopPrice.

The last trade can be found in the latest match message. Note that not all match messages may be received due to dropped messages.

The last trade price is the last price at which an order was filled. This price can be found in the latest match message. Note that not all match messages may be received due to dropped messages.

Note that when triggered, stop orders execute as either market or limit orders, depending on the type.

When placing a stop loss order, the system will not pre-freeze the assets in your account for the order. **When you are going to place a stop market order, we recommend you to specify the funds for the order when trading**.

## Place a new order

**Do not include extra spaces in JSON strings in request body.**

### Limitation

The maximum untriggered stop orders for a single trading pair in one account is **20**.

### HTTP Request

**POST /api/v1/stop-order**

### Example

POST /api/v1/stop-order

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### Request Body Parameters

| Param     | Type   | Description                                                  |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | String | Unique order id created by users to identify their orders, e.g. UUID. |
| side      | String | **buy** or **sell**                                          |
| symbol    | String | a valid trading symbol code. e.g. ETH-BTC                    |
| type      | String | *[Optional]* **limit** or **market**, the default is **limit** |
| remark    | String | *[Optional]* remark for the order, length cannot exceed 100 utf8 characters |
| stop      | String | *[Optional]* Either **loss** or **entry**, the default is **loss**. Requires stopPrice to be defined. |
| stopPrice | String | Need to be defined if stop is specified.                     |
| stp       | String | *[Optional]* self trade prevention , **CN**, **CO**, **CB** , **DC** (limit order does not support DC) |
| tradeType | String | *[Optional]* The type of trading : **TRADE**（Spot Trade）, **MARGIN_TRADE** (Margin Trade). Default is **TRADE** |

#### LIMIT ORDER PARAMETERS

| Param       | type    | Description                                                  |
| ----------- | ------- | ------------------------------------------------------------ |
| price       | String  | price per base currency                                      |
| size        | String  | amount of base currency to buy or sell                       |
| timeInForce | String  | *[Optional]* **GTC**, **GTT**, **IOC**, or **FOK** (default is **GTC**), read [Time In Force](#time-in-force). |
| cancelAfter | long    | *[Optional]*  cancel after **n** seconds, requires **timeInForce** to be **GTT** |
| postOnly    | boolean | *[Optional]*  Post only flag, invalid when **timeInForce** is **IOC** or **FOK** |
| hidden      | boolean | *[Optional]*  Order will not be displayed in the order book  |
| iceberg     | boolean | *[Optional]*  Only aportion of the order is displayed in the order book |
| visibleSize | String  | *[Optional]*  The maximum visible size of an iceberg order   |


#### MARKET ORDER PARAMETERS

| Param | type   | Description                                               |
| ----- | ------ | --------------------------------------------------------- |
| size  | String | *[Optional]*  Desired amount in base currency             |
| funds | String | *[Optional]*  The desired amount of quote currency to use |

* It is required that you use one of the two parameters, **size** or **funds**.

###RESPONSES

| Field   | Description         |
| ------- | ------------------- |
| orderId | The ID of the order |

A successful order will be assigned an order ID. A successful order is defined as one that has been accepted by the matching engine.

## Cancel an Order

Request via this endpoint to cancel a single stop order previously placed.

You will receive cancelledOrderIds field once the system has received the cancellation request. The cancellation request will be processed by the matching engine in sequence. To know if the request is processed (successfully or not), you may check the order status or the update message from the pushes.

### HTTP Request

**DELETE /api/v1/stop-order/{orderId}**

### Example

DELETE /api/v1/stop-order/5bd6e9286d99522a52e458de

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### Parameters

| Param   | Type   | Description                                       |
| ------- | ------ | ------------------------------------------------- |
| orderId | String | [Order ID](#list-orders), unique ID of the order. |

### RESPONSES

| Field   | Description                      |
| ------- | -------------------------------- |
| orderId | Unique ID of the cancelled order |



<aside class="notice">The <b>order ID</b> is the server-assigned order id and not the passed clientOid.</aside>

### CANCEL REJECT

If the order could not be canceled (already filled or previously canceled, etc), then an error response will indicate the reason in the **message** field.

## Cancel Orders

Request via this interface to cancel a batch of stop orders.

### HTTP Request

**DELETE /api/v1/stop-order/cancel**

### Example

**DELETE /api/v1/stop-order/cancel?symbol=ETH-BTC&tradeType=TRADE&orderIds=5bd6e9286d99522a52e458de,5bd6e9286d99522a52e458df**

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

### PARAMETERS

| Parm      | Type   | Decription                                                   |
| --------- | ------ | ------------------------------------------------------------ |
| symbol    | String | [Optional] symbol                                            |
| tradeType | String | [Optional] The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading). |
| orderIds  | String | [Optional] Comma seperated order IDs.                        |

### RESPONSES

| Field             | Decription          |
| ----------------- | ------------------- |
| cancelledOrderIds | cancelled order ids |

## Get Single Order Info

Request via this interface to get a stop order information via the order ID.

### HTTP Request

**GET /api/v1/stop-order/{orderId}**

### Example

GET /api/v1/stop-order/5c35c02703aa673ceec2a168

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

### PARAMETERS

| Parm    | Type   | Decription |
| ------- | ------ | ---------- |
| orderId | String | Order ID   |



### RESPONSES

| Field       | Description                                                  |
| ----------- | ------------------------------------------------------------ |
| id          | Order ID, the ID of an order.                                |
| symbol      | Symbol                                                       |
| userId      | User ID                                                      |
| type        | Order type                                                   |
| side        | transaction direction,include buy and sell                   |
| price       | order price                                                  |
| size        | order quantity                                               |
| funds       | order funds                                                  |
| stp         | self trade prevention                                        |
| timeInForce | time InForce,include GTC,GTT,IOC,FOK                         |
| cancelAfter | cancel orders after n seconds，requires timeInForce to be GTT |
| postOnly    | postOnly                                                     |
| hidden      | hidden order                                                 |
| iceberg     | Iceberg order                                                |
| visibleSize | displayed quantity for iceberg order                         |
| channel     | order source                                                 |
| clientOid   | user-entered order unique mark                               |
| remark      | Remarks                                                      |
| tags        | tag order source                                             |
| tradeType   | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading). |
| feeCurrency | The currency of the fee                                      |
| createdAt   | order creation time                                          |
| stop        | Stop order type, include loss and entry                      |
| stopPrice   | stop price                                                   |


## List Stop Orders


Request via this endpoint to get your current untriggered stop order list. Items are paginated and sorted to show the latest first. See the [Pagination](#pagination) section for retrieving additional entries after the first page.

### HTTP REQUEST

**GET /api/v1/stop-order**

### Example

GET /api/v1/stop-order

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

<aside class="notice">This request is paginated.</aside>


### PARAMETERS

You can pinpoint the results with the following query paramaters.

| Param       | Type   | Description                                                  |
| ----------- | ------ | ------------------------------------------------------------ |
| status      | String | *[Optional]* **active** or **done**(done as default), Only list orders with a specific status . |
| symbol      | String | *[Optional]* Only list orders for a specific symbol.         |
| side        | String | *[Optional]* **buy** or **sell**                             |
| type        | String | *[Optional]* **limit**, **market**, **limit_stop** or **market_stop** |
| tradeType   | String | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading). |
| startAt     | long   | *[Optional]*  Start time (milisecond)                        |
| endAt       | long   | *[Optional]* End time (milisecond)                           |
| currentPage | Int    | *[Optional]* current page                                    |
| orderIds    | String | *[Optional]* comma seperated order ID list                   |
| pageSize    | Int    | *[Optional]* page size                                       |

### RESPONSES

| Field       | Description                                                  |
| ----------- | ------------------------------------------------------------ |
| id          | Order ID, the ID of an order.                                |
| symbol      | Symbol                                                       |
| userId      | User ID                                                      |
| type        | Order type                                                   |
| side        | transaction direction,include buy and sell                   |
| price       | order price                                                  |
| size        | order quantity                                               |
| funds       | order funds                                                  |
| stp         | self trade prevention                                        |
| timeInForce | time InForce,include GTC,GTT,IOC,FOK                         |
| cancelAfter | cancel orders after n seconds，requires timeInForce to be GTT |
| postOnly    | postOnly                                                     |
| hidden      | hidden order                                                 |
| iceberg     | Iceberg order                                                |
| visibleSize | displayed quantity for iceberg order                         |
| channel     | order source                                                 |
| clientOid   | user-entered order unique mark                               |
| remark      | Remarks                                                      |
| tags        | tag order source                                             |
| tradeType   | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading). |
| feeCurrency | The currency of the fee                                      |
| createdAt   | order creation time                                          |
| stop        | Stop order type, include loss and entry                      |
| stopPrice   | stop price                                                   |


## Get Single Order by clientOid

Request via this interface to get a stop order information via the clientOid.

### HTTP Request

**GET /api/v1/stop-order/queryOrderByClientOid**

### Example

GET /api/v1/stop-order/queryOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

| Param     | Type   | Description                                                  |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | String | Unique order id created by users to identify their orders    |
| symbol    | String | [Optional] Unique order id created by users to identify their orders |

### RESPONSES

| Field       | Description                                                  |
| ----------- | ------------------------------------------------------------ |
| id          | Order ID, the ID of an order.                                |
| symbol      | Symbol                                                       |
| userId      | User ID                                                      |
| type        | Order type                                                   |
| side        | transaction direction,include buy and sell                   |
| price       | order price                                                  |
| size        | order quantity                                               |
| funds       | order funds                                                  |
| stp         | self trade prevention                                        |
| timeInForce | time InForce,include GTC,GTT,IOC,FOK                         |
| cancelAfter | cancel orders after n seconds，requires timeInForce to be GTT |
| postOnly    | postOnly                                                     |
| hidden      | hidden order                                                 |
| iceberg     | Iceberg order                                                |
| visibleSize | displayed quantity for iceberg order                         |
| channel     | order source                                                 |
| clientOid   | user-entered order unique mark                               |
| remark      | Remarks                                                      |
| tags        | tag order source                                             |
| tradeType   | The type of trading : **TRADE**（Spot Trading）, **MARGIN_TRADE** (Margin Trading). |
| feeCurrency | The currency of the fee                                      |
| createdAt   | order creation time                                          |
| stop        | Stop order type, include loss and entry                      |
| stopPrice   | stop price                                                   |


## Cancel Single Order by clientOid

Request via this interface to cancel a stop order via the clientOid.

### HTTP REQUEST

**DELETE /api/v1/stop-order/cancelOrderByClientOid**

### Example

DELETE /api/v1/stop-order/cancelOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

| Param     | Type   | Description                                                  |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | String | Unique order id created by users to identify their orders    |
| symbol    | String | [Optional] Unique order id created by users to identify their orders |

### RESPONSES

| Field            | Description                                               |
| ---------------- | --------------------------------------------------------- |
| cancelledOrderId | Order ID of cancelled order                               |
| clientOid        | Unique order id created by users to identify their orders |


# 

# Market Data

Signature is not required for this part

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
        "enableTrading": true,
        "isMarginEnabled": true,
        "priceLimitRate": "0.1"
    }
]
```

Request via this endpoint to get a list of available currency pairs for trading.
If you want to get the market information of the trading symbol, please use [Get All Tickers](#get-all-tickers).

### HTTP REQUEST
**GET /api/v1/symbols**

### Example
GET /api/v1/symbols

### PARAMETERS
You can query all symbols through *market* parameter.

Param | Type | Description
--------- | ------- | -----------
market | String |*[Optional]* The [trading market](#get-market-list).

###RESPONSES

Field |  Description
--------- | -----------
symbol | unique code of a symbol, it would not change after renaming
name | Name of trading pairs, it would change after renaming
baseCurrency |  Base currency,e.g. BTC.
quoteCurrency |  Quote currency,e.g. USDT.
baseMinSize |  The minimum order quantity requried to place an order.
quoteMinSize | The minimum order funds required to place a market order.
baseMaxSize |  The maximum order size required to place an order.
quoteMaxSize | The maximum order funds  required to place a market order.
baseIncrement |The increment of the order size. The value shall be a positive multiple of the baseIncrement.
quoteIncrement | The increment of the funds required to place a market order. The value shall be a positive multiple of the quoteIncrement.
priceIncrement |  The increment of the price required to place a limit order. The value shall be a positive multiple of the priceIncrement.
feeCurrency | The currency of charged fees.
enableTrading |  Available for transaction or not.
isMarginEnabled |  Available for margin or not.
priceLimitRate | Threshold for price portection

The **baseMinSize** and **baseMaxSize** fields define the min and max order size. The **priceIncrement** field specifies the min order price as well as the price increment.This also applies to **quote** currency.

The order price must be a positive integer multiple of this priceIncrement (i.e. if the increment is 0.01, the  0.001 and 0.021 order prices would be rejected).

**priceIncrement** and **quoteIncrement** may be adjusted in the future. We will notify you by email and site notifications before adjustment.



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

Request via this endpoint to get Level 1 Market Data. The returned value includes the best bid price and size, the best ask price and size as well as the last traded price and the last traded size.

### HTTP REQUEST
**GET /api/v1/market/orderbook/level1**


### Example
GET /api/v1/market/orderbook/level1?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String |[symbol](#get-symbols-list)


### RESPONSES
Field |  Description
--------- | -----------
sequence | Sequence
bestAsk |  Best ask price
size | Last traded size
price |  Last traded price
bestBidSize | Best bid size
bestBid | Best bid price
bestAskSize |  Best ask size
time |  timestamp



<aside class="spacer2"></aside>


## Get All Tickers

```json
{
    "time":1602832092060,
    "ticker":[
        {
            "time": 1602832092060,	// time
            "symbol": "BTC-USDT",	// symbol
            "symbolName":"BTC-USDT", // Name of trading pairs, it would change after renaming
            "buy": "11328.9",	// bestAsk
            "sell": "11329",	// bestBid
            "changeRate": "-0.0055",	// 24h change rate
            "changePrice": "-63.6",	// 24h change price
            "high": "11610",	// 24h highest price
            "low": "11200",	// 24h lowest price
            "vol": "2282.70993217",	// 24h volume，the aggregated trading volume in BTC
            "volValue": "25984946.157790431",	// 24h total, the trading volume in quote currency of last 24 hours
            "last": "11328.9",	// last price
            "averagePrice": "11360.66065903",	// 24h average transaction price yesterday
            "takerFeeRate": "0.001",	// Basic Taker Fee
            "makerFeeRate": "0.001",	// Basic Maker Fee
            "takerCoefficient": "1",	// Taker Fee Coefficient
            "makerCoefficient": "1"	// Maker Fee Coefficient
        }
    ]
}
```

Request market tickers for all the trading pairs in the market (including 24h volume).

On the rare occasion that we will change the currency name, if you still want the changed symbol name, you can use the symbolName field instead of the symbol field via “Get all tickers” endpoint.

### HTTP REQUEST
**GET /api/v1/market/allTickers**


### RESPONSES
Field |  Description
--------- | -----------
time |  timestamp
symbol | Symbol
symbolName | Name of trading pairs, it would change after renaming
buy |  Best bid price
sell | Best ask price
changeRate |  24h change rate
changePrice | 24h change price
high | Highest price in 24h
low |  Lowest price in 24h
vol | 24h volume, executed based on base currency
volValue | 24h traded amount
last | Last traded price
averagePrice | Average trading price in the last 24 hours
takerFeeRate | Basic Taker Fee
makerFeeRate | Basic Maker Fee
takerCoefficient | Taker Fee Coefficient
makerCoefficient | Maker Fee Coefficient
<aside class="spacer2"></aside>

## Get 24hr Stats

```json
//Get 24hr Stats
{
    "time": 1602832092060,	// time
    "symbol": "BTC-USDT",	// symbol
    "buy": "11328.9",	// bestAsk
    "sell": "11329",	// bestBid
    "changeRate": "-0.0055",	// 24h change rate
    "changePrice": "-63.6",	// 24h change price
    "high": "11610",	// 24h highest price
    "low": "11200",	// 24h lowest price
    "vol": "2282.70993217",	// 24h volume，the aggregated trading volume in BTC
    "volValue": "25984946.157790431",	// 24h total, the trading volume in quote currency of last 24 hours
    "last": "11328.9",	// last price
    "averagePrice": "11360.66065903",	// 24h average transaction price yesterday
    "takerFeeRate": "0.001",	// Basic Taker Fee
    "makerFeeRate": "0.001",	// Basic Maker Fee
    "takerCoefficient": "1",	// Taker Fee Coefficient
    "makerCoefficient": "1"	// Maker Fee Coefficient
}
```

Request via this endpoint to get the statistics of the specified ticker in the last 24 hours.

### HTTP REQUEST
**GET /api/v1/market/stats**

### Example
GET /api/v1/market/stats?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)


### RESPONSES
Field |  Description
--------- | -----------
time |  timestamp
symbol | Symbol
buy |  Best bid price
sell | Best ask price
changeRate |  24h change rate
changePrice | 24h change price
high | Highest price in 24h
low |  Lowest price in 24h
vol | 24h volume, executed based on base currency
volValue | 24h traded amount
last | Last traded price
averagePrice | Average trading price in the last 24 hours
takerFeeRate | Basic Taker Fee
makerFeeRate | Basic Maker Fee
takerCoefficient | Taker Fee Coefficient
makerCoefficient | Maker Fee Coefficient
<aside class="spacer2"></aside>

## Get Market List

```json
//Get Market List
{
	"data":[

    "BTC",
    "KCS",
    "USDS",  //SC has been changed to USDS
    "ALTS" //ALTS market includes ETH, NEO, TRX
  ]
}
```

Request via this endpoint to get the transaction currency for the entire trading market.

<aside class="notice">SC has been changed to USDS, but you can still use SC as a query parameter</aside>
<aside class="notice">The three markets of ETH, NEO and TRX are merged into the ALTS market. You can query the trading pairs of the ETH, NEO and TRX markets through the ALTS trading area.</aside>

### HTTP REQUEST
**GET /api/v1/markets**

### Example
GET /api/v1/markets


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

Request via this endpoint to get a list of open orders for a symbol.

Level-2 order book includes all bids and asks (aggregated by price), this level returns only one size for each active price (as if there was only a single order for that price).

Query via this endpoint and the system will return only part of the order book to you. If you request level2_20, the system will return you 20 pieces of data (ask and bid data) on the order book. If you request level_100, the system will return 100 pieces of data (ask and bid data) on the order book to you. You are recommended to request via this endpoint as the system reponse would be faster and cosume less traffic.


To maintain up-to-date Order Book, please use [Websocket](#level-2-market-data) incremental feed after retrieving the Level 2 snapshot.



### HTTP REQUEST

**GET /api/v1/market/orderbook/level2_20**

**GET /api/v1/market/orderbook/level2_100**

### Example
GET /api/v1/market/orderbook/level2_20?symbol=BTC-USDT
GET /api/v1/market/orderbook/level2_100?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Timestamp
bids | bids
asks | asks

### Data Sort

**Asks**: Sort price from low to high

**Bids**: Sort price from high to low



## Get Full Order Book(aggregated) [Deprecated]

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

Request via this endpoint to get the order book of the specified symbol.

Level 2 order book includes all bids and asks (aggregated by price). This level returns only one aggregated size for each price (as if there was only one single order for that price).

This API will return data with **full** depth.

It is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date Order Book, please use [Websocket](#level-2-market-data) incremental feed after retrieving the Level 2 snapshot.


### HTTP REQUEST

**GET /api/v2/market/orderbook/level2**  (Recommend)

### Example
GET /api/v2/market/orderbook/level2?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Timestamp
bids | bids
asks | asks

### Data Sor

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

Request via this endpoint to get the order book of the specified symbol.

Level 2 order book includes all bids and asks (aggregated by price). This level returns only one aggregated size for each price (as if there was only one single order for that price).

This API will return data with **full** depth.

It is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date Order Book, please use [Websocket](#level-2-market-data) incremental feed after retrieving the Level 2 snapshot.


### HTTP REQUEST

**GET /api/v3/market/orderbook/level2**  (Recommend)

### Example
GET /api/v3/market/orderbook/level2?symbol=BTC-USDT

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Timestamp
bids | bids
asks | asks

### Data Sor

**Asks**: Sort price from low to high

**Bids**: Sort price from high to low

## Get Full Order Book(atomic) [Deprecated]


```json
{
    "data": {

        "sequence": 1573503933086,
        "asks": [
            [
                "5e0d672c1f311300093ac522",   //orderId
                "0.1917",                     //price
                "390.9275",                   //size
                1577936689346546088           //time,nanoseconds
            ],
            [
                "5e0d672891432f000819ecc3",
                "0.19171",
                "1456.1316",
                1577936685718811031
            ]
        ],
        "bids": [
            [
                "5e0d672cdc53860007f30262",
                "0.19166",
                "178.1936",
                1577936689166023452
            ],
            [
                "5e0d671a91432f000819d1b0",
                "0.19165",
                "583.6298",
                1577936671595901518
            ]
        ],
        "time": 1577936689346546088
    }
}
```
Request via this endpoint to get the Level 3 order book of the specified trading pair. Level 3 order book includes all bids and asks (the data is non-aggregated, and each item means a single order).


This API is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date order book, please use [Websocket](#full-matchengine-data-revision-level-nbsp-3) incremental feed after retrieving the Level 3 snapshot.

If you do not use Level-3 to build incremental order book, we suggest you do not use this endpoint because of a large latency, which is only applicable to Level-3 incremental construction.

In the orderbook, the selling data is sorted low to high by price and orders with the same price are sorted in time sequence. The buying data is sorted high to low by price and orders with the same price are sorted in time sequence. The matching engine will match the orders according to the price and time sequence.


### HTTP REQUEST
**GET /api/v2/market/orderbook/level3**

### Example
GET GET /api/v2/market/orderbook/level3?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Timestamp, nanoseconds
bids | bids
asks | asks

### Data Sort

**Asks**: Sort price from low to high

**Bids**: Sort price from high to low

<aside class="spacer4"></aside>

## Get Full Order Book(atomic)


```json
{
    "data": {

        "sequence": 1573503933086,
        "asks": [
            [
                "5e0d672c1f311300093ac522",   //orderId
                "0.1917",                     //price
                "390.9275",                   //size
                1577936689346546088           //time,nanoseconds
            ],
            [
                "5e0d672891432f000819ecc3",
                "0.19171",
                "1456.1316",
                1577936685718811031
            ]
        ],
        "bids": [
            [
                "5e0d672cdc53860007f30262",
                "0.19166",
                "178.1936",
                1577936689166023452
            ],
            [
                "5e0d671a91432f000819d1b0",
                "0.19165",
                "583.6298",
                1577936671595901518
            ]
        ],
        "time": 1577936689346546088
    }
}
```
Request via this endpoint to get the Level 3 order book of the specified trading pair. Level 3 order book includes all bids and asks (the data is non-aggregated, and each item means a single order).


This API is generally used by professional traders because it uses more server resources and traffic, and we have strict access frequency control.

To maintain up-to-date order book, please use [Websocket](#full-matchengine-data-revision-level-nbsp-3) incremental feed after retrieving the Level 3 snapshot.

If you do not use Level-3 to build incremental order book, we suggest you do not use this endpoint because of a large latency, which is only applicable to Level-3 incremental construction.

In the orderbook, the selling data is sorted low to high by price and orders with the same price are sorted in time sequence. The buying data is sorted high to low by price and orders with the same price are sorted in time sequence. The matching engine will match the orders according to the price and time sequence.


### HTTP REQUEST
**GET /api/v3/market/orderbook/level3**

### Example
GET GET /api/v3/market/orderbook/level3?symbol=BTC-USDT

### API KEY PERMISSIONS
This endpoint requires the **"General"** permission.

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Timestamp, nanoseconds
bids | bids
asks | asks

### Data Sort

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
Request via this endpoint to get the trade history of the specified symbol.


### HTTP REQUEST
**GET /api/v1/market/histories**

### Example
GET /api/v1/market/histories?symbol=BTC-USDT

### PARAMETERS

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)

### RESPONSES

Field |  Description
--------- | -----------
sequence | Sequence number
time | Transaction time
price | Filled price
size |  Filled amount
side | Filled side. The filled side is set to the taker by default


###SIDE
The trade side indicates the taker order side. A taker order is the order that was matched with orders opened on the order book.

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
Request via this endpoint to get the kline of the specified symbol. Data are returned in grouped buckets based on requested type.


<aside class="notice"> Klines data may be incomplete. No data is published for intervals where there are no ticks.</aside>

<aside class="warning"> Klines should not be polled frequently. If you need real-time information, use the trade and book endpoints along with the websocket feed.</aside>

### HTTP REQUEST
**GET /api/v1/market/candles**

### Example
GET /api/v1/market/candles?type=1min&symbol=BTC-USDT&startAt=1566703297&endAt=1566789757

Param | Type | Description
--------- | ------- | -----------
symbol | String | [symbol](#get-symbols-list)
startAt| long | *[Optional]*  Start time (second), default is 0
endAt| long | *[Optional]* End time (second), default is 0
type | String |Type of candlestick patterns: **1min, 3min, 5min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week**

<aside class="notice">For each query, the system would return at most **1500** pieces of data. To obtain more data, please page the data by time.</aside>

### RESPONSES

Field |  Description
--------- | -----------
time | Start time of the candle cycle
open |  Opening price
close | Closing price
high | Highest price
low | Lowest price
volume |Transaction volume
turnover | Transaction amount



# Currencies


## Get Currencies

```json

[
    {
        "currency": "BTC",
        "name": "BTC",
        "fullName": "Bitcoin",
        "precision": 8,
        "withdrawalMinSize": "0.002",
        "withdrawalMinFee": "0.0005",
        "isWithdrawEnabled": true,   
        "isDepositEnabled": true,
        "isMarginEnabled": true,
       "isDebitEnabled": true
    },
    {
        "currency": "ETH",
        "name": "ETH",
        "fullName": "Ethereum",
        "precision": 8,
        "withdrawalMinSize": "0.02",
        "withdrawalMinFee": "0.01",
        "isWithdrawEnabled": true,
        "isDepositEnabled": true,
        "isMarginEnabled": true,
        "isDebitEnabled": true
    }
]

```

Request via this endpoint to get the currency list.

<aside class="notice">Not all currencies currently can be used for trading.</aside>


### HTTP REQUEST
**GET /api/v1/currencies**

### Example
GET /api/v1/currencies

### RESPONSES

|Field | Description|
|-----|-------------|
|currency| A unique currency code that will never change|
|name| Currency name, will change after renaming|
|fullName| Full name of a currency, will change after renaming |
|precision| Currency precision |
|withdrawalMinSize| Minimum withdrawal amount |
|withdrawalMinFee|  Minimum fees charged for withdrawal |
|isWithdrawEnabled| Support withdrawal or not |
|isDepositEnabled| Support deposit or not |
|isMarginEnabled| Support margin or not |
|isDebitEnabled| Support debit or not |
|confirms| Number of block confirmations|

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


```json
{
    "currency": "BTC",
    "name": "BTC",
    "fullName": "Bitcoin",
    "precision": 8,
    "withdrawalMinSize": "0.002",
    "withdrawalMinFee": "0.0005",
    "isWithdrawEnabled": true,
    "isDepositEnabled": true,
    "isMarginEnabled": true,
    "isDebitEnabled": true
  }
```
Request via this endpoint to get the currency details of a specified currency

### HTTP REQUEST
**GET /api/v1/currencies/{currency}**

### Example
GET /api/v1/currencies/BTC

<aside class="notice">Details of the currency.</aside>

### PARAMETERS
Param | Type | Description
--------- | ------- | -----------
currency | String | **Path parameter**. [Currency](#get-currencies)
chain | String | *[Optional]* Support for querying the chain of currency, e.g. The available value for USDT are OMNI, ERC20, TRC20. This only apply for multi-chain currency, and there is no need for single chain currency.

### RESPONSES

|Field | Description|
|-----|-------------|
|currency| A unique currency code that will never change|
|name| Currency name, will change after renaming |
|fullName| Full name of a currency, will change after renaming |
|precision| Currency precision |
|withdrawalMinSize| Minimum withdrawal amount |
|withdrawalMinFee| Minimum fees charged for withdrawal |
|isWithdrawEnabled| Support withdrawal or not |
|isDepositEnabled| Support deposit or not |
|isMarginEnabled| Support margin or not |
|isDebitEnabled| Support debit or not |
|confirms| Number of block confirmations|

## Get Fiat Price



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
Request via this endpoint to get the fiat price of the currencies for the available trading pairs.  

### HTTP REQUEST
**GET /api/v1/prices**

### Example
GET /api/v1/prices

### PARAMETERS
|Param | Type | Description|
|--------- | ------- | -----------|
| base | String |*[Optional]* Ticker symbol of a base currency,eg.USD,EUR. Default is USD |
| currencies | String |*[Optional]* Comma-separated cryptocurrencies to be converted into fiat, e.g.: BTC,ETH, etc. Default to return the fiat price of all currencies.|


# Margin Trade

# Margin Info

## Get Mark Price


```json
{
    "symbol": "USDT-BTC",
    "granularity": 5000,
    "timePoint": 1568701710000,
    "value": 0.00009807
}
```

Request via this endpoint to get the index price of the specified symbol.

### HTTP REQUEST

**GET /api/v1/mark-price/{symbol}/current**

### Example

GET /api/v1/mark-price/USDT-BTC/current

### PARAMETERS

|Param | Type | Description|
|--------- | ------- | -----------|
| symbol | String | **Path parameter.** [symbol](#get-symbols-list) |

### RESPONSES

|Field        | Description                    |
|------------ |--------------------------------|
| symbol      | symbol                         |
| granularity | Data granularity (millisecond) |
| timePoint   | Time (millisecond)             |
| value       | Mark price    |

The following ticker symbols are supported: USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC, DIA-BTC, VET-BTC, DASH-BTC, DOT-BTC, XTZ-BTC, ZEC-BTC, BCHSV-BTC, ADA-BTC, ATOM-BTC, LINK-BTC, LUNA-BTC, NEO-BTC, UNI-BTC, ETC-BTC, BNB-BTC, TRX-BTC, XLM-BTC

## Get Margin Configuration Info

```json
{
    "currencyList": ["BTC","USDT","EOS"],
    "warningDebtRatio": "0.8",
    "liqDebtRatio": "0.9",
    "maxLeverage": "3"
  }
```

Request via this endpoint to get the configure info of the margin.

### HTTP REQUEST

**GET /api/v1/margin/config**

### Example

GET /api/v1/margin/config


### RESPONSES

|Field | Description|
|----- |-------------|
| currencyList | Available currencies for margin trade |
| warningDebtRatio | The warning debt ratio of the forced liquidation |
| liqDebtRatio | The debt ratio of the forced liquidation |
| maxLeverage | Max leverage available |

## Get Margin Account

```json
{
    "accounts": [
      {
        "availableBalance": "990.11",
        "currency": "USDT",
        "holdBalance": "7.22",
        "liability": "66.66",
        "maxBorrowSize": "88.88",
        "totalBalance": "997.33"
      }
    ],
    "debtRatio": "0.33"
  }

```
Request via this endpoint to get the info of the margin account.


### HTTP REQUEST

**GET /api/v1/margin/account**

### Example

GET /api/v1/margin/account

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

### RESPONSES

|Field | Description|
|----- |-------------|
| accounts | Margin account list |
| debtRatio | Debt ratio |
| currency | Currency |
| totalBalance | Total funds in the account |
| availableBalance | Available funds in the account |
| holdBalance | Funds on hold in the account |
| liability | Total liabilities |
| maxBorrowSize | Available size to borrow |

# Borrow & Lend

## Post Borrow Order

```json
{
    "orderId": "a2111213",
    "currency": "USDT"
}
```



### HTTP REQUEST

**POST /api/v1/margin/borrow**

### Example

POST /api/v1/margin/borrow

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description|
|--------- | ------- | -----------|
| currency | String | Currency to Borrow |
| type | String | Type: FOK, IOC |
| size | BigDecimal | Total size |
| maxRate | BigDecimal | *[Optional]* The max interest rate. All interest rates are acceptable if this field is left empty.|
| term | String | *[Optional]* Term (Unit: Day). All terms are acceptable if this field is left empty. Please note to separate the terms via comma. For example, 7,14,28.|


<aside class="notice">Available terms currently supported: 7, 14, 28</aside>

### RESPONSES

|Field | Description|
|----- |-------------|
| orderId | Borrow order ID |
| currency | Currency to borrow  |

## Get Borrow Order     


```json
{
    "orderId": "a2111213",
    "currency": "USDT",
    "size": "1.009",
    "filled": 1.009,
    "matchList": [
      {
        "currency": "USDT",
        "dailyIntRate": "0.001",
        "size": "12.9",
        "term": 7,
        "timestamp": "1544657947759",
        "tradeId": "1212331"
      }
    ],
    "status": "DONE"
  }

```

Request via this endpoint to get the info of the borrow order through the **orderId** retrieved from [Post Borrow Order](#post-borrow-order) .


### HTTP REQUEST

**GET /api/v1/margin/borrow**

### Example

GET /api/v1/margin/borrow?orderId=123456789

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description|
|--------- | ------- | -----------|
| orderId | String | Borrow order ID |

### RESPONSES

|Field | Description|
|----- |-------------|
| orderId      | Borrow order ID |
| currency | Currency |
| size | Total size  |
| filled | Size executed |
| status | Status. DONE (Canceled or Filled),PROCESSING |
| matchList | Execution details |
| tradeId | Trade ID| |
| dailyIntRate | Daily interest rate |
| term | Term |
| timestamp | Borrow time|

## Get Repay Record


```json
{
    "currentPage": 0,
    "pageSize": 0,
    "totalNum": 0,
    "totalPage": 0,
    "items": [
        {
            "tradeId": "1231141",
            "currency": "USDT",
            "accruedInterest": "0.22121",
            "dailyIntRate": "0.0021",
            "liability": "1.32121",
            "maturityTime": "1544657947759",
            "principal": "1.22121",
            "repaidSize": "0",
            "term": 7,
            "createdAt": "1544657947759"
        }
    ]
  }
```


### HTTP REQUEST

**GET /api/v1/margin/borrow/outstanding**

### Example

GET /api/v1/margin/borrow/outstanding

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

<aside class="notice">This request is paginated.</aside>

### PARAMETERS

|Param | Type | Description|
|--------- | ------- | -----------|
| currency | String |  *[Optional]* Currency. All currencies will be quried if this field is not required. |

### RESPONSES

|Field | Description|
|----- |-------------|
| tradeId | Trade ID |
| currency  | Currency |
| liability | Total liabilities |
| principal | Outstanding principal to repay    |
| accruedInterest | Accrued interest |
| createdAt   | Execution time |
| maturityTime  | Maturity time |
| period       | Period  |
| repaidSize | Repaid size  |
| dailyIntRate | Daily interest rate   |

## Get Repayment Record


```json
{
    "pageSize": 0,
    "totalNum": 0,
    "totalPage": 0,
    "currentPage": 0,
    "items": [
        {
            "tradeId": "1231141",
            "currency": "USDT",
            "dailyIntRate": "0.0021",
            "interest": "0.22121",
            "principal": "1.22121",
            "repaidSize": "0",
            "repayTime": "1544657947759",
            "term": 7
        }
    ]
  }
```


### HTTP REQUEST

**GET /api/v1/margin/borrow/repaid**

### Example

GET /api/v1/margin/borrow/repaid

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

<aside class="notice">This request is paginated.</aside>

### PARAMETERS

|Param | Type | Description|
|--------- | ------- | -----------|
| currency | String | *[Optional]* Currency. All currencies will be quried if this field is not required. |

### RESPONSES

|Field | Description|
|----- |-------------|
| tradeId | Trade ID |
| currency       | Currency |
| interest   | Interest |
| principal  | Principal |
| repayTime | Repayment time|
| term   | Term  |
| repaidSize | Repaid size |
| dailyIntRate | Daily interest rate |

## One-Click Repayment



### HTTP REQUEST

**POST /api/v1/margin/repay/all**

### Example

POST /api/v1/margin/repay/all

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | Currency |
| sequence | String | Repayment strategy. RECENTLY_EXPIRE_FIRST: Time priority, namely to repay the loans of the nearest maturity time first, HIGHEST_RATE_FIRST: Rate Priority: Repay the loans of the highest interest rate first. |
| size | BigDecimal | Repayment size |

### RESPONSES

A successful repayment response is indicated by an HTTP status code 200 and system code 200000. If the system returns other code, it means the repayment fails.

## Repay a Single Order


Request via this endpoint to repay a single order.


### HTTP REQUEST

**POST /api/v1/margin/repay/single**

### Example

POST /api/v1/margin/repay/single

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | Currncy |
| tradeId | String | Trade ID |
| size | BigDecimal | Repayment size |

### RESPONSES

A successful repayment response is indicated by an HTTP status code 200 and system code 200000. If the system returns other code, it means the repayment fails.

## Post Lend Order


```json
{
	"orderId": "5da5a4f0f943c040c2f8501e"
}
```

Request via this endpoint to post lend order.


Please ensure that you have sufficient funds in your Main Account before you post the order. Once the post succeed, the funds posted will be frozen until the order is succssfuly lent out or cancelled.

### HTTP REQUEST

**POST /api/v1/margin/lend**

### Example

POST /api/v1/margin/lend

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency     | String | Currency to lend   |
| size         | String | Total size     |
| dailyIntRate | String | Daily interest rate. e.g. 0.002 is 0.2% |
| term         | int    | Term (Unit: Day)    |

### RESPONSES

|Field | Description|
|----- |-------------|
| orderId | Lend order ID |

## Cancel Lend Order

Request via this endpoint to cancel lend order.

### HTTP REQUEST

**DELETE /api/v1/margin/lend/{orderId}**

### Example

DELETE /api/v1/margin/lend/5d9f133ef943c0882ca37bc8

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| orderId  | String | Lend order ID |

## Set Auto-lend

Request via this endpoint to set up the automatic lending for a specified currency.


### HTTP REQUEST

**POST /api/v1/margin/toggle-auto-lend**

### Example

POST /api/v1/margin/toggle-auto-lend

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency     | String  | Currency                                        |
| isEnable     | boolean | Auto-lend enabled or not                                |
| retainSize   | String  | Reserved size in main account. Required when **isEnable** is true.   |
| dailyIntRate | String  | acceptable min. day rate, 0.002 is 0.2%. Required when **isEnable** is true.     |
| term         | int     | Term (Unit: Day). Required when **isEnable** is true.            |

###Advanced Description

###dailyIntRate

When the priority interest rate is higher than the acceptable min. day rate, the system will place lending orders at the rate of the former one. The priority interest rate is the optimal market rate for all pending orders of the selected lending period, orders with this interest rate will be prioritized for auto-lending.

When the priority interest rate is lower than the acceptable min. day rate, the system will place lending orders at the rate of the latter one.


## Get Active Order


```json
{
	  "currentPage": 1,
	  "pageSize": 1,
	  "totalNum": 1,
	  "totalPage": 1,
	  "items": [
        {
            "orderId": "5da59f5ef943c033b2b643e4",
            "currency": "BTC",
            "size": "0.51",
            "filledSize": "0",
            "dailyIntRate": "0.0001",
            "term": 7,
            "createdAt": 1571135326913
        }
    ]
}
```

Request via this endpoint to get active lend orders. Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page. The max pageSize is 100.

Active lend orders include orders unfilled, partially filled and uncanceled.

### HTTP REQUEST

**GET /api/v1/margin/lend/active**

### Example

GET /api/v1/margin/lend/active?currency=BTC&currentPage=1&pageSize=50

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | *[Optional]*  Currency |

### RESPONSES

|Field | Description|
|----- |----------------------------------|
| orderId      | Lend order ID           |
| currency     | Currency                |
| size         | Total size            |
| filledSize   | Size executed               |
| dailyIntRate | Daily interest rate. e.g. 0.002 is 0.2% |
| term         | Term (Unit: Day)           |
| createdAt    | Time of the event (millisecond)       |

## Get Lent History



```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "orderId": "5da59f5bf943c033b2b643da",
            "currency": "BTC",
            "size": "0.51",
            "filledSize": "0.51",
            "dailyIntRate": "0.0001",
            "term": 7,
            "status": "FILLED",
            "createdAt": 1571135323984
        }
    ]
}
```

Request via this endpoint to get lent orders . Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page. The max pageSize is 100.

Lent order history involves orders canceled or fully filled.

### HTTP REQUEST

**GET /api/v1/margin/lend/done**

### Example

GET /api/v1/margin/lend/done?currency=BTC&currentPage=1&pageSize=50

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | *[Optional]* Currency |

### RESPONSES

|Field | Description|
|----- |----------------------------------|
| orderId      | Lend order ID                     |
| currency     | Currency                          |
| size         | Total size                      |
| filledSize   | Size executed                         |
| dailyIntRate | Daily interest rate. e.g. 0.002 is 0.2%    |
| term         | Term (Unit: Day)                     |
| createdAt    | Time of the event (millisecond)      |
| status       | Order status: FILLED -- Fully filled, CANCELED -- Canceled |

## Get Active Lend Order List


```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "tradeId": "5da6dba0f943c0c81f5d5db5",
            "currency": "BTC",
            "size": "0.51",
            "accruedInterest": "0",
            "repaid": "0.10999968",
            "dailyIntRate": "0.0001",
            "term": 14,
            "maturityTime": 1572425888958
        }
    ]
}
```

Request via this endpoint to get the outstanding lend order list. Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page. The max pageSize is 100.

When a lending order is executed, the system will generate the lending history. The outstanding lend orders includes orders unrepaid and partially repaid.

### HTTP REQUEST

**GET /api/v1/margin/lend/trade/unsettled**

### Example

GET /api/v1/margin/lend/trade/unsettled?currency=BTC&currentPage=1&pageSize=50

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | *[Optional]* Currency |

### RESPONSES

|Field | Description|
|----- |----------------------------------|
| tradeId         | Trade ID                                             |
| currency        | Currency                                             |
| size            | Size executed                                            |
| accruedInterest | Accrued interest. This value will decrease when borrower repays the interest. |
| repaid          | Repaid size                                          |
| dailyIntRate    | Daily interest rate. e.g. 0.002 is 0.2%              |
| term            | Term (Unit: Day)                                     |
| maturityTime    |  Maturity time  (millisecond)                        |

## Get Settled Lend Order History


```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "tradeId": "5da59fe6f943c033b2b6440b",
            "currency": "BTC",
            "size": "0.51",
            "interest": "0.00004899",
            "repaid": "0.510041641",
            "dailyIntRate": "0.0001",
            "term": 7,
            "settledAt": 1571216254767,
            "note": "The account of the borrowers reached a negative balance, and the system has supplemented the loss via the insurance fund. Deposit funds: 0.51."
        }
    ]
}
```

Request via this endpoint to get the settled lend orders . Items are paginated and sorted to show the latest first. See the Pagination section for retrieving additional entries after the first page. The max pageSize is 100.

The settled lend orders include orders repaid fully or partially before or at the maturity time.


### HTTP REQUEST

**GET /api/v1/margin/lend/trade/settled**

### Example

GET /api/v1/margin/lend/trade/settled?currency=BTC&currentPage=1&pageSize=50

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | *[Optional]* Currency |

### RESPONSES

|Field | Description|
|----- |----------------------------------|
| tradeId      | Trade ID                                     |
| currency     | Currency                                     |
| size         | Size executed                                    |
| interest     | Total interest                               |
| repaid       | Repaid size                                  |
| dailyIntRate | Daily interest rate. e.g. 0.002 is 0.2%      |
| term         | Term (Unit: Day)                             |
| settledAt    | Settlement time (millisecond)                |
| note         | Note. To note the account of the borrower reached a negative balance, and whether the insurance fund is repaid. |

## Get Account Lend Record

```json
[
    {
        "currency": "BTC",
        "outstanding": "1.02",
        "filledSize": "0.91000213",
        "accruedInterest": "0.00000213",
        "realizedProfit": "0.000045261",
        "isAutoLend": false
    }
]
```

Request via this endpoint to get the lending history of the main account.



### HTTP REQUEST

**GET /api/v1/margin/lend/assets**

### Example

GET /api/v1/margin/lend/assets?currency=BTC

### API KEY PERMISSIONS

This endpoint requires the **"Trade"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String | *[Optional]* Currency |

### RESPONSES

|Field | Description                      |
|----- |----------------------------------|
| currency        | Currency              |
| outstanding     | Outstanding size       |
| filledSize      | Size executed             |
| accruedInterest | Accrued Interest      |
| realizedProfit  | Realized profit       |
| isAutoLend      | Auto-lend enabled or not |

## Lending Market Data

```json
[
    {
        "dailyIntRate": "0.0001",
        "term": 7,
        "size": "1.02"
    }
]
```

Request via this endpoint to get the lending market data.
The returned value is sorted based on the descending sequence of the daily interest rate and terms.



### HTTP REQUEST

**GET /api/v1/margin/market**

### Example

GET /api/v1/margin/market?currency=BTC&term=7

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String |   Currency    |
| term     | int    | *[Optional]* Term (Unit: Day)   |

### RESPONSES

|Field | Description                      |
|----- |----------------------------------|
| dailyIntRate | Daily interest rate. e.g. 0.002 is 0.2% |
| term         | Term (Unit: Day)                        |
| size         | Total size                              |

## Margin Trade Data

```json
[
    {
        "tradeId": "5da6dba0f943c0c81f5d5db5",
        "currency": "BTC",
        "size": "0.51",
        "dailyIntRate": "0.0001",
        "term": 14,
        "timestamp": 1571216288958989641
    }
]
```

Request via this endpoint to get the last 300 fills in the lending and borrowing market.
The returned value is sorted based on the descending sequence of the order execution time.



### HTTP REQUEST

**GET /api/v1/margin/trade/last**

### Example

GET /api/v1/margin/trade/last?currency=BTC

### API KEY PERMISSIONS

This endpoint requires the **"General"** permission.

### PARAMETERS

|Param | Type | Description |
|--------- | ------- | -----------|
| currency | String |   Currency    |

### RESPONSES

|Field | Description                      |
|----- |----------------------------------|
| tradeId      | Trade ID                                 |
| currency     | Currency                                 |
| size         | Executed size                            |
| dailyIntRate | Daily interest rate. e.g. 0.002 is 0.2%  |
| term         | Term (Unit: Day)                         |
| timestamp    | Time of execution in nanosecond          |


# Others


## Server Time

```json
{  
    "code":"200000",
    "msg":"success",
    "data":1546837113087
}
```

Get the server time.

### HTTP REQUEST
**GET /api/v1/timestamp**

### Example
GET /api/v1/timestamp

<aside class="spacer2"></aside>

## Service Status

```json
{    
  "code": "200000",     
  "data": {

      "status": "open",                //open, close, cancelonly
      "msg":  "upgrade match engine"   //remark for operation
    }
}
```
Get the service status

### HTTP REQUEST
**GET /api/v1/status**

### Example
GET /api/v1/status

### RESPONSES

|Field    | Description                                             |
|-------- |-------------------------------------------------------  |
| status  | Status of service: **open**, **close** or **cancelonly**|
| msg     | Remark for operation                                    |





# Websocket Feed

While there is a strict access frequency control for REST API, we highly recommend that API users utilize Websocket to get the real-time data.


<aside class="notice">The recommended way is to just create a websocket connection and subscribe to multiple channels.
</aside>

## Apply connect token

```json
{
    "code": "200000",
    "data": {

        "instanceServers": [
            {
                "endpoint": "wss://push1-v2.kucoin.com/endpoint",
                "protocol": "websocket",
                "encrypt": true,
                "pingInterval": 50000,
                "pingTimeout": 10000
            }
        ],
        "token": "vYNlCtbz4XNJ1QncwWilJnBtmmfe4geLQDUA62kKJsDChc6I4bRDQc73JfIrlFaVYIAE0Gv2--MROnLAgjVsWkcDq_MuG7qV7EktfCEIphiqnlfpQn4Ybg==.IoORVxR2LmKV7_maOR9xOg=="
    }
}
```

You need to apply for one of the two tokens below to create a websocket connection.

### Public token (No authentication required):

If you only use public channels (e.g. all public market data), please make request as follows to obtain the server list and temporary public token:

#### HTTP REQUEST

**POST /api/v1/bullet-public**

### Private channels (Authentication request required):


For private channels and messages (e.g. account balance notice), please make request as follows after authorization to obtain the server list and authorized token.

#### HTTP REQUEST

**POST /api/v1/bullet-private**


### Response

|Field | Description|
-----|-----
|endpoint| Websocket server address for establishing connection|
|protocol| Protocol supported|
|encrypt| Indicate whether SSL encryption is used |
|pingInterval| Recommended to send ping interval in millisecond|
|pingTimeout| After such a long time(millisecond), if you do not receive pong, it will be considered as disconnected. |
|token| token|

## Create connection

```javascript
var socket = new WebSocket("wss://push1-v2.kucoin.com/endpoint?token=xxx&[connectId=xxxxx]");
```


When the connection is successfully established, the system will send a welcome message.

<aside class="notice">Only when the welcome message is received will the connection be available</aside>

**connectId**: the connection id, a unique value taken from the client side. Both the id of the welcome message and the id of the error message are connectId.

If you only want to receive private messages of the specified topic, please set privateChannel to true when subscribing.

```json
{
    "id":"hQvf8jkno",
    "type":"welcome"
}
```



<aside class="spacer2"></aside>

## Ping
```json
{
    "id":"1545910590801",
    "type":"ping"
}
```


To prevent the TCP link being disconnected by the server, the client side needs to send ping messages every pingInterval time to the server to keep alive the link.

After the ping message is sent to the server, the system would return a pong message to the client side.

If the server has not received any message from the client for a long time, the connection will be disconnected.


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

To subscribe channel messages from a certain server, the client side should send subscription message to the server.

If the subscription succeeds, the system will send ack messages to you, when the response is set as true.


```json
{
    "id":"1545910660739",
    "type":"ack"
}
```
While there are topic messages generated, the system will send the corresponding messages to the client side. For details about the message format, please check the definitions of topics.

### Parameters
#### ID
ID is unique string to mark the request which is same as id property of ack.

#### Topic
The topic you want to subscribe to.

#### PrivateChannel
For some specific topics (e.g. /market/level3), **privateChannel** is available. The default value of **privateChannel** is **False**. If the **privateChannel** is set to **true**, the user will only receive messages related himself on the topic.

#### Response
If the response is set as true, the system will return the ack messages after the subscription succeed.

## UnSubscribe
Unsubscribe from topics you have subscribed to.

```json
{
    "id": "1545910840805",                            //The id should be an unique value
    "type": "unsubscribe",
    "topic": "/market/ticker:BTC-USDT,ETH-USDT",      //Topic needs to be unsubscribed. Some topics support to divisional unsubscribe the informations of multiple trading pairs through ",".
    "privateChannel": false,
    "response": true                                  //Whether the server needs to return the receipt information of this subscription or not. Set as false by default.
}
```

```json
{
    "id": "1545910840805",
    "type": "ack"
}
```

### Parameters

#### ID
Unique string to mark the request.

#### Topic
The topic you want to subscribe.

#### PrivateChannel
If the **privateChannel** is set to **true**, the private topic will be unsubscribed.

#### Response
If the response is set as true, the system would return the ack messages after the unsubscription succeed.

## Multiplex

In one physical connection, you could open different multiplex tunnels to subscribe different **topics** for different data.


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
The sequence field exists in order book, trade history and snapshot messages by default and the Level 3 and Level 2 data works to ensure the full connection of the sequence. If the sequence is non-sequential, please enable the calibration logic.


## General Logic for Message Judgement in Client Side
1.Judge message type. There are three types of messages at present: message (the commonly used messages for push), notice (the notices generally used), and command (consecutive command).

2.Judge messages by topic. You could judge the message type through the topic.

3.Judge messages by subject. For the same type of messages with the same topic, you could judge the type of messages through their subjects.

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

        "sequence":"1545896668986", // Sequence number
        "price":"0.08",             // Last traded price
        "size":"0.011",             //  Last traded amount
        "bestAsk":"0.08",          // Best ask price
        "bestAskSize":"0.18",      // Best ask size
        "bestBid":"0.049",         // Best bid price
        "bestBidSize":"0.036"     // Best bid size
    }
}
```
Subscribe to this topic to get the push of BBO changes. If there is no change within **one second**, it will not be pushed.

It will be pushed per 100ms with the newest BBO. If there was no change compared with last data, it will not be pushed.


Please note that more information may be added to messages from this channel in the near future.


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
Subscribe to this topic to get the push of all market symbols BBO change.


<aside class="spacer2"></aside>
<aside class="spacer4"></aside>


## Symbol Snapshot

```json

{
    "type": "message",
    "topic": "/market/snapshot:KCS-BTC",
    "subject": "trade.snapshot",
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
    }
}
```

Topic: **/market/snapshot:{symbol}**

Subscribe to get snapshot data for a single symbol.

The snapshot data is pushed at **2 seconds** intervals.

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Market Snapshot

```json
{
    "type": "message",
    "topic": "/market/snapshot:BTC",
    "subject": "trade.snapshot",
    "data": {

        "sequence": "1545896669291",
        "data": [
            {

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
          }
       ]
    }
}
```

Topic: **/market/snapshot:{market}**

Subscribe this topic to get the snapshot data of for the entire [market](#get-market-list).


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

1. After receiving the websocket Level 2 data flow, cache the data.
2. Initiate a [REST](#get-full-order-book-aggregated) request to get the snapshot data of Level 2 order book.
3. Playback the cached Level 2 data flow.
4. Apply the new Level 2 data flow to the local snapshot to ensure that the sequence of the new Level 2 update lines up with the sequence of the previous Level 2 data. Discard all the message prior to that sequence, and then playback the change to snapshot.
5. Update the level2 full data based on sequence according to the price and size. If the price is 0, ignore the messages and update the sequence. If the size=0, update the sequence and remove the price of which the size is 0 out of level 2. For other cases, please update the price.


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

Get a snapshot of the order book through a **REST** request ([Get Order Book](#get-part-order-book-aggregated)) to build a local order book. Suppose that data we got is as follows:

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

In the beginning, the sequence of the order book is 16. Discard the feed data of sequence that is below or equals to 16, and apply playback the sequence [17,18] to update the snapshot of the order book. Now the sequence of your order book is 18 and your local order book is up-to-date.

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

## Level2 - 5 best ask/bid orders
```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth5:BTC-USDT",
    "subject": "level2",
    "data": {

	      "asks":[

            ["9989","8"],    //price, size
            ["9990","32"],
            ["9991","47"],
            ["9992","3"],
            ["9993","3"]
        ],
        "bids":[

            ["9988","56"],
            ["9987","15"],
            ["9986","100"],
            ["9985","10"],
            ["9984","10"]
        ],
        "timestamp": 1586948108193
    }
}

```

Topic: **/spotMarket/level2Depth5:{symbol},{symbol}...**

The system will return the 5 best ask/bid orders data, which is the snapshot data of every 100 milliseconds (in other words, the 5 best ask/bid orders data returned every 100 milliseconds in real-time).

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Level2 - 50 best ask/bid orders

```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth50:BTC-USDT",
    "subject": "level2",
    "data": {

	      "asks":[

            ["9993","3"],     //price,size
            ["9992","3"],
            ["9991","47"],
            ["9990","32"],
            ["9989","8"]
        ],
        "bids":[

            ["9988","56"],
            ["9987","15"],
            ["9986","100"],
            ["9985","10"],
            ["9984","10"]
        ]
        "timestamp": 1586948108193
    }
}

```

Topic: **/spotMarket/level2Depth50:{symbol},{symbol}...**

The system will return the 50 best ask/bid orders data, which is the snapshot data of every 100 milliseconds (in other words, the 50 best ask/bid orders data returned every 100 milliseconds in real-time).

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Klines

```json
{
    "type":"message",
    "topic":"/market/candles:BTC-USDT_1hour",
    "subject":"trade.candles.update",
    "data":{

        "symbol":"BTC-USDT",    // symbol
        "candles":[

            "1589968800",   // Start time of the candle cycle
            "9786.9",       // open price
            "9740.8",       // close price
            "9806.1",       // high price
            "9732",         // low price
            "27.45649579",  // Transaction volume
            "268280.09830877"   // Transaction amount
        ],
        "time":1589970010253893337  // now（us）
    }
}
```
Topic: **/market/candles:{symbol}_{type}**

Param |  Description
--------- | -------
symbol | [symbol](#get-symbols-list)
type |  1min, 3min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week


Subscribe to this topic to get K-Line data.


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

Subscribe to this topic to get the matching event data flow of Level 3.

For each order traded, the system would send you the match messages in the following format.

```json
{
    "type":"message",
    "topic":"/market/match:BTC-USDT",
    "subject":"trade.l3match",
    "data":{

        "sequence":"1545896669145",
        "type":"match",
        "symbol":"BTC-USDT",
        "side":"buy",
        "price":"0.08200000000000000000",
        "size":"0.01022222000000000000",
        "tradeId":"5c24c5da03aa673885cd67aa",
        "takerOrderId":"5c24c5d903aa6772d55b371e",
        "makerOrderId":"5c2187d003aa677bd09d5c93",
        "time":"1545913818099033203"
    }
}
```
<aside class="spacer8"></aside>
<aside class="spacer"></aside>


## Full MatchEngine Data(Level 3)


```json
{
    "id":1545910660742,
    "type":"subscribe",
    "topic":"/spotMarket/level3:BTC-USDT",
    "response":true
}
```



Topic: **/spotMarket/level3:{symbol},{symbol}...**

Subscribe this topic to get the updated data for orders and trades.

This channel provides real-time updates on orders and trades. These updates can be applied on to a Level 3 order book snapshot for users to maintain an accurate and up-to-date copy of the exchange order book.

The process to maintain an up-to-date Level 3 order book is described below.

1. Subscribe Topic: /spotMarket/level3:{symbol} to get an up-to-date Level 3 order book data.
2. Queue every messages received over the websocket stream.
3. Make a [REST](#get-full-order-book-atomic-revision) request to get the snapshot data of the order book.
4. Playback queued messages, and discard sequence numbers before or equal to the snapshot sequence number.
5.  Apply playback messages to the snapshot as needed (see below).
6.  After playback is complete, apply real-time stream messages as they arrive.

**Any Open and Match messages will result in changes to the order book.**

### MESSAGE TYPE


The following messages(**RECEIVED**, **OPEN**, **UPDATE**, **MATCH**, **DONE**) are sent over the websocket stream in JSON format after subscribing to this channel:

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### RECEIVED

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"received",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125432,
        "orderId":"5efab07953bdea00089965d2",
        "clientOid":"1593487481000906",
        "ts":1593487481683297666
    }
}

```

When the matching engine receives an order command, the system would send a **received** message to the user.

This will mean that a valid order has been received and is now with an active status. This message is emitted for every single valid order as soon as the matching engine receives it whether it fills immediately or not.

The **received** message does not indicate a resting order on the orderbook. It simply indicates a new incoming order which has been accepted by the matching engine for processing. Received orders may cause **match** messages to follow if they are being filled immediately (i.e if you made a ‘taker’ order). Self-trade prevention may also trigger **change** messages to follow if the order size needs to be adjusted. Orders which are not fully filled or canceled due to self-trade prevention result in an **open** message and become resting orders on the orderbook.

You can filter your orders through clientOid, but it will be posted to L3 message (it may cause your orders strategy to be known for others), it is recommended that you can use UUID as clientOid.

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### OPEN

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"open",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125433,
        "orderId":"5efab07953bdea00089965d2",
        "side":"buy",
        "price":"0.937",
        "size":"0.1",
        "orderTime":1593487481683297666,
        "ts":1593487481683297666
    }
}

```

When the remaining part in a limit order enters the order book, the system will send an **open** message to the user.

This will mean that the order is now open on the order book. This message will only be sent for orders which are not fully filled immediately. remaining_size will indicate how much of the order is unfilled and going on the book.

When receiving a message with price="", size="0", it means this is a hidden order


<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


### DONE

When the matching life cycle of an order ends, the order will no longer be displayed on the order book and the system will send a **done** message to the user.

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"done",
    "data":{

        "symbol":"KCS-USDT",
        "orderId":"5efab07953bdea00089965fa",
        "sequence":1592995125437,
        "reason":"filled",
        "ts":1593487482038606180
    }
}


{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"done",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125434,
        "orderId":"5efab07953bdea00089965d2",
        "reason":"canceled",
        "ts":1593487481893140844
    }
}
```

This will mean that the order is no longer on the order book. The message is sent for all orders for which there was a **received** message. This message can result from an order being canceled or filled. There will be no more messages for this order_id after a **done** message. remain_size indicates how much of the order went unfilled; this will be 0 for filled orders. Market orders will not have a remainSize or price field as they are never on the open order book at a given price.

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### MATCH

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"match",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125436,
        "side":"sell",
        "price":"0.96738",
        "size":"0.1",  // Matching Size
        "remainSize":"2.9",  // Remain Size
        "takerOrderId":"5efab07953bdea00089965fa",
        "makerOrderId":"5efab01453bdea00089959ba",
        "tradeId":"5efab07a4ee4c7000a82d6d9",
        "ts":1593487482038606180
    }
}

```

When two orders become matched, the system will send a match message to user.


The match message indicates that a trade occurred between two orders. The taker order is the one executing immediately after being received and the maker order is a resting order on the book. The side field indicates the taker order side.

Before entering the orderbook, the iceberg or hidden order is the same as the ordinary order when it is matched as taker (it has a takerOrderId).

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### CHANGE

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"update",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125858,
        "orderId":"5efab14d53bdea0008997298",  // Updated Size
        "size":"0.06",
        "ts":1593487696535838711
    }
}

```


When an order is changed due to STP, the system would send a **change** message to the user. This is the result of self-trade prevention adjusting the order size or available funds. Orders can only decrease in size or funds. **change** messages are always sent when an order changes in size; this includes resting orders (**open**) as well as **received** but not yet open orders. **change** messages are also sent when a new market order goes through self trade prevention and the funds for the market order have changed.

### How to manage a local L3 orderbook correctly


1. Use the websocket channel: /market/level3:{symbol} to subscribe to the level3 incremental data and cache all incremental data received.

2.Get the snapshot data of level3 through the rest interface, [REST](#level-3-2) https://api.kucoin.com/api/v1/market/orderbook/level3?symbol={symbol}.

3.Verify the data that you received. The sequence of the snapshot should not be less than the minimum sequence of all increments of the cache. If this condition is not met, start from the first step.

4.Playback all cached incremental data:

4.1 If the sequence of the incremental data is less or equal to the sequence of the current snapshot, discard the incremental data and end the update; otherwise proceed to 4.2.

4.2 If the sequence of incremental data = sequence+1 of the current snapshot, proceed to 4.2.1 logical update, otherwise proceed to step 4.3.

4.2.1 Update the sequence of the current snapshot to the sequence of the incremental data.

4.2.2 If it is a received message, end the update logic (now the received message does not affect the level 3 data).

4.2.3 If it is an open message, add the corresponding buy or sell order built by orderid, price and size.

4.2.4 If it is a done message, remove the buy or sell order corresponding to the orderid.

4.2.5 If it is a change message, modify the number of buy or sell order corresponding to the orderid.

4.2.6 If it is a match message, reduce the number of order corresponding to the markerOrderId.

4.3 In this case, the sequence is not continuous. Perform step 2 and re-pull the snapshot data to ensure that the sequence is not missing.

5.Receive the new incremental data push and go to step 4.

When you maintain a local L3 orderbook data, if you can't fully understand the above examples, you can check the L3 orderbook maintenance case based on the Go language (https://docs.kucoin.com/cn/#level-nbsp-3). This example mainly includes how to update the L3 data under different events, well-maintained orderbook, the data format of the websocket message, etc. The specific link is as follows: L3 SDK

## Index Price

```json
{
  "id": 1545910660740,                              
  "type": "subscribe",
  "topic": "/indicator/index:USDT-BTC",
  "response": true
}
```

Topic: **/indicator/index:{symbol0},{symbol1}...**

Subscribe to this topic to get the index price for the margin trading.

```json
{
    "id":"5c24c5da03aa673885cd67a0",
    "type":"message",
    "topic":"/indicator/index:USDT-BTC",
    "subject":"tick",
    "data":{

        "symbol": "USDT-BTC",
        "granularity": 5000,
        "timestamp": 1551770400000,
        "value": 0.0001092
    }
}
```

The following ticker symbols are supported: USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC

<aside class="spacer8"></aside>
<aside class="spacer4"></aside>

## Mark Price

```json
{
  "id": 1545910660741,                              
  "type": "subscribe",
  "topic": "/indicator/markPrice:USDT-BTC",
  "response": true
}
```

Topic: **/indicator/markPrice:{symbol0},{symbol1}...**

Subscribe to this topic to get the mark price for margin trading.

```json
{
    "id":"5c24c5da03aa673885cd67aa",
    "type":"message",
    "topic":"/indicator/markPrice:USDT-BTC",
    "subject":"tick",
    "data":{

        "symbol": "USDT-BTC",
        "granularity": 5000,
        "timestamp": 1551770400000,
        "value": 0.0001093
    }
}
```
The following ticker symbols are supported: USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC, DIA-BTC, VET-BTC, DASH-BTC, DOT-BTC, XTZ-BTC, ZEC-BTC, BCHSV-BTC, ADA-BTC, ATOM-BTC, LINK-BTC, LUNA-BTC, NEO-BTC, UNI-BTC, ETC-BTC, BNB-BTC, TRX-BTC, XLM-BTC

<aside class="spacer8"></aside>
<aside class="spacer4"></aside>

## Order Book Change

```json
{
  "id": 1545910660742,
  "type": "subscribe",
  "topic": "/margin/fundingBook:BTC",
  "response": true
}
```

Topic: **/margin/fundingBook:{currency0},{currency1}...**


Subscribe to this topic to get the order book changes on margin trade.


```json
{
    "id": "5c24c5da03aa673885cd67ab",
	  "type": "message",
	  "topic": "/margin/fundingBook:BTC",
	  "subject": "funding.update",
	  "data": {

		    "sequence": 1000000,       //Sequence number
		    "currency": "BTC",         //Currency
		    "dailyIntRate": "0.00007",   //Daily interest rate. e.g. 0.002 is 0.2%
		    "annualIntRate": "0.12",     //Annual interest rate. e.g. 0.12 is 12%
		    "term": 7,                 //Term (Unit: Day)    
		    "size": "1017.5",            //Current total size. When this value is 0, remove this record from the order book.
		    "side": "lend",            //Lend or borrow. Currently, only "Lend" is available
		    "ts": 1553846081210004941  //Timestamp (nanosecond)
    }
}
```

<aside class="spacer8"></aside>
<aside class="spacer2"></aside>



# Private Channels

Subscribe to private channels require **privateChannel=“true”**.


## Private Order Change Events

Topic: **/spotMarket/tradeOrders**

This topic will push all change events of your orders.


**Order Status**

“match”: when taker order executes with orders in the order book, the taker order status is “match”;

“open”: the order is in the order book;

“done”: the order is fully executed successfully;


### Message Type

#### open
```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrders",
    "subject":"orderChange",
    "channelType":"private",
    "data":{

        "symbol":"KCS-USDT",
        "orderType":"limit",
        "side":"buy",
        "orderId":"5efab07953bdea00089965d2",
        "type":"open",
        "orderTime":1593487481683297666,
        "size":"0.1",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487481000906",
        "remainSize":"0.1",
        "status":"open",
        "ts":1593487481683297666
    }
}
```
when the order enters into the order book;

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### match
```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrders",
    "subject":"orderChange",
    "channelType":"private",
    "data":{

        "symbol":"KCS-USDT",
        "orderType":"limit",
        "side":"sell",
        "orderId":"5efab07953bdea00089965fa",
        "liquidity":"taker",
        "type":"match",
        "orderTime":1593487482038606180,
        "size":"0.1",
        "filledSize":"0.1",
        "price":"0.938",
        "matchPrice":"0.96738",
        "matchSize":"0.1",
        "tradeId":"5efab07a4ee4c7000a82d6d9",
        "clientOid":"1593487481000313",
        "remainSize":"0",
        "status":"match",
        "ts":1593487482038606180
    }
}
```
when the order has been executed;

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### filled
```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrders",
    "subject":"orderChange",
    "channelType":"private",
    "data":{

        "symbol":"KCS-USDT",
        "orderType":"limit",
        "side":"sell",
        "orderId":"5efab07953bdea00089965fa",
        "type":"filled",
        "orderTime":1593487482038606180,
        "size":"0.1",
        "filledSize":"0.1",
        "price":"0.938",
        "clientOid":"1593487481000313",
        "remainSize":"0",
        "status":"done",
        "ts":1593487482038606180
    }
}
```
when the order has been executed and its status was changed into DONE;

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### canceled
```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrders",
    "subject":"orderChange",
    "channelType":"private",
    "data":{

        "symbol":"KCS-USDT",
        "orderType":"limit",
        "side":"buy",
        "orderId":"5efab07953bdea00089965d2",
        "type":"canceled",
        "orderTime":1593487481683297666,
        "size":"0.1",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487481000906",
        "remainSize":"0",
        "status":"done",
        "ts":1593487481893140844
    }
}
```
when the order has been cancelled and its status was changed into DONE;

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### update
```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrders",
    "subject":"orderChange",
    "channelType":"private",
    "data":{

        "symbol":"KCS-USDT",
        "orderType":"limit",
        "side":"buy",
        "orderId":"5efab13f53bdea00089971df",
        "type":"update",
        "oldSize":"0.1",
        "orderTime":1593487679693183319,
        "size":"0.06",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487679000249",
        "remainSize":"0.06",
        "status":"open",
        "ts":1593487682916117521
    }
}
```
when the order has been updated;

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>

## Account Balance Notice
```json
{
    "type": "message",
	  "topic": "/account/balance",
	  "subject": "account.balance",
    "channelType":"private",
	  "data": {

		    "total": "88", // total balance
		    "available": "88", // available balance
		    "availableChange": "88", // the change of available balance
		    "currency": "KCS", // currency
		    "hold": "0", // hold amount
		    "holdChange": "0", // the change of hold balance
		    "relationEvent": "trade.setted", //relation event
		    "relationEventId": "5c21e80303aa677bd09d7dff", // relation event id
		    "relationContext": {

            "symbol":"BTC-USDT",
            "tradeId":"5e6a5dca9e16882a7d83b7a4", // the trade Id when order is executed
            "orderId":"5ea10479415e2f0009949d54"
        },  // the context of trade event
		"time": "1545743136994" // timestamp
  }
}

```
Topic: **/account/balance**

You will receive this message when an account balance changes. The message contains the details of the change.


### Relation Event

| Type    | Description |
|---------| ----------- |
main.deposit | Deposit
main.withdraw_hold | Hold withdrawal amount
main.withdraw_done | Withdrawal done
main.transfer | Transfer (Main account)
main.other | Other operations (Main account)
trade.hold | Hold (Trade account)
trade.setted | Settlement (Trade account)
trade.transfer | Transfer (Trade account)
trade.other | Other operations (Trade account)
margin.hold | Hold (Margin account)
margin.setted | Settlement (Margin account)
margin.transfer |Transfer (Margin account)
margin.other | Other operations (Margin account)
other | Others

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## Debt Ratio Change

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"debt.ratio",
    "channelType":"private",
    "data": {

        "debtRatio": 0.7505,                                         //Debt ratio
        "totalDebt": "21.7505",                                      //Total debt in BTC (interest included)
        "debtList": {"BTC": "1.21","USDT": "2121.2121","EOS": "0"},  //Debt list (interest included)
        "timestamp": 15538460812100                                  //Timestamp (millisecond)
  }
}

```

Topic: **/margin/position**

The system will push the current debt message periodically when there is a liability.

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## Position Status Change Event

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"position.status",
    "channelType":"private",
    "data": {

        "type": "FROZEN_FL",         //Event type
        "timestamp": 15538460812100  //Timestamp (millisecond)
    }
}
```

Topic: **/margin/position**

The system will push the change event when the position status changes.

Event type:

FROZEN_FL: When the debt ratio exceeds the liquidation threshold and the position is frozen, the system will push this event.

UNFROZEN_FL: When the liquidation is finished and the position returns to “EFFECTIVE” status, the system will push this event.

FROZEN_RENEW: When the auto-borrow renewing is complete and the position returns to “EFFECTIVE” status, the system will push this event.

UNFROZEN_RENEW: When the account reaches a negative balance, the system will push this event.

LIABILITY: When the account reaches a negative balance, the system will push this event.

UNLIABILITY: When all the liabilities is repaid and the position returns to “EFFECTIVE” status, the system will push this event.




<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## Margin Trade Order Enters Event

```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.open",
    "channelType":"private",
    "data": {

        "currency": "BTC",                            //Currency
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //Trade ID
        "dailyIntRate": 0.0001,                       //Daily interest rate.
        "term": 7,                                    //Term (Unit: Day)  
        "size": 1,                                    //Size
        "side": "lend",                               //Lend or borrow. Currently, only "Lend" is available
        "ts": 1553846081210004941                     //Timestamp (nanosecond)
    }
}
```

Topic: **/margin/loan:{currency}**

The system will push this message to the lenders when the order enters the order book.


<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## Margin Order Update Event


```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.update",
    "channelType":"private",
    "data": {

        "currency": "BTC",                            //Currency
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //Order ID
        "dailyIntRate": 0.0001,                       //Daily Interest Rate
        "term": 7,                                    //Term (Unit: Day)
        "size": 1,                                    //Size
        "lentSize": 0.5,                              //Size executed
        "side": "lend",                               //Lend or borrow. Currently, only "Lend" is available
        "ts": 1553846081210004941                     //Timestamp (nanosecond)
    }
}

```

Topic: **/margin/loan:{currency}**

The system will push this message to the lenders when the order is executed.


<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## Margin Order Done Event

```json
{
	"type": "message",
	"topic": "/margin/loan:BTC",
	"subject": "order.done",
    "channelType":"private",
	"data": {

		"currency": "BTC",                            //Currency
		"orderId": "ac928c66ca53498f9c13a127a60e8",   //Order ID
		"reason": "filled",                           //Done reason (filled or canceled)
		"side": "lend",                               //Lend or borrow. Currently, only "Lend" is available
		"ts": 1553846081210004941                     //Timestamp (nanosecond)
  }
}
```

Topic: **/margin/loan:{currency}**

The system will push this message to the lenders when the order is completed.



<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>



```json
{
    "type":"message",
    "topic":"/spotMarket/advancedOrders",
    "subject":"stopOrder",
    "channelType":"private",
    "data":{

        "createdAt":1589789942337,
        "orderId":"5ec244f6a8a75e0009958237",
        "orderPrice":"0.00062",
        "orderType":"stop",
        "side":"sell",
        "size":"1",
        "stop":"entry",
        "stopPrice":"0.00062",
        "symbol":"KCS-BTC",
        "tradeType":"TRADE",
        "triggerSuccess":true,
        "ts":1589790121382281286,
        "type":"triggered"
    }
}
```

## Stop Order Event

Topic: /spotMarket/advancedOrders

Subject: stopOrder

When a stop order is received by the system, you will receive a message with "open" type. It means that this order entered the system and waited to be triggered.

When a stop order is triggered by current trading price, you will receive a message with "triggered" type.

When you cancel a stop order, you will receive a message with "cancel" type.