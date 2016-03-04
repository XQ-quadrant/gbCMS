<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-11
 * Time: 上午4:11
 */

namespace Admin\Model;
use Think\Model;

class ManagerModel extends Model implements User
{
    protected $tableName = 'manager';
    //protected $mid = '4';

    public function register(){

        $uid = $this->add();

        if($uid){

            $uindex = D('uindex');
            $uindex->create();
            $uContent =[$uid,I('get.mid'),date('y-m-d H:i:s'),3,1];
            list($uindex->uid,
                $uindex->mid,
                $uindex->createtime,
                $uindex->power,
                $uindex->status
                ) = $uContent;
            /*$uindex->uid = $uid;
            $uindex->mid = $this->tableName ;
            //$cate_atc->title = $title ;
            $uindex->createtime = date('y-m-d H:i:s') ;
            $uindex->power = 3;
            $uindex->status=1;*/
            if($uindex->add()){
                //return true;
            }else{
                $this->delete($uid);
                $this->error='添加失败';
                return ['msg'=>"添加成功",'status'=>2];
            }
            return ['msg'=>"添加成功",'status'=>1];
        }else{
            return ['msg'=>"添加成功",'status'=>2];//$this->getError();
        }
    }

    /**
     * @return mixed ajax反馈信息
     */
    public function login(){
        //$cookie =  cookie('id');
        $loginInfo = $this->find();

        switch($loginInfo["status"]){
            case 1:
                session("id",$loginInfo["id"]);
                session("name",I('post.name'));
                session("status",$loginInfo['status']);
                cookie("name",I('post.name'));

                return ['msg'=>"waiting",'status'=>1];
                break;
            case 2:
                return ['msg'=>"系统已经向{$loginInfo['email']}发送了验证信，请验证。",'status'=>1];
                break;
            case 3:
                ['msg'=>"你的用户资格管理员正在审核中"];
                break;
            default:
                ['msg'=>"登录失败，请检查用户名或邮箱"];
        }
        /*if ($loginInfo["status"]==1){//登录成功

            session("id",$loginInfo["id"]);
            session("name",I('post.name'));
            session("status",$loginInfo['status']);
            cookie("name",I('post.name'));

            return "登录成功";
            //$this->ajaxReturn($loginInfo);

        }elseif ($loginInfo["status"]==2){
            $this->ajaxReturn(['msg'=>"系统已经向{$loginInfo['user_email']}发送了验证信，请验证。"]);
        }elseif ($loginInfo["status"]==3){
            $this->ajaxReturn(['msg'=>"你的用户资格管理员正在审核中"]);
        }else{

            $this->ajaxReturn(['msg'=>"登录失败，请检查用户名或邮箱"],'JSON');
        }

        $where=array(
            "name"=>I('post.name'),
            "password"=>I('post.password'),
            //"password_hash"=>md5(I('post.password'))
        );
        $rows = $this->where($where)->find();
        //$rows = ['status'=>1,'id'=>2];
       return $rows;*/
    }

    public function logout(){

    }

}