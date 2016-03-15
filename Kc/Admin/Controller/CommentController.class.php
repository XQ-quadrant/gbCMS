<?php
/**
 * Created by PhpStorm.
 * User: AndersonKim
 * Date: 2016/3/14
 * Time: 19:09
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Model;

class CommentController extends Controller
{
    public function add_Comment(){


        $_POST['cindex_id']='1123';
        $_POST['user_id']='23';
        $_POST['recieve_id']='31';
        $_POST['content']=null;


        $com   =   D('Comment');
        if($com->create()) {
            $result =   $com->add();
            if($result) {
                $this->success('数据添加成功！','list_Comment');
            }else{
                $this->error('数据添加错误！');
            }
        }else{
            $this->error($com->getError());
        }
    }
    public function delete_Comment(){

        $id=45;

        $com = M("Comment"); // 实例化Comment对象
        $com->where('id='.$id)->delete(); // 删除id为$id的数据

    }
    public function edit_Comment(){

        $id=45;

        $com = M("Comment"); // 实例化Comment对象
        $data=$com->where('id='.$id)->select(); // 选择id为$id的数据

    }

    /**
     * @param $cindex_id
     * @param $user_id
     * @param $receive_id
     * @return mixed
     *
     * *******************instruct***************
     * 1.使用全0参数，显示所有的评论
     * 2.三个参数接口中的任一个传入一参数
     *          $cindex_id
     *          $user_id
     *          $receive_id
     *      则查找指定的cinde_id/user_id/receive_id下的所有评论
     * 3.目前不支持数组形式的参数
     */
    public function list_Comment($cindex_id,$user_id,$receive_id){
        $com=M('Comment');


        if($cindex_id==0&&$user_id==0&&$receive_id==0){
            $com->select();
        }else{
           if(!empty($cindex_id)){
              $com->where('cindex_id='.$cindex_id)->select();
           }elseif(!empty($user_id)){
               $com->where('user_id='.$user_id)->select();
           }elseif(!empty($receive_id)){
               $com->where('receive_id='.$receive_id)->select();
           }
        }
       return $com;
    }
}

