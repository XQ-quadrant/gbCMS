<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-6
 * Time: 上午1:26
 */

namespace Common\Model;


use Think\Model;

class TeamModel extends Model implements Atc
{
    protected $tableName='team';

    protected $mid = 5;

    public $strLimit = 45;

    /**获取对应编辑内容
     * @param $id 内容id
     * @return mixed
     */
    public function editor($id){  //获取编辑内容

        return $this->field(['content','race','limit_member','already_member'])->find($id);

    }

    public function addAtc($cate){  //添加文档

        $title = $this->title;
        //$userId = empty($this->openid)?session('id'):$this->openid;
        $userId['id'] = session('id');
        $userId['openid'] = $this->openid;
        $userInfo = get_user_info($userId,['name','id']);
        $this->uname = $userInfo['name'];

        $atc_id =$this->add();
        if($atc_id==false){
            $this->error='添加失败';
            return false;
        }
        $cate_atc = M('cate_atc');
        $cate_atc->atc_id = $atc_id;
        $cate_atc->uid = $userInfo['id'];
        //$cate_atc->author = session('id');
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
        $teamIndex = $this->query("select * from cate_atc WHERE id={$id}");
        //var_dump($teamIndex);

        if($teamIndex[0]['status']==1){  //状态确认
            $teamContent = $this->where('id=%d',$teamIndex[0]['atc_id'])->find();
            //var_dump($teamContent);
            $userInfo = get_user_info($teamIndex[0]['uid'],['name']);

            if($userInfo==null){
                return false;
            }
            $teamContent+= $userInfo;
            //$atcInfo = $this->query("select title from {$this->trueTableName} WHERE id=$this->id");
            $teamIndex[0]+=$teamContent;
            return $teamIndex[0];
        }else{
            return 'h';//$this->getDbError();
            //返回状态信息
        }

    }

    /**列表内容获取
     * @param $list
     */
    public function listView(&$list,$modelInfo,$module = 'admin'){
        $listExtra = implode(',',$modelInfo['list_extra'][$module]); //列表附加项，如：user
        $reList =[];
        //echo $listExtra;
        foreach($list as $k=>$v){
            if($this->mid==$v['model_id']){
                $raw = $this->query("select {$listExtra} from {$modelInfo['identity']} where id = {$v['atc_id']}");
//var_dump($raw);
                if(mb_strlen($raw[0]['content'],'utf-8')>$this->strLimit){
                    $raw[0]['content']= mb_substr($raw[0]['content'],0,$this->strLimit,'utf-8');
                    $raw[0]['content'].='……';
                }
                //echo $raw['content'];
                $reList[$k] = array_merge($v,$raw[0]);

                unset($list[$k]);
            }
        }
        return $reList;
    }
}