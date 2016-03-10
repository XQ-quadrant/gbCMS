<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-6
 * Time: 上午1:26
 */

namespace Admin\Model;


use Think\Model;

class TeamModel extends Model implements Atc
{
    protected $tableName='team';

    protected $mid = 5;

    /**获取对应编辑内容
     * @param $id 内容id
     * @return mixed
     */
    public function editor($id){  //获取编辑内容

        return $this->field(['content','race','limit_member','already_member'])->find($id);

    }

    public function addAtc($cate){  //添加文档

        $title = $this->title;
        $this->uid = session('id');

        $atc_id =$this->add();
        if($atc_id==false){
            $this->error='添加失败';
            return false;
        }
        $cate_atc = M('cate_atc');
        $cate_atc->atc_id = $atc_id;
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
        //var_dump($atcInfo);

        if($teamIndex[0]['status']==1){  //状态确认
            $teamContent = $this->where('id=%d',$teamIndex[0]['atc_id'])->find();
            $userInfo = get_user_info($teamContent['uid'],['name','signature','pic']);
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
    /*public function listView(&$list,$modelInfo){
        $listExtra = implode(',',$modelInfo['list_extra']['index']); //列表附加项，如：user
        $reList =[];
        foreach($list as $k=>$v){
            if(in_array($this->mid,$list['model'])){
                $raw = $this->query("select {$listExtra} from {$modelInfo['identity']} where id = {$v['atc_id']}");
                $reList[$k] = array_merge($v,$raw);
                unset($list[$k]);
                echo $list[$k];
                //var_dump($list);

            }
        }
        return $reList;
    }*/
}