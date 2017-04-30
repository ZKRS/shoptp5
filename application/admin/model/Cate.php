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
    //由父类id得到全部子类
   public function getChildrenId($cate_list,$pid=0){
       static $arr = array();
       foreach ($cate_list as $key => $value){
           if($value['cate_pid']==$pid){
               if($pid!=1){
                   $value['str']=str_repeat('----',$value['cate_level']-1);
               }else{
                   $value['str']="";
               }
               $arr[]=$value;
               $this->getChildrenId($cate_list,$value['id_cate']);
           }
       }
        return $arr;

   }
}