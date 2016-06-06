<?php

namespace Deepdevelop\WechatLoginExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class WechatLoginExtensionServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        'Deepdevelop\WechatLoginExtension\WechatLoginPlugin',
    ];

    protected $routes = [
        'wechat/callback' => 'Deepdevelop\WechatLoginExtension\Http\Controller\WechatLoginController@callback',
        'wechat/login' => 'Deepdevelop\WechatLoginExtension\Http\Controller\WechatLoginController@login',
    ];

    protected $middleware = [
        'Deepdevelop\WechatLoginExtension\Http\Middleware\WechatLogin',
    ];

    protected $listeners = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\WeixinWeb\WeixinWebExtendSocialite@handle',
        ],
    ];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [
        \SocialiteProviders\Manager\ServiceProvider::class,
    ];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }
}
