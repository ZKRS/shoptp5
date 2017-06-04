<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.6.4
 * Time: 19:46
 */

namespace app\admin\model;




class Goods extends \think\Model
{
    protected  $resultSetType = "collection";
    public function keywords(){
        return $this->belongsToMany('Keywords','shop_goods_keywords');
    }




}