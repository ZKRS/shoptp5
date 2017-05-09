<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.9
 * Time: 21:57
 */

namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'goods_name' => 'require|max:90',
        'goods_thumb' => 'require',
        'goods_price' => 'egt:1|integer',
        'goods_sales' => 'egt:0|integer',
        'goods_inventory' => 'egt:0|integer'
    ];


}

?>