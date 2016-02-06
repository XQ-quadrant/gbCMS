<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-20
 * Time: 下午6:56
 */

namespace Admin\Behaviors;


class testBehavior
{
    // 行为参数定义
    protected $options   =  array(
        'TEST_PARAM'        => true,   //  行为参数 会转换成TEST_PARAM配置参数
    );
    // 行为扩展的执行入口必须是run
    public function run(&$params)
    {
        //echo 'll';
        echo $params;
       /* if (C('TEST_PARAM')) {
            echo 'RUNTEST BEHAVIOR ' . $params;
        }*/
    }
}