<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-18
 * Time: 下午9:12
 */

namespace Common\Model;


class Wechat
{
    //

//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx304dc5ac6934543d&redirect_uri=http://xq1024.com/kechuang4/index.php/Home/Article/addAtc/cate/10/mid/5&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect


    protected $accessApi    = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx304dc5ac6934543d&secret=e4346a2d12812b8eb4ed808d2e41b97d";
    protected $usertokenApi = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx304dc5ac6934543d&secret=e4346a2d12812b8eb4ed808d2e41b97d&code=%s&grant_type=authorization_code";
    protected $userApi = "https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN";
    protected $accessRefreshApi = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token=REFRESH_TOKEN";
    protected $openId;
    public function getAccessToken($code = '',$tokenAccess=''){
        //$token_access_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx304dc5ac6934543d&secret=e4346a2d12812b8eb4ed808d2e41b97d&code=$code&grant_type=authorization_code";
        //$token_access_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . 'wx304dc5ac6934543d' . "&secret=" . 'B3GVkzGYVfPbgZtFo58l4ynCFXOv0iYjw3JWiMNIJZB'."&code=".$code."&grant_type=authorization_code";
        if(!empty($code)){
            //$this->accessApi = $this->accessApi."&code=".$code."&grant_type=authorization_code";
            $Api = sprintf($this->usertokenApi,$code);
        }else{
            $Api = sprintf($this->accessRefreshApi,$tokenAccess);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Api);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);

        //$res = file_get_contents($token_access_url); //获取文件内容或获取网络请求的内容
        $result = json_decode($res, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
        return $result;
    }

    public function getUserInfo($code){
        $res = $this->getAccessToken($code);
        if($code=''){

        }
        //var_dump($res);
        $this->userApi = sprintf($this->userApi,$res['access_token'],$res['openid']);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->userApi);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        return json_decode($result);
    }

}