<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-10
 * Time: 下午3:08
 */

namespace Common\Model;


use Think\Model;
use Think\Model\RelationModel;

class CateAtcModel extends RelationModel
{
    /*protected $_link = array(
        'document'=>[
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'cate_atc',
            'foreign_key' => 'index_id',
            //'mapping_fields '

        ]
    );*/

    protected $linkClass;

    public function linkSet($linkName =''){
        if($linkName!=''){
            $this->linkClass = $linkName;
        }
        elseif(isset($this->_map['id'])){
            $m_id = $this->field("mid")->find();
            $model = D('model');
            $raw = $model->query("select link,`name` from model WHERE id = {$m_id['mid']}");
            $this->_link[$raw[0]['name']] = json_decode($raw[0]['link']);
            $this->linkClass = $raw[0]['name'];
        }
        return $this;
    }

    public function delete_h($id){
        $atcInfo = $this->find($id);
        $modelInfo = get_model_info($atcInfo['model_id']);
        $model =D($modelInfo['identity']);
        $model->delete($this->atc_id);
        if($this->delete()){
            return true;
        }
    }

}