<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.14
 * Time: 20:05
 */

namespace app\index\controller;


class Goods extends \think\Controller
{
    public function goodslist($goods_pid = "")
    {
        if ($goods_pid == "") {
            $this->redirect('index/index');
        }
        $goods_select = db('goods')->where("goods_status", "eq", 1)->where('goods_pid', 'eq', $goods_pid)->paginate(1);
        dump($goods_select);
        die;
        $this->assign('goods_select', $goods_select);
        return view('goods/goodslist');
    }
}


}
