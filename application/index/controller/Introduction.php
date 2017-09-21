<?php
/**
 * Created by PhpStorm.
 * User: 25851
 * Date: 2017.4.23
 * Time: 0:43
 */

namespace app\index\controller;


class Introduction extends \think\Controller
{
    public function index(){
        return view('introduction\introduction');
    }
}