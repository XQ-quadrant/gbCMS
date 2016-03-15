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
    public function profile($id){
        $uindex = new UindexModel();
        $uindexInfo = $uindex->find($id);
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