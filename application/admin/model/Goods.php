<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.6.29
 * Time: 22:10
 */

namespace app\admin\model;

/**
    belongToMany参数:
        1. 关联模型名
        2. 中间表名
        3. 外键名
        4. 当前模型关联键名


*/
class Goods extends \think\Model
{
    protected $resultType = "collection";

    public function keywords(){
        return $this->belongsToMany('Keywords','shop_goods_keywords');
    }
    public function cate(){
        return $this->belongsTo('Cate',"goods_pid");
    }

}