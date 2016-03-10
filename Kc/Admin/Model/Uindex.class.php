<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-5
 * Time: 上午3:57
 */

namespace Admin\Model;


use Think\Model;

class Uindex extends Model
{
    protected $tableName = 'uindex';

    /**通用登录
     * @param $mid
     * @return array
     */
    public function login($mid){
        $modelInfo = get_model_info($mid);
        //$this->create();
        $map = I('post.');
        if($modelInfo['status']==3){   //学生登录
            $model = D($modelInfo['identity']);
            $loginInfo = $model->login($map);
            $loginInfo = $this->where(['count'=>$map['count'],'password'=>$map['password']])->find();
            if($loginInfo==null){
                $this->register($mid,$map);
                return ['msg'=>'登录失败，请检查邮箱账号与密码','status'=>2];
            }
            //var_dump($loginInfo);
        }else{
            $loginInfo = $this->where(['email'=>$map['email'],'password'=>$map['password']])->find();
            if($loginInfo==null){
                return ['msg'=>'登录失败，请检查邮箱账号与密码','status'=>2];
            }

        }



        switch($loginInfo["status"]){
            case 1:
                session(['expire'=>3600]);
                session("id" , $loginInfo["id"]);
                session("id" , $mid);
                session("email" , $loginInfo['email']);
                session("status" , $loginInfo['status']);
                session("power",$loginInfo['power']);

                cookie("email",$loginInfo['email'],3600);
                cookie("name",$loginInfo['name'],3600);

                return ['msg'=>$loginInfo['name'].'登录成功','status'=>1];
                break;
            case 2:
                return ['msg'=>"系统已经向{$loginInfo['email']}发送了验证信，请验证。",'status'=>2];
                break;
            case 3:
                ['msg'=>"你的用户资格管理员正在审核中",'status'=>2];
                break;
            default:
                ['msg'=>"登录失败，请检查用户名或邮箱",'status'=>2];
        }

    }

    public function logout(){
            session(null);
            /*session("name",null);
            session("status",null);*/
            cookie(null);
        return 0;
            //$this->redirect('login');
    }

    public function register($mid,$map=[]){
        $modelInfo = get_model_info($mid);
        $model = D($modelInfo['identity']);

        $Info = $model->register($map);
        if(!empty($Info)){
            $this->create($Info);
            $this->mid =$mid;
            return $this->add();
        }
        else{
            $this->error('注册失败');
            return false;
        }

        //$this->count = $Info['user_id'];
       // $this->name = $Info['name'];
        //$this->name = $Info['password'];



    }


}