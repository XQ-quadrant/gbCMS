<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-11
 * Time: 上午4:11
 */

namespace Admin\Model;
use Think\Model;

class AdminModel extends Model
{
    protected $tableName = 'admin';

    public function register($data){
        if($this->add($data)){
            return 'yes';
        }else{
            return $this->getError();
        }
    }

    public function login(){
        //$cookie =  cookie('id');

        $where=array(
            "name"=>I('post.name'),
            "password"=>I('post.password'),
            //"password_hash"=>md5(I('post.password'))
        );
        $rows = $this->where($where)->find();
        //$rows = ['status'=>1,'id'=>2];
       return $rows;
    }

    public function logout(){

    }

}