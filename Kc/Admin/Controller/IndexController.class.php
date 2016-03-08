<?php
namespace Admin\Controller;
use Admin\Model\AdminModel;
use Admin\Model\Uindex;
use Think\Controller;
use Admin\Model\CateModel;

class IndexController extends Controller {

    protected $user ;
    private $power = 2;

    public function _initialize(){
        $logined = session('email');
        $status = session('status');

        if(!session('?email')&& !session('?status')){
            $this->redirect('/Admin/Enter/login');
        }
        elseif(session('power')<$this->power){
            $this->error('权限不足，无法访问');
//echo session('power');
        }

    }

    public function index(){

        //tag('cate');
        $this->display();
    }

    /**统一登录入口
     * @param $uid
     */
/*    public function login($mid){

        $modelInfo = get_model_info($mid);  //获取模型信息
        $uindex = new Uindex();
        if(IS_POST){

            $reInfo = $uindex->login($mid);
            $this->ajaxReturn($reInfo);
            //$this->ajaxReturn(['name'=>$rows['id']],'JSON');

        }
        $this->assign('mid',$modelInfo['id']);
        $this->display($modelInfo['view_other']);
    }*/

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

//    public function logout(){
//        session(null);
//        /*session("name",null);
//        session("status",null);*/
//        cookie(null);
//        $this->redirect('login');
//    }
}