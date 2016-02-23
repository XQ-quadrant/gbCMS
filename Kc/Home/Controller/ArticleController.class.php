<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-10
 * Time: 下午11:18
 */

namespace Home\Controller;
use Think\Controller;
//use Home\Model\CateModel;
//use Home\Model;
use Admin\Model\ArticleModel;
use Admin\Model\CateModel;
use Admin\Model\CateAtcModel;
use Home\Model\AritcleModel;


class ArticleController extends Controller
{
    /**
     * @param string $c 栏目标识
     * @param int $p 分页页码
     */
    public function index($c,$p = 0){
        $cate_atc= M('cate_atc');
        $count      = $cate_atc->where(['status'=>1,'cate'=>$cate])->count();
        $Page       = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出

        $list = $cate_atc->where(['cate'=>$cate])->order('createtime')->limit($Page->firstRow.','.$Page->listRows)->select();
        $model = new Model();
        foreach($list as $k=>$v){
            $modelInfo = get_model_info($v['model_id']);  //获每条数据的模型信息
            $raw = $model->query("select author from {$modelInfo['identity']} where id = {$v['atc_id']}");
            $list[$k]['author'] = $raw[0]['author'];
            $d = strtotime($v['createtime']);
            $list[$k]['createtime'] = '<div>'.date("Y/m/d",$d).'</div>'.'<div>'.date("H:i:s",$d).'</div>'; //编辑时间格式
        }
        //var_dump($show);
        /* $Page->setConfig('f_decorate','<li>');
         $Page->setConfig('b_decorate','</li>');*/

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->assign('model_list',get_cate_Model($cate));
        //$this->assign("cate_id",1);
        $this->assign("cate",$cate);

        $this->display();
    }

    public function listView(){

    }

    public function detail(){

    }


}