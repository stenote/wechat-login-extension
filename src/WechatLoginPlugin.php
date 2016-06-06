<?php

namespace Deepdevelop\WechatLoginExtension;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Illuminate\Config\Repository as ConfigRepository;

class WechatLoginPlugin extends Plugin
{
    protected $config;
    protected $url;

    public function __construct(ConfigRepository $config, UrlGenerator $url)
    {
        $this->config = $config;
        $this->url = $url;
    }

    public function getFunctions()
    {
        return [
            /*
             * {{ wechat_login_qr('#qr_container_id') }}
             */
            new \Twig_SimpleFunction('wechat_login_qr', function ($container_id) {
                return strtr('
                <script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
                <script type="text/javascript">
                    var obj = new WxLogin({
                        id:"%container_id",
                        appid: "%appid",
                        scope: "snsapi_login",
                        redirect_uri: "%redirect_uri"
                    });
                </script>', [
                    '%container_id' => $container_id,
                    '%appid' => $this->config->get('services.weixinweb.client_id'),
                    '%redirect_uri' => $this->url->to('wechat/login'),
                ]);
            }),
        ];
    }
}
