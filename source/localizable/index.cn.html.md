---
title: title

language_tabs: # must be one of https://git.io/vQNgJ


toc_footers:
  - <a href='https://www.kucoin.com'>Sign Up for KuCoin</a>

includes:

search: true
---

# 快速开始

## 简介

欢迎使KuCoin开发者文档。

本文档概述了交易功能、市场行情和其他应用开发接口。


API分为两部分：**REST API和Websocket 实时数据流**

 -  REST API包含四个类别：**[用户模块](#b6935b918b)（私有），[交易模块](#484936af01)（私有），[市场数据](#841ec28ecd)（公共），[杠杆交易](#540fbda255)，[其他接口](#cd67660573)（公共）**
 -  Websocket包含两类：**公共频道和私人频道**

## 更新预告

为了您能获取到最新的API 变更的通知，请在 [KuCoin Docs Github](https://github.com/Kucoin/kucoin-api-docs)添加关注【Watch】

**为了进一步提升API安全性，KuCoin已经升级到了V2版本的API-KEY，验签逻辑也发生了一些变化，建议到[API管理页面](https://www.kucoin.cc/account/api)添加并更换到新的API-KEY。KuCoin将继续支持使用老的API-KEY到2021年05月01日。[查看新的签名方式](#8ba46c43fe)**

**06/04/21**:

- 【修改】基于clientOid可查询订单全生命周期[基于clientOid 获取单个订单详情](#clientoid-2) 
- 【修改】修改订单详情时间戳，显示到毫秒级别

**04/26/21**:

- 【添加】 [Level-2全部买卖盘(价格聚合)](#level-2-3),[Level-3全部买卖盘(非聚合)](#level-3-3) 增加V3版本的Level2，Level3接口，这两个接口需要通用权限
- 【废弃】 [Level-2全部买卖盘(价格聚合)](#level-2-2),[Level-3全部买卖盘(非聚合)](#level-3-2) 废弃V2版本的Level2，Level3接口
- 【添加】 [获取充值地址(V2)](#v2) 接口 

**02/24/21**

- 【添加】 [杠杆下单接口](#08c835db7a)


**11/05/20**:

- 【添加】 [手续费](#307d666742)模块，增加[用户基础手续费](#a7b53083e5),[用户实际费率](#4d7761e141)接口
- 【添加】 增加[账户流水记录](#c8122540e1)接口，并弃用[账户流水记录（弃用）](#9b26dde3d2)接口


**10/28/20**:


- 【添加】 [全局行情快照](#f3027c9902),[24小时统计](#24) 增加吃单基础手续费、挂单基础手续费、吃单手续费系数、挂单手续费系数
- 【添加】 [子母账号资金划转](#108b1a50d2) 增加划转账户类型
- 【添加】 [内部资金划转](#c08ac949fb) 增加划转账户类型
- 【废弃】 [子母账号资金划转](#108b1a50d2) 中'/api/v1/accounts/sub-transfer'接口
- 【添加】 新增REST API[止盈止损](#e7116ba965)
- 【添加】 新增websocket[止盈止损事件](#3c27c94b77)，并弃用[止损单放置事件](#7bd1b172b3)和[止损单触发事件](#44aa1ad733)

**08/12/20**:

- 【添加】 新增[基于clientOid 单个撤单](#clientoid)
- 【添加】 新增[基于clientOid 获取单个活跃订单详情](#clientoid-2)

**07/13/20**:

- 【添加】 新增[私有订单变更事件](#6c2474816d)，公共频道[完整的撮合引擎数据（改版）(Level 3)](#level-nbsp-3-2)，[Level2 - 5档深度频道](#level2-5)，[Level2 - 50档深度频道](#level2-50)；
- 【添加】 新增[Level-3全部买卖盘(非聚合)(改版)](#level-3-3)；


**06/12/20**:

- 【添加】 Websocket推送消息增加channelType字段: public(公共频道，默认)、private(用户私有频道)、session(会话频道)；
- 【弃用】 三个月后移除私用频道topic中({topic}:privateChannel:{userId})和私有消息中的userId

**05/28/20**:

- 【修改】 [账户流水记录](#c8122540e1)新增唯一id

**04/22/20**:

- 【废弃】 2020年05月10日废弃[账户冻结记录](#8092434cb7)接口
- 【添加】 [余额变更事件](#5a9519dabe) 新增 **relationContext**
- 【修改】 USDT币种的默认链修改为ERC20

**04/09/20**:

- 【添加】 [账户列表](#f0f7ae469d) 添加类型**pool** ，支持矿池账户查询
- 【添加】 [内部资金划转](#c08ac949fb) 类型**pool**，支持矿池账户划转
- 【添加】 [账户可划转资金](#766919e88c) 类型**pool**，获取矿池账户的可划转的资金
- 【弃用】 [账户流水记录](#c8122540e1) 返回值中的 **balance** 字段且展示为0

**03/27/20**:

- 【添加】 [账户流水记录](#c8122540e1) 添加 **bizType** 和 **direction** 请求参数

**03/11/20**:

- 【新增】 [服务状态](#fb99032698)

**02/03/20**:

- 【新增】 [批量下单](#de93fae07b)

**01/03/20**:

- 【新增】 [下单](#fd6ce2a756)接口，新增**postOnly**说明

**27/02/20**:

- 【新增】 [下单](#fd6ce2a756)接口，新增价格保护机制

**02/01/20**:

- 【添加】 [Level-3全部买卖盘(非聚合)](#level-3-2) 添加**time**时间字段
- 【添加】 [止损单触发事件](#bd9bf72174) 添加字段**reason**，支持止损触发类型

**10/20/19**:

- 【废弃】 [内部资金划转](#c08ac949fb) 中'/api/v1/accounts/inner-transfer'接口
- 【添加】 [账户列表](#f0f7ae469d) 添加类型**margin**，支持杠杆账户查询
- 【添加】 [单个账户详情](#7f8d035c7d) 支持杠杆账户查询
- 【添加】 [创建账户](#9ec360d41d) 添加类型**margin**，支持杠杆账户创建
- 【添加】 [账户流水记录](#c8122540e1) 增加杠杆业务类型
- 【添加】 [账户冻结记录](#8092434cb7) 增加杠杆业务类型
- 【添加】 [获取单个子账户信息](#db03191132) 支持杠杆账户查询
- 【添加】 [获取所有子账户信息](#93f3f96acd) 支持杠杆账户查询
- 【添加】 [子母账号资金划转](#108b1a50d2) 类型**MARGIN**，支持杠杆账户划转
- 【添加】 [内部资金划转](#c08ac949fb) 类型**margin**，支持杠杆账户划转
- 【添加】 [账户可划转资金](#766919e88c)可获取账户可用于划转的资金
- 【添加】 [下单](#fd6ce2a756)添加**tradeType**字段，可支持杠杆交易
- 【添加】 [全部撤单](#f175a031e7)添加**tradeType**字段，区分现货交易和杠杆交易
- 【添加】 [获取订单列表](#23e02e24af)、[最近订单记录](#35acc0041f)和[单个订单详情](#d86507e2dd) 添加**tradeType**字段，区分现货交易和杠杆交易
- 【添加】 [成交记录](#6a30a471cf)和[最近成交记录](#5abc068b38) 添加**tradeType**字段，区分现货交易和杠杆交易
- 【添加】 [交易对列表](#a17b4e2866)**isMarginEnabled**字段  
- 【添加】 [币种详情](#cb79285fc3) 和 [币种列表](#ebcc9fbb02) **isMarginEnabled** 和 **isDebitEnabled** 字段
- 【添加】 [杠杆交易](#540fbda255) 模块.



**10/17/19**:

- 【添加】 [获取充值列表](#a5dabc006) 和 [获取提现列表](#c46f4b3b8e)添加 **remark** 字段

**10/12/19**:

- 【合并】 [交易市场列表](#b8f118fefc) ETH、NEO、TRX交易区为ALTS交易区

**9/26/19**:

- 【新增】 [全局行情快照](#f3027c9902) 添加返回值**symbolName** 交易对名称

**6/19/19**:

- 【修改】 [子母账号划转接口](#108b1a50d2)

**6/13/19**:

- 【添加】 对接Open API[常见问题](#765f554c38)
- 【添加】 [Level-3的优势](#34b637869b).

**5/28/19**:

- 【修改】 [交易市场列表](#b8f118fefc) SC改名为USDS。
- 【添加】 [内部资金划转](#c08ac949fb) 新增接口，原来的接口于三个月后（8/28/19）过期。
- 【添加】 [申请提现](#6eaf6b9ae0) **指定收藏地址提现** 描述。
- 【添加】 [24小时统计](#24) 添加字段 **averagePrice** 昨日24小时平均成交价格。

**5/8/19**:

- 【添加】 [申请提现](#6eaf6b9ae0)，[获取提现额度](#c46f4b3b8e)，[申请充值地址](#9277fb3f66)，[获取充值地址](#b3114995fd)，[币种详情](#cb79285fc3)，添加**chain**字段。
- 【添加】 [内部资金划转](#c08ac949fb) 添加资金划转操作步骤。
- 【添加】 对接[Level-3撮合引擎数据](#level-nbsp-3)的[go-level-3-SDK](#level-nbsp-3)
- 【修改】 [请求频率限制](#26435b04cf)


**4/24/19**:

- 【删除】 [完整的撮合引擎数据(Level&nbsp;3)](#level-nbsp-3) 为了保护隐藏订单信息，在**received** 消息中删除 **size**  和 **funds** 字段，私人频道字段保持不变。
- 【删除】 [完整的撮合引擎数据(Level&nbsp;3)](#level-nbsp-3) 为了保护隐藏订单信息，在 **open** 消息中删除 **remainSize** 字段，私人频道字段保持不变。
- 【新增】 [获取所有子账号信息](#a0bc1cb873)接口。
- 【新增】 [获取单个子账户信息](#db03191132)接口。
- 【新增】 [获取所有子账户信息](#93f3f96acd)接口。
- 【新增】 [子母账号资金划转](#108b1a50d2)接口。

**3/27/19** :

- 【添加】 [交易对列表](#a17b4e2866) **feeCurrency** 字段。

**3/25/19** :

- 【添加】 [全局行情快照](#f3027c9902) **volValue** 字段。
- 【添加】 [完整的撮合引擎数据(Level&nbsp;3)](#level-nbsp-3) **received**消息中  **clientOid** 字段，您可以通过 **clientOid** 来筛选订单信息。
- 【添加】 私人频道[余额变更](#5a9519dabe) **accountId** 字段，您可以通过 **accountId** 来跟踪账户余额变更信息。

**3/13/19** :

- 【修改】 一个用户，允许单个交易对，撮合中的订单最大数为200（包括止损订单）。

**3/6/19** :

- 【添加】 订单系统和撮合引擎时间单位为  **nanoseconds**。

**2/28/19** :

- 【修改】 [交易对列表](#a17b4e2866) 返回值描述。
- 【新增】 [获取V1历史充值列表](#v1)接口。
- 【新增】 [获取V1历史提现列表](#v1-2)接口。
- 【新增】 [获取V1历史订单列表](#v1-3)接口。
- 【添加】 部分API JSON 字段描述。
- 【删除】 [撮合执行数据](#c7f054198c) 删除 **sn** 字段 。
- 【修改】 [法币换算价格](#a2e56e9e0e) 参数描述。

**2/22/19** :

- 【添加】 [24小时统计](#24) 添加**volValue**字段。

**2/21/19** :

- 【新增】 [全部买卖盘(价格合并)](#level-2-2)
- 【添加】 Level-1,2,3 数据添加 **time** 字段
- 【新增】 [法币换算价格](#a2e56e9e0e)接口。

**2/20/19** :

- 【添加】 [全局行情快照](#f3027c9902)和[行情快照](#b784c68bd3)添加 **time** 字段

**2/19/19** :

- 【添加】 [全局行情快照](#f3027c9902)

**2/18/19** :

- 【新增】 [最近订单列表](#23e02e24af)接口
- 【新增】 [最近成交记录](#5abc068b38)接口

**2/16/19** :

- 【添加】 公共频道添加[全部交易对瞬时行情](#251e3b7813) 订阅
- 【修改】 [权限](#api-2)描述

**1/30/19** :

- 【新增】 官方SDK [CCXT](#client-libraries)

**1/25/19** :

- 【添加】 [Get Market List](#get-market-list)
- 【添加】 [交易对行情快照](#396f791c4d)
- 【添加】 [按市场的交易对行情快照](#1240da64f2)
- 【添加】 官方的 [Java & Go SDK](#level-nbsp-3)


## 阅读指南

1.  [沙盒环境](#2d9a68bcb2) 帮助您在测试环境更快地了解和使用API。
2.  [REST&nbsp;API](#rest-api) 如何创建一个REST&nbsp;API。
3.  [服务器时间](#89b4aa6364) 在无需验签的情况下，可以获取服务器时间。（可用作连接测试）
4.  [服务状态](#7cc1fc76fc) 根据服务状态来维护交易策略。
5.  [接口认证](#e6a574d26d) 如何进行接口认证。
6.  [内部资金划转](#c08ac949fb) 储蓄账户和交易账户之间资产的相互划转。
7.  [账户列表](#f0f7ae469d) 获取个人的账户资产指南。
8.  [下单](#fd6ce2a756) 获取下单操作指南。
9.  [委托买卖盘](#ab5235c05c) 获取买卖盘的快照信息。
10. [Websocket](#42f0e0ea9d) 如何创建Websocket 连接
11. [Level-2 市场行情](#level-2-3) 如何使用Websocket 在本地构建一个实时的买卖盘。
12. [余额变更](#5a9519dabe) 通过Websocket实时获取账户余额变更信息



## 子账号
子账号需要在Web端进行创建，并配置子账号的API。
子账号可以用作隔离资金和交易。资金可以在母账号和子账号之间相互划转。
子账户的资金仅用于子账号交易，不可以提现。

子账号的API可以访问所有公共接口。此外，通过API-KEY可以访问以下私有接口。

| 接口名称                  | 含义                          |
| --------------------- | --------------------------- |
| [账户列表](#f0f7ae469d)   | 获取所有账户信息                    |
| [单个账户详情](#7f8d035c7d) | 获取单个账户信息                    |
| [创建账户](#9ec360d41d)   | 创建账户                        |
| [账户流水记录](#c8122540e1) | 获取账户流水记录                    |
| [账户冻结记录](#8092434cb7) | 获取账户冻结记录                    |
| [内部资金划转](#c08ac949fb) | 储蓄账户和交易账户资金相互划转             |
| [下单](#fd6ce2a756)     | 下单                          |
| [单个撤单](#fc69531f52)   | 取消单个订单                      |
| [全部撤单](#f175a031e7)   | 取消所有订单                      |
| [订单记录](#23e02e24af)   | 获取订单记录                      |
| [最近订单记录](#35acc0041f) | 获取最近24小时内的订单列表（最多获取1000条记录） |
| [单个订单详情](#d86507e2dd) | 获取单个订单详情                    |
| [成交记录](#6a30a471cf)   | 获取成交记录                      |
| [最近成交记录](#5abc068b38) | 获取最近24小时内的成交记录（最多1000条记录）   |
| [基于clientOid 单个撤单](#clientoid)   | 基于clientOid 单个撤单                      |
| [基于clientOid 获取单个订单详情](#clientoid-2) | 基于clientOid 获取单个订单详情   |
子账号与母账号共享同一手续费等级（根据子账号与母账号交易额/KCS持有量累加求和计算划分）。
子账号在交易之前需要将资金从储蓄账户转到交易账户。

<aside class="notice">子账号不支持提现和充值</aside>

## 撮合引擎

### 订单生命周期

当订单进入撮合引擎时，订单状态为 **received** 。如果一个订单与另外一个订单完全撮合，订单状态更新为 **done** 。一个订单可以部分成交或全部成交，未被撮合的订单状态为 **open**。当订单被取消（ **canceled** ）或成交（ **filled** ），订单状态更新为 **done**, 否则订单会一直保持 **open** 状态。

### 自成交保护（STP）

您可在高级设置中设置**自成交保护**策略。您的订单将不会发生自成交。如果您在再下单时没有指定**STP**，否则您的订单可能会与被自己的订单成交。需要注意的是，只有taker方的保护策略生效。

#### 减量和取消(DC)

目前，**市价单不支持减量和取消（DECREMENT AND CANCEL）**。针对同一个用户，同一个交易对，买卖订单同时存在，数量少的订单取消，数量多的订单减去少的一方的数量，继续执行撮合。如果数量相同，两个订单都会取消。

#### 取消旧的订单(CO)

**Cancel Old** 全部取消旧的订单，新的订单继续执行撮合。

#### 取消新的订单(CN)

**Cancel New** 全部取消新的订单，旧的订单仍然在买卖盘中。

#### 双方都取消(CB)

**Cancel Both** 买卖方都取消。

### 撮合引擎数据

#### Level-3 市场数据（推荐使用）

撮合引擎推送的数据，是每一个订单的信息，即Level-3的市场数据。<br/>
Level-3市场数据更适合高频交易者<br/>
您通过WebSocket订阅[Level-3市场数据](#level-nbsp-3):

* 更快速获取到市场实时的行情信息，推送速度Level-3 >= Level-2
* 可以用于构建维护买卖盘
* 可以获取单笔订单的数量变动原
* 更实时的获取到订单的成交情况
* 可以完全取代Rest API的大部分拉取信息功能(Rest请求有严格的请求频率限制)

不同的类型信息的处理可以参考[Level-3 SDK](#4623bd9386)或参考下方Level-3的[Message Type](#level-nbsp-3)

## 客户端开发库

客户端库可以帮助您快速集成我们的API。

**官方**

- [Java SDK](https://github.com/Kucoin/KuCoin-Java-SDK)
- [PHP SDK](https://github.com/Kucoin/KuCoin-PHP-SDK)
- [Go SDK](https://github.com/Kucoin/KuCoin-Go-SDK)
- [Level3-SDK](https://github.com/Kucoin/kucoin-level3-sdk)
- [Python SDK](https://github.com/Kucoin/kucoin-python-sdk)
- [Nodejs SDK](https://github.com/Kucoin/kucoin-node-sdk)

CCXT 是我们官方SDK提供方，您可以使用CCXT来对接Kucoin API。
更多信息, 请访问: [https://ccxt.trade](https://ccxt.trade).



**代码样例**

- PHP 文件样例 (GET & POST & DELETE)  [Github Link](https://github.com/Kucoin/kucoin-api-docs/tree/master/examples/php)

- - -

## 沙盒测试环境

**沙盒是测试环境**，用于测试API连接和Web交易，并提供交易的所有功能。在沙盒中，您可以使用虚拟资金来测试交易功能。 沙盒环境中的登录会话和API密钥与生产环境完全分离。您可以使用沙盒环境中的Web界面来创建API密钥。

注意：在沙盒环境中注册后，您将收到系统在您的帐户中自动充值的一定数量的测试资金（BTC，ETH或KCS）。如果您想**交易**，请将资产从**储蓄**账户转移到**交易**账户。这些资金仅用于测试目的，不能提现。

用于API测试的沙盒URL：

网址：
**[https://sandbox.kucoin.com](https://sandbox.kucoin.com)**

REST&nbsp;API 连接地址:
**https://openapi-sandbox.kucoin.com**


## 请求频率限制

当请求频率超过限制频率时，系统将返回 **403 Forbidden** 或者 **429 Too Many Request** 提示。如果请求次数多次超过频率限制，你的IP或账户会被限制使用，限制时间至少1分钟。请求返回中包含当前类型的剩余请求次数。


###REST API

我们通过 **API-KEY** 限制 REST API： **每分钟1800次请求**，一个账号最多可以[创建](#api-key)10个API-KEY。该策略对公共接口和私有接口皆适用。

####硬性限制
[获取成交记录](#6a30a471cf): **每十秒100次请求**（超过会被禁用10秒）
[获取订单列表](#23e02e24af): **每十秒200次请求**（超过会被禁用10秒）
[批量下单](#de93fae07b): **每十秒10次请求** （超过会被禁用10秒）

###WEBSOCKET

### 连接数量

每个用户ID同时建立的连接数： ≤ 50个

### 连接次数

连接请求次数限制：每分钟 30次 请求

### 上行消息条数

向服务器发送指令条数限制：每10秒 100条

### 订阅topic数量

单次最多批量订阅数量限制：100个topic

每个连接最大可订阅topic数量限制：300个topic

### 申请提高频率限制

做市商或专业交易员，如需提高请求频率，请将您的账户信息、申请原因，及交易量发送至[api@kucoin.com](mailto:api@kucoin.com)。

## 做市激励计划

KuCoin为专业做市商提供做市激励计划。
参与该计划，可以获得以下激励：

- 做市商返佣
- 每个月奖励高达30,000 KCS，来回馈最佳的做市商
- 直接市场接入和主机托管服务

具有良好做市策略和大交易量的用户欢迎参与此长期做市激励计划。如果您的账户在过去30天内的交易量超过5000 BTC，请提供以下信息以发送电子邮件至mm@kucoin.com，邮件主题为“Spot Market Maker Application”：

- 提供平台帐户（需要电子邮件，无需推荐关系）
- 过去30天内在任何交易所交易的交易量证明或VIP级别的证明
- 请简要说明做市的方法（不需要详细说明）以及估算做市订单量的百分比。


## VIP快速通道

具有良好做市策略和大交易量的用户欢迎参与长期做市商计划。 如果您的帐户资产大于10BTC，请提供以下信息以发送电子邮件至：

**vip@kucoin.com**（现货）进行做市商申请;

- 提供平台帐户（需要电子邮件，无需推荐关系）;
- 提供其他交易平台做市商交易量的截图（例如30天内的交易量，或VIP级别等）;
- 请简要说明做市的方法，不需要详细说明。

## 常见问题

### 签名错误

* 检查API-KEY，API-SECRET，API-PASSPHRASE是否正确
* 检查签名内容顺序 timestamp + method + requestEndpoint + body
* 检查header中timestamp是否与生成signature一致
* 检查签名生成是否为base64编码
* get请求是否以表单方式提交
* post请求的数据格式是否是json格式（application/json; charset=utf-8）

### 申请提现
* memo字段<br/>
  个别币种提现需要memo字段，该字段在其他平台可能会表示成tag或paymentId<br/>
  对于没有 memo 的币种，在使用API提现的时候是不能传递memo值，否则，接口会返回 **kucoin incorrect withdrawal address**
* amount字段<br/>
  amount需要符合该币种提现的precision，可以通过[获取提现额度](#5bd567d526)获取<br/>
  提现金额必须为提现精度的整数倍，如果为0表示只能为整数。

### .net SDK
* POST请求验签错误<br/>
  {"code":"400005", "msg":"Invalid KC-API-SIGN"}<br/>
  代码有bug<br/>
  var response = body == null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);<br/>
  修改为:<br/>
  var response = body != null ? await _restRepo.PostApi<ApiResponse<T>, SortedDictionary<string, object>>(url, body, headers) : await _restRepo.PostApi<ApiResponse<T>>(url, headers);

### WebSocket 限制
* 一个连接最多订阅300个topic；
* token有效期24小时；
* 一个用户最多50个连接；
* 客户端每10秒最多上行100个消息；
* 一个symbol就是一个topic; e.g.Topic: /market/level3:{symbol},{symbol}...

### 返回 403 问题

如返回以下错误消息：
403 "The request could not be satisfied. Bad Request" from Amazon CloudFront<br/>

* 检查请求是否为HTTPS
* 移除GET请求中的RequestBody

# REST API

## API服务器地址

REST API 对于账户、订单、和市场数据均提供了接口。

基本URL: **https://api.kucoin.com**。

<aside class="notice">为了遵守当地法律要求，使用中国IP的用户不允许访问以上URL。</aside>

请求URL由基本URL和接口端点组成。

## 接口端点(Endpoint)

每个接口都提供了对应的端点（Endpoint），可在HTTP请求模块下获取。

对于**GET** 请求, 端点需要要包含请求参数。

例如，对于"[账户列表](#f0f7ae469d)"接口，其默认端点为 **/api/v1/accounts**。
如果您的请求参数currency=BTC，则该端点将变为 **/api/v1/accounts?currency=BTC**。因此，您最终请求的URL应为：**https://api.kucoin.com/api/v1/accounts?currency=BTC**。


## 请求

所有的POST请求和返回内容类型都是 **application/json**.  

除非另行说明，所有的时间戳参数均以Unix时间戳毫秒计算。如：**1544657947759**

### 请求参数

对于 **GET和DELETE** 请求, 需将参数拼接在请求URL中。(**例如， /api/v1/accounts?currency=BTC**)

对于 **POST和PUT** 请求, 需将参数以JSON格式拼接在请求主体中(**例如， {"currency":"BTC"}**)。
注意：不要在JSON字符串中添加空格。

### 错误返回

系统会返回HTTP错误代码或系统错误代码。您可根据返回的参数消息排查错误原因。

#### HTTP错误码

```json
{
    "code":"400100",
    "msg":"Invalid Parameter."
}

```

| 代码  | 意义                                                                 |
| --- | ------------------------------------------------------------------ |
| 400 | Bad Request -- 无效的请求格式                                             |
| 401 | Unauthorized -- 无效的API-KEY                                         |
| 403 | Forbidden 或 Too Many Requests -- 请求被禁止 或 超过[请求频率限制](#26435b04cf)     |
| 404 | Not Found -- 找不到指定资源                                               |
| 405 | Method Not Allowed -- 您请求资源的方法不正确                                  |
| 415 | Content-Type: application/json -- [请求类型](#请求)必须为application/json类型 |
| 500 | Internal Server Error -- 服务器出错，请稍后再试                               |
| 503 | Service Unavailable -- 服务器维护中，请稍后再试                                |



#### 系统错误码

| 代码   | 意义                                                         |
| ------ | ------------------------------------------------------------ |
| 200001 | Order creation for this pair suspended--交易对暂停交易       |
| 200002 | Order cancel for this pair suspended--交易对暂停取消订单     |
| 200003 | Number of orders breached the limit--委托中订单数量过多      |
| 200009 | Please complete the KYC verification before you trade XX--需要通过KYC高级认证才能交易该币对 |
| 200004 | Balance insufficient--账户余额不足                           |
| 400001 | Any of KC-API-KEY, KC-API-SIGN, KC-API-TIMESTAMP, KC-API-PASSPHRASE is missing in your request header -- 请求头中缺少[验签参数](#35e3a383b3) |
| 400002 | KC-API-TIMESTAMP Invalid -- 请求时间与服务器时差超过5秒      |
| 400003 | KC-API-KEY not exists -- API-KEY 不存在                      |
| 400004 | KC-API-PASSPHRASE error -- API-PASSPHRASE 不正确             |
| 400005 | Signature error -- [签名](#8ba46c43fe)错误，请检查您的签名     |
| 400006 | The requested ip address is not in the api whitelist -- 请求IP不在API白名单中 |
| 400007 | Access Denied -- API权限不足，无法访问该URI目标地址。        |
| 404000 | Url Not Found -- 找不到请求资源                              |
| 400100 | Parameter Error -- 请求参数不合法                            |
| 400200 | Forbidden to place an order--禁止在该交易对下单              |
| 400500 | Your located country/region is currently not supported for the trading of this token--该数字资产不支持您所在区域的用户参与，感谢您的理解 |
| 400700 | Transaction restricted, there's a risk problem in your account--您的账户存在风险问题，暂时不允许进行交易 |
| 400800 | Leverage order failed--杠杠下单失败                          |
| 411100 | User are frozen -- 用户被冻结，请联系[帮助中心](https://kucoin.zendesk.com/hc/zh-cn/requests/new) |
| 500000 | Internal Server Error -- 服务器出错，请稍后再试              |
| 900001 | symbol not exists--交易对不存在                              |

如果系统返回HTTP状态码为200，但业务失败，系统会报错。您可根据返回的参数消息排查错误。

### 成功返回

当系统返回HTTP状态码200和系统代码200000时，表示响应成功，返回结果如下：

```json
{
    "code":"200000",
    "data":"1544657947759"
}
```

### 分页

Pagination允许使用当前页数获取结果，非常适用于获取实时数据。如/api/v1/deposits、/api/v1/orders及/api/v1/fills端点均默认返回第一页结果，共50条数据。如需获取更多数据，请根据当前返回的数据指定其他分页，然后再进行请求。


#### 请求参数

| 参数名称    | 默认值 | 含义                            |
| ----------- | ------ | ------------------------------- |
| currentPage | 1      | 当前页码                        |
| pageSize    | 50     | 每页记录数，最小值10，最大值500 |

#### 示例

**GET /api/v1/orders?currentPage=1&pageSize=50**


## 类型说明

### 时间戳

所有时间戳参数都应以毫秒为单位，除非另有说明。例如， **1544657947759**。

撮合引擎和订单系统的时间戳使用的是纳秒为单位。

### 数字

为了保证跨平台的数字的精确度，Decimal转化为字符串返回。请在发出请求时，将数字转换为字符串来避免数字被截断或者精度错误。

## 接口认证

### 创建API-KEY
通过接口进行请求前，您需在Web端创建API-KEY。创建成功后，您需妥善保管好以下三条信息：


* Key
* Secret
* Passphrase

Key和Secret由KuCoin随机生成并提供，Passphrase是您在创建API时使用的密码。以上信息若遗失将无法恢复，需要重新申请API KEY。

### API权限

您可在KuCoin Web端管理API权限。API权限分为以下几类：

* **通用权限** - 允许API访问大部分的GET请求。
* **交易权限** - 允许API具有下单权限。
* **提现权限** - 允许API划转资金，包含充值和提现。子账号没有提现权限。
  授权提现权限时请注意，不需要邮箱验证和谷歌验证就可以使用API进行转账。



请参考下方API文档，看接口具体需要哪些权限。

### 创建请求

Rest请求头必须包含以下内容:

* **KC-API-KEY** API-KEY以字符串传递
* **KC-API-SIGN** [签名](#8ba46c43fe)
* **KC-API-TIMESTAMP** 请求的时间戳
* **KC-API-PASSPHRASE** 创建API时填的API-KEY的密码
* **KC-API-KEY-VERSION** API-KEY版本号，可通过[API管理](https://www.kucoin.cc/account/api)页面查看版本号

### 签名

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
        "KC-API-KEY-VERSION": 2,
        "Content-Type": "application/json" # specifying content type or using json=data in request
    }
    response = requests.request('post', url, headers=headers, data=data_json)
    print(response.status_code)
    print(response.json())
```
请求头中的 **KC-API-SIGN**:

1. 使用 API-Secret 对
    {timestamp + method + endpoint + body} 拼接的字符串进行**HMAC-sha256**加密。
2. 再将加密内容使用 **base64** 编码。

请求头中的 **KC-API-PASSPHRASE**:

1. 对于V1版的API-KEY，请使用明文传递
2. 对于V2版的API-KEY，需要将KC-API-KEY-VERSION指定为2，并将passphrase使用API-Secret进行**HMAC-sha256**加密，再将加密内容通过**base64**编码后传递

注意：

* 加密的 timestamp 需要和请求头中的KC-API-TIMESTAMP保持一致
* 用于加密的body需要和请求中的Request Body的内容保持一致
* 请求方法需要大写
* 对于 GET, DELETE 请求，endpoint 需要包含请求的参数（/api/v1/deposit-addresses?currency=BTC）。如果没有请求体（通常用于GET请求），则请求体使用空字符串””。



```python
#Example for Create Deposit Address

curl -H "Content-Type:application/json" -H "KC-API-KEY:5c2db93503aa674c74a31734" -H "KC-API-TIMESTAMP:1547015186532" -H "KC-API-PASSPHRASE:QWIxMjM0NTY3OCkoKiZeJSQjQA==" -H "KC-API-SIGN:7QP/oM0ykidMdrfNEUmng8eZjg/ZvPafjIqmxiVfYu4="  -H "KC-API-KEY-VERSION:2"
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

### 选择时间戳

请求头中的 **KC-API-TIMESTAMP** 必须为[Unix 时间](http://en.wikipedia.org/wiki/Unix_time)，精确到毫秒，例如，1547015186532。

服务器请求的时间戳与API服务器时差必须控制在5秒以内，否则请求会因过期而被服务器拒绝。如果服务器与API服务器之间存在时间偏差，请使用平台提供的服务器时间接口，获取API[服务器的时间](#3f1907847c)。

# 用户模块

此部分需进行[签名验证](#8ba46c43fe)。

# 用户信息

## 获取所有子账号信息

```json
[
    {
        "userId":"5cbd31ab9c93e9280cd36a0a", //subUserId子账号用户ID
        "subName":"kucoin1",
        "remarks":"kucoin1"
    },
    {
        "userId":"5cbd31b89c93e9280cd36a0d",
        "subName":"kucoin2",
        "remarks":"kucoin2"
    }
]
```

这个接口获取母账号下所有的子账号信息。

### HTTP请求

**Get /api/v1/sub/user**

### 请求示例

GET /api/v1/sub/user

### API权限

该接口需要**通用权限**。

### 返回值

| 字段      | 含义       |
| ------- | -------- |
| userId  | 子账号的用户ID |
| subName | 子账号的用户名  |
| remarks | 备注信息     |


##
# 账户

## 创建账户

此接口可以用于创建账户

```json
{
    "id":"5bd6e9286d99522a52e458de" //accountId
}
```

### HTTP请求
**POST /api/v1/accounts**

### 请求示例
POST /api/v1/accounts

### API权限
此接口需要**通用权限**。


### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
type | String | 账户类型，**main**、**trade**或**margin**
currency | String |[币种](#ebcc9fbb02)

### 返回值
字段 | 含义
--------- | -------
id | 账户ID -- accountId



## 账户列表

```json
[
    {
        "id":"5bd6e9286d99522a52e458de", //accountId
        "currency":"BTC",  //币种
        "type":"main", //账户类型，储蓄（main）账户、交易(trade)账户或杠杆（margin）账户
        "balance":"237582.04299",//资金总额
        "available":"237582.032", //可用金额
        "holds":"0.01099" //冻结金额
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
获取账号下账户详情列表。

交易前请先[充值](#fa03c46253)到储蓄账户，再使用[内部资金划转](#c08ac949fb)将资金从储蓄账户划转到交易账户。


### HTTP请求
**GET /api/v1/accounts**


### 请求示例
GET /api/v1/accounts

### API权限
此接口需要**通用权限**。


### 请求参数

请求参数 | 类型 | 含义
--------- | -------| -------
currency | String | [可选] [币种](#ebcc9fbb02)
type | String |[可选] 账户类型 **main**、**trade**、**margin**或**pool**

### 返回值
字段 | 含义
--------- | -------
id | accountId 账户ID
currency | 账户对应的币种
type |账户类型 ，**main**（储蓄账户）、**trade**（交易账户）、**margin**(杠杆账户)、**pool**(矿池账户)
balance | 账户资金总额
available | 账户可用的资金
holds | 账户冻结的资金

### 账户类型
账户划分为: 储蓄账户、交易账户和杠杆账户。

账户之间的资金划转不收取手续费。

储蓄账户主要用于资金的提现和充值，储蓄账户里面的资金不可以直接用于交易。交易之前需要将资金从储蓄账户转到交易账户。

交易账户主要用于交易。下单扣除的是交易账户里面的资金，交易账户里面的资金不可以直接提现，必须要转到储蓄账户才可以提现。

杠杆账户主要用于借入资产和杠杆交易。


账户之间资金划转请参考[内部资金划转](#c08ac949fb)。

### 冻结资金
当下单时，您用于下单的资金会被冻结。冻结的资金不可以用作再次下单或者提现。当订单取消或成交后，资金才能解冻回退或解冻支付。



## 单个账户详情

```json
{
    "currency":"KCS", //币种
    "balance":"1000000060.6299", //资金总额
    "available":"1000000060.6299", //可用资金
    "holds":"0" //冻结资金
}
```
此接口返回单个账户的详情。

### HTTP请求
**GET /api/v1/accounts/{accountId}**

### 请求示例
GET /api/v1/accounts/5bd6e9286d99522a52e458de

### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
accountId | String | 路径参数，[账户ID](#f0f7ae469d)

### 返回值
字段 | 含义
--------- | -------
currency | 币种
balance | 账户资金总额
holds | 冻结资金
available | 可用资金



## 账户流水记录（弃用）

已弃用，请用[账户流水记录](#c8122540e1)代替

此接口返回账户的出入账流水记录。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

```json
{
    "currentPage":1,
    "pageSize":10,
    "totalNum":2,
    "totalPage":1,
    "items":[
        {
            "id":"5bc7f080b39c5c03486eef8b",//唯一键
            "currency":"KCS",//币种
            "amount":"0.0998", //资金变动值
            "fee":"0", //充值或提现费率
            "balance":"0", //金额变动
            "bizType":"withdraw", //业务类型
            "direction":"in",  // 出入账方向入账或出账（in or out）
            "createdAt":1540296039000,  // 创建时间
            "context":{  // 业务核心参数
                "orderId":"5bc7f080b39c5c03286eef8a",
                "currency":"BTC"
            }
        },
        {
            "id":"5bc7f080b39c5c03486eef8c",
            "currency":"KCS",
            "amount":"0.0998",
            "fee":"0",
            "balance":"0",
            "bizType":"trade exchange",
            "direction":"in",
            "createdAt":1540296039000,
            "context":{
                "orderId":"5bc7f080b39c5c03286eef8e",
                "tradeId":"5bc7f080b3949c03286eef8a",
                "symbol":"BTC-USD"
            }
        }
    ]
}

```

### HTTP请求
**GET /api/v1/accounts/{accountId}/ledgers**


### 请求示例
GET /api/v1/accounts/5bd6e9286d99522a52e458de/ledgers

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
accountId | String | 路径参数，[账户ID](#f0f7ae469d)
direction | String | [可选] 出入账方向: **in** -入账, **out** -出账
bizType   | String | [可选] 业务类型: **DEPOSIT** -充值, **WITHDRAW** -提现, **TRANSFER** -转账, **SUB_TRANSFER** -子账户转账,**TRADE_EXCHANGE** -交易, **MARGIN_EXCHANGE** -杠杆交易, **KUCOIN_BONUS** -鼓励金
startAt   | long   | [可选] 开始时间（毫秒）
endAt     | long   | [可选] 截止时间（毫秒）


### 返回值
字段 | 含义
--------- | -------
id | 唯一键
currency | 币种
amount | 资金变动值
fee | 充值或提现费率
balance | 变动后的资金总额
bizType | 业务类型，比如交易，提现，推荐关系奖，借贷等
direction | 出入账方向 **out** 或 **in**
createdAt | 创建时间
context | 业务核心参数

### context
如果 **bizType** 是trade exchange，那么 **context** 字段会包含交易的额外信息（订单id，交易id，交易对）。



## 账户流水记录

此接口返回所有账户的出入账流水记录，支持多币种查询。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

```json
{
    "currentPage":1,
    "pageSize":10,
    "totalNum":2,
    "totalPage":1,
    "items":[
        {
            "id":"5bc7f080b39c5c03486eef8b",//唯一键
            "currency":"KCS",//币种
            "amount":"0.0998", //资金变动值
            "fee":"0", //充值或提现费率
            "balance":"0", //金额变动
            "bizType":"withdraw", //业务类型
            "direction":"in",  // 出入账方向入账或出账（in or out）
            "createdAt":1540296039000,  // 创建时间
            "context":{  // 业务核心参数
                "orderId":"5bc7f080b39c5c03286eef8a",
                "currency":"BTC"
            }
        },
        {
            "id":"5bc7f080b39c5c03486eef8c",
            "currency":"KCS",
            "amount":"0.0998",
            "fee":"0",
            "balance":"0",
            "bizType":"trade exchange",
            "direction":"in",
            "createdAt":1540296039000,
            "context":{
                "orderId":"5bc7f080b39c5c03286eef8e",
                "tradeId":"5bc7f080b3949c03286eef8a",
                "symbol":"BTC-USD"
            }
        }
    ]
}

```

### HTTP请求
**GET /api/v1/accounts/ledgers**


### 请求示例
GET /api/v1/accounts/ledgers?currency=BTC&startAt=1601395200000

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
currency | String |  [可选] 币种，选填，可多选，以逗号分隔，最多支持选择10个币种，若不填写，默认查询所有币种
direction | String | [可选] 出入账方向: **in** -入账, **out** -出账
bizType   | String | [可选] 业务类型: **DEPOSIT** -充值, **WITHDRAW** -提现, **TRANSFER** -转账, **SUB_TRANSFER** -子账户转账,**TRADE_EXCHANGE** -交易, **MARGIN_EXCHANGE** -杠杆交易, **KUCOIN_BONUS** -鼓励金
startAt   | long   | [可选] 开始时间（毫秒）
endAt     | long   | [可选] 截止时间（毫秒）


### 返回值
字段 | 含义
--------- | -------
id | 唯一键
currency | 币种
amount | 资金变动值
fee | 充值或提现费率
balance | 变动后的资金总额
bizType | 业务类型，比如交易，提现，推荐关系奖，借贷等
direction | 出入账方向 **out** 或 **in**
createdAt | 创建时间
context | 业务核心参数

### context

如果 **bizType** 是trade exchange，那么 **context** 字段会包含交易的额外信息（订单id，交易id，交易对）。

### BizType 含义
值 | 含义
--------- | -------
Assets Transferred in After Upgrading | 从V1迁入V2时系统升级转入
Deposit  | 获取充值入账记录
Withdrawal  | 获取提现记录
Transfer | 获取资金划转记录
Trade_Exchange | 获取币币交易记录
Vote for Coin | 投票上币分发资产
KuCoin Bonus | 获取鼓励金入账记录
Referral Bonus | 获取邀请奖励入账记录
Rewards | 一些活动发奖记录
Distribution  | 持币分发，持有NEO 获得GAS 等资产分发记录
Airdrop/Fork  | 某些代币的空投活动，比如持有BTC空投KCS
Other rewards | 其他奖励，除持币分发、空投、分叉之外的其他活动奖励
Fee Rebate | 手续费返佣，负手续费获得的手续费返佣
Buy Crypto | 使用信用卡购买资产
Sell Crypto | 使用信用卡出售资产
Public Offering Purchase | Spotlight活动公开发行某些资产
Send red envelope | 发送红包
Open red envelope  | 领取红包
Staking  | Staking锁仓
LockDrop Vesting | 进行Lockdrop认购
Staking Profits | Staking收益
Redemption | 赎回资产
Refunded Fees | KCS抵扣
KCS Pay Fees | KCS抵扣
Margin Trade | 杠杆交易
Loans   | 杠杆借出
Borrowings  | 杠杆借入
Debt Repayment   | 杠杆还款
Loans Repaid  | 杠杆收款
Lendings  | 借贷
Pool transactions  | Pool-X交易
Instant Exchange  | 闪兑交易
Sub-account transfer  | 子母账户转账
Liquidation Fees   | 爆仓手续费
Soft Staking Profits  | 获取Soft Staking收益
Voting Earnings  | Pool-X获取投票收益
Redemption of Voting  | Pool-X投票赎回资产
Voting  | Pool-X投票
Convert to KCS   | 一键转KCS


## 获取单个子账户信息

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

此接口可获取单个子账号的账户信息。

### HTTP请求
**GET /api/v1/sub-accounts/{subUserId}**

### 请求示例
GET /api/v1/sub-accounts/5caefba7d9575a0688f83c45


### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------  
subUserId | String | 路径参数，[子账号的用户Id](#a0bc1cb873)

### 返回值

字段 | 含义
--------- | -------
subUserId | 子账号的用户Id
subName | 子账号的用户名
currency | 币种
balance | 资金总额
available | 可用资金
holds | 冻结资金
baseCurrency | 基准币种
baseCurrencyPrice | 基准货币价格
baseAmount | 基准货币数量


## 获取所有子账户信息


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

此接口可获取所有子账号的账户信息。


### HTTP请求

**GET /api/v1/sub-accounts**

### 请求示例
GET /api/v1/sub-accounts

### API权限
此接口需要**通用权限**。

### 返回值

字段 | 描述
--------- | -------
subUserId | 子账号的用户ID
subName | 子账号的用户名
currency | 币种
balance | 资金总额
available | 可用资金
holds | 冻结资金
baseCurrency | 基准币种
baseCurrencyPrice | 基准货币价格
baseAmount | 基准货币数量



## 获取可划转资金

```json
{
    "currency":"KCS",
    "balance":"0",
    "available":"0",
    "holds":"0",
    "transferable":"0"
}
```
此接口可获取指定账户和币种下的可划转的资金。

### HTTP请求
**GET /api/v1/accounts/transferable**

### 请求示例
GET /api/v1/accounts/transferable?currency=BTC&type=MAIN

### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- |  -------
currency | String | [币种](#ebcc9fbb02)
type | String |  账户类型**MAIN**、**TRADE**、**MARGIN** 或 **POOL**


### 返回值
字段 | 含义
--------- | -------
currency | 币种
balance | 资金总额
available | 可用资金
holds | 冻结资金
transferable | 可划转资金


## 子母账号资金划转


```json
{
    "orderId":"5cbd870fd9575a18e4438b9a"
}
```

此接口，用于子母账号之间资金的划转。
支持母账号的储蓄/交易/杠杆账户向子账号的储蓄/交易/账户杠杆划转。合约账户只支持从其他账户转入资金，不支持转出资金至其他账户。


### HTTP请求
**POST /api/v2/accounts/sub-transfer**  

<aside class="notice">推荐使用</aside>


### 请求示例
POST /api/v2/accounts/sub-transfer

### API权限
此接口需要**交易权限**。

### 请求参数
请求参数 | 类型 | 含义
--------- | ------- | -------
clientOid | String | Client Order Id，客户端创建的唯一标识，建议使用UUID
currency | String | [币种](#ebcc9fbb02)
amount | String | 转账金额，为[币种精度](#ebcc9fbb02)正整数倍
direction | String | OUT — 母账号转子账号<br/>IN — 子账号转母账号
accountType | String | [可选] 母账号账户类型**MAIN**、**TRADE**、**MARGIN**或**CONTRACT**，
subAccountType | String |[可选] 子账号账户类型**MAIN**、**TRADE**、**MARGIN**或**CONTRACT**，默认为**MAIN**。
subUserId | String | [子账号的用户Id](#a0bc1cb873)

### 返回值
字段 | 含义
--------- | -------
orderId | 子母账号转账的订单ID

## 内部资金划转

```json
{
    "orderId":"5bd6e9286d99522a52e458de"
}
```
此接口用于平台内部账户资金划转，用户可以将资金在储蓄账户、交易账户、杠杆账户和矿池账户之间免费划转。同时支持从其他账户划转资金至合约账户，但不支持从合约账户转出资金至其他账户。
### HTTP请求

**POST /api/v2/accounts/inner-transfer**

### 请求示例
POST /api/v2/accounts/inner-transfer

### API权限
此接口需要**交易权限**。

### 请求参数
请求参数 | 类型 | 含义
--------- | ------- |  -------
clientOid | String | Client Order Id，客户端创建的唯一标识，建议使用UUID
currency | String | [币种](#ebcc9fbb02)
from | String |  付款账户类型**main**、**trade**、**margin** 或 **pool**
to | String |  收款账户类型**main**、**trade**、**margin** 、**contract** 或 **pool**
amount | String | 转账金额，精度为[币种精度](#ebcc9fbb02)正整数倍


### 返回值
字段 | 含义
--------- | -------
orderId | 内部资金划转的订单ID

# 充值

## 申请充值地址

```json
{
    "address":"0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
    "memo":"5c247c8a03aa677cea2a251d",
    "chain":"OMNI"
}
```

此接口可用于申请充值地址

### HTTP请求
**POST /api/v1/deposit-addresses**

### 请求示例
POST /api/v1/deposit-addresses

### API权限
此接口需要**提现权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- |  -------
currency | String | [币种](#ebcc9fbb02)
chain | String | [可选] 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。对于BTC，现有的链有Native、Segwit、TRC20，参数分别为bech32、btc、trx。默认值为Native。这个参数用于区分多链的币种，单链币种不需要。 

### 返回值
字段 | 含义
--------- | -------
address | 充值地址
memo | 地址标签memo(tag)，如果返回为空，则该币种没有memo。对于没有memo的币种，在[提现](#6eaf6b9ae0)的时候不可以传递memo
chain | 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。对于BTC，现有的链有Native、Segwit、TRC20，参数分别为bech32、btc、trx。默认值为Native。

## 获取充值地址(V2)

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

此接口可以获取币种所有支持链的充值地址，如果返回数据为空，请先[申请充值地址](#9277fb3f66)。

### HTTP请求
**GET /api/v2/deposit-addresses**

### 请求示例
GET /api/v2/deposit-addresses?currency=BTC

### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | -------  | -------
currency | String |[币种](#ebcc9fbb02)

### 返回值
字段 | 含义
--------- | -------
address | 充值地址
memo | 地址标签memo(tag)，如果返回为空，则该币种没有memo。对于没有memo的币种，在[提现](#6eaf6b9ae0)的时候不可以传递memo
chain | 币种的链名
contractAddress | 合约地址


## 获取充值地址

```json
{
    "address":"0x78d3ad1c0aa1bf068e19c94a2d7b16c9c0fcd8b1",
    "memo":"5c247c8a03aa677cea2a251d",
    "chain":"ERC20"
}
```

此接口，可获取某一币种的充值地址，如果返回数据为空，请先[申请充值地址](#9277fb3f66)。

### HTTP请求
**GET /api/v1/deposit-addresses**


### 请求示例
GET /api/v1/deposit-addresses

### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | -------  | -------
currency | String |[币种](#ebcc9fbb02)
chain | String | [可选] 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。对于BTC，现有的链有Native、Segwit、TRC20，参数分别为bech32、btc、trx。默认值为Native。这个参数用于区分多链的币种，单链币种不需要。 

### 返回值
字段 | 含义
--------- | -------
address | 充值地址
memo | 地址标签memo(tag)，如果返回为空，则该币种没有memo。对于没有memo的币种，在[提现](#6eaf6b9ae0)的时候不可以传递memo
chain | 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。对于BTC，现有的链有Native、Segwit、TRC20，参数分别为bech32、btc、trx。默认值为Native。 

## 获取充值列表

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

此端点，可获取充值分页列表。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

### HTTP请求
**GET /api/v1/deposits**

### 请求示例
GET /api/v1/deposits

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
currency | String |[可选] [币种](#ebcc9fbb02)
startAt| long | [可选] 开始时间（毫秒）
endAt| long | [可选]  截止时间（毫秒）
status | String | [可选] 状态。可选值: PROCESSING, SUCCESS, FAILURE

### 返回值
字段 | 含义
--------- | -------
address | 充值地址
memo | 地址标签memo(tag)，如果返回为空，则该币种没有memo。对于没有memo的币种，在[提现](#6eaf6b9ae0)的时候不可以传递memo
amount | 充值金额
fee | 充值手续费
currency | 币种
isInner | 是否为平台内部充值
walletTxId | 钱包交易Id
status | 状态
remark | 备注
createdAt | 创建时间
updatedAt | 修改时间


## 获取V1历史充值列表

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

此接口，可获取KuCoin V1的充值记录。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

<aside class="notice">默认查询一个月的数据</aside>

###HTTP请求
**GET /api/v1/hist-deposits**

### 请求示例
GET /api/v1/hist-deposits


### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------  
currency | String | [可选] [币种](#ebcc9fbb02)
status | String | [可选] 状态。可选值: PROCESSING, SUCCESS, and FAILURE
startAt| long | [可选] 开始时间（毫秒）
endAt| long | [可选]  截止时间（毫秒）  


### 返回值
字段 | 含义
--------- | -------
amount | 充值金额
currency | 币种
isInner | 是否为平台内充值
walletTxId | 钱包交易Id
status | 状态
createAt | 创建时间


# 提现

## 获取提现列表

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

### HTTP请求
**GET /api/v1/withdrawals**

### 请求示例
GET /api/v1/withdrawals

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
currency | String | [可选] [币种](#ebcc9fbb02)
status | String | [可选]  状态。可选值: PROCESSING, WALLET_PROCESSING, SUCCESS, FAILURE
startAt| long | [可选] 开始时间（毫秒）
endAt| long | [可选]  截止时间（毫秒）

### 返回值
字段 |  含义
--------- | -------
id | 唯一标识
address | 提现地址
memo | 提现地址标识
currency | 币种
amount | 提现金额
fee | 提现手续费
walletTxId | 钱包交易Id
isInner | 是否为平台内部提现
status | 状态
remark | 备注
createdAt | 创建时间
updatedAt | 修改时间


## 获取V1历史提现列表

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

此接口，可获取KuCoin V1的提现记录。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

<aside class="notice">默认查询一个月的数据</aside>

###HTTP请求
**GET /api/v1/hist-withdrawals**

### 请求示例
GET /api/v1/hist-withdrawals

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------  
currency | String | [可选] [币种](#ebcc9fbb02)
status | String | [可选] 状态。可选值: PROCESSING, SUCCESS, FAILURE
startAt| long | [可选] 开始时间（毫秒）
endAt| long | [可选]  截止时间（毫秒）



### 返回值
字段 | 含义
--------- | -------
amount | 提现金额
currency | 币种
isInner | 是否为平台内部提现
walletTxId | 钱包交易Id
createAt |  创建时间
status | 状态


##  获取提现额度

```json
{
    "currency":"KCS",
    "limitBTCAmount":"2.0",
    "usedBTCAmount":"0",
    "limitAmount":"75.67567568",
    "remainAmount":"75.67567568",
    "availableAmount":"9697.41991348",
    "withdrawMinFee":"0.93000000",
    "innerWithdrawMinFee":"0.00000000",
    "withdrawMinSize":"1.4",
    "isWithdrawEnabled":true,
    "precision":8,
    "chain":"OMNI"
}
```

### HTTP请求
**GET /api/v1/withdrawals/quotas**

### 请求示例
GET /api/v1/withdrawals/quotas?currency=BTC


### API权限
此接口需要**通用权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | ---------
currency | String | [币种](#ebcc9fbb02)
chain | String | [可选] 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。这个参数用于区分多链的币种，单链币种不需要。

### 返回值
字段 | 含义
--------- | -------
currency | 币种
availableAmount | 可提现的金额
remainAmount | 当日剩余可提现的额度
withdrawMinSize | 最小提现金额
limitBTCAmount | 当日剩余可提现的额度，折合为BTC
innerWithdrawMinFee | 内部提现手续费
usedBTCAmount | 当日BTC折合提现
isWithdrawEnabled | 是否可提现
withdrawMinFee | 最小提现金额
precision | 提现的精度
chain | 币种的链名。例如，对于USDT，现有的链有OMNI、ERC20、TRC20。默认值为ERC20。

## 申请提现

```json
{
    "withdrawalId":"5bffb63303aa675e8bbe18f9"
}
```

### HTTP请求
**POST /api/v1/withdrawals**

<aside class="notice">在WEB端可以开启指定常用地址提现，开启后会校验你的提现地址是否为常用地址。</aside>

### 请求示例
POST /api/v1/withdrawals

### API权限
此接口需要**提现权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | -------  | -------
currency  | String | 币种
address   | String | 提现地址
amount | number | 提现总额，必须为提现精度的正整数倍
memo | 地址标签memo(tag)，如果返回为空，则该币种没有memo。对于没有memo的币种，在[提现](#6eaf6b9ae0)的时候不可以传递memo
isInner | boolean | [可选] 是否为平台内部提现。默认为false
remark | String | [可选] 备注信息
chain | String | [可选] 针对一币多链的币种，可通过chain获取币种详情。比如， USDT存在的链有 OMNI, ERC20, TRC20。

### 返回值
字段 | 含义
--------- | -------
withdrawalId | 提现Id 唯一标识

KuCoin支持外扣手续费和内扣手续费。当您的储蓄账户的余额足以支持支付提现手续费时，首先从您的储蓄账户中扣除手续费，反之，从您的提现金额中扣除手续费。

比如，您从KuCoin提现 1 个BTC(提现手续费为：0.0001BTC)，如果您储蓄账户里的余额不支持支付手续费，系统将会自动从您的提现金额中扣除手续费，您实际到账金额为0.9999个BTC。


## 取消提现

提现状态为提现中才可以取消。


### HTTP请求
**DELETE /api/v1/withdrawals/{withdrawalId}**

### 请求示例
DELETE /api/v1/withdrawals/5bffb63303aa675e8bbe18f9

### API权限
此接口需要**提现权限**。

### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
withdrawalId | String | 路径参数，[提现Id](#c46f4b3b8e) 唯一标识


# 手续费

## 用户基础手续费

此接口返回用户的基础费率。

```json
{
    "code": "200000",
    "data": {
        "takerFeeRate": "0.001",
        "makerFeeRate": "0.001"
    }
}
```

### HTTP请求
**GET /api/v1/base-fee**

### 请求示例
GET /api/v1/base-fee

### API权限
此接口需要**通用权限**。

### 返回值
字段 |  含义
--------- | -------
takerFeeRate | 用户挂单基础手续费率
makerFeeRate | 用户吃单基础手续费率

## 交易对实际费率

此接口返回用户交易时实际费率，一次限制最多查10个交易对，子用户的费率和母用户保持一致。

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

### HTTP请求
**GET /api/v1/trade-fees**

### 请求示例
GET /api/v1/trade-fees?symbols=BTC-USDT,KCS-USDT

### API权限
此接口需要**通用权限**。


### 请求参数

请求参数 | 类型 | 含义
--------- | ------- | -------
symbols| String | 交易对，可多填，逗号分割，一次限制最多查10个交易对


### 返回值
字段 |  含义
--------- | -------
symbol | 交易对唯一标识码，重命名后不会改变
takerFeeRate | 交易对挂单实际手续费率
makerFeeRate | 交易对吃单实际手续费率


# 交易模块

以下请求需要校验[签名](#8ba46c43fe)。


# 订单

## 下单

```json
{
    "orderId":"5bd6e9286d99522a52e458de"
}
```

订单有两种类型：
限价单（**limit**）: 指定价格和数量进行交易。
市价单(**market**) : 指定资金或数量进行交易。

在下单前，请确保您的[交易账户/杠杆账户](#f0f7ae469d)有足够的资金。一旦下单成功，您下单的金额会被冻结。[冻结金额](#HOLDS)的多少取决于您下单的类型和具体的请求参数。
<aside class="notice">下单将启用价格保护机制。当限价单的价格在阈值范围之外时，会触发价格保护机制，导致下单失败。</aside>


请悉知，当您的订单进入买卖盘，系统会提前冻结[订单的手续费](#6a30a471cf)。

在下单之前，请充分了解每一个[交易对](#a17b4e2866)的参数含义。

**请求体中的JSON字符串中不要有多余的空格**

###下单限制

对于一个账号，每一个交易对最大撮合订单数量 **200** （包含止损单）。

### HTTP 请求

**POST /api/v1/orders**

### 请求示例

POST /api/v1/orders

### API权限
此接口需要**交易权限**。

### 请求参数

下单公有的请求参数

| 请求参数      | 类型     | 含义                                                                                    |
| --------- | ------ | ------------------------------------------------------------------------------------- |
| clientOid | String | Client Order Id，客户端创建的唯一标识，建议使用UUID                                                   |
| side      | String | **buy**（买） 或 **sell**（卖）                                                              |
| symbol    | String | [交易对](#a17b4e2866) 比如，ETH-BTC                                                         |
| type      | String | [可选] 订单类型 **limit** 和  **market** (默认为 **limit**)                                     |
| remark    | String | [可选] 下单备注，长度不超过100个字符（UTF-8）                                                          |
| stp       | String | [可选] [自成交保护](#80920cd667)（self trade prevention）分为**CN**, **CO**, **CB** , **DC**四种策略 |
| tradeType       | String | [可选] 交易类型，分为**TRADE**（现货交易）, **MARGIN_TRADE**（杠杆交易）（默认为**TRADE** ）。**另请注意：为了提升系统性能和下单速度，我们新增单独的杠杆订单接口，请还在此接口下杠杆订单的用户尽快迁移至新杠杆订单接口。此接口将于2020年5月1日（UTC+8）不再接受杠杆订单，届时我们将提前公告用户。** |
#### **limit** 限价单额外所需请求参数

| 请求参数        | 类型      | 含义                                                          |
| ----------- | ------- | ----------------------------------------------------------- |
| price       | String  | 指定币种的价格                                                     |
| size        | String  | 指定币种的数量                                                     |
| timeInForce | String  | [可选] 订单时效策略 **GTC**, **GTT**, **IOC**, **FOK** (默认为**GTC**) |
| cancelAfter | long    | [可选] **n** 秒之后取消，订单时效策略为 **GTT**                            |
| postOnly    | boolean | [可选] 被动委托的标识, 当订单时效策略为 **IOC** 或 **FOK** 时无效                |
| hidden      | boolean | [可选] 是否隐藏（买卖盘中不展示）                                          |
| iceberg     | boolean | [可选] 冰山单中是否仅显示订单的可见部分                                       |
| visibleSize | String  | [可选] 冰山单最大的展示数量                                             |

#### **market** 市价单额外所需请求参数

请求参数 | 类型 | 含义
--------- | ------- | ------- | ---------
size | String | 否（size和funds 二选一） | 下单数量
funds | String |  否（size和funds 二选一）| 下单资金

* 下市价单，需定买卖数量或资金。

###术语解释

###交易对(Symbol)

交易对必须是KuCoin支持的[交易对](#a17b4e2866)。

###Client Order Id(clientOid)

ClientOid字段是客户端创建的唯一ID（推荐使用UUID），只能包含数字、字母、下划线（_） 和 分隔线（-）。这个字段会在获取订单信息时返回。您可使用clientOid来标识您的订单。ClientOid不同于服务端创建的订单ID。请不要使用同一个clientOid发起请求。clientOid最长不得超过40个字符。

请妥善记录服务端创建的orderId，以用于查询订单状态的更新。

###订单类型(type)

您在下单时指定的订单类型，决定了您是否需要请求其他参数，同时还会影响到撮合引擎的执行。如果您在下单时未指定订单类型，系统将默认按照限价单执行。

下限价单时，您需指定限价单的价格（**price**）和数量（**size**）。系统将根据市场行情以指定或更优价格撮合该订单。如果订单未能被立即撮合，将继续留买卖盘中，直至被撮合或被用户取消。

与限价单不同，市价单价格会随着市场价格波动而变化。下市价单时，您无需指定价格，只需指定数量。市价单会立即成交，不会进入买卖盘。所有市价单都是taker，需支付taker费用。

###交易类型(tradeType)
目前平台支持现货（**TRADE**）与杠杆（**MARGIN_TRADE**）两种资产交易下单。系统根据您的参数类型，将对指定账户资金进行冻结。若未传递该参数，将默认按照现货冻结您交易账户资金。**另请注意：为了提升系统性能和下单速度，我们新增单独的杠杆订单接口，请还在此接口下杠杆订单的用户尽快迁移至新杠杆订单接口。此接口将于2020年5月1日（UTC+8）不再接受杠杆订单，届时我们将提前公告用户。**

###价格(Price)
下限价单时，price 必须以交易对的[价格增量 priceIncrement](#a17b4e2866)为基准，价格增量是交易对的价格的精度。比如，对BTC-USDT这个交易对, 它的 priceIncrement 为0.00001000。那么你下单的 price 不可以小于0.00001000，且为 priceIncrement 的正整数倍，否则下单时会报错，invalid priceIncrement。

###数量(Size)
下限价单时，size 是指交易对的交易对象(即写在靠前部分的资产名)的数量。size 必须以交易对中的[数量增量 baseIncrement](#a17b4e2866)为基准，数量增量是交易对的数量的精度。下单的 size 为 baseIncrement 的正整数倍并且必须在 baseMinSize 和 baseMaxSize 之间。

###资金(Funds)
下市价单时，funds 字段是指交易对的定价资产(即写在靠后部分资产名)的资金。funds 必须以交易对中的[资金增量quoteIncrement](#a17b4e2866)为基准，资金增量是交易对的资金的精度。下单的 funds 为 quoteIncrement 的正整数倍且必须在 quoteMinSize 和 quoteMaxSize 之间。

###订单时效策略(TimeInForce)
订单时效是一种交易时使用的特殊策略，用于设定订单在被撮合或取消前的生效时间。订单时效策略分为四种：

| 缩写  | 全称                  | 含义                         |
| --- | ------------------- | -------------------------- |
| GTC | Good Till Canceled  | 主动取消才过期                    |
| GTT | Good Till Time      | 指定时间后过期                    |
| IOC | Immediate Or Cancel | 立即成交可成交的部分，然后取消剩余部分，不进入买卖盘 |
| FOK | Fill Or Kill        | 如果下单不能全部成交，则取消             |

* 注意，成交也包含自成交。

###被动委托(PostOnly)

postOnlys只是一个标识，如果下单有能立即成交的对手方，则取消。
* 当用户所下订单是postonly订单时，如果订单进入撮合引擎后遇到冰山单和隐藏单可以立即成交，postonly 订单收maker 手续费，冰山单和隐藏单收taker手续费。

###隐藏单和冰山单(Hidden & Iceberg)

您可在高级设置中设置隐藏单和冰山单（冰山单是一种特殊形式的隐藏单）。进行限价单和限价止损单交易时，您可选择按照隐藏单或冰山单执行。

隐藏单不会展示在买卖盘上。

与隐藏单不同，冰山单分为可见和隐藏两部分。进行冰山单交易时，需设置可见订单数量。冰山单最小可见数量是总订单量的1/20。

进行撮合时，冰山单的可见部分会首先被撮合，当可见部分被全部撮合后，另一部分隐藏订单将浮出，直至订单全部成交。

**注意**：

- 系统将对隐藏和冰山单收取taker费用。
- 如果您同时设定了冰山单和隐藏单，您的订单将默认作为冰山单处理。

###冻结策略(Hold)
对于限价买单，我们会从您的资金里面冻结您买单的金额(price * size)。同样，对于限价卖单，我们也会冻结您卖单的资产。在成交那一刻评估实际的手续费。如果您取消了一个部分成交或未成交的订单，那么剩余金额会解冻会退到您的账户。
对于市价买/卖单，需要指定**funds(资金)**，我们会根据funds来冻结您账户里的资金。如果只指定了**size**，在成交或取消之前，您的账户所有资金会被冻结（通常冻结时间非常短）。

###自成交保护(SelfTradePrevention)

您可在高级设置中设置自成交保护策略。您的订单将不会发生自成交。如果您在下单时没有指定STP，否则您的订单可能会被自己的订单成交。市价单现不支持DC策略。

**市价单现不支持 DC**，当*timeInForce* 为**FOK**， 那么stp会指定为**CN**。

| 缩写  | 全称                  | 含义                           |
| --- | ------------------- | ---------------------------- |
| DC  | Decrease and Cancel | 取消数量少的一方的订单，并将数量多的一方数量改为新旧差值 |
| CO  | Cancel old          | 取消旧的订单                       |
| CN  | Cancel new          | 取消新的订单                       |
| CB  | Cancel both         | 双方都取消                        |

### 订单生命周期(ORDER LIFECYCLE)

当下单请求因请求成功（撮合引擎已收到订单）或（因余额不足、参数不合法等原因）被拒绝时，HTTP 请求会进行响应。下单成功，返回订单ID，订单将被撮合，可能会部分或全部成交。部分成交后，订单剩余为未成交部分会变成等待撮合（**Active**）状态（不包括使用立即成交或取消[IOC]的订单）。已完全成交的订单会变成“已完成”（**Done**）状态。

订阅市场数据频道的用户可使用订单ID（**orderId**）和用户订单ID（**clientOid**）来识别消息。

### 价格保护机制

下单将启用价格保护机制。具体规则如下

- 若用户在币币交易所下的市价单/限价单可以与当前买卖盘内订单直接成交，那么系统会判断成交深度对应的价格与同方向盘口价的偏差是否超出阈值（阈值可根据API symbol接口获取）；

- 若超过，当您是限价单时，该订单会提示下单失败；

- 若是市价单则此订单将被系统部分执行，执行上限为阈值对应的价格内的订单数量，其他剩余订单将不被成交。

举例说明：若阈值为10%，当某用户在KCS/USDT交易区下了10,000 USDT的市价买单时(此时卖一价为1.20000)，系统会判断订单成交后最新成交价为1.40000。(1.40000-1.20000)/1.20000=16.7%>10%，而阈值价格为1.32000，此时，用户的这笔市价买单将最多被成交至1.32000，其他剩余订单则不会和买卖盘内订单进行撮合。
请注意：该功能对深度的探测可能存在偏差，若您的订单未被完全成交有可能是因为超出了阈值的部分未成交。


### 返回值

| 字段                                | 含义   |
| --------------------------------- | ---- |
| orderId                           | 订单Id |
| 下单成功后，会返回一个orderId字段，意味这订单进入撮合引擎。 |      |

## 杠杆下单

```json
{
    "orderId":"5bd6e9286d99522a52e458de",
    "borrowSize":10.2,
    "loanApplyId":"600656d9a33ac90009de4f6f"
}
```

订单有两种类型：
限价单（**limit**）: 指定价格和数量进行交易。
市价单(**market**) : 指定资金或数量进行交易。

在下单前，请确保您的[杠杆账户](#f0f7ae469d)有足够的资金。一旦下单成功，您下单的金额会被冻结。[冻结金额](#HOLDS)的多少取决于您下单的类型和具体的请求参数。
<aside class="notice">下单将启用价格保护机制。当限价单的价格在阈值范围之外时，会触发价格保护机制，导致下单失败。</aside>


请悉知，当您的订单进入买卖盘，系统会提前冻结[订单的手续费](#6a30a471cf)。

在下单之前，请充分了解每一个[交易对](#a17b4e2866)的参数含义。

**请求体中的JSON字符串中不要有多余的空格**

###下单限制

对于一个账号，每一个交易对最大撮合订单数量 **200** （包含止损单）。

### HTTP 请求

**POST /api/v1/margin/order**

### 请求示例

POST /api/v1/margin/order

### API权限
此接口需要**交易权限**。

### 请求参数

下单公有的请求参数

| 请求参数      | 类型     | 含义                                                                                    |
| --------- | ------ | ------------------------------------------------------------------------------------- |
| clientOid | String | Client Order Id，客户端创建的唯一标识，建议使用UUID                                                   |
| side      | String | **buy**（买） 或 **sell**（卖）                                                              |
| symbol    | String | [交易对](#a17b4e2866) 比如，ETH-BTC                                                         |
| type      | String | [可选] 订单类型 **limit** 和  **market** (默认为 **limit**)                                     |
| remark    | String | [可选] 下单备注，长度不超过100个字符（UTF-8）                                                          |
| stp       | String | [可选] [自成交保护](#80920cd667)（self trade prevention）分为**CN**, **CO**, **CB** , **DC**四种策略 |
| marginMode | String | [可选] 杠杆交易模式，分为cross（全仓模式）, isolated（逐仓模式）, **默认为cross**。逐仓模式即将上线，敬请期待。   |
| autoBorrow | boolean | [可选] [可选] 自动借币下单，即系统自动以市场最优利率借币再下单。                                         |
#### **limit** 限价单额外所需请求参数

| 请求参数        | 类型      | 含义                                                          |
| ----------- | ------- | ----------------------------------------------------------- |
| price       | String  | 指定币种的价格                                                     |
| size        | String  | 指定币种的数量                                                     |
| timeInForce | String  | [可选] 订单时效策略 **GTC**, **GTT**, **IOC**, **FOK** (默认为**GTC**) |
| cancelAfter | long    | [可选] **n** 秒之后取消，订单时效策略为 **GTT**                            |
| postOnly    | boolean | [可选] 被动委托的标识, 当订单时效策略为 **IOC** 或 **FOK** 时无效                |
| hidden      | boolean | [可选] 是否隐藏（买卖盘中不展示）                                          |
| iceberg     | boolean | [可选] 冰山单中是否仅显示订单的可见部分                                       |
| visibleSize | String  | [可选] 冰山单最大的展示数量                                             |

#### **market** 市价单额外所需请求参数

请求参数 | 类型 | 含义
--------- | ------- | ------- | ---------
size | String | 否（size和funds 二选一） | 下单数量
funds | String |  否（size和funds 二选一）| 下单资金

* 下市价单，需定买卖数量或资金。

###术语解释

###交易模式(marginModel)
交易模式有：全仓（cross）与逐仓（isolated），目前平台只支持全仓（cross）模式，默认为全仓模式。逐仓模式即将上线，敬请期待

### 自动借币下单(autoBorrow)
自动借币下单标识，如此字段为true，则会根据下单量，自动借入下单所需的金额。默认为false。如果下单量过大，超过了最大杠杆倍数或者风险限额阈值，则借币失败，下单也会失败。


### 返回值

| 字段                                | 含义   |
| --------------------------------- | ---- |
| orderId                           | 订单Id |
| borrowSize                        | 借币数量，只有在自动借币下单后才返回 |
| loanApplyId                       | 借币申请ID，只有在自动借币下单后才返回 |
| 下单成功后，会返回一个orderId字段，意味这订单进入撮合引擎。 |      |


## 批量下单

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

该接口支持在一个接口中批量下单，每次可同时下5个订单，订单类型必须为相同交易对的限价单（目前该接口只支持现货交易，不支持杠杆交易）


### HTTP 请求

**POST /api/v1/orders/multi**


### 请求示例

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

### API权限

此接口需要**交易权限**。


### 请求参数

| 请求参数     | 类型     | 含义                                                                                    |
| ---------   | ------  | -------------------------------------------------------------------------------------- |
| clientOid   | String  | Client Order Id，客户端创建的唯一标识，建议使用UUID                                          |
| side        | String  | **buy**（买） 或 **sell**（卖）                                                           |
| symbol      | String  | [交易对](#a17b4e2866) 比如，ETH-BTC                                                       |
| type        | String  | [可选] 订单类型 **limit** 和  **market** (默认为 **limit**)                                |
| remark      | String  | [可选] 下单备注，长度不超过100个字符（UTF-8）                                                 |
| stop        | String  | [可选] 止盈止损单，触发条件， **loss**（小于等于） 或 **entry**（大于等于）。设置后，就必须设置stopPrice参数。               |
| stopPrice   | String  | [可选] 触发价格，只要设置stop参数，就必须设置此属性。                                                        |
| stp         | String  | [可选] [自成交保护](#80920cd667)（self trade prevention）分为**CN**, **CO**, **CB** , **DC**四种策略 |
| tradeType   | String  | [可选] 交易类型，默认为**TRADE**                                                             |
| price       | String  | 指定货币的价格                                                     |
| size        | String  | 指定货币的数量                                                     |
| timeInForce | String  | [可选] 订单时效策略 **GTC**, **GTT**, **IOC**, **FOK** (默认为**GTC**) |
| cancelAfter | long    | [可选] **n** 秒之后取消，订单时效策略为 **GTT**                            |
| postOnly    | boolean | [可选] 被动委托的标识, 当订单时效策略为 **IOC** 或 **FOK** 时无效                |
| hidden      | boolean | [可选] 是否隐藏（买卖盘中不展示）                                          |
| iceberg     | boolean | [可选] 冰山单中是否仅显示订单的可见部分                                       |
| visibleSize | String  | [可选] 冰山单最大的展示数量                                             |

### 返回值
| 字段    | 含义                        |
| -------| --------------------------- |
|status  |  订单创建结果 (success, fail) |
|failMsg |  失败原因                    |


## 单个撤单

```json
{
    "cancelledOrderIds":[
        "5bd6e9286d99522a52e458de"
    ]
}
```

此端点可以取消单笔订单。

<aside class="notice">此接口只提交取消请求。实际取消结果需要通过查询订单状态或订阅websocket获取订单消息。建议您在收到Open消息后再进行撤单，否则会导致订单取消不成功。
</aside>

### HTTP请求

**DELETE /api/v1/orders/{orderId}**

### 请求示例

DELETE /api/v1/orders/5bd6e9286d99522a52e458de

### API权限

此接口需要**交易权限**。

### 请求参数

| 请求参数    | 类型     | 含义                            |
| ------- | ------ | ----------------------------- |
| orderId | String | 路径参数，[订单Id](#23e02e24af) 唯一标识 |

### 返回值

| 字段                | 含义      |
| ----------------- | ------- |
| cancelledOrderIds | 取消的订单id |


<aside class="notice">The <b>orderId</b> 是服务器生成的订单唯一标识，不是客户端生成的clientOId</aside>
### 撤单被拒

如果订单不能撤销（已经成交或已经取消），会返回错误信息，可根据返回的msg获取原因。


## 基于clientOid 单个撤单

```json
{
  "cancelledOrderId": "5f311183c9b6d539dc614db3",
  "clientOid": "6d539dc614db3"
}
```

此接口发送一个通过clientOid撤销订单的请求。

### HTTP请求

**DELETE /api/v1/order/client-order/{clientOid}**

### 请求示例

DELETE /api/v1/order/client-order/6d539dc614db3

### API权限

此接口需要**交易权限**。

### 请求参数

| 请求参数    | 类型     | 含义                            |
| ------- | ------ | ----------------------------- |
| clientOid | String | 路径参数，客户端生成的标识 |

### 返回值

| 字段                | 含义      |
| ----------------- | ------- |
| cancelledOrderId | 取消的订单id |
| clientOid | 客户端生成的标识 |


## 全部撤单

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

此接口，可以取消所有状态为**open**的订单，返回值是是已取消订单的ID列表。

### HTTP请求

**DELETE /api/v1/orders**

### 请求示例

**DELETE /api/v1/orders?symbol=ETH-BTC&tradeType=TRADE**

### API权限
此接口需要**交易权限**。

### 请求参数


| 请求参数   | 类型     | 含义                                 |
| ------ | ------ | ---------------------------------- |
| symbol | String | [可选] 取消指定[交易对](#a17b4e2866)的open订单 |
| tradeType| String | [可选] 取消指定交易类型的open 订单（默认为取消TRADE现货交易订单）                                     |
### 返回值

| 字段                | 含义      |
| ----------------- | ------- |
| cancelledOrderIds | 取消的订单id |

## 获取订单列表

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

此接口，可获取订单列表
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

### HTTP请求

**GET /api/v1/orders**

### 请求示例

GET /api/v1/orders

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数


| 请求参数    | 类型     | 含义                                                                                            |
| ------- | ------ | --------------------------------------------------------------------------------------------- |
| status  | String | [可选] **active（活跃）** 或 **done（完成）** 默认为done。只返回指定状态的订单信息                                       |
| symbol  | String | [可选] 只返回指定[交易对](#a17b4e2866)的订单信息                                                             |
| side    | String | [可选] **buy（买）** 或 **sell（卖）**                                                                 |
| type    | String | [可选] 订单类型: **limit（限价单）**, **market(市价单)**, **limit_stop(限价止盈止损单)**, **market_stop（市价止盈止损单）** |
| tradeType    | String | [可选] 交易类型: **TRADE（现货交易）**, **MARGIN_TRADE(杠杆交易)**|
| startAt | long   | [可选] 开始时间（毫秒）                                                                                 |
| endAt   | long   | [可选]  截止时间（毫秒）                                                                                |

### 返回值

| 字段            | 含义                                          |
| ------------- | ------------------------------------------- |
| id            | 订单id，订单唯一标识                                 |
| symbol        | 交易对                                         |
| opType        | 操作类型: DEAL                                  |
| type          | 订单类型                                        |
| side          | 买或卖                                         |
| price         | 订单价格                                        |
| size          | 下单数量                                        |
| funds         | 下单金额                                        |
| dealFunds     | 成交额                                         |
| dealSize      | 成交数量                                        |
| fee           | 手续费                                         |
| feeCurrency   | 计手续费币种                                      |
| stp           | 自成交保护                                       |
| stop          | 止盈止损类型， entry:止盈; loss:止损                   |
| stopTriggered | 是否触发止盈止损                                    |
| stopPrice     | 止盈止损触发价格                                    |
| timeInForce   | 订单时效策略                                      |
| postOnly      | 是否为被动委托                                     |
| hidden        | 是否为隐藏单                                      |
| iceberg       | 是否为冰山单                                      |
| visibleSize   | 冰山单在买卖盘可见数量                                 |
| cancelAfter   | timeInForce 为 GTT n秒后过期                     |
| channel       | 下单来源                                        |
| clientOid     | 客户端生成的标识                                    |
| remark        | 订单说明                                        |
| tags          | 订单标签                                        |
| isActive      | 订单状态 true: 订单状态为 open;<br/> false: 订单已成交或取消 |
| cancelExist   | 订单是否存在取消记录                                  |
| createdAt     | 创建时间                                        |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)                                        |

### 订单状态和结算

在买卖盘上，所有委托都处于活跃（**Active**）状态，从买卖盘上移除的订单则被标记为已完成（**Done**）状态。

订单被成交后到入账，因系统清算可能会有毫秒级别的延迟。

您可发送请求，查询任一状态的订单。如果您未指定状态参数，系统将默认返回“已完结”（Done）状态的订单。

查询“**active**”状态的订单，没有时间限制。但查询“已完成”状态的订单时，您只能获取 7 * 24 小时时间范围内的数据（即：查询时，开始时间到结束时间的时间范围不能超过24 * 7小时）。若超出时间范围，系统会报错。如果您只指定了结束时间，没有指定开始时间，系统将按照 24小时的范围自动计算开始时间（开始时间=结束时间-7*24小时）并返回相应数据，反之亦然。

取消订单的历史记录仅保留**一个月**。您将无法查询一个月以前已取消的订单。

<aside class="notice">检索的总条目不能超过5万条，如果超过，请缩短查询时间范围。</aside>
###订单轮询(Polling)

对于高频交易的用户，建议您在本地缓存和维护一份自己的活动委托列表，并使用市场数据流实时更新自己的订单信息。

## 获取V1历史订单列表

```json
{
    "currentPage": 1,
    "pageSize": 1,
    "totalNum": 1,
    "totalPage": 1,
    "items": [
        {
            "symbol": "SNOV-ETH",
            "dealPrice": "0.0000246",
            "dealValue": "0.018942",
            "amount": "770",
            "fee": "0.00001137",
            "side": "sell",
            "createdAt": 1540080199
        }
    ]
 }
```

此接口，可获取KuCoin V1历史订单列表
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

<aside class="notice">默认查询一个月的订单数据</aside>
###HTTP请求
**GET /api/v1/hist-orders**

### 请求示例

GET /api/v1/hist-orders

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数


| 请求参数    | 类型     | 含义                                |
| ------- | ------ | --------------------------------- |
| symbol  | String | [可选] 只返回指定[交易对](#a17b4e2866)的订单信息 |
| side    | String | [可选] **buy（买）** 或 **sell（卖）**     |
| startAt | long   | [可选] 开始时间（毫秒）                     |
| endAt   | long   | [可选]  截止时间（毫秒）                    |

### 返回值

| 字段        | 含义   |
| --------- | ---- |
| symbol    | 交易对  |
| dealPrice | 成交价格 |
| dealValue | 成交额  |
| amount    | 成交量  |
| fee       | 手续费费 |
| side      | 买或卖  |
| createdAt | 创建时间 |

## 最近订单记录

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

此接口，可获取最近24小时的1000条订单数据。
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

### HTTP请求

**GET /api/v1/limit/orders**

### 请求示例

GET /api/v1/limit/orders

### API权限
此接口需要**通用权限**。

### 返回值

| 字段            | 含义                                          |
| ------------- | ------------------------------------------- |
| id            | 订单id，订单唯一标识                                 |
| symbol        | 交易对                                         |
| opType        | 操作类型: DEAL                                 |
| type          | 订单类型                                        |
| side          | 买或卖                                         |
| price         | 订单价格                                        |
| size          | 订单数量                                        |
| funds         | 下单金额                                        |
| dealFunds     | 成交额                                         |
| dealSize      | 成交数量                                        |
| fee           | 手续费                                         |
| feeCurrency   | 计手续费币种                                      |
| stp           | 自成交保护                                       |
| stop          | 止盈止损类型， entry:止盈; loss:止损                   |
| stopTriggered | 是否触发止盈止损                                    |
| stopPrice     | 止盈止损触发价格                                    |
| timeInForce   | 订单时效策略                                      |
| postOnly      | 是否为被动委托                                     |
| hidden        | 是否为隐藏单                                      |
| iceberg       | 是否为冰山单                                      |
| visibleSize   | 冰山单在买卖盘可见数量                                 |
| cancelAfter   | timeInForce 为 GTT n秒后过期                     |
| channel       | 下单来源                                        |
| clientOid     | 客户端生成的标识                                    |
| remark        | 订单说明                                        |
| tags          | 订单标签                                        |
| isActive      | 订单状态 true: 订单状态为 open;<br/> false: 订单已成交或取消 |
| cancelExist   | 订单是否存在取消记录                                  |
| createdAt     | 创建时间                                        |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)           |
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>
## 单个订单详情

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

此接口，可以通过订单id获取单个订单信息。

### HTTP请求

**GET /api/v1/orders/{orderId}**

### 请求示例

GET /api/v1/orders/5c35c02703aa673ceec2a168

### API权限
此接口需要**通用权限**。

### 请求参数


| 请求参数    | 类型     | 含义                            |
| ------- | ------ | ----------------------------- |
| orderId | String | 路径参数，[订单Id](#23e02e24af) 唯一标识 |

### 返回值

| 字段            | 含义                                          |
| ------------- | ------------------------------------------- |
| id            | 订单id，订单唯一标识                                 |
| symbol        | 交易对                                         |
| opType        | 操作类型: DEAL                                  |
| type          | 订单类型                                        |
| side          | 买或卖                                         |
| price         | 订单价格                                        |
| size          | 订单数量                                        |
| funds         | 下单金额                                        |
| dealFunds     | 成交额                                         |
| dealSize      | 成交数量                                        |
| fee           | 手续费                                         |
| feeCurrency   | 计手续费币种                                      |
| stp           | 自成交保护                                       |
| stop          | 止盈止损类型， entry:止盈; loss:止损                   |
| stopTriggered | 是否触发止盈止损                                    |
| stopPrice     | 止盈止损触发价格                                    |
| timeInForce   | 订单时效策略                                      |
| postOnly      | 是否为被动委托                                     |
| hidden        | 是否为隐藏单                                      |
| iceberg       | 是否为冰山单                                      |
| visibleSize   | 冰山单在买卖盘可见数量                                 |
| cancelAfter   | timeInForce 为 GTT n秒后触发                     |
| channel       | 下单来源                                        |
| clientOid     | 客户端生成的标识                                    |
| remark        | 订单说明                                        |
| tags          | 订单标签                                        |
| isActive      | 订单状态 true: 订单状态为 open;<br/> false: 订单已成交或取消 |
| cancelExist   | 订单是否存在取消记录                                  |
| createdAt     | 创建时间                                        |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)                                        |

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 基于clientOid 获取单个订单详情

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

此接口，可以通过clientOid查询单个订单的信息，若订单不存在则提示订单不存在。

### HTTP请求

**GET /api/v1/order/client-order/{clientOid}**

### 请求示例

GET /api/v1/order/client-order/6d539dc614db312

### API权限

此接口需要**通用权限**。

### 请求参数

| 请求参数    | 类型     | 含义                            |
| ------- | ------ | ----------------------------- |
| clientOid | String | 路径参数，客户端生成的标识 |

### 返回值

| 字段            | 含义                                          |
| ------------- | ------------------------------------------- |
| id            | 订单id，订单唯一标识                                 |
| symbol        | 交易对                                         |
| opType        | 操作类型: DEAL                                  |
| type          | 订单类型                                        |
| side          | 买或卖                                         |
| price         | 订单价格                                        |
| size          | 订单数量                                        |
| funds         | 下单金额                                        |
| dealFunds     | 成交额                                         |
| dealSize      | 成交数量                                        |
| fee           | 手续费                                         |
| feeCurrency   | 计手续费币种                                      |
| stp           | 自成交保护                                       |
| stop          | 止盈止损类型， entry:止盈; loss:止损                   |
| stopTriggered | 是否触发止盈止损                                    |
| stopPrice     | 止盈止损触发价格                                    |
| timeInForce   | 订单时效策略                                      |
| postOnly      | 是否为被动委托                                     |
| hidden        | 是否为隐藏单                                      |
| iceberg       | 是否为冰山单                                      |
| visibleSize   | 冰山单在买卖盘可见数量                                 |
| cancelAfter   | timeInForce 为 GTT n秒后触发                     |
| channel       | 下单来源                                        |
| clientOid     | 客户端生成的标识                                    |
| remark        | 订单说明                                        |
| tags          | 订单标签                                        |
| isActive      | 订单状态 true: 订单状态为 open					 |
| cancelExist   | 订单是否存在取消记录                                  |
| createdAt     | 创建时间                                        |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)                                        |



# 成交明细

## 成交记录

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
            "tradeType": "TRADE",
            "type":"limit",
            "createdAt":1547026472000,
            "tradeType": "TRADE"
        }
    ]
}
```

此接口，可获取最近的成交明细列表
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

### HTTP请求

**GET /api/v1/fills**

### 请求示例

GET /api/v1/fills

### API权限
此接口需要**通用权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数


| 请求参数    | 类型     | 含义                                                                                            |
| ------- | ------ | --------------------------------------------------------------------------------------------- |
| orderId | String | [可选] 查询该[订单Id](#23e02e24af) 的成交明细（如果指定了orderId，请忽略其他查询条件）                                     |
| symbol  | String | [可选] 查询指定[交易对](#a17b4e2866)的成交明细                                                              |
| side    | String | [可选] **buy（买）** 或 **sell（卖）**                                                                 |
| type    | String | [可选] 订单类型: **limit（限价单）**, **market(市价单)**, **limit_stop(限价止盈止损单)**, **market_stop（市价止盈止损单）** |
| startAt | long   | [可选] 开始时间（毫秒）                                                                                 |
| endAt   | long   | [可选]  截止时间（毫秒）                                                                                |
| tradeType  | String   | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)                                                                                 |
### 返回值

| 字段             | 含义                       |
| -------------- | ------------------------ |
| symbol         | 交易对                      |
| tradeId        | 交易Id                     |
| orderId        | 订单Id                     |
| counterOrderId | 对手方订单Id                  |
| side           | 买或卖                      |
| forceTaker     | 是否强制作为taker处理            |
| liquidity      | 流动性类型: taker 或 maker     |
| price          | 订单价格                     |
| size           | 订单数量                     |
| funds          | 成交额                      |
| fee            | 手续费                      |
| feeRate        | 手续费率                     |
| feeCurrency    | 计手续费币种                   |
| stop           | 止盈止损类型，entry:止盈; loss:止损 |
| type           | 订单类型limit 或 market       |
| createdAt      | 创建时间                     |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)           |

**查询时间范围**
您可检索一周时间范围内的数据您范围内检索数据（默认从最近一天开始算起）。 若检索时间范围超过一周，系统将提示您超过时间限制。如果查询只提供开始时间没有提供结束时间，系统将自动计算结束时间（结束时间=开始时间+ 7*24小时），反之亦然。

<aside class="notice">检索的总条目不能超过5万条，如果超过，请缩短查询时间范围。</aside>
**结算**
结算分为两部分，一部分是成交结算，一部分是费用结算。当撮合完成后，这些数据将立即更新到我们的数据存储区，系统将启动结算并从您的预冻结资金中进行扣除。

**手续费**

KuCoin平台上的订单分为两种类型：Taker 和 Maker。Taker单会与买卖盘上的已有订单立即成交，而Maker单则相反，会一直留在买卖盘中等待撮合。Taker单消耗了市场的流动性，因此会被收取taker费用，而Maker单增加了市场的流动性，会被收取较低的手续费甚至获得手续费补贴。请注意：市价单、冰山单和隐藏单都会被扣除taker手续费。

下单时，系统会预冻结您账户中的taker费用。流动性（liquidity）字段中的参数说明了订单将会被收取taker还是maker费用。

假设您的订单是限价单，当您下单后在撮合引擎中被立即撮合，我们将收取您taker费用，而如果您的订单没有被立即撮合或有部分剩余未被撮合都会进入买卖盘，进入买卖盘的订单在未被取消前成交都会收取您maker手续费。

进入撮合后与对手盘订单撮合，当指令订单剩余金额为0，交易完成，如果剩余资金不足以购买最低数量（0.00000001）的商品，则取消指令订单。

如果您的订单作为maker被成交，我们会将剩余预冻结的taker费用返还给您。

但需要注意的是:

- 当您创建了一个隐藏委托/冰山委托订单时，即使它未被撮合引擎立即成交而被被动成交，仍然会收取taker费用
- 被动委托收取maker费用。如果该委托下单后会立刻与市场已有委托(除冰山/隐藏订单外)撮合，那么该委托将被取消。如果被动委托下单后与冰山/隐藏订单立即成交，被动委托订单将收取**maker**费用  

举例：

以BTC/USDT为例，假设您想市价买入1BTC，手续费率为0.1%，市场买卖盘数据如下：

| Price（USDT） | Size（BTC）  | Side |
| ----------- | ---------- | ---- |
| 4200.00     | 0.18412309 | sell |
| 4015.60     | 0.56849308 | sell |
| 4011.32     | 0.24738383 | sell |
| 3995.64     | 0.84738383 | buy  |
| 3988.60     | 0.20484000 | buy  |
| 3983.85     | 1.37584908 | buy  |

 当您下一个买入市价单时，市场会立即成交，成交明细将分为3笔，如下图所示：

| Price（USDT） | Size（BTC）  | Fee（BTC）   |
| ----------- | ---------- | ---------- |
| 4011.32     | 0.24738383 | 0.00024738 |
| 4015.60     | 0.56849308 | 0.00056849 |
| 4200.00     | 0.18312409 | 0.00018312 |

## 最近成交记录

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

此接口，可以获取最近24小时1000条成交明细的列表
返回值是[分页](#88b6b4f79a)后的数据，根据时间降序排序。

### HTTP请求

**GET /api/v1/limit/fills**

### 请求示例

GET /api/v1/limit/fills

### API权限
此接口需要**通用权限**。

### 返回值

| 字段             | 含义                        |
| -------------- | ------------------------- |
| symbol         | 交易对                       |
| tradeId        | 交易Id                      |
| orderId        | 订单Id                      |
| counterOrderId | 对手方订单Id                   |
| side           | 买或卖                       |
| forceTaker     | 是否强制作为taker处理             |
| liquidity      | 流动性类型: taker 或 maker      |
| price          | 订单价格                      |
| size           | 订单数量                      |
| funds          | 成交额                       |
| fee            | 手续费                       |
| stop           | 止盈止损类型， entry:止盈; loss:止损 |
| tradeType     | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易)                                        |
| type           | 订单类型，limit 或 market       |
| createdAt      | 创建时间                      |

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

# 止盈止损

止盈止损单，是指当最新成交价格达到了设置的止损触发价格（stopPrice）后，会生成一个订单（限价/市价），订单的撮合顺序为价格优先，然后时间优先。

**stop: 'loss'(止损):** 当最新成交价格小于等于**stopPrice**时触发。

**stop: 'entry'(止盈):** 当最新成交价格大于等于**stopPrice**时触发。

最新交易价格可以在最新[撮合执行数据](#c7f054198c)里面获取。注意，由于Websocket消息有丢失的可能，无法接收所有撮合执行数据。

当您下一个止盈止损单时，系统不会冻结您账户中的资产。

## 下单

**请求体中的JSON字符串中不要有多余的空格**

### 下单限制

对于一个账号，每一个交易对最大止盈止损委托数量 **20** 。

### HTTP 请求

**POST /api/v1/stop-order**

### 请求示例

POST /api/v1/stop-order

### API权限

此接口需要**交易权限**。

### 请求参数

下单公有的请求参数

| 请求参数  | 类型   | 含义                                                         |
| --------- | ------ | ------------------------------------------------------------ |
| clientOid | String | Client Order Id，客户端创建的唯一标识，建议使用UUID          |
| side      | String | **buy**（买） 或 **sell**（卖）                              |
| symbol    | String | [交易对](#a17b4e2866) 比如，ETH-BTC                          |
| type      | String | [可选] 订单类型 **limit** 和 **market**，默认为**limit**     |
| remark    | String | [可选] 下单备注，长度不超过100个字符（UTF-8）                |
| stop      | String | [可选] 止盈止损单，触发条件， **loss**（小于等于） 或 **entry**（大于等于）。默认为**loss** |
| stopPrice | String | 触发价格。                                                   |
| stp       | String | [可选] [自成交保护](#80920cd667)（self trade prevention）分为**CN**, **CO**, **CB** , **DC**四种策略，**type为limit（限价单）时，不支持DC策略** |
| tradeType | String | [可选] 交易类型，分为**TRADE**（现货交易）, **MARGIN_TRADE**（杠杆交易）（默认为**TRADE** ） |

#### **limit** 限价单额外所需请求参数

| 请求参数    | 类型    | 含义                                                         |
| ----------- | ------- | ------------------------------------------------------------ |
| price       | String  | 指定货币的价格                                               |
| size        | String  | 指定货币的数量                                               |
| timeInForce | String  | [可选] 订单时效策略 **GTC**, **GTT**, **IOC**, **FOK** (默认为**GTC**) |
| cancelAfter | long    | [可选] **n** 秒之后取消，订单时效策略为 **GTT**              |
| postOnly    | boolean | [可选] 被动委托的标识, 当订单时效策略为 **IOC** 或 **FOK** 时无效 |
| hidden      | boolean | [可选] 是否隐藏（买卖盘中不展示）                            |
| iceberg     | boolean | [可选] 冰山单中是否仅显示订单的可见部分                      |
| visibleSize | String  | [可选] 冰山单最大的展示数量                                  |

#### **market** 市价单额外所需请求参数

| 请求参数 | 类型   | 含义                     |
| -------- | ------ | ------------------------ |
| size     | String | 否（size和funds 二选一） |
| funds    | String | 否（size和funds 二选一） |

- 下市价单，需定买卖数量或资金

### 返回值

| 字段    | 含义                                        |
| ------- | ------------------------------------------- |
| orderId | 订单Id。下单成功后，会返回一个orderId字段。 |

## 单个撤单

此接口可以取消单笔止盈止损单。

一旦系统收到取消请求，您将收cancelledOrderIds字段。要知道请求是否已处理，您可以查询订单状态或订阅websocket获取订单消息。

### HTTP请求

**DELETE /api/v1/stop-order/{orderId}**

### 请求示例

DELETE /api/v1/stop-order/5bd6e9286d99522a52e458de

### 请求参数

| 请求参数 | 类型   | 含义                      |
| -------- | ------ | ------------------------- |
| orderId  | String | 路径参数，订单Id 唯一标识 |

### 返回值

| 字段              | 含义         |
| ----------------- | ------------ |
| cancelledOrderIds | 取消的订单id |

### API权限

此接口需要**交易权限**。

**orderId** 是服务器生成的订单唯一标识，不是客户端生成的clientOid

### 撤单被拒

如果订单不能撤销（已经成交或已经取消），会返回错误信息，可根据返回的msg获取原因。

## 按条件撤单

此接口，可以取消当前活跃的止盈止损单，返回值是是已取消订单的ID列表。

### HTTP请求

**DELETE /api/v1/stop-order/cancel**

### 请求示例

**DELETE /api/v1/stop-order/cancel?symbol=ETH-BTC&tradeType=TRADE&orderIds=5bd6e9286d99522a52e458de,5bd6e9286d99522a52e458df**

### API权限

此接口需要**交易权限**。

### 请求参数

| 请求参数  | 类型   | 含义                                                         |
| --------- | ------ | ------------------------------------------------------------ |
| symbol    | String | [可选] 取消指定[交易对](#a17b4e2866)的open订单               |
| tradeType | String | [可选] 取消指定交易类型的open 订单（默认为取消TRADE现货交易订单） |
| orderIds  | String | [可选] 指定订单号，可以多个，用逗号分隔                      |

### 返回值

| 字段              | 含义         |
| ----------------- | ------------ |
| cancelledOrderIds | 取消的订单id |

## 单个订单详情

此接口，可以通过订单id获取单个订单信息。

### HTTP请求

**GET /api/v1/stop-order/{orderId}**

### 请求示例

GET /api/v1/stop-order/5c35c02703aa673ceec2a168

### API权限

此接口需要**通用权限**。

### 请求参数

| 请求参数 | 类型   | 含义                     |
| -------- | ------ | ------------------------ |
| orderId  | String | 路径参数，订单Id唯一标识 |

### 返回值

| 字段        | 含义                                                |
| ----------- | --------------------------------------------------- |
| id          | 订单id，订单唯一标识                                |
| symbol      | 交易对                                              |
| userId      | 用户ID                                              |
| type        | 订单类型                                            |
| side        | 买或卖                                              |
| price       | 订单价格                                            |
| size        | 订单数量                                            |
| funds       | 下单金额                                            |
| stp         | 自成交保护                                          |
| timeInForce | 订单时效策略                                        |
| cancelAfter | timeInForce 为 GTT n秒后触发                        |
| postOnly    | 是否为被动委托                                      |
| hidden      | 是否为隐藏单                                        |
| iceberg     | 是否为冰山单                                        |
| visibleSize | 冰山单在买卖盘可见数量                              |
| channel     | 下单来源                                            |
| clientOid   | 客户端生成的标识                                    |
| remark      | 订单说明                                            |
| tags        | 订单标签                                            |
| tradeType   | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易) |
| feeCurrency | 计手续费币种                                        |
| createdAt   | 创建时间                                            |
| stop        | 止盈止损类型                                        |
| stopPrice   | 触发价格                                            |

## 获取止盈止损单列表

此接口，可获取订单列表 返回值是[分页](#88b6b4f79a)后的数据。

### HTTP请求

**GET /api/v1/stop-order

### 请求示例

GET /api/v1/stop-order

### API权限

此接口需要**通用权限**。

这个接口需要使用分页

### 请求参数

| 请求参数    | 类型   | 含义                                                         |
| ----------- | ------ | ------------------------------------------------------------ |
| symbol      | String | [可选] 只返回指定交易对的订单信息                            |
| side        | String | [可选] **buy（买）** 或 **sell（卖）**                       |
| type        | String | [可选] 订单类型: **limit（限价单）**, **market(市价单)**     |
| tradeType   | String | [可选] 交易类型: **TRADE（现货交易）**, **MARGIN_TRADE(杠杆交易)** |
| startAt     | long   | [可选] 开始时间（毫秒）                                      |
| endAt       | long   | [可选] 截止时间（毫秒）                                      |
| currentPage | Int    | [可选] 当前页号                                              |
| orderIds    | String | [可选] 订单号列表，用逗号分隔                                |
| pageSize    | Int    | [可选] 每页大小                                              |

### 返回值

| 字段        | 含义                                                |
| ----------- | --------------------------------------------------- |
| id          | 订单id，订单唯一标识                                |
| symbol      | 交易对                                              |
| userId      | 用户ID                                              |
| type        | 订单类型                                            |
| side        | 买或卖                                              |
| price       | 订单价格                                            |
| size        | 订单数量                                            |
| funds       | 下单金额                                            |
| stp         | 自成交保护                                          |
| timeInForce | 订单时效策略                                        |
| cancelAfter | timeInForce 为 GTT n秒后触发                        |
| postOnly    | 是否为被动委托                                      |
| hidden      | 是否为隐藏单                                        |
| iceberg     | 是否为冰山单                                        |
| visibleSize | 冰山单在买卖盘可见数量                              |
| channel     | 下单来源                                            |
| clientOid   | 客户端生成的标识                                    |
| remark      | 订单说明                                            |
| tags        | 订单标签                                            |
| tradeType   | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易) |
| feeCurrency | 计手续费币种                                        |
| createdAt   | 创建时间                                            |
| stop        | 止盈止损类型                                        |
| stopPrice   | 触发价格                                            |

## 根据clientOid获取单个订单详情

此接口，可以通过clientOid获取单个止盈止损单信息。

### HTTP请求

**GET /api/v1/stop-order/queryOrderByClientOid**

### 请求示例

GET /api/v1/stop-order/queryOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a

### API权限

此接口需要**通用权限**。

### 请求参数

| 请求参数  | 类型   | 含义             |
| --------- | ------ | ---------------- |
| clientOid | String | 客户端生成的标识 |
| symbol    | String | [可选] 交易对    |

### 返回值

| 字段        | 含义                                                |
| ----------- | --------------------------------------------------- |
| id          | 订单id，订单唯一标识                                |
| symbol      | 交易对                                              |
| userId      | 用户ID                                              |
| type        | 订单类型                                            |
| side        | 买或卖                                              |
| price       | 订单价格                                            |
| size        | 订单数量                                            |
| funds       | 下单金额                                            |
| stp         | 自成交保护                                          |
| timeInForce | 订单时效策略                                        |
| cancelAfter | timeInForce 为 GTT n秒后触发                        |
| postOnly    | 是否为被动委托                                      |
| hidden      | 是否为隐藏单                                        |
| iceberg     | 是否为冰山单                                        |
| visibleSize | 冰山单在买卖盘可见数量                              |
| channel     | 下单来源                                            |
| clientOid   | 客户端生成的标识                                    |
| remark      | 订单说明                                            |
| tags        | 订单标签                                            |
| tradeType   | 交易类型: TRADE（现货交易）, MARGIN_TRADE(杠杆交易) |
| feeCurrency | 计手续费币种                                        |
| createdAt   | 创建时间                                            |
| stop        | 止盈止损类型                                        |
| stopPrice   | 触发价格                                            |

## 根据clientOid取消单个止盈止损单

此接口，可以通过clientOid取消单个止盈止损单。

### HTTP请求

**DELETE /api/v1/stop-order/cancelOrderByClientOid**

### 请求示例

DELETE /api/v1/stop-order/cancelOrderByClientOid?symbol=BTC-USDT&clientOid=9823jnfda923a

### API权限

此接口需要**交易权限**。

### 请求参数

| 请求参数  | 类型   | 含义             |
| --------- | ------ | ---------------- |
| clientOid | String | 客户端生成的标识 |
| symbol    | String | [可选] 交易对    |

### 返回值

| 字段             | 含义             |
| ---------------- | ---------------- |
| cancelledOrderId | 取消的订单id     |
| clientOid        | 客户端生成的标识 |


# 

# 市场数据

市场数据是公共的，不需要验证签名。


# 交易对 & 行情快照

## 交易对列表

```json
[
    {
        "symbol":"BTC-USDT",
        "name":"BTC-USDT",
        "baseCurrency":"BTC",
        "quoteCurrency":"USDT",
        "baseMinSize":"0.00000001",
        "quoteMinSize":"0.01",
        "baseMaxSize":"10000",
        "quoteMaxSize":"100000",
        "baseIncrement":"0.00000001",
        "quoteIncrement":"0.01",
        "priceIncrement":"0.00000001",
        "feeCurrency":"USDT",
        "enableTrading":true,
        "isMarginEnabled":true,
        "priceLimitRate":"0.1"
    }
]
```

此接口，可获取交易对列表。如果您想获取更多交易对的市场信息，可在[全局行情快照](#f3027c9902中获取)。


### HTTP请求
**GET /api/v1/symbols**

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
market | String | [可选] [交易市场](#b8f118fefc): BTC, KCS, USDS, ALTS

### 请求示例
GET /api/v1/symbols


### 返回值

| 字段             | 含义                            |
| -------------- | ----------------------------- |
| symbol         | 交易对唯一标识码，重命名后不会改变             |
| name           | 交易对名称，重命名后会改变                 |
| baseCurrency   | 商品货币，指一个交易对的交易对象，即写在靠前部分的资产名  |
| quoteCurrency  | 计价币种，指一个交易对的定价资产，即写在靠后部分资产名   |
| baseMinSize    | 下单时size的最小值                   |
| quoteMinSize   | 下市价单，funds的最小值                |
| baseMaxSize    | 下单，size的最大值                   |
| quoteMaxSize   | 下市价单，funds的最大值                |
| baseIncrement  | 数量增量，下单的size必须为数量增量的正整数倍      |
| quoteIncrement | 市价单：资金增量，下单的funds必须为资金增量的正整数倍 |
| priceIncrement | 限价单：价格增量，下单的price必须为价格增量的正整数倍 |
| feeCurrency    | 交易计算手续费的币种                   |
| enableTrading  | 是否可以用于交易                      |
| isMarginEnabled | 是否支持杠杆                        |
| priceLimitRate | 价格保护阈值                          |

- **baseMinSize** 和 **baseMaxSize** 这两个字段规范了下单size的最小值和最大值。
- **priceIncrement** 字段规范了下单的price的最小值和价格增量。

下单的price必须为价格增量的正整数倍（如果增量为 0.01，下单价格是0.001或0.021的请求会被拒绝，返回invalid priceIncrement）

**priceIncrement** 和 **quoteIncrement** 以后可能会调整，调整前我们会提前以邮件和全站通知的方式进行通知。



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


此接口，会返回level-1市场行情快照，买/最佳卖一价，买/卖一数量，最近成交价，最近成交数量。

### HTTP请求
**GET /api/v1/market/orderbook/level1**

### 请求示例
GET /api/v1/market/orderbook/level1?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值
字段 | 含义
--------- | -------
sequence | 序列号
price |  最新成交价格
size | 最新成交数量
bestAsk |  最佳卖一价
bestAskSize |  最佳卖一数量
bestBid |  最佳买一价
bestBidSize | 最佳买一数量
time |  时间戳


<aside class="spacer2"></aside>


## 全局行情快照

```json
{
    "ticker":[
        {
          "time": 1602832092060,	// 时间戳
          "symbol": "BTC-USDT",	// 交易对
          "symbolName": "BTC-USDT", // 变更后的交易对名称
          "buy": "11328.9",	// 最佳买一价
          "sell": "11329",	// 最佳卖一价
          "changeRate": "-0.0055",	// 24h涨跌幅	
          "changePrice": "-63.6",	//24h 涨跌价
          "high": "11610",	// 24h最高价
          "low": "11200",	// 24h最低价
          "vol": "2282.70993217",	// 24h成交量，以基础币种计量的交易量
          "volValue": "25984946.157790431",	// 24h成交金额
          "last": "11328.9",	// 最新成交价
          "averagePrice": "11360.66065903",	// 昨日24小时平均成交价格
          "takerFeeRate": "0.001",	// 吃单基础手续费
          "makerFeeRate": "0.001",	// 挂单基础手续费
          "takerCoefficient": "1",	// 吃单手续费系数
          "makerCoefficient": "1"	// 挂单手续费系数
        }
    ],
    "time":1602832092060
}
```

此接口，可获取所有交易对的tickers(包含24h成交量)

极少数情况下，交易市场存在币种变更名称的情况，如果您想要外部显示正常，您可以调用Get all tickers接口根据返回值的“symbolName”字段显示改名后交易对的交易数据。

### HTTP请求
**GET /api/v1/market/allTickers**

### 请求示例
GET /api/v1/market/allTickers

### 返回值
字段 | 含义
--------- | -------
time |  时间戳
symbol | 交易对
symbolName| 变更后的交易对名称
buy |  最佳买一价
sell | 最佳卖一价
changeRate |  24h涨跌幅
changePrice | 24h涨跌价格
high | 24h最高价
low |  24h最低价
vol | 24h成交量，以基础币种计量的交易量
volValue | 24h 成交金额
last | 最新成交价
averagePrice | 昨日24小时平均成交价格
takerFeeRate | 吃单基础手续费
makerFeeRate | 挂单基础手续费
takerCoefficient | 吃单手续费系数
makerCoefficient | 挂单手续费系数
<aside class="spacer2"></aside>

## 24小时统计

```json
//Get 24hr Stats
{
  "time": 1602832092060,	// 时间戳
  "symbol": "BTC-USDT",	// 交易对
  "buy": "11328.9",	// 最佳买一价
  "sell": "11329",	// 最佳卖一价
  "changeRate": "-0.0055",	// 24h涨跌幅	
  "changePrice": "-63.6",	//24h 涨跌价
  "high": "11610",	// 24h最高价
  "low": "11200",	// 24h最低价
  "vol": "2282.70993217",	// 24h成交量，以基础币种计量的交易量
  "volValue": "25984946.157790431",	// 24h成交金额
  "last": "11328.9",	// 最新成交价
  "averagePrice": "11360.66065903",	// 昨日24小时平均成交价格
  "takerFeeRate": "0.001",	// 吃单基础手续费
  "makerFeeRate": "0.001",	// 挂单基础手续费
  "takerCoefficient": "1",	// 吃单手续费系数
  "makerCoefficient": "1"	// 挂单手续费系数
}
```

此接口，可获取指定交易对的最近24小时的ticker

### HTTP请求
**GET /api/v1/market/stats**

### 请求示例
GET /api/v1/market/stats?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | -------| -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
time |  时间戳
symbol | 交易对
buy |  最佳买一价
sell | 最佳卖一价
changeRate |  24h涨跌幅
changePrice | 24h涨跌价格
high | 24h最高价
low |  24h最低价
vol | 24h成交量，以基础币种计量的交易量
volValue | 24h 成交金额
last | 最新成交价
averagePrice | 昨日24小时平均成交价格
takerFeeRate | 吃单基础手续费
makerFeeRate | 挂单基础手续费
takerCoefficient | 吃单手续费系数
makerCoefficient | 挂单手续费系数
<aside class="spacer2"></aside>

## 交易市场列表

```json
//Get Market List
{
    "data":[

        "BTC",
        "KCS",
        "USDS",
        "ALTS"
    ]
}
```

此接口，可以获取整个交易市场的交易币种
<aside class="notice"> SC已更名为USDS，但您依然可以使用SC作为查询参数。</aside>
<aside class="notice"> ETH、NEO、TRX三个计价币种区合并至ALTS交易区，您可以通过ALTS交易区查询ETH、NEO、TRX市场的交易对。</aside>

### HTTP请求
**GET /api/v1/markets**

### 请求示例
GET /api/v1/markets


<aside class="spacer2"></aside>

# 委托买卖盘

## Level-2部分买卖盘(价格聚合)

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
此接口，可获取指定交易对的买卖盘数据。

买卖盘上的买单和卖单均按照价格汇总，每个价格下仅返回一个根据价格汇总的挂单量。

此接口，只会返回部分的买卖盘数据，level2_20是指返回买卖方各20条数据，level_100 是指返回买卖方各100条数据。推荐您使用这个接口，因为响应速度更快，流量消耗小。



### HTTP请求

**GET /api/v1/market/orderbook/level2_20**

**GET /api/v1/market/orderbook/level2_100**

### 请求示例
GET /api/v1/market/orderbook/level2_20?symbol=BTC-USDT
GET /api/v1/market/orderbook/level2_100?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | -------  | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 时间戳
bids | 买盘
asks | 卖盘

###数据排序方式

**Asks**: 买盘，根据价格从低到高

**Bids**: 卖盘，根据价格从高到低


## Level-2全部买卖盘(价格聚合) [已废弃]

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
此接口获取指定交易对的所有活动委托的快照。

Level 2 买卖盘上的买单和卖单均按照价格汇总，每个价格下仅返回一个根据价格汇总的挂单量。

此接口将返回全部的买卖盘数据。

该功能适用于专业交易员，因为该过程将使用较多服务器资源及流量，访问频率受到了严格控制。

为保证本地买卖盘数据为最新数据，在获取Level 2快照后，请使用[Websocket](#level-2-3)推送的增量消息来更新Level 2买卖盘。


### HTTP请求

**GET /api/v2/market/orderbook/level2**

### 请求示例
GET /api/v2/market/orderbook/level2?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 时间戳
bids | 买盘
asks | 卖盘

###数据排序方式

**Asks**: 买盘，根据价格从低到高

**Bids**: 卖盘，根据价格从高到低

## Level-2全部买卖盘(价格聚合)

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
此接口获取指定交易对的所有活动委托的快照。

Level 2 买卖盘上的买单和卖单均按照价格汇总，每个价格下仅返回一个根据价格汇总的挂单量。

此接口将返回全部的买卖盘数据。

该功能适用于专业交易员，因为该过程将使用较多服务器资源及流量，访问频率受到了严格控制。

为保证本地买卖盘数据为最新数据，在获取Level 2快照后，请使用[Websocket](#level-2-3)推送的增量消息来更新Level 2买卖盘。


### HTTP请求

**GET /api/v3/market/orderbook/level2**

### 请求示例
GET /api/v3/market/orderbook/level2?symbol=BTC-USDT

### API权限
此接口需要**通用权限**。

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 时间戳
bids | 买盘
asks | 卖盘

###数据排序方式

**Asks**: 买盘，根据价格从低到高

**Bids**: 卖盘，根据价格从高到低

## Level-3全部买卖盘(非聚合) [已废弃]


```json
{
    "data": {

        "sequence": 1573503933086,
        "asks": [
            [
                "5e0d672c1f311300093ac522",   //订单ID
                "0.1917",                     //价格
                "390.9275",                   //数量
                1577936689346546088           //时间,纳秒
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

此接口，可获取指定交易对的所有未结委托的快照。Level 3 返回了买卖盘上的所有数据（未按价格汇总，一个价格对应一个挂单）。

该功能适用于专业交易员，因为该过程将使用较多服务器资源及流量，访问频率受到了严格控制。

为保证本地买卖盘数据为最新数据，在获取Level 3快照后，请使用[Websocket](#level-nbsp-3-2)推送的增量消息来更新Level 3买卖盘。

如果不使用level3构建增量买卖盘，建议不要使用此接口，该接口获取的买卖盘数据会有较大的延迟，仅适用于level3增量构建。

在买卖盘中，卖盘是以价格从低到高排序的，价格相同的订单以进入买卖盘的时间从低到高排序。买盘是以价格从高到低排序的，价格相同的订单以进入买卖盘的时间从低到高排序。撮合引擎将按照订单在买卖盘中排列顺序依次进行撮合。


### HTTP请求
**GET /api/v2/market/orderbook/level3**

### 请求示例

GET GET /api/v2/market/orderbook/level3?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 时间戳，纳秒
bids | 买盘
asks | 卖盘

###数据排序方式

**Asks**: 卖盘，根据价格从低到高

**Bids**: 买盘，根据价格从高到低

<aside class="spacer4"></aside>

## Level-3全部买卖盘(非聚合)


```json
{
    "data": {

        "sequence": 1573503933086,
        "asks": [
            [
                "5e0d672c1f311300093ac522",   //订单ID
                "0.1917",                     //价格
                "390.9275",                   //数量
                1577936689346546088           //时间,纳秒
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

此接口，可获取指定交易对的所有未结委托的快照。Level 3 返回了买卖盘上的所有数据（未按价格汇总，一个价格对应一个挂单）。

该功能适用于专业交易员，因为该过程将使用较多服务器资源及流量，访问频率受到了严格控制。

为保证本地买卖盘数据为最新数据，在获取Level 3快照后，请使用[Websocket](#level-nbsp-3-2)推送的增量消息来更新Level 3买卖盘。

如果不使用level3构建增量买卖盘，建议不要使用此接口，该接口获取的买卖盘数据会有较大的延迟，仅适用于level3增量构建。

在买卖盘中，卖盘是以价格从低到高排序的，价格相同的订单以进入买卖盘的时间从低到高排序。买盘是以价格从高到低排序的，价格相同的订单以进入买卖盘的时间从低到高排序。撮合引擎将按照订单在买卖盘中排列顺序依次进行撮合。


### HTTP请求
**GET /api/v3/market/orderbook/level3**

### 请求示例

GET GET /api/v3/market/orderbook/level3?symbol=BTC-USDT

### API权限
此接口需要**通用权限**。

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 时间戳，纳秒
bids | 买盘
asks | 卖盘

###数据排序方式

**Asks**: 卖盘，根据价格从低到高

**Bids**: 买盘，根据价格从高到低

<aside class="spacer4"></aside>

# 历史数据

## 成交历史

```json
[
    {
        "sequence":"1545896668571",
        "price":"0.07",//成交价格
        "size":"0.004", //成交数量
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
此接口，可获取指定交易对的成交历史列表。

### HTTP请求
**GET /api/v1/market/histories**

### 请求示例
GET GET /api/v1/market/histories?symbol=BTC-USDT

### 请求参数


请求参数 | 类型 | 含义
--------- | -------  | -------
symbol | String |  [交易对](#a17b4e2866)

### 返回值

字段 | 含义
--------- | -------
sequence | 序列号
time | 交易时间戳
price | 订单价格
size | 订单数量
side |卖方 或 买方

###SIDE
Taker订单的成交方向。Taker订单指立刻与买卖盘上的已有订单成交的订单类型。



<aside class="spacer2"></aside>

## 历史蜡烛图数据

```json
[
    [
        "1545904980", //k线周期的开始时间
        "0.058",  //开盘价
        "0.058", //收盘价
        "0.049", //最高价
        "0.018",  //最低价
        "0.000945"  //成交量
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
此接口，返回指定交易对的kline(蜡烛图），返回数据根据时间粒度划分。

<aside class="notice">  历史蜡烛图数据可能不完整，请勿轮询调用此接口，可以通过Websocket订阅实时数据</aside>


### HTTP请求
**GET /api/v1/market/candles**

### 请求示例
GET /api/v1/market/candles?type=1min&symbol=BTC-USDT&startAt=1566703297&endAt=1566789757



### 请求参数


请求参数 | 类型 | 含义
------------- | ------- | -------
symbol | String |  [交易对](#a17b4e2866)
startAt| long | [可选] 开始时间（秒）默认值为0
endAt| long | [可选]  截止时间（秒）默认值为0
type | String | 时间粒度，也就是每根蜡烛的时间区间:<br/>**1min, 3min, 5min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week**

<aside class="notice"> 每次查询系统最多返回1500条数据。要获得更多数据，请按时间分页数据。</aside>

###返回值

字段 | 含义
--------- | -------
time | k线周期的开始时间
open | 开盘价
close | 收盘价
high | 最高价
low | 最低价
volume | 成交量
turnover | 成交额


# 币种

## 币种列表

```json

```

此接口，返回币种详情列表。

<aside class="notice">并不是所有的币种可以用于交易</aside>
### HTTP请求

**GET /api/v1/currencies**

### 请求示例

GET /api/v1/currencies

### 返回值

| 字段  | 含义                |
| --- | ----------------- |
|currency| 币种唯一标识，不会改变|
|name| 币种名，可变更|
|fullName| 币种全称，可变更|
|precision| 币种精度 |
|withdrawalMinSize| 提现最小值 |
|withdrawalMinFee| 提现最小手续费 |
|isWithdrawEnabled| 是否可提现 |
|isDepositEnabled| 是否可充值|
|isMarginEnabled|是否支持杠杆|
|isDebitEnabled|是否支持借贷|
|confirms| 区块链确认数|

### 币种标识(currency code)

币种标识（code）均符合 ISO 4217 的标准，不符合ISO 4217标准中无法标识的币种，将采取自定义标识。

| Code | 含义            |
| ---- | ------------- |
| BTC  | Bitcoin       |
| ETH  | Ethereum      |
| KCS  | Kucoin Shares |

返回值中的**currency**是不会改变的，而name、fullname、precision等都可能会变动，当一个币种更换name时，您仍可以使用currency去获取该币种的信息。

例如：XRB更名后变为Nano，但它的currency仍然是XRB，而它的name变更为Nano，此时您仍然需要通过XRB去查询该币种。

## 币种详情

```json
{
    "currency":"BTC",
    "name":"BTC",
    "fullName":"Bitcoin",
    "precision":8,
    "withdrawalMinSize":"0.002",
    "withdrawalMinFee":"0.0005",
    "isWithdrawEnabled":true,
    "isDepositEnabled":true,
    "isMarginEnabled":true,
    "isDebitEnabled":true
}
```

此接口，返回可交易币种的法币换算后的价格

### HTTP请求

**GET /api/v1/currencies/{currency}**

### 请求示例

GET /api/v1/currencies/BTC

### 请求参数

| 请求参数     | 类型     | 含义                                                              |
| -------- | ------ | --------------------------------------------------------------- |
| currency | String | 路径参数，[币种标识](#ebcc9fbb02)                                        |
| chain    | String | [可选] 针对一币多链的币种，可通过chain获取币种详情。比如， USDT存在的链有 OMNI, ERC20, TRC20。 |

### 返回值

|字段 | 含义|
|--------- | -------|
|currency| 币种唯一标识，不会改变|
|name| 币种名，可变更|
|fullName| 币种全称，可变更|
|precision| 币种精度 |
|withdrawalMinSize| 提现最小值 |
|withdrawalMinFee| 提现最小手续费 |
|isWithdrawEnabled| 是否可提现 |
|isDepositEnabled| 是否可充值|
|isMarginEnabled|是否支持杠杆|
|isDebitEnabled|是否支持借贷|
|confirms| 区块链确认数|

## 法币换算价格
此接口，返回法币换算后的价格

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
### HTTP 请求
**GET /api/v1/prices**

### 请求示例
GET /api/v1/prices

### 请求参数


请求参数 | 类型 | 含义
--------- | ------- | -------
 base | String | [可选] 法币货币代码。比如，USD，EUR 默认为USD |
 currencies | String  |[可选] 需转换的数字货币（多个币种，请使用“,“进行间隔）。比如，BTC,ETH 。默认为返回所有币种的法币价格|


# 杠杆交易

# 杠杆信息

## 获取当前标记价格

```json
{
    "symbol":"USDT-BTC",
    "granularity":5000,
    "timePoint":1568701710000,
    "value":0.00009807
}
```

此接口返回当前指定交易对的标记价格

### HTTP请求

**GET /api/v1/mark-price/{symbol}/current**

### 请求示例

GET /api/v1/mark-price/USDT-BTC/current

### 请求参数

| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| symbol | String | 路径参数, 交易对 |

### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| symbol      | 交易对      |
| granularity | 数据粒度(毫秒) |
| timePoint   | 时间点(毫秒)  |
| value       | 标记价格值    |

目前支持的标记价格有：USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC, DIA-BTC, VET-BTC, DASH-BTC, DOT-BTC, XTZ-BTC, ZEC-BTC, BCHSV-BTC, ADA-BTC, ATOM-BTC, LINK-BTC, LUNA-BTC, NEO-BTC, UNI-BTC, ETC-BTC, BNB-BTC, TRX-BTC, XLM-BTC

## 查询杠杆配置信息

```json
{
    "currencyList":[
        "BTC",
        "USDT",
        "EOS"
    ],
    "warningDebtRatio":"0.8",
    "liqDebtRatio":"0.9",
    "maxLeverage":"3"
}
```

此接口返回杠杆配置信息

### HTTP请求

**GET /api/v1/margin/config**

### 请求示例

GET /api/v1/margin/config


### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| currencyList | 支持的币种列表 |
| warningDebtRatio | 爆仓预警负债率 |
| liqDebtRatio | 爆仓负债率 |
| maxLeverage | 杠杆倍数 |

## 查询杠杆账户信息

```json
{
    "accounts":[
        {
            "currency":"USDT",
            "availableBalance":"990.11",
            "holdBalance":"7.22",
            "liability":"66.66",
            "maxBorrowSize":"88.88",
            "totalBalance":"997.33"
        }
    ],
    "debtRatio":"0.33"
}
```

此接口返回当前杠杆账户信息

### HTTP请求

**GET /api/v1/margin/account**

### 请求示例

GET /api/v1/margin/account

### API权限

该接口需要**通用权限**。


### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| accounts | 账户列表 |
| debtRatio | 负债率 |
| currency | 币种 |
| totalBalance | 账户总额 |
| availableBalance | 账户可用余额 |
| holdBalance | 账户冻结金额 |
| liability | 当前总负债 |
| maxBorrowSize | 当前可借数量 |

# 借贷

## 发布借入委托

```json
{
    "orderId":"a2111213",
    "currency":"USDT"
}
```



### HTTP请求

**POST /api/v1/margin/borrow**

### 请求示例

POST /api/v1/margin/borrow

### API权限

该接口需要**交易权限**。

### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| currency | String | [必选] 借入币种 |
| type | String | [必选] 类型：FOK、IOC |
| size | BigDecimal | [必选] 借入数量 |
| maxRate | BigDecimal | [可选] 最大利率, 不填则表示接受所有利率 |
| term | String | [可选] 期限,单位为:天, 不填则表示接受所有期限,逗号隔开,如: 7,14,28 |

<aside class="notice">现系统支持的借入期限: 7、14、28</aside>

### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| orderId | 借入委托id |
| currency | 借入币种 |

## 查询借入委托

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

调用[发布借入委托](#ebcc9fbb02) 后,根据返回的委托id，查询借入详情。

### HTTP请求

**GET /api/v1/margin/borrow**

### 请求示例

GET /api/v1/margin/borrow?orderId=123456789

### API权限

该接口需要**交易权限**。

### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| orderId | String | 借入委托id |

### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| orderId      | 借入委托id      |
| currency | 币种 |
| size | 申请借入数量  |
| filled | 实际借入数量    |
| status | 状态：DONE-表示已借入完成或者取消，PROCESSING-表示系统还在处理中 |
| matchList | 借入成交明细    |
| tradeId | 交易id |
| dailyIntRate | 利率 |
| term | 期限 |
| timestamp | 借入时间戳 |

## 查询待还款记录

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


### HTTP请求

**GET /api/v1/margin/borrow/outstanding**

### 请求示例

GET /api/v1/margin/borrow/outstanding

### API权限

该接口需要**交易权限**。
<aside class="notice">这个接口需要使用分页</aside>
### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| currency | String | 币种，不传则查询所有币种 |

### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| tradeId | 交易id |
| currency       | 币种 |
| liability | 总负债 |
| principal | 待还本金    |
| accruedInterest | 应计利息 |
| createdAt   | 成交时间，时间戳 |
| maturityTime       | 到期时间，时间戳 |
| period       | 期限  |
| repaidSize | 已还数量  |
| dailyIntRate | 日利率  |

## 查询已还款记录

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


### HTTP请求

**GET /api/v1/margin/borrow/repaid**

### 请求示例

GET /api/v1/margin/borrow/repaid

### API权限

该接口需要**交易权限**。

<aside class="notice">这个接口需要使用分页</aside>
### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| currency | String | 币种，不传则查询所有币种 |

### 返回值

| 字段          | 含义       |
| ----------- | -------- |
| tradeId | 交易id |
| currency       | 币种 |
| interest   | 利息 |
| principal  | 本金 |
| repayTime | 还款时间，时间戳 |
| term   | 期限  |
| repaidSize | 已还款数量 |
| dailyIntRate | 日利率  |

## 一键还款



### HTTP请求

**POST /api/v1/margin/repay/all**

### 请求示例

POST /api/v1/margin/repay/all

### API权限

该接口需要**交易权限**。

### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| currency | String | 币种 |
| sequence | String | 还款顺序策略,RECENTLY_EXPIRE_FIRST:到期时间优先,即优先归还最快到期的贷款, HIGHEST_RATE_FIRST:利率优先，即优先归还利率高的贷款 |
| size | BigDecimal | 还款数量 |

### 返回值

当返回HTTP状态码200和code为200000时,表示还款响应成功,否则表示还款失败。

## 单笔还款

此接口用于归还指定某笔贷款

### HTTP请求

**POST /api/v1/margin/repay/single**

### 请求示例

POST /api/v1/margin/repay/single

### API权限

该接口需要**交易权限**。

### 请求参数


| 请求参数   | 类型     | 含义        |
| ------ | ------ | --------- |
| currency | String | 币种 |
| tradeId | String | 交易id |
| size | BigDecimal | 还款数量 |

### 返回值

当返回HTTP状态码200和code为200000时,表示还款响应成功,否则表示还款失败。

## 发布借出委托

```json
{
    "orderId":"5da5a4f0f943c040c2f8501e"
}
```

此接口可以发布单笔借出委托。

在发布前，请确保你的储蓄账户有足够的资金。一旦发布成功，你发布的金额会被冻结，直到借出委托成交或者撤销

### HTTP请求

**POST /api/v1/margin/lend**

### 请求示例

POST /api/v1/margin/lend

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数     | 类型   | 含义                             |
| ------------ | ------ | -------------------------------- |
| currency     | String | [必须] 借出币种                  |
| size         | String | [必须] 该币种的数量              |
| dailyIntRate | String | [必须] 日利率小数。0.002表示0.2% |
| term         | int    | [必须] 期限，单位天              |

### 返回值

| 字段    | 含义   |
| ------- | ------ |
| orderId | 委托Id |

## 撤销借出委托

此接口可以撤销单笔借出委托

### HTTP请求

**DELETE /api/v1/margin/lend/{orderId}**

### 请求示例

DELETE /api/v1/margin/lend/5d9f133ef943c0882ca37bc8

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义          |
| -------- | ------ | ------------- |
| orderId  | String | [必须] 委托Id |

## 设置自动借出

此接口可以设置用户单币种的自动借出。可以设置自动借出的开关、参数

### HTTP请求

**POST /api/v1/margin/toggle-auto-lend**

### 请求示例

POST /api/v1/margin/toggle-auto-lend

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数     | 类型    | 含义                                                         |
| ------------ | ------- | ------------------------------------------------------------ |
| currency     | String  | [必须] 币种                                                  |
| isEnable     | boolean | [必须] 是否开启                                              |
| retainSize   | String  | [开启时必须] 该币种的保留数量。储蓄账户该币种不自动借出的数量 |
| dailyIntRate | String  | [开启时必须] 可接受最低日利率，0.002标识0.2%                      |
| term         | int     | [开启时必须] 期限，单位天                                    |

###术语解释

###可接受最低日利率(dailyIntRate)
可接受最低日利率(dailyIntRate)

当市场最优利率高于您的可接受最低日利率时，系统将以市场最优利率挂单。（市场最优利率即当下时刻所选期限的所有借出挂单的一档利率。该利率将优先被成交。）

当市场最优利率低于可接受最低日利率时，我们将以您设定的可接受最低日利率进行挂单借出。


## 查询活跃借出委托

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

此接口可以分页查询用户活跃的借出委托
返回值是分页后的数据，根据委托时间降序排列，最大页数100

活跃借出委托指：未成交、部分成交、未撤销的借出委托

### HTTP请求

**GET /api/v1/margin/lend/active**

### 请求示例

GET /api/v1/margin/lend/active?currency=BTC&currentPage=1&pageSize=50

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [可选] 币种 |

### 返回值

| 字段         | 含义                      |
| ------------ | ------------------------- |
| orderId      | 委托Id                    |
| currency     | 币种                      |
| size         | 该币种的委托总量          |
| filledSize   | 该币种的已借出数量        |
| dailyIntRate | 日利率小数。0.002表示0.2% |
| term         | 期限，单位天              |
| createdAt    | 委托时间戳，单位毫秒      |

## 查询历史借出委托

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

此接口可以分页查询用户历史的借出委托
返回值是分页后的数据，根据委托时间降序排列，最大页数100

历史借出委托指：全部成交、撤销的借出委托

### HTTP请求

**GET /api/v1/margin/lend/done**

### 请求示例

GET /api/v1/margin/lend/done?currency=BTC&currentPage=1&pageSize=50

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [可选] 币种 |

### 返回值

| 字段         | 含义                                         |
| ------------ | -------------------------------------------- |
| orderId      | 委托Id                                       |
| currency     | 币种                                         |
| size         | 该币种的委托总量                             |
| filledSize   | 该币种的已借出数量                           |
| dailyIntRate | 日利率小数。0.002表示0.2%                    |
| term         | 期限，单位天                                 |
| createdAt    | 委托时间戳，单位毫秒                         |
| status       | 委托状态：FILLED - 全部成交，CANCELED - 撤销 |

## 查询未结算出借记录

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

此接口可以分页查询用户未结算的出借记录
返回值是分页后的数据，根据成交时间降序排列，最大页数100

借出委托成交后，会产生出借记录。未结算的出借记录指：未还款、部分还款的出借记录

### HTTP请求

**GET /api/v1/margin/lend/trade/unsettled**

### 请求示例

GET /api/v1/margin/lend/trade/unsettled?currency=BTC&currentPage=1&pageSize=50

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [可选] 币种 |

### 返回值

| 字段            | 含义                                             |
| --------------- | ------------------------------------------------ |
| tradeId         | 交易Id                                           |
| currency        | 币种                                             |
| size            | 该币种的借出数量                                 |
| accruedInterest | 该币种的应计利息。借入方偿还利息以后，该值会减少 |
| repaid          | 该币种的已还款数量                               |
| dailyIntRate    | 日利率小数。0.002表示0.2%                        |
| term            | 期限，单位天                                     |
| maturityTime    | 到期时间戳，单位毫秒                             |

## 查询已结算出借记录

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

此接口可以分页查询用户已结算的出借记录
返回值是分页后的数据，根据成交时间降序排列，最大页数100

已结算的出借记录指：提前全额还款、到期足额还款、到期不足额还款风险基金补足、到期不足额还款风险基金不能补足的出借记录

### HTTP请求

**GET /api/v1/margin/lend/trade/settled**

### 请求示例

GET /api/v1/margin/lend/trade/settled?currency=BTC&currentPage=1&pageSize=50

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [可选] 币种 |

### 返回值

| 字段         | 含义                                     |
| ------------ | ---------------------------------------- |
| tradeId      | 交易Id                                   |
| currency     | 币种                                     |
| size         | 该币种的借出数量                         |
| interest     | 该币种的总计利息                         |
| repaid       | 该币种的已还款数量                       |
| dailyIntRate | 日利率小数。0.002表示0.2%                |
| term         | 期限，单位天                             |
| settledAt    | 结算时间戳，单位毫秒                     |
| note         | 备注。备注借方穿仓，风险基金是否偿还情况 |

## 资产借出记录

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

该接口可以查询用户借出资产相关的统计信息

### HTTP请求

**GET /api/v1/margin/lend/assets**

### 请求示例

GET /api/v1/margin/lend/assets?currency=BTC

### API权限

该接口需要**交易权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [可选] 币种 |

### 返回值

| 字段            | 含义                   |
| --------------- | ---------------------- |
| currency        | 币种                   |
| outstanding     | 该币种的委托中数量     |
| filledSize      | 该币种的已借出数量     |
| accruedInterest | 该币种的应计利息数量   |
| realizedProfit  | 该币种的已实现收益数量 |
| isAutoLend      | 是否开启自动续借       |

## 借出市场信息

```json
[
    {
        "dailyIntRate":"0.0001",
        "term":7,
        "size":"1.02"
    }
]
```

该接口可以查询借出市场的信息，一次性返回所有满足条件的记录
返回值根据日利率降序、期限降序排列

### HTTP请求

**GET /api/v1/margin/market**

### 请求示例

GET /api/v1/margin/market?currency=BTC&term=7

### API权限

该接口需要**通用权限**。

### 请求参数

| 请求参数 | 类型   | 含义                |
| -------- | ------ | ------------------- |
| currency | String | [必须] 币种          |
| term     | int    | [可选] 期限，单位天    |

### 返回值

| 字段         | 含义                      |
| ------------ | ------------------------- |
| dailyIntRate | 日利率小数。0.002表示0.2% |
| term         | 期限，单位天              |
| size         | 总计金额                  |

## 借贷市场成交信息

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

该接口可以查询借贷市场最近的300条成交信息
返回值根据成交时间戳降序排列

### HTTP请求

**GET /api/v1/margin/trade/last**

### 请求示例

GET /api/v1/margin/trade/last?currency=BTC

### API权限

该接口需要**通用权限**。

### 请求参数

| 请求参数 | 类型   | 含义        |
| -------- | ------ | ----------- |
| currency | String | [必须] 币种 |

### 返回值

| 字段         | 含义                      |
| ------------ | ------------------------- |
| tradeId      | 交易Id                    |
| currency     | 币种                      |
| size         | 成交总量                  |
| dailyIntRate | 日利率小数。0.002表示0.2% |
| term         | 期限，单位天              |
| timestamp    | 成交时间戳，单位纳秒      |


# 其他接口



## 获取服务器时间

```json
{
    "code":"200000",
    "msg":"success",
    "data":1546837113087
}
```

此接口，可获取服务器时间 (Unix时间戳)

### HTTP请求
**GET /api/v1/timestamp**

### 请求示例
GET /api/v1/timestamp

<aside class="spacer2"></aside>

## 获取服务状态

```json
{
    "code":"200000",
    "data":{

        "status":"open", // //open, close, cancelonly
        "msg":"upgrade match engine"
    }
}
```
此接口，可获取服务状态

### HTTP REQUEST
**GET /api/v1/status**

### Example
GET /api/v1/status

### RESPONSES

| 字段     | 含义                                          |
|-------- | -------------------------------------------   |
| status  | 服务状态: **open**、 **close** 或 **cancelonly** |
| msg     | 操作说明                                        |


# Websocket

REST API的使用受到了访问频率的限制，因此推荐您使用Websocket获取实时数据。

<aside class="notice">推荐您只创建一个Websocket连接，在这个连接上订阅多个通道的数据</aside>


## 申请连接令牌


在创建Websocket连接前，您需申请一个令牌（Token）。


### 公共令牌 (不需要验证签名):

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

如果您只订阅公共频道的数据，请按照以下方式请求获取服务实例列表和公共令牌。

#### HTTP请求

**POST /api/v1/bullet-public**

### 私有令牌 (需要验证签名):

如您需请求私有频道的数据（如：账户资金变化），请在签名验证后按照以下方式获取Websocket的服务实例和已验签的令牌。

#### HTTP请求

**POST /api/v1/bullet-private**


### 返回值

|字段 | 含义|
-----|-----
|endpoint| Websocket建立连接的服务器地址 |
|protocol| 支持的协议 |
|encrypt| 表示是否使用了SSL加密 |
|pingInterval| 建议发送ping的时间间隔（毫秒）|
|pingTimeout| 如果在pingTimeout时间后，未收到pong消息，那么连接可能已断开了 |
|token | 令牌 |


## 建立连接

```javascript
var socket = new WebSocket("wss://push1-v2.kucoin.com/endpoint?token=xxx&[connectId=xxxxx]");
```

成功建立连接后，您将会收到系统向您发出的欢迎（welcome）消息。


<aside class="notice">客户端需要等待welcome消息，只有收到了welcome消息，才表示连接可用。</aside>

```json
{
    "id":"hQvf8jkno",
    "type":"welcome"
}
```

**connectId**：连接ID，是客户端生成的唯一标识。您在创建连接时收到的欢迎（welcome）消息的ID以及错误消息的ID都属于连接ID（connectId）。

如果你想只接收指定topic的私人消息，请在订阅时使用privateChannel:true。


<aside class="spacer2"></aside>

## Ping
```json
{
    "id":"1545910590801",
    "type":"ping"
}
```
为防止服务器断开TCP连接，建议客户端每间隔pingInterval时间发送一条ping指令。
在服务器收到ping消息后，系统会向客户端返回一条pong消息。
如果服务器长时间没有收到来自客户端的消息，连接将被断开。


```json
{
    "id":"1545910590801",
    "type":"pong"
}
```
<aside class="spacer3"></aside>


## 订阅

```json
  // 订阅
{
    "id":"123456789",
    "type":"subscribe",
    "topic":"/market/ticker:BTC-USDT,ETH-USDT",
    "privateChannel":false,
    "response":true
}
```

使用服务器订阅消息时，客户端应向服务器发送订阅消息。

订阅成功后，当**response**参数为**true**时，系统将向您发出**“ack”消息**。


```json
{
    "id":"1545910660739",
    "type":"ack"
}
```

当订阅频道产生新消息时，系统将向客户端推送消息。了解消息格式，请查看频道介绍。

### 参数
#### ID
ID用于标识请求和ack的唯一字符串。

#### Topic
您订阅的频道内容。

#### PrivateChannel

您可通过privateChannel参数订阅以一些特殊的topic（如： /market/level3）。该参数默认设置为“false”。设置为“true”时，则您只能收到与您订阅的topic相关的内容推送。


#### Response
若设置为True, 用户成功订阅后，系统将返回ack消息。

客户端需要发送订阅消息到服务端，获取指定topic的消息。

但系统会将相应topic的消息发送到客户端，详情返回值请参照指定的topic。

## 退订

用于取消您之前订阅的topic

```json
  // 取消订阅
{
    "id":"1545910840805",  //要求唯一
    "type":"unsubscribe", //类型: unsubscribe
    "topic":"/market/ticker:BTC-USDT,ETH-USDT",
    "privateChannel":false, //是否使用该频道的私有频道，默认为false
    "response":true //是否需要服务端返回本次订阅的回执信息，默认为false   
}

```

```json
{
    "id":"1545910840805",
    "type":"ack"
}
```

### 参数

#### ID
用于标识请求的唯一字符串。

#### Topic
您订阅的topic内容。

#### PrivateChannel
设置为“true”，您可以退订相关的私有频道推送。


#### Response
退订成功后，当**response**参数为**true**时，系统将向您发出“ack”消息。


## 多路复用


 在一条物理连接上，您可开启多条多路复用通道，以订阅不同topic，获取多种数据推送。

### 开启


例如： 请输入以下指令定开启多条bt1通道 {"id": "1Jpg30DEdU", "type": "openTunnel", "newTunnelId": "bt1", "response": true}

在指定中添加参数tunnelId： {"id": "1JpoPamgFM", "type": "subscribe", "topic": "/market/ticker:KCS-BTC"，"tunnelId": "bt1", "response": true}



### 返回值
请求成功后，您将收到 tunnelIId 对应的消息推送：{"id": "1JpoPamgFM", "type": "message", "topic": "/market/ticker:KCS-BTC", "subject": "trade.ticker", "tunnelId": "bt1", "data": {...}}

### 关闭
请输入以下指令：{"id": "1JpsAHsxKS", "type": "closeTunnel", "tunnelId": "bt1", "response": true}

### 限制
- 多路复用仅限API用户使用。
- 最多可开启的多路复用通道条数：5条。






## 定序编号
买卖盘数据化、成交历史数据以及快照消息均会默认返回sequence字段。您可以从Level 2和Level 3市场行情数据中的sequence来判断数据是否丢失，连接是否稳定。如果连接不稳定，请按照校准流程进行校准。




## 消息处理逻辑

- 判断消息的type: 目前有三类消息，message（常用的推送消息），notice（一般的通知），command（连接的命令）
- 判断消息topic: 通过topic判断是哪一类消息
- 判断subject: 同一个topic的不同类型消息用subject区分。例如level3的5类分别为received, open等


# 公共频道

## 交易瞬时行情

```json
{
    "id":1545910660739,
    "type":"subscribe",
    "topic":"/market/ticker:BTC-USDT",
    "response":true
}
```
Topic: **/market/ticker:{symbol},{symbol}...**

```json
{
    "type":"message",
    "topic":"/market/ticker:BTC-USDT",
    "subject":"trade.ticker",
    "data":{

        "sequence":"1545896668986", //序列号
        "price":"0.08",             // 最近成交价格
        "size":"0.011",             // 最近成交数量
        "bestAsk":"0.08",           //最佳卖一价
        "bestAskSize":"0.18",       // 最佳卖一数量
        "bestBid":"0.049",          //最佳买一价
        "bestBidSize":"0.036",      //最佳买一数量
    }
}
```
订阅此topic可获取指定[交易对](#a17b4e2866)的BBO(最佳买一和卖一)数据的推送。

平台将以100ms的频率推送最新的BB0，如果在和上一次推送相比，BBO没有变化，将不进行推送。

平台后期可能会向该渠道推送更多的信息。

<aside class="spacer2"></aside>
<aside class="spacer4"></aside>


## 全部交易对瞬时行情

```json
{
    "id":1545910660739,
    "type":"subscribe",
    "topic":"/market/ticker:all",
    "response":true
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
        "price":"0.08",
        "size":"0.011",
        "bestAsk":"0.08",
        "bestAskSize":"0.18",
        "bestBid":"0.049",
        "bestBidSize":"0.036"
    }
}
```
订阅此topic可获取所有的BBO(最佳买一和卖一)数据的推送。


<aside class="spacer2"></aside>
<aside class="spacer4"></aside>


## 交易对行情快照

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
            "sort":100,
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
            "board":0,
            "mark":0
        }
    }
}
```

Topic: **/market/snapshot:{symbol}**

订阅此topic对可以获取单个[交易对](#a17b4e2866)的行情快照信息，每隔**两秒**推送一次。


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## 市场行情快照

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
                "sort":100,
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
                "board":0,
                "mark":0
            }
        ]
    }
}
```

Topic: **/market/snapshot:{market}**

订阅此topic可获取指定[交易市场](#b8f118fefc)的所有交易对的行情快照，每隔**2秒**推送一次。


<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Level-2市场行情

```json
{
    "id":1545910660740,
    "type":"subscribe",
    "topic":"/market/level2:BTC-USDT",
    "response":true
}
```

Topic: **/market/level2:{symbol},{symbol}...**

订阅此topic可获取指定[交易对](#a17b4e2866)Level-2买卖盘数据。

订阅成功后，服务端会推送增量的市场数据给您。


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

            "asks":[
                [
                    "6",//price
                    "1", //size
                    "1545896669105" //sequence
                ]
            ],
            "bids":[
                [
                    "4",
                    "1",
                    "1545896669106"
                ]
            ]
        }
    }
}
```

校准流程:


1. 将Websocket推送的Level 2数据缓存在本地;
2. 通过REST请求拉取[Level 2](#level-2-2)买卖盘的快照;
3. 回放缓存的Level 2数据流;
4. 将Level 2数据流应用到快照上，确保数据顺序号与之前数据顺序号连续无间断，丢弃小于快照顺序号的level2数据;
5. 根据订单的价格和数量更新买卖盘。如果价格为0，忽略这条消息，只更新顺序号；如果数量为0，则需要将该数量对应的订单价格从买卖盘中移除。如遇其他情况，正常更新买卖盘即可。

[Level 2](#level-2-2) 的Change属性是一个“price, size, sequence”的字符串值。

请注意，size指的是price对应的最新size。当size为0时，需要将其对应的price从买卖盘中删除。






**示例**

以BTC/USDT为例，假设level 2当前买卖盘数据如下:

1. 成功订阅此topic，您会收到如下买卖盘数据流:


"asks":[

  ["3988.62","8", 15], // 摒弃 sequence <16

  ["3988.61","0", 18], // 移除 price 为 3988.61 的数据

  ["3988.59","3", 16], // 摒弃 sequence = 16

]

"bids":[

    ["3988.50", "44", "17"] // 更新 price 为 3988.50 的size

]

<aside class="notice">消息展示为[“价格”,“数量”,“sequence”]</aside>

1. 通过REST请求拉取[Level-2买卖盘快照信息](#level-2-2)

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

<aside class="notice">消息展示为[“价格”,“数量”]</aside>

当前拉取的买卖盘的快照数据如下:

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


当前买卖盘快照信息的sequence 为 **16**，摒弃买卖盘数据流中sequence <= 16的数据，回放sequence为**17，18**的数据，更新买卖盘快照信息。现在，您本地的sequence为**18**。

**变更**:
1. **将价格3988.50对应的数量变更为44（顺序号为17）**
2. **移除价格为3988.61的数据（顺序号为18）**

变更后，当前买卖盘数据为最新数据，具体数据如下:

| Price   | Size | Side |
| ------- | ---- | ---- |
| 3988.62 | 8    | Sell |
| 3988.60 | 47   | Sell |
| 3988.59 | 3    | Sell |
| 3988.51 | 56   | Buy  |
| 3988.50 | 44   | Buy  |
| 3988.49 | 100  | Buy  |
| 3988.48 | 10  | Buy  |

## Level2 - 5档深度频道
```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth5:BTC-USDT",
    "subject": "level2",
    "data": {

	    "asks":[

            ["9989","8"],     //价格, 数量
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

Topic: **/spotMarket/level2Depth5:{symbol},{symbol}...**

每次返回前五档的深度数据，此数据为每100毫秒的快照数据，即每隔100毫秒，快照当前时刻市场买卖盘的5档深度数据并推送

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## Level2 - 50档深度频道
```json
{
    "type": "message",
    "topic": "/spotMarket/level2Depth50:BTC-USDT",
    "subject": "level2",
    "data": {

	    "asks":[

            ["9993","3"],    //价格, 数量
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

每次返回前50档的深度数据，此数据为每100毫秒的快照数据，即每隔100毫秒，快照当前时刻市场买卖盘的50档深度数据并推送

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer"></aside>


## K线

```json
{
    "type":"message",
    "topic":"/market/candles:BTC-USDT_1hour",
    "subject":"trade.candles.update",
    "data":{

        "symbol":"BTC-USDT",    // 交易对
        "candles":[

            "1589968800",   // candle的开盘时间
            "9786.9",       // open开票价
            "9740.8",       // close收盘价
            "9806.1",       // high最高价
            "9732",         // low最低价
            "27.45649579",  // volume成交量
            "268280.09830877"   // turnover成交额
        ],
        "time":1589970010253893337  // 当前时间，纳秒
    }
}
```
Topic: **/market/candles:{symbol}_{type}**

参数 |  含义
--------- | -------
symbol | 交易对
type |  1min, 3min, 15min, 30min, 1hour, 2hour, 4hour, 6hour, 8hour, 12hour, 1day, 1week


订阅此topic可获取指定 symbol的指定 type 的K线数据。

订阅成功后，服务端会推送的市场K线数据给您。

<aside class="spacer2"></aside>







## 撮合执行数据

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

订阅此topic，可获取撮合执行数据。


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
<aside class="spacer2"></aside>


## 完整的撮合引擎数据(Level 3)

```json
{
    "id":1545910660742,
    "type":"subscribe",
    "topic":"/spotMarket/level3:BTC-USDT",
    "response":true
}
```



Topic: **/spotMarket/level3:{symbol},{symbol}...**

订阅此topic，可获取Level-3完整的撮合引擎数据。

可获取订单和交易的实时数据，这些数据流可用于维护一个本地的Level-3买卖盘。

维护更新Level 3买卖盘的步骤如下：

1. 订阅Topic: /spotMarket/level3:{symbol}，获取Level 3买卖盘数据流;
2. 按顺序缓存接收到的数据流;
3. 发送[REST](#level-3-3)请求，获取Level 3买卖盘的快照;
4. 回放数据流，确保顺序号是连续的，并丢弃掉小于或等于快照顺序号的数据;
5. 将回放消息应用于快照（见下文）;
6. 回放完成后，使用实时数据流更新买卖盘。

**任意Open和Match消息都将导致买卖盘发生变更。**

### 消息类型

订阅成功后，系统将以JSON格式，将**RECEIVED**、**OPEN**、**UPDATE**、**MATCH**及**DONE**消息推送到Websocket消息流中。

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

当撮合引擎接收到订单指令时，系统将向用户发送确认消息，type为**received**。

这意味着，订单进入撮合引擎且订单状态为active。一旦撮合引擎收到这个订单信息，无论它是否立即成交，都会向用户发送确认信息。

**received**消息并不是指在买卖盘挂单，而是指这个订单进入撮合引擎。如果订单能够立即成交，（taker订单），会发送**match**消息。如果自成交保护被触发，size会调整，会发送**change**消息。没有全部成交的的订单会展示在买卖盘中，发送信息中的type为**open**。

您可以使用您自定义的clientOid来跟踪订单信息，但是特别的clientOid可能会暴露您的策略，所以推荐您使用UUID


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

当限价订单中的剩余部分进入买卖盘时，系统将向用户发送**open**消息。

这意味着这个订单现已在订单簿上，没有立即成交的订单才会推送此消息。

当接收到 price="", size="0" 的消息时，意味着这是隐藏单

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### DONE

一个订单生命周期结束时，订单将不会展示在买卖盘中，系统会推送**done**信息。

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"done",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125437,
        "orderId":"5efab07953bdea00089965fa",
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

推送**done**消息，意味着订单从买卖盘中移除，这要有推送过**received**消息的，都会收到**done**消息。 **done**可能指订单被成交或被取消。收到done消息后，就不会在收到关于这个订单的其他的信息了。

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
        "size":"0.1",
        "remainSize":"2.9",
        "tradeId":"5efab07a4ee4c7000a82d6d9",
        "takerOrderId":"5efab07953bdea00089965fa",
        "makerOrderId":"5efab01453bdea00089959ba",
        "ts":1593487482038606180
    }
}

```

当两个订单成功撮合后，系统会推送match信息。

两个订单成功撮合，会生成一个tradeId

当进入撮合引擎后，taker单会立即与maker单(买卖盘中剩余的订单)开始撮合。side字段是指taker单的成交方向。remainSize为maker单的剩余数量。

在进入买卖盘之前，冰山单或隐藏单和普通的订单一样，撮合成功后作为taker

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

### UPDATE

```json
{
    "type":"message",
    "topic":"/spotMarket/level3:KCS-USDT",
    "subject":"update",
    "data":{

        "symbol":"KCS-USDT",
        "sequence":1592995125858,
        "orderId":"5efab14d53bdea0008997298",
        "size":"0.06",
        "ts":1593487696535838711
    }
}

```

当订单信息因为STP(自成交保护)变更，系统会给您推送**update**消息。

由于自成交保护，需要调整订单数量或资金。订单只会在数量或资金上减少。当一个订单size发生变化会向您推送**update**消息。在买卖盘中订单（**open**）和收到**received**消息但没有进入买卖盘的订单，都可能向您推送**update**消息。新的市价单由于自成交保护导致的导致资金变化也会向您推送**update**消息。size为更新后的数量。

### 构建Level-3买卖盘

如何构建本地OrderBook level-3数据

1 使用websocket订阅 /market/level3:{symbol} 频道订阅level3的增量数据，并缓存收到的所有增量数据。

2 通过[REST](#level-3-2)请求获取level3的快照数据。

3 数据检验：获取快照的sequence不小于缓存的所有增量的最小sequence。如果不满足此条件，从第一步从头开始。

4 回放所有缓存的增量数据:

4.1. 如果增量数据的sequence <= 当前快照的sequence，则舍弃增量数据，并结束本次更新; 否则进行4.2。

4.2 如果增量数据的sequence = 当前快照的sequence+1，则进行4.2.1逻辑更新，否则进行4.3步骤。

4.2.1 更新当前快照的sequence为增量数据的sequence. 4.2.2 如果是received消息，结束更新逻辑。（因为现在received消息不影响level3数据） 4.2.3 如果是open消息，增加orderid,price,size构建的相应买单或卖单 4.2.4 如果是done消息，移除对应orderid对应的买单或者卖单 4.2.5 如果是change消息，修改对应orderid对应的买单或者卖单的数量 4.2.6 如果是match消息，减少对应markerOrderId对应的订单数量

4.3 此种情况为sequence不连续，执行步骤2，重新拉取快照数据，以便保证sequence不缺失。

5 接收新的增量数据推送，执行步骤4。

如果您在维护一个本地Level-3买卖盘过程中，有不理解的地方，您可以参考用 Go Language 写的[SDK](https://docs.kucoin.com/cn/#level-nbsp-3)，里面包含了不同type信息的处理逻辑。

<aside class="spacer4"></aside>
<aside class="spacer"></aside>

## 指数价格

```json
{
  "id": 1545910660740,
  "type": "subscribe",
  "topic": "/indicator/index:USDT-BTC",
  "response": true
}
```

Topic: **/indicator/index:{symbol0},{symbol1}...**

订阅此topic，可获取杠杆交易使用的指数价格。

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

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

目前支持的指数价格有：USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 标记价格

```json
{
  "id": 1545910660741,
  "type": "subscribe",
  "topic": "/indicator/markPrice:USDT-BTC",
  "response": true
}
```

Topic: **/indicator/markPrice:{symbol0},{symbol1}...**

订阅此topic，可获取杠杆交易使用的标记价格。

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

目前支持的标记价格有：USDT-BTC, ETH-BTC, LTC-BTC, EOS-BTC, XRP-BTC, KCS-BTC, DIA-BTC, VET-BTC, DASH-BTC, DOT-BTC, XTZ-BTC, ZEC-BTC, BCHSV-BTC, ADA-BTC, ATOM-BTC, LINK-BTC, LUNA-BTC, NEO-BTC, UNI-BTC, ETC-BTC, BNB-BTC, TRX-BTC, XLM-BTC

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 杠杆交易买卖盘变化

```json
{
  "id": 1545910660742,                              
  "type": "subscribe",
  "topic": "/margin/fundingBook:BTC",
  "response": true
}
```

Topic: **/margin/fundingBook:{currency0},{currency1}...**

订阅此topic，可获取杠杆交易借贷买卖盘的变化。

```json
{
	"id": "5c24c5da03aa673885cd67ab",
	"type": "message",
	"topic": "/margin/fundingBook:BTC",
	"subject": "funding.update",
	"data": {

		"sequence": 1000000,       //序列号, 一条消息和上一条线消息的sequence相差1
		"currency": "BTC",         //币种
		"dailyIntRate": "0.00007",   //日利率小数，0.2%返回0.002
		"annualIntRate": "0.12",     //年化利率小数，12%返回0.12
		"term": 7,                 //出借期限(天)
		"size": "1017.5",            //当前总数量，当为0时，从funding-book中删除
		"side": "lend",            //委托方向，目前只支持借出。lend - 借出；borrow - 借入
		"ts": 1553846081210004941  //时间戳(纳秒)
  }
}
```

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


# 私有频道

## 私有订单变更事件

Topic: **/spotMarket/tradeOrders**

该topic将推送所有有关您的订单的变更事件。

**订单状态**

"match": 订单为taker时与买卖盘中订单成交，此时该taker订单状态为match；

"open": 订单存在于买卖盘中；

"done": 订单完成；


### 消息类型


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

订单进入买卖盘时发出的消息。

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
订单成交时发出的消息

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
订单因成交后状态变为DONE时发出的消息

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
订单因被取消后状态变为DONE时发出的消息

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
订单因被修改发出的消息

<aside class="spacer4"></aside>
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 余额变更事件
```json
{
    "type":"message",
    "topic":"/account/balance",
    "subject":"account.balance",
    "channelType":"private",
    "data":{

        "total": "88", //总额
        "available": "88", // 可用余额
        "availableChange": "88", // 可用余额变化值
        "currency": "KCS", // 币种
        "hold": "0", // 冻结金额
        "holdChange": "0", // 可用冻结金额变化值
        "relationEvent": "trade.setted", // 关联事件
        "relationEventId": "5c21e80303aa677bd09d7dff", // 关联事件id
        "relationContext": {

            "tradeId":"5e6a5dca9e16882a7d83b7a4", // 成交了才会有tradeId
            "orderId":"5ea10479415e2f0009949d54",
            "symbol":"BTC-USDT"
        }, // 交易事件的上下文
    "time": "1545743136994" // 时间戳
  }
}

```
Topic: **/account/balance**

当您的账户余额变更时，您会收到详细的账户变更信息。

### Relation Event

类型 | 描述
--------- | -------
main.deposit | 充值入账
main.withdraw_hold | 提现冻结
main.withdraw_done | 提现完成
main.transfer | 储蓄账户转账
main.other | 储蓄账户其他操作
trade.hold | 交易账户冻结
trade.setted | 交易账户入账
trade.transfer | 交易账户转账
trade.other | 交易账户其他操作
margin.hold | 杠杆账户冻结
margin.setted | 杠杆账户入账
margin.transfer | 杠杆账户转账
margin.other | 杠杆账户其他操作
other | 其他操作

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 负债率推送

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"debt.ratio",
    "channelType":"private",
    "data": {

        "debtRatio": 0.7505,                                         //负债率
        "totalDebt": "21.7505",                                      //总负债(转换为BTC的价值)
        "debtList": {"BTC": "1.21","USDT": "2121.2121","EOS": "0"},  //负债列表
        "timestamp": 15538460812100                                  //时间戳(毫秒)
    }
}

```

Topic: **/margin/position**

存在负债时，系统会定时推送当前的负债信息。

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>


## 仓位状态变更事件

```json
{
    "type":"message",
    "topic":"/margin/position",
    "subject":"position.status",
    "channelType":"private",
    "data": {

        "type": "FROZEN_FL",         //事件类型
        "timestamp": 15538460812100  //时间戳(毫秒)
    }
}
```

Topic: **/margin/position**

仓位状态发生变更时，会推送状态变更事件。

事件类型描述：

FROZEN_FL：爆仓冻结。负债率超过爆仓线，仓位冻结时，推送此事件。

UNFROZEN_FL：解除爆仓冻结。爆仓处理完成后，仓位恢复到EFFECTIVE状态时，推送此事件。

FROZEN_RENEW：自动续借冻结。贷款到期，系统自动续借处理，仓位冻结时，推送此事件。

UNFROZEN_RENEW：解除自动续借冻结。自动续借处理完成后，仓位恢复到EFFECTIVE状态时，推送此事件。

LIABILITY：穿仓事件。用户发生穿仓时，推送此事件。

UNLIABILITY：解除穿仓。归还所有负债后，仓位恢复到EFFECTIVE状态时，推送此事件。



<aside class="spacer8"></aside>
<aside class="spacer4"></aside>

## 杠杆交易订单入买卖盘

```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.open",
    "channelType":"private",
    "data": {

        "currency": "BTC",                            //币种
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //订单id
        "dailyIntRate": 0.0001,                       //日利率
        "term": 7,                                    //出借期限(天)
        "size": 1,                                    //借贷数量
        "side": "lend",                               //委托方向，目前只支持借出。lend - 借出；borrow - 借入
        "ts": 1553846081210004941                     //时间戳(纳秒)
    }
}
```

Topic: **/margin/loan:{currency}**

出借订单入买卖盘时向出借方推送。

<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 杠杆交易订单更新

```json
{
    "type": "message",
    "topic": "/margin/loan:BTC",
    "subject": "order.update",
    "channelType":"private",
    "data": {

        "currency": "BTC",                            //币种
        "orderId": "ac928c66ca53498f9c13a127a60e8",   //订单id
        "dailyIntRate": 0.0001,                       //日利率
        "term": 7,                                    //出借期限(天)
        "size": 1,                                    //借贷数量
        "lentSize": 0.5,                              //已借出数量
        "side": "lend",                               //委托方向，目前只支持借出。lend - 借出；borrow - 借入
        "ts": 1553846081210004941                     //时间戳(纳秒)
    }
}

```

Topic: **/margin/loan:{currency}**

借贷撮合成功时向出借方推送。
<aside class="spacer4"></aside>
<aside class="spacer2"></aside>

## 杠杆交易订单完成

```json
{
	"type": "message",
	"topic": "/margin/loan:BTC",
	"subject": "order.done",
    "channelType":"private",
	"data": {

		"currency": "BTC",                            //币种
		"orderId": "ac928c66ca53498f9c13a127a60e8",   //订单id
		"reason": "filled",                           //订单完成原因, 有filled(撮合完成)和canceled(取消)
		"side": "lend",                               //委托方向，目前只支持借出。lend - 借出；borrow - 借入
		"ts": 1553846081210004941                     //时间戳(纳秒)
    }
}
```

Topic: **/margin/loan:{currency}**

出借订单完成时向出借方推送。
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

## 止盈止损事件

Topic: /spotMarket/advancedOrders

Subject: stopOrder


1、当系统收到止盈止损订单时，您将收到一条type为的'open'消息，表示此订单已委托成功并等待触发。

2、当您的止盈止损订单被触发时，您将收到一条type为的'triggered'消息，表示此订单已经被触发。

3、当您的止盈止损订单被取消时，您将收到一条type为的'cancel'消息，表示此订单已被取消。