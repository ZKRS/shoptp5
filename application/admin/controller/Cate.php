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
    public function cateList()
    {
        $cate_select = db('cate')->select();//db助手函数
        $cate_model = model('Cate');
        $cate_list = $cate_model->getChildrenId($cate_select);
        $cate_total = count($cate_list);
        $page_class = new \app\admin\controller\Page($cate_total, 3);
        $show = $page_class->fpage();
        $limit = $page_class->setLimit();
        $limit = explode(',', $limit);
        $list = array_slice($cate_list, $limit[0], $limit[1]);
        $this->assign('show', $show);
        $this->assign('cate_list', $cate_list);//$cate_list分配给cate_list模版
        return view('cate/catelist');
    }

    public function add()
    {
        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list = $cate_model->getChildrenId($cate_select);
        $this->assign('cate_list', $cate_list);
        return view('cate/add');
    }

    /**
     * 添加分类提交的处理
     */
    public function addhandle()
    {

        $post = request()->post();
        $cate_add = db('cate')->insert($post);
        if ($cate_add) {
            $this->success("分类添加成功", 'cate/catelist');
        } else {
            $this->error("分类添加失败", "cate/catelist");
        }
    }

    /**
     * 修改分类
     */
    public function update($id_cate)
    {
        if ($id_cate == "") {
            $this->redirect('cate/catelist');
        }
        $cate_find = db('cate')->find($id_cate);
        if ($cate_find == "") {
            $this->redirect('cate/catelist');
        }
        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list = $cate_model->getChildrenId($cate_select);
        $this->assign('cate_list', $cate_list);
        $this->assign('cate_find', $cate_find);
        return view('cate/update');
    }
    public function updatehanddle(){
        $post = request()->post();
        $cate_upd_result = db('cate')->update($post);
        if($cate_upd_result){
            $this->success('分类修改成功','cate/catelist');
        }
    }
}