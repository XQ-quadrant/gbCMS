<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-20
 * Time: 下午6:56
 */

namespace Admin\Behaviors;
use Admin\Model\CateModel;
use Think\Behavior;
use Think\Model;

class CateBehavior extends Behavior
{
    // 行为参数定义
    protected $options   =  array(
        'TEST_PARAM'        => true,   //  行为参数 会转换成TEST_PARAM配置参数
    );
    //protected $cateList  =  [];
    protected $model ;

    public $ul_class= "nav";
    public $ul_id= "side-menu";
    public $css= ['class'=>"side-menu",'id'=>'side-menu'];

    public function __construct()
    {
        $this->model= new Model();
        //parent::construct();
    }

    // 行为扩展的执行入口必须是run
    public function run(&$params)
    {
        echo $this->cateNav($this->catelist());
        //header('charset:utf-8');
        //return $this->catelist();
       /* if (C('TEST_PARAM')) {
            echo 'RUNTEST BEHAVIOR ' . $params;
        }*/
    }

    public function getAllCate(){
        $cate = new CateModel();
        //$cateArray = $cate->where(['status'=>1])->order('pre_cate desc')->select();

       /* function sortCate($pid = 0)  //栏目排序，栏目的子栏目作为其数组子元素
        {
            global $cateArray;
            foreach($cateArray as $k=>$v){
                $preCate = $v['pre_cate'];
                if($preCate!=0){
                    $cate_id = $preCate;
                    while($cateArray[$cate_id]['id']!=$preCate){
                        $cate_id++;
                    }
                    $cateArray[$cate_id]['sub_cate']=$v;
                }
            }
        }*/

        function catelist($pre_cate =0){
            $cate = new CateModel();
            global $cateArray;
            $cateArray = $cate->where(['$pre_cate'=>$pre_cate])->select();

            foreach($cateArray as $v=>$k){

                $k['next_cate'] = catelist($k['id']);
            }
            return $cateArray;
        }
        return catelist();
        //sort($cateArray,0);
        /*function PreCateSet(int $n){
            $cateArray=[];
            if($cateArray[$n]['pre_cate']!=0){
                $cateArray[$cateArray[$n]['pre_cate']]['sub_cate']= $cateArray[$n];
                return getPreCate($cateArray[$n]['pre_cate']);
            }else{
                return 0;

            }
        }*/
        $this->ajaxreturn($cateArray);

        /*foreach($cateArray as $k=>$v){
            if(empty($v['sub_cate'])) $v['sub_cate'] = 0;

            if($v['pre_cate'] != 0){

                if($cate[$v['pre_cate']]['sub_cate']==0){

                }
                $cate[$v['pre_cate']]['sub_cate'] = $v;
            }
        }*/
    }
    public function catelist($pre_cate =0){

        $cateArray = $this->model->query("select id,`name`,pre_cate,uri from cate WHERE pre_cate=$pre_cate AND status=1 ORDER BY `LEVEL`");//$cate->where(['$pre_cate'=>$pre_cate])->select();
        //$this->cateList = $cateArray;
        foreach( $cateArray as $v=>$k){
            //echo $v['id'];
            $cateArray[$v]['next_cate'] = $this->catelist($k['id']);
        }
        return $cateArray;
    }

    public function cateNav($list){
        $ul ="<ul class={$this->css['class']} id={$this->css['id']} >";
        foreach($list as $v=>$k){
            $ul.="<li><a href={$k['uri']}><i class=\"fa fa-laptop nav_icon\"></i>".$k['name'];
            if(!empty($k['next_cate'])){
                if($this->css['class']=='nav'){
                    $this->css['class'] = "nav nav-second-level";
                }
                if($this->css['id']=='side-menu'){
                    $this->css['id'] = "";
                }
                $ul.=$this->cateNav($k['next_cate']);
            }
            $ul.= "</a></li>";
        }
        $ul.= "</ul>";
        return $ul;
    }
}