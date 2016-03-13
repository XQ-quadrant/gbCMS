<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-20
 * Time: 下午6:56
 */

namespace Home\Behaviors;
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

    //public $ul_class= "nav";
    //public $ul_id= "side-menu";
    public $css= ['class'=>"nav",'id'=>'side-menu']; //<ul>的 css

    public function __construct()
    {
        $this->model= new Model();
        //parent::construct();
    }

    // 行为扩展的执行入口必须是run
    /**
     * @param mixed $params
     */
    public function run(&$params)
    {
        echo $this->cateNav($this->catelist());

    }



    /**获取栏目排序数组
     * @param int $pre_cate
     * @return mixed
     */
    public function catelist($pre_cate =0){

        $cateArray = $this->model->query("select id,`name`,pre_cate,uri from cate WHERE pre_cate=$pre_cate AND status=4 ORDER BY `LEVEL`");//$cate->where(['$pre_cate'=>$pre_cate])->select();
        //$this->cateList = $cateArray;
        foreach( $cateArray as $v=>$k){
            //echo $v['id'];
            $cateArray[$v]['next_cate'] = $this->catelist($k['id']);
        }
        return $cateArray;
    }

    /**栏目数组进行html转换
     * @param $list
     * @return string
     */
    public function cateNav($list,$css){
        if(empty($css)){
            $css=$this->css;
        }
        $cssStr="";
        foreach($css as $k=>$v){
            $cssStr.=$k.'='."\"$v\" ";
        }
        $ul ="<ul $cssStr >\n";
        foreach($list as $v=>$k){
            $ul.="<li>\n<a href=\"{$k['uri']}\">".$k['name'];
            if(!empty($k['next_cate'])){
                $ul.= "<span class=\"fa arrow\"></span></a>\n";
                /*if($this->css['class']=='nav'){
                    $this->css['class'] = "nav nav-second-level";
                }
                if($this->css['id']=='side-menu'){
                    $this->css['id'] = "";
                }*///class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;
                $ul.=$this->cateNav($k['next_cate'],['class'=>"nav nav-second-level"]);
            }else{
                $ul.= "</a>\n";
            }
            $ul.= "</li>\n";
        }
        $ul.= "</ul>\n";
        return $ul;
    }
}