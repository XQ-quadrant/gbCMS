<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-15
 * Time: 上午1:21
 */

namespace Admin\Controller;


use Admin\Model\UindexModel;
use Think\Controller;

class UserController extends Controller
{
    private $power = 1;
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

    public function profile($index){
        $uindex = new UindexModel();
        //$uindexInfo = $uindex->find($id);
        if(!empty($_GET['id'])){     //按id查询
            $uindexInfo = $uindex->find($index['id']);        }
        elseif(!empty($this->openid)){     //按openid查询
            $uindexInfo = $uindex->where(['openid'=>$this->openid])->find();
        }else{
            $this->redirect("/Home/Enter/login/mid/6");
        }

        $modelInfo = get_model_info($uindexInfo['mid']);
        $user = D($modelInfo['identity']);
        $userInfo = $user->find($uindexInfo['uid']);
        $this->assign($userInfo);
        $this->display();
    }

    public function listView($mid,$status = 1){
        $cate_atc= new UindexModel();
        $count      = $cate_atc->where(['status'=>$status,'mid'=>$mid])->count();

        $Page       = new \Think\Page($count,16);    // 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();   // 分页显示输出

        $list = $cate_atc->where(['mid'=>$mid])->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();

       /* $cateInfo = get_cate($cate);  //获取栏目信息
        $reList =[];
        //$yList = &$list;
        foreach($cateInfo['model'] as $k=>$v){
            //var_dump($v);*/
            $modelInfo = get_model_info($mid);
            $model = D($modelInfo['identity']);            //建立内容模型对象
            $reList = array_merge($list,$model->listView($list,$modelInfo));  //合并
       // }


        $this->assign('page',$show);
        $this->assign('list',$reList);
        //$this->assign('model_list',get_cate_Model($cate));
        //$this->assign("cate_id",1);
        //$this->assign("cate",$cate);

        $this->display();
    }


    public function register($mid){
        $modelInfo = get_model_info($mid);

        if(IS_POST){
            //$data =I('post.');
            $user = D($modelInfo['identity']);    //建立模型对象
            if(!$user->validate($modelInfo['rules'])->create()){
                $this->ajaxreturn($user->getError());   //反馈验证错误信息
            }else {
                $reInfo = $user->register();  //模型实际操作方法
                $this->ajaxReturn($reInfo);
            }
            /*$reInfo = $user->login();


            $this->ajaxReturn($reInfo);



            //$adminer= new AdminModel();
            //$adminer->create();
            //$adminer->status=2;
            $AddInfo = $adminer->register();
            //var_dump($data);
            return $AddInfo;
            //$this->display();*/
        }else{
            $this->assign('mid',$modelInfo['id']);
            $this->display($modelInfo['view_add']);
        }

    }

}