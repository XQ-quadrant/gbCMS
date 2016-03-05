<?php
namespace Admin\Controller;
use Admin\Model\AdminModel;
use Admin\Model\Uindex;
use Think\Controller;
use Admin\Model\CateModel;

class IndexController extends Controller {

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
    public function login($mid){

        $modelInfo = get_model_info($mid);  //获取模型信息
        $uindex = new Uindex();
        if(IS_POST){
            //$data = I("post.");
            //$user = D($modelInfo['identity']);    //建立模型对象
            //$user = new AdminModel();
            //return 'hhh';
            //$this->ajaxReturn(['name'=>'34'],'JSON');
            //$this->redirect('index');
            $uindex->create();
            $reInfo = $uindex->login($mid);
            $this->ajaxReturn($reInfo);
            //$this->ajaxReturn(['name'=>$rows['id']],'JSON');

            /*if ($loginInfo["status"]==1){
                //登录成功
                session("id",$loginInfo["id"]);
                session("name",I('post.name'));
                session("status",$loginInfo['status']);
                cookie("name",I('post.name'));
                $this->ajaxReturn($loginInfo);

            }elseif ($loginInfo["status"]==2){
                $this->ajaxReturn(['msg'=>"系统已经向{$loginInfo['user_email']}发送了验证信，请验证。"]);
            }elseif ($loginInfo["status"]==3){
                $this->ajaxReturn(['msg'=>"你的用户资格管理员正在审核中"]);
            }else{

                $this->ajaxReturn(['msg'=>"登录失败，请检查用户名或邮箱"],'JSON');
            }*/

        }
        $this->assign('mid',$modelInfo['id']);
        $this->display($modelInfo['view_other']);
    }

    public function register($mid){
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


            $this->ajaxReturn($reInfo);



            //$adminer= new AdminModel();
            //$adminer->create();
            //$adminer->status=2;
            $AddInfo = $adminer->register();
            //var_dump($data);
            return $AddInfo;
            //$this->display();*/
        }else{
            $this->assign('mid',$modelInfo['id']);
            $this->display($modelInfo['view_add']);
        }

    }

    public function logout(){
        session('id',null);
        session("name",null);
        session("status",null);
        cookie("username",null);
        $this->redirect('login');
    }
}