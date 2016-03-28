<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-27
 * Time: 上午2:06
 */

namespace Admin\Model;


use Think\Model;

class ShortModel extends Model
{
    public function addComment($id){
        $this->uid = session('id');
        $this->createtime = date('Y-m-d H-i-s');
        $this->atc_id = $id;
        $userInfo =  get_user_info(['id'=>$this->uid]);
        $this->uname = $userInfo['name'];
        $sid=$this->add();
        if($sid!=null){
            return ['msg'=>"评论成功",'status'=>1,'id'=>$sid];
        }else{
            return ['msg'=>"sorry,出问题了orz",'status'=>1,'id'=>$sid];
        }

    }


}