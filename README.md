# Wechat Login Extension

pyrocms 使用的微信登录插件

## 安装

### 环境要求

php >= 7.0


### 使用 composer 进行该依赖安装

```
composer require "deepdevelop/wechat_login-extension:~0.1"
```

由于 `pyrocms` 的设计中, 需要使用 `-` 来区分 addon 的类型和名称, 所以，如上包的名字为正确设置 

### 进行该插件安装

#### 如果已经安装好了 `pyrocms` , 可考虑使用如下方法进行安装:
	
* `php artisan extension:install deepdevelop.extension.wechat_login`
* `php artisan db:seed --addon=deepdevelop.extension.wechat_login`


#### 如果没安装好 `pyrocms`, 先安装 `pyrocms` 再进行上述插件安装

## 配置说明

.env 中需要进行部分配置, 如下:

| .env 中的 Key | 说明 |
| :---- | ---- |
| `WEIXINWEB_KEY` | **微信开放平台** 中的网页应用的 `app_id` |
| `WEIXINWEB_SECRET` | **微信开放平台** 中的网页应用的 `app_id` |
| `WEIXIN_AUTOLOGIN` | 配置微信内嵌浏览器访问是否直接跳转到登录页面 |


**注意**, **微信开发平台** 地址为: [https://open.weixin.qq.com/](https://open.weixin.qq.com/)

## 使用说明

### 页面渲染微信登录二维码

直接在 `twig` 的 `view` 文件中增加如下代码即可渲染出来, 如下:

```
<div id="login_container"></div>

{{ wechat_login_qr('login_container')|raw }}    
```

### 微信内嵌浏览器跳转登录页面

目前配置了微信内嵌浏览器访问页面后不会跳转, 可通过配置文件手动开启.


* `.env` 配置 `WEIXIN_AUTOLOGIN`, 设置是否开启微信内嵌浏览器跳转功能
* `config/services.php` 增加如下配置

```
    'weixinweb'=> [
        'client_id' => env('WEIXINWEB_KEY'),
        'client_secret' => env('WEIXINWEB_SECRET'),
        'autologin' => env('WEIXIN_AUTO_LOGIN'),
    ],

```

### openid 存储位置

`users stream` 增加 `weixin_openid` 用于存储 **wechat** 的 `openid`
