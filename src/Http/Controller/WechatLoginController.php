<?php namespace Deepdevelop\WechatLoginExtension\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\BaseController;
use Laravel\Socialite\Facades\Socialite;
use Anomaly\UsersModule\User\UserAuthenticator;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

class WechatLoginController extends BaseController
{
    public function callback(UserRepositoryInterface $users, UserAuthenticator $authenticator)
    {

        $mockUser =  Socialite::with('weixinweb')->user();
        if ($mockUser) {

            $openid = $mockUser->id;

            $user = $users->findByWeixinOpenid($openid);

            if ($user) {
                $authenticator->login($user);
                return redirect()->to('/');
            } else {
                // 存储 weixin_user_openid
                $this->request->session()->set('weixin_user_openid', $openid);
                return redirect()->to('register');
            }
        }
        // something wrong ~
	return abort(500);
    }

    public function login()
    {
        $this->request->session()->set('wechat_requested', true);
        return Socialite::with('weixinweb')->redirect();
    }
}
