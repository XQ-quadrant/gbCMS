<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-14
 * Time: 上午2:22
 */

namespace Common\Model;


use Admin\Model\CateAtcModel;
use Think\Model;

class SrtphireModel extends Model
{
    protected $tableName = 'srtphire';


    protected $mid = 7;
    public function test(){
        $info = $this->field(['id','title'])->select();
        $aIndex = new CateAtcModel();
        foreach($info as $v){
            $aIndex->title = $v['title'];
            $aIndex->atc_id = $v['id'];
            $aIndex->model_id = 7;
            $aIndex->cate = 26;
            $aIndex->status = 1;
            $aIndex->add();
        }
    }

    public function detail($id){
        //$status = $this->query("select status from {$this->trueTableName} WHERE id=$this->id");
        $atcInfo = $this->query("select * from cate_atc WHERE id={$id}");
        //var_dump($atcInfo);

        if($atcInfo[0]['status']==1){
            $atcContent = $this->where('id=%d',$atcInfo[0]['atc_id'])->find();
            //$atcInfo = $this->query("select title from {$this->trueTableName} WHERE id=$this->id");
            $atcInfo[0]+=$atcContent;
            return $atcInfo[0];
        }else{
            return 'h';//$this->getDbError();
            //返回状态信息
        }

    }

    public function listView(&$list,$modelInfo,$module = 'index'){
        $listExtra = implode(',',$modelInfo['list_extra'][$module]); //列表附加项，如：user
        $reList =[];
        foreach($list as $k=>$v){
            if($this->mid==$v['model_id']){
                $raw = $this->query("select {$listExtra} from {$modelInfo['identity']} where id = {$v['atc_id']}");
                /*if(mb_strlen($raw[0]['content'],'utf-8')>$this->strLimit){
                    $raw[0]['content']= mb_substr($raw[0]['content'],0,$this->strLimit,'utf-8');
                    $raw[0]['content'].='……';
                }*/
                $date = date_create($raw[0]['original_time']);
                $raw[0]['original_time'] = $date->format('m-d');
                //$raw[0]['original_time']='cx';// date_format($raw[0]['original_time'],'%m月%d日');
                $reList[$k] = array_merge($v,$raw[0]);

                unset($list[$k]);
            }
        }
        return $reList;
    }

}