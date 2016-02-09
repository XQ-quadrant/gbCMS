<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-1-17
 * Time: 下午11:13
 */

namespace Admin\Model;

use Think\Model;

class DocumentModel extends Model implements Atc
{
    //protected $tableName = '';
    public $id;

    public function editor(){

    }

    public function addAtc($cate){  //添加文档

        $title = $this->title ;
        $atc_id =$this->add();
        if($atc_id==false){
            $this->error='添加失败';
            return false;
        }
        $cate_atc = M('cate_atc');
        $cate_atc->atc_id = $atc_id;
        $cate_atc->cate = $cate ;
        $cate_atc->title = $title ;

        $cate_atc->createtime = date('y-m-d-h-m-s') ;
        $cate_atc->model_id = M('model')->field('id')->where(['name'=>$this->trueTableName])->find();
        $cate_atc->status=1;
        if($cate_atc->add()){
            return true;
        }else{
            $this->delete();
            $this->error='添加失败';
            return false;
        }
    }

    public function deleteAtc(){

    }

    public function detail($id){
        //$status = $this->query("select status from {$this->trueTableName} WHERE id=$this->id");
        $atcInfo = $this->query("select * from cate_atc WHERE id=$id");
        //var_dump($atcInfo);

        if($atcInfo[0]['status']==1){
            $atcContent = $this->where('id=%d',$atcInfo[0]['atc_id'])->find();
            //$atcInfo = $this->query("select title from {$this->trueTableName} WHERE id=$this->id");
            $atcInfo+=$atcContent;
            return $atcInfo;
        }else{
            return 'h';//$this->getDbError();
            //返回状态信息
        }

    }

}