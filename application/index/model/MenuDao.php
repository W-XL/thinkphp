<?php
namespace app\index\model;

use think\Model;
use think\Db;

class MenuDao extends Model{

    public function GetAdminMenus(){
      return   Db::table('admin_menus')->select();
    }

    public function get_cate_menu($pid){
        return Db::table('admin_menus')->where('pid='.$pid)->order('id','desc')->select();
    }

    public function get_menu($pid){
        return Db::table('admin_menus')
            ->alias('a')
            ->join(['admin_menus'=>'b'],'a.pid=b.id','left')
            ->where('a.id="'.$pid.'"')
            ->field('a.*,b.pid as pp_id')
            ->find();
    }

    public function insert_menu($params){
        $data = ['pid'=>$params['pid'],'name'=>$params['name'],'url'=>$params['url'],'status'=>$params['status']];
        Db::name('admin_menus')
            ->insert($data);
    }


}