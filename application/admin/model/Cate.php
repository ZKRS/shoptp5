<?php

/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.4.28
 * Time: 20:46
 * 模型类名取名和对应操作的数据表名后缀一致
 * 商品分类模型
 */

namespace app\admin\model;
class Cate extends \think\Model
{
    protected $resultSetType = 'collection';
    //由父类id得到全部子类
    public function getChildrenId($cate_list, $pid = 0, $level = 1)
    {
        static $arr = array();
        foreach ($cate_list as $key => $value) {
            if ($value['cate_pid'] == $pid) {
                $value['cate_level'] = $level;
                $value['str'] = str_repeat('----', $value['cate_level'] - 1);
                $arr[] = $value;
                $this->getChildrenId($cate_list, $value['id_cate'], $level + 1);
            }
        }
        return $arr;
    }

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

    /**
     * @param $cate_list
     * @param $id
     * 由子类id遍历全部父类
     */
    public function getFather($cate_list, $pid)
    {
        $arr = array();
        foreach ($cate_list as $key =>$value){
            if($value['id_cate'] == $pid){
                $value['father'] = $this->getFather($cate_list,$value['cate_pid']);
                $arr[] = $value;
            }
        }
        return $arr;
    }

    /**
     *由子类id遍历全部父类
     */
    public function getFatherId($cate_list, $pid)
    {
        static $arr = array();
        foreach ($cate_list as $key => $value) {
            if ($value['id_cate'] == $pid) {
                array_unshift($arr, $value);
                $this->getFatherId($cate_list, $value['cate_pid']);
            }
        }
        return $arr;
    }
    public function goods(){
        return $this->belongsTo('Goods');
    }
}