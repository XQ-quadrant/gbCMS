<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-7
 * Time: 上午2:20
 */

namespace Admin\Model;


use Common\Model\JiaowuModel;
use Common\Model\Wechat;
use Think\Model;

class StudentModel extends Model implements User
{
    private $power =4;
    private $mid = 6;
    public function login($map){
        $loginInfo = $this->where(['user_id'=>$map['count'],'password'=>$map['password']])->find();

        if($loginInfo==null){
            //$jw = new JiaowuModel();
            return $this->register($map);
        }
        return $loginInfo;

    }

    public function logout(){

    }

    /**教务绑定
     * @param $map  ['user_id'=学号,'password'=>密码]
     */
    public function register($map){
        // header ( 'Content-Type: text/html; charset=UTF-8;User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240' );

        $info['user_id'] = $map['count'];
        $info['password'] = $map['password'];
        $info['user_type'] = 'student';
        $info['set_language'] = 'cn';

    /****第一次登录****/

        $cookie_file =tempnam('./temp22','uu');   //创建临时文件保存cookie
        $login_url = 'http://202.115.67.50/servlet/UserLoginSQLAction';//登陆地址
//$post_fields = '__VIEWSTATE=dDwtMTk3MjM2MzU0MDs7Po+Vuw2g98nkvMhqN2OzPbC6DnbA&TextBox1='.$username&TextBox2='.$password;//POST参数
        $ch = curl_init($login_url);//初始化
        curl_setopt($ch, CURLOPT_HEADER, 1);//0显示
        curl_setopt($ch, CURLOPT_REFERER, "http://202.115.67.50/service/login.jsp?user_type=student");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//1不显示
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE,  $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file);//保存cookie
        curl_setopt($ch, CURLOPT_POST, 1);//POST数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($info));//加上POST变量
        curl_exec($ch);
        curl_close($ch);

        /****第2次登录 验证****/
        $url='http://202.115.67.50/servlet/StudentInfoMapAction?MapID=101&PageUrl=../student/student/student.jsp';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_REFERER, "http://202.115.67.50/service/login.jsp?user_type=student");

        curl_setopt($ch, CURLOPT_AUTOREFERER,1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_REFERER, 'http://202.115.67.50/');
        $contents = curl_exec($ch);  //执行并获取HTML文档内容
//iconv('GBK', 'UTF-8', $contents);//编码转换
        curl_close($ch);
        //echo $contents;
        unlink($cookie_file);
        $preg = '/ffff\".*>&nbsp;.*<\/td>/';
        preg_match_all($preg,$contents,$infoList);
        //$info = [];
        function listInfo($c){
            $info = preg_split('/(>&nbsp;)|(<\/td>)/',$c);
            return $info[1];
        }
        foreach($infoList[0] as $k=>$v){
            //echo "<br>".$k;
            //$a2 = preg_split('/(>&nbsp;)|(<\/td>)/',$v);
            switch($k){
                case 0:$info['user_id'] = listInfo($v);break;
                case 1:$info['name'] = listInfo($v);break;
                case 3:$info['sex'] = listInfo($v);break;
                case 4:$info['birthday'] = listInfo($v);break;
                case 5:$info['college'] = listInfo($v);break;
                case 7:$info['major'] = listInfo($v);break;
                case 8:$info['class'] = listInfo($v);break;
                case 9:$info['native'] = listInfo($v);break;
                case 10:$info['nation'] = listInfo($v);break;
                case 11:$info['politics'] = listInfo($v);break;
                case 12:$info['person_id'] = listInfo($v);break;
                case 15:$info['tel'] = listInfo($v);break;
                case 16:$info['address'] = listInfo($v);break;
                default:break;
            }
        }

        if(empty($info['name'])){
            return false;
        }else{
            if(!empty($map['code'])){
                $wechat = new Wechat();  //微信对象
                $wechatInfo = $wechat->getUserInfo($map['code']);   //获取用户微信信息
                $info['openid'] = $wechatInfo['openid'];
                $info['headimgurl'] = $wechatInfo['headimgurl'];
            }

            $id = $this->add($info);
            $info['uid'] = $id;
            $info['power'] = $this->power;
            return $info;   //返回给UindexModel
        }

        //sssxxvar_dump($info);

    }

    public function listView(&$list, $modelInfo, $module = 'admin')
    {
        $listExtra = implode(',',$modelInfo['list_extra'][$module]); //主内容附加项，如：user
        $reList =[];

        foreach($list as $k=>$v){
            if($this->mid==$v['model_id']) //选择对应模型
            {
                $raw = $this->query("select {$listExtra} from {$modelInfo['identity']} where id = {$v['uid']}");

                $reList[$k] = array_merge($v,$raw[0]);
                unset($list[$k]);
            }
        }
        return $reList;

    }

}