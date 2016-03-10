<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-7
 * Time: 上午4:58
 */

namespace Common\Model;
//use Think\Model;

class JiaowuModel //extends Model
{
    public function login(){
       // header ( 'Content-Type: text/html; charset=UTF-8;User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240' );

        $post['user_id'] = '20132195';
       // $post['user_id'] = $map['count'];
        $post['password'] = 'phibeta';
        //$post['password'] = $map['password'];
        $post['user_type'] = 'student';
        $post['set_language'] = 'cn';



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
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));//加上POST变量
        curl_exec($ch);
        curl_close($ch);

//$stu = '__VIEWSTATE=3VryDbIFaZ8Exd2fVaSws5BZI4cqLm0p2ULsgryU3k57mWazv05GEJA7RWQf2iS06sQ9GhBjwkArGsXstvXCk0PHlBSJy9OxMobGM6CxxJDWcrLgWRc9sXq7Lv2K1E9QkqlmKOWVgyNxMVz6L21cmBIsgzaoW5pbqoEmZJJcbPTFrcRnF8vVA1QCrNkMRw261ZYzvvBqSHs4MhRcs1QPKwN0LrClQUTgeji3zD3JoP6qTZYtY4LlJlF4%2FTg03kVJnAvLNYNmxrtxVR2PSOhcaTTW7ZRn1yBZXsm9tUbabOU5yMIRHKBEA3WZ988S0pmkJ8di8VPKf1g85oOBmDiRiQ%3D%3D&__VIEWSTATEGENERATOR=E08963AD&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION=49EMq0Xoozo6KFeA%2BxPpDoig0QVMJ9mbzymT6bD0u0uuGtiJ4CDHZV0AthU13yQOvkU3sbaZQkVb7psEqAFbperuLfoNgbzUK5pZ%2FQ1HqKQFp7hdM6EYL97QllAW0D6A&StudentNo=1234&StudentName=&Button1=%B2%E9%D1%AF&SearchStyleControl_currentState=false';
//$url='http://202.115.67.50/usersys/index.jsp';
        $url='http://202.115.67.50/servlet/StudentInfoMapAction?MapID=101&PageUrl=../student/student/student.jsp';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,0);
//curl_setopt($ch, CURLOPT_COOKIE, 'JSESSIONID=ED1647EBD20646F44526BA76BC849381; user_id=20132195; user_type=student; user_style=modern');
        curl_setopt($ch, CURLOPT_COOKIE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_REFERER, "http://202.115.67.50/service/login.jsp?user_type=student");

//curl_setopt($ch, CURLOPT_COOKIE, 'ASP.NET_SessionId=folkenvcu32zim4odg0ogjft; YangHua=A5AC04290861FB483CB12C1E429132AF06BD0BC4C628396C921C28B97D8898C156B0F1FDB1C5C85AC19BBF1A4329BCBBD736EA1434E983E03C75C9AAE08FF833DA9453E19275E56F6B6765366A8BC1141739ABF8689D43A67144A5BBAB700931EDDC260C21ECD37D790219E8E001C12EAD5F0118017C6A55A5209B13EA897712D2249D66B2BC066D7B767779D1B89D55DD86B69F8D497CA158095FAACAEC2F7C0BDDBBA85BE286CC8021F4D21684F8FD1A51728900A3C2532807E99E775D5B6DC46157AD64C7A1901857AC21C385613E0DE09F60BCC1E7B130D227AEA2EA0409C2D78DCEA8699974B1104A99BAA17FC2; ');
//curl_setopt($ch, CURLOPT_POST, 1);//POST数据
//curl_setopt($ch, CURLOPT_POSTFIELDS, $stu);//加上POST变量
        curl_setopt($ch, CURLOPT_AUTOREFERER,1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_REFERER, 'http://202.115.67.50/');
        $contents = curl_exec($ch);  //执行并获取HTML文档内容
//iconv('GBK', 'UTF-8', $contents);//编码转换
        curl_close($ch);//释放curl句柄
        echo $contents;
        unlink($cookie_file);
        $beg_tag="<td height=\"28\" width=\"25%\" bgcolor=\"#ffffff\">";
        $close_tag = '</td>';
        //echo preg_match("($beg_tag(.*)$close_tag)",$contents);

    }

    public function band(){

    }




}