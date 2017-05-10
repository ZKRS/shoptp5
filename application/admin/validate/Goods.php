<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.9
 * Time: 21:57
 */

namespace app\admin\validate;

use think\Validate;

/**
 * Class Goods
 * @package app\admin\validate
 * 商品添加时数据的验证
 */
class Goods extends Validate
{
    protected $rule = [
        'goods_name' => 'require|max:90',
        'goods_thumb' => 'require',
        'goods_price' => 'require|egt:1|integer',
        'goods_sales' => 'require|egt:0|integer',
        'goods_inventory' => 'require|egt:0|integer',
        'goods_pid' => 'require',
    ];
    protected $message = [
        'goods_name.require' => '请输入商品名称',

    ];

}

?>