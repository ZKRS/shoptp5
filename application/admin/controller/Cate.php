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
        $cate_select=db('cate')->select();//db助手函数
        $cate_model=model('Cate');
        $cate_list=$cate_model->getChildrenId($cate_select);
        $this->assign('cate_list',$cate_list);//$cate_list分配给cate_list模版
        return view('cate/catelist');
    }
}