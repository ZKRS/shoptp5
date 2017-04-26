<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.4.24
 * Time: 22:10
 */

namespace app\admin\controller;


/**
 * Class Cate
 * @package app\admin\controller\
 * 商品列表的控制器
 */
class Cate extends \think\Controller
{
    //分类列表
    public function cateList(){
        return view('cate/catelist');
    }
}