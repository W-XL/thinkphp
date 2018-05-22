<?php
namespace app\index\model;

use think\Model;
use think\Db;

class AccountDao extends Model{

    public function get_account_list($params){
        $map['a.is_del'] = 0;
        if($params['user_account']){
            $map['a.account'] = $params['user_account'];
        }
         return Db::table('admins')
                ->field('a.*,b.ch_name')
                ->alias('a')
                ->join('admin_groups b','a.group_id = b.id','left')
                ->where($map)
                ->order(['a.last_login'=>'desc'])
                ->paginate();
    }

    public function get_user_info($user_id){
        return Db::table('admins')
                ->where('id',$user_id)
                ->find();
    }

    public function get_groups(){
        return Db::table('admin_groups')->order(['id'=>'desc'])->select();
    }

    public function check_account($params){
        return Db::table('admins')
                 ->where('account',$params['account'])
                 ->where('user_code',$params['user_code'])
                 ->find();
    }

    public function insert_account($params){
        $data = ['account'=>$params['account'],'usr_pwd'=>$params['usr_pwd'],'real_name'=>$params['real_name'], 'qq'=>$params['qq'],
            'user_code'=>$params['user_code'],'group_id'=>$params['group_id'],'last_login'=>time()];
        $userId = Db::name('admins')->insertGetId($data);

        $group = $this->get_group($params['group_id']);
        $datalist = ['usr_id'=>$userId,'module'=>$group['module'],'permissions'=>$group['module']];
        Db::table('admin_permissions')->insert($datalist);
    }

    public function get_group($group_id){
        return Db::table('admin_groups')
                ->where('id',$group_id)
                ->find();
    }

    public function get_account($id){
        return Db::table('admins')
                ->where('id',$id)
                ->find();
    }

    public function check_account_info($params){
        return Db::table('admins')
                ->where('account',$params['account'])
                ->where('id != '.$params['id'])
                ->find();
    }

    public function update_account($params){
        $data = ['account'=>$params['account'],'qq'=>$params['qq'],'group_id'=>$params['group_id'],'real_name'=>$params['real_name']];
        Db::table('admins')
            ->where('id',$params['id'])
            ->update($data);
    }

    public function update_pwd($params){
        $data = ['usr_pwd'=>md5($params['re_pwd'])];
        Db::table('admins')
            ->where('id',$params['id'])
            ->update($data);
    }
}