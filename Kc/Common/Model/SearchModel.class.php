<?php
/**
 * Created by PhpStorm.
 * User: quadrantone
 * Date: 2015/10/7
 * Time: 0:26
 */
namespace Common\Model;
use Think\Model;
use Org\SHD\simple_html_dom;

class SearchModel extends Model
{
    public $action;
    public $method;
    public $ref ;
    public $data ;
    public $page;

    public function _initialize($action = null,$ref,$data,$method )
    {
        $this->action=$action;
        $this->method = $method;
        $this->method = $ref;
        $this->data =$data;
    }

    public static function getRaw($action,$ref,$data,$method ="POST")
    {
        /*self::action =$action;//"http://202.115.71.131/iv/queryPastPro.do?url=In";
        $method ="POST";
        $ref = "http://202.115.71.131/iv/queryPastPro.do?url=In";
        $data = ['name'=>'张逊桥',
        'btn'=>'执行查询',
            'qishuId'=>'',//5,
            'srtpProject.projCollege'=>'信息科学与技术学院'
        ];*/

        //import('LIB.LIB_http.php');
        //require_once('../../LIB/LIB_http.php');
        $response = http($target=$action,$ref,$method,$data,EXCL_HEAD);
        return $response;
        //输入项目名 或者 参与人员 的学号 或您的 姓名 或指 导教师姓名
        //"/iv/queryPastPro.do?url=In"
        //name  srtpProject.projCollege  qishuId
        //name=&srtpProject.projCollege=%E4%BF%A1%E6%81%AF%E7%A7%91%E5%AD%A6%E4%B8%8E%E6%8A%80%E6%9C%AF%E5%AD%A6%E9%99%A2&qishuId=5&btn=%E6%89%A7%E8%A1%8C%E6%9F%A5%E8%AF%A2
    }

    public function getInfo() //获取查询信息
    {
        $rawInfo = self::getRaw($this->action,$this->ref,$this->data);
        //import('SHD.simple_html_dom');
        $infoArray = parse_array($rawInfo['FILE'],'<tr>','</tr>');
        $tr=[];
        $this->page = end($infoArray);
        foreach($infoArray as $k=>$v)
        {
            $tb =parse_array($v,'<td','</td>');
            $temp = get_attribute($tb[7],'href') ;
            $temp=split_string($temp,'proj_idDes=',AFTER,EXCL);
            $tb[7] = remove($tb[7],'<a','>') ;
            $tb[7] = remove($tb[7],'</a','>') ;
            $temp2 = $tb[7];
            $tb[7] = [];
            $tb[7][] =$temp2;
            $tb[7][] = $temp;

            $temp4= get_attribute($tb[8],'href') ;
            $temp4=split_string($temp4,'proj_idDes=',AFTER,EXCL);
            $tb[8] = remove($tb[8],'<a','>') ;
            $tb[8] = remove($tb[8],'</a','>') ;
            $temp3 = $tb[8];
            $tb[8] = [];
            $tb[8][] =$temp3;
            $tb[8][] = $temp4;
            $tr[]=$tb;//parse_array($v,'<td','</td>');
            //var_dump($tr);
        }
        /*
         [4]=> array(9) { [0]=> string(37) "3" [1]=> string(30) "信息" [2]=> string(49) "201510613089 " [3]=> string(78) "基于人体肢体语言的机械臂操控" [4]=> string(62) "15国家创新训练项目" [5]=> string(45) "张翠芳" [6]=> string(185) "20132235 刘炳楠
20132312 覃勇杰
20132230 李晓芳
20132169 涂敏
" [7]=> string(145) "查看 " [8]=> string(158) " 成果展" }
          */
        /*$html=new simple_html_dom();
        $html->load($rawInfo["FILE"]);
        //var_dump($html);
//return $rawInfo;
        $infoArray = $html->find('tr');*/

        return $tr;


    }

    public function getMatchInfo()
    {
        $rawInfo = self::getRaw($this->action,$this->ref,$this->data);
        return $rawInfo;
    }

    public function getPage(){

    }
}