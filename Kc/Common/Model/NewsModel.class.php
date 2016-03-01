<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-1-17
 * Time: 下午11:13
 */

namespace Common\Model;

use Think\Model;
use Think\Model\RelationModel;
class NewsModel extends Model implements Atc
{
    //protected $tableName = '';
    /*protected $_link = array(
        'cate_atc'=>[
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'cate_atc',
            'foreign_key' => 'index_id',
            //'mapping_fields '

        ]
    );*/
    public $id;
    protected $mid = 2;

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

        $cate_atc->createtime = date('y-m-d H:i:s') ;

        //$modelInfo = M('model')->field('id')->where(['identity'=>$this->trueTableName])->find();
        $cate_atc->model_id = $this->mid;//$modelInfo['id'];
        $cate_atc->status=1;
        if($cate_atc->add()){
            return true;
        }else{
            $this->delete($atc_id);
            $this->error='添加失败';
            return false;
        }
    }

    public function deleteAtc($cate=0,$id=0){
        $this->delete();
        //$article =

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

}