<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-14
 * Time: 上午1:16
 */

namespace Home\Controller;


use Think\Controller;

class KcController extends Controller {

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