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
 * Wx
 */
class Wx
{
    /**
     * 版本号
     */
    const VERSION = '20180428';

    /**
     * appid 申请微信号或者小程序号时可获得
     *
     * @var string
     */
    protected $appid;
    protected $sessionKey;


    /**
     * 检验数据的真实性，并且获取解密后的明文。
     * （参照了微信官方的示例文档，但对变量名按照Dida的命名规则进行了调整）
     *
     * @param $encryptedData string 业务数据的密文
     * @param $iv string 与用户数据一同返回的加密初始向量
     * @param $data string 解密后的原文
     *
     * @return array [$code, $msg, $data]，成功返回的code为0
     */
    public function decryptData($encryptedData, $iv)
    {
        // 检查sessionKey是否合法
        if (strlen($this->sessionKey) != 24) {
            return WxError::$IllegalAESKey;
        }
        $aesKey = base64_decode($this->sessionKey);

        // 检查IV向量是否合法
        if (strlen($iv) != 24) {
            return WxError::$IllegalIV;
        }
        $aesIV = base64_decode($iv);

        // 生成密文序列
        $aesCipher = base64_decode($encryptedData);

        // 用AES算法解密
        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        // 如果解密失败
        $dataObj = json_decode($result);
        if ($dataObj == NULL) {
            return WxError::$IllegalBuffer;
        }

        // 比对解密出来的appid和当前的appid是否一致，不一致则表明数据被篡改
        if ($dataObj->watermark->appid != $this->appid) {
            return WxError::$IllegalWatermark;
        }
        $data = $result;

        // 返回正确的数据
        return [0, null, $data];
    }
}
