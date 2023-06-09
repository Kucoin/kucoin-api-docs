---
title: title

language_tabs: # must be one of https://git.io/vQNgJ


toc_footers:
  - <a href='https://www.kucoin.com'>Sign Up for KuCoin</a>

includes:

search: true
---

# 高頻交易

## 簡介

高頻帳戶現已正式推出，該帳戶是跟main、trade、margin、future並列的帳戶，type為：trade_hf（WEB端叫做Pro Account）。

目前高頻帳戶僅支持現貨，暫時不支持槓桿，也不支持合約。

相對於普通的trade帳戶，使用trade_hf帳戶交易會有更低等延遲，並且擁有更寬鬆的頻率限制。

如果你是現貨高頻交易者，強烈建議更新現貨api code到高頻帳戶上去。

## 使用教程

高頻帳戶目前的簽名方式等，和trade帳戶完全一致。新增了下單撤單等接口，其他數據仍然使用現有api文檔中等接口。

以下是高频账户的使用教程：

高頻API文檔地址：[https://docs.kucoin.com/spot-hf/#quick-start](https://docs.kucoin.com/spot-hf/#quick-start)

快速開始：

使用POST /api/v2/accounts/inner-transfer劃轉資金到高頻帳戶，劃轉完成後高頻帳戶即可自動開通

使用POST /api/v1/hf/orders高頻帳戶下單交易即可

**注意:** 目前高頻帳戶只能通過api劃轉開通，無法通過web劃轉開通，開通以後才能支持web劃轉

如果需要更多的API交流或回饋，請加入我們的官方 API 電報群：https://t.me/KuCoin_API 或發送電子郵件至 newapi@kucoin.plus


# 快速開始

## 簡介

歡迎使用KuCoin開發者文檔。

本文檔概述了交易功能、市場行情和其他應用開發接口。


API分爲兩部分：**REST API和Websocket 實時數據流**

 -  REST API包含四個類別：**[用戶模塊](#c7e3890dd9)（私有），[交易模塊](#ce6402891a)（私有），[市場數據](#d63a2ca8ac)（公共），[槓桿交易](#11b832b495)，[其他接口](#cd67660573)（公共）**
 -  Websocket包含兩類：**公共頻道和私人頻道**

## 更新預告

爲了您能獲取到最新的API 變更的通知，請在 [KuCoin Docs Github](https://github.com/Kucoin/kucoin-api-docs)添加關注【Watch】

**爲了進一步提升API安全性，KuCoin已經升級到了V2版本的API-KEY，驗籤邏輯也發生了一些變化，建議到[API管理頁面](https://www.kucoin.cc/account/api)添加並更換到新的API-KEY。KuCoin已經停止對老版本API-KEY的支持。[查看新的簽名方式](#99f215f459)**

**29/05/23**:

- 【新增】新上線一系列槓桿V3接口。


**08/04/23**:

- 【新增】升级創建子賬號`POST /api/v1/sub/user`接口，請使用`POST /api/v2/sub/user/created`新接口
- 【新增】升级獲取賬號概要信息`GET /api/v1/user-info`接口，請使用`GET /api/v2/user-info`新接口

**02/03/23**:

- 【新增】新上線trade_hf類型，並推出高頻帳戶一系列接口
- 【修改】`GET /api/v1/margin/lend/active`等四個接口由交易權限改為通用權限


**17/02/23**:

- 【添加】`GET /api/v1/sub/user`接口新增返回字段``uid`、`access`

**11/08/22**:

- 【廢棄】廢棄`POST /api/v1/accounts`接口

**11/01/22**:

- 【添加】`GET /api/v1/withdrawals`和`GET /api/v1/deposits`接口添加返回字段`chain`
- 【添加】在`POST /api/v1/sub/user`接口添加 `generalSubQuantity`、`marginSubQuantity`、`futuresSubQuantity`、`maxDefaultSubQuantity`、`maxGeneralSubQuantity`、`maxMarginSubQuantity` 和 `maxFuturesSubQuantity` 返回字段
- 【新增】新增查詢子賬戶信息分頁接口`GET /api/v2/sub/user`、 `GET /api/v2/sub-accounts`接口

**10/25/22**:

- 【添加】`GET /api/v1/withdrawals`和`GET /api/v1/deposits`接口添加返回字段`chain`

**10/20/22**:

- 【廢棄&新增】廢棄交易對列表`GET /api/v1/symbols`接口，請使用`GET /api/v2/symbols`新接口

**09/22/22**:

- 【新增】新增子賬號相關接口: `DELETE /api/v1/sub/api-key`
- 【新增】Topic`/market/level2`消息增加`time`字段(毫秒)


**08/24/22**:

- 【新增】新增子賬號相關接口: `GET /api/v1/user-info`、`POST /api/v1/sub/user`、`GET /api/v1/sub/api-key`、`POST /api/v1/sub/api-key`、`POST /api/v1/sub/api-key/update`

**08/03/22**:

- 【添加】`GET /api/v1/base-fee`接口添加請求參數`currencyType`
- 【添加】`POST /api/v1/withdrawals`接口添加請求參數`feeDeductType`
- 【添加】`GET /api/v2/currencies/{currency}`接口添加返回字段`chain`


**07/05/22**:

- 【新增】新增槓桿逐倉相關接口: `GET /api/v1/isolated/symbols`、`GET /api/v1/isolated/accounts`、`GET /api/v1/isolated/account/{symbol}`、`POST /api/v1/isolated/borrow`、`GET /api/v1/isolated/borrow/outstanding`、`GET /api/v1/isolated/borrow/repaid`、`POST /api/v1/isolated/repay/all`、`POST /api/v1/isolated/repay/single`
- 【修改】修改以下接口用於支持槓桿逐倉: `POST /api/v2/accounts/inner-transfer`、`GET /api/v1/accounts/transferable`、`POST /api/v1/margin/order`
- 【修改】覈對修正文檔描述，提高文檔的閱讀性

**01/25/22**:

- 【新增】新增[查詢全倉/逐倉槓桿風險限額](#c1114aff6a)接口
- 【廢棄】廢棄獲取V1歷史訂單列表接口`GET /api/v1/hist-orders`



## 閱讀指南

1.  [沙盒環境](#c0302f7165) 幫助您在測試環境更快地瞭解和使用API。
2.  [REST&nbsp;API](#rest-api) 如何創建一個REST&nbsp;API。
3.  [服務器時間](#cfc829dcfc) 在無需驗籤的情況下，可以獲取服務器時間。（可用作連接測試）
4.  [服務狀態](#b92b50d79d) 根據服務狀態來維護交易策略。
5.  [接口認證](#44936cf54e) 如何進行接口認證。
6.  [內部資金劃轉](#d92edf6866) 儲蓄賬戶和交易賬戶之間資產的相互劃轉。
7.  [賬戶列表](#88d7ca20ae) 獲取個人的賬戶資產指南。
8.  [下單](#6a338fcba8) 獲取下單操作指南。
9.  [委託買賣盤](#0063487c69) 獲取買賣盤的快照信息。
10. [Websocket](#websocket-3) 如何創建Websocket 連接
11. [Level-2 市場行情](#level-2-3) 如何使用Websocket 在本地構建一個實時的買賣盤。
12. [餘額變更](#c8ed95427a) 通過Websocket實時獲取賬戶餘額變更信息



## 子賬號
子賬號需要在Web端進行創建，並配置子賬號的API。
子賬號可以用作隔離資金和交易。資金可以在母賬號和子賬號之間相互劃轉。
子賬戶的資金僅用於子賬號交易，不可以提現。

子賬號的API可以訪問所有公共接口。此外，通過API-KEY可以訪問以下私有接口。

| 接口名稱                  | 含義                          |
| --------------------- | --------------------------- |
| [賬戶列表](#88d7ca20ae)   | 獲取所有賬戶信息                    |
| [單個賬戶詳情](#ff7328463d) | 獲取單個賬戶信息                    |
| [創建賬戶](#)   | 創建賬戶                        |
| [賬戶流水記錄](#2cdf284591) | 獲取賬戶流水記錄                    |
| [賬戶凍結記錄](#) | 獲取賬戶凍結記錄                    |
| [內部資金劃轉](#d92edf6866) | 儲蓄賬戶和交易賬戶資金相互劃轉             |
| [下單](#6a338fcba8)     | 下單                          |
| [單個撤單](#014ecde009)   | 取消單個訂單                      |
| [全部撤單](#ead0875a12)   | 取消所有訂單                      |
| [訂單記錄](#23e02e24af)   | 獲取訂單記錄                      |
| [最近訂單記錄](#f040bd813b) | 獲取最近24小時內的訂單列表（最多獲取1000條記錄） |
| [單個訂單詳情](#d726152b23) | 獲取單個訂單詳情                    |
| [成交記錄](#6a30a471cf)   | 獲取成交記錄                      |
| [最近成交記錄](#0dcd2eb829) | 獲取最近24小時內的成交記錄（最多1000條記錄）   |
| [基於clientOid 單個撤單](#clientoid)   | 基於clientOid 單個撤單                      |
| [基於clientOid 獲取單個訂單詳情](#clientoid-2) | 基於clientOid 獲取單個訂單詳情   |
子賬號與母賬號共享同一手續費等級（根據子賬號與母賬號交易額/KCS持有量累加求和計算劃分）。
子賬號在交易之前需要將資金從儲蓄賬戶轉到交易賬戶。

<aside class="notice">子賬號不支持提現和充值</aside>

## 撮合引擎

### 訂單生命週期

當訂單進入撮合引擎時，訂單狀態爲 **received** 。如果一個訂單與另外一個訂單完全撮合，訂單狀態更新爲 **done** 。一個訂單可以部分成交或全部成交，未被撮合的訂單狀態爲 **open**。當訂單被取消（ **canceled** ）或成交（ **filled** ），訂單狀態更新爲 **done**, 否則訂單會一直保持 **open** 狀態。

### 自成交保護（STP）

您可在高級設置中設置**自成交保護**策略。您的訂單將不會發生自成交。如果您在再下單時沒有指定**STP**，否則您的訂單可能會與被自己的訂單成交。需要注意的是，只有taker方的保護策略生效。

#### 減量和取消(DC)

目前，**市價單不支持減量和取消（DECREMENT AND CANCEL）**。針對同一個用戶，同一個交易對，買賣訂單同時存在，數量少的訂單取消，數量多的訂單減去少的一方的數量，繼續執行撮合。如果數量相同，兩個訂單都會取消。

#### 取消舊的訂單(CO)

**Cancel Old** 全部取消舊的訂單，新的訂單繼續執行撮合。

#### 取消新的訂單(CN)

**Cancel New** 全部取消新的訂單，舊的訂單仍然在買賣盤中。

#### 雙方都取消(CB)

**Cancel Both** 買賣方都取消。



## 客戶端開發庫

客戶端庫可以幫助您快速集成我們的API。

**官方**

- [Java SDK](https://github.com/Kucoin/KuCoin-Java-SDK)
- [PHP SDK](https://github.com/Kucoin/KuCoin-PHP-SDK)
- [Go SDK](https://github.com/Kucoin/KuCoin-Go-SDK)
- [Python SDK](https://github.com/Kucoin/kucoin-python-sdk)
- [Nodejs SDK](https://github.com/Kucoin/kucoin-node-sdk)

CCXT 是我們官方SDK提供方，您可以使用CCXT來對接Kucoin API。
更多信息, 請訪問: [https://ccxt.trade](https://ccxt.trade).



**代碼樣例**

- PHP 文件樣例 (GET & POST & DELETE)  [Github Link](https://github.com/Kucoin/kucoin-api-docs/tree/master/examples/php)

- - -

## 沙盒測試環境

**沙盒是測試環境**，用於測試API連接和Web交易，並提供交易的所有功能。在沙盒中，您可以使用虛擬資金來測試交易功能。 沙盒環境中的登錄會話和API密鑰與生產環境完全分離。您可以使用沙盒環境中的Web界面來創建API密鑰。

注意：在沙盒環境中註冊後，您將收到系統在您的帳戶中自動充值的一定數量的測試資金（BTC，ETH或KCS）。如果您想**交易**，請將資產從**儲蓄**賬戶轉移到**交易**賬戶。這些資金僅用於測試目的，不能提現。

用於API測試的沙盒URL：

網址：
**[https://sandbox.kucoin.com](https://sandbox.kucoin.com)**

REST&nbsp;API 連接地址:
**https://openapi-sandbox.kucoin.com**


## 請求頻率限制


###REST API

對需要校驗API權限的私有接口，限制賬號userid。不需要檢驗權限API，則限制IP。目前Kucoin一共有三種限頻，分別如下

1、error code：1015，根據IP限制頻率，是Cloudflare基於ip的限制，所有的接口共用該限頻，目前是500/10s,後臺可能會微調，block 30s。Cloudflare沒有ip白名單的配置，所以無法特殊調整，但是這個問題是可以避免的，比如使用Websocket接口代替Rest接口(如果接口支持的話)。也可以用一臺伺服器綁定多個ip地址（ipv4或者ipv6），或者不同的子帳號使用不同的ip。

2、error code：200002，kucoin每個私有接口的限頻，是基於用戶的uid+接口模式的限制，block10s。比如某個接口調用頻率過高，就可能遇到這個問題，建議降低那個接口的使用頻率

3、error code：429000，kucoin單機容量限制。可以理解為服務器超載了。如果是現貨的話，建議使用的高頻帳戶，能減少429000報錯，也能降低延遲，以下是高頻帳戶的使用教程：

高頻 API文檔：https://docs.kucoin.com/spot-hf/cn

快速開始：

1、使用POST /api/v2/accounts/inner-transfer劃轉資金到高頻帳戶

2、使用POST /api/v1/hf/orders高頻下單交易即可

目前高頻帳戶只能通過api劃轉開通，無法通過web劃轉開通，開通以後才能支持web劃轉

<aside class="notice">接口有特定請求頻率限制說明，以特定說明爲準。</aside>

###WEBSOCKET

### 連接數量
每個用戶ID同時建立的連接數： ≤ 50個

### 連接次數
連接請求次數限制：每分鐘 30次 請求

### 上行消息條數
向服務器發送指令條數限制：每10秒 100條

### 訂閱topic數量
單次最多批量訂閱數量限制：100個topic

每個連接最大可訂閱topic數量限制：300個topic

### 申請提高頻率限制
做市商或專業交易員，如需提高請求頻率，請將您的賬戶信息、申請原因，及交易量發送至[api@kucoin.com](mailto:api@kucoin.com)。

## 做市激勵計劃
KuCoin爲專業做市商提供做市激勵計劃。
參與該計劃，可以獲得以下激勵：

- 做市商返傭
- 每個月獎勵高達30,000 KCS，來回饋最佳的做市商
- 直接市場接入和主機託管服務

具有良好做市策略和大交易量的用戶歡迎參與此長期做市激勵計劃。如果您的賬戶在過去30天內的交易量超過5000 BTC，請提供以下信息以發送電子郵件至mm@kucoin.com，郵件主題爲“Spot Market Maker Application”：

- 提供平臺帳戶（需要電子郵件，無需推薦關係）
- 過去30天內在任何交易所交易的交易量證明或VIP級別的證明
- 請簡要說明做市的方法（不需要詳細說明）以及估算做市訂單量的百分比。


## VIP快速通道

具有良好做市策略和大交易量的用戶歡迎參與長期做市商計劃。 如果您的帳戶資產大於10BTC，請提供以下信息以發送電子郵件至：

**vip@kucoin.com**（現貨）進行做市商申請;

- 提供平臺帳戶（需要電子郵件，無需推薦關係）;
- 提供其他交易平臺做市商交易量的截圖（例如30天內的交易量，或VIP級別等）;
- 請簡要說明做市的方法，不需要詳細說明。

## 常見問題

### 簽名錯誤

* 檢查API-KEY，API-SECRET，API-PASSPHRASE是否正確
* 檢查簽名內容順序 timestamp + method + requestEndpoint + body
* 檢查header中timestamp是否與生成signature一致
* 檢查簽名生成是否爲base64編碼
* get請求是否以表單方式提交
* post請求的數據格式是否是json格式（application/json; charset=utf-8）

### 申請提現
* memo字段<br/>
  個別幣種提現需要memo字段，該字段在其他平臺可能會表示成tag或paymentId<br/>
  對於沒有 memo 的幣種，在使用API提現的時候是不能傳遞memo值，否則，接口會返回 **kucoin incorrect withdrawal address**
* amount字段<br/>
  amount需要符合該幣種提現的precision，可以通過[獲取提現額度](#fb40b060ad)獲取<br/>
  提現金額必須爲提現精度的整數倍，如果爲0表示只能爲整數。

### .net SDK
* POST請求驗籤錯誤<br/>
  {"code":"400005", "msg":"Invalid KC-API-SIGN"}<br/>
  代碼有bug<br/>
  var response = body == null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);<br/>
  修改爲:<br/>
  var response = body != null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);

### WebSocket 限制
* 一個連接最多訂閱300個topic；
* token有效期24小時；
* 一個用戶最多50個連接；
* 客戶端每10秒最多上行100個消息；
* 一個symbol就是一個topic; e.g.Topic: /market/level2:{symbol},{symbol}...

### 返回 403 問題

如返回以下錯誤消息：
403 "The request could not be satisfied. Bad Request" from Amazon CloudFront<br/>

* 檢查請求是否爲HTTPS
* 移除GET請求中的RequestBody

# REST API

## API服務器地址
REST API 對於賬戶、訂單、和市場數據均提供了接口。

基本URL: **https://api.kucoin.com**。

<aside class="notice">爲了遵守當地法律要求，使用中國IP的用戶不允許訪問以上URL。</aside>

請求URL由基本URL和接口端點組成。

## 接口端點(Endpoint)
每個接口都提供了對應的端點（Endpoint），可在HTTP請求模塊下獲取。

對於**GET** 請求, 端點需要要包含請求參數。

例如，對於"[賬戶列表](#88d7ca20ae)"接口，其默認端點爲 **/api/v1/accounts**。
如果您的請求參數currency=BTC，則該端點將變爲 **/api/v1/accounts?currency=BTC**。因此，您最終請求的URL應爲：**https://api.kucoin.com/api/v1/accounts?currency=BTC**。


## 請求
所有的POST請求和返回內容類型都是 **application/json**.  

除非另行說明，所有的時間戳參數均以Unix時間戳毫秒計算。如：**1544657947759**

### 請求參數
對於 **GET和DELETE** 請求, 需將參數拼接在請求URL中。(**例如， /api/v1/accounts?currency=BTC**)

對於 **POST** 請求, 需將參數以JSON格式拼接在請求主體中(**例如， {"currency":"BTC"}**)。
注意：不要在JSON字符串中添加空格。

### 錯誤返回
系統會返回HTTP錯誤代碼或系統錯誤代碼。您可根據返回的參數消息排查錯誤原因。

#### HTTP錯誤碼
```json
{
    "code":"400100",
    "msg":"Invalid Parameter."
}
```

| 代碼  | 意義                                                                 |
| --- | ------------------------------------------------------------------ |
| 400 | Bad Request -- 無效的請求格式                                             |
| 401 | Unauthorized -- 無效的API-KEY                                         |
| 403 | Forbidden 或 Too Many Requests -- 請求被禁止 或 超過[請求頻率限制](#7250787b00)     |
| 404 | Not Found -- 找不到指定資源                                               |
| 405 | Method Not Allowed -- 您請求資源的方法不正確                                  |
| 415 | Content-Type: application/json -- [請求類型](#466c5b7be2)必須爲application/json類型 |
| 500 | Internal Server Error -- 服務器出錯，請稍後再試                               |
| 503 | Service Unavailable -- 服務器維護中，請稍後再試                                |



#### 系統錯誤碼
| 代碼   | 意義                                                         |
| ------ | ------------------------------------------------------------ |
| 200001 | Order creation for this pair suspended--交易對暫停交易       |
| 200002 | Order cancel for this pair suspended--交易對暫停取消訂單     |
| 200003 | Number of orders breached the limit--委託中訂單數量過多      |
| 200009 | Please complete the KYC verification before you trade XX--需要通過KYC高級認證才能交易該幣對 |
| 200004 | Balance insufficient--賬戶餘額不足                           |
| 260210 | withdraw.disabled -- 幣鏈提現關閉，或者用戶被凍結提現         |
| 400001 | Any of KC-API-KEY, KC-API-SIGN, KC-API-TIMESTAMP, KC-API-PASSPHRASE is missing in your request header -- 請求頭中缺少驗籤參數 |
| 400002 | KC-API-TIMESTAMP Invalid -- 請求時間與服務器時差超過5秒      |
| 400003 | KC-API-KEY not exists -- API-KEY 不存在                      |
| 400004 | KC-API-PASSPHRASE error -- API-PASSPHRASE 不正確             |
| 400005 | Signature error -- [簽名](#99f215f459)錯誤，請檢查您的簽名     |
| 400006 | The requested ip address is not in the api whitelist -- 請求IP不在API白名單中 |
| 400007 | Access Denied -- API權限不足，無法訪問該URI目標地址。        |
| 404000 | Url Not Found -- 找不到請求資源                              |
| 400100 | Parameter Error -- 請求參數不合法                            |
| 400200 | Forbidden to place an order--禁止在該交易對下單              |
| 400500 | Your located country/region is currently not supported for the trading of this token--該數字資產不支持您所在區域的用戶參與，感謝您的理解 |
| 400600 | validation.createOrder.symbolNotAvailable -- 交易對還未開啟交易 |
| 400700 | Transaction restricted, there's a risk problem in your account--您的賬戶存在風險問題，暫時不允許進行交易 |
| 400800 | Leverage order failed--槓槓下單失敗                          |
| 411100 | User are frozen -- 用戶被凍結，請聯繫[幫助中心](https://kucoin.zendesk.com/hc/zh-cn/requests/new) |
| 415000 | Unsupported Media Type -- 請求頭等Content-Type需要設置成application/json |
| 500000 | Internal Server Error -- 服務器出錯，請稍後再試              |
| 900001 | symbol not exists--交易對不存在                              |

如果系統返回HTTP狀態碼爲200，但業務失敗，系統會報錯。您可根據返回的參數消息排查錯誤。

### 成功返回
當系統返回HTTP狀態碼200和系統代碼200000時，表示響應成功，返回結果如下：

```json
{
    "code":"200000",
    "data":"1544657947759"
}
```

### 分頁

Pagination允許使用當前頁數獲取結果，非常適用於獲取實時數據。如/api/v1/deposits、/api/v1/orders及/api/v1/fills端點均默認返回第一頁結果，共50條數據。如需獲取更多數據，請根據當前返回的數據指定其他分頁，然後再進行請求。


#### 請求參數
| 參數名稱    | 默認值 | 含義                            |
| ----------- | ------ | ------------------------------- |
| currentPage | 1      | 當前頁碼                        |
| pageSize    | 50     | 每頁記錄數，最小值10，最大值500 |

#### 示例
`GET /api/v1/orders?currentPage=1&pageSize=50`


## 類型說明

### 時間戳

所有時間戳參數都應以毫秒爲單位，除非另有說明。例如， **1544657947759**。

撮合引擎和訂單系統的時間戳使用的是納秒爲單位。

### 數字

爲了保證跨平臺的數字的精確度，Decimal轉化爲字符串返回。請在發出請求時，將數字轉換爲字符串來避免數字被截斷或者精度錯誤。

## 接口認證

### 創建API-KEY
通過接口進行請求前，您需在Web端創建API-KEY。創建成功後，您需妥善保管好以下三條信息：


* Key
* Secret
* Passphrase

Key和Secret由KuCoin隨機生成並提供，Passphrase是您在創建API時使用的密碼。以上信息若遺失將無法恢復，需要重新申請API KEY。

### API權限

您可在KuCoin Web端管理API權限。API權限分爲以下幾類：

* **通用權限** - 用戶僅能通過此 API 進行查詢賬戶信息、賬單流水以及訂單信息等只讀操作，不能進行下單、提現等
* **幣幣權限** - 用戶可通過此 API 進行幣幣交易的訂單委託、撤單等操作
* **槓桿權限** - 用戶可通過此 API 進行槓桿交易的訂單委託、撤單等操作
* **合約權限** - 用戶可通過此 API 進行合約交易的訂單委託、撤單等操作
* **提現權限** - 此權限可進行提現、獲取充值地址、取消提現等操作，啟用此權限必須添加 IP 地址訪問限制白名單。子帳戶沒有提現權限。
  授權提現權限時請注意，不需要郵箱驗證和谷歌驗證就可以使用API進行轉賬。



請參考下方API文檔，看接口具體需要哪些權限。

### 創建請求

Rest請求頭必須包含以下內容:

* **KC-API-KEY** API-KEY以字符串傳遞
* **KC-API-SIGN** [簽名](#99f215f459)
* **KC-API-TIMESTAMP** 請求的時間戳
* **KC-API-PASSPHRASE** 創建API時填的API-KEY的密碼
* **KC-API-KEY-VERSION** API-KEY版本號，可通過[API管理](https://www.kucoin.cc/account/api)頁面查看版本號

### 簽名

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
    url = 'https://api.kucoin.com/api/v1/accounts'
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
        "KC-API-KEY-VERSION": "2"
    }
    response = requests.request('get', url, headers=headers)
    print(response.status_code)
    print(response.json())

    #Example for create deposit addresses in python
    url = 'https://api.kucoin.com/api/v1/deposit-addresses'
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
        "KC-API-KEY-VERSION": 2,
        "Content-Type": "application/json" # specifying content type or using json=data in request
    }
    response = requests.request('post', url, headers=headers, data=data_json)
    print(response.status_code)
    print(response.json())
```
請求頭中的 **KC-API-SIGN**:

1. 使用 API-Secret 對
    {timestamp + method + endpoint + body} 拼接的字符串進行**HMAC-sha256**加密。
2. 再將加密內容使用 **base64** 編碼。

請求頭中的 **KC-API-PASSPHRASE**:

1. 對於V1版的API-KEY，請使用明文傳遞
2. 對於V2版的API-KEY，需要將KC-API-KEY-VERSION指定爲2，並將passphrase使用API-Secret進行**HMAC-sha256**加密，再將加密內容通過**base64**編碼後傳遞

注意：

* 加密的 timestamp 需要和請求頭中的KC-API-TIMESTAMP保持一致
* 用於加密的body需要和請求中的Request Body的內容保持一致
* 請求方法需要大寫
* 對於 GET, DELETE 請求，endpoint 需要包含請求的參數（/api/v1/deposit-addresses?currency=BTC）。如果沒有請求體（通常用於GET請求），則請求體使用空字符串””。



```python
#Example for Create Deposit Address

curl -H "Content-Type:application/json" -H "KC-API-KEY:5c2db93503aa674c74a31734" -H "KC-API-TIMESTAMP:1547015186532" -H "KC-API-PASSPHRASE:QWIxMjM0NTY3OCkoKiZeJSQjQA==" -H "KC-API-SIGN:7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4="  -H "KC-API-KEY-VERSION:2"
-X POST -d '{"currency":"BTC"}' http://api.kucoin.com/api/v1/deposit-addresses

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

### 選擇時間戳

請求頭中的 **KC-API-TIMESTAMP** 必須爲[Unix 時間](http://en.wikipedia.org/wiki/Unix_time)，精確到毫秒，例如，1547015186532。

服務器請求的時間戳與API服務器時差必須控制在5秒以內，否則請求會因過期而被服務器拒絕。如果服務器與API服務器之間存在時間偏差，請使用平臺提供的服務器時間接口，獲取API[服務器的時間](#cfc829dcfc)。

# 用戶模塊

此部分需進行[簽名驗證](#99f215f459)。

# 用戶信息

## 獲取所有子賬號信息
```json
[
    {
        "userId":"5cbd31ab9c93e9280cd36a0a", //subUserId子賬號用戶ID
		"uid":"1789234",
        "subName":"kucoin1",
        "type":0, //type子賬號類型:0-普通子賬號
        "remarks":"kucoin1",
		"access":"All"
    },
    {
        "userId":"5cbd31b89c93e9280cd36a0d",
		"uid":"1789431",
        "subName":"kucoin2",
        "type":1, //type子賬號類型:1-交易機器人子賬號
        "remarks":"kucoin2",
		"access":"All"
    }
]
```
這個接口獲取母賬號下所有的子賬號信息。
<aside class="notice">推薦使用<code>GET /api/v2/sub/user</code>接口進行分頁查詢</aside>

### HTTP請求
`GET /api/v1/sub/user`
### 請求示例
`GET /api/v1/sub/user`
### API權限
該接口需要`通用權限`。
### 請求參數
`無`
### 返回值
| 字段      | 含義       |
| ------- | -------- |
| userId  | 子賬號的用戶ID |
| uid  | 子賬號UID |
| subName | 子賬號的用戶名  |
| type | 子賬號類型  |
| remarks | 備註信息     |
| access | 權限     |

## 獲取子賬號分頁列表
```json
{
    "code":"200000",
    "data":{
        "currentPage":1,
        "pageSize":100,
        "totalNum":1,
        "totalPage":1,
        "items":[
            {
                "userId":"635002438793b80001dcc8b3",
                "uid":62356,
                "subName":"margin01",
                "status":2,
                "type":4,
                "access":"Margin",
                "createdAt":1666187844000,
                "remarks":null
            }
        ]
    }
}
```
這個接口用以獲取子賬號分頁列表，需要使用分頁
### HTTP請求
`GET /api/v2/sub/user`
### 請求示例
`GET /api/v2/sub/user`
### API權限
此接口需要`通用權限`
### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
currentPage | Int | [可選] 當前頁；默認爲第`1`頁 
pageSize | Int | [可選] 每頁數量；默認值`10`，最小值`1`，最大值`100`
### 返回值
字段 | 含義
--------- | -------
createdAt |  創建時間
remarks   |  備註
status    |  賬戶狀態
subName   |  子賬戶名
type      |  子賬戶類型
uid       |  子賬戶UID
userId    |  子賬號ID
access    |  交易權限


##
# 賬戶

## 賬戶列表
```json
[
    {
        "id":"5bd6e9286d99522a52e458de", //accountId
        "currency":"BTC",  //幣種
        "type":"main", //賬戶類型，儲蓄（main）賬戶、交易(trade)賬戶或槓桿（margin）賬戶
        "balance":"237582.04299",//資金總額
        "available":"237582.032", //可用金額
        "holds":"0.01099" //凍結金額
    },
    {
        "id":"5bd6e9216d99522a52e458d6",
        "currency":"BTC",
        "type":"trade",
        "balance":"1234356",
        "available":"1234356",
        "holds":"0"
    }
]
```
獲取賬號下賬戶詳情列表。

交易前請先[充值](#fa03c46253)到儲蓄賬戶，再使用[內部資金劃轉](#d92edf6866)將資金從儲蓄賬戶劃轉到交易賬戶。


### HTTP請求
`GET /api/v1/accounts`

### 請求示例
`GET /api/v1/accounts`

### API權限
此接口需要**通用權限**。


### 請求參數

請求參數 | 類型 | 含義
--------- | -------| -------
currency | String | [可選] [幣種](#47f0f7e8df)
type | String |[可選] 賬戶類型 **main**、**trade**、**margin**

### 返回值
字段 | 含義
--------- | -------
id | accountId 賬戶ID
currency | 賬戶對應的幣種
type |賬戶類型 ，**main**（儲蓄賬戶）、**trade**（交易賬戶）、**margin**(槓桿賬戶)
balance | 賬戶資金總額
available | 賬戶可用的資金
holds | 賬戶凍結的資金

### 賬戶類型
賬戶劃分爲: 儲蓄賬戶、交易賬戶和槓桿賬戶。

賬戶之間的資金劃轉不收取手續費。

儲蓄賬戶主要用於資金的提現和充值，儲蓄賬戶裏面的資金不可以直接用於交易。交易之前需要將資金從儲蓄賬戶轉到交易賬戶。

交易賬戶主要用於交易。下單扣除的是交易賬戶裏面的資金，交易賬戶裏面的資金不可以直接提現，必須要轉到儲蓄賬戶纔可以提現。

槓桿賬戶主要用於借入資產和槓桿交易。


賬戶之間資金劃轉請參考[內部資金劃轉](#d92edf6866)。

### 凍結資金
當下單時，您用於下單的資金會被凍結。凍結的資金不可以用作再次下單或者提現。當訂單取消或成交後，資金才能解凍回退或解凍支付。



## 單個賬戶詳情

```json
{
    "currency":"KCS", //幣種
    "balance":"1000000060.6299", //資金總額
    "available":"1000000060.6299", //可用資金
    "holds":"0" //凍結資金
}
```
此接口返回單個賬戶的詳情。

### HTTP請求
`GET /api/v1/accounts/{accountId}`

### 請求示例
`GET /api/v1/accounts/5bd6e9286d99522a52e458de`

### API權限
此接口需要**通用權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
accountId | String | 路徑參數，[賬戶ID](#88d7ca20ae)

### 返回值
字段 | 含義
--------- | -------
currency | 幣種
balance | 賬戶資金總額
holds | 凍結資金
available | 可用資金

## 賬戶流水記錄
此接口返回所有賬戶的出入賬流水記錄，支持多幣種查詢。
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

```json
{
  "currentPage": 1,
  "pageSize": 50,
  "totalNum": 2,
  "totalPage": 1,
  "items": [
    {
      "id": "611a1e7c6a053300067a88d9",//唯一鍵
      "currency": "USDT", //幣種
      "amount": "10.00059547", //資金變動值
      "fee": "0", //充值或提現費率
      "balance": "0", //金額變動
      "accountType": "MAIN", //賬戶類型
      "bizType": "Loans Repaid", //業務類型
      "direction": "in", //出入賬方向入賬或出賬（in or out）
      "createdAt": 1629101692950, //創建時間
      "context": "{\"borrowerUserId\":\"601ad03e50dc810006d242ea\",\"loanRepayDetailNo\":\"611a1e7cc913d000066cf7ec\"}" //Business core parameters
    },
    {
      "id": "611a18bc6a0533000671e1bf",
      "currency": "USDT",
      "amount": "10.00059547",
      "fee": "0",
      "balance": "0",
      "accountType": "MAIN",
      "bizType": "Loans Repaid",
      "direction": "in",
      "createdAt": 1629100220843,
      "context": "{\"borrowerUserId\":\"5e3f4623dbf52d000800292f\",\"loanRepayDetailNo\":\"611a18bc7255c200063ea545\"}"// 業務核心參數
    }
  ]
}
```

### HTTP請求
`GET /api/v1/accounts/ledgers`


### 請求示例
`GET /api/v1/accounts/ledgers?currency=BTC&startAt=1601395200000`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**18次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
currency | String |  [可選] 幣種，選填，可多選，以逗號分隔，最多支持選擇10個幣種，若不填寫，默認查詢所有幣種
direction | String | [可選] 出入賬方向: **in** -入賬, **out** -出賬
bizType   | String | [可選] 業務類型: **DEPOSIT** -充值, **WITHDRAW** -提現, **TRANSFER** -轉賬, **SUB_TRANSFER** -子賬戶轉賬,**TRADE_EXCHANGE** -交易, **MARGIN_EXCHANGE** -槓桿交易, **KUCOIN_BONUS** -鼓勵金
startAt   | long   | [可選] 開始時間（毫秒）
endAt     | long   | [可選] 截止時間（毫秒）

<aside class="notice">您只能獲取 24 小時時間範圍內的數據（即：查詢時，開始時間到結束時間的時間範圍不能超過24小時）。若超出時間範圍，系統會報錯。如果您只指定了結束時間，沒有指定開始時間，系統將按照24小時的範圍自動計算開始時間（開始時間=結束時間-24小時）並返回相應數據，反之亦然。</aside>
<aside class="notice">最多獲取1年的歷史數據，如需要獲取更久遠的歷史數據，請提交工單查詢：https://kucoin.zendesk.com/hc/en-us/requests/new</aside>



### 返回值
字段 | 含義
--------- | -------
id | 唯一鍵
currency | 幣種
amount | 資金變動值
fee | 充值或提現費率
balance | 變動後的資金總額
accountType | 母賬號賬戶類型MAIN、TRADE、MARGIN或CONTRACT
bizType | 業務類型，比如交易，提現，推薦關係獎，借貸等
direction | 出入賬方向 **out** 或 **in**
createdAt | 創建時間
context | 業務核心參數

### context

如果 **bizType** 是trade exchange，那麼 **context** 字段會包含交易的額外信息（訂單id，交易id，交易對）。

### BizType 含義
值 | 含義
--------- | -------
Assets Transferred in After Upgrading | 從V1遷入V2時系統升級轉入
Deposit  | 獲取充值入賬記錄
Withdrawal  | 獲取提現記錄
Transfer | 獲取資金劃轉記錄
Trade_Exchange | 獲取幣幣交易記錄
Vote for Coin | 投票上幣分發資產
KuCoin Bonus | 獲取鼓勵金入賬記錄
Referral Bonus | 獲取邀請獎勵入賬記錄
Rewards | 一些活動發獎記錄
Distribution  | 持幣分發，持有NEO 獲得GAS 等資產分發記錄
Airdrop/Fork  | 某些代幣的空投活動，比如持有BTC空投KCS
Other rewards | 其他獎勵，除持幣分發、空投、分叉之外的其他活動獎勵
Fee Rebate | 手續費返傭，負手續費獲得的手續費返傭
Buy Crypto | 使用信用卡購買資產
Sell Crypto | 使用信用卡出售資產
Public Offering Purchase | Spotlight活動公開發行某些資產
Send red envelope | 發送紅包
Open red envelope  | 領取紅包
Staking  | Staking鎖倉
LockDrop Vesting | 進行Lockdrop認購
Staking Profits | Staking收益
Redemption | 贖回資產
Refunded Fees | KCS抵扣
KCS Pay Fees | KCS抵扣
Margin Trade | 槓桿交易
Loans   | 槓桿借出
Borrowings  | 槓桿借入
Debt Repayment   | 槓桿還款
Loans Repaid  | 槓桿收款
Lendings  | 借貸
Pool transactions  | Pool-X交易
Instant Exchange  | 閃兌交易
Sub-account transfer  | 子母賬戶轉賬
Liquidation Fees   | 爆倉手續費
Soft Staking Profits  | 獲取Soft Staking收益
Voting Earnings  | Pool-X獲取投票收益
Redemption of Voting  | Pool-X投票贖回資產
Convert to KCS   | 一鍵轉KCS

## 獲取賬號概要信息(廢棄)

```json
{
    "code": "200000",
    "data": {
        "level": 0,
        "subQuantity": 11,
        "subQuantityByType": {
            "generalSubQuantity": 9,
            "marginSubQuantity": 1,
            "futuresSubQuantity": 1
        },
        "maxSubQuantity": 35,
        "maxSubQuantityByType": {
            "maxDefaultSubQuantity": 5,
            "maxGeneralSubQuantity": 10,
            "maxMarginSubQuantity": 10,
            "maxFuturesSubQuantity": 10
        }
    }
}
```
這個接口用以獲取賬號概要信息

<aside class="notice"><code>GET /api/v1/user-info</code>接口已被廢棄，因爲升級了子帳戶權限結構，所以推薦使用<code>GET /api/v2/user-info</code>接口</aside>

### HTTP請求
`GET /api/v1/user-info`

### 請求示例
`GET /api/v1/user-info`

### API權限
此接口需要`通用權限`。

### 請求參數
`無`

### 返回值
字段 | 含義
--------- | -------
level | 用戶等級
subQuantity | 子賬號數量
generalSubQuantity | 通用子賬號開通數量
marginSubQuantity | 槓桿子賬號開通數量
futuresSubQuantity | 合約子賬號開通數量
maxSubQuantity | 子賬號數量上限
maxDefaultSubQuantity | 默認子賬號數量上限
maxGeneralSubQuantity | 通用子賬號數量上限
maxMarginSubQuantity | 槓桿子賬號數量上限
maxFuturesSubQuantity | 合約子賬號數量上限



## 獲取賬號概要信息(V2)

```json
{
  "data" : {
	"level" : 0,
	"subQuantity" : 5,
	"maxDefaultSubQuantity" : 5,
	"maxSubQuantity" : 5,
	
	"spotSubQuantity" : 5,
	"marginSubQuantity" : 5,
	"futuresSubQuantity" : 5,  
  
    "maxSpotSubQuantity" : 0,
    "maxMarginSubQuantity" : 0,
    "maxFuturesSubQuantity" : 0 
  },
  "code" : "200000"
}
```
這個接口用以獲取賬號概要信息

### HTTP請求
`GET /api/v2/user-info`

### 請求示例
`GET /api/v2/user-info`

### API權限
此接口需要`通用權限`。

### 請求參數
`無`

### 返回值
字段 | 含義
--------- | -------
level | 用戶等級
subQuantity | 當前子賬號數量
maxDefaultSubQuantity | 默認子賬號數量上限（根據level等級）
maxSubQuantity | 子賬號數量上限=默認子賬號數量上限+附加币币权限數量上限
spotSubQuantity | 幣幣權限使用数量
marginSubQuantity | 槓桿權限使用數量
futuresSubQuantity | 合約權限使用數量
maxSpotSubQuantity | 附加幣幣权限數量上限
maxMarginSubQuantity | 附加槓桿权限數量上限
maxFuturesSubQuantity | 附加合約权限數量上限


## 創建子賬號(廢棄)
```json
{
    "code": "200000",
    "data": {
        "uid": 9969082973,
        "subName": "AAAAAAAAAA0007",
        "remarks": "remark",
        "access": "All"
    }
}
```
這個接口用以創建子賬號。

<aside class="notice"><code>POST /api/v1/sub/user</code>接口已被廢棄，因爲升級了子帳戶權限結構，所以推薦使用<code>POST /api/v2/sub/user/created</code>接口</aside>


### HTTP請求
`POST /api/v1/sub/user`

### 請求示例
`POST /api/v1/sub/user`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
password | String | 密碼(7～24位字符，數字或字母，不允許純數字或@等特殊字符)
remarks | String | [可選]備註(1～24位字符)
subName | String | 子賬戶名(7～32位字符，必須包含字母和數字，不支持空格)
access | String | [可選]交易權限(只能設置`All`、`Futures`、`Margin`權限，默認爲`All`。`All`-無限制；`Futures`-無法使用槓桿功能；`Margin`-無法使用合約功能）

### 返回值
字段 | 含義
--------- | -------
remarks | 備註
subName | 子賬戶名
uid | 子賬戶UID
access | 交易權限

## 創建子賬號(V2)
```json
{
    "code": "200000",
    "data": {
        "uid": 9969082973,
        "subName": "AAAAAAAAAA0007",
        "remarks": "remark",
        "access": "Spot"
    }
}
```
這個接口用以創建子賬號。

### HTTP請求
`POST /api/v2/sub/user/created`

### 請求示例
`POST /api/v2/sub/user/created`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
password | String | 密碼(7～24位字符，數字或字母，不允許純數字或@等特殊字符)
remarks | String | [可選]備註(1～24位字符)
subName | String | 子賬戶名(7～32位字符，必須包含字母和數字，不支持空格)
access | String | 交易權限(類型包含`Spot`、`Futures`、`Margin`權限，可單獨使用或組合使用）。

### 返回值
字段 | 含義
--------- | -------
remarks | 備註
subName | 子賬戶名
uid | 子賬戶UID
access | 交易權限


## 獲取子賬號現貨API列表
```json
{
    "code": "200000",
    "data": [
        {
            "subName": "AAAAAAAAAAAAA0022",
            "remark": "hytest01-01",
            "apiKey": "63032453e75087000182982b",
            "permission": "General",
            "ipWhitelist": "",
            "createdAt": 1661150291000
        }
    ]
}
```
這個接口用以獲取子賬號現貨API列表

### HTTP請求
`GET /api/v1/sub/api-key`

### 請求示例
`GET /api/v1/sub/api-key`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
apiKey | String | [可選]API-Key
subName | String | 子賬號名

### 返回值
字段 | 含義
--------- | -------
apiKey | API-Key
createdAt | 創建時間
ipWhitelist | IP白名單
permission | 權限列表
remark | 備註
subName | 子賬號名

## 創建子賬號現貨API
```json
{
    "code": "200000",
    "data": {
        "subName": "AAAAAAAAAA0007",
        "remark": "remark",
        "apiKey": "630325e0e750870001829864",
        "apiSecret": "110f31fc-61c5-4baf-a29f-3f19a62bbf5d",
        "passphrase": "passphrase",
        "permission": "General",
        "ipWhitelist": "",
        "createdAt": 1661150688000
    }
}
```
這個接口用以創建子賬號現貨API

### HTTP請求
`POST /api/v1/sub/api-key`

### 請求示例
`POST /api/v1/sub/api-key`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 |  含義
--------- | ------- | -------
subName | String | 子賬號名, 創建api key的子賬號名稱
passphrase | String | 密碼(7～32位字符，不可輸入空格)
remark | String | 備註(1～24位字符)
permission | String | [可選]權限列表(只能設置General、Trade權限，如："General,Trade”。默認爲General)
ipWhitelist | String | [可選]IP白名單(每個IP用半角逗號隔開，最多添加20個)
expire | String | [可選]API過期時間；不過期(默認值)`-1`，30天`30`，90天`90`，180天`180`，360天`360`

### 返回值
字段 | 含義
--------- | -------
apiKey | API-Key
createdAt | 創建時間
ipWhitelist | IP白名單
permission | 權限列表
remark | 備註
subName | 子賬號名
apiSecret | 祕鑰
passphrase | 密碼

## 修改子賬號現貨API
```json
{
    "code": "200000",
    "data": {
        "subName": "AAAAAAAAAA0007",
        "apiKey": "630329b4e7508700018298c5",
        "permission": "General",
        "ipWhitelist": "127.0.0.1",
    }
}
```
這個接口用以修改子賬號現貨API

### HTTP請求
`POST /api/v1/sub/api-key/update`

### 請求示例
`POST /api/v1/sub/api-key/update`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
subName | String | 子賬號名(API Key對應子賬號名)
apiKey | String | API-Key(需要修改的API Key)
passphrase | String | 密碼(API Key 密碼)
permission | String |  [可選]權限列表(只能設置General、Trade權限，默認爲General。如果修改，權限將會重置)
ipWhitelist | String | [可選]IP白名單(每個IP用半角逗號隔開，最多添加20個。如果修改，ip將會重置)
expire | String | [可選]API過期時間；不過期(默認值)`-1`，30天`30`，90天`90`，180天`180`，360天`360`

### 返回值
字段 | 含義
--------- | -------
apiKey | API-Key
ipWhitelist | IP白名單
permission | 權限列表
subName | 子賬號名

## 刪除子賬號現貨API
```json
{
 "code": "200000",
 "data": {
   "subName": "AAAAAAAAAA0007",
   "apiKey": "630325e0e750870001829864"
 }
}
```
這個接口用以刪除子賬號現貨API

### HTTP請求
`DELETE /api/v1/sub/api-key`

### 請求示例
`DELETE /api/v1/sub/api-key`

### API權限
此接口需要`通用權限`。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
apiKey | String | API-Key(要刪除的api key)
passphrase | String | 密碼(api key的密碼)
subName | String | 子賬號名(api key對應子賬號名)

### 返回值
字段 | 含義
--------- | -------
apiKey | API-Key
subName | 子賬號名 

## 獲取單個子賬戶信息
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

此接口可獲取單個子賬號的賬戶信息。

### HTTP請求
`GET /api/v1/sub-accounts/{subUserId}`

### 請求示例
`GET /api/v1/sub-accounts/5caefba7d9575a0688f83c45?includeBaseAmount=false`


### API權限
此接口需要**通用權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------  
subUserId | String | 路徑參數，[子賬號的用戶Id](#abcf8983bc)
includeBaseAmount | boolean | false:不展示資產為0的幣種，true:展示資產為0的幣種

### 返回值
字段 | 含義
--------- | -------
subUserId | 子賬號的用戶Id
subName | 子賬號的用戶名
currency | 幣種
balance | 資金總額
available | 可用資金
holds | 凍結資金
baseCurrency | 基準幣種
baseCurrencyPrice | 基準貨幣價格
baseAmount | 基準貨幣數量


## 獲取所有子賬戶信息
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
此接口可獲取所有子賬號的賬戶信息。
<aside class="notice">推薦使用<code>GET /api/v2/sub-accounts</code>接口進行分頁查詢</aside>

### HTTP請求
`GET /api/v1/sub-accounts`
### 請求示例
`GET /api/v1/sub-accounts`
### API權限
此接口需要`通用權限`。
### 請求參數
`無`
### 返回值
字段 | 描述
--------- | -------
subUserId | 子賬號的用戶ID
subName | 子賬號的用戶名
currency | 幣種
balance | 資金總額
available | 可用資金
holds | 凍結資金
baseCurrency | 基準幣種
baseCurrencyPrice | 基準貨幣價格
baseAmount | 基準貨幣數量

## 分頁獲取子賬戶信息
```json
{
    "code": "200000",
    "data": {
        "currentPage": 1,
        "pageSize": 10,
        "totalNum": 14,
        "totalPage": 2,
        "items": [
            {
                "subUserId": "635002438793b80001dcc8b3",
                "subName": "margin03",
                "mainAccounts": [
                    {
                        "currency": "00",
                        "balance": "0",
                        "available": "0",
                        "holds": "0",
                        "baseCurrency": "BTC",
                        "baseCurrencyPrice": "125.63",
                        "baseAmount": "0"
                    }
                ]
            }
        ]
    }
}
```
這個接口用以分頁獲取子賬戶信息，需要使用分頁
### HTTP請求          
`GET /api/v2/sub-accounts`
### 請求示例
`GET /api/v2/sub-accounts`
### API權限
此接口需要`通用權限`
### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
currentPage | Int | [可選]當前頁；默認爲第`1`頁 
pageSize | Int | [可選]每頁數量；默認值`10`，最小值`1`，最大值`100`
### 返回值
字段 | 含義
--------- | -------
subUserId  | 子賬號的用戶ID
subName  | 子賬號的用戶名
currency  | 幣種
balance  | 資金總額
available  | 可用資金
holds  | 凍結資金
baseCurrency  | 基準幣種
baseCurrencyPrice  | 基準貨幣價格
baseAmount    | 基準貨幣數量

## 獲取可劃轉資金
```json
{
    "currency":"KCS",
    "balance":"0",
    "available":"0",
    "holds":"0",
    "transferable":"0"
}
```
此接口可獲取指定賬戶和幣種下的可劃轉的資金。

### HTTP請求
`GET /api/v1/accounts/transferable`

### 請求示例
`GET /api/v1/accounts/transferable?currency=BTC&type=MAIN`

### API權限
此接口需要`通用權限`。

### 請求參數

請求參數 | 類型 | 含義
--------- | ------- |  ------- | -------
currency | String | [幣種](#47f0f7e8df)
type | String | 賬戶類型：`MAIN`、`TRADE`、`MARGIN`、`ISOLATED`
tag | String | [可選]交易對，賬戶類型爲`ISOLATED`時必填，其他類型不傳，例如：`BTC-USDT`

### 返回值
字段 | 含義
--------- | -------
currency | 幣種
balance | 資金總額
available | 可用資金
holds | 凍結資金
transferable | 可劃轉資金


## 子母賬號資金劃轉
```json
{
    "orderId":"5cbd870fd9575a18e4438b9a"
}
```
此接口，用於子母賬號之間資金的劃轉。
支持母賬號的儲蓄/交易/槓桿賬戶向子賬號的儲蓄/交易/賬戶槓桿劃轉。合約賬戶只支持從其他賬戶轉入資金，不支持轉出資金至其他賬戶。


### HTTP請求
`POST /api/v2/accounts/sub-transfer`

<aside class="notice">推薦使用</aside>

### 請求示例
`POST /api/v2/accounts/sub-transfer`

### API權限
此接口需要**現貨交易權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**3次/3s**

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
clientOid | String | Client Order Id，客戶端創建的唯一標識，建議使用UUID，最大長度為128位
currency | String | [幣種](#47f0f7e8df)
amount | String | 轉賬金額，爲[幣種精度](#47f0f7e8df)正整數倍
direction | String | OUT — 母賬號轉子賬號<br/>IN — 子賬號轉母賬號
accountType | String | [可選] 母賬號賬戶類型**MAIN**、**TRADE**、**MARGIN**或**CONTRACT**，默認爲**MAIN**。
subAccountType | String | [可選] 子賬號賬戶類型**MAIN**、**TRADE**、**MARGIN**或**CONTRACT**，默認爲**MAIN**。
subUserId | String | [子賬號的用戶Id](#abcf8983bc)

### 返回值
字段 | 含義
--------- | -------
orderId | 子母賬號轉賬的訂單ID

## 內部資金劃轉
```json
{
    "orderId":"5bd6e9286d99522a52e458de"
}
```
此接口用於平臺內部賬戶資金劃轉，用戶可以將資金在儲蓄賬戶、交易賬戶、槓桿賬戶全倉、槓桿賬戶逐倉之間免費劃轉。同時支持從儲蓄賬戶、交易賬戶、槓桿賬戶全倉劃轉資金至合約賬戶，但不支持從合約賬戶轉出資金至其他賬戶。

### HTTP請求
`POST /api/v2/accounts/inner-transfer`

### API權限
此接口需要`現貨交易權限`。

### 請求參數
請求參數 | 類型 |含義
--------- | ------- |  -------
clientOid | String | Client Order Id，客戶端創建的唯一標識，建議使用UUID，最大長度為128位
currency | String | [幣種](#47f0f7e8df)
from | String | 付款賬戶類型: `main`、`trade`、`margin`、`isolated`
to | String | 收款賬戶類型: `main`、`trade`、`margin`、`isolated`、`contract`
amount | String | 轉賬金額，精度爲[幣種精度](#47f0f7e8df)正整數倍
fromTag | String | [可選]交易對，付款賬戶類型爲`isolated`時必填，例如：`BTC-USDT`
toTag | String | [可選]交易對，收款賬戶類型爲`isolated`時必填，例如：`BTC-USDT`

### 返回值
字段 | 含義
--------- | -------
orderId | 內部資金劃轉的訂單ID

# 充值

## 申請充值地址
```json
{
    "address":"0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
    "memo":"5c247c8a03aa677cea2a251d",
    "chain":"OMNI"
}
```

此接口可用於申請充值地址

### HTTP請求
`POST /api/v1/deposit-addresses`

### 請求示例
`POST /api/v1/deposit-addresses`

### API權限
此接口需要**提現權限**。

### 請求參數

請求參數 | 類型 | 含義
--------- | ------- |  -------
currency | String | [幣種](#47f0f7e8df)
chain | String | [可選] 幣種的鏈名。例如，對於USDT，現有的鏈有OMNI、ERC20、TRC20。默認值爲ERC20。對於BTC，現有的鏈有Native、Segwit、TRC20，參數分別爲bech32、btc、trx。默認值爲Native。這個參數用於區分多鏈的幣種，單鏈幣種不需要。 

### 返回值
字段 | 含義
--------- | -------
address | 充值地址
memo | 地址標籤memo(tag)，如果返回爲空，則該幣種沒有memo。對於沒有memo的幣種，在[提現](#5a3e3653c8-2)的時候不可以傳遞memo
chain | 幣種的鏈名。例如，對於USDT，現有的鏈有OMNI、ERC20、TRC20。默認值爲ERC20。對於BTC，現有的鏈有Native、Segwit、TRC20，參數分別爲bech32、btc、trx。默認值爲Native。

## 獲取充值地址(V2)
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

此接口可以獲取幣種所有支持鏈的充值地址，如果返回數據爲空，請先[申請充值地址](#c424eb7b8c)。

### HTTP請求
`GET /api/v2/deposit-addresses`

### 請求示例
`GET /api/v2/deposit-addresses?currency=BTC`

### API權限
此接口需要**通用權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | -------  | -------
currency | String |[幣種](#47f0f7e8df)

### 返回值
字段 | 含義
--------- | -------
address | 充值地址
memo | 地址標籤memo(tag)，如果返回爲空，則該幣種沒有memo。對於沒有memo的幣種，在[提現](#081737423d)的時候不可以傳遞memo
chain | 幣種的鏈名
contractAddress | 合約地址


## 獲取充值地址
```json
{
    "address":"0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
    "memo":"5c247c8a03aa677cea2a251d",
    "chain":"ERC20"
}
```
此接口，可獲取某一幣種的充值地址，如果返回數據爲空，請先[申請充值地址](#9277fb3f66)。

### HTTP請求
`GET /api/v1/deposit-addresses`

### 請求示例
`GET /api/v1/deposit-addresses`

### API權限
此接口需要**通用權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | -------  | -------
currency | String |[幣種](#47f0f7e8df)
chain | String | [可選] 幣種的鏈名。例如，對於USDT，現有的鏈有OMNI、ERC20、TRC20。默認值爲ERC20。對於BTC，現有的鏈有Native、Segwit、TRC20，參數分別爲bech32、btc、trx。默認值爲Native。這個參數用於區分多鏈的幣種，單鏈幣種不需要。 

### 返回值
字段 | 含義
--------- | -------
address | 充值地址
memo | 地址標籤memo(tag)，如果返回爲空，則該幣種沒有memo。對於沒有memo的幣種，在[提現](#081737423d)的時候不可以傳遞memo
chain | 幣種的鏈名。例如，對於USDT，現有的鏈有OMNI、ERC20、TRC20。默認值爲ERC20。對於BTC，現有的鏈有Native、Segwit、TRC20，參數分別爲bech32、btc、trx。默認值爲Native。 

## 獲取充值列表
```json
{
    "code": "200000",
    "data": {
        "currentPage": 1,
        "pageSize": 50,
        "totalNum": 1,
        "totalPage": 1,
        "items": [
            {
                "currency": "XRP",
                "chain": "xrp",
                "status": "SUCCESS",
                "address": "rNFugeoj3ZN8Wv6xhuLegUBBPXKCyWLRkB",
                "memo": "1919537769",
                "isInner": false,
                "amount": "20.50000000",
                "fee": "0.00000000",
                "walletTxId": "2C24A6D5B3E7D5B6AA6534025B9B107AC910309A98825BF5581E25BEC94AD83B@e8902757998fc352e6c9d8890d18a71c",
                "createdAt": 1666600519000,
                "updatedAt": 1666600549000,
                "remark": "Deposit"
            }
        ]
    }
}
```
此端點，可獲取充值分頁列表。
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

### HTTP請求
`GET /api/v1/deposits`

### 請求示例
`GET /api/v1/deposits`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**6次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
請求參數 | 類型 | 含義 
--------- | ------- | -------
currency | String | [可選][幣種](#47f0f7e8df)
startAt| long | [可選]開始時間（毫秒）
endAt| long | [可選]截止時間（毫秒）
status | String | [可選]狀態。可選值: `PROCESSING`, `SUCCESS`, `FAILURE`

### 返回值
字段 | 含義
--------- | -------
address | 充值地址
memo | 地址標籤memo(tag)，如果返回爲空，則該幣種沒有memo。對於沒有memo的幣種，在[提現](#081737423d)的時候不可以傳遞memo
amount | 充值金額
fee | 充值手續費
currency | 幣種
isInner | 是否爲平臺內部充值
walletTxId | 錢包交易Id
status | 狀態
remark | 備註
createdAt | 創建時間
updatedAt | 修改時間


## 獲取V1歷史充值列表
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
此接口，可獲取KuCoin V1的充值記錄。
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

<aside class="notice">默認查詢一個月的數據</aside>

### HTTP請求
`GET /api/v1/hist-deposits`

### 請求示例
`GET /api/v1/hist-deposits`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**6次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------  
currency | String | [可選] [幣種](#47f0f7e8df)
status | String | [可選] 狀態。可選值: PROCESSING, SUCCESS, and FAILURE
startAt| long | [可選] 開始時間（毫秒）
endAt| long | [可選] 截止時間（毫秒）  

### 返回值
字段 | 含義
--------- | -------
amount | 充值金額
currency | 幣種
isInner | 是否爲平臺內充值
walletTxId | 錢包交易Id
status | 狀態
createAt | 創建時間


# 提現

## 獲取提現列表
```json
{
    "code": "200000",
    "data": {
        "currentPage": 1,
        "pageSize": 50,
        "totalNum": 1,
        "totalPage": 1,
        "items": [
            {
                "id": "63564dbbd17bef00019371fb",
                "currency": "XRP",
                "chain": "xrp",
                "status": "SUCCESS",
                "address": "rNFugeoj3ZN8Wv6xhuLegUBBPXKCyWLRkB",
                "memo": "1919537769",
                "isInner": false,
                "amount": "20.50000000",
                "fee": "0.50000000",
                "walletTxId": "2C24A6D5B3E7D5B6AA6534025B9B107AC910309A98825BF5581E25BEC94AD83B",
                "createdAt": 1666600379000,
                "updatedAt": 1666600511000,
                "remark": "test"
            }
        ]
    }
}
```

### HTTP請求
`GET /api/v1/withdrawals`

### 請求示例
`GET /api/v1/withdrawals`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**6次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | ---------
currency | String |  [可選] [幣種](#47f0f7e8df)
status | String | [可選] 狀態。可選值: `PROCESSING`, `WALLET_PROCESSING`, `SUCCESS`, `FAILURE`
startAt| long | [可選] 開始時間（毫秒）
endAt| long | [可選] 截止時間（毫秒）

### 返回值
字段 |  含義
--------- | -------
id | 唯一標識
address | 提現地址
memo | 提現地址標識
currency | 幣種
chain | 幣種chain
amount | 提現金額
fee | 提現手續費
walletTxId | 錢包交易Id
isInner | 是否爲平臺內部提現
status | 狀態
remark | 備註
createdAt | 創建時間
updatedAt | 修改時間


## 獲取V1歷史提現列表
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
此接口，可獲取KuCoin V1的提現記錄。
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

<aside class="notice">默認查詢一個月的數據</aside>

### HTTP請求
`GET /api/v1/hist-withdrawals`

### 請求示例
`GET /api/v1/hist-withdrawals`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**6次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------  
currency | String | [可選] [幣種](#47f0f7e8df)
status | String | [可選] 狀態。可選值: PROCESSING, SUCCESS, FAILURE
startAt| long | [可選] 開始時間（毫秒）
endAt| long | [可選]  截止時間（毫秒）

### 返回值
字段 | 含義
--------- | -------
amount | 提現金額
currency | 幣種
isInner | 是否爲平臺內部提現
walletTxId | 錢包交易Id
createAt |  創建時間
status | 狀態


##  獲取提現額度
```json
{
  "data" : {
    "limitBTCAmount" : "37.83993375",
    "quotaCurrency" : "USDT",
    "chain" : "BTC",
    "remainAmount" : "37.83993375",
    "innerWithdrawMinFee" : "0",
    "usedBTCAmount" : "0.00000000",
    "limitQuotaCurrencyAmount" : "1000000.00000000",
    "withdrawMinSize" : "0.0008",
    "withdrawMinFee" : "0.0005",
    "precision" : 8,
    "reason" : null,
    "usedQuotaCurrencyAmount" : "0",
    "currency" : "BTC",
    "availableAmount" : "0",
    "isWithdrawEnabled" : true
  },
  "code" : "200000"
}
```

### HTTP請求
`GET /api/v1/withdrawals/quotas`

### 請求示例
`GET /api/v1/withdrawals/quotas?currency=BTC`

### API權限
此接口需要**通用權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | ---------
currency | String | [幣種](#47f0f7e8df)
chain | String | [可選] 幣種chain。這個參數用於區分多鏈的幣種，單鏈幣種不需要；你可通過`GET /api/v2/currencies/{currency}`接口查詢幣種的`chain`值.

### 返回值
字段 | 含義
--------- | -------
currency | 幣種
availableAmount | 可提現的金額
remainAmount | 當日剩餘可提現的額度
withdrawMinSize | 最小提現金額
limitBTCAmount | 24小時總提現額度，摺合爲BTC
innerWithdrawMinFee | 內部提現手續費
usedBTCAmount | 當日BTC摺合提現
isWithdrawEnabled | 是否可提現
withdrawMinFee | 最小提現手續費
precision | 提現的精度
chain | 幣種的鏈名。例如，對於USDT，現有的鏈有OMNI、ERC20、TRC20。默認值爲ERC20。
quotaCurrency | 提幣限額幣種
limitQuotaCurrencyAmount | 當日折合可提現數量（提現限額幣種）
usedQuotaCurrencyAmount | 當日折合已提現數量（提現限額幣種）

## 申請提現
```json
{
    "withdrawalId":"5bffb63303aa675e8bbe18f9"
}
```

### HTTP請求
`POST /api/v1/withdrawals`

<aside class="notice">在WEB端可以開啓指定常用地址提現，開啓後會校驗你的提現地址(地址區分字母大小寫,包括chain的設置)是否爲常用地址；若校驗不通過會提示<code>{"msg":"Already set withdraw whitelist, this address is not favorite address","code":"260325”}</code>錯誤信息。</aside>

### API權限
此接口需要`提現權限`。

### 請求參數
請求參數 | 類型 |含義
--------- | ------- |  -------
currency  | String | 幣種
address   | String | 提現地址
amount | number | 提現總額，必須爲提現精度的正整數倍
memo | String | [可選] 地址標籤memo(tag)，如果返回爲空，則該幣種沒有memo。對於沒有memo的幣種，在[提現](#081737423d)的時候不可以傳遞memo
isInner | boolean | [可選] 是否爲平臺內部提現。默認爲`false`
remark | String | [可選] 備註信息
chain | String | [可選] 針對一幣多鏈的幣種，推薦指定chain參數；不指定則使用默認鏈；你可通過`GET /api/v2/currencies/{currency}`接口查詢幣種的`chain`值。
feeDeductType | String | [可選] 提現手續費扣除方式: `INTERNAL` 或 `EXTERNAL` 或不指定 <br/><br/>1. `INTERNAL`- 從提現金額中扣除手續費</br>2. `EXTERNAL`- 從儲蓄賬戶中扣除手續費</br>3. 不指定`feeDeductType`參數時, 當您的儲蓄賬戶的餘額足以支持支付提現手續費時，首先從您的儲蓄賬戶中扣除手續費，反之，從您的提現金額中扣除手續費。比如，您從KuCoin提現 1 個BTC(提現手續費爲：0.0001BTC)，如果您儲蓄賬戶裏的餘額不支持支付手續費，系統將會自動從您的提現金額中扣除手續費，您實際到賬金額爲0.9999個BTC。

### 返回值
字段 | 含義
--------- | -------
withdrawalId | 提現Id 唯一標識


## 取消提現
提現狀態爲提現中纔可以取消。

### HTTP請求
`DELETE /api/v1/withdrawals/{withdrawalId}`

### 請求示例
`DELETE /api/v1/withdrawals/5bffb63303aa675e8bbe18f9`

### API權限
此接口需要**提現權限**。

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
withdrawalId | String | 路徑參數，[提現Id](#5a3e3653c8-2) 唯一標識


# 手續費

## 用戶基礎手續費

此接口返回用戶的基礎費率。

```json
{
    "code": "200000",
    "data": {
        "takerFeeRate": "0.001",
        "makerFeeRate": "0.001"
    }
}
```

### HTTP請求
`GET /api/v1/base-fee`

### 請求示例
`GET /api/v1/base-fee`
<br/>
`GET /api/v1/base-fee?currencyType=1`

### API權限
此接口需要`通用權限`。

### 請求參數  
請求參數|數據類型|是否必需|含義
---|---|---|---
currencyType|String|否|幣種類型: `0`-數字貨幣, `1`-法幣. 默認爲`0`-數字貨幣

### 返回值
字段 |  含義
--------- | -------
takerFeeRate | 用戶吃單基礎手續費率
makerFeeRate | 用戶掛單基礎手續費率

## 交易對實際費率
此接口返回用戶交易時實際費率，一次限制最多查10個交易對，子用戶的費率和母用戶保持一致。

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

### HTTP請求
`GET /api/v1/trade-fees`

### 請求示例
`GET /api/v1/trade-fees?symbols=BTC-USDT,KCS-USDT`

### API權限
此接口需要`通用權限`。

### 請求參數  
請求參數|數據類型|是否必需|含義
---|---|---|---
symbols|String|是| 交易對，可多填，逗號分割，一次限制最多查`10`個交易對

### 返回值
字段 |  含義
--------- | -------
symbol | 交易對唯一標識碼，重命名後不會改變
takerFeeRate | 交易對吃單實際手續費率
makerFeeRate | 交易對掛單實際手續費率


# 交易模塊

以下請求需要校驗[簽名](#99f215f459)。


# 訂單

## 下單

```json
{
    "orderId":"5bd6e9286d99522a52e458de"
}
```

訂單有兩種類型：
限價單（**limit**）: 指定價格和數量進行交易。
市價單(**market**) : 指定資金或數量進行交易。

在下單前，請確保您的[交易賬戶/槓桿賬戶](#88d7ca20ae)有足夠的資金。一旦下單成功，您下單的金額會被凍結。[凍結金額](#HOLDS)的多少取決於您下單的類型和具體的請求參數。
<aside class="notice">下單將啓用價格保護機制。當限價單的價格在閾值範圍之外時，會觸發價格保護機制，導致下單失敗。</aside>


請悉知，當您的訂單進入買賣盤，系統會提前凍結[訂單的手續費](#052bf0ef58)。

在下單之前，請充分了解每一個[交易對](#d6402cad41)的參數含義。

**請求體中的JSON字符串中不要有多餘的空格**

### 下單限制
對於一個賬號，每一個交易對最大活躍委託訂單數量 **200** （包含止損單）。

### HTTP 請求
`POST /api/v1/orders`

### 請求示例
`POST /api/v1/orders`

### API權限
此接口需要**現貨交易權限** 或 **槓桿交易權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**45次/3s**

### 請求參數

下單公有的請求參數

| 請求參數      | 類型     | 含義                                                                                    |
| --------- | ------ | ------------------------------------------------------------------------------------- |
| clientOid | String | Client Order Id，客戶端創建的唯一標識，建議使用UUID，最大長度為128位                                                  |
| side      | String | **buy**（買） 或 **sell**（賣）                                                              |
| symbol    | String | [交易對](#d6402cad41) 比如，ETH-BTC                                                         |
| type      | String | [可選] 訂單類型 **limit** 和  **market** (默認爲 **limit**)                                     |
| remark    | String | [可選] 下單備註，長度不超過100個字符（UTF-8）                                                          |
| stp       | String | [可選] [自成交保護](#stp)（self trade prevention）分爲**CN**, **CO**, **CB** , **DC**四種策略 |
| tradeType       | String | [可選] 交易類型，分爲**TRADE**（現貨交易）, **MARGIN_TRADE**（槓桿交易）（默認爲**TRADE** ）。**另請注意：爲了提升系統性能和下單速度，我們新增單獨的槓桿訂單接口，請還在此接口下槓桿訂單的用戶儘快遷移至新槓桿訂單接口。此接口將於2020年5月1日（UTC+8）不再接受槓桿訂單，屆時我們將提前公告用戶。** |
#### **limit** 限價單額外所需請求參數

| 請求參數        | 類型      | 含義                                                          |
| ----------- | ------- | ----------------------------------------------------------- |
| price       | String  | 指定幣種的價格                                                     |
| size        | String  | 指定幣種的數量                                                     |
| timeInForce | String  | [可選] 訂單時效策略 **GTC**, **GTT**, **IOC**, **FOK** (默認爲**GTC**) |
| cancelAfter | long    | [可選] **n** 秒之後取消，訂單時效策略爲 **GTT**                            |
| postOnly    | boolean | [可選] 被動委託的標識, 當訂單時效策略爲 **IOC** 或 **FOK** 時無效                |
| hidden      | boolean | [可選] 是否隱藏（買賣盤中不展示）                                          |
| iceberg     | boolean | [可選] 冰山單中是否僅顯示訂單的可見部分                                       |
| visibleSize | String  | [可選] 冰山單最大的展示數量                                             |

#### **market** 市價單額外所需請求參數

請求參數 | 類型 | 含義
--------- | ------- | ------- | ---------
size | String | 否（size和funds 二選一） | 下單數量
funds | String |  否（size和funds 二選一）| 下單資金

* 下市價單，需定買賣數量或資金。

###術語解釋

###交易對(Symbol)

交易對必須是KuCoin支持的[交易對](#d6402cad41)。

###Client Order Id(clientOid)

ClientOid字段是客戶端創建的唯一ID（推薦使用UUID），只能包含數字、字母、下劃線（_） 和 分隔線（-）。這個字段會在獲取訂單信息時返回。您可使用clientOid來標識您的訂單。ClientOid不同於服務端創建的訂單ID。請不要使用同一個clientOid發起請求。clientOid最長不得超過40個字符。

請妥善記錄服務端創建的orderId，以用於查詢訂單狀態的更新。

###訂單類型(type)

您在下單時指定的訂單類型，決定了您是否需要請求其他參數，同時還會影響到撮合引擎的執行。如果您在下單時未指定訂單類型，系統將默認按照限價單執行。

下限價單時，您需指定限價單的價格（**price**）和數量（**size**）。系統將根據市場行情以指定或更優價格撮合該訂單。如果訂單未能被立即撮合，將繼續留買賣盤中，直至被撮合或被用戶取消。

與限價單不同，市價單價格會隨着市場價格波動而變化。下市價單時，您無需指定價格，只需指定數量。市價單會立即成交，不會進入買賣盤。所有市價單都是taker，需支付taker費用。

###交易類型(tradeType)
目前平臺支持現貨（**TRADE**）與槓桿（**MARGIN_TRADE**）兩種資產交易下單。系統根據您的參數類型，將對指定賬戶資金進行凍結。若未傳遞該參數，將默認按照現貨凍結您交易賬戶資金。**另請注意：爲了提升系統性能和下單速度，我們新增單獨的槓桿訂單接口，請還在此接口下槓桿訂單的用戶儘快遷移至新槓桿訂單接口。此接口將於2020年5月1日（UTC+8）不再接受槓桿訂單，屆時我們將提前公告用戶。**

###價格(Price)
下限價單時，price 必須以交易對的[價格增量 priceIncrement](#d6402cad41)爲基準，價格增量是交易對的價格的精度。比如，對BTC-USDT這個交易對, 它的 priceIncrement 爲0.00001000。那麼你下單的 price 不可以小於0.00001000，且爲 priceIncrement 的正整數倍，否則下單時會報錯，invalid priceIncrement。

###數量(Size)
下限價單時，size 是指交易對的交易對象(即寫在靠前部分的資產名)的數量。size 必須以交易對中的[數量增量 baseIncrement](#d6402cad41)爲基準，數量增量是交易對的數量的精度。下單的 size 爲 baseIncrement 的正整數倍並且必須在 baseMinSize 和 baseMaxSize 之間。

###資金(Funds)
下市價單時，funds 字段是指交易對的定價資產(即寫在靠後部分資產名)的資金。funds 必須以交易對中的[資金增量quoteIncrement](#d6402cad41)爲基準，資金增量是交易對的資金的精度。下單的 funds 爲 quoteIncrement 的正整數倍且必須在 quoteMinSize 和 quoteMaxSize 之間。

###訂單時效策略(TimeInForce)
訂單時效是一種交易時使用的特殊策略，用於設定訂單在被撮合或取消前的生效時間。訂單時效策略分爲四種：

| 縮寫  | 全稱                  | 含義                         |
| --- | ------------------- | -------------------------- |
| GTC | Good Till Canceled  | 主動取消才過期                    |
| GTT | Good Till Time      | 指定時間後過期                    |
| IOC | Immediate Or Cancel | 立即成交可成交的部分，然後取消剩餘部分，不進入買賣盤 |
| FOK | Fill Or Kill        | 如果下單不能全部成交，則取消             |

* 注意，成交也包含自成交。市價單並不支持訂單時效策略(TimeInForce)

###被動委託(PostOnly)

postOnlys只是一個標識，如果下單有能立即成交的對手方，則取消。
* 當用戶所下訂單是postonly訂單時，如果訂單進入撮合引擎後遇到冰山單和隱藏單可以立即成交，postonly 訂單收maker 手續費，冰山單和隱藏單收taker手續費。

###隱藏單和冰山單(Hidden & Iceberg)

您可在高級設置中設置隱藏單和冰山單（冰山單是一種特殊形式的隱藏單）。進行限價單和限價止損單交易時，您可選擇按照隱藏單或冰山單執行。

隱藏單不會展示在買賣盤上。

與隱藏單不同，冰山單分爲可見和隱藏兩部分。進行冰山單交易時，需設置可見訂單數量。冰山單最小可見數量是總訂單量的1/20。

進行撮合時，冰山單的可見部分會首先被撮合，當可見部分被全部撮合後，另一部分隱藏訂單將浮出，直至訂單全部成交。

**注意**：

- 系統將對隱藏和冰山單收取taker費用。
- 如果您同時設定了冰山單和隱藏單，您的訂單將默認作爲冰山單處理。

###凍結策略(Hold)
對於限價買單，我們會從您的資金裏面凍結您買單的金額(price * size)。同樣，對於限價賣單，我們也會凍結您賣單的資產。在成交那一刻評估實際的手續費。如果您取消了一個部分成交或未成交的訂單，那麼剩餘金額會解凍會退到您的賬戶。
對於市價買/賣單，需要指定**funds(資金)**，我們會根據funds來凍結您賬戶裏的資金。如果只指定了**size**，在成交或取消之前，您的賬戶所有資金會被凍結（通常凍結時間非常短）。

###自成交保護(SelfTradePrevention)

您可在高級設置中設置自成交保護策略。您的訂單將不會發生自成交。如果您在下單時沒有指定STP，否則您的訂單可能會被自己的訂單成交。市價單現不支持DC策略。

**市價單現不支持 DC**，當*timeInForce* 爲**FOK**， 那麼stp會指定爲**CN**。

| 縮寫  | 全稱                  | 含義                           |
| --- | ------------------- | ---------------------------- |
| DC  | Decrease and Cancel | 取消數量少的一方的訂單，並將數量多的一方數量改爲新舊差值 |
| CO  | Cancel old          | 取消舊的訂單                       |
| CN  | Cancel new          | 取消新的訂單                       |
| CB  | Cancel both         | 雙方都取消                        |

### 訂單生命週期(ORDER LIFECYCLE)

當下單請求因請求成功（撮合引擎已收到訂單）或（因餘額不足、參數不合法等原因）被拒絕時，HTTP 請求會進行響應。下單成功，返回訂單ID，訂單將被撮合，可能會部分或全部成交。部分成交後，訂單剩餘爲未成交部分會變成等待撮合（**Active**）狀態（不包括使用立即成交或取消[IOC]的訂單）。已完全成交的訂單會變成“已完成”（**Done**）狀態。

訂閱市場數據頻道的用戶可使用訂單ID（**orderId**）和用戶訂單ID（**clientOid**）來識別消息。

### 價格保護機制

下單將啓用價格保護機制。具體規則如下

- 若用戶在幣幣交易所下的市價單/限價單可以與當前買賣盤內訂單直接成交，那麼系統會判斷成交深度對應的價格與同方向盤口價的偏差是否超出閾值（閾值可根據API symbol接口獲取）；

- 若超過，當您是限價單時，該訂單會提示下單失敗；

- 若是市價單則此訂單將被系統部分執行，執行上限爲閾值對應的價格內的訂單數量，其他剩餘訂單將不被成交。

舉例說明：若閾值爲10%，當某用戶在KCS/USDT交易區下了10,000 USDT的市價買單時(此時賣一價爲1.20000)，系統會判斷訂單成交後最新成交價爲1.40000。(1.40000-1.20000)/1.20000=16.7%>10%，而閾值價格爲1.32000，此時，用戶的這筆市價買單將最多被成交至1.32000，其他剩餘訂單則不會和買賣盤內訂單進行撮合。
請注意：該功能對深度的探測可能存在偏差，若您的訂單未被完全成交有可能是因爲超出了閾值的部分未成交。


### 返回值
| 字段                                | 含義   |
| --------------------------------- | ---- |
| orderId                           | 訂單Id |
| 下單成功後，會返回一個orderId字段，意味這訂單進入撮合引擎。 |      |

## 槓桿下單
```json
{
    "orderId":"5bd6e9286d99522a52e458de",
    "borrowSize":10.2,
    "loanApplyId":"600656d9a33ac90009de4f6f"
}
```

訂單有兩種類型：
限價單（`limit`）: 指定價格和數量進行交易。
市價單(`market`) : 指定資金或數量進行交易。

在下單前，請確保您的[槓桿賬戶](#a15fb3ce26)有足夠的資金。一旦下單成功，您下單的金額會被凍結。[凍結金額](#HOLDS)的多少取決於您下單的類型和具體的請求參數。
<aside class="notice">下單將啓用價格保護機制。當限價單的價格在閾值範圍之外時，會觸發價格保護機制，導致下單失敗。</aside>


請悉知，當您的訂單進入買賣盤，系統會提前凍結[訂單的手續費](#052bf0ef58)。

在下單之前，請充分了解每一個[交易對](#d6402cad41)的參數含義。

**請求體中的JSON字符串中不要有多餘的空格**

### 下單限制
對於一個賬號，每一個交易對最大活躍委託訂單數量`200`（包含止損單）。

### HTTP 請求
`POST /api/v1/margin/order`

### API權限
此接口需要`槓桿交易權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`45次/3s`

### 請求參數

下單公有的請求參數

| 請求參數      | 類型     | 含義                                                                                    |
| --------- | ------ | ------------------------------------------------------------------------------------- |
| clientOid | String | 客戶端創建的唯一標識，建議使用UUID                                                   |
| side      | String | `buy`（買） 或 `sell`（賣）                                                              |
| symbol    | String | [交易對](#d6402cad41) 比如，ETH-BTC                                                         |
| type      | String | [可選] 訂單類型 `limit`和`market`(默認爲 `limit`)                                     |
| remark    | String | [可選] 下單備註，長度不超過100個字符（UTF-8）                                                          |
| stp       | String | [可選] [自成交保護](#selftradeprevention)（self trade prevention）分爲`CN`, `CO`, `CB` , `DC`四種策略 |
| marginModel | String | [可選] 槓桿交易模式，分爲`cross`（全倉模式）, `isolated`（逐倉模式）, 默認爲`cross`。   |
| autoBorrow | boolean | [可選] 自動借幣下單，即系統自動以市場最優利率借幣再下單。 (目前只支持全倉不支持逐倉)，借幣下單時，不支持止盈止損                |
#### **limit** 限價單額外所需請求參數

| 請求參數        | 類型      | 含義                                                          |
| ----------- | ------- | ----------------------------------------------------------- |
| price       | String  | 指定幣種的價格                                                     |
| size        | String  | 指定幣種的數量                                                     |
| timeInForce | String  | [可選] 訂單時效策略:`GTC`, `GTT`, `IOC`, `FOK` (默認爲`GTC`) |
| cancelAfter | long    | [可選] `n`秒之後取消，訂單時效策略爲 `GTT`                            |
| postOnly    | boolean | [可選] 被動委託的標識, 當訂單時效策略爲`IOC`或`FOK` 時無效                |
| hidden      | boolean | [可選] 是否隱藏（買賣盤中不展示）                                          |
| iceberg     | boolean | [可選] 冰山單中是否僅顯示訂單的可見部分                                       |
| visibleSize | String  | [可選] 冰山單最大的展示數量                                             |

#### **market** 市價單額外所需請求參數

請求參數 | 類型 | 含義
--------- | ------- | ------- | ---------
size | String | 否（`size`和`funds`二選一） | 下單數量
funds | String |  否（`size`和`funds`二選一）| 下單資金

* 下市價單，需定買賣數量或資金。市價買單，funds參數必傳。

###術語解釋

###交易模式(marginModel)
交易模式有：全倉（`cross`）與逐倉（`isolated`），默認爲全倉模式。

### 自動借幣下單(autoBorrow)
自動借幣下單標識，如此字段爲`true`，則會根據下單量，自動借入下單所需的金額。默認爲`false`。如果下單量過大，超過了最大槓桿倍數或者風險限額閾值，則借幣失敗，下單也會失敗。目前只支持全倉（`cross`）借幣下單


### 返回值
| 字段                                | 含義   |
| --------------------------------- | ---- |
| orderId                           | 訂單Id |
| borrowSize                        | 借幣數量，只有在自動借幣下單後才返回 |
| loanApplyId                       | 借幣申請ID，只有在自動借幣下單後才返回 |

下單成功後，會返回一個`orderId`字段，意味這訂單進入撮合引擎。


## 批量下單
```json
//request
{
  "symbol": "KCS-USDT",
  "orderList": [
    {
      "clientOid": "3d07008668054da6b3cb12e432c2b13a",
      "side": "buy",
      "type": "limit",
      "price": "0.01",
      "size": "0.01"
    },
    {
      "clientOid": "37245dbe6e134b5c97732bfb36cd4a9d",
      "side": "buy",
      "type": "limit",
      "price": "0.01",
      "size": "0.01"
    }
  ]
}
```

該接口支持在一個接口中批量下單，每次可同時下5個訂單，訂單類型必須爲相同交易對的限價單（目前該接口只支持現貨交易，不支持槓桿交易）

### HTTP 請求
`POST /api/v1/orders/multi`

### 請求示例
```json
//response
{
  "data": [
    {
      "symbol": "KCS-USDT",
      "type": "limit",
      "side": "buy",
      "price": "0.01",
      "size": "0.01",
      "funds": null,
      "stp": "",
      "stop": "",
      "stopPrice": null,
      "timeInForce": "GTC",
      "cancelAfter": 0,
      "postOnly": false,
      "hidden": false,
      "iceberge": false,
      "iceberg": false,
      "visibleSize": null,
      "channel": "API",
      "id": "611a6a309281bc000674d3c0",
      "status": "success",
      "failMsg": null,
      "clientOid": "552a8a0b7cb04354be8266f0e202e7e9"
    },
    {
      "symbol": "KCS-USDT",
      "type": "limit",
      "side": "buy",
      "price": "0.01",
      "size": "0.01",
      "funds": null,
      "stp": "",
      "stop": "",
      "stopPrice": null,
      "timeInForce": "GTC",
      "cancelAfter": 0,
      "postOnly": false,
      "hidden": false,
      "iceberge": false,
      "iceberg": false,
      "visibleSize": null,
      "channel": "API",
      "id": "611a6a309281bc000674d3c1",
      "status": "success",
      "failMsg": null,
      "clientOid": "bd1e95e705724f33b508ed270888a4a9"
    }
  ]
}
```
`POST /api/v1/orders/multi`

### API權限
此接口需要`現貨交易權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`3次/3s`

### 請求參數

| 請求參數     | 類型     | 含義                                                                                    |
| ---------   | ------  | -------------------------------------------------------------------------------------- |
| clientOid   | String  | Client Order Id，客戶端創建的唯一標識，建議使用UUID                                          |
| side        | String  | **buy**（買） 或 **sell**（賣）                                                           |
| symbol      | String  | [交易對](#d6402cad41) 比如，ETH-BTC                                                       |
| type        | String  | [可選] 訂單類型 只能是**limit**(默認爲**limit**)                                |
| remark      | String  | [可選] 下單備註，長度不超過100個字符（UTF-8）                                                 |
| stop        | String  | [可選] 止盈止損單，觸發條件， **loss**（小於等於） 或 **entry**（大於等於）。設置後，就必須設置stopPrice參數。               |
| stopPrice   | String  | [可選] 觸發價格，只要設置stop參數，就必須設置此屬性。                                                        |
| stp         | String  | [可選] [自成交保護](#selftradeprevention)（self trade prevention）分爲**CN**, **CO**, **CB** , **DC**四種策略 |
| tradeType   | String  | [可選] 交易類型，默認爲**TRADE**                                                             |
| price       | String  | 指定貨幣的價格                                                     |
| size        | String  | 指定貨幣的數量                                                     |
| timeInForce | String  | [可選] 訂單時效策略 **GTC**, **GTT**, **IOC**, **FOK** (默認爲**GTC**) |
| cancelAfter | long    | [可選] **n** 秒之後取消，訂單時效策略爲 **GTT**                            |
| postOnly    | boolean | [可選] 被動委託的標識, 當訂單時效策略爲 **IOC** 或 **FOK** 時無效                |
| hidden      | boolean | [可選] 是否隱藏（買賣盤中不展示）                                          |
| iceberg     | boolean | [可選] 冰山單中是否僅顯示訂單的可見部分                                       |
| visibleSize | String  | [可選] 冰山單最大的展示數量                                             |

### 返回值
| 字段    | 含義                        |
| -------| --------------------------- |
|status  |  訂單創建結果 (success, fail) |
|failMsg |  失敗原因                    |


## 單個撤單
```json
{
    "cancelledOrderIds":[
        "5bd6e9286d99522a52e458de"
    ]
}
```

此端點可以取消單筆訂單。

<aside class="notice">此接口只提交取消請求。實際取消結果需要通過查詢訂單狀態或訂閱websocket獲取訂單消息。建議您在收到Open消息後再進行撤單，否則會導致訂單取消不成功。
</aside>

### HTTP請求
`DELETE /api/v1/orders/{orderId}`

### 請求示例
`DELETE /api/v1/orders/5bd6e9286d99522a52e458de`

### API權限
此接口需要`現貨交易權限` 或 `槓桿交易權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`60次/3s`

### 請求參數
| 請求參數    | 類型     | 含義                            |
| ------- | ------ | ----------------------------- |
| orderId | String | 路徑參數，[訂單Id](#6a338fcba8) 唯一標識 |

### 返回值
| 字段                | 含義      |
| ----------------- | ------- |
| cancelledOrderIds | 取消的訂單id |


<aside class="notice">The <b>orderId</b> 是服務器生成的訂單唯一標識，不是客戶端生成的clientOId</aside>

### 撤單被拒
如果訂單不能撤銷（已經成交或已經取消），會返回錯誤信息，可根據返回的msg獲取原因。


## 基於clientOid 單個撤單
```json
{
  "cancelledOrderId": "5f311183c9b6d539dc614db3",
  "clientOid": "6d539dc614db3"
}
```
此接口發送一個通過clientOid撤銷訂單的請求。

### HTTP請求
`DELETE /api/v1/order/client-order/{clientOid}`

### 請求示例
`DELETE /api/v1/order/client-order/6d539dc614db3`

### API權限
此接口需要`現貨交易權限` 或 `槓桿交易權限`。

### 請求參數
| 請求參數    | 類型     | 含義                            |
| ------- | ------ | ----------------------------- |
| clientOid | String | 路徑參數，客戶端生成的標識 |

### 返回值
| 字段                | 含義      |
| ----------------- | ------- |
| cancelledOrderId | 取消的訂單id |
| clientOid | 客戶端生成的標識 |


## 全部撤單
```json
{
    "cancelledOrderIds":[

        "5c52e11203aa677f33e493fb",
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
此接口，可以取消所有狀態爲**open**的訂單，返回值是是已取消訂單的ID列表。

### HTTP請求
`DELETE /api/v1/orders`

### 請求示例
`DELETE /api/v1/orders?symbol=ETH-BTC&tradeType=TRADE`<br/>
`DELETE /api/v1/orders?symbol=ETH-BTC&tradeType=MARGIN_ISOLATED_TRADE`

### API權限
此接口需要`現貨交易權限` 或 `槓桿交易權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`3次/3s`

### 請求參數
| 請求參數   | 類型     | 含義                                 |
| ------ | ------ | ---------------------------------- |
| symbol | String | [可選] 取消指定[交易對](#d6402cad41)的open訂單 |
| tradeType| String | [可選] 取消指定交易類型的open訂單:`TRADE`（現貨交易）, `MARGIN_TRADE`(全倉槓桿交易), `MARGIN_ISOLATED_TRADE`(逐倉槓桿交易), 默認爲取消`TRADE`(現貨交易)訂單                                 |

### 返回值
| 字段                | 含義      |
| ----------------- | ------- |
| cancelledOrderIds | 取消的訂單id |

## 獲取訂單列表
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
此接口，可獲取訂單列表
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

### HTTP請求
`GET /api/v1/orders`

### 請求示例
`GET /api/v1/orders?status=active`<br/>
`GET /api/v1/orders?status=active?tradeType=MARGIN_ISOLATED_TRADE`

### API權限
此接口需要`通用權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`30次/3s`

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
| 請求參數    | 類型     | 含義                                                                                            |
| ------- | ------ | --------------------------------------------------------------------------------------------- |
| status  | String | [可選] `active`（活躍） 或 `done`（完成）,默認爲`done`。只返回指定狀態的訂單信息                           |
| symbol  | String | [可選] 只返回指定[交易對](#d6402cad41)的訂單信息                                                             |
| side    | String | [可選] `buy`（買）或 `sell`（賣）                                                                 |
| type    | String | [可選] 訂單類型: `limit`（限價單）, `market`(市價單), `limit_stop`(限價止盈止損單), `market_stop`（市價止盈止損單） |
| tradeType    | String | [可選] 交易類型: `TRADE`（現貨交易）, `MARGIN_TRADE`(全倉槓桿交易), `MARGIN_ISOLATED_TRADE`(逐倉槓桿交易), 默認爲`TRADE`。|
| startAt | long   | [可選] 開始時間（毫秒）                                                                                 |
| endAt   | long   | [可選]  截止時間（毫秒）                                                                                |

### 返回值
| 字段            | 含義                                          |
| ------------- | ------------------------------------------- |
| id            | 訂單id，訂單唯一標識                                 |
| symbol        | 交易對                                         |
| opType        | 操作類型: DEAL                                  |
| type          | 訂單類型                                        |
| side          | 買或賣                                         |
| price         | 訂單價格                                        |
| size          | 下單數量                                        |
| funds         | 下單金額                                        |
| dealFunds     | 成交額                                         |
| dealSize      | 成交數量                                        |
| fee           | 手續費                                         |
| feeCurrency   | 計手續費幣種                                      |
| stp           | 自成交保護                                       |
| stop          | 止盈止損類型， entry:止盈; loss:止損                   |
| stopTriggered | 是否觸發止盈止損                                    |
| stopPrice     | 止盈止損觸發價格                                    |
| timeInForce   | 訂單時效策略                                      |
| postOnly      | 是否爲被動委託                                     |
| hidden        | 是否爲隱藏單                                      |
| iceberg       | 是否爲冰山單                                      |
| visibleSize   | 冰山單在買賣盤可見數量                                 |
| cancelAfter   | timeInForce 爲 GTT n秒後過期                     |
| channel       | 下單來源                                        |
| clientOid     | 客戶端生成的標識                                    |
| remark        | 訂單說明                                        |
| tags          | 訂單標籤                                        |
| isActive      | 訂單狀態 true: 訂單狀態爲 open;<br/> false: 訂單已成交或取消 |
| cancelExist   | 訂單是否存在取消記錄                                  |
| createdAt     | 創建時間                                        |
| tradeType     | 交易類型                                       |

### 訂單狀態和結算

在買賣盤上，所有委託都處於活躍（**Active**）狀態，從買賣盤上移除的訂單則被標記爲已完成（**Done**）狀態。

訂單被成交後到入賬，因系統清算可能會有毫秒級別的延遲。

您可發送請求，查詢任一狀態的訂單。如果您未指定狀態參數，系統將默認返回“已完結”（Done）狀態的訂單。

查詢“**active**”狀態的訂單，沒有時間限制。但查詢“已完成”狀態的訂單時，您只能獲取 7 * 24 小時時間範圍內的數據（即：查詢時，開始時間到結束時間的時間範圍不能超過24 * 7小時）。若超出時間範圍，系統會報錯。如果您只指定了結束時間，沒有指定開始時間，系統將按照 24小時的範圍自動計算開始時間（開始時間=結束時間-7*24小時）並返回相應數據，反之亦然。

已取消訂單的歷史記錄僅保留**一個月**。您將無法查詢一個月以前已取消的訂單。
已完成訂單的歷史記錄僅保留**六個月**。您將無法查詢六個月以前已完成的訂單。

<aside class="notice">檢索的總條目不能超過5萬條，如果超過，請縮短查詢時間範圍。</aside>
###訂單輪詢(Polling)

對於高頻交易的用戶，建議您在本地緩存和維護一份自己的活動委託列表，並使用市場數據流實時更新自己的訂單信息。

## 最近訂單記錄
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

此接口，可獲取最近24小時的1000條訂單數據。
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

### HTTP請求
`GET /api/v1/limit/orders`

### 請求示例
`GET /api/v1/limit/orders`

### API權限
此接口需要**通用權限**。

### 返回值
| 字段            | 含義                                          |
| ------------- | ------------------------------------------- |
| id            | 訂單id，訂單唯一標識                                 |
| symbol        | 交易對                                         |
| opType        | 操作類型: DEAL                                 |
| type          | 訂單類型                                        |
| side          | 買或賣                                         |
| price         | 訂單價格                                        |
| size          | 訂單數量                                        |
| funds         | 下單金額                                        |
| dealFunds     | 成交額                                         |
| dealSize      | 成交數量                                        |
| fee           | 手續費                                         |
| feeCurrency   | 計手續費幣種                                      |
| stp           | 自成交保護                                       |
| stop          | 止盈止損類型， entry:止盈; loss:止損                   |
| stopTriggered | 是否觸發止盈止損                                    |
| stopPrice     | 止盈止損觸發價格                                    |
| timeInForce   | 訂單時效策略                                      |
| postOnly      | 是否爲被動委託                                     |
| hidden        | 是否爲隱藏單                                      |
| iceberg       | 是否爲冰山單                                      |
| visibleSize   | 冰山單在買賣盤可見數量                                 |
| cancelAfter   | timeInForce 爲 GTT n秒後過期                     |
| channel       | 下單來源                                        |
| clientOid     | 客戶端生成的標識                                    |
| remark        | 訂單說明                                        |
| tags          | 訂單標籤                                        |
| isActive      | 訂單狀態 true: 訂單狀態爲 open;<br/> false: 訂單已成交或取消 |
| cancelExist   | 訂單是否存在取消記錄                                  |
| createdAt     | 創建時間                                        |
| tradeType     | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易)           |
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 單個訂單詳情
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
此接口，可以通過訂單id獲取單個訂單信息。

### HTTP請求
`GET /api/v1/orders/{orderId}`

### 請求示例
`GET /api/v1/orders/5c35c02703aa673ceec2a168`

### API權限
此接口需要**通用權限**。

### 請求參數
| 請求參數    | 類型     | 含義                            |
| ------- | ------ | ----------------------------- |
| orderId | String | 路徑參數，[訂單Id](#6a338fcba8) 唯一標識 |

### 返回值
| 字段            | 含義                                          |
| ------------- | ------------------------------------------- |
| id            | 訂單id，訂單唯一標識                                 |
| symbol        | 交易對                                         |
| opType        | 操作類型: DEAL                                  |
| type          | 訂單類型                                        |
| side          | 買或賣                                         |
| price         | 訂單價格                                        |
| size          | 訂單數量                                        |
| funds         | 下單金額                                        |
| dealFunds     | 成交額                                         |
| dealSize      | 成交數量                                        |
| fee           | 手續費                                         |
| feeCurrency   | 計手續費幣種                                      |
| stp           | 自成交保護                                       |
| stop          | 止盈止損類型， entry:止盈; loss:止損                   |
| stopTriggered | 是否觸發止盈止損                                    |
| stopPrice     | 止盈止損觸發價格                                    |
| timeInForce   | 訂單時效策略                                      |
| postOnly      | 是否爲被動委託                                     |
| hidden        | 是否爲隱藏單                                      |
| iceberg       | 是否爲冰山單                                      |
| visibleSize   | 冰山單在買賣盤可見數量                                 |
| cancelAfter   | timeInForce 爲 GTT n秒後觸發                     |
| channel       | 下單來源                                        |
| clientOid     | 客戶端生成的標識                                    |
| remark        | 訂單說明                                        |
| tags          | 訂單標籤                                        |
| isActive      | 訂單狀態 true: 訂單狀態爲 open;<br/> false: 訂單已成交或取消 |
| cancelExist   | 訂單是否存在取消記錄                                  |
| createdAt     | 創建時間                                        |
| tradeType     | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易)                                        |

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 基於clientOid 獲取單個訂單詳情
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
此接口，可以通過clientOid查詢單個訂單的信息，若訂單不存在則提示訂單不存在。

### HTTP請求
`GET /api/v1/order/client-order/{clientOid}`

### 請求示例
`GET /api/v1/order/client-order/6d539dc614db312`

### API權限
此接口需要**通用權限**。

### 請求參數
| 請求參數    | 類型     | 含義                            |
| ------- | ------ | ----------------------------- |
| clientOid | String | 路徑參數，客戶端生成的標識 |

### 返回值
| 字段            | 含義                                          |
| ------------- | ------------------------------------------- |
| id            | 訂單id，訂單唯一標識                                 |
| symbol        | 交易對                                         |
| opType        | 操作類型: DEAL                                  |
| type          | 訂單類型                                        |
| side          | 買或賣                                         |
| price         | 訂單價格                                        |
| size          | 訂單數量                                        |
| funds         | 下單金額                                        |
| dealFunds     | 成交額                                         |
| dealSize      | 成交數量                                        |
| fee           | 手續費                                         |
| feeCurrency   | 計手續費幣種                                      |
| stp           | 自成交保護                                       |
| stop          | 止盈止損類型， entry:止盈; loss:止損                   |
| stopTriggered | 是否觸發止盈止損                                    |
| stopPrice     | 止盈止損觸發價格                                    |
| timeInForce   | 訂單時效策略                                      |
| postOnly      | 是否爲被動委託                                     |
| hidden        | 是否爲隱藏單                                      |
| iceberg       | 是否爲冰山單                                      |
| visibleSize   | 冰山單在買賣盤可見數量                                 |
| cancelAfter   | timeInForce 爲 GTT n秒後觸發                     |
| channel       | 下單來源                                        |
| clientOid     | 客戶端生成的標識                                    |
| remark        | 訂單說明                                        |
| tags          | 訂單標籤                                        |
| isActive      | 訂單狀態 true: 訂單狀態爲 open					 |
| cancelExist   | 訂單是否存在取消記錄                                  |
| createdAt     | 創建時間                                        |
| tradeType     | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易)                                        |

# 成交明細

## 成交記錄
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
            "createdAt":1547026472000,
            "tradeType": "TRADE"
        }
    ]
}
```

此接口，可獲取最近的成交明細列表
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

### HTTP請求
`GET /api/v1/fills`

### 請求示例
`GET /api/v1/fills`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**9次/3s**

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
| 請求參數    | 類型     | 含義                                                                                            |
| ------- | ------ | --------------------------------------------------------------------------------------------- |
| orderId | String | [可選] 查詢該[訂單Id](#6a338fcba8) 的成交明細（如果指定了orderId，請忽略其他查詢條件）                                     |
| symbol  | String | [可選] 查詢指定[交易對](#d6402cad41)的成交明細                                                              |
| side    | String | [可選] **buy（買）** 或 **sell（賣）**                                                                 |
| type    | String | [可選] 訂單類型: **limit（限價單）**, **market(市價單)**, **limit_stop(限價止盈止損單)**, **market_stop（市價止盈止損單）** |
| startAt | long   | [可選] 開始時間（毫秒）                                                                                 |
| endAt   | long   | [可選]  截止時間（毫秒）                                                                                |
| tradeType  | String   | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易),默認為TRADE.                               |
### 返回值

| 字段             | 含義                       |
| -------------- | ------------------------ |
| symbol         | 交易對                      |
| tradeId        | 交易Id                     |
| orderId        | 訂單Id                     |
| counterOrderId | 對手方訂單Id                  |
| side           | 買或賣                      |
| forceTaker     | 是否強制作爲taker處理            |
| liquidity      | 流動性類型: taker 或 maker     |
| price          | 訂單價格                     |
| size           | 訂單數量                     |
| funds          | 成交額                      |
| fee            | 手續費                      |
| feeRate        | 手續費率                     |
| feeCurrency    | 計手續費幣種                   |
| stop           | 止盈止損類型，entry:止盈; loss:止損 |
| type           | 訂單類型limit 或 market       |
| createdAt      | 創建時間                     |
| tradeType     | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易)           |

**查詢時間範圍**
您可檢索一週時間範圍內的數據您範圍內檢索數據（默認從最近一天開始算起）。 若檢索時間範圍超過一週，系統將提示您超過時間限制。如果查詢只提供開始時間沒有提供結束時間，系統將自動計算結束時間（結束時間=開始時間+ 7*24小時），反之亦然。

<aside class="notice">檢索的總條目不能超過5萬條，如果超過，請縮短查詢時間範圍。</aside>
**結算**
結算分爲兩部分，一部分是成交結算，一部分是費用結算。當撮合完成後，這些數據將立即更新到我們的數據存儲區，系統將啓動結算並從您的預凍結資金中進行扣除。

**手續費**

KuCoin平臺上的訂單分爲兩種類型：Taker 和 Maker。Taker單會與買賣盤上的已有訂單立即成交，而Maker單則相反，會一直留在買賣盤中等待撮合。Taker單消耗了市場的流動性，因此會被收取taker費用，而Maker單增加了市場的流動性，會被收取較低的手續費甚至獲得手續費補貼。請注意：市價單、冰山單和隱藏單都會被扣除taker手續費。

下單時，系統會預凍結您賬戶中的taker費用。流動性（liquidity）字段中的參數說明了訂單將會被收取taker還是maker費用。

假設您的訂單是限價單，當您下單後在撮合引擎中被立即撮合，我們將收取您taker費用，而如果您的訂單沒有被立即撮合或有部分剩餘未被撮合都會進入買賣盤，進入買賣盤的訂單在未被取消前成交都會收取您maker手續費。

進入撮合後與對手盤訂單撮合，當指令訂單剩餘金額爲0，交易完成，如果剩餘資金不足以購買最低數量（0.00000001）的商品，則取消指令訂單。

如果您的訂單作爲maker被成交，我們會將剩餘預凍結的taker費用返還給您。

但需要注意的是:

- 當您創建了一個隱藏委託/冰山委託訂單時，即使它未被撮合引擎立即成交而被被動成交，仍然會收取taker費用
- 被動委託收取maker費用。如果該委託下單後會立刻與市場已有委託(除冰山/隱藏訂單外)撮合，那麼該委託將被取消。如果被動委託下單後與冰山/隱藏訂單立即成交，被動委託訂單將收取**maker**費用  

舉例：

以BTC/USDT爲例，假設您想市價買入1BTC，手續費率爲0.1%，市場買賣盤數據如下：

| Price（USDT） | Size（BTC）  | Side |
| ----------- | ---------- | ---- |
| 4200.00     | 0.18412309 | sell |
| 4015.60     | 0.56849308 | sell |
| 4011.32     | 0.24738383 | sell |
| 3995.64     | 0.84738383 | buy  |
| 3988.60     | 0.20484000 | buy  |
| 3983.85     | 1.37584908 | buy  |

 當您下一個買入市價單時，市場會立即成交，成交明細將分爲3筆，如下圖所示：

| Price（USDT） | Size（BTC）  | Fee（BTC）   |
| ----------- | ---------- | ---------- |
| 4011.32     | 0.24738383 | 0.00024738 |
| 4015.60     | 0.56849308 | 0.00056849 |
| 4200.00     | 0.18312409 | 0.00018312 |

## 最近成交記錄
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

此接口，可以獲取最近24小時1000條成交明細的列表
返回值是[分頁](#95d51b1f3b)後的數據，根據時間降序排序。

### HTTP請求
`GET /api/v1/limit/fills`

### 請求示例
`GET /api/v1/limit/fills`

### API權限
此接口需要**通用權限**。

### 返回值

| 字段             | 含義                        |
| -------------- | ------------------------- |
| symbol         | 交易對                       |
| tradeId        | 交易Id                      |
| orderId        | 訂單Id                      |
| counterOrderId | 對手方訂單Id                   |
| side           | 買或賣                       |
| forceTaker     | 是否強制作爲taker處理             |
| liquidity      | 流動性類型: taker 或 maker      |
| price          | 訂單價格                      |
| size           | 訂單數量                      |
| funds          | 成交額                       |
| fee            | 手續費                       |
| stop           | 止盈止損類型， entry:止盈; loss:止損 |
| tradeType     | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易)                                        |
| type           | 訂單類型，limit 或 market       |
| createdAt      | 創建時間                      |

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# 止盈止損

止盈止損單，是指當最新成交價格達到了設置的止損觸發價格（stopPrice）後，會生成一個訂單（限價/市價），訂單的撮合順序爲價格優先，然後時間優先。

**stop: 'loss'(止損):** 當最新成交價格小於等於**stopPrice**時觸發。

**stop: 'entry'(止盈):** 當最新成交價格大於等於**stopPrice**時觸發。

最新交易價格可以在最新[撮合執行數據](#54983ab383)裏面獲取。注意，由於Websocket消息有丟失的可能，無法接收所有撮合執行數據。

當您下一個止盈止損單時，系統不會凍結您賬戶中的資產。

## 下單
```json
{
  "orderId": "vs8hoo8kpkmklv4m0038lql0"
}
```
**請求體中的JSON字符串中不要有多餘的空格**

### 下單限制
對於一個賬號，每一個交易對最大止盈止損委託數量 **20** 。

### HTTP 請求
`POST /api/v1/stop-order`

### 請求示例
`POST /api/v1/stop-order`

### API權限
此接口需要**幣幣交易權限**或**槓桿交易權限**。

### 請求參數
下單公有的請求參數

| 請求參數  | 類型   | 含義                                                         |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | String | Client Order Id，客戶端創建的唯一標識，建議使用UUID，最大長度為40位          |
| side      | String | **buy**（買） 或 **sell**（賣）                              |
| symbol    | String | [交易對](#d6402cad41) 比如，ETH-BTC                          |
| type      | String | [可選] 訂單類型 **limit** 和 **market**，默認爲**limit**     |
| remark    | String | [可選] 下單備註，長度不超過100個字符（UTF-8）                |
| stop      | String | [可選] 止盈止損單，觸發條件， **loss**（小於等於） 或 **entry**（大於等於）。默認爲**loss** |
| stopPrice | String | 觸發價格。                                                   |
| stp       | String | [可選] [自成交保護](#selftradeprevention)（self trade prevention）分爲**CN**, **CO**, **CB** , **DC**四種策略，**type爲limit（限價單）時，不支持DC策略** |
| tradeType | String | [可選] 交易類型，分爲**TRADE**（現貨交易）, **MARGIN_TRADE**（槓桿交易）（默認爲**TRADE** ） |

#### **limit** 限價單額外所需請求參數

| 請求參數    | 類型    | 含義                                                         |
| ----------- | ------- | ------------------------------------------------------------ |
| price       | String  | 指定貨幣的價格                                               |
| size        | String  | 指定貨幣的數量                                               |
| timeInForce | String  | [可選] 訂單時效策略 **GTC**, **GTT**, **IOC**, **FOK** (默認爲**GTC**) |
| cancelAfter | long    | [可選] **n** 秒之後取消，訂單時效策略爲 **GTT**              |
| postOnly    | boolean | [可選] 被動委託的標識, 當訂單時效策略爲 **IOC** 或 **FOK** 時無效 |
| hidden      | boolean | [可選] 是否隱藏（買賣盤中不展示）                            |
| iceberg     | boolean | [可選] 冰山單中是否僅顯示訂單的可見部分                      |
| visibleSize | String  | [可選] 冰山單最大的展示數量                                  |

#### **market** 市價單額外所需請求參數

| 請求參數 | 類型   | 含義                     |
| -------- | ------ | ------------------------ |
| size     | String | 否（size和funds 二選一） |
| funds    | String | 否（size和funds 二選一） |

- 下市價單，需定買賣數量或資金

### 返回值
| 字段    | 含義                                        |
| ------- | ------------------------------------------- |
| orderId | 訂單Id。下單成功後，會返回一個orderId字段。 |

## 單個撤單
```json
{
  "cancelledOrderIds": [
    "611477889281bc0006d68aea"
  ]
}
```
此接口可以取消單筆止盈止損單。

一旦系統收到取消請求，您將收cancelledOrderIds字段。要知道請求是否已處理，您可以查詢訂單狀態或訂閱websocket獲取訂單消息。

### HTTP請求
`DELETE /api/v1/stop-order/{orderId}`

### 請求示例
`DELETE /api/v1/stop-order/5bd6e9286d99522a52e458de`

### 請求參數
| 請求參數 | 類型   | 含義                      |
| -------- | ------ | ------------------------- |
| orderId  | String | 路徑參數，訂單Id 唯一標識 |

### 返回值
| 字段              | 含義         |
| ----------------- | ------------ |
| cancelledOrderIds | 取消的訂單id |

### API權限
此接口需要**現貨交易權限** 或 **槓桿交易權限**。

**orderId** 是服務器生成的訂單唯一標識，不是客戶端生成的clientOid

### 撤單被拒
如果訂單不能撤銷（已經成交或已經取消），會返回錯誤信息，可根據返回的msg獲取原因。

## 按條件撤單
```json
{
  "cancelledOrderIds": [
    "vs8hoo8m4751f5np0032t7gk",
    "vs8hoo8m4758qjjp0037mslk",
    "vs8hoo8prp98qjjp0037q9gb",
    "vs8hoo8prp91f5np00330k6p"
  ]
}
```
此接口，可以取消當前活躍的止盈止損單，返回值是是已取消訂單的ID列表。

### HTTP請求
`DELETE /api/v1/stop-order/cancel`

### 請求示例
`DELETE /api/v1/stop-order/cancel?symbol=ETH-BTC&tradeType=TRADE&orderIds=5bd6e9286d99522a52e458de,5bd6e9286d99522a52e458df`

### API權限
此接口需要**現貨交易權限** 或 **槓桿交易權限**。

### 請求參數
| 請求參數  | 類型   | 含義                                                         |
| --------- | ------ | ------------------------------------------------------------ |
| symbol    | String | [可選] 取消指定[交易對](#d6402cad41)的open訂單               |
| tradeType | String | [可選] 取消指定交易類型的open 訂單（默認爲取消TRADE現貨交易訂單） |
| orderIds  | String | [可選] 指定訂單號，可以多個，用逗號分隔                      |

### 返回值
| 字段              | 含義         |
| ----------------- | ------------ |
| cancelledOrderIds | 取消的訂單id |

## 單個訂單詳情
```json
{
  "id": "vs8hoo8q2ceshiue003b67c0",
  "symbol": "KCS-USDT",
  "userId": "60fe4956c43cbc0006562c2c",
  "status": "NEW",
  "type": "limit",
  "side": "buy",
  "price": "0.01000000000000000000",
  "size": "0.01000000000000000000",
  "funds": null,
  "stp": null,
  "timeInForce": "GTC",
  "cancelAfter": -1,
  "postOnly": false,
  "hidden": false,
  "iceberg": false,
  "visibleSize": null,
  "channel": "API",
  "clientOid": "40e0eb9efe6311eb8e58acde48001122",
  "remark": null,
  "tags": null,
  "orderTime": 1629098781127530345,
  "domainId": "kucoin",
  "tradeSource": "USER",
  "tradeType": "TRADE",
  "feeCurrency": "USDT",
  "takerFeeRate": "0.00200000000000000000",
  "makerFeeRate": "0.00200000000000000000",
  "createdAt": 1629098781128,
  "stop": "loss",
  "stopTriggerTime": null,
  "stopPrice": "10.00000000000000000000"
}
```
此接口，可以通過訂單id獲取單個訂單信息。

### HTTP請求
`GET /api/v1/stop-order/{orderId}`

### 請求示例
`GET /api/v1/stop-order/5c35c02703aa673ceec2a168`

### API權限
此接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義                     |
| -------- | ------ | ------------------------ |
| orderId  | String | 路徑參數，訂單Id唯一標識 |

### 返回值
| 字段        | 含義                                                |
| ----------- | --------------------------------------------------- |
| id          | 訂單id，訂單唯一標識                                |
| symbol      | 交易對                                              |
| userId      | 用戶ID                                              |
| status      | 訂單狀態: **NEW（新建）**, **TRIGGERED(已觸發)**       |
| type        | 訂單類型                                            |
| side        | 買或賣                                              |
| price       | 訂單價格                                            |
| size        | 訂單數量                                            |
| funds       | 下單金額                                            |
| stp         | 自成交保護                                          |
| timeInForce | 訂單時效策略                                        |
| cancelAfter | timeInForce 爲 GTT n秒後觸發                        |
| postOnly    | 是否爲被動委託                                      |
| hidden      | 是否爲隱藏單                                        |
| iceberg     | 是否爲冰山單                                        |
| visibleSize | 冰山單在買賣盤可見數量                              |
| channel     | 下單來源                                            |
| clientOid   | 客戶端生成的標識                                    |
| remark      | 訂單說明                                            |
| tags        | 訂單標籤                                            |
| orderTime   | 止損單下單時間，精確到納秒                            |
| domainId    | 租戶ID                                            |
| tradeSource | 訂單來源: USER(用戶下單), MARGIN_SYSTEM(操盤系統下單)  |
| tradeType   | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易) |
| feeCurrency | 計手續費幣種                                        |
| takerFeeRate | taker的手續費費率                                  |
| makerFeeRate | maker的手續費費率                                  |
| createdAt   | 創建時間                                            |
| stop        | 止盈止損類型                                        |
| stopTriggerTime | 止損單觸發時間                                   |
| stopPrice   | 觸發價格                                            |

## 獲取止盈止損單列表
```json
{
  "currentPage": 1,
  "pageSize": 50,
  "totalNum": 1,
  "totalPage": 1,
  "items": [
    {
      "id": "vs8hoo8kqjnklv4m0038lrfq",
      "symbol": "KCS-USDT",
      "userId": "60fe4956c43cbc0006562c2c",
      "status": "NEW",
      "type": "limit",
      "side": "buy",
      "price": "0.01000000000000000000",
      "size": "0.01000000000000000000",
      "funds": null,
      "stp": null,
      "timeInForce": "GTC",
      "cancelAfter": -1,
      "postOnly": false,
      "hidden": false,
      "iceberg": false,
      "visibleSize": null,
      "channel": "API",
      "clientOid": "404814a0fb4311eb9098acde48001122",
      "remark": null,
      "tags": null,
      "orderTime": 1628755183702150167,
      "domainId": "kucoin",
      "tradeSource": "USER",
      "tradeType": "TRADE",
      "feeCurrency": "USDT",
      "takerFeeRate": "0.00200000000000000000",
      "makerFeeRate": "0.00200000000000000000",
      "createdAt": 1628755183704,
      "stop": "loss",
      "stopTriggerTime": null,
      "stopPrice": "10.00000000000000000000"
    }
  ]
}
```
此接口，可獲取訂單列表 返回值是[分頁](#95d51b1f3b)後的數據。

### HTTP請求
`GET /api/v1/stop-order`

### 請求示例
`GET /api/v1/stop-order`

### API權限
此接口需要**通用權限**。

這個接口需要使用分頁

### 請求參數
| 請求參數    | 類型   | 含義                                                         |
| ----------- | ------ | ------------------------------------------------------------ |
| symbol      | String | [可選] 只返回指定交易對的訂單信息                            |
| side        | String | [可選] **buy（買）** 或 **sell（賣）**                       |
| type        | String | [可選] 訂單類型: **limit（限價單）**, **market(市價單)**     |
| tradeType   | String | [可選] 交易類型: **TRADE（現貨交易）**, **MARGIN_TRADE(槓桿交易)** |
| startAt     | long   | [可選] 開始時間（毫秒）                                      |
| endAt       | long   | [可選] 截止時間（毫秒）                                      |
| currentPage | Int    | [可選] 當前頁號                                              |
| orderIds    | String | [可選] 訂單號列表，用逗號分隔                                |
| pageSize    | Int    | [可選] 每頁大小                                              |

### 返回值
| 字段        | 含義                                                |
| ----------- | --------------------------------------------------- |
| id          | 訂單id，訂單唯一標識                                |
| symbol      | 交易對                                              |
| userId      | 用戶ID                                              |
| status      | 訂單狀態: **NEW（新建）**, **TRIGGERED(已觸發)**       |
| type        | 訂單類型                                            |
| side        | 買或賣                                              |
| price       | 訂單價格                                            |
| size        | 訂單數量                                            |
| funds       | 下單金額                                            |
| stp         | 自成交保護                                          |
| timeInForce | 訂單時效策略                                        |
| cancelAfter | timeInForce 爲 GTT n秒後觸發                        |
| postOnly    | 是否爲被動委託                                      |
| hidden      | 是否爲隱藏單                                        |
| iceberg     | 是否爲冰山單                                        |
| visibleSize | 冰山單在買賣盤可見數量                              |
| channel     | 下單來源                                            |
| clientOid   | 客戶端生成的標識                                    |
| remark      | 訂單說明                                            |
| tags        | 訂單標籤                                            |
| orderTime        | 止損單下單時間，精確到納秒                       |
| domainId        | 租戶ID                                            |
| tradeSource     | 訂單來源: USER(用戶下單), MARGIN_SYSTEM(操盤系統下單)  |
| tradeType   | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易) |
| feeCurrency | 計手續費幣種                                        |
| takerFeeRate | taker的手續費費率                           |
| makerFeeRate | maker的手續費費率                           |
| createdAt   | 創建時間                                            |
| stop        | 止盈止損類型                                        |
| stopTriggerTime | 止損單觸發時間                                  |
| stopPrice   | 觸發價格                                            |

## 根據clientOid獲取單個訂單詳情
```json
[
  {
    "id": "vs8hoo8os561f5np0032vngj",
    "symbol": "KCS-USDT",
    "userId": "60fe4956c43cbc0006562c2c",
    "status": "NEW",
    "type": "limit",
    "side": "buy",
    "price": "0.01000000000000000000",
    "size": "0.01000000000000000000",
    "funds": null,
    "stp": null,
    "timeInForce": "GTC",
    "cancelAfter": -1,
    "postOnly": false,
    "hidden": false,
    "iceberg": false,
    "visibleSize": null,
    "channel": "API",
    "clientOid": "2b700942b5db41cebe578cff48960e09",
    "remark": null,
    "tags": null,
    "orderTime": 1629020492834532568,
    "domainId": "kucoin",
    "tradeSource": "USER",
    "tradeType": "TRADE",
    "feeCurrency": "USDT",
    "takerFeeRate": "0.00200000000000000000",
    "makerFeeRate": "0.00200000000000000000",
    "createdAt": 1629020492837,
    "stop": "loss",
    "stopTriggerTime": null,
    "stopPrice": "1.00000000000000000000"
  }
]
```
此接口，可以通過clientOid獲取單個止盈止損單信息。

### HTTP請求
`GET /api/v1/stop-order/queryOrderByClientOid`

### 請求示例
`GET /api/v1/stop-order/queryOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a`

### API權限
此接口需要**通用權限**。

### 請求參數
| 請求參數  | 類型   | 含義             |
| --------- | ------ | ---------------- |
| clientOid | String | 客戶端生成的標識 |
| symbol    | String | [可選] 交易對    |

### 返回值
| 字段        | 含義                                                |
| ----------- | --------------------------------------------------- |
| id          | 訂單id，訂單唯一標識                                |
| symbol      | 交易對                                              |
| userId      | 用戶ID                                              |
| status      | 訂單狀態: **NEW（新建）**, **TRIGGERED(已觸發)**       |
| type        | 訂單類型                                            |
| side        | 買或賣                                              |
| price       | 訂單價格                                            |
| size        | 訂單數量                                            |
| funds       | 下單金額                                            |
| stp         | 自成交保護                                          |
| timeInForce | 訂單時效策略                                        |
| cancelAfter | timeInForce 爲 GTT n秒後觸發                        |
| postOnly    | 是否爲被動委託                                      |
| hidden      | 是否爲隱藏單                                        |
| iceberg     | 是否爲冰山單                                        |
| visibleSize | 冰山單在買賣盤可見數量                              |
| channel     | 下單來源                                            |
| clientOid   | 客戶端生成的標識                                    |
| remark      | 訂單說明                                            |
| tags        | 訂單標籤                                            |
| orderTime   | 止損單下單時間，精確到納秒                            |
| domainId    | 租戶ID                                            |
| tradeSource | 訂單來源: USER(用戶下單), MARGIN_SYSTEM(操盤系統下單)  |
| tradeType   | 交易類型: TRADE（現貨交易）, MARGIN_TRADE(槓桿交易) |
| feeCurrency | 計手續費幣種                                        |
| takerFeeRate | taker的手續費費率                                  |
| makerFeeRate | maker的手續費費率                                  |
| createdAt   | 創建時間                                            |
| stop        | 止盈止損類型                                        |
| stopTriggerTime | 止損單觸發時間                                   |
| stopPrice   | 觸發價格                                            |

## 根據clientOid取消單個止盈止損單
```json
{
  "cancelledOrderId": "vs8hoo8ksc8mario0035a74n",
  "clientOid": "689ff597f4414061aa819cc414836abd"
}
```
此接口，可以通過clientOid取消單個止盈止損單。

### HTTP請求
`DELETE /api/v1/stop-order/cancelOrderByClientOid`

### 請求示例
`DELETE /api/v1/stop-order/cancelOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a`

### API權限
此接口需要**現貨交易權限** 或 **槓桿交易權限**。

### 請求參數
| 請求參數  | 類型   | 含義             |
| --------- | ------ | ---------------- |
| clientOid | String | 客戶端生成的標識 |
| symbol    | String | [可選] 交易對    |

### 返回值
| 字段             | 含義             |
| ---------------- | ---------------- |
| cancelledOrderId | 取消的訂單id     |
| clientOid        | 客戶端生成的標識 |


# 市場數據

市場數據是公共的，不需要驗證簽名。


# 交易對 & 行情快照

## 交易對列表(廢棄)
```json
{
    "code": "200000",
    "data": [
        {
            "symbol": "GALAX-USDT",
            "name": "GALA-USDT",
            "baseCurrency": "GALA",// 它並不準確, 應該是GALAX而不是GALA
            "quoteCurrency": "USDT",
            "feeCurrency": "USDT",
            "market": "USDS",
            "baseMinSize": "10",
            "quoteMinSize": "0.001",
            "baseMaxSize": "10000000000",
            "quoteMaxSize": "99999999",
            "baseIncrement": "0.0001",
            "quoteIncrement": "0.00001",
            "priceIncrement": "0.00001",
            "priceLimitRate": "0.1",
            "minFunds": "0.1",
            "isMarginEnabled": true,
            "enableTrading": true
        },
        {
            "symbol": "XLM-USDT",
            "name": "XLM-USDT",
            "baseCurrency": "XLM",
            "quoteCurrency": "USDT",
            "feeCurrency": "USDT",
            "market": "USDS",
            "baseMinSize": "0.1",
            "quoteMinSize": "0.01",
            "baseMaxSize": "10000000000",
            "quoteMaxSize": "99999999",
            "baseIncrement": "0.0001",
            "quoteIncrement": "0.000001",
            "priceIncrement": "0.000001",
            "priceLimitRate": "0.1",
            "minFunds": "0.1",
            "isMarginEnabled": true,
            "enableTrading": true
        }
    ]
}
```
此接口，可獲取交易對列表。如果您想獲取更多交易對的市場信息，可在[全局行情快照](#f3027c9902)中獲取。


### HTTP請求
`GET /api/v1/symbols`

<aside class="notice"><code>GET /api/v1/symbols</code>接口已被廢棄，因爲當交易對的<code>name</code>改名後， 響應中的<code>baseCurrency</code>也會對應改變，這並不準確。 所以推薦使用<code>GET /api/v2/symbols</code>接口</aside>

### 請求示例
`GET /api/v1/symbols`

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | ---------
market | String | [可選] [交易市場](#5666d37373) |

### 返回值
| 字段             | 含義                            |
| -------------- | ----------------------------- |
| symbol         | 交易對唯一標識碼，重命名後不會改變             |
| name           | 交易對名稱，重命名後會改變                 |
| baseCurrency   | 商品貨幣，指一個交易對的交易對象，即寫在靠前部分的資產名(不準確)  |
| quoteCurrency  | 計價幣種，指一個交易對的定價資產，即寫在靠後部分資產名   |
| market         | [交易市場](#5666d37373)                   |
| baseMinSize    | 下單時size的最小值                   |
| quoteMinSize   | 下市價單，funds的最小值                |
| baseMaxSize    | 下單，size的最大值                   |
| quoteMaxSize   | 下市價單，funds的最大值                |
| baseIncrement  | 數量增量，下單的size必須爲數量增量的正整數倍      |
| quoteIncrement | 市價單：資金增量，下單的funds必須爲資金增量的正整數倍 |
| priceIncrement | 限價單：價格增量，下單的price必須爲價格增量的正整數倍 |
| feeCurrency    | 交易計算手續費的幣種                   |
| enableTrading  | 是否可以用於交易                      |
| isMarginEnabled | 是否支持槓桿                        |
| priceLimitRate | 價格保護閾值                          |
| minFunds       | 最小交易金額                          |

- `baseMinSize` 和 `baseMaxSize` 這兩個字段規範了下單size的最小值和最大值。
- `priceIncrement` 字段規範了下單的price的最小值和價格增量。

下單的`price`必須爲價格增量的正整數倍（如果增量爲 0.01，下單價格是0.001或0.021的請求會被拒絕，返回invalid priceIncrement）

`priceIncrement` 和 `quoteIncrement` 以後可能會調整，調整前我們會提前以郵件和全站通知的方式進行通知。

委託單 | 遵循minFunds的規則
--------- | ------- | -----------
限價買單 | [委託數量*委託價格] >= `minFunds`
限價賣單 | [委託數量*委託價格] >= `minFunds`
市價買單 | 委託金額 >= `minFunds`
市價賣單 | [委託數量*BASE幣種最新成交價] >= `minFunds`

注：

* 對於API中按數量進行市價買單的情況，採用[委託數量*BASE幣種最新成交價]<`minFunds`進行判斷
* 對於API中按照金額進行市價賣單的情況，採用委託金額<`minFunds`進行判斷。
* 對於市價及限價止盈止損委託，委託時不受此限制，但委託觸發之後的下單後亦會受到此限制

## 交易對列表
```json
[
  {
    "symbol": "XLM-USDT",
    "name": "XLM-USDT",
    "baseCurrency": "XLM",
    "quoteCurrency": "USDT",
    "feeCurrency": "USDT",
    "market": "USDS",
    "baseMinSize": "0.1",
    "quoteMinSize": "0.01",
    "baseMaxSize": "10000000000",
    "quoteMaxSize": "99999999",
    "baseIncrement": "0.0001",
    "quoteIncrement": "0.000001",
    "priceIncrement": "0.000001",
    "priceLimitRate": "0.1",
    "minFunds": "0.1",
    "isMarginEnabled": true,
    "enableTrading": true
  },
  {
    "symbol": "VET-USDT",
    "name": "VET-USDT",
    "baseCurrency": "VET",
    "quoteCurrency": "USDT",
    "feeCurrency": "USDT",
    "market": "USDS",
    "baseMinSize": "10",
    "quoteMinSize": "0.01",
    "baseMaxSize": "10000000000",
    "quoteMaxSize": "99999999",
    "baseIncrement": "0.0001",
    "quoteIncrement": "0.000001",
    "priceIncrement": "0.0000001",
    "priceLimitRate": "0.1",
    "minFunds": "0.1",
    "isMarginEnabled": true,
    "enableTrading": true
  }
]
```
此接口，可獲取交易對列表。如果您想獲取更多交易對的市場信息，可在[全局行情快照](#f3027c9902)中獲取。


### HTTP請求
`GET /api/v2/symbols`

### 請求示例
`GET /api/v2/symbols`

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | ----------
market | String | [可選] [交易市場](#5666d37373)

### 返回值
| 字段             | 含義                            |
| -------------- | ----------------------------- |
| symbol         | 交易對唯一標識碼，重命名後不會改變             |
| name           | 交易對名稱，重命名後會改變                 |
| baseCurrency   | 商品貨幣，指一個交易對的交易對象，即寫在靠前部分的資產名  |
| quoteCurrency  | 計價幣種，指一個交易對的定價資產，即寫在靠後部分資產名   |
| market         | [交易市場](#5666d37373)                   |
| baseMinSize    | 下單時size的最小值                   |
| quoteMinSize   | 下市價單，funds的最小值                |
| baseMaxSize    | 下單，size的最大值                   |
| quoteMaxSize   | 下市價單，funds的最大值                |
| baseIncrement  | 數量增量，下單的size必須爲數量增量的正整數倍      |
| quoteIncrement | 市價單：資金增量，下單的funds必須爲資金增量的正整數倍 |
| priceIncrement | 限價單：價格增量，下單的price必須爲價格增量的正整數倍 |
| feeCurrency    | 交易計算手續費的幣種                   |
| enableTrading  | 是否可以用於交易                      |
| isMarginEnabled | 是否支持槓桿                        |
| priceLimitRate | 價格保護閾值                          |
| minFunds       | 最小交易金額                          |

- `baseMinSize` 和 `baseMaxSize` 這兩個字段規範了下單size的最小值和最大值。
- `priceIncrement` 字段規範了下單的price的最小值和價格增量。

下單的`price`必須爲價格增量的正整數倍（如果增量爲 0.01，下單價格是0.001或0.021的請求會被拒絕，返回invalid priceIncrement）

`priceIncrement` 和 `quoteIncrement` 以後可能會調整，調整前我們會提前以郵件和全站通知的方式進行通知。

委託單 | 遵循minFunds的規則
--------- | ------- | -----------
限價買單 | [委託數量*委託價格] >= `minFunds`
限價賣單 | [委託數量*委託價格] >= `minFunds`
市價買單 | 委託金額 >= `minFunds`
市價賣單 | [委託數量*BASE幣種最新成交價] >= `minFunds`

注：

* 對於API中按數量進行市價買單的情況，採用[委託數量*BASE幣種最新成交價]<`minFunds`進行判斷
* 對於API中按照金額進行市價賣單的情況，採用委託金額<`minFunds`進行判斷。
* 對於市價及限價止盈止損委託，委託時不受此限制，但委託觸發之後的下單後亦會受到此限制

## 行情快照
```json
//Get Ticker
{
    "sequence":"1550467636704",
    "price":"0.03715005",
    "size":"0.17",
    "bestAsk":"0.03715004",
    "bestAskSize":"1.788",
    "bestBid":"0.03710768",
    "bestBidSize":"3.803",
    "time":1550653727731
}
```
此接口，會返回level-1市場行情快照，買/最佳賣一價，買/賣一數量，最近成交價，最近成交數量。

### HTTP請求
`GET /api/v1/market/orderbook/level1`

### 請求示例
`GET /api/v1/market/orderbook/level1?symbol=BTC-USDT`

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
symbol | String |  [交易對](#d6402cad41)

### 返回值
字段 | 含義
--------- | -------
sequence | 序列號
price |  最新成交價格
size | 最新成交數量
bestAsk |  最佳賣一價
bestAskSize |  最佳賣一數量
bestBid |  最佳買一價
bestBidSize | 最佳買一數量
time |  時間戳


<aside class="spacer2"></aside>


## 全局行情快照
```json
{
    "ticker":[
        {
          "symbol": "BTC-USDT",	// 交易對
          "symbolName": "BTC-USDT", // 變更後的交易對名稱
          "buy": "11328.9",	// 最佳買一價
          "sell": "11329",	// 最佳賣一價
          "changeRate": "-0.0055",	// 24h漲跌幅	
          "changePrice": "-63.6",	//24h 漲跌價
          "high": "11610",	// 24h最高價
          "low": "11200",	// 24h最低價
          "vol": "2282.70993217",	// 24h成交量，以基礎幣種計量的交易量
          "volValue": "25984946.157790431",	// 24h成交金額
          "last": "11328.9",	// 最新成交價
          "averagePrice": "11360.66065903",	// 昨日24小時平均成交價格
          "takerFeeRate": "0.001",	// 吃單基礎手續費
          "makerFeeRate": "0.001",	// 掛單基礎手續費
          "takerCoefficient": "1",	// 吃單手續費係數
          "makerCoefficient": "1"	// 掛單手續費係數
        }
    ],
    "time":1602832092060
}
```
此接口，可獲取所有交易對的tickers(包含24h成交量)

極少數情況下，交易市場存在幣種變更名稱的情況，如果您想要外部顯示正常，您可以調用Get all tickers接口根據返回值的“symbolName”字段顯示改名後交易對的交易數據。

### HTTP請求
`GET /api/v1/market/allTickers`

### 請求示例
`GET /api/v1/market/allTickers`

### 返回值
字段 | 含義
--------- | -------
time |  時間戳
symbol | 交易對
symbolName| 變更後的交易對名稱
buy |  最佳買一價
sell | 最佳賣一價
changeRate |  24h漲跌幅
changePrice | 24h漲跌價格
high | 24h最高價
low |  24h最低價
vol | 24h成交量，以基礎幣種計量的交易量
volValue | 24h 成交金額
last | 最新成交價
averagePrice | 昨日24小時平均成交價格
takerFeeRate | 吃單基礎手續費
makerFeeRate | 掛單基礎手續費
takerCoefficient | 吃單手續費係數
makerCoefficient | 掛單手續費係數
<aside class="spacer2"></aside>

## 24小時統計
```json
//Get 24hr Stats
{
  "time": 1602832092060,	// 時間戳
  "symbol": "BTC-USDT",	// 交易對
  "buy": "11328.9",	// 最佳買一價
  "sell": "11329",	// 最佳賣一價
  "changeRate": "-0.0055",	// 24h漲跌幅	
  "changePrice": "-63.6",	//24h 漲跌價
  "high": "11610",	// 24h最高價
  "low": "11200",	// 24h最低價
  "vol": "2282.70993217",	// 24h成交量，以基礎幣種計量的交易量
  "volValue": "25984946.157790431",	// 24h成交金額
  "last": "11328.9",	// 最新成交價
  "averagePrice": "11360.66065903",	// 昨日24小時平均成交價格
  "takerFeeRate": "0.001",	// 吃單基礎手續費
  "makerFeeRate": "0.001",	// 掛單基礎手續費
  "takerCoefficient": "1",	// 吃單手續費係數
  "makerCoefficient": "1"	// 掛單手續費係數
}
```
此接口，可獲取指定交易對的最近24小時的ticker

### HTTP請求
`GET /api/v1/market/stats`

### 請求示例
`GET /api/v1/market/stats?symbol=BTC-USDT`

### 請求參數
請求參數 | 類型 | 含義
--------- | -------| -------
symbol | String |  [交易對](#d6402cad41)

### 返回值
字段 | 含義
--------- | -------
time |  時間戳
symbol | 交易對
buy |  最佳買一價
sell | 最佳賣一價
changeRate |  24h漲跌幅
changePrice | 24h漲跌價格
high | 24h最高價
low |  24h最低價
vol | 24h成交量，以基礎幣種計量的交易量
volValue | 24h 成交金額
last | 最新成交價
averagePrice | 昨日24小時平均成交價格
takerFeeRate | 吃單基礎手續費
makerFeeRate | 掛單基礎手續費
takerCoefficient | 吃單手續費係數
makerCoefficient | 掛單手續費係數
<aside class="spacer2"></aside>

## 交易市場列表
```json
//Get Market List
{
  "data" : [
    "USDS",
    "BTC",
    "KCS",
    "ALTS",
    "NFT-ETF",
    "FIAT",
    "DeFi",
    "NFT",
    "Metaverse",
    "Polkadot",
    "ETF"
  ],
  "code" : "200000"
}
```
此接口，可以獲取整個交易市場的交易幣種
<aside class="notice"> SC已更名爲USDS，但您依然可以使用SC作爲查詢參數。</aside>
<aside class="notice"> ETH、NEO、TRX三個計價幣種區合併至ALTS交易區，您可以通過ALTS交易區查詢ETH、NEO、TRX市場的交易對。</aside>

### HTTP請求
`GET /api/v1/markets`

### 請求示例
`GET /api/v1/markets`


<aside class="spacer2"></aside>

# 委託買賣盤

## Level-2部分買賣盤(價格聚合)
```json
{
    "sequence":"3262786978",
    "bids":[
        [
            "6500.12",//price
            "0.45054140"//size
        ],
        [
            "6500.11",
            "0.45054140"
        ]
    ],
    "asks":[
        [
            "6500.16",
            "0.57753524"
        ],
        [
            "6500.15",
            "0.57753524"
        ]
    ],
    "time":1550653727731
}
```
此接口，可獲取指定交易對的買賣盤數據。

買賣盤上的買單和賣單均按照價格彙總，每個價格下僅返回一個根據價格彙總的掛單量。

此接口，只會返回部分的買賣盤數據，level2_20是指返回買賣方各20條數據，level_100 是指返回買賣方各100條數據。推薦您使用這個接口，因爲響應速度更快，流量消耗小。



### HTTP請求
`GET /api/v1/market/orderbook/level2_20`<br/>
`GET /api/v1/market/orderbook/level2_100`

### 請求示例
`GET /api/v1/market/orderbook/level2_20?symbol=BTC-USDT`<br/>
`GET /api/v1/market/orderbook/level2_100?symbol=BTC-USDT`

### 請求參數
請求參數 | 類型 | 含義
--------- | -------  | -------
symbol | String |  [交易對](#d6402cad41)

### 返回值
字段 | 含義
--------- | -------
sequence | 序列號
time | 時間戳
bids | 買盤
asks | 賣盤

###數據排序方式

**Asks**: 買盤，根據價格從低到高

**Bids**: 賣盤，根據價格從高到低


## Level-2全部買賣盤(價格聚合)
```json
{
    "sequence":"3262786978",
    "bids":[
        [
            "6500.12", //price
            "0.45054140"
        ],
        [
            "6500.11",
            "0.45054140"
        ]
    ],
    "asks":[
        [
            "6500.16",
            "0.57753524"
        ],
        [
            "6500.15",
            "0.57753524"
        ]
    ],
    "time":1550653727731
}
```
此接口獲取指定交易對的所有活動委託的快照。

Level 2 買賣盤上的買單和賣單均按照價格彙總，每個價格下僅返回一個根據價格彙總的掛單量。

此接口將返回全部的買賣盤數據。

該功能適用於專業交易員，因爲該過程將使用較多服務器資源及流量，訪問頻率受到了嚴格控制。

爲保證本地買賣盤數據爲最新數據，在獲取Level 2快照後，請使用[Websocket](#level-2-3)推送的增量消息來更新Level 2買賣盤。

### HTTP請求
`GET /api/v3/market/orderbook/level2`

### 請求示例
`GET /api/v3/market/orderbook/level2?symbol=BTC-USDT`

### API權限
此接口需要**通用權限**。

### 頻率限制
此接口針對每個賬號請求頻率限制爲**30次/3s**

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
symbol | String |  [交易對](#d6402cad41)

### 返回值
字段 | 含義
--------- | -------
sequence | 序列號
time | 時間戳
bids | 買盤
asks | 賣盤

###數據排序方式

**Asks**: 買盤，根據價格從低到高

**Bids**: 賣盤，根據價格從高到低



<aside class="spacer4"></aside>

# 歷史數據

## 成交歷史
```json
[
    {
        "sequence":"1545896668571",
        "price":"0.07",//成交價格
        "size":"0.004", //成交數量
        "side":"buy", //成交方向
        "time":1545904567062140823
    },
    {
        "sequence":"1545896668578",
        "price":"0.054",
        "size":"0.066",
        "side":"buy",
        "time":1545904581619888405
    }
]
```
此接口，可獲取指定交易對的成交歷史列表。

### HTTP請求
`GET /api/v1/market/histories`

### 請求示例
`GET /api/v1/market/histories?symbol=BTC-USDT`

### 請求參數
請求參數 | 類型 | 含義
--------- | -------  | -------
symbol | String |  [交易對](#d6402cad41)

### 返回值

字段 | 含義
--------- | -------
sequence | 序列號
time | 交易時間戳
price | 訂單價格
size | 訂單數量
side |賣方 或 買方

###SIDE
Taker訂單的成交方向。Taker訂單指立刻與買賣盤上的已有訂單成交的訂單類型。



<aside class="spacer2"></aside>

## 歷史蠟燭圖數據
```json
[
    [
        "1545904980", //k線週期的開始時間
        "0.058",  //開盤價
        "0.049",  //收盤價
        "0.058", //最高價
        "0.049", //最低價
        "0.018",  //成交量
        "0.000945"  //成交額
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
此接口，返回指定交易對的kline(蠟燭圖），返回數據根據時間粒度劃分。

<aside class="notice">  歷史蠟燭圖數據可能不完整，請勿輪詢調用此接口，可以通過Websocket訂閱實時數據</aside>


### HTTP請求
`GET /api/v1/market/candles`

### 請求示例
`GET /api/v1/market/candles?type=1min&symbol=BTC-USDT&startAt=1566703297&endAt=1566789757`

### 請求參數
請求參數 | 類型 | 含義
------------- | ------- | -------
symbol | String |  [交易對](#d6402cad41)
startAt| long | [可選] 開始時間（秒）默認值爲0
endAt| long | [可選]  截止時間（秒）默認值爲0
type | String | 時間粒度，也就是每根蠟燭的時間區間:<br/>**1min, 3min, 5min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week**

<aside class="notice"> 每次查詢系統最多返回1500條數據。要獲得更多數據，請按時間分頁數據。</aside>

### 返回值
字段 | 含義
--------- | -------
time | k線週期的開始時間
open | 開盤價
close | 收盤價
high | 最高價
low | 最低價
volume | 成交量
turnover | 成交額


# 幣種

## 幣種列表
```json
[
  {
    "currency": "CSP",
    "name": "CSP",
    "fullName": "Caspian",
    "precision": 8,
    "confirms": 12,
    "contractAddress": "0xa6446d655a0c34bc4f05042ee88170d056cbaf45",
    "withdrawalMinSize": "2000",
    "withdrawalMinFee": "1000",
    "isWithdrawEnabled": true,
    "isDepositEnabled": true,
    "isMarginEnabled": false,
    "isDebitEnabled": false
  },
  {
    "currency": "LOKI",
    "name": "OXEN",
    "fullName": "Oxen",
    "precision": 8,
    "confirms": 10,
    "contractAddress": "",
    "withdrawalMinSize": "2",
    "withdrawalMinFee": "2",
    "isWithdrawEnabled": true,
    "isDepositEnabled": true,
    "isMarginEnabled": false,
    "isDebitEnabled": true
  }
]
```
此接口，返回幣種詳情列表。

<aside class="notice">並不是所有的幣種可以用於交易</aside>

### HTTP請求
`GET /api/v1/currencies`

### 請求示例
`GET /api/v1/currencies`

### 返回值
| 字段  | 含義                |
| --- | ----------------- |
|currency| 幣種唯一標識，不會改變|
|name| 幣種名，可變更|
|fullName| 幣種全稱，可變更|
|precision| 幣種精度 |
|confirms| 區塊鏈確認數|
|contractAddress| 合約地址 |
|withdrawalMinSize| 提現最小值 |
|withdrawalMinFee| 提現最小手續費 |
|isWithdrawEnabled| 是否可提現 |
|isDepositEnabled| 是否可充值|
|isMarginEnabled|是否支持槓桿|
|isDebitEnabled|是否支持借貸|


### 幣種標識(currency code)
幣種標識（code）均符合 ISO 4217 的標準，不符合ISO 4217標準中無法標識的幣種，將採取自定義標識。

| Code | 含義            |
| ---- | ------------- |
| BTC  | Bitcoin       |
| ETH  | Ethereum      |
| KCS  | Kucoin Shares |

返回值中的**currency**是不會改變的，而name、fullname、precision等都可能會變動，當一個幣種更換name時，您仍可以使用currency去獲取該幣種的信息。

例如：XRB更名後變爲Nano，但它的currency仍然是XRB，而它的name變更爲Nano，此時您仍然需要通過XRB去查詢該幣種。

## 幣種詳情
```json
{
  "currency": "BTC",
  "name": "BTC",
  "fullName": "Bitcoin",
  "precision": 8,
  "confirms": 2,
  "contractAddress": "",
  "withdrawalMinSize": "0.001",
  "withdrawalMinFee": "0.0006",
  "isWithdrawEnabled": true,
  "isDepositEnabled": true,
  "isMarginEnabled": true,
  "isDebitEnabled": true
}
```
此接口，返回可交易幣種的貨幣詳細信息

### HTTP請求
`GET /api/v1/currencies/{currency}`

### 請求示例
`GET /api/v1/currencies/BTC`

### 請求參數
| 請求參數     | 類型     | 含義                                                              |
| -------- | ------ | --------------------------------------------------------------- |
| currency | String | 路徑參數，[幣種標識](#47f0f7e8df)                                        |
| chain    | String | [可選] 針對一幣多鏈的幣種，可通過chain獲取幣種詳情。比如， USDT存在的鏈有 OMNI, ERC20, TRC20。 |

### 返回值
|字段 | 含義|
|--------- | -------|
|currency| 幣種唯一標識，不會改變|
|name| 幣種名，可變更|
|fullName| 幣種全稱，可變更|
|precision| 幣種精度 |
|confirms| 區塊鏈確認數|
|contractAddress| 合約地址|
|withdrawalMinSize| 提現最小值 |
|withdrawalMinFee| 提現最小手續費 |
|isWithdrawEnabled| 是否可提現 |
|isDepositEnabled| 是否可充值|
|isMarginEnabled|是否支持槓桿|
|isDebitEnabled|是否支持借貸|

## 幣種詳情(推薦使用)
```json
{
    "code": "200000",
    "data": {
        "currency": "BTC",
        "name": "BTC",
        "fullName": "Bitcoin",
        "precision": 8,
        "confirms": null,
        "contractAddress": null,
        "isMarginEnabled": true,
        "isDebitEnabled": true,
        "chains": [
            {
                "chainName": "BTC",
                "chain": "btc",
                "withdrawalMinSize": "0.001",
                "withdrawalMinFee": "0.0005",
                "isWithdrawEnabled": true,
                "isDepositEnabled": true,
                "confirms": 2,
                "contractAddress": ""
            },
            {
                "chainName": "KCC",
                "chain": "kcc",
                "withdrawalMinSize": "0.0008",
                "withdrawalMinFee": "0.00002",
                "isWithdrawEnabled": true,
                "isDepositEnabled": true,
                "confirms": 20,
                "contractAddress": ""
            },
            ...
        ]
    }
}
```
此接口，返回可交易幣種的貨幣詳細信息

### HTTP請求
`GET /api/v2/currencies/{currency}`

### 請求示例
`GET /api/v2/currencies/BTC`

<aside class="notice">推薦使用</aside>

### 請求參數
| 請求參數     | 類型     | 含義                                                              |
| -------- | ------ | --------------------------------------------------------------- |
| currency | String | 路徑參數，[幣種標識](#47f0f7e8df)                                        |
| chain    | String | [可選] 可通過chain獲取幣種指定鏈的詳情，不傳默認返回所有鏈的幣種詳情。 |

### 返回值
|字段 | 含義|
|--------- | -------|
|currency| 幣種唯一標識，不會改變|
|name| 幣種名，可變更|
|fullName| 幣種全稱，可變更|
|precision| 幣種精度 |
|confirms| 區塊鏈確認數|
|contractAddress| 合約地址|
|withdrawalMinSize| 提現最小值 |
|chainName| 幣種chain名字 |
|chain| 幣種chain |
|withdrawalMinFee| 提現最小手續費 |
|isWithdrawEnabled| 是否可提現 |
|isDepositEnabled| 是否可充值|
|isMarginEnabled|是否支持槓桿|
|isDebitEnabled|是否支持借貸|

## 法幣換算價格
此接口，返回法幣換算後的價格

```json
{
    "code":"200000",
    "data":{

        "BTC":"3911.28000000",
        "ETH":"144.55492453",
        "LTC":"48.45888179",
        "KCS":"0.45546856"
    }
}
```
### HTTP 請求
`GET /api/v1/prices`

### 請求示例
`GET /api/v1/prices`

### 請求參數
請求參數 | 類型 | 含義
--------- | ------- | -------
 base | String | [可選] 法幣貨幣代碼。比如，USD，EUR 默認爲USD |
 currencies | String  |[可選] 需轉換的數字貨幣（多個幣種，請使用“,“進行間隔）。比如，BTC,ETH 。默認爲返回所有幣種的法幣價格|


# 槓桿交易

# 槓桿信息

## 獲取當前標記價格
```json
{
    "code": "200000",
    "data": {
        "symbol": "USDT-BTC",
        "timePoint": 1659930234000,
        "value": 0.0000429
    }
}
```
此接口返回當前指定交易對的標記價格

### HTTP請求
`GET /api/v1/mark-price/{symbol}/current`

### 請求示例
`GET /api/v1/mark-price/USDT-BTC/current`

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| symbol | String | 路徑參數, 交易對 |

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| symbol      | 交易對      |
| timePoint   | 時間點(毫秒)  |
| value       | 標記價格值    |

#### 目前支持的交易對列表
<aside class="notice">USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC, DIA-BTC, VET-BTC, DASH-BTC, DOT-BTC, XTZ-BTC, ZEC-BTC, BSV-BTC, ADA-BTC, ATOM-BTC, LINK-BTC, LUNA-BTC, NEO-BTC, UNI-BTC, ETC-BTC, BNB-BTC, TRX-BTC, XLM-BTC, BCH-BTC, USDC-BTC, GRT-BTC, 1INCH-BTC, AAVE-BTC,SNX-BTC, API3-BTC, CRV-BTC, MIR-BTC, SUSHI-BTC, COMP-BTC, ZIL-BTC, YFI-BTC, OMG-BTC,XMR-BTC, WAVES-BTC, MKR-BTC, COTI-BTC, SXP-BTC, THETA-BTC, ZRX-BTC, DOGE-BTC, LRC-BTC, FIL-BTC, DAO-BTC, BTT-BTC, KSM-BTC, BAT-BTC, ROSE-BTC, CAKE-BTC, CRO-BTC, XEM-BTC, MASK-BTC, FTM-BTC, IOST-BTC, ALGO-BTC, DEGO-BTC, CHR-BTC, CHZ-BTC, MANA-BTC, ENJ-BTC, IOST-BTC, ANKR-BTC, ORN-BTC, SAND-BTC, VELO-BTC, AVAX-BTC, DODO-BTC, WIN-BTC, ONE-BTC, SHIB-BTC, ICP-BTC, MATIC-BTC, CKB-BTC, SOL-BTC, VRA-BTC, DYDX-BTC, ENS-BTC, NEAR-BTC, SLP-BTC, AXS-BTC, TLM-BTC, ALICE-BTC,IOTX-BTC, QNT-BTC, SUPER-BTC, HABR-BTC, RUNE-BTC, EGLD-BTC, AR-BTC, RNDR-BTC, LTO-BTC, YGG-BTC</aside>

## 查詢槓桿配置信息
```json
{
    "code": "200000",
    "data": {
        "currencyList": [
            "XEM",
            "MATIC",
            "VRA",
            ...
        ],
        "maxLeverage": 5,
        "warningDebtRatio": "0.95",
        "liqDebtRatio": "0.97"
    }
}
```
此接口返回槓桿配置信息

### HTTP請求
`GET /api/v1/margin/config`

### 請求參數
`無`

### 請求示例
`GET /api/v1/margin/config`

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| currencyList | 支持的幣種列表 |
| warningDebtRatio | 爆倉預警負債率 |
| liqDebtRatio | 爆倉負債率 |
| maxLeverage | 槓桿倍數 |

## 查詢槓桿賬戶信息
```json
{
    "code": "200000",
    "data": {
        "debtRatio": "0",
        "accounts": [
            {
                "currency": "KCS",
                "totalBalance": "0.01",
                "availableBalance": "0.01",
                "holdBalance": "0",
                "liability": "0",
                "maxBorrowSize": "0"
            },
            {
                "currency": "USDT",
                "totalBalance": "0",
                "availableBalance": "0",
                "holdBalance": "0",
                "liability": "0",
                "maxBorrowSize": "0"
            },
            ...
        ]
    }
}
```
此接口返回當前槓桿賬戶信息

### HTTP請求
`GET /api/v1/margin/account`

### 請求示例
`GET /api/v1/margin/account`

### API權限
該接口需要`通用權限`。

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| accounts | 賬戶列表 |
| debtRatio | 負債率 |
| currency | 幣種 |
| totalBalance | 賬戶總額 |
| availableBalance | 賬戶可用餘額 |
| holdBalance | 賬戶凍結金額 |
| liability | 當前總負債 |
| maxBorrowSize | 當前可借數量 |

## 查詢全倉/逐倉槓桿風險限額
```json
// 全倉返回值
{
    "code": "200000",
    "data": [
        {
            "currency": "BTC",
            "borrowMaxAmount": "140",
            "buyMaxAmount": "60",
            "holdMaxAmount": "522.8",
            "precision": 8
        },
        {
            "currency": "USDT",
            "borrowMaxAmount": "2000000",
            "buyMaxAmount": "10000000",
            "holdMaxAmount": "15000000",
            "precision": 8
        },
        {
            "currency": "ETH",
            "borrowMaxAmount": "1000",
            "buyMaxAmount": "600",
            "holdMaxAmount": "3737.1",
            "precision": 8
        },
        ...
    ]
}
```
```json
// 逐倉返回值
{
    "code": "200000",
    "data": [
        {
            "symbol": "ETH-USDT",
            "baseMaxBorrowAmount": "200",
            "quoteMaxBorrowAmount": "3000000",
            "baseMaxBuyAmount": "210",
            "quoteMaxBuyAmount": "3300000",
            "baseMaxHoldAmount": "3737.1",
            "quoteMaxHoldAmount": "5000000",
            "basePrecision": 8,
            "quotePrecision": 8
        },
        {
            "symbol": "BTC-USDT",
            "baseMaxBorrowAmount": "20",
            "quoteMaxBorrowAmount": "3000000",
            "baseMaxBuyAmount": "25",
            "quoteMaxBuyAmount": "3300000",
            "baseMaxHoldAmount": "522.8",
            "quoteMaxHoldAmount": "5000000",
            "basePrecision": 8,
            "quotePrecision": 8
        },
        ...
    ]
}
```
此接口可獲取查詢全倉/逐倉槓桿風險限額

### HTTP請求
`GET /api/v1/risk/limit/strategy`

### 請求示例
`GET /api/v1/risk/limit/strategy?marginModel=cross`

### API權限
該接口需要`通用權限`。

### 頻率限制
此接口針對每個賬號請求頻率限制爲`1次/3s`

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| marginModel | String | `cross`代表查詢全倉，`isolated`代表查詢逐倉，默認值是`cross` |

### 全倉返回值
| 字段          | 含義       |
| ----------- | -------- |
| currency    | 幣種名稱      |
| borrowMaxAmount | 最大借入量 |
| buyMaxAmount   | 最大買入量  |
| holdMaxAmount   | 最大持有量 |
| precision       | 精度    |

### 逐倉返回值
| 字段          | 含義       |
| ----------- | -------- |
| symbol    |    symbol   |
| baseMaxBorrowAmount | base最大借入量 |
| quoteMaxBorrowAmount | quote最大借入量 |
| baseMaxBuyAmount | base最大買入量    |
| quoteMaxBuyAmount | quote最大買入量 |
| baseMaxHoldAmount | base最大持倉量 |
| quoteMaxHoldAmount | quote最大持倉量 |
| basePrecision | base精度 |
| quotePrecision | quote精度|

# 借貸

## 發佈借入委託
```json
{
    "orderId":"a2111213",
    "currency":"USDT"
}
```

### HTTP請求
`POST /api/v1/margin/borrow`

### 請求示例
`POST /api/v1/margin/borrow`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| currency | String | [必選] 借入幣種 |
| type | String | [必選] 類型：FOK、IOC |
| size | BigDecimal | [必選] 借入數量 |
| maxRate | BigDecimal | [可選] 最大利率, 不填則表示接受所有利率 |
| term | String | [可選] 期限,單位爲:天, 不填則表示接受所有期限,逗號隔開,如: 7,14,28 |

<aside class="notice">現系統支持的借入期限: 7、14、28</aside>

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| orderId | 借入委託id |
| currency | 借入幣種 |
| actualSize | 實際借入的金額 |

## 查詢借入委託
```json
{
    "orderId":"a2111213",
    "currency":"USDT",
    "size":"1.009",
    "filled":1.009,
    "matchList":[
        {
            "currency":"USDT",
            "dailyIntRate":"0.001",
            "size":"12.9",
            "term":7,
            "timestamp":"1544657947759",
            "tradeId":"1212331"
        }
    ],
    "status":"DONE"
}
```
調用[發佈借入委託](#4a9442d959) 後,根據返回的委託id，查詢借入詳情。

### HTTP請求
`GET /api/v1/margin/borrow`

### 請求示例
`GET /api/v1/margin/borrow?orderId=123456789`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| orderId | String | 借入委託id |

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| orderId      | 借入委託id      |
| currency | 幣種 |
| size | 申請借入數量  |
| filled | 實際借入數量    |
| status | 狀態：DONE-表示已借入完成或者取消，PROCESSING-表示系統還在處理中 |
| matchList | 借入成交明細    |
| tradeId | 交易id |
| dailyIntRate | 利率 |
| term | 期限 |
| timestamp | 借入時間戳 |

## 查詢待還款記錄
```json
{
    "currentPage":0,
    "pageSize":0,
    "totalNum":0,
    "totalPage":0,
    "items":[
        {
            "tradeId":"1231141",
            "accruedInterest":"0.22121",
            "currency":"USDT",
            "dailyIntRate":"0.0021",
            "liability":"1.32121",
            "maturityTime":"1544657947759",
            "principal":"1.22121",
            "repaidSize":"0",
            "term":7,
            "createdAt":"1544657947759"
        }
    ]
}
```

### HTTP請求
`GET /api/v1/margin/borrow/outstanding`

### 請求示例
`GET /api/v1/margin/borrow/outstanding`

### API權限
該接口需要**通用權限**。
<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| currency | String | 幣種，不傳則查詢所有幣種 |

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| tradeId | 交易id |
| currency       | 幣種 |
| liability | 總負債 |
| principal | 待還本金    |
| accruedInterest | 應計利息 |
| createdAt   | 成交時間，時間戳 |
| maturityTime       | 到期時間，時間戳 |
| term       | 期限  |
| repaidSize | 已還數量  |
| dailyIntRate | 日利率  |

## 查詢已還款記錄
```json
{
    "currentPage":0,
    "pageSize":0,
    "totalNum":0,
    "totalPage":0,
    "items":[
        {
            "tradeId":"1231141",
            "currency":"USDT",
            "dailyIntRate":"0.0021",
            "interest":"0.22121",
            "principal":"1.22121",
            "repaidSize":"0",
            "repayTime":"1544657947759",
            "term":7
        }
    ]
}
```

### HTTP請求
`GET /api/v1/margin/borrow/repaid`

### 請求示例
`GET /api/v1/margin/borrow/repaid`

### API權限
該接口需要**通用權限**。

<aside class="notice">這個接口需要使用分頁</aside>

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| currency | String | 幣種，不傳則查詢所有幣種 |

### 返回值
| 字段          | 含義       |
| ----------- | -------- |
| tradeId | 交易id |
| currency       | 幣種 |
| interest   | 利息 |
| principal  | 本金 |
| repayTime | 還款時間，時間戳 |
| term   | 期限  |
| repaidSize | 已還款數量 |
| dailyIntRate | 日利率  |

## 一鍵還款
```json
{
  "code": "200000",
  "data": null
}
```

### HTTP請求
`POST /api/v1/margin/repay/all`

### 請求示例
`POST /api/v1/margin/repay/all`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| currency | String | 幣種 |
| sequence | String | 還款順序策略,RECENTLY_EXPIRE_FIRST:到期時間優先,即優先歸還最快到期的貸款, HIGHEST_RATE_FIRST:利率優先，即優先歸還利率高的貸款 |
| size | BigDecimal | 還款數量 |

### 返回值
當返回HTTP狀態碼200和code爲200000時,表示還款響應成功,否則表示還款失敗。

## 單筆還款
```json
{
  "code": "200000",
  "data": null
}
```

此接口用於歸還指定某筆貸款

### HTTP請求
`POST /api/v1/margin/repay/single`

### 請求示例
`POST /api/v1/margin/repay/single`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數   | 類型     | 含義        |
| ------ | ------ | --------- |
| currency | String | 幣種 |
| tradeId | String | 交易id |
| size | BigDecimal | 還款數量 |

### 返回值
當返回HTTP狀態碼200和code爲200000時,表示還款響應成功,否則表示還款失敗。

## 發佈借出委託
```json
{
    "orderId":"5da5a4f0f943c040c2f8501e"
}
```
此接口可以發佈單筆借出委託。

在發佈前，請確保你的儲蓄賬戶有足夠的資金。一旦發佈成功，你發佈的金額會被凍結，直到借出委託成交或者撤銷

### HTTP請求
`POST /api/v1/margin/lend`

### 請求示例
`POST /api/v1/margin/lend`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數     | 類型   | 含義                             |
| ------------ | ------ | -------------------------------- |
| currency     | String | [必須] 借出幣種                  |
| size         | String | [必須] 該幣種的數量              |
| dailyIntRate | String | [必須] 日利率小數。0.002表示0.2% |
| term         | int    | [必須] 期限，單位天              |

### 返回值
| 字段    | 含義   |
| ------- | ------ |
| orderId | 委託Id |

## 撤銷借出委託
```json
{
  "code": "200000",
  "data": null
}
```
此接口可以撤銷單筆借出委託

### HTTP請求
`DELETE /api/v1/margin/lend/{orderId}`

### 請求示例
`DELETE /api/v1/margin/lend/5d9f133ef943c0882ca37bc8`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數 | 類型   | 含義          |
| -------- | ------ | ------------- |
| orderId  | String | [必須] 委託Id |

## 設置自動借出
```json
{
  "code": "200000",
  "data": null
}
```
此接口可以設置用戶單幣種的自動借出。可以設置自動借出的開關、參數

### HTTP請求
`POST /api/v1/margin/toggle-auto-lend`

### 請求示例
`POST /api/v1/margin/toggle-auto-lend`

### API權限
該接口需要**槓桿交易權限**。

### 請求參數
| 請求參數     | 類型    | 含義                                                         |
| ------------ | ------- | ------------------------------------------------------------ |
| currency     | String  | [必須] 幣種                                                  |
| isEnable     | boolean | [必須] 是否開啓                                              |
| retainSize   | String  | [開啓時必須] 該幣種的保留數量。儲蓄賬戶該幣種不自動借出的數量 |
| dailyIntRate | String  | [開啓時必須] 可接受最低日利率，0.002標識0.2%                      |
| term         | int     | [開啓時必須] 期限，單位天                                    |

###術語解釋

###可接受最低日利率(dailyIntRate)
可接受最低日利率(dailyIntRate)

當市場最優利率高於您的可接受最低日利率時，系統將以市場最優利率掛單。（市場最優利率即當下時刻所選期限的所有借出掛單的一檔利率。該利率將優先被成交。）

當市場最優利率低於可接受最低日利率時，我們將以您設定的可接受最低日利率進行掛單借出。


## 查詢活躍借出委託
```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "orderId":"5da59f5ef943c033b2b643e4",
            "currency":"BTC",
            "size":"0.51",
            "filledSize":"0",
            "dailyIntRate":"0.0001",
            "term":7,
            "createdAt":1571135326913
        }
    ]
}
```
此接口可以分頁查詢用戶活躍的借出委託
返回值是分頁後的數據，根據委託時間降序排列，最大頁數100

活躍借出委託指：未成交、部分成交、未撤銷的借出委託

### HTTP請求
`GET /api/v1/margin/lend/active`

### 請求示例
`GET /api/v1/margin/lend/active?currency=BTC&currentPage=1&pageSize=50`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段         | 含義                      |
| ------------ | ------------------------- |
| orderId      | 委託Id                    |
| currency     | 幣種                      |
| size         | 該幣種的委託總量          |
| filledSize   | 該幣種的已借出數量        |
| dailyIntRate | 日利率小數。0.002表示0.2% |
| term         | 期限，單位天              |
| createdAt    | 委託時間戳，單位毫秒      |

## 查詢歷史借出委託
```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "orderId":"5da59f5bf943c033b2b643da",
            "currency":"BTC",
            "size":"0.51",
            "filledSize":"0.51",
            "dailyIntRate":"0.0001",
            "term":7,
            "createdAt":1571135323984,
            "status":"FILLED"
        }
    ]
}
```
此接口可以分頁查詢用戶歷史的借出委託
返回值是分頁後的數據，根據委託時間降序排列，最大頁數100

歷史借出委託指：全部成交、撤銷的借出委託

### HTTP請求
`GET /api/v1/margin/lend/done`

### 請求示例
`GET /api/v1/margin/lend/done?currency=BTC&currentPage=1&pageSize=50`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段         | 含義                                         |
| ------------ | -------------------------------------------- |
| orderId      | 委託Id                                       |
| currency     | 幣種                                         |
| size         | 該幣種的委託總量                             |
| filledSize   | 該幣種的已借出數量                           |
| dailyIntRate | 日利率小數。0.002表示0.2%                    |
| term         | 期限，單位天                                 |
| createdAt    | 委託時間戳，單位毫秒                         |
| status       | 委託狀態：FILLED - 全部成交，CANCELED - 撤銷 |

## 查詢未結算出借記錄
```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "tradeId":"5da6dba0f943c0c81f5d5db5",
            "currency":"BTC",
            "size":"0.51",
            "accruedInterest":"0",
            "repaid":"0.10999968",
            "dailyIntRate":"0.0001",
            "term":14,
            "maturityTime":1572425888958
        }
    ]
}
```
此接口可以分頁查詢用戶未結算的出借記錄
返回值是分頁後的數據，根據成交時間降序排列，最大頁數100

借出委託成交後，會產生出借記錄。未結算的出借記錄指：未還款、部分還款的出借記錄

### HTTP請求
`GET /api/v1/margin/lend/trade/unsettled`

### 請求示例
`GET /api/v1/margin/lend/trade/unsettled?currency=BTC&currentPage=1&pageSize=50`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段            | 含義                                             |
| --------------- | ------------------------------------------------ |
| tradeId         | 交易Id                                           |
| currency        | 幣種                                             |
| size            | 該幣種的借出數量                                 |
| accruedInterest | 該幣種的應計利息。借入方償還利息以後，該值會減少 |
| repaid          | 該幣種的已還款數量                               |
| dailyIntRate    | 日利率小數。0.002表示0.2%                        |
| term            | 期限，單位天                                     |
| maturityTime    | 到期時間戳，單位毫秒                             |

## 查詢已結算出借記錄
```json
{
    "currentPage":1,
    "pageSize":1,
    "totalNum":1,
    "totalPage":1,
    "items":[
        {
            "tradeId":"5da59fe6f943c033b2b6440b",
            "currency":"BTC",
            "size":"0.51",
            "interest":"0.00004899",
            "repaid":"0.510041641",
            "dailyIntRate":"0.0001",
            "term":7,
            "settledAt":1571216254767,
            "note":"The account of the borrowers reached a negative balance, and the system has supplemented the loss via the insurance fund. Deposit funds: 0.51."
        }
    ]
}
```
此接口可以分頁查詢用戶已結算的出借記錄
返回值是分頁後的數據，根據成交時間降序排列，最大頁數100

已結算的出借記錄指：提前全額還款、到期足額還款、到期不足額還款風險基金補足、到期不足額還款風險基金不能補足的出借記錄

### HTTP請求
`GET /api/v1/margin/lend/trade/settled`

### 請求示例
`GET /api/v1/margin/lend/trade/settled?currency=BTC&currentPage=1&pageSize=50`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段         | 含義                                     |
| ------------ | ---------------------------------------- |
| tradeId      | 交易Id                                   |
| currency     | 幣種                                     |
| size         | 該幣種的借出數量                         |
| interest     | 該幣種的總計利息                         |
| repaid       | 該幣種的已還款數量                       |
| dailyIntRate | 日利率小數。0.002表示0.2%                |
| term         | 期限，單位天                             |
| settledAt    | 結算時間戳，單位毫秒                     |
| note         | 備註。備註借方穿倉，風險基金是否償還情況 |

## 資產借出記錄
```json
[
    {
        "currency":"BTC",
        "outstanding":"1.02",
        "filledSize":"0.91000213",
        "accruedInterest":"0.00000213",
        "realizedProfit":"0.000045261",
        "isAutoLend":false
    }
]
```
該接口可以查詢用戶借出資產相關的統計信息

### HTTP請求
`GET /api/v1/margin/lend/assets`

### 請求示例
`GET /api/v1/margin/lend/assets?currency=BTC`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段            | 含義                   |
| --------------- | ---------------------- |
| currency        | 幣種                   |
| outstanding     | 該幣種的委託中數量     |
| filledSize      | 該幣種的已借出數量     |
| accruedInterest | 該幣種的應計利息數量   |
| realizedProfit  | 該幣種的已實現收益數量 |
| isAutoLend      | 是否開啓自動續借       |

## 借出市場信息
```json
[
    {
        "dailyIntRate":"0.0001",
        "term":7,
        "size":"1.02"
    }
]
```
該接口可以查詢借出市場的信息，一次性返回所有滿足條件的記錄
返回值根據日利率降序、期限降序排列

### HTTP請求
`GET /api/v1/margin/market`

### 請求示例
`GET /api/v1/margin/market?currency=BTC&term=7`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義                |
| -------- | ------ | ------------------- |
| currency | String | [必須] 幣種          |
| term     | int    | [可選] 期限，單位天    |

### 返回值
| 字段         | 含義                      |
| ------------ | ------------------------- |
| dailyIntRate | 日利率小數。0.002表示0.2% |
| term         | 期限，單位天              |
| size         | 總計金額                  |

## 借貸市場成交信息
```json
[
    {
        "tradeId":"5da6dba0f943c0c81f5d5db5",
        "currency":"BTC",
        "size":"0.51",
        "dailyIntRate":"0.0001",
        "term":14,
        "timestamp":1571216288958989641
    }
]
```
該接口可以查詢借貸市場最近的300條成交信息
返回值根據成交時間戳降序排列

### HTTP請求
`GET /api/v1/margin/trade/last`

### 請求示例
`GET /api/v1/margin/trade/last?currency=BTC`

### API權限
該接口需要**通用權限**。

### 請求參數
| 請求參數 | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [必須] 幣種 |

### 返回值
| 字段         | 含義                      |
| ------------ | ------------------------- |
| tradeId      | 交易Id                    |
| currency     | 幣種                      |
| size         | 成交總量                  |
| dailyIntRate | 日利率小數。0.002表示0.2% |
| term         | 期限，單位天              |
| timestamp    | 成交時間戳，單位納秒      |

# 逐倉
## 查詢逐倉交易對配置
```json
{
    "code":"200000",
    "data": [
        {
            "symbol": "EOS-USDC",
            "symbolName": "EOS-USDC",
            "baseCurrency": "EOS",
            "quoteCurrency": "USDC",
            "maxLeverage": 10,
            "flDebtRatio": "0.97",
            "tradeEnable": true,
            "autoRenewMaxDebtRatio": "0.96",
            "baseBorrowEnable": true,
            "quoteBorrowEnable": true,
            "baseTransferInEnable": true,
            "quoteTransferInEnable": true
        },
        {
            "symbol": "MANA-USDT",
            "symbolName": "MANA-USDT",
            "baseCurrency": "MANA",
            "quoteCurrency": "USDT",
            "maxLeverage": 10,
            "flDebtRatio": "0.9",
            "tradeEnable": true,
            "autoRenewMaxDebtRatio": "0.96",
            "baseBorrowEnable": true,
            "quoteBorrowEnable": true,
            "baseTransferInEnable": true,
            "quoteTransferInEnable": true
        }
    ]
}
```
此接口返回當前逐倉槓桿交易對配置

### HTTP請求
`GET /api/v1/isolated/symbols`

### API權限
該接口需要`通用權限`。

### 請求參數
`無`

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
symbol | 交易對編碼
baseCurrency | base幣種
quoteCurrency | quote幣種
symbolName | 交易對名稱
maxLeverage | 最大槓桿倍數
flDebtRatio | 強平負債率
tradeEnable | 交易開關
autoRenewMaxDebtRatio | 自動續借最大負債率，低於該負債率才續借，超過該負債率直接部分強平還款
baseBorrowEnable | base幣種借入開關
quoteBorrowEnable | quote幣種借入開關
baseTransferInEnable | base幣種轉入開關
quoteTransferInEnable | quote幣種轉入開關

## 查詢逐倉賬戶信息
```json
{
    "code":"200000",
    "data": {
        "totalConversionBalance": "3.4939947",
        "liabilityConversionBalance": "0.00239066",
        "assets": [
            {
                "symbol": "MANA-USDT",
                "status": "CLEAR",
                "debtRatio": "0",
                "baseAsset": {
                    "currency": "MANA",
                    "totalBalance": "0",
                    "holdBalance": "0",
                    "availableBalance": "0",
                    "liability": "0",
                    "interest": "0",
                    "borrowableAmount": "0"
                },
                "quoteAsset": {
                    "currency": "USDT",
                    "totalBalance": "0",
                    "holdBalance": "0",
                    "availableBalance": "0",
                    "liability": "0",
                    "interest": "0",
                    "borrowableAmount": "0"
                }
            },
            {
                "symbol": "EOS-USDC",
                "status": "CLEAR",
                "debtRatio": "0",
                "baseAsset": {
                    "currency": "EOS",
                    "totalBalance": "0",
                    "holdBalance": "0",
                    "availableBalance": "0",
                    "liability": "0",
                    "interest": "0",
                    "borrowableAmount": "0"
                },
                "quoteAsset": {
                    "currency": "USDC",
                    "totalBalance": "0",
                    "holdBalance": "0",
                    "availableBalance": "0",
                    "liability": "0",
                    "interest": "0",
                    "borrowableAmount": "0"
                }
            }
        ]
    }
}
```
此接口返回當前用戶的所有逐倉賬戶

### HTTP請求
`GET /api/v1/isolated/accounts`

### API權限
該接口需要`通用權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
balanceCurrency	| String | [可選] 計價幣種，目前只支持`USDT`、`KCS`、`BTC`，不傳默認`BTC`

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
totalConversionBalance | 逐倉賬戶總的餘額（按指定的幣種計價）
liabilityConversionBalance | 逐倉賬戶總的負債（按指定的幣種計價）
assets | 賬戶列表
assets.symbol | 交易對，一個交易對代表一個倉位
assets.status | 倉位狀態，有負債-`DEBT`, 無負債-`CLEAR`, 破產(發生穿倉後，進入破產狀態)-`BANKRUPTCY`,借入中-`IN_BORROW`, 還款中-`IN_REPAY`, 平倉中-`IN_LIQUIDATION`, 自動續借中-`IN_AUTO_RENEW`
assets.debtRatio | 負債率
assets.baseAsset | base幣種的資產信息
assets.quoteAsset | quote幣種的資產信息
currency | 幣種Code
totalBalance | 當前幣種總資產金額
holdBalance | 當前幣種凍結金額
availableBalance | 可用餘額（總資產-凍結）

## 查詢單個逐倉賬戶信息
```json
{
    "code": "200000",
    "data": {
        "symbol": "MANA-USDT",
        "status": "CLEAR",
        "debtRatio": "0",
        "baseAsset": {
            "currency": "MANA",
            "totalBalance": "0",
            "holdBalance": "0",
            "availableBalance": "0",
            "liability": "0",
            "interest": "0",
            "borrowableAmount": "0"
        },
        "quoteAsset": {
            "currency": "USDT",
            "totalBalance": "0",
            "holdBalance": "0",
            "availableBalance": "0",
            "liability": "0",
            "interest": "0",
            "borrowableAmount": "0"
        }
    }
}
```
此接口返回當前用戶單個逐倉賬戶信息

### HTTP請求
`GET /api/v1/isolated/account/{symbol}`

### API權限
該接口需要`通用權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | 交易對，例如：`BTC-USDT`

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
symbol | 交易對
status | 倉位狀態: 有負債-`DEBT`, 無負債-`CLEAR`, 破產(發生穿倉後，進入破產狀態)-`BANKRUPTCY`,借入中-`IN_BORROW`, 還款中-`IN_REPAY`, 平倉中-`IN_LIQUIDATION`, 自動續借中-`IN_AUTO_RENEW` （每個狀態的權限）
debtRatio | 負債率
baseAsset | base幣種的資產信息
quoteAsset | quote幣種的資產信息
currency | 幣種Code
totalBalance | 當前幣種總資產金額
availableBalance | 當前幣種可用金額
holdBalance | 當前幣種凍結金額
liability | 當前幣種負債的本金,即未償還的本金
interest | 當前幣種負債的負債的利息,即未償還的利息
borrowableAmount | 可借數量

## 逐倉借入
```json
{
    "code": "200000",
    "data": {
        "orderId": "62baad0aaafc8000014042b3",
        "currency": "USDT",
        "actualSize": "10"
    }
}
```
此接口用戶發起逐倉借入

### HTTP請求
`POST /api/v1/isolated/borrow`

### API權限
該接口需要`槓桿交易權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | 交易對，例如：`BTC-USDT`
currency | String | 借入幣種
size | BigDecimal | 借入數量
borrowStrategy | String | 借入策略：`FOK`、`IOC`
maxRate | BigDecimal | [可選] 最大利率, 不填則表示接受所有利率
period | String | [可選] 期限,單位爲:天, 不填則表示接受所有期限,逗號隔開,如: `7`,`14`,`28`

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
orderId | 借入單號
currency | 借入幣種
actualBorrowSize | 實際借入金額

## 查詢待還款記錄
```json
{
    "success": true,
    "code": "200",
    "msg": "success",
    "retry": false,
    "data": {
        "currentPage": 1,
        "pageSize": 10,
        "totalNum": 6,
        "totalPage": 1,
        "items": [
            {
                "loanId": "62aec83bb51e6f000169a3f0",
                "symbol": "BTC-USDT",
                "currency": "USDT",
                "liabilityBalance": "10.02000016",
                "principalTotal": "10",
                "interestBalance": "0.02000016",
                "createdAt": 1655621691869,
                "maturityTime": 1656226491869,
                "period": 7,
                "repaidSize": "0",
                "dailyInterestRate": "0.001"
            },
            {
                "loanId": "62aa94e52a3fbb0001277fd1",
                "symbol": "BTC-USDT",
                "currency": "USDT",
                "liabilityBalance": "10.05166708",
                "principalTotal": "10",
                "interestBalance": "0.05166708",
                "createdAt": 1655346405447,
                "maturityTime": 1655951205447,
                "period": 7,
                "repaidSize": "0",
                "dailyInterestRate": "0.001"
            }
        ]
    }
}
```
此接口用於查詢逐倉待還款記錄

### HTTP請求
`GET /api/v1/isolated/borrow/outstanding`

### 請求示例
`GET /api/v1/isolated/borrow/outstanding?symbol=BTC-USDT&currency=USDT`

### API權限
該接口需要`通用權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | [可選] 交易對,例如：`BTC-USDT`
currency | String | [可選] 幣種
pageSize | int | [可選] 分頁每頁大小[`10`-`50`]
currentPage | int | [可選] 當前頁碼[`1`-`100`]

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
loanId | 交易id
symbol | 交易對
currency | 幣種
liabilityBalance | 剩餘負債
principalTotal | 本金
interestBalance | 應計利息
createdAt | 成交時間，時間戳
maturityTime | 到期時間，時間戳
period | 期限
repaidSize | 已還數量
dailyInterestRate | 日利率

## 查詢已還款記錄
```json
{
    "code": "200000",
    "data": {
        "currentPage": 1,
        "pageSize": 10,
        "totalNum": 30,
        "totalPage": 3,
        "items": [
            {
                "loanId": "628df5787818320001c79c8b",
                "symbol": "BTC-USDT",
                "currency": "USDT",
                "principalTotal": "10",
                "interestBalance": "0.07000056",
                "repaidSize": "10.07000056",
                "createdAt": 1653470584859,
                "period": 7,
                "dailyInterestRate": "0.001",
                "repayFinishAt": 1654075506416
            },
            {
                "loanId": "628c570f7818320001d52b69",
                "symbol": "BTC-USDT",
                "currency": "USDT",
                "principalTotal": "11",
                "interestBalance": "0.07699944",
                "repaidSize": "11.07699944",
                "createdAt": 1653364495783,
                "period": 7,
                "dailyInterestRate": "0.001",
                "repayFinishAt": 1653969432251
            }
        ]
    }
}
```
此接口用於查詢逐倉已還款記錄

### HTTP請求
`GET /api/v1/isolated/borrow/repaid`

### 請求示例
`GET /api/v1/isolated/borrow/repaid?symbol=BTC-USDT&currency=USDT`

### API權限
該接口需要`通用權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | [可選] 交易對,例如：`BTC-USDT`
currency | String | [可選] 幣種
pageSize | int | [可選] 分頁每頁大小[`10`-`50`]
currentPage | int | [可選] 當前頁碼[`1`-`100`]

### 返回值
| 字段         | 含義                     
| ------------ | -----------------
loanId | 交易id
symbol | 交易對
currency | 幣種
principalTotal | 本金
interestBalance | 應計利息
repaidSize | 已還數量
createdAt | 成交時間，時間戳
period | 期限
dailyInterestRate | 日利率
repayFinishAt | 還款完成時間

## 一鍵還款
```json
//request
{
    "currency": "BTC",
    "seqStrategy": "HIGHEST_RATE_FIRST",
    "size": 1.9,
    "symbol": "BTC-USDT"
}
```
```json
//response
{
    "code": "200000",
    "data": null
}
```
此接口用於發起逐倉一鍵還款

### HTTP請求
`POST /api/v1/isolated/repay/all`

### API權限
該接口需要`槓桿交易權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | 交易對,例如：`BTC-USDT`
currency | String | 還款幣種
size | BigDecimal | 還款數量
seqStrategy | String | 還款順序策略,`RECENTLY_EXPIRE_FIRST`:到期時間優先,即優先歸還最快到期的貸款, `HIGHEST_RATE_FIRST`:利率優先，即優先歸還利率高的貸款

### 返回值
當系統返回HTTP狀態碼`200`和系統代碼`200000`時，表示成功

## 單筆還款
```json
//request
{
    "currency": "BTC",
    "loanId": 8765321,
    "size": 1.9,
    "symbol": "BTC-USDT"
}
```
```json
//response
{
    "code": "200000",
    "data": null
}
```
此接口用於發起逐倉單筆還款

### HTTP請求
`POST /api/v1/isolated/repay/single`

### API權限
該接口需要`槓桿交易權限`。

### 請求參數
| 請求參數 | 類型  | 含義 
| ------ | ------ | ------
symbol | String | 交易對,例如：`BTC-USDT`
currency | String | 還款幣種
size | BigDecimal | 還款數量
loanId | String | 交易單號,設置該字段後，順序策略無效

### 返回值
當系統返回HTTP狀態碼`200`和系統代碼`200000`時，表示成功









# 槓桿交易（V3）

目前v1版本和v3版本均可正常使用

## 1 槓桿借幣
```json 
{
    "success": true,
    "code": "200",
    "msg": "success",
    "retry": false,
    "data": {
        "orderNo": "5da6dba0f943c0c81f5d5db5",
        "actualSize": 10
    }
}
```
該接口用於發起全倉或逐倉的借幣申請
### Http 請求
`POST /api/v3/margin/borrow`                                      

### 請求示例:
`POST /api/v3/margin/borrow`

### Api 權限
此接口需要**槓桿交易權限**

### 請求參數
| 字段        | 類型       | 含義                                  |
| ----------- | ---------- | ------------------------------------- |
| isIsolated  | Boolean    | [可選] true-逐倉,false-全倉;默認false |
| symbol      | String     | [可選] 交易對, 逐倉賬戶必填           |
| currency    | String     | [必選] 借入幣種                       |
| size        | BigDecimal | [必選] 借入數量                       |
| timeInForce | String     | [必選] 訂單時效策略IOC, FOK           |

### 返回值
| 字段    | 含義       |
| ------- | ---------- |
| orderNo | 借入訂單號 |  | actualSize | 實際借入數量 |


## 2 還幣
```json 
{
    "success": true,
    "code": "200",
    "msg": "success",
    "retry": false,
    "data": {
        "orderNo": "5da6dba0f943c0c81f5d5db5",
        "actualSize": 10
    }
}
```
該接口用於發起全倉或逐倉的還幣申請
### Http 請求
`POST /api/v3/margin/repay`                                       

### 請求示例:
`POST /api/v3/margin/repay`

### Api 權限
此接口需要**槓桿交易權限**

### 請求參數
| 字段       | 類型       | 含義                                  |
| ---------- | ---------- | ------------------------------------- |
| isIsolated | Boolean    | [可選] true-逐倉,false-全倉;默認false |
| symbol     | String     | [可選] 交易對, 逐倉賬戶必填           |
| currency   | String     | [必選] 幣種                           |
| size       | BigDecimal | [必選] 還幣數量                       |


### 返回值
| 字段       | 含義         |
| ---------- | ------------ |
| orderNo    | 還款訂單號   |
| actualSize | 實際還款數量 |

## 3 查詢借幣紀錄
```json 
{
    "currentPage": 1,
    "pageSize": 50,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "orderNo": "5da6dba0f943c0c81f5d5db5",
            "symbol": "BTC-USDT",
            "currency": "USDT",
            "size": 10,
            "actualSize": 10,
            "status": "DONE",
            "createdTime": 1555056425000
        }
    ]
}
```
該接口用於查詢全倉和逐倉的借幣訂單
### Http 請求
`GET /api/v3/margin/borrow`                                     
### 請求示例:
`GET /api/v3/margin/borrow`

### Api 權限
此接口需要**槓桿交易權限**

### 請求參數
| 字段        | 類型    | 含義                                            |
| ----------- | ------- | ----------------------------------------------- |
| currency    | String  | [必選] 幣種                                     |
| isIsolated  | Boolean | [可選] true-逐倉,false-全倉;默認false           |
| symbol      | String  | [可選] 交易對, 逐倉賬戶必填                     |
| orderNo     | String  | [可選] 訂單號                                   |
| startTime   | Long    | [可選] 開始時間                                 |
| endTime     | Long    | [可選] 結束時間                                 |
| currentPage | Int     | [可選] 當前查詢頁, 開始值1。 默認:1             |
| pageSize    | Int     | [可選] 每頁紀錄數，默認:50, 最小值10，最大值500 |


### 返回值
| 字段        | 含義                 |
| ----------- | -------------------- |
| orderNo     | 借幣訂單ID           |
| symbol      | 逐倉交易對，全倉為空 |
| currency    | 幣種                 |
| size        | 申請借幣數量         |
| actualSize  | 實際借幣數量         |
| status      | 狀態                 |
| createdTime | 借幣時間             |

### 備註
查詢時間範圍最大不得超過30天。 若 startTime 和 endTime 沒傳，則默認返回最近 7 天數據只能查最近 6 個月的數據

## 4 查詢還幣申請紀錄
```json 
{
    "currentPage": 1,
    "pageSize": 50,
    "totalNum": 1,
    "totalPage": 1,
    "items": {
        "orderNo": "5da6dba0f943c0c81f5d5db5",
        "symbol": "BTC-USDT",
        "currency": "USDT",
        "size": 10,
        "actualSize": 10,
        "status": "DONE",
        "createdTime": 1555056425000
    }
}
```
該接口用於查詢全倉和逐倉的還幣申請訂單
### Http 請求
`GET /api/v3/margin/repay`
### 請求示例:
`GET /api/v3/margin/repay`

### Api 權限
此接口需要**槓桿交易權限**

### 請求參數
| 字段        | 類型    | 含義                                            |
| ----------- | ------- | ----------------------------------------------- |
| currency    | String  | [必選] 幣種                                     |
| isIsolated  | Boolean | [可選] true-逐倉,false-全倉;默認false           |
| symbol      | String  | [可選] 交易對, 逐倉賬戶必填                     |
| orderNo     | String  | [可選] 訂單號                                   |
| startTime   | Long    | [可選] 開始時間                                 |
| endTime     | Long    | [可選] 結束時間                                 |
| currentPage | Int     | [可選] 當前查詢頁, 開始值1。 默認:1             |
| pageSize    | Int     | [可選] 每頁紀錄數，默認:50, 最小值10，最大值500 |


### 返回值
| 字段        | 含義                      |
| ----------- | ------------------------- |
| orderNo     | 還幣訂單號                |
| symbol      | 逐倉交易對，全倉為空      |
| currency    | 幣種                      |
| size        | 申請還幣數量              |
| principal   | 支付的本金數量            |
| interest    | 支付的利息                |
| status      | 狀態還款中，已完成， 失敗 |
| createdTime | 還幣時間                  |

## 錯誤碼：
| 外部 Code | message                                                                        |
| --------- | ------------------------------------------------------------------------------ |
| 400400    | 參數錯誤                                                                       |
| 130201    | 請先開通槓桿交易                                                               |
| 130201    | 您的相關權限已被限制，可聯繫客服進行處理                                       |
| 130201    | 借貸功能已禁用                                                                 |
| 130202    | 系統正在自動續借,請稍後再試                                                    |
| 130202    | 系統正在強平處理,請稍後再試                                                    |
| 130202    | 請先償還所有負債                                                               |
| 130202    | 借入中，請稍後再試                                                             |
| 130202    | 網絡超時,系統處理中                                                            |
| 130202    | 系統正在自動續借,請稍後再試                                                    |
| 130202    | 倉位強平確認中，請稍後重試                                                     |
| 130202    | 系統處理中，請稍後重試                                                         |
| 130202    | 有借入委託未完成，可稍後重試                                                   |
| 130203    | 賬戶餘額不足                                                                   |
| 130203    | 超過最大借入額度，剩餘可藉入數量: {1}{0}                                       |
| 130204    | 平台槓桿{0}借貸累計總量達到平台設置的最大槓桿借貸總量，系統暫停槓桿{1}借入功能 |
| 130204    | 平台槓桿{0}持倉累計總量達到平台設置的最大槓桿持倉總量，系統暫停槓桿{1}借入功能 |
| 130204    | 根據平台最大借入量風控限制，您最大可藉入{0}{1}                                 |

# 借貸市場(V3)
## 1 查詢借貸市場借出幣種信息
```json 
{
    "currentPage": 1,
    "pageSize": 100,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "currency": "BTC",
            "purchaseEnable": true,
            "redeemEnable": true,
            "increment": "1",
            "minPurchaseSize": "10",
            "minInterestRate": "0.004",
            "maxInterestRate": "0.02",
            "interestIncrement": "0.0001",
            "maxPurchaseSize": "20000",
            "marketInterestRate": "0.009",
            "autoPurchaseEnable": true
        }
    ]
}
```
該接口提供借貸市場支持的借出幣種信息查詢
### Http 請求
`GET /api/v3/project/list`                                              

### 請求示例:
`GET /api/v3/project/list?currency=BTC`

### Api 權限
此接口需要**通用權限** 。

### 請求參數
| 字段     | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [可選] 幣種 |

### 返回值
| 字段               | 含義                                    |
| ------------------ | --------------------------------------- |
| currency           | 幣種                                    |
| purchaseEnable     | 支持申購                                |
| redeemEnable       | 支持贖回                                |
| increment          | 申購、贖回步長精度                      |
| minPurchaseSize    | 最小申購數量                            |
| minInterestRate    | 最小出借年利率                          |
| maxInterestRate    | 最大出借年利率                          |
| interestIncrement  | 利息步長精度，默認0.0001                |
| maxPurchaseSize    | 用戶最大申購限額                        |
| marketInterestRate | 最新市場年利率                          |
| autoPurchaseEnable | 是否開啟自動申購：true:開啟，false:關閉 |


## 2 查詢市場出借利率
```json 
[
    {
        "time": "202303261200",
        "marketInterestRate": "0.003"
    },
    {
        "time": "202303261300",
        "marketInterestRate": "0.004"
    }
]
```
該接口提供借貸市場最近7天利率 
### Http 請求
` GET /api/v3/project/marketInterestRate `           

### 請求示例:
`GET /api/v3/project/marketInterestRate?currency=BTC`

### Api 權限
此接口需要**通用權限** 。

### 請求參數
| 字段     | 類型   | 含義        |
| -------- | ------ | ----------- |
| currency | String | [必選] 幣種 |

### 返回值
| 字段               | 含義               |
| ------------------ | ------------------ |
| time               | 時間：YYYYMMDDHH00 |
| marketInterestRate | 市場利率           |


## 3 申購
```json 
{
    "orderNo": "5da6dba0f943c0c81f5d5db5"
}
```
發起借貸市場申購
### Http 請求
`POST /api/v3/purchase`

### 請求示例:
`POST /api/v3/purchase`

### Api 權限
此接口需要**槓桿交易權限** 。

### 請求參數
| 字段         | 類型   | 含義            |
| ------------ | ------ | --------------- |
| currency     | String | [必選] 幣種     |
| size         | String | [必選] 申購金額 |
| interestRate | String | [必選] 申購利率 |


### 返回值
| 字段    | 含義                                                       |
| ------- | ---------------------------------------------------------- |
| orderNo | 申購訂單號如果已存在幣種+利率的申購單，返回上一次的orderNo |

## 4 贖回
```json 
{
    "orderNo": "5da6dba0f943c0c81f5d5db5"
}
```
發起借貸市場贖回
### Http 請求
`POST /api/v3/redeem` 
    
### 請求示例:
`POST /api/v3/redeem`

### Api 權限
此接口需要**槓桿交易權限** 。

### 請求參數
| 字段            | 類型   | 含義              |
| --------------- | ------ | ----------------- |
| currency        | String | [必選] 幣種       |
| size            | String | [必選] 贖回金額   |
| purchaseOrderNo | String | [必選] 申購訂單號 |


### 返回值
| 字段    | 含義       |
| ------- | ---------- |
| orderNo | 贖回訂單號 |


## 5 修改申購訂單
```json 
{
    "success": true,
    "code": "200",
    "msg": "success",
    "retry": false
}
```
該接口提供借貸市場申購訂單利率修改，在下一個整點生效。

### Http 請求
`POST /api/v3/lend/purchase/update`


### 請求示例:
`POST /api/v3/lend/purchase/update`

### Api 權限
此接口需要**槓桿交易權限** 。

### 請求參數
| 字段            | 類型   | 含義                    |
| --------------- | ------ | ----------------------- |
| currency        | String | [必選] 幣種             |
| purchaseOrderNo | String | [必選] 申購訂單號       |
| interestRate    | String | [必選] 修改後的申購利率 |

### 返回值
Void



## 6 查詢贖回訂單
```json 
 {
    "currentPage": 1,
    "pageSize": 100,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "currency": "BTC",
            "purchaseOrderNo": "5da6dba0f943c0c81f5d5db5",
            "redeemOrderNo": "5da6dbasdffga1f5d5dfsb5",
            "redeemAmount": "300000",
            "receiptAmount": "250000",
            "applyTime": 1669508513820,
            "status": "PENDING",
        }
    ]
}
```
該接口提供借貸市場贖回訂單分頁查詢
### Http 請求
`GET /api/v3/redeem/orders`

### 請求示例:
`GET /api/v3/redeem/orders?currency=BTC&status=DONE&currentPage=1&pageSize=10`

### Api 權限
此接口需要**通用權限** 。

### 請求參數
| 字段          | 類型   | 含義                                     |
| ------------- | ------ | ---------------------------------------- |
| currency      | String | [必選] 幣種                              |
| redeemOrderNo | String | [可選] 贖回訂單號                        |
| status        | String | [必選] DONE-已完結;PENDING-結算中        |
| currentPage   | Int    | [可選] 當前頁,默認1                      |
| pageSize      | Int    | [可選] 頁大小， 1<=pageSize<=100，默認50 |

### 返回值
| 字段            | 含義                             |
| --------------- | -------------------------------- |
| currency        | 幣種                             |
| purchaseOrderNo | 申購訂單號                       |
| redeemOrderNo   | 贖回訂單號                       |
| redeemSize      | 贖回數量                         |
| receiptSize     | 已贖回數量                       |
| applyTime       | 申請贖回時間                     |
| status          | 狀態，DONE-已完結;PENDING-結算中 |


## 7 查詢申購訂單
```json 
{
    "currentPage": 1,
    "pageSize": 100,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "currency": "BTC",
            "purchaseOrderNo": "5da6dba0f943c0c81f5d5db5",
            "purchaseAmount": "300000",
            "lendAmount": "0",
            "redeemAmount": "300000",
            "interestRate": "0.0003",
            "incomeAmount": "200",
            "applyTime": 1669508513820,
            "status": "DONE",
        }
    ]
}
```
該接口提供借貸市場申購訂單分頁查詢
### Http 請求
`GET /api/v3/purchase/orders`

### 請求示例:
`GET /api/v3/purchase/orders?currency=BTC&status=DONE&currentPage=1&pageSize=10`

### Api 權限
此接口需要**通用權限** 。

### 請求參數
| 字段            | 類型   | 含義                                     |
| --------------- | ------ | ---------------------------------------- |
| currency        | String | [必選] 幣種                              |
| purchaseOrderNo | String | [可選] 申購訂單號                        |
| status          | String | [必選] DONE-已完結;PENDING-結算中        |
| currentPage     | Int    | [可選] 當前頁,默認1                      |
| pageSize        | Int    | [可選] 頁大小， 1<=pageSize<=100，默認50 |

### 返回值
| 字段            | 含義                           |
| --------------- | ------------------------------ |
| currency        | 幣種                           |
| purchaseOrderNo | 申購訂單號                     |
| purchaseSize    | 累計申購數量                   |
| matchSize       | 已撮合部分數量                 |
| redeemSize      | 已贖回數量                     |
| interestRate    | 目標年化利率                   |
| incomeSize      | 累計收益                       |
| applyTime       | 申購發起時間                   |
| status          | 狀態DONE-已完結;PENDING-結算中 |

## 錯誤碼：
| 外部 Code | message                  |
| --------- | ------------------------ |
| 130101    | 幣種不允許申購           |
| 130101    | 利率步長錯誤             |
| 130101    | 利率超過範圍             |
| 130101    | 申購金額超過單筆申購範圍 |
| 130101    | 申購金額步長錯誤         |
| 130101    | 贖回金額步長錯誤         |
| 130101    | 利率超過範圍             |
| 130102    | 超過用戶最大申購總額度   |
| 130103    | 申購訂單不存在           |
| 130104    | 超過用戶最大申購訂單數   |
| 130105    | 餘額不足                 |
| 130106    | 幣種不支持贖回           |
| 130107    | 贖回金額超過申購金額     |
| 130108    | 贖回訂單不存在           |












# 其他接口

## 獲取服務器時間
```json
{
    "code":"200000",
    "msg":"success",
    "data":1546837113087
}
```
此接口，可獲取服務器時間 (Unix時間戳)

### HTTP請求
`GET /api/v1/timestamp`

### 請求示例
`GET /api/v1/timestamp`

<aside class="spacer2"></aside>

## 獲取服務狀態
```json
{
    "code":"200000",
    "data":{

        "status":"open", //open:正常交易, close：停止交易/維護, cancelonly：只可以撤單，不能下單
        "msg":"upgrade match engine"
    }
}
```
此接口，可獲取服務狀態

### HTTP REQUEST
`GET /api/v1/status`

### Example
`GET /api/v1/status`

### RESPONSES
| 字段     | 含義                                          |
|-------- | -------------------------------------------   |
| status  | 服務狀態: **open**：正常交易、 **close**：停止交易/維護、 **cancelonly**：只可以撤單，不能下單 |
| msg     | 操作說明                                        |


# Websocket
REST API的使用受到了訪問頻率的限制，因此推薦您使用Websocket獲取實時數據。

<aside class="notice">推薦您只創建一個Websocket連接，在這個連接上訂閱多個通道的數據</aside>

## 申請連接令牌
在創建Websocket連接前，您需申請一個令牌（Token）。

### 公共令牌 (不需要驗證簽名):
```json
{
	"code": "200000",
	"data": {
		"token": "2neAiuYvAU61ZDXANAGAsiL4-iAExhsBXZxftpOeh_55i3Ysy2q2LEsEWU64mdzUOPusi34M_wGoSf7iNyEWJ4aBZXpWhrmY9jKtqkdWoFa75w3istPvPtiYB9J6i9GjsxUuhPw3BlrzazF6ghq4L_u0MhKxG3x8TeN4aVbNiYo=.mvnekBb8DJegZIgYLs2FBQ==",
		"instanceServers": [{
			"endpoint": "wss://ws-api-spot.kucoin.com/",	//建議使用動態URL，該URL可能會改變
			"encrypt": true,
			"protocol": "websocket",
			"pingInterval": 18000,
			"pingTimeout": 10000
		}]
	}
}

```
如果您只訂閱公共頻道的數據，請按照以下方式請求獲取服務實例列表和公共令牌。

#### HTTP請求
`POST /api/v1/bullet-public`

### 私有令牌 (需要驗證簽名):
如您需請求私有頻道的數據（如：賬戶資金變化），請在簽名驗證後按照以下方式獲取Websocket的服務實例和已驗籤的令牌。

#### HTTP請求
`POST /api/v1/bullet-private`

### 返回值
|字段 | 含義|
-----|-----
|endpoint| Websocket建立連接的服務器地址 |
|protocol| 支持的協議 |
|encrypt| 表示是否使用了SSL加密 |
|pingInterval| 建議發送ping的時間間隔（毫秒）|
|pingTimeout| 如果在pingTimeout時間後，未收到pong消息，那麼連接可能已斷開了 |
|token | 令牌 |

## 建立連接
```javascript
var socket = new WebSocket("wss://ws-api-spot.kucoin.com/?token=xxx&[connectId=xxxxx]");
```
成功建立連接後，您將會收到系統向您發出的歡迎（welcome）消息。

<aside class="notice">客戶端需要等待welcome消息，只有收到了welcome消息，才表示連接可用。</aside>

```json
{
    "id":"hQvf8jkno",
    "type":"welcome"
}
```
**connectId**：連接ID，是客戶端生成的唯一標識。您在創建連接時收到的歡迎（welcome）消息的ID以及錯誤消息的ID都屬於連接ID（connectId）。

如果你想只接收指定topic的私人消息，請在訂閱時使用privateChannel:true。

<aside class="spacer2"></aside>

## Ping
```json
{
    "id":"1545910590801",
    "type":"ping"
}
```
爲防止服務器斷開TCP連接，建議客戶端每間隔pingInterval時間發送一條ping指令。
在服務器收到ping消息後，系統會向客戶端返回一條pong消息。
如果服務器長時間沒有收到來自客戶端的消息，連接將被斷開。

```json
{
    "id":"1545910590801",
    "type":"pong"
}
```
<aside class="spacer3"></aside>

## 訂閱
```json
  // 訂閱
{
    "id":"123456789",
    "type":"subscribe",
    "topic":"/market/ticker:BTC-USDT,ETH-USDT",
    "privateChannel":false,
    "response":true
}
```
使用服務器訂閱消息時，客戶端應向服務器發送訂閱消息。

訂閱成功後，當**response**參數爲**true**時，系統將向您發出**“ack”消息**。

```json
{
    "id":"1545910660739",
    "type":"ack"
}
```

當訂閱頻道產生新消息時，系統將向客戶端推送消息。瞭解消息格式，請查看頻道介紹。

### 參數
#### ID
ID用於標識請求和ack的唯一字符串。

#### Topic
您訂閱的頻道內容。

#### PrivateChannel
您可通過privateChannel參數訂閱以一些特殊的topic（如：/market/level2）。該參數默認設置爲“false”。設置爲“true”時，則您只能收到與您訂閱的topic相關的內容推送。

#### Response
若設置爲True, 用戶成功訂閱後，系統將返回ack消息。

客戶端需要發送訂閱消息到服務端，獲取指定topic的消息。

但系統會將相應topic的消息發送到客戶端，詳情返回值請參照指定的topic。

## 退訂
用於取消您之前訂閱的topic

```json
  // 取消訂閱
{
    "id":"1545910840805",  //要求唯一
    "type":"unsubscribe", //類型: unsubscribe
    "topic":"/market/ticker:BTC-USDT,ETH-USDT",
    "privateChannel":false, //是否使用該頻道的私有頻道，默認爲false
    "response":true //是否需要服務端返回本次訂閱的回執信息，默認爲false   
}

```

```json
{
    "id":"1545910840805",
    "type":"ack"
}
```

### 參數

#### ID
用於標識請求的唯一字符串。

#### Topic
您訂閱的topic內容。

#### PrivateChannel
設置爲“true”，您可以退訂相關的私有頻道推送。


#### Response
退訂成功後，當**response**參數爲**true**時，系統將向您發出“ack”消息。


## 多路複用
 在一條物理連接上，您可開啓多條多路複用通道，以訂閱不同topic，獲取多種數據推送。

### 開啓
例如： 請輸入以下指令定開啓多條bt1通道 {"id": "1Jpg30DEdU", "type": "openTunnel", "newTunnelId": "bt1", "response": true}

在指定中添加參數tunnelId： {"id": "1JpoPamgFM", "type": "subscribe", "topic": "/market/ticker:KCS-BTC"，"tunnelId": "bt1", "response": true}

### 返回值
請求成功後，您將收到 tunnelIId 對應的消息推送：{"id": "1JpoPamgFM", "type": "message", "topic": "/market/ticker:KCS-BTC", "subject": "trade.ticker", "tunnelId": "bt1", "data": {...}}

### 關閉
請輸入以下指令：{"id": "1JpsAHsxKS", "type": "closeTunnel", "tunnelId": "bt1", "response": true}

### 限制
- 多路複用僅限API用戶使用。
- 最多可開啓的多路複用通道條數：5條。

## 定序編號
買賣盤數據化、成交歷史數據以及快照消息均會默認返回sequence字段。您可以從Level 2和Level 3市場行情數據中的sequence來判斷數據是否丟失，連接是否穩定。如果連接不穩定，請按照校準流程進行校準。

## 消息處理邏輯

- 判斷消息的type: 目前有三類消息，message（常用的推送消息），notice（一般的通知），command（連接的命令）
- 判斷消息topic: 通過topic判斷是哪一類消息
- 判斷subject: 同一個topic的不同類型消息用subject區分。


# 公共頻道

## 交易瞬時行情
```json
{
    "id":1545910660739,
    "type":"subscribe",
    "topic":"/market/ticker:BTC-USDT",
    "response":true
}
```
```json
{
    "type":"message",
    "topic":"/market/ticker:BTC-USDT",
    "subject":"trade.ticker",
    "data":{
        "sequence":"1545896668986", //序列號
        "price":"0.08",             // 最近成交價格
        "size":"0.011",             // 最近成交數量
        "bestAsk":"0.08",           //最佳賣一價
        "bestAskSize":"0.18",       // 最佳賣一數量
        "bestBid":"0.049",          //最佳買一價
        "bestBidSize":"0.036",      //最佳買一數量
    }
}
```
Topic: `/market/ticker:{symbol},{symbol}...`

* 推送頻率: `100ms`一次

訂閱此topic可獲取指定[交易對](#d6402cad41)的BBO(最佳買一和賣一)數據的推送。

平臺後期可能會向該渠道推送更多的信息。

<aside class="spacer2"></aside>
<aside class="spacer4"></aside>


## 全部交易對瞬時行情

```json
{
    "id":1545910660739,
    "type":"subscribe",
    "topic":"/market/ticker:all",
    "response":true
}
```
```json
{
    "type":"message",
    "topic":"/market/ticker:all",
    "subject":"BTC-USDT",
    "data":{
        "sequence":"1545896668986",
        "price":"0.08",
        "size":"0.011",
        "bestAsk":"0.08",
        "bestAskSize":"0.18",
        "bestBid":"0.049",
        "bestBidSize":"0.036"
    }
}
```
Topic: `/market/ticker:all`

* 推送頻率: `100ms`一次

訂閱此topic可獲取所有的BBO(最佳買一和賣一)數據的推送。

<aside class="spacer8"></aside>


## 交易對行情快照

```json
{
    "type":"message",
    "topic":"/market/snapshot:KCS-BTC",
    "subject":"trade.snapshot",
    "data":{
        "sequence":"1545896669291",
        "data":{
            "trading":true,
            "symbol":"KCS-BTC",
            "buy":0.00011,
            "sell":0.00012,
            "sort":100,		//排序條數
            "volValue":3.13851792584,
            "baseCurrency":"KCS",
            "market":"BTC",
            "quoteCurrency":"BTC",
            "symbolCode":"KCS-BTC",
            "datetime":1548388122031,
            "high":0.00013,
            "vol":27514.34842,
            "low":0.0001,
            "changePrice":-0.00001,
            "changeRate":-0.0769,
            "lastTradedPrice":0.00012,
            "board":0,	//交易對分區 0.主分区 1.KuCoin Plus", example = "1"
            "mark":0	//交易對標記 0.default 1.ST. 2.NEW", example = "1"
        }
    }
}
```

Topic: `/market/snapshot:{symbol}`

* 推送頻率: `2s`一次

訂閱此topic對可以獲取單個[交易對](#d6402cad41)的行情快照信息。


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## 市場行情快照

```json
{
    "type":"message",
    "topic":"/market/snapshot:BTC",
    "subject":"trade.snapshot",
    "data":{
        "sequence":"1545896669291",
        "data":[
            {
                "trading":true,
                "symbol":"KCS-BTC",
                "buy":0.00011,
                "sell":0.00012,
                "sort":100,		//排序條數
                "volValue":3.13851792584,
                "baseCurrency":"KCS",
                "market":"BTC",
                "quoteCurrency":"BTC",
                "symbolCode":"KCS-BTC",
                "datetime":1548388122031,
                "high":0.00013,
                "vol":27514.34842,
                "low":0.0001,
                "changePrice":-0.00001,
                "changeRate":-0.0769,
                "lastTradedPrice":0.00012,
                "board":0,	//交易對分區 0.主分区 1.KuCoin Plus", example = "1"
                "mark":0	//交易對標記 0.default 1.ST. 2.NEW", example = "1"
            }
        ]
    }
}
```

Topic: `/market/snapshot:{market}`

* 推送頻率: `2s`一次

訂閱此topic可獲取指定[交易市場](#5666d37373)的所有交易對的行情快照。


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Level-2市場行情

```json
{
    "id":1545910660740,
    "type":"subscribe",
    "topic":"/market/level2:BTC-USDT",
    "response":true
}
```

Topic: `/market/level2:{symbol},{symbol}...`

* 推送頻率: `實時推送`

訂閱此topic可獲取指定[交易對](#d6402cad41)Level-2買賣盤數據。訂閱成功後，服務端會推送增量的市場數據給您。


```json
{
    "type": "message",
    "topic": "/market/level2:BTC-USDT",
    "subject": "trade.l2update",
    "data": {
        "changes": {
            "asks": [
                [
                    "18906",//price
                    "0.00331",//size
                    "14103845"//sequence
                ],
                [
                    "18907.3",
                    "0.58751503",
                    "14103844"
                ]
            ],
            "bids": [
                [
                    "18891.9",
                    "0.15688",
                    "14103847"
                ]
            ]
        },
        "sequenceEnd": 14103847,
        "sequenceStart": 14103844,
        "symbol": "BTC-USDT",
        "time": 1663747970273//milliseconds
    }
}
```

校準流程:

1. 將Websocket推送的Level 2數據緩存在本地;
2. 通過REST請求拉取[Level 2](#level-2-2)買賣盤的快照;
3. 回放緩存的Level 2數據流;
4. 將Level 2數據流應用到快照上，只需滿足 sequenceStart(new)<=sequenceEnd+1(old) 並且 seqenceEnd(new) > sequenceEnd(old)，即可認爲是有效的L2增量消息，可以用changes中的數據覆蓋本地數據。changes中每條記錄上的sequence僅表示該價格的數量最後一次修改對應的sequence，不作爲消息連續的判斷依據；
5. 根據訂單的價格和數量更新買賣盤。如果價格爲0，忽略這條消息，只更新順序號；如果數量爲0，則需要將該數量對應的訂單價格從買賣盤中移除。如遇其他情況，正常更新買賣盤即可。

[Level 2](#level-2-2) 的Change屬性是一個“price, size, sequence”的字符串值,即：[“價格”,“數量”,“sequence”]。

請注意: size指的是price對應的最新size。當size爲0時，需要將其對應的price從買賣盤中刪除。


**示例**

以BTC/USDT爲例，假設level 2當前買賣盤數據如下:

步驟1.成功訂閱此topic，您會收到如下買賣盤數據流:

<code>
...<br/>
"asks":[<br/>
&nbsp;&nbsp;["3988.59","3", 16], // 摒棄 sequence = 16<br/>
&nbsp;&nbsp;["3988.61","0", 19], // 移除 price 爲 3988.61 的數據<br/>
&nbsp;&nbsp;["3988.62","8", 15], // 摒棄 sequence <16 <br/>
]<br/>
"bids":[<br/>
&nbsp;&nbsp;["3988.50", "44", "18"] // 更新 price 爲 3988.50 的size<br/>
]<br/>
"sequenceEnd": 15,<br/>
"sequenceStart": 19,<br/>
...<br/>
</code>

<aside class="notice">changes中每條記錄上的sequence僅表示該價格的數量最後一次修改對應的sequence，不作爲消息連續的判斷依據；比如當在相同價位有多個數量更新["3988.50", "20", "17"]、["3988.50", "44", "18"]，此時只會推送最新的["3988.50", "44", "18"]</aside>

步驟2.通過REST請求拉取[Level-2買賣盤快照信息](#level-2-2)

<code>
...<br/>
"sequence": "16",<br/>
"asks":[<br/>
&nbsp;&nbsp;["3988.62","8"],// [“價格”,“數量”]<br/>
&nbsp;&nbsp;["3988.61","32"],<br/>
&nbsp;&nbsp;["3988.60","47"],<br/>
&nbsp;&nbsp;["3988.59","3"],<br/>
]<br/>
"bids":[<br/>
&nbsp;&nbsp;["3988.51","56"],<br/>
&nbsp;&nbsp;["3988.50","15"],<br/>
&nbsp;&nbsp;["3988.49","100"],<br/>
&nbsp;&nbsp;["3988.48","10"]<br/>
]<br/>
...<br/>
</code>

當前拉取的買賣盤的快照數據如下:

<code>
| Price | Size | Side |<br/>
|---------|-----|------|<br/>
| 3988.62 | 8&nbsp;&nbsp;    | Sell |<br/>
| 3988.61 | 32&nbsp;   | Sell |<br/>
| 3988.60 | 47&nbsp;   | Sell |<br/>
| 3988.59 | 3&nbsp;&nbsp;    | Sell |<br/>
| 3988.51 | 56&nbsp;   | Buy&nbsp;  |<br/>
| 3988.50 | 15&nbsp;   | Buy&nbsp;  |<br/>
| 3988.49 | 100  | Buy&nbsp;  |<br/>
| 3988.48 | 10&nbsp;  | Buy&nbsp;  |<br/>
</code>

當前買賣盤快照信息的sequence爲`16`，摒棄買賣盤數據流中sequence <= 16的數據，回放sequence爲`[18,19]`的數據，更新買賣盤快照信息。現在，您本地的sequence爲`19`。

變更:

- 將價格3988.50對應的數量變更爲44（sequence順序號爲18）
- 移除價格爲3988.61的數據（sequence順序號爲19）

變更後，當前買賣盤數據爲最新數據，具體數據如下:

<code>
| Price | Size | Side |<br/>
|---------|-----|------|<br/>
| 3988.62 | 8&nbsp;&nbsp;    | Sell |<br/>
| 3988.60 | 47&nbsp;    | Sell |<br/>
| 3988.59 | 3&nbsp;&nbsp; | Sell |<br/>
| 3988.51 | 56&nbsp;    | Buy&nbsp;   |<br/>
| 3988.50 | 44&nbsp;    | Buy&nbsp;   |<br/>
| 3988.49 | 100  | Buy&nbsp;   |<br/>
| 3988.48 | 10&nbsp;   | Buy&nbsp;   |<br/>
</code>

## Level2 - 5檔深度頻道
```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth5:BTC-USDT",
    "subject": "level2",
    "data": {
	    "asks":[
            ["9989","8"],     //價格, 數量
            ["9990","32"],
            ["9991","47"],
            ["9992","3"],
 	        ["9993","3"],
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

Topic: `/spotMarket/level2Depth5:{symbol},{symbol}...`

* 推送頻率: `100ms`一次

每次返回前五檔的深度數據，此數據爲每100毫秒的快照數據，即每隔100毫秒，快照當前時刻市場買賣盤的5檔深度數據並推送

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Level2 - 50檔深度頻道
```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth50:BTC-USDT",
    "subject": "level2",
    "data": {
	    "asks":[
            ["9993","3"],    //價格, 數量
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

Topic: `/spotMarket/level2Depth50:{symbol},{symbol}...`

* 推送頻率: `100ms`一次

每次返回前50檔的深度數據，此數據爲每100毫秒的快照數據，即每隔100毫秒，快照當前時刻市場買賣盤的50檔深度數據並推送

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>


## K線

```json
{
    "type":"message",
    "topic":"/market/candles:BTC-USDT_1hour",
    "subject":"trade.candles.update",
    "data":{
        "symbol":"BTC-USDT",    // 交易對
        "candles":[
            "1589968800",   // candle的開盤時間
            "9786.9",       // open開票價
            "9740.8",       // close收盤價
            "9806.1",       // high最高價
            "9732",         // low最低價
            "27.45649579",  // volume成交量
            "268280.09830877"   // turnover成交額
        ],
        "time":1589970010253893337  // 當前時間，納秒
    }
}
```
Topic: `/market/candles:{symbol}_{type}`

* 推送頻率: `實時推送`

參數 |  含義
--------- | -------
symbol | 交易對
type |  `1min`, `3min`, `15min`, `30min`, `1hour`, `2hour`, `4hour`, `6hour`, `8hour`, `12hour`, `1day`, `1week`


訂閱此topic可獲取指定 symbol的指定 type 的K線數據。

訂閱成功後，服務端會推送的市場K線數據給您。

<aside class="spacer2"></aside>







## 撮合執行數據

```json
{
    "id": 1545910660741,                          
    "type": "subscribe",
    "topic": "/market/match:BTC-USDT",
    "privateChannel": false,                      
    "response": true                              
}
```
Topic: `/market/match:{symbol},{symbol}...`

* 推送頻率: `實時推送`

訂閱此topic，可獲取撮合執行數據。


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
<!-- <aside class="spacer2"></aside> -->


<!-- 
<aside class="spacer4"></aside>
<aside class="spacer"></aside> -->

## 指數價格

```json
{
  "id": 1545910660740,
  "type": "subscribe",
  "topic": "/indicator/index:USDT-BTC",
  "response": true
}
```



<!-- <aside class="spacer4"></aside> -->
<!-- <aside class="spacer2"></aside> -->

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
Topic: `/indicator/index:{symbol0},{symbol1}...`

訂閱此topic，可獲取槓桿交易使用的指數價格。

目前支持的指數價格見：[目前支持的交易對列表](#f09581452e)

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 標記價格

```json
{
  "id": 1545910660741,
  "type": "subscribe",
  "topic": "/indicator/markPrice:USDT-BTC",
  "response": true
}
```
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
Topic: `/indicator/markPrice:{symbol0},{symbol1}...`

訂閱此topic，可獲取槓桿交易使用的標記價格。

目前支持的標記價格見：[目前支持的交易對列表](#f09581452e)

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 槓桿交易買賣盤變化

```json
{
  "id": 1545910660742,                              
  "type": "subscribe",
  "topic": "/margin/fundingBook:BTC",
  "response": true
}
```

```json
{
	"id": "5c24c5da03aa673885cd67ab",
	"type": "message",
	"topic": "/margin/fundingBook:BTC",
	"subject": "funding.update",
	"data": {
		"sequence": 1000000,       //序列號, 一條消息和上一條線消息的sequence相差1
		"currency": "BTC",         //幣種
		"dailyIntRate": "0.00007",   //日利率小數，0.2%返回0.002
		"annualIntRate": "0.12",     //年化利率小數，12%返回0.12
		"term": 7,                 //出借期限(天)
		"size": "1017.5",            //當前總數量，當爲0時，從funding-book中刪除
		"side": "lend",            //委託方向，目前只支持借出。lend - 借出；borrow - 借入
		"ts": 1553846081210004941  //時間戳(納秒)
  }
}
```

Topic: `/margin/fundingBook:{currency0},{currency1}...`

訂閱此topic，可獲取槓桿交易借貸買賣盤的變化。

<aside class="spacer8"></aside>


# 私有頻道

訂閱私人頻道需要`privateChannel=“true”`。

## 私有訂單變更事件

Topic: `/spotMarket/tradeOrders`

* 推送頻率: `實時推送`

該topic將推送所有有關您的訂單的變更事件。

**訂單狀態**

"match": 訂單爲taker時與買賣盤中訂單成交，此時該taker訂單狀態爲match；

"open": 訂單存在於買賣盤中；

"done": 訂單完成；


### 消息類型


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
        "orderTime":1670329987026,
        "size":"0.1",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487481000906",
        "remainSize":"0.1",
        "status":"open",
        "ts":1670329987311000000
    }
}
```

訂單進入買賣盤時發出的消息。

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
        "orderTime":1670329987026,
        "size":"0.1",
        "filledSize":"0.1",
        "price":"0.938",
        "matchPrice":"0.96738",
        "matchSize":"0.1",
        "tradeId":"5efab07a4ee4c7000a82d6d9",
        "clientOid":"1593487481000313",
        "remainSize":"0",
        "status":"match",
        "ts":1670329987311000000
    }
}
```
訂單成交時發出的消息

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
        "orderTime":1670329987026,
        "size":"0.1",
        "filledSize":"0.1",
        "price":"0.938",
        "clientOid":"1593487481000313",
        "remainSize":"0",
        "status":"done",
        "ts":1670329987311000000
    }
}
```
訂單因成交後狀態變爲DONE時發出的消息

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
        "orderTime":1670329987026,
        "size":"0.1",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487481000906",
        "remainSize":"0",
        "status":"done",
        "ts":1670329987311000000
    }
}
```
訂單因被取消後狀態變爲DONE時發出的消息

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
        "orderTime":1670329987026,
        "size":"0.06",
        "filledSize":"0",
        "price":"0.937",
        "clientOid":"1593487679000249",
        "remainSize":"0.06",
        "status":"open",
        "ts":1670329987311000000
    }
}
```
訂單因被修改發出的消息

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 交易私有订单变更事件V2

### Topic: /spotMarket/tradeOrdersV2

推送频率: 实时推送
该topic将推送所有有关您的订单的变更事件。
相對於v1，v2新增一個Order Status：“new”，在推送速度上沒有差別

### 订单状态

"match": 订单为taker时与买卖盘中订单成交，此时该taker订单状态为match；

"open": 订单存在于买卖盘中；

"done": 订单完成；

"new": 订单进入撮合；

#### received
订单进入撮合系统时发出的消息。

```json
    {
        "type":"message",
        "topic":"/spotMarket/tradeOrdersV2",
        "subject":"orderChange",
        "channelType":"private",
        "data":{
            "symbol":"KCS-USDT",
            "orderType":"limit",
            "side":"buy",
            "orderId":"5efab07953bdea00089965d2",
            "type":"received",
            "orderTime":1593487481683297666,
            "price":"0.937",
            "clientOid":"1593487481000906",
            "status":"new",
            "originSize": "0.1", // 原始数量
            "originFunds": "0.1", // 市价单原始资金
            "ts":1593487481683297666
    }
}
```

订单刚进入撮合系统，还未与对手盘做撮合逻辑时，会推送一条消息类型为"received"、订单状态为"new"的私有消息


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### open
订单进入买卖盘时发出的消息。

```json
    {
        "type":"message",
        "topic":"/spotMarket/tradeOrdersV2",
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
            "canceledSize": "0.1", // 累计取消数量
            "canceledFunds": "0.1", // 市价单累计取消资金
            "originSize": "0.1", // 原始数量
            "originFunds": "0.1", // 市价单原始资金
            "ts":1593487481683297666
       }
	}
```


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### match
订单成交时发出的消息

```json
    {
        "type":"message",
        "topic":"/spotMarket/tradeOrdersV2",
        "subject":"orderChange",
        "channelType":"private",
        "data": {
          "symbol": "KCS-USDT",
          "orderType": "limit",
          "side": "sell",
          "orderId": "5efab07953bdea00089965fa",
          "liquidity": "taker",
          "type": "match",
          "orderTime": 1593487482038606180,
          "size": "0.1",
          "filledSize": "0.1",
          "price": "0.938",
          "matchPrice": "0.96738",
          "matchSize": "0.1",
          "tradeId": "5efab07a4ee4c7000a82d6d9",
          "clientOid": "1593487481000313",
          "remainSize": "0",
          "status": "match",
          "canceledSize": "0.1", // 累计取消数量
          "canceledFunds": "0.1", // 市价单累计取消资金
          "originSize": "0.1", // 原始数量
          "originFunds": "0.1", // 市价单原始资金
          "ts": 1593487482038606180
        }
    }
```


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### filled
订单因成交后状态变为DONE时发出的消息

```json
    {
        "type":"message",
        "topic":"/spotMarket/tradeOrdersV2",
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
            "canceledSize": "0.1", // 累计取消数量
            "canceledFunds": "0.1", // 市价单累计取消资金
            "originSize": "0.1", // 原始数量
            "originFunds": "0.1", // 市价单原始资金
            "ts":1593487482038606180
      }
    }
```


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### canceled
订单因被取消后状态变为DONE时发出的消息

```json
    {
    "type":"message",
    "topic":"/spotMarket/tradeOrdersV2",
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
        "canceledSize": "0.1", // 累计取消数量
        "canceledFunds": "0.1", // 市价单累计取消资金
        "originSize": "0.1", // 原始数量
        "originFunds": "0.1", // 市价单原始资金
        "ts":1593487481893140844
        }
    }
```

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

#### update
订单因被修改发出的消息

```json
{
    "type":"message",
    "topic":"/spotMarket/tradeOrdersV2",
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
        "canceledSize": "0.1", // 累计取消数量
        "canceledFunds": "0.1", // 市价单累计取消资金
        "originSize": "0.1", // 原始数量
        "originFunds": "0.1", // 市价单原始资金
        "ts":1593487682916117521
    }
}
```



<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>



## 餘額變更事件
```json
{
    "type":"message",
    "topic":"/account/balance",
    "subject":"account.balance",
    "channelType":"private",
    "data":{
        "total": "88", //總額
        "available": "88", // 可用餘額
        "availableChange": "88", // 可用餘額變化值
        "currency": "KCS", // 幣種
        "hold": "0", // 凍結金額
        "holdChange": "0", // 可用凍結金額變化值
        "relationEvent": "trade.setted", // 關聯事件
        "relationEventId": "5c21e80303aa677bd09d7dff", // 關聯事件id
        "relationContext": {
            "tradeId":"5e6a5dca9e16882a7d83b7a4", // 成交了纔會有tradeId
            "orderId":"5ea10479415e2f0009949d54",
            "symbol":"BTC-USDT"
        }, // 交易事件的上下文
    "time": "1545743136994" // 時間戳
  }
}

```
Topic: `/account/balance`

* 推送頻率: `實時推送`

當您的賬戶餘額變更時，您會收到詳細的賬戶變更信息。

### Relation Event

類型 | 描述
--------- | -------
main.deposit | 充值入賬
main.withdraw_hold | 提現凍結
main.withdraw_done | 提現完成
main.transfer | 儲蓄賬戶轉賬
main.other | 儲蓄賬戶其他操作
trade.hold | 交易賬戶凍結
trade.setted | 交易賬戶入賬
trade.transfer | 交易賬戶轉賬
trade.other | 交易賬戶其他操作
margin.hold | 槓桿賬戶凍結
margin.setted | 槓桿賬戶入賬
margin.transfer | 槓桿賬戶轉賬
margin.other | 槓桿賬戶其他操作，包含解凍回，解凍支付等
isolated_%s.hold | 逐倉槓桿賬戶凍結
isolated_%s.setted | 逐倉槓桿賬戶入帳
isolated_%s.transfer | 逐倉槓桿賬戶轉帳
isolated_%s.other | 逐倉槓桿賬戶其他操作
other | 其他操作

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 負債率推送

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"debt.ratio",
    "channelType":"private",
    "data": {
        "debtRatio": 0.7505,                                         //負債率
        "totalDebt": "21.7505",                                      //總負債(轉換爲BTC的價值)
        "debtList": {"BTC": "1.21","USDT": "2121.2121","EOS": "0"},  //負債列表
        "timestamp": 15538460812100                                  //時間戳(毫秒)
    }
}

```

Topic: `/margin/position`

存在負債時，系統會定時推送當前的負債信息。

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 倉位狀態變更事件

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"position.status",
    "channelType":"private",
    "data": {
        "type": "FROZEN_FL",         //事件類型
        "timestamp": 15538460812100  //時間戳(毫秒)
    }
}
```

Topic: `/margin/position`

倉位狀態發生變更時，會推送狀態變更事件。

事件類型描述：

FROZEN_FL：爆倉凍結。負債率超過爆倉線，倉位凍結時，推送此事件。

UNFROZEN_FL：解除爆倉凍結。爆倉處理完成後，倉位恢復到EFFECTIVE狀態時，推送此事件。

FROZEN_RENEW：自動續借凍結。貸款到期，系統自動續借處理，倉位凍結時，推送此事件。

UNFROZEN_RENEW：解除自動續借凍結。自動續借處理完成後，倉位恢復到EFFECTIVE狀態時，推送此事件。

LIABILITY：穿倉事件。用戶發生穿倉時，推送此事件。

UNLIABILITY：解除穿倉。歸還所有負債後，倉位恢復到EFFECTIVE狀態時，推送此事件。



<aside class="spacer8"></aside>
<aside class="spacer4"></aside>

## 槓桿交易訂單入買賣盤

```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.open",
    "channelType":"private",
    "data": {
        "currency": "BTC",                            //幣種
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //訂單id
        "dailyIntRate": 0.0001,                       //日利率
        "term": 7,                                    //出借期限(天)
        "size": 1,                                    //借貸數量
        "side": "lend",                               //委託方向，目前只支持借出。lend - 借出；borrow - 借入
        "ts": 1553846081210004941                     //時間戳(納秒)
    }
}
```

Topic: `/margin/loan:{currency}`

出借訂單入買賣盤時向出借方推送。

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 槓桿交易訂單更新

```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.update",
    "channelType":"private",
    "data": {
        "currency": "BTC",                            //幣種
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //訂單id
        "dailyIntRate": 0.0001,                       //日利率
        "term": 7,                                    //出借期限(天)
        "size": 1,                                    //借貸數量
        "lentSize": 0.5,                              //已借出數量
        "side": "lend",                               //委託方向，目前只支持借出。lend - 借出；borrow - 借入
        "ts": 1553846081210004941                     //時間戳(納秒)
    }
}

```

Topic: `/margin/loan:{currency}`

借貸撮合成功時向出借方推送。
<aside class="spacer8"></aside>

## 槓桿交易訂單完成

```json
{
	"type": "message",
	"topic": "/margin/loan:BTC",
	"subject": "order.done",
    "channelType":"private",
	"data": {
		"currency": "BTC",                            //幣種
		"orderId": "ac928c66ca53498f9c13a127a60e8",   //訂單id
		"reason": "filled",                           //訂單完成原因, 有filled(撮合完成)和canceled(取消)
		"side": "lend",                               //委託方向，目前只支持借出。lend - 借出；borrow - 借入
		"ts": 1553846081210004941                     //時間戳(納秒)
    }
}
```

Topic: `/margin/loan:{currency}`

出借訂單完成時向出借方推送。
<aside class="spacer8"></aside>
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

## 止盈止損事件

Topic: `/spotMarket/advancedOrders`

* 推送頻率: `實時推送`

Subject: stopOrder


1、當系統收到止盈止損訂單時，您將收到一條type爲的'open'消息，表示此訂單已委託成功並等待觸發。

2、當您的止盈止損訂單被觸發時，您將收到一條type爲的'triggered'消息，表示此訂單已經被觸發。

3、當您的止盈止損訂單被取消時，您將收到一條type爲的'cancel'消息，表示此訂單已被取消。