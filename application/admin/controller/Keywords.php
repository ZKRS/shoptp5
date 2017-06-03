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
    public function add()
    {
        return view();
    }

    /**
     * 用户添加分类post方式,提交给服务器
     * 服务器端接收并存入数据库
     */
    public function addhandle()
    {
        $post = request()->post();
        $validate = validate('keywords');
        //TODO://使用Ajax来异步验证,不用来回跳转的方式
        if (!$validate->check($post)) {
            $this->error($validate->getError(),'keywords/add');
        }
        $keywords_add_result = db('keywords')->insert($post);
        if ($keywords_add_result) {
            $this->success('关键字添加成功', 'keywords/keywordslist');
        } else {
            $this->error('关键字添加失败', 'keywords/keywordslsit');
        }

//        dump($post);
    }

}