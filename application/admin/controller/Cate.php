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
        $cate_total=count($cate_list);
        $page_class=new \app\admin\controller\Page($cate_total,3);
        $show=$page_class->fpage();
        $limit=$page_class->setLimit();
        $limit=explode(',',$limit);
        $list=array_slice($cate_list,$limit[0],$limit[1]);
        $this->assign('show',$show);
        $this->assign('cate_list',$cate_list);//$cate_list分配给cate_list模版
        return view('cate/catelist');
    }
    public function add(){
        $cate_select=db('cate')->select();
        $cate_model=model('Cate');
        $cate_list=$cate_model->getChildrenId($cate_select);
        $this->assign('cate_list',$cate_list);
        return view('cate/add');
    }
    public function addhandle(){
        $post=request()->post();
        dump($post);
    }
}