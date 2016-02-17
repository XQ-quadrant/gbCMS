<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-19
 * Time: 下午10:32
 */

namespace Admin\Controller;
use Admin\Model\CateModel;
use Think\Controller;
use Think\Crypt\Driver\Think;

class CateController extends Controller
{
    public function _initialize(){
        //$a='oop';
        //tag('cate',$a);
    }

    /**添加栏目
     *
     */
    public function addCate(){
        if(IS_POST){
            //$this->ajaxreturn(['msg'=>I("post.name")]);
            $cate = new CateModel();
            if(!$cate->create()){                     //验证是否合法
                $this->ajaxreturn($cate->getError());//;
                //$this->ajaxreturn($cate->getError());
            }else{
                $cate->model= json_encode($cate->model);
                $cate->status=1;
                if(!$cate->add()){          //插入数据表
                    $this->ajaxreturn($cate->getDbError());
                }
                $this->ajaxreturn('添加成功');
            }

        }else{
            $this->display();
        }
    }

    public function editCate($id){
        $cate = new CateModel();
        if(IS_POST){
            $cate->create();
            $cate->id = $id;
            if($cate->save()){
                $this->ajaxreturn('修改成功');
            }else{
                $this->ajaxreturn($cate->getError());

            }

        }else{
            $content = $cate->find($id);
            $checked = json_decode($content['model']);

            $this->assign($content);
            $model = get_all_model();
            foreach($model as $k=>$v){
                if(in_array($v['id'],$checked)){
                    $model[$k]['checked'] = "checked=\"\"";
                }
            }
            $this->assign('model',$model);
            $this->display();
        }

    }

    public function test(){
        //\Think\Hook::add('action_end','Admin\\Behaviors\\testBehavior');
        //\Think\Hook::add('ad','Admin\\Behaviors\\testBehavior');
        $hook = new \Think\Hook();
        //$hook->listen('action_end');
        $a='oop';
        //tag('ad', $a);
        \Think\Hook::listen('ad'['ss']);
        echo 'dd';
    }

}