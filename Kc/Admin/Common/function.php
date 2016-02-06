<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-27
 * Time: 上午12:36
 */
use Admin\Model\CateModel;

function getAllCate(){
    $cate = new CateModel();
    $cateArray = $cate->where(['status'=>1])->order('pre_cate desc')->select();

    function sortCate()  //栏目排序，栏目的子栏目作为其数组子元素
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
    }
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
    //$this->ajaxreturn($cateArray);
    return $cateArray;
    /*foreach($cateArray as $k=>$v){
        if(empty($v['sub_cate'])) $v['sub_cate'] = 0;

        if($v['pre_cate'] != 0){

            if($cate[$v['pre_cate']]['sub_cate']==0){

            }
            $cate[$v['pre_cate']]['sub_cate'] = $v;
        }
    }*/
}
