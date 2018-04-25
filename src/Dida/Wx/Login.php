<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files must retain the above copyright notice.
 */

namespace Dida\Wx;

/**
 * Login
 */
class Login
{
    /**
     * 版本号
     */
    const VERSION = '20180425';


    /**
     * 请求微信登录
     */
    public function login(array $params)
    {
        $url = "https://api.weixin.qq.com/sns/jscode2session";
        $params = [
            "appid"      => $appid,
            "secret"     => $appsecret,
            "js_code"    => $code,
            "grant_type" => "authorization_code",
        ];

        list($err, $msg, $data) = Curl::request([
                "url"   => $url,
                "query" => $params,
        ]);
    }
}
