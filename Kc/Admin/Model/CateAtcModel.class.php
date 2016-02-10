<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-10
 * Time: 下午3:08
 */

namespace Admin\Model;


use Think\Model;

class CateAtcModel extends Model
{
    public function deleteIndex(){
        $atcInfo = $this->find();
        $modelInfo = get_model_info($atcInfo['model_id']);
        $model =D($modelInfo['name']);
        $model->delete($this->atc_id);
        if($this->delete()){
            return true;
        }
    }

}