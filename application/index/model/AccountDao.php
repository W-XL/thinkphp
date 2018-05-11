<?php
namespace app\index\model;

use think\Model;
use think\Db;

class AccountDao extends Model{

    public function get_account_list(){
      return   Db::table('admins')
                ->field('a.*,b.ch_name')
                ->alias('a')
                ->join('admin_groups b','a.group_id = b.id','left')
                ->where('a.is_del',0)
                ->order(['a.last_login'=>'desc'])
                ->paginate();
    }

    public function get_user_info($user_id){
        return Db::table('admins')
                ->where('id',$user_id)
                ->find();
    }


}