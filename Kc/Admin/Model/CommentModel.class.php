<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-2-10
 * Time: 下午3:08
 */

namespace Admin\Model;


use Think\Model;


class CommentModel extends Model
{
    // 定义自动验证
    protected $_validate    =   array(
        array('content','require','评论内容不可为空！'),

    );
    // 定义自动完成
    protected $_auto    =   array(
        array('createtime','time',3,'function'),
        array('status','1'),
    );

}
