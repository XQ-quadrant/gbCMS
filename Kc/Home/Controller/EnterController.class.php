<?php
namespace Home\Controller;
use Admin\Model\AdminModel;
use Common\Model\UindexModel;
use Think\Controller;
use Admin\Model\CateModel;

class EnterController extends Controller {

    protected $user ;

    public function _initialize(){

    }

    public function index(){
        //tag('cate');
        $this->display();
    }

    /**统一登录入口
     * @param $uid
     */
    public function login($mid = 6){

        $modelInfo = get_model_info($mid);  //获取模型信息

        $uindex = new UindexModel();
        if(IS_POST){
            $reInfo = $uindex->login($mid);
            $this->ajaxReturn($reInfo);
            //$this->ajaxReturn(['name'=>$rows['id']],'JSON');
        }
        $this->assign('mid',$modelInfo['id']);
        $this->display($modelInfo['view_other']);
    }

    public function stuRegister($mid = 6){
        $modelInfo = get_model_info($mid);

        if(IS_POST){
            //$data =I('post.');
            $user = D($modelInfo['identity']);    //建立模型对象
            if(!$user->validate($modelInfo['rules'])->create()){
                $this->ajaxreturn($user->getError());   //反馈验证错误信息
            }else {
                $reInfo = $user->register();  //模型实际操作方法
                $this->ajaxReturn($reInfo);
            }
            /*$reInfo = $user->login();
            //$this->display();*/
        }else{
            $this->assign('mid',$modelInfo['id']);
            $this->display();
        }
    }


    public function logout(){
        $uindex = new UindexModel();
        $uindex->logout();
        $this->redirect('login');
    }
}