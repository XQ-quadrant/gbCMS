<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-19
 * Time: 下午3:03
 */

namespace Home\Controller;


use Common\Model\Wechat;
use Think\Controller;

class WechatController extends Controller
{
    public function wechatEntre($uri,$code){
        $w  = new Wechat();
        $winfo = $w->getAccessToken($code);
        $this->redirect($uri,['openid'=>$winfo['openid']]);

    }

}