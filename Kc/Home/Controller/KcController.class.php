<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-14
 * Time: 上午1:16
 */

namespace Home\Controller;


use Common\Model\SrtpHireModel;
use Think\Controller;

class KcController extends Controller {

    public function kczm(){
        $post['type'] =2;
        $post['page'] =3;

        $url= "http://202.115.71.135/iv/srtpHire_list.do";
        //$login_url = 'http://202.115.67.50/servlet/UserLoginSQLAction';//登陆地址
//$post_fields = '__VIEWSTATE=dDwtMTk3MjM2MzU0MDs7Po+Vuw2g98nkvMhqN2OzPbC6DnbA&TextBox1='.$username&TextBox2='.$password;//POST参数
        $ch = curl_init($url);//初始化
        curl_setopt($ch, CURLOPT_HEADER, 1);//0显示
        curl_setopt($ch, CURLOPT_REFERER, "http://202.115.71.135/iv/srtpHire_list.do");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//1不显示
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_COOKIEFILE,  $cookie_file);
        //curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file);//保存cookie
        curl_setopt($ch, CURLOPT_POST, 1);//POST数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));//加上POST变量
        $contents = curl_exec($ch);
        curl_close($ch);
        //echo $contents;
        $preg= '/hireId=(.+)" targe/';

        preg_match_all($preg,$contents,$infoList);
        $srtpHire = new SrtpHireModel();
        for($i=0;$i<count($infoList[1]);$i+=2) {
            $srtpHire->oid = $infoList[1][$i];
            $html = file_get_contents("http://202.115.71.135/iv/srtpHire_view.do?hireId={$infoList[1][$i]}");
            $preg2 = <<<'H'
/<font style="font-size: 18pt; color: #000000;"><strong>(.*)<\/strong><\/font>.*面向学院：(.*)
		  &nbsp;.+发布时间：(.*)&nbsp;
		  &nbsp;&nbsp;浏览次数：23<\/font>
		  <\/p>.*<td width="650" id="content" style="line-height: 150%;">(.*)<\/td>
		<\/tr>
		<tr>
		  <td height="20"><\/td>
		<\/tr>.*发布人：(.*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <\/td>/
H;
            $pregPage['orienting'] = "/面向学院：(.+)
		  &nbsp;/U";
            $pregPage['original_time'] = "/发布时间：(.+)&nbsp;/U";
            $pregPage['content'] = '/<td width="650" id="content" style="line-height: 150%;">(.*)<\/td>/Us';
            //preg_match_all($preg3,$html,$infoList2);
            $pregPage['author'] = "/发布人：(.+)&nbsp/U";
            $pregPage['title'] = "/><strong>(.+)<\/strong>/U";
            //preg_match($preg6,$html,$infoList3);
            //var_dump($infoList3);
            //preg_match($preg7,$html,$infoList3);
            //var_dump($infoList3);
            foreach($pregPage as $k=>$v){
                preg_match($v,$html,$infoList3);
                $srtpHire->$k=$infoList3[1];
                //echo $srtpHire->$k;
            }
            $srtpHire->add();
        }

    }

    /*
     * SRTP查询
     */
    public function search()
    {
        if (IS_POST) {
            $page =I("post.page");
            $pageString = empty($page)?'':"&goPage=".$page;
            $action = "http://202.115.71.135/iv/queryPastPro.do?url=In".$pageString;
            $method = "POST";
            $ref = "http://202.115.71.135/iv/queryPastPro.do?url=In";
            /*$data = ['name' => '张',
                'btn' => '执行查询',
                'qishuId' => '',//5,
                'srtpProject.projCollege' => ''
            ];*///
            $data = I('post.');
            $data['srtpProject.projCollege'] = $data["srtpProject_projCollege"];

            unset($data['page']);
            unset($data['srtpProject_projCollege']);


            $search = new SearchModel($action, $ref, $data, $method);
            $info = $search->getInfo();
            unset($info[1]);
            unset($info[0]);
            array_pop($info);
            /*$rURL="/iv/queryPastPro.do?url=In&";
            echo($search->page);
            $PageA = str_replace($rURL,__ACTION__.'?',$search->page);
            $this->assign('PageA',$PageA);*/
            //$pageCount = $count/10;
            /* $info = array_slice($info,($page)*10,10);
             //$info[($page-1)*10];
             $sGet='';
             foreach($data as $k=>$v){
                 $sGet.=$k.'='.$v.'&';
             }
             $PageA='?'.$sGet;
             $count = count($info);
             $pageCount=$count/10;
             $this->assign('PageA',$PageA);
             $this->assign('count',$pageCount);*/

            $this->assign('info',$info);
            $this->display();
        } else {
            $this->display();
        }
    }
    /*
     * 竞赛查询
     */
    public function searchMatch()
    {
        if (IS_POST) {
            $action = "http://202.115.71.135/iv/re_search.do";
            $method = "POST";
            $ref = "http://202.115.71.135/iv/student/public/QueryCompetition.jsp";

            /*  base_com 全国大学生电子设计竞赛
                btn3 执行查询
                name
                url /student/public/QueryCompetition.jsp
                year 2012
            */
            $data = ['name' => '马俊鹏',
                'year' => '',
                'url' => '/student/public/QueryCompetition.jsp',//5,
                'base_com' => '全国大学生电子设计竞赛'
            ];
            $data = I('post.');
            $data['url']='/student/public/QueryCompetition.jsp';
            //$data['srtpProject.projCollege'] = $data["srtpProject_projCollege"];
            //unset($data["srtpProject_projCollege"]);
            //var_dump($data);
            $search = new SearchModel($action, $ref, $data, $method);
            $info = $search->getInfo();
            unset($info[0]);
            unset($info[1]);
            array_pop($info);
            //dump($info);
            //$info1=[];
            //echo $info;

            $this->assign('info',$info);
            $this->display();
        } else {
            $this->display();
        }
    }


    /*
            1
            公共
            201510613099
            “考了么”——高考志愿辅助填报系统
            15国家创业训练项目
            李静波/刘凤
            20134249 权圣威
            20132853 蒋洁滢
            20134245 张淳



            */
    /*
     * 科创信息查看，申报书等
     */
    public function read($proj_idDes)
    {
        //if(IS_POST){
        //$proj_idDes = I('post.proj_idDes');
        $html = http_get('http://202.115.71.131/iv/seeHisProject.action?proj_idDes='.$proj_idDes,'http://202.115.71.131');
        //var_dump($html);
        //new simple_html_dom()
        echo $html['FILE'];
        //import('@.SHD.simple_html_dom');

        $str= remove($html['FILE'],'width=','"');
        //$str=str_replace('width= ','',$html['FILE']);
        //$str.='</div>';
        //echo $str;
        //var_dump($html);
        $dom =  new simple_html_dom();
        $dom->load($str);
        $table = $dom->find('table');
        //$table[1]->width='';
        //echo $table[1]->outertext;
//var_dump($table);
        /*$body = return_between($html['FILE'],'<table width="652" border="0" cellpadding="4" cellspacing="1"
                           align="center">','</table>',EXCL);*/
        //$body.='</div>';
        $this->assign('body',$table[1]->outertext);
        $this->display();

        //}
    }

    /*public static function strInfo($info)
    {
        $infoArray=[];
        $k=-1;
        for($i=0;$i<strlen($info);$i++)
        {
            if($info[$i] != ''){

                if(!empty($infoArray[$k])){
                    $infoArray[$k].=$info[$i];
                }else{
                    $k++;
                    $infoArray[$k]=$info[$i];
                }
            }
        }
        return $infoArray;
    }*/


}