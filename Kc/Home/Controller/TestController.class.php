<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-19
 * Time: 下午7:41
 */

namespace Home\Controller;


use Common\Model\StudentModel;
use Common\Model\UindexModel;
use Common\Model\Wechat;
use Think\Controller;

class TestController extends Controller
{
    public function openid(){
        /*if (isset($_GET['code'])){
            echo $_GET['code'];
        }else{
            echo "NO CODE";
        }*/
        if(!empty(I('get.code'))){
            //echo I('get.code');
            $wechat = new Wechat();//Wechat();  //微信对象
            $wechatInfo = $wechat->getUserInfo(I('get.code'));   //获取用户微信信息

            $info['openid'] = $wechatInfo->openid;
            $info['headimgurl'] = $wechatInfo->headimgurl;
            echo $info['openid'];
            echo $info['headimgurl'];
            //echo "<img src='".$info['headimgurl']."'>";
            /*array(5) {
                ["access_token"]=> string(150) "OezXcEiiBSKSxW0eoylIeC3gXGeMTQrl0ueaMcRpnBLwYhP50uNT6NyCAOpqFj7PymF9-LWYyndDD-OluN-cDcQofPIyyh0_8qGKmINN2NQqBupCC_JTXrmGKMGnk0gbdqPSmEGEIeE4beWEbILrAg"
                ["expires_in"]=> int(7200)
                ["refresh_token"]=> string(150) "OezXcEiiBSKSxW0eoylIeC3gXGeMTQrl0ueaMcRpnBLwYhP50uNT6NyCAOpqFj7PnVIIFyCy07YBViZ5ZvjUZEWC090ywJTkOsL5L3U-c-V1eKnxa9sB1mchiMo2yo-u7uRwYGSy5GkrG_32TI0Huw"
                ["openid"]=> string(28) "o5V6pjt_l0Rm5jYvdc_WhXPUCtms"
                ["scope"]=> string(15) "snsapi_userinfo"
            }
            string(300) "{"openid":"o5V6pjt_l0Rm5jYvdc_WhXPUCtms","nickname":"XQ-1024","sex":1,"language":"zh_CN","city":"成都","province":"四川","country":"中国","headimgurl":"http:\/\/wx.qlogo.cn\/mmopen\/QSzZwca5a6tLd3hEiby4BrElcRXPYHHITdNqhtT83PcaLnH91F92yojibely5cibo7u4Fy89oia9Vr9uFnpcTSiaicGg\/0","privilege":[]}" {{hha*/

        }
        //echo "hha";
    }
    public function register(){
        $u = new UindexModel();
        echo $u->register(6,['count'=>'20132195','password'=>'phibeta']);
        //$s =new StudentModel();
        //$s->register(['user_id'=>'20132195','password'=>'phibeta']);
    }

}