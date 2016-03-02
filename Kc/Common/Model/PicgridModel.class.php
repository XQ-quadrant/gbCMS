<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-24
 * Time: 下午9:13
 */

namespace Common\Model;

use Think\Model;
use Think\Model\RelationModel;

class PicgridModel extends Model //implements Atc
{
    public $mid = 3;
    public $config = array(
    'maxSize'    =>    3145728,
    'rootPath'   =>    './Public',
    'savePath'   =>    '/Uploads/',
    'saveName'   =>    array('uniqid',''),
    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','jpga'),
    'autoSub'    =>    true,
    //'subName'    =>    array('PicgridName',[date(),]),
    );
    public $thumb= 'thumb/';
    /**
     * @param $id
     * @return array
     */
    public function detail($id){

    }

    /**
     * @param $cate
     * @return mixed
     */
    public function addAtc($cate){
        //$title = $this->title;
        $upload = new \Think\Upload($this->config);
        $upload->saveName = ['Common\Model\PicgridModel::picgridName'];//$_POST['author'];
        $upload->subName = ['Common\Model\PicgridModel::picgridSub'];//$_POST['author'];

        $info = $upload->upload();

        //$upload->saveName=$this->picgridName();
        $cate_atc = M('cate_atc');    //引索存储
        $image = new \Think\Image();  //制造缩略图
        if(!$info) {            // 上传错误提示错误信息
            $this->error=$upload->getError();
        }else{                 // 上传成功 获取上传文件信息
            foreach($info as $file){
//                $file['title'] = $_POST['title'];
//                $file['content'] = $_POST['content'];
                $file = array_merge($file,I('post.'));
                $this->create($file);
                $atc_id =$this->add();
                if($atc_id==false){
                    $this->error='存储失败';
                    return false;
                }
                $picName = './Public'.$file['savepath'].$file['savename'];
                $picThunbName = './Public'.$file['savepath'].'thumb/'.$file['savename'];
                chmod('./Public'.$file['savepath'],0777);
                chmod($picName,0777);

                //echo './Public/'.substr($file['savepath'],2).'thumb/hehe.jpg';
                $image->open($picName);

                if (!file_exists('./Public/'.$file['savepath'].'thumb')){
                    mkdir ('./Public'.$file['savepath'].'thumb');
                    chmod('./Public'.$file['savepath'].'thumb',0777);
                }
                $image->thumb(500, 600)->save($picThunbName);
                chmod($picThunbName,0777);
                $cate_atc->atc_id = $atc_id;
                $cate_atc->cate = $cate ;
                $cate_atc->title = $_POST['title'];  //$file['savename'] ;
                $cate_atc->createtime = date('y-m-d H:i:s') ;
                $cate_atc->model_id = $this->mid;
                $cate_atc->status=1;
                if($cate_atc->add()){
                    return true;
                }else{
                    $this->delete($atc_id);
                    $this->error='添加失败';
                    return false;
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function editor(){

    }

    /**
     * @param $cate
     * @param $id
     * @return bool
     */
    public function delete($id){
        //$this->field()
        $raw = $this->field(['savename','savepath'])->find($id);
        //echo $raw['savepath'];
        $picName = $this->config['rootPath'].$raw['savepath'].$raw['savename']; //原图地址
        $picThunbName = $this->config['rootPath'].$raw['savepath'].'thumb/'.$raw['savename']; //缩略图地址
        //echo $picName;
        chmod($picName,0777);
        chmod($picThunbName,0777);
        $a = unlink($picThunbName);
        $b = unlink($picName);
        if($a&&$b){
            return parent::delete($id);
        }else{
            return false;
        }

    }


    public static function picgridName(){

        return $_POST['title'].'_'.time();
    }

    public static function picgridSub(){

        return $_POST['author'];
    }

}