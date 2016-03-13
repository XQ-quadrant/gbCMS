<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-1
 * Time: 下午2:41
 */

namespace Admin\Controller;


use Admin\Model\CateModel;
use Admin\Model\ManagerModel;
use Admin\Model\NewsModel;
use Admin\Model\StudentModel;
use Admin\Model\TeamModel;
use Admin\Model\Uindex;
use Common\Model\JiaowuModel;
use Common\Model\UindexModel;
use Home\Model\ArticleModel;
use Think\Controller;

class TestController extends  Controller
{
    public function index(){
        //$model =D('picgrid');
        //$model->delete($id);
        $a = [
            'admin'=>['author'],
            'index'=>['author'],
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

    public function user(){
        $r = new ManagerModel();
        $r->register(['email'=>'33','password'=>'33','name'=>33]);
        var_dump(get_user_info(65,['name']));
    }
    public function team(){
        $t = new TeamModel();
        var_dump($t->detail(133));
    }

    public function session(){
        $a = new UindexModel();
        $a->login(6);
        //var_dump($_SESSION);
    }
    public function addcc()
    {
        //echo 'hh';
        $e = new NewsModel();
/*$d= new ArticleController();
        $d->addAtc(22,2);*/
        $e->create(['content'=>'cccc']);
        $e->addAtc(22);
    }
}