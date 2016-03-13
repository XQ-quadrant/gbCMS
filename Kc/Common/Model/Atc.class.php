<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-3
 * Time: 下午3:34
 */

namespace Common\Model;

interface Atc
{
    /**
     * @param $id
     * @return array
     */
    public function detail($id);  //查

    /**
     * @param $cate
     * @return mixed
     */
    public function addAtc($cate); //添

    /**
     * @return mixed
     */
    public function editor($id);       //改

    /**
     * @param $cate
     * @param $id
     * @return bool
     */
    public function deleteAtc($cate,$id); //删

}