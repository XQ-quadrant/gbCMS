<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-10
 * Time: 下午11:18
 */

namespace Home\Controller;
use Think\Controller;
use Home\Model\CateModel;
use Home\Model;
class ArticleController extends Controller
{
    /**
     * @param string $c 栏目标识
     * @param int $p 分页页码
     */
    public function index($c,$p = 0){

        $cate = new CateModel();
        $cate->cate=$c;
        $cateInfo = $cate->find();
        //$cate->getModel($cateInfo['model']);
        //$cate->where(['name'=>$c])->find();
        //$articles = new
        $modelName ='Model\\'.$cateInfo['model'].'Model';
        $articles= new $modelName();

        //$articles->where(['cate'=>$c])->select();


        $list = $articles->where(['status'=>1,'cate'=>$c])->order('create_time desc')->page($p.',15')->select(); //查询模型中对应栏目文章信息
        $this->assign('articles',$articles);//

        $count      = $articles->where(['status'=>1,'cate'=>$c])->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,15);
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出


        $this->display();

    }

    public function listView(){

    }

    public function detail(){

    }


}