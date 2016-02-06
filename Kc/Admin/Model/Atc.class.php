<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-3
 * Time: 下午3:34
 */

namespace Admin\Model;

interface Atc
{
    public function detail();
    public function addAtc($cate);
    public function editor();
    public function deleteAtc();

}