<?php
namespace app\index\model;

use think\Model;

class index_dao extends Model{

    public function get_admins($account){
        return db('admins')->where('account',$account)->find();
    }

}