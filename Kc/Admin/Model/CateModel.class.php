<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-19
 * Time: 下午8:37
 */

namespace Admin\Model;


class CateModel extends BaseModel
{
    protected $tableName = 'cate';

    //protected $patchValidate = true;
    protected $_validate = array(
        //array('verify','require','验证码必须！'), //默认情况下用正则进行验证
        array('name','','栏目名称已经存在！',0,'unique',self::MODEL_INSERT), // 在新增的时候验证name字段是否唯一
        //array('model',array(0,1,2,3),'值的范围不正确！',2,'in',3), // 当值不为空的时候判断是否在一个范围内
        //array('sub_cate','isJson','下级栏目错误',0,'function',), //
        array('pre_cate','require','上级栏目错误',0,'',3), //
        array('level',[0,255],'优先级错误',0,'between'), // 自定义函数验证密码格式
    );

    public function getAll(){
        return $this->where(['status'=>1])->select();
    }




}