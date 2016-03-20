<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 15-12-10
 * Time: 下午11:18
 */

namespace Home\Controller;
use Think\Controller;
use Think\Model;
//use Home\Model\CateModel;
//use Home\Model;
//use Admin\Model\D;
use Admin\Model\ArticleModel;
use Admin\Model\CateModel;
use Admin\Model\CateAtcModel;
use Home\Model\AritcleModel;

class ArticleController extends Controller
{

    private $power = 1;
    private $openid ;
    private $data ;
    public function _initialize(){
        if(isset($_GET['cate'])){
            $cateInfo = get_cate($_GET['cate']);
            $this->assign('cateName',$cateInfo['name']);
        }
        $this->data = I('post.')+I('get.');

        if(!empty($_GET['code'])){

            $this->openid = $_GET['openid'];
            $this->assign('openid',$this->openid);
        }
        if(!empty($_GET['code'])){
            $wechat = new Wechat();    //微信对象
            $wechatInfo = $wechat->getUserInfo(I('get.code'));   //获取用户微信信息

            $info['openid'] = $wechatInfo->openid;  //$wechatInfo;//I('get.code');//
            $info['headimgurl'] = $wechatInfo->headimgurl;
        }
        /*if(!session('?count')){  //权限验证
            $this->redirect("/Home/Enter/login/mid/6");
        }
        elseif(session('power')<$this->power){
            $this->error('权限不足，无法访问');
        }*/
    }
    /**主控面板
     * @param $cate
     * @param $id
     */
    public function index($cate){
        $cate_atc= M('cate_atc');
        $count      = $cate_atc->where(['status'=>1,'cate'=>$cate])->count();
        $Page       = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();   // 分页显示输出

        $list = $cate_atc->where(['cate'=>$cate])->order('createtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();

        $cateInfo = get_cate($cate);  //获取栏目信息

        $reList =[];

        foreach($cateInfo['model'] as $k=>$v){

            $modelInfo = get_model_info($v['id']);

            $model = D($modelInfo['identity']);            //建立内容模型对象
            $reList = array_merge($reList,$model->listView($list,$modelInfo,'index'));

        }

        $this->assign('page',$show);
        $this->assign('list',$reList);
        $this->assign('model_list',get_cate_Model($cate));
        $this->assign("cate",$cate);


        $this->display($cateInfo['view_index']);
    }

    /**列表展示
     * @param $cate
     */
    public function listView($cate=1,$mid=''){
        if($mid==''){
            $mid = get_cate_Model($cate)[0]['id']; //获取栏目对应的模型
        }
        $modelInfo=get_model_info($mid);  //获取模型信息
        //$article = D($modelInfo['identity']);
        $this->display('Picgrid/index');
    }

    public function PicView($cate=15,$mid='',$author){
        if($mid==''){
            $mid = get_cate_Model($cate)[0]['id']; //获取栏目对应的模型
        }
        $modelInfo=get_model_info($mid);  //获取模型信息
        $article = D($modelInfo['identity']);
        $pic =$article->where(['author'=>$author])->select();
        /*foreach(){

        }*/
        $this->assign('pic',$pic);
        $this->display('Picgrid/index');
    }

    /**详细信息展示
     * @param $mid
     * @param $id
     */
    public function detail($mid,$id){
        $modelInfo=get_model_info($mid);  //获取模型信息
        $article = D('Common/'.$modelInfo['identity']);
        //$article = new "Admin\\".$modelInfo['identity']."Model";
       // $modelName = "Admin\\Model\\".$modelInfo['identity']."Model";
        //$article = new $modelName();

        //echo $modelInfo['identity'];
        //$article->id = $id;
        $atcInfo = $article->detail($id);
        if(!is_array($atcInfo)){
            //$this->error($atcInfo);
            //$this->ajaxreturn($article->getDbError());
        }
        $atcInfo['content']=htmlspecialchars_decode($atcInfo['content']);

        $this->assign($atcInfo);
        //var_dump($atcInfo);
        //var_dump($article->getError());
        $this->display($modelInfo['view_detail']);
    }

    /**
     * 文档控制台
     * @param $cate
     */
    public function admin($cate){
        $cateInfo = new CateModel();
    }

    /**
     * 添加文章
     * @param $cate 栏目
     * @param $mid  文档模型
     */
    public function addAtc($cate=1,$mid=''){
        if(empty($this->openid) || empty(session('count'))){
            $this->redirect("/Home/Enter/login/mid/6");
        }
        if($mid==''){
            $mid = get_cate_Model($cate)[0]['id']; //获取栏目对应的模型
        }
        $modelInfo=get_model_info($mid);  //获取模型信息

        if(IS_POST){
            //$className= ;//$modelInfo['identity'];
            //$className   =   '\\Common\\'.'Model'.'\\'.$modelInfo['identity'].'Model';
            //$article =new $className();

            $article = D($modelInfo['identity']);    //建立模型对象
            //$this->ajaxreturn(['msg'=>$_POST['title'],'status'=>2]);
            if(!$article->validate($modelInfo['rules'])->create($this->data)){  //建立数据

                $this->ajaxreturn(['msg'=>$article->getError(),'status'=>2]);//;

            }else{
                //$this->ajaxreturn(['msg'=>'f','status'=>2]);
                if(!$article->addAtc($cate)){        //提交内容

                    $this->ajaxreturn(['msg'=>$article->getError(),'status'=>2]);
                }else{
                    $this->ajaxreturn(['msg'=>'添加成功','status'=>2]);
                }

            }
        }else{
            $this->assign("cate",$cate);
            $this->assign("mid",$mid);
            $this->display($modelInfo['view_add']);
        }
    }

    /**删除文章
     * @param $id
     */
    public function delete($id){
        $index_atc = D('cate_atc');
        if($index_atc->delete_h($id)){
            $this->ajaxreturn(['msg'=>'已删除','status'=>1]);
        }else{
            $this->ajaxreturn(['msg'=>$index_atc->getError(),'status'=>2]);
        }
    }


    /**编辑内容
     * @param $id
     * @param string $id
     */

    public function editor($id){
        $cate_atc = new CateAtcModel();//D('cate_atc');
        //$atcInfo = $cate_atc->find($id);
        $atcInfo = $cate_atc->field("id,title,model_id,cate,atc_id,status,createtime")->find($id);
        $model = get_model_info($atcInfo['model_id']); //获取模型信息
        $atc = D($model['identity']);    //建立模型对象

        if(IS_POST){
            $c = $atc->create();
            $d = $cate_atc->create();
            if(!$c&&!$d){             //验证是否合法
                $this->ajaxreturn(['msg'=>$atc->getError(),'status'=>2]);//;
                //$this->ajaxreturn($article->getError());
            }else{
                //$atc->linkSet();
                $atc->id = $atcInfo['atc_id'];
                $cate_atc->id = $id;
                //$atc->status=1;
                //
                $a = $cate_atc->where(['id'=>$cate_atc->id])->save();
                $b = $atc->where(['id'=>$atc->id])->validate($model['rules'])->save();
                if(!$a&&!$b){        //提交内容
                    $this->ajaxreturn(['msg'=>$atc->getError().$cate_atc->getError(),'status'=>2]);
                }
                $this->ajaxreturn(['msg'=>'修改成功','status'=>1]);
            }
        }else{

            //$atc->query("select author,editor, content from ")
            $atcInfo = array_merge($atcInfo, $atc->field("author,content")->find($atcInfo['atc_id']));
            $this->assign($atcInfo);
            //echo $model['identity'];
            $this->display($model['view_edit']);
        }
    }

    /**
     * 判断并执行控制器的指定方法
     */
    public function excu(){
        $e =I('post.');
        //$a= json_decode($e);
        //echo $e[0];
        $cate_atc = D('cate_atc');
        $func= $e['status'];    //当前控制器操作函数

        $success=0;
        $fail=0;

        foreach($e['val'] as $k=>$v){

            $state = $cate_atc->$func($v);
            if ($state) {
                $success++;
                //$this->ajaxReturn($state);
            } else {
                $fail++;
                //$this->ajaxReturn(null);
            }
        }
        //$b= json_encode($a);
        $c=[1,2];
        $alarm = "成功修改".$success."个，失败".$fail."个";
        $this->ajaxReturn($alarm);
    }

}