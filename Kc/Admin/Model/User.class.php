<?php
/**
 * Created by PhpStorm.
 * User: xq
 * Date: 16-3-4
 * Time: 下午4:14
 */
namespace Admin\Model;


interface User
{
    public function login();

    public function register();

    public function logout();

}