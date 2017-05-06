<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.6
 * Time: 20:04
 */

namespace app\admin\controller;


class Goods extends \think\Controller
{
    /**
     * 商品添加
     */
    public function add(){
        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list = $cate_model->getChildrenId($cate_select,0);
        $this->assign('cate_list',$cate_list);
        return view();
    }


}