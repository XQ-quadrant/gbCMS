<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-1-17
 * Time: 下午5:27
 */

/**
 * 获取文档模型信息
 * @param $cateName 栏目名称||栏目编号
 * @return mixed
 */
function get_cate($cateName){
    $cate= new \Admin\Model\CateModel();
    if(is_numeric($cateName)){
        $row = $cate->where(['id'=>$cateName])->find();
    }else{
        $row = $cate->where(['cindex'=>$cateName])->find();
    }
    $row['model'] = json_decode($row['model']);
    $model = new M('model');
    $modelName = $model->field('name')->where(['id'=>['IN',$row['model']]])->select();  //查询模型名称列表
    $row['model'] =$modelName;
    return $row;
    //return ['name'=>'Article'];
}

/**获取栏目对应模型的名称
 * @param int $cate 栏目名称
 * @return mixed 模型名称数组
 */
function get_cate_Model($cate=1){
    $cateModel= new \Admin\Model\CateModel();   //带增加根据唯一标识获取信息
    $row = $cateModel->field('model')->where(['id'=>$cate])->find();
    $modelArray = json_decode($row['model']);
    return $modelArray;

}

/**获取模型信息
 * @param $mid
 * @return mixed
 */
function get_model_info($mid){  //带增加根据唯一标识获取信息
    $model = D('model');
    $model->id=$mid;
    return $model->find();
}