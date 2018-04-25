<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files must retain the above copyright notice.
 */

namespace Dida\WX;

/**
 * 业务数据的加解密操作
 */
class BizDataCrypt
{
    /**
     * 版本号
     */
    const VERSION = '20180425';

    /**
     * appid 申请微信号或者小程序号时可获得
     *
     * @var string
     */
    private $appid;
    private $session_key;


    public function __construct($appid, $session_key)
    {
        $this->appid = $appid;
        $this->session_key = $session_key;
    }
}
