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
    public function goodslist1($goods_pid = "")
    {
        if ($goods_pid == "") {
            $this->redirect('index/index');
        }
        $goods_select = db('goods')->where("goods_status", "eq", 1)->where('goods_pid', 'eq', $goods_pid)->paginate(1);
        $this->assign('goods_select', $goods_select);
        return view('goods/goodslist');
    }

    public function goodslist($goods_pid="",$goods_order='id'){
        if($goods_pid==""){
            $this->redirect("index/index");
        }
        $goods_exist = db("goods")->where("goods_pid","eq",$goods_pid)->where("goods_status","eq","1")->select();
        if(empty($goods_exist)){
            $this->redirect("index/index");
        }
        if($goods_order=='goods_sales'){
            $goods_order = 'goods_sales desc';
        }else if($goods_order=='goods_price_asc'){
            $goods_order = 'goods_price asc';
        }else if($goods_order=='goods_price_desc'){
            $goods_order = 'goods_price desc';
        }else{
            $goods_order = 'goods_id';
        }



        $goods_model = new \app\admin\model\Goods;

        $goods_all = $goods_model->all(function ($query) use ($goods_pid,$goods_order) {
            $query->where('goods_pid', 'eq', $goods_pid)->where('goods_status','eq','1')->order($goods_order);

        });

        $goods_all_toArray = $goods_all;
        $goods_info = array();
        foreach ($goods_all_toArray as $key => $value) {
            $goods_get = $goods_model->get($value['goods_id']);

            $goods_keywords = $goods_get->keywords;
            $goods_keywords_toArray = $goods_keywords->toArray();
            $value['keywords'] = $goods_keywords_toArray;

            $goods_cate = $goods_get->cate;
            $goods_cate_toArray = $goods_cate->toArray();
            $value['cate_name'] = $goods_cate_toArray['cate_name'];

            $goods_info[] = $value;
        }
        $this->assign('goods_info', $goods_info);
        $goods_total = count($goods_info);
        $page_class = new \app\admin\controller\Page($goods_total, 4);
        $show = $page_class->fpage();
        $limit = $page_class->setlimit();
        $limit = explode(',',$limit);
        $list = array_slice($goods_info,$limit[0],$limit[1]);
        $this->assign('show',$show);
        $this->assign('goods_info',$list);
        $this->assign('goods_pid',$goods_pid);
        return view('goods/goodslist');
    }
}



