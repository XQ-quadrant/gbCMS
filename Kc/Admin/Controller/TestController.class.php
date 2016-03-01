<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-1
 * Time: 下午2:41
 */

namespace Admin\Controller;


class TestController
{
    public function index($id =46){
        $model =D('picgrid');
        $model->delete($id);
    }
}