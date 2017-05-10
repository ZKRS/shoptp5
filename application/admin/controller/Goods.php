<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017.5.6
 * Time: 20:04
 */

namespace app\admin\controller;


class Goods extends \think\Controller
{
    /**
     * 商品添加
     */
    public function add()
    {
        if (session('goods_thumb')) {
//            dump(session('goods_thumb'));
            $url = str_replace(DS . 'shoptp' . DS . 'public', '.', session('goods_thumb'));
//            dump($url);
            if (file_exists($url)) {//防止手动删除至upload中的缩略图文件或者文件名改变
                unlink($url);
            }
        }
        session('goods_thumb', null);//刚进入到此界面时,要清空用户session信息
        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list = $cate_model->getChildrenId($cate_select, 0);
        $this->assign('cate_list', $cate_list);
        //获取无限极分类列表
        $cate_list1 = $cate_model->getChildren($cate_select, 0);
        $this->assign('cate_list1', $cate_list1);
        return view();
    }

    /**
     * jquery插件商品缩略图上传
     * 上传完图片,没有提交的时候有session,提交结束后就要清空session
     */
    public function uploadthumb()
    {
        //获取表单上传的文件
        $file = request()->file('goods_thumb');
        //移动到框架应用根目录/public/uploads下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
        if ($info) {
            $address = DS . 'shoptp' . DS . 'public' . DS . 'upload' . DS . $info->getSaveName();
            session('goods_thumb', $address);
            return $address;
        } else {
            echo $file->getError();
        }
    }

    /**
     * 添加商品表单上传处理
     */
    public function addhandle()
    {
        $post = request()->post();
        $post['goods_thumb'] = session('goods_thumb');
        $post['goods_status'] = isset($post['goods_status']) ? $post['goods_status'] : '0';
        $post['goods_pid'] = isset($post['goods_pid']) ? $post['goods_pid'] : null;
        $validate = validate('Goods');
        if(!$validate->check($post)){
            dump($validate->getError());
        }
        dump($post);//打印得到的表单中的数据,键值对数组:字段名=>值
        $goods_add_result = db('goods')->insert($post);
        if($goods_add_result){
            $this->success('添加商品成功','cate/catelist');
        }else{
            $this->error('添加商品失败','');
        }
        session('goods_thumb', null);
    }

    /**
     * 用户删除上传的图像
     */
    public
    function cancelthumb()
    {
        if (request()->isAjax()) {
            if (session('goods_thumb')) {
                $url = str_replace(DS . 'shoptp' . DS . 'public', '.', session('goods_thumb'));
                if (file_exists($url)) {
                    unlink($url);
                }
            }
            session('goods_thumb', null);

            return json(['status' => 'success', 'message' => 'cancel success']);
        }
    }


}