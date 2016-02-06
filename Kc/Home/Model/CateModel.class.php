<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-11
 * Time: 上午1:05
 */

namespace Home\Model;


use Think\Model;

class CateModel extends Model
{
    protected $fields = array('id', 'name', 'model', 'sub_cate','level','status');

    public $cate='';

    public function __construct($cate ='')
    {
        parent::__construct($name='cate',$tablePrefix='',$connection='');
        $this->cate = $cate;
    }

    public function get(){
        $this->where(['name'=>$this->cate])->field('id','name','model','sub_cate')->find();
    }

    public function getModel($model){
        return json_decode($model);
    }

}