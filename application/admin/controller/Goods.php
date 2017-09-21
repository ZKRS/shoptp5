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
        $post['goods_after_price'] = empty($post['goods_after_price'])?'0':$post['goods_after_price'];
        $result = [];
        $validate = validate('Goods');
        if (!$validate->batch()->check($post) || ($post['goods_after_price']>=$post['goods_price'])) {
            $errors = $validate->getError();
            $errors['goods_after_price'] = "促销价格不能大于等于原价格";
            $this->assign("goods", $post);
            $result = [
                'status' => 2,
                'message' => "发生错误",
                'errors' => $errors
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


//        foreach ($goods_keywords as $key => $value) {
//            dump($value->keywords_name);
//        }

        $goods_model = model('Goods');
        $cate_model = model('Cate');
        $cate_select = db('cate')->select();
        $cate_list1 = $cate_model->getChildren($cate_select, 0);
        $this->assign('cate_list1', $cate_list1);
        $cate_find = db("cate")->find($goods_pid);
//        $goods_get = $goods_model->get(10);
//        $goods_keywords = $goods_get->keywords;
//        $goods_keywords_toArray = $goods_keywords->toArray();
//        $goods_all = $goods_model->all();
//        dump($goods_all);die;
//        $goods_all_toArray = $goods_all->toArray();
//        dump($goods_all_toArray);die;
//        $goods_info = array();
//        foreach ($goods_all_toArray as $key => $value) {
//            $goods_get = $goods_model->get($value['goods_id']);
//            $goods_keywords = $goods_get->keywords;
//            $goods_keywords_toArray = $goods_keywords->toArray();
//            $value['keywords'] = $goods_keywords_toArray;
//            $goods_cate = $goods_get->cate;
//            $goods_cate_toArray = $goods_cate->toArray();
//            $value['cate_name'] = $goods_cate_toArray["cate_name"];
//            $goods_info[] = $value;
//        }
//        $this->assign('goods_info', $goods_info);
//        dump($goods_info);die;

//        $cate_model = model('Cate');
//        $cate_all = $cate_model->all();
//        $cate_all_toArray = collection($cate_all) ->toArray();
//        dump($cate_all_toArray);
////        foreach ($cate_all as $key => $value) {
////            dump($value -> cate_name);
////        }
//        die;


        if ($cate_find) {
//            $goods_select = db('goods')->where('goods_pid', 'eq', $goods_pid)->join('shop_cate', 'shop_cate.id_cate = shop_goods.goods_pid')->select();
//            dump($goods_select);die;
//            $this->assign('goods_select', $goods_select);
            $goods_all = $goods_model->all(function ($query) use ($goods_pid) {
                $query->where('goods_pid', 'eq', $goods_pid);
            });
            $this->assign('cate_find', $cate_find);
        } else {
//            $this->assign('goods_select', "");
            $goods_all = $goods_model->all();
            $this->assign('cate_find', '');
        }
//        dump($goods_all);die;
        $goods_all_toArray = $goods_all;
        $goods_info = array();
        foreach ($goods_all_toArray as $key => $value) {
            $goods_get = $goods_model->get($value['goods_id']);
            $goods_keywords = $goods_get->keywords;
            $goods_keywords_toArray = $goods_keywords->toArray();
            $value['keywords'] = $goods_keywords_toArray;
            $goods_cate = $goods_get->cate;
            $goods_cate_toArray = $goods_cate->toArray();
            $value['cate_name'] = $goods_cate_toArray['cate_name'];
            $goods_info[] = $value;
        }
        $this->assign('goods_info', $goods_info);
        $goods_total = count($goods_info);
        $page_class = new \app\admin\controller\Page($goods_total, 4);
        $show = $page_class->fpage();
        $limit = $page_class->setlimit();
        $limit = explode(',',$limit);
        $list = array_slice($goods_info,$limit[0],$limit[1]);
        $this->assign('show',$show);
        $this->assign('goods_info',$list);
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
                $goods_keywords_del_result = db("goods_keywords")->where("goods_id","eq",$goods_id)->delete();//删除商品与关键字对应关系
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
            $this->success("商品修改成功", url("admin/goods/goodslist", ["goods_pid" => $post['goods_pid']]));
        } else {
            session('goods_thumb', null);
            $this->error("商品修改失败", "goods/goodslist");
        }

    }

    /**
     * 商品关键字添加,如果关键字已经存在就添加到shop_goods_keywords表中,商品id 对应 关键字id
     */
    public function keywordsAddHanddle(){
        $post = request()->post();
        $goods_id = array_keys($post)[0];
        $keywords_name = array_values($post)[0];
//        dump($goods_keywords);die;

        if(empty($keywords_name)){//用户没有输入关键字
            $this->error('关键字不能为空','goods/goodslist','',1);
        }
        $keywords_find = db('keywords')->where('keywords_name','eq',$keywords_name)->find();
        if(empty($keywords_find)){//用户输入关键字不存在数据库中
            $this->error('请先添加关键字','keywords/add',"",1);
        }
        $keywords_id  = $keywords_find["keywords_id"];
        $goods_keywords_find = db("goods_keywords")->where("goods_id=$goods_id")->where("keywords_id=$keywords_id")->find();
        if(!empty($goods_keywords_find)){//用户添加的关键字,商品已经添加过了
            $this->redirect("goods/goodslist");
        }
        $goods_model = model("goods");
        $goods = $goods_model->get($goods_id);//得到要添加关键字的商品
        /**
         * 增加关联的中间表数据
         *      attach方法参数
         *          1. data :可以是数组 / 关联模型对象 / 关联对象的主键
         * */
        $goods->keywords()->attach($keywords_id);
        $this->redirect("goods/goodslist");
    }

    /**
     * @param string $goods_id
     * @param string $keywords_name
     * 删除商品的某个关键字
     * 通过get方式把商品id和关键字名传过来,不安全
     *                                  可以更改url中的数据就能删除关联
     *
     */
    public function keywordsDelHanddle($goods_id="",$keywords_name=""){
        if(empty($goods_id)||empty($keywords_name)){
            $this->redirect("goods/goodslilst");
        }
        $goods_find = db("goods")->find($goods_id);
//        dump($goods_find);die;
        if(empty($goods_id)){
            $this->redirect("goods/goodslist");
        }
        $keywords_find = db("keywords")->where("keywords_name","eq",$keywords_name)->find();
        if(empty($keywords_find)){
            $this->redirect("goods/goodslist");
        }
        $keywords_id = $keywords_find["keywords_id"];
        $goods_model = model("goods");
        $goods = $goods_model->get($goods_id);
        $goods->keywords()->detach($keywords_id);
        $this->redirect("goods/goodslist");
    }
    public function keywordsAjax(){
        if(request()->isAjax()){
            $post=request()->post();
            $post_val = $post['val'];
            $keywords_like = db('keywords')->where('keywords_name','like','%'.$post_val.'%')->limit(4)->select();
            return $keywords_like;
        }
    }

}