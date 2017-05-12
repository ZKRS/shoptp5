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
            if (file_exists($url)) {//防止手动删除upload中的缩略图文件或者文件名改变
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
        $result = [];

        $validate = validate('Goods');
        if (!$validate->batch()->check($post)) {
            $this->assign("goods", $post);
            $result = [
                'status' => 2,
                'message' => "发生错误",
                'errors' => $validate->getError()
            ];

            return json($result);
        }
        $goods_add_result = db('goods')->insert($post);
        session('goods_thumb', null);
        if ($goods_add_result) {
            $result = [
                'status' => 1,
                'message' => "添加成功",
                'errors' => [],
                'url' => url('admin/goods/goodslist', ['goods_pid' => $post['goods_pid']])
            ];

            return json($result);
        } else {
            $result = [
                'status' => 0,
                'message' => "添加失败",
                'errors' => []
            ];

            return json($result);
        }

    }

    /**
     * 用户删除上传的图像
     */
    public function cancelthumb()
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

    /**
     * 商品列表显示
     */
    public function goodslist($goods_pid = "")
    {
//        dump($goods_select);die;
//        foreach ($goods_select as $key => $value) {
//            $goods_select[$key]['goods_price'] = $value['goods_price'] / 100;
//        }

        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list1 = $cate_model->getChildren($cate_select, 0);
        $this->assign('cate_list1', $cate_list1);

        $cate_find = db("cate")->find($goods_pid);
        if ($cate_find) {
            $goods_select = db('goods')->where('goods_pid', 'eq', $goods_pid)->join('shop_cate', 'shop_cate.id_cate = shop_goods.goods_pid')->select();
//            dump($goods_select);die;
            $this->assign('goods_select', $goods_select);
        } else {
            $this->assign('goods_select', "");
        }
        return view('goods/goodslist');
    }

    /**
     * 商品列表中删除商品信息
     */
    public function del($goods_id = "")
    {
        if ($goods_id == "") {
            $this->redirect("goods/goodslist");
        }
        $goods_find = db("goods")->find($goods_id);
//        dump($goods_find);die;
        if ($goods_id == null) {
            $this->redirect("goods/goodslist");
        }
        if ($goods_find['goods_thumb']) {//删除缩略图文件
            $url = str_replace(DS . "shoptp" . DS . "public", ".", $goods_find['goods_thumb']);
            if (file_exists($url)) {
                unlink($url);
                $goods_del_results = db("goods")->delete($goods_id);//delete方法返回删除影响的条数,没有删除返回0
                $this->success('删除此记录成功', url('admin/goods/goodslist', ['goods_pid' => $goods_find['goods_pid']]));
            }
        } else {
            $this->error('删除此记录失败', url('admin/goods/goodslist'));

        }

    }

    /**
     * 商品列表中修改某页面
     */
    public function update($goods_id = "")
    {

        if ($goods_id == 0) {
            $this->redirect('goods/goodslist');
//            return view('goods/goodslist');
        }
        $goods_find = db('goods')->find($goods_id);
//        dump($goods_find);die;
        if (empty($goods_find)) {
            $this->redirect('goods/goodslist');
        }
        if (session('goods_thumb') != $goods_find['goods_thumb']) {//如果有session,就把session图片路径对应的图片删除(错误的信息)
            $url = str_replace(DS . 'shoptp' . DS . 'public', '.', session('goods_thumb'));
            if (file_exists($url)) {
                unlink($url);
            }
        }
        session('goods_thumb', $goods_find['goods_thumb']);//创建session,
        $cate_select = db('cate')->select();
        $cate_model = model('Cate');
        $cate_list1 = $cate_model->getChildren($cate_select, 0);
        $cate_in = $cate_model->getFatherId($cate_select, $goods_find['goods_pid']);
//        dump($cate_in);die;
        $cate_father = array("one" => $cate_in[2]['id_cate'], "two" => $cate_in[1]['id_cate'], "three" => $cate_in[0]['id_cate']);
//        dump($cate_father);die;
        $this->assign('cate_father', $cate_father);
        $this->assign('goods_find', $goods_find);
        $this->assign('cate_list1', $cate_list1);

        return view('goods/update');
    }

    /**
     * 用户修改商品信息提交后修改至数据库
     */
    public function updatehandle()
    {
        $post = request()->post();
//        dump($post);die;
        $post['goods_thumb'] = session('goods_thumb');
        $post['goods_status'] = isset($post['goods_status']) ? $post['goods_status'] : "0";
        $post['goods_pid'] = isset($post['goods_pid']) ? $post['goods_pid'] : null;
        //验证修改后的信息是否合法
        $validate = validate("Goods");
        if (!$validate->check($post)) {
            $this->error($validate->getError(), 'goods/goodslist');
        }
        $goods_update_result = db('goods')->update($post);
        if ($goods_update_result) {
            session('goods_thumb', null);
            $this->success("商品修改成功", url("admin/goods/goodslist", ["goods_pid"=>$post['goods_pid']]));
        } else {
            session('goods_thumb', null);
            $this->error("商品修改失败", "goods/goodslist");
        }

    }

}