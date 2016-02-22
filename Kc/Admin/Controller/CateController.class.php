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
    public function index(){
        $cate = new CateModel();
        $cateInfo = $cate->where(['status'=>['NEQ',0]])->select();
        $this->assign("cate",$cateInfo);
        $this->assign('model',get_all_model());

        $this->display();
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
            $this->assign('model',get_all_model());

            $this->display();
        }
    }

    /**编辑栏目
     * @param $id
     */
    public function editCate($id){
        //$this->ajaxreturn(['msg'=>'修改成功'],'JSON');
        //die();
        $cate = new CateModel();
        if(IS_POST){
            //$cate->id = $id;
            $cate->create();
            //$
            //$this->ajaxreturn(['msg'=>$cate->where(['id'=>$id])->save()]);
            if($cate->where(['id'=>$id])->save()){
                //return json_encode(['msg'=>'修改成功','status'=>1]);
                $this->ajaxreturn(['msg'=>'修改成功']);
            }else{
                //return json_encode(['msg'=>'修功','status'=>2]);
                $this->ajaxreturn(['msg'=>$cate->getError()]);
            }

        }else{
            $content = $cate->find($id);
            $checked = json_decode($content['model']);

            $this->assign($content);
            $model = get_all_model();
            foreach($model as $k=>$v){
                if(in_array($v['id'],$checked)){
                    $model[$k]['checked'] = "checked=true";
                }
            }
            $this->assign('model',$model);
            $this->display();
        }

    }
    public function delete($id){
        $cate= new CateModel();
        if($cate->delete($id)){
            return true;
            //$this->ajaxreturn(['msg'=>'已删除','status'=>1]);
        }else{
            return false;
            //$this->ajaxreturn(['msg'=>$cate->getError(),'status'=>2]);
        }
    }

    public function excu(){
        $e =I('post.');
        //$a= json_decode($e);
        //echo $e[0];
        //$cate_atc = D('cate_atc');
        $func= $e['status'];

        $success=0;
        $fail=0;

        foreach($e['val'] as $k=>$v){

            $state = $this->$func($v);
            if ($state) {
                $success++;
                //$this->ajaxReturn($state);
            } else {
                $fail++;
                //$this->ajaxReturn(null);
            }
        }
        //$b= json_encode($a);
        $c=[1,2];
        $alarm = "成功修改".$success."个，失败".$fail."个";
        $this->ajaxReturn($alarm);
    }


}