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
use Home\Model\AritcleModel;
use Think\Controller;



class ArticleController extends Controller
{
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

        //var_dump($show);
       /* $Page->setConfig('f_decorate','<li>');
        $Page->setConfig('b_decorate','</li>');*/

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }

    public function detail($mid,$id){
        $modelInfo=get_model_info($mid);  //获取模型信息
        $article = D($modelInfo['name']);
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
            $mid=get_cate_Model($cate)[0]; //获取栏目对应的模型
        }
        $modelInfo=get_model_info($mid);  //获取模型信息

        if(IS_POST){
            $article = D($modelInfo['name']);    //建立模型对象
            //$article = new ArticleModel();
            //$article->id=$id;
        if(!$article->validate($modelInfo['rules'])->validate($modelInfo['rules'])->create()){

                $this->ajaxreturn($article->getError());//;
                //echo $article->getError();
                //$this->ajaxreturn($article->getError());
        }else{

                $article->createtime=date();
                if(!$article->addAtc($cate)){        //提交内容
                    $this->ajaxreturn($article->getError());

                }else{
                    $this->ajaxreturn('添加成功');

                }
            }
        }else{
                $this->display(T($modelInfo['view_edit']));
        }
    }

    /**编辑文章
     * @param $cate
     * @param string $id
     */
    public function editor($cate,$id=''){
        $atcModel=get_document_Model($cate);        //获取模型信息
        D($atcModel['name']);    //建立模型对象

        if(IS_POST){
            $article = new ArticleModel();
            $article->id=$id;
            if(!$article->validate($atcModel['rules'])->create()){             //验证是否合法
                $this->ajaxreturn($article->getError());//;
                //$this->ajaxreturn($article->getError());
            }else{
                $article->status=1;
                if(!$article->save()){        //提交内容
                    $this->ajaxreturn($article->getDbError());
                }
                $this->ajaxreturn('添加成功');
            }
        }else{
            $this->display();
        }
    }

}