<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-1
 * Time: 下午2:41
 */

namespace Admin\Controller;


use Admin\Model\CateAtcModel;
use Admin\Model\CateModel;
use Admin\Model\ManagerModel;
use Admin\Model\NewsModel;
use Admin\Model\StudentModel;
use Admin\Model\TeamModel;
use Admin\Model\Uindex;
use Common\Model\JiaowuModel;
use Common\Model\SrtphireModel;
use Common\Model\UindexModel;
use Home\Model\ArticleModel;
use Think\Controller;

class TestController extends  Controller
{
    public function index(){
        //$model =D('picgrid');
        //$model->delete($id);
        $a = [
            'admin'=>['author','original_time','orienting'],
            'index'=>['breviary','author','original_time','orienting'],
            //'editor'=>['uid','content','race','limit_member','already_member'],
            //'add'=>[],
        ];
        //echo 'dd';
        echo json_encode($a);
    }

    public function jiao(){
        $b = new UindexModel();
        $b->register(6,['count'=>20132195,'password'=>'phibeta']);
        //$a =new StudentModel();
        //var_dump($a->login(['count'=>20132195,'password'=>'phibeta']));
    }
    public function jiao2(){
        $a =new UindexModel();
        var_dump($a->register(6,['count'=>20132195,'password'=>'phibeta']));
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
    public function ss(){
        //$modelInfo = get_model_info(6);
        $model = D('student');

    }

    public function session(){
        $a = new UindexModel();
        $a->login(6);
        //var_dump($_SESSION);
    }
    public function addcc()
    {
        //echo 'hh';
        $e = new SrtpHireModel();

/*$d= new ArticleController();
        $d->addAtc(22,2);*/
        //$e->create(['content'=>'cccc']);
        $e->test();
    }

    public function de2(){
        $e = new SrtphireModel();
        $a = new CateAtcModel();
        $h = $a->field(['id','atc_id','createtime'])->where(['cate'=>26])->select();
        foreach($h as $v){
            $p = $e->where(['id'=>$v['atc_id']])->find();
            $t['createtime']=$p['original_time'];
            $a->where(['id'=>$v['id']])->save($t);
            echo $p['original_time'];
        }


    }
    /**
     * @param $cate 文章所属类别ID
     *              类型支持：cate_id
     * @param $module 文章所属模型ID
     *                类型支持：model_id
     *                         model_identity
     * @param $status 文章状态
     *                类型支持：array[]
     *                         var
     * ******************alet*******************
     *
     * 以上每个参数都支持数组的形式传入参数
     * 因此带来的返回结果将是所查询的文章数量和
     *
     * *****************structure*****************
     *
     * 1.判断是数组的变量
     * 2.拼接查询SQL语句
     * 3.返回查询结果
     *
     * *****************manual*****************
     *
     * 默认取得所有的文章数量
     * 任何一参数的默认都是该分类下的所有
     *
     * *****************approach*****************
     *
     * 情况1，获取全局文章数量
     * 情况2，获取指定cate/module/status的文章数量
     * 情况3，获取指定cate+module的文章数量这里cate具有较高优先级
     * 情况4，获取指定cate+status的文章数量这里cate具有较高优先级
     *
     *
     *
     * @return int
     */
    public function get_count($cate,$module,$status)
    {
        //TODO when module named by identity array make identify into id

        //$cate=['1','15','10'];
        //$cate = 0;
        //$module=['1','3','5'];
        //$module = 0;
        //$status=['123','123','123','123'];
        //$status = 0;
        $News = M();


        $count = 0;
        $nullcount = 0;
        $cate_is_array = is_array($cate);
        $module_is_array = is_array($module);
        $status_is_array = is_array($status);


        //get var status in count as flag
        if (empty($cate)) {
            $nullcount = $nullcount + 1;
            $cate_is_null = 1;
        }
        if (empty($module)) {
            $nullcount = $nullcount + 1;
            $module_is_null = 1;
        }
        if (empty($status)) {
            $nullcount = $nullcount + 1;
            $status_is_null = 1;
        }
        //find situation
        if ($nullcount == 3) {
            $condition = 1;
        }
        if ($nullcount == 2) {
            $condition = 2;
        }
        if ($nullcount == 1) {
            if ($status_is_null == 1) {
                $condition = 3;
            }
            if ($module_is_null == 1) {
                $condition = 4;
            }
        }


        switch ($condition) {
            case 1:
                //echo 'case 1'.'<br>'.'get all news'.'<br>';
                $list = $News->query("select * from cate_atc ");
                return sizeof($list);
                break;
            case 2:
                //echo 'case 2'.'<br>';
                //get one out of three kind number
                if ($cate_is_null == 0) {
                    if ($cate_is_array) {
                        //echo 'only cate : cate is array';
                        foreach ($cate as $cate_element) {
                            $list = $News->query("select * from cate_atc WHERE cate=".$cate_element);
                            $count=$count+sizeof($list);
                        }
                        return $count;
                        //array to solve
                    } else {
                        //echo 'only cate : cate is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE cate=".$cate);
                        return sizeof($list);
                    }
                }
                if ($module_is_null == 0) {
                    if ($module_is_array) {
                        //echo 'only module : module is array';
                        foreach ($module as $module_element) {
                            $list = $News->query("select * from cate_atc WHERE model_id=".$module_element);
                            $count=$count+sizeof($list);
                        }
                        return $count;
                        //array to solve
                    } else {
                        //echo 'only module : module is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE model_id=".$module);
                        return sizeof($list);
                    }
                }
                if ($status_is_null == 0) {
                    if ($status_is_array) {
                        //echo 'only status : status is array';
                        //array to solve
                        foreach ($status as $status_element) {
                            $list = $News->query("select * from cate_atc WHERE status=".$status_element);
                            $count=$count+sizeof($list);
                        }
                        return $count;
                    } else {
                        //echo 'only status : status is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE status=".$status);
                        return  sizeof($list);
                    }
                }
                break;
            case 3:
                //echo 'case 3';
                if($status_is_null==1){
                    if ($cate_is_array) {
                        if ($module_is_array) {
                            //echo 'cate & module both array';
                            //cate & module both array
                            foreach ($cate as $cate_element) {
                                foreach ($module as $module_element) {
                                    $list = $News->query("select * from cate_atc WHERE cate=".$cate_element.' and model_id='.$module_element);
                                    $count=$count+sizeof($list);
                                }
                            }
                            return $count;
                        } else {
                            //echo 'cate is array : module is not array';
                            //cate is array
                            //module is not array
                            foreach ($cate as $cate_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=".$cate_element.' and model_id='.$module);
                                $count=$count+sizeof($list);
                            }
                            return $count;
                        }
                    } else {
                        //cate is not array
                        if ($module_is_array) {
                            //echo 'cate is not array : module is array';
                            //cate is not array
                            //module is array
                            foreach ($module as $module_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=".$cate.' and model_id='.$module_element);
                                $count=$count+sizeof($list);
                            }
                            return $count;
                        } else {
                            //echo 'cate & module both var';
                            // cate & module both var
                            $list = $News->query("select * from cate_atc WHERE cate =".$cate.' and model_id ='.$module);
                            return  sizeof($list);
                        }
                    }
                }
                break;
            case 4:
                //echo 'case 4'.'<br>';
                if($module_is_null){
                    if ($cate_is_array) {
                        if ($status_is_array) {
                            //echo 'cate & status both array';
                            //cate & status both array
                            foreach ($cate as $cate_element) {
                                foreach ($status as $status_element) {
                                    $list = $News->query("select * from cate_atc WHERE cate=".$cate_element.' and status='.$status_element);
                                    $count=$count+sizeof($list);
                                }
                            }
                            return $count;
                        } else {
                            //echo 'cate is array : status is not array';
                            //cate is array
                            //status is not array
                            foreach ($cate as $cate_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=".$cate_element.' and status='.$status);
                                $count=$count+sizeof($list);
                            }
                            return $count;
                        }
                    } else {
                        //cate is not array
                        if ($status_is_array) {
                            //echo 'cate is not array : status is array';
                            //cate is not array
                            //status is array
                            foreach ($status as $status_element) {
                                $list = $News->query("select * from cate_atc WHERE status=".$status_element.' and cate='.$cate);
                                $count=$count+sizeof($list);
                            }
                            return $count;
                        } else {
                            //echo 'cate & status both var';
                            // cate & status both var
                            $list = $News->query("select * from cate_atc WHERE cate =".$cate.' and status ='.$status);
                            return  sizeof($list);
                        }
                    }
                }
                break;
        }
    }


/**
     * @param $cate 文章所属类别ID
     *              类型支持：cate_id
     * @param $module 文章所属模型ID
     *                类型支持：model_id
     *                         model_identity
     * @param $status 文章状态
     *                类型支持：array[]
     *                         var
     * ******************alet*******************
     *
     * 以上每个参数都支持数组的形式传入参数
     * 因此带来的返回结果将是所查询的文章数量和
     *
     * *****************structure*****************
     *
     * 1.判断是数组的变量
     * 2.拼接查询SQL语句
     * 3.返回查询结果
     *
     * *****************manual*****************
     *
     * 默认取得所有的文章数量
     * 任何一参数的默认都是该分类下的所有
     *
     * *****************approach*****************
     *
     * 情况1，获取全局文章数量
     * 情况2，获取指定cate/module/status的文章数量
     * 情况3，获取指定cate+module的文章数量这里cate具有较高优先级
     * 情况4，获取指定cate+status的文章数量这里cate具有较高优先级
     *
     *
     *
     * @return int
     */
    public function get_count2($cate,$module,$status)
    {
        //TODO when module named by identity array make identify into id

        //$cate=['1','15','10'];
        //$cate = 0;
        //$module=['1','3','5'];
        //$module = 0;
        //$status=['123','123','123','123'];
        //$status = 0;
        $News = M();


        $count = 0;
        $nullcount = 0;
        $cate_is_array = is_array($cate);
        $module_is_array = is_array($module);
        $status_is_array = is_array($status);


        //get var status in count as flag
        if (empty($cate)) {
            $nullcount = $nullcount + 1;
            $cate_is_null = 1;
        }
        if (empty($module)) {
            $nullcount = $nullcount + 1;
            $module_is_null = 1;
        }
        if (empty($status)) {
            $nullcount = $nullcount + 1;
            $status_is_null = 1;
        }
        //find situation
        if ($nullcount == 3) {
            $condition = 1;
        }
        if ($nullcount == 2) {
            $condition = 2;
        }
        if ($nullcount == 1) {
            if ($status_is_null == 1) {
                $condition = 3;
            }
            if ($module_is_null == 1) {
                $condition = 4;
            }
        }


        switch ($condition) {
            case 1:
                //echo 'case 1'.'<br>'.'get all news'.'<br>';
                $list = $News->query("select * from cate_atc ");
                return sizeof($list);
                break;
            case 2:
                //echo 'case 2'.'<br>';
                //get one out of three kind number
                if ($cate_is_null == 0) {
                    if ($cate_is_array) {
                        //echo 'only cate : cate is array';
                        foreach ($cate as $cate_element) {
                            $list = $News->query("select * from cate_atc WHERE cate=" . $cate_element);
                            $count = $count + sizeof($list);
                        }
                        return $count;
                        //array to solve
                    } else {
                        //echo 'only cate : cate is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE cate=" . $cate);
                        return sizeof($list);
                    }
                }
                if ($module_is_null == 0) {
                    if ($module_is_array) {
                        //echo 'only module : module is array';
                        foreach ($module as $module_element) {
                            $list = $News->query("select * from cate_atc WHERE model_id=" . $module_element);
                            $count = $count + sizeof($list);
                        }
                        return $count;
                        //array to solve
                    } else {
                        //echo 'only module : module is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE model_id=" . $module);
                        return sizeof($list);
                    }
                }
                if ($status_is_null == 0) {
                    if ($status_is_array) {
                        //echo 'only status : status is array';
                        //array to solve
                        foreach ($status as $status_element) {
                            $list = $News->query("select * from cate_atc WHERE status=" . $status_element);
                            $count = $count + sizeof($list);
                        }
                        return $count;
                    } else {
                        //echo 'only status : status is not array'.'<br>';
                        //var to solve
                        $list = $News->query("select * from cate_atc WHERE status=" . $status);
                        return sizeof($list);
                    }
                }
                break;
            case 3:
                //echo 'case 3';
                if ($status_is_null == 1) {
                    if ($cate_is_array) {
                        if ($module_is_array) {
                            //echo 'cate & module both array';
                            //cate & module both array
                            foreach ($cate as $cate_element) {
                                foreach ($module as $module_element) {
                                    $list = $News->query("select * from cate_atc WHERE cate=" . $cate_element . ' and model_id=' . $module_element);
                                    $count = $count + sizeof($list);
                                }
                            }
                            return $count;
                        } else {
                            //echo 'cate is array : module is not array';
                            //cate is array
                            //module is not array
                            foreach ($cate as $cate_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=" . $cate_element . ' and model_id=' . $module);
                                $count = $count + sizeof($list);
                            }
                            return $count;
                        }
                    } else {
                        //cate is not array
                        if ($module_is_array) {
                            //echo 'cate is not array : module is array';
                            //cate is not array
                            //module is array
                            foreach ($module as $module_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=" . $cate . ' and model_id=' . $module_element);
                                $count = $count + sizeof($list);
                            }
                            return $count;
                        } else {
                            //echo 'cate & module both var';
                            // cate & module both var
                            $list = $News->query("select * from cate_atc WHERE cate =" . $cate . ' and model_id =' . $module);
                            return sizeof($list);
                        }
                    }
                }
                break;
            case 4:
                //echo 'case 4'.'<br>';
                if ($module_is_null) {
                    if ($cate_is_array) {
                        if ($status_is_array) {
                            //echo 'cate & status both array';
                            //cate & status both array
                            foreach ($cate as $cate_element) {
                                foreach ($status as $status_element) {
                                    $list = $News->query("select * from cate_atc WHERE cate=" . $cate_element . ' and status=' . $status_element);
                                    $count = $count + sizeof($list);
                                }
                            }
                            return $count;
                        } else {
                            //echo 'cate is array : status is not array';
                            //cate is array
                            //status is not array
                            foreach ($cate as $cate_element) {
                                $list = $News->query("select * from cate_atc WHERE cate=" . $cate_element . ' and status=' . $status);
                                $count = $count + sizeof($list);
                            }
                            return $count;
                        }
                    } else {
                        //cate is not array
                        if ($status_is_array) {
                            //echo 'cate is not array : status is array';
                            //cate is not array
                            //status is array
                            foreach ($status as $status_element) {
                                $list = $News->query("select * from cate_atc WHERE status=" . $status_element . ' and cate=' . $cate);
                                $count = $count + sizeof($list);
                            }
                            return $count;
                        } else {
                            //echo 'cate & status both var';
                            // cate & status both var
                            $list = $News->query("select * from cate_atc WHERE cate =" . $cate . ' and status =' . $status);
                            return sizeof($list);
                        }
                    }
                }
                break;
        }
    }
}

