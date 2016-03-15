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

}