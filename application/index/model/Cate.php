<?php

/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.6
 * Time: 14:18
 */

namespace app\index\model;
class Cate extends \think\Model
{
    public function getChildren($cate_list, $pid = 0)
    {
        $arr = array();
        foreach ($cate_list as $key => $value) {
            if ($value['cate_pid'] == $pid) {
                $value['children'] = $this->getChildren($cate_list, $value['id_cate']);
                $arr[] = $value;
            }
        }
        return $arr;
    }
}