<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Loader;

class Menu extends Controller{
    public function __construct(Request $request = null){
        parent::__construct($request);
    }

    public function listView(){
        $menu_dao = Loader::model('MenuDao');
        $top_list = $menu_dao->get_cate_menu(0);
        foreach ($top_list as $k=>$v){
            $sub_list = $menu_dao->get_cate_menu($v['id']);
            $top_list[$k]['sub_list'] = $sub_list;
            foreach ($sub_list as $kk=>$vv){
                $child_list = $menu_dao->get_cate_menu($vv['id']);
                $top_list[$k]['sub_list'][$kk]['child_list'] = $child_list;
            }
        }

        $this->assign("dataList", $top_list);
        return view('menu_list');
    }

    public function add_view(){
        $pid = Request::instance()->param('id');
        if(!$pid){
            $pmenu = array("id"=>0,"name"=>"顶级菜单");
        }else{
            $menu_dao = Loader::model('MenuDao');
            $pmenu = $menu_dao->get_menu($pid);
        }
        $this->assign("pmenu", $pmenu);
        return view('menu_add');
    }

    public function do_add(){
        $params = Request::instance()->param();
        if(!isset($params['pid']) || !$params['name'] || !isset($params['status'])){
            return error_msg('缺少必填项');
        }
        $menu_dao = Loader::model('MenuDao');
        $menu_dao->insert_menu($params);
        return succeed_msg();
    }



}
