<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.6.4
 * Time: 21:08
 */

namespace app\admin\model;


class Keywords extends \think\Model
{
    protected $resultSetType = 'collection';

    public function goods()
    {
        return $this->belongsToMany('Goods', 'shop_goods_keywords');
    }

}