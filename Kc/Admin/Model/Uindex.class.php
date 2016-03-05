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

    public function login($mid){
        $modelInfo = get_model_info($mid);
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

    }

}