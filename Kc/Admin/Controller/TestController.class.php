<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-1
 * Time: 下午2:41
 */

namespace Admin\Controller;


use Admin\Model\CateModel;
use Admin\Model\StudentModel;
use Admin\Model\Uindex;
use Common\Model\JiaowuModel;

class TestController extends  CateModel
{
    public function index(){
        //$model =D('picgrid');
        //$model->delete($id);
        $a = [
            'admin'=>['uid'],
            'index'=>['uid','limit_member','already_member','content'],
            //'editor'=>['uid','content','race','limit_member','already_member'],
            //'add'=>[],
        ];
        //echo 'dd';
        echo json_encode($a);
    }

    public function jiao(){
        $a =new StudentModel();
        var_dump($a->login(['count'=>20132195,'password'=>'phibeta']));
    }
    public function jiao2(){
        $a =new Uindex();
        var_dump($a->login(6));
    }
}