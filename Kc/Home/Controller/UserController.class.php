<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-15
 * Time: 上午1:21
 */

namespace Home\Controller;


use Admin\Model\UindexModel;
use Think\Controller;

class UserController extends Controller
{

    private $mid = 6;
    private $openid ;
    private $data =[] ;

    public function _initialize(){
        if(isset($_GET['cate'])){
            $cateInfo = get_cate($_GET['cate']);
            $this->assign('cateName',$cateInfo['name']);
        }

        if(!empty($_GET['code'])){
            $wechat = new Wechat();    //微信对象
            $wechatInfo = $wechat->getAccessToken(I('get.code'));   //获取用户微信openid
            $this->openid = $wechatInfo['openid'];
            $this->assign('openid',$this->openid);
        }

        if(!empty($_GET['openid'])){
            $this->openid = $_GET['openid'];
            $this->assign('openid',$this->openid);
        }
        $this->data = I('post.')+I('get.');

    }

    public function profile($id=0){
        $uindex = new UindexModel();
        //$uindexInfo = $uindex->find($id);
        if(!empty($_GET['id'])&& $id!=0){     //按id查询
            $uindexInfo = $uindex->find($id);
            $modelInfo = get_model_info($uindexInfo['mid']);
            $user = D($modelInfo['identity']);
            $userInfo = $user->find($uindexInfo['uid']);
            $this->assign($userInfo);
            $this->assign('id',$id);
            $this->display();
        }
        elseif(!empty($this->openid)){     //按openid查询
            $uindexInfo = $uindex->where(['openid'=>$this->openid])->find();
            $modelInfo = get_model_info($uindexInfo['mid']);
            $user = D($modelInfo['identity']);
            $userInfo = $user->find($uindexInfo['uid']);
            $this->assign($userInfo);
            $this->display('myProfile');
        }else{
            $this->redirect("/Home/Enter/login/mid/6");
        }


    }


    public function alter($id = 0)
    {
        $modelInfo = get_model_info($this->mid);
        $user = D($modelInfo['identity']);    //建立模型对象
        //$user->id = $id;
        //$this->ajaxReturn(['msg'=>"fsd",'status'=>2]);

        if (IS_POST) {
            if (!$user->validate($modelInfo['rules'])->create()) {
                $this->ajaxreturn(['msg'=>$user->getError(),'status'=>2]);   //反馈验证错误信息

            } else {
                $reInfo = $user->alter($id);  //模型实际操作方法
                $this->ajaxReturn(['msg'=>$reInfo,'status'=>1]);
            }

        } else {
            $userData = $user->getData($id);
            $this->assign($userData);
            $this->assign('mid', $modelInfo['id']);
            $this->display();

        }
    }

}