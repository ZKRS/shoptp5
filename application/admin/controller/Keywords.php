<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.6.3
 * Time: 20:24
 */

namespace app\admin\controller;


class Keywords extends \think\Controller
{
    /**
     * @return \think\response\View
     * 从数据库中读取关键字,并显示在列表中
     */
    public function keywordslist()
    {
        $keywords_select = db("keywords")->paginate(2);
        if ($keywords_select) {
            $this->assign("keywords_select", $keywords_select);
            return view();
        } else {
            $this->redirect("index/index");
        }
    }

    /**
     * 给用户添加自定义关键字
     */
    public function add(){
        return view();
    }



}