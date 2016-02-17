<?php
namespace Admin\Controller;
use Admin\Model\AdminModel;
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

    public function login(){
        if(IS_POST){
            //$data = I("post.");
            $user = new AdminModel();
            //return 'hhh';
            //$this->ajaxReturn(['name'=>'34'],'JSON');
            //$this->redirect('index');
            $rows = $user->login();
            //$this->ajaxReturn(['name'=>$rows['id']],'JSON');
            if ($rows["status"]==1){
                //登录成功
                session("id",$rows["id"]);

                session("name",I('post.name'));
                session("status",$rows['status']);
                cookie("name",I('post.name'));
                $this->ajaxReturn($rows);

            }elseif ($rows["status"]==2){
                $this->ajaxReturn(['msg'=>"系统已经向{$rows['user_email']}发送了验证信，请验证。"]);
            }elseif ($rows["status"]==3){
                $this->ajaxReturn(['msg'=>"你的用户资格管理员正在审核中"]);
            }else{

                $this->ajaxReturn(['msg'=>"登录失败，请检查用户名或邮箱"],'JSON');
            }

        }
        $this->display();
    }

    public function logout(){
        session('id',null);
        session("name",null);
        session("status",null);
        cookie("username",null);
        $this->redirect('login');
    }

    public function register(){
        if(IS_POST){
            //$data =I('post.');
            $adminer= new AdminModel();
            $adminer->create();
            $adminer->status=2;
            $AddInfo = $adminer->register();
            //var_dump($data);
            return $AddInfo;
            //$this->display();
        }else{
            $this->display();
        }

    }
}