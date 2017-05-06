<?php
namespace app\index\controller;

class Index extends \think\Controller
{
    public function index(){
        $cate_select = db('cate')->select();
//        dump($cate_select);//将查询的结果保存至数组中,一条记录就是数组中的一个元素
        $cate_model = model('Cate');
        $cate_list=$cate_model->getChildren($cate_select);
//        dump($cate_list);die;//将查询的数组按树级结构存储
        $this->assign('cate_list', $cate_list);
        return view();
    }
}
