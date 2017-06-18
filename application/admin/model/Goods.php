<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.6.10
 * Time: 11:36
 */

namespace app\admin\model;


class Goods extends \think\Model
{
    protected $resultSetType = "collection";

    public function keywords()
    {
        return $this->belongsToMany('Keywords', 'shop_goods_keywords');
    }

    /**
     * @return \think\model\relation\BelongsTo
     * 一个分类下有很多商品
     */
    public function cate()
    {
        return $this->belongsTo('Cate', 'goods_pid');
    }


}