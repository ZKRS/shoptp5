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
class Keywords extends Validate
{
    protected $rule = [
        'keywords_name' => 'require|max:90|unique:keywords,keywords_name',

    ];
    protected $message = [
        'keywords_name.require' => '请输入商品名称',
        'keywords_name.unique' => '关键字已经存在',

    ];

}

?>