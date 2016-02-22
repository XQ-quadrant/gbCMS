<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-10
 * Time: 下午11:18
 */

namespace Admin\Controller;
use Admin\Model\ArticleModel;
use Admin\Model\CateModel;
use Admin\Model\CateAtcModel;
use Home\Model\AritcleModel;
use Think\Controller;
use Think\Model;


class ArticleController extends Controller
{
    public $cate_id = 1;
    /*public function _initialize(){
        $this->assign("cate_id",$this->cate_id);
    }*/

    public function index($cate,$id){
        //$article =
        //$this->display();
    }

    public function listView($cate){
        $cate_atc= M('cate_atc');
        $count      = $cate_atc->where('status=1')->count();
        $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $list = $cate_atc->where(['cate'=>$cate])->order('createtime')->limit($Page->firstRow.','.$Page->listRows)->select();
        $model = new Model();
        foreach($list as $k=>$v){
            $modelInfo = get_model_info($v['mid']);
            $raw = $model->query("select author from {$modelInfo['identity']} where id = {$v['atc_id']}");
            $list[$k]['author'] = $raw[0]['author'];
            $d = strtotime($v['createtime']);
            $list[$k]['createtime'] = '<div>'.date("Y/m/d",$d).'</div>'.'<div>'.date("h:i:s A",$d).'</div>';
        }
        //var_dump($show);
       /* $Page->setConfig('f_decorate','<li>');
        $Page->setConfig('b_decorate','</li>');*/

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->assign('model_list',get_all_model($this->cate_id));
        $this->assign("cate_id",1);
        $this->display();
    }

    public function detail($mid,$id){
        $modelInfo=get_model_info($mid);  //获取模型信息
        $article = D($modelInfo['identity']);
        //$article->id = $id;
        $atcInfo = $article->detail($id);
        if(!is_array($atcInfo)){
            //$this->error($atcInfo);
            //$this->ajaxreturn($article->getDbError());
        }
        $atcInfo['content']=htmlspecialchars_decode($atcInfo['content']);

        $this->assign($atcInfo);
        //var_dump($atcInfo);
        //var_dump($article->getError());
        $this->display(T($modelInfo['view_detail']));
    }

    /**
     * 文档控制台
     * @param $cate
     */
    public function admin($cate){
        $cateInfo = new CateModel();
    }

    /**
     * 添加文章
     * @param $cate 栏目
     * @param $mid  文档模型
     */
    public function addAtc($cate=1,$mid=''){
        if($mid==''){
            $mid=get_cate_Model($cate)[0]['id']; //获取栏目对应的模型
        }
        $modelInfo=get_model_info($mid);  //获取模型信息

        if(IS_POST){
            $article = D($modelInfo['identity']);    //建立模型对象

        if(!$article->validate($modelInfo['rules'])->create()){

                $this->ajaxreturn(['msg'=>$article->getError(),'status'=>2]);//;

        }else{
            //$this->ajaxreturn('dfs');
                $article->createtime=date();
                if(!$article->addAtc($cate)){        //提交内容
                    $this->ajaxreturn(['msg'=>$article->getError(),'status'=>2]);

                }else{
                    $this->ajaxreturn(['msg'=>'添加成功','status'=>1]);

                }
            }
        }else{
                $this->display(T($modelInfo['view_add']));
        }
    }

    public function delete($id){
        $index_atc = D('cate_atc');
        if($index_atc->delete_h($id)){
            $this->ajaxreturn(['msg'=>'已删除','status'=>1]);
        }else{
            $this->ajaxreturn(['msg'=>$index_atc->getError(),'status'=>2]);
        }
    }


    /**编辑文章
     * @param $id
     * @param string $id
     */

    public function editor($id){
        $cate_atc = new CateAtcModel();//D('cate_atc');
        //$atcInfo = $cate_atc->find($id);
        $atcInfo = $cate_atc->field("id,title,model_id,cate,atc_id,views,status,createtime")->find($id);//cate_atc_get($id);     //获取文档目录信息
        $model = get_model_info($atcInfo['mid']); //获取模型信息
        $atc = D($model['identity']);    //建立模型对象

        if(IS_POST){
            //var_dump($cate_atc->create());



            //$article = new ArticleModel();
            $c = $atc->create();
            $d = $cate_atc->create();
            if(!$c&&!$d){             //验证是否合法
                $this->ajaxreturn(['msg'=>$atc->getError(),'status'=>2]);//;
                //$this->ajaxreturn($article->getError());
            }else{
                //$atc->linkSet();
                $atc->id = $atcInfo['atc_id'];
                $cate_atc->id = $id;
                //$atc->status=1;
                //
                $a = $cate_atc->where(['id'=>$cate_atc->id])->save();
                $b = $atc->where(['id'=>$atc->id])->validate($model['rules'])->save();
                if(!$a&&!$b){        //提交内容
                    $this->ajaxreturn(['msg'=>$atc->getError().$cate_atc->getError(),'status'=>2]);
                }
                $this->ajaxreturn(['msg'=>'修改成功','status'=>1]);
            }
        }else{

            //$atc->query("select author,editor, content from ")
            $atcInfo = array_merge($atcInfo, $atc->field("author,editor,content")->find($atcInfo['atc_id']));
            $this->assign($atcInfo);
            $this->display($model['view_edit']);
        }
    }

    public function excu(){
        $e =I('post.');
        //$a= json_decode($e);
        //echo $e[0];
        $cate_atc = D('cate_atc');
        $func= $e['status'];    //当前控制器操作函数

        $success=0;
        $fail=0;

        foreach($e['val'] as $k=>$v){

            $state = $cate_atc->$func($v);
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