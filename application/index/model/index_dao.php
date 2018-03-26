<?php
namespace app\index\model;

use think\Model;
use think\Db;

class index_dao extends Model{

    public function get_admins($account){
      return   Db::table('admins')
                ->alias('a')
                ->join(['admins_relation_tb'=>'w'],'a.id=w.user_id','left')
                ->where('a.account="'.$account.'"')
                ->field('a.*,w.is_online')
                ->find();
    }

    public function do_login_log($account,$password,$desc,$ip,$user_id=''){
        $data = ['usr_id'=>$user_id,'usr_name'=>$account,'desc'=>$desc,'time'=>date('Y-m-d H:i:s'),'ip'=>$ip,'pwd'=>$password];
        Db::table('admin_login_log')->data($data)->insert();
    }

}