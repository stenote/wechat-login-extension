<?php namespace Deepdevelop\WechatLoginExtension\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Jenssegers\Agent\Agent;

/**
 * Class WeixinAuthorize
 *
 * @link          http://www.deepdevelop.com/
 * @author        Deepdevelop, Inc. <hello@deepdevelop.com>
 * @author        Rui Ma <xjmarui@gmail.com.com>
 * @package       Deepdevelop\UsersExtension\Http\Middle
 */
class Authorize
{

    /**
     * The redirect utility.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * Create a new AuthorizeModuleAccess instance.
     *
     * @param Redirector $redirect
     */
    public function __construct(Redirector $redirect)
    {
        $this->redirect   = $redirect;
    }

    /**
     * Check the authorization of module access.
     *
     * @param  Request  $request
     * @param  \Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        //还没有去进行 weixin 那边请求
        //用的微信的内嵌浏览器访问的页面
        //不是请求 weixin/login

        if (
            ! $request->session()->has('wechat_requested')
            &&
            strpos($agent->getUserAgent(), 'MicroMessenger') !== false
            &&
            $request->path() != 'wechat/login'
        ) {
            return $this->redirect->to('wechat/login');
        }

        return $next($request);
    }
}
