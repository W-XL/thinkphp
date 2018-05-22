<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Loader;

class Account extends Controller{
    public function __construct(Request $request = null){
        parent::__construct($request);
    }

    public function listView(){
        $params = Request::instance()->param();
        $group_id = Session::get('group_id');
        $user_id = Session::get('usr_id');
        $accountDao = Loader::model('AccountDao');
        $account_list = $accountDao->get_account_list($params);
        //将分页返回的数据集对象转换成数组
        $account = $account_list->all();
        foreach($account as $key=>$data){
            if(!empty($data['p1'])){
                $p1_info = $accountDao->get_user_info($data['p1']);
                if ($p1_info) {
                    $account[$key]['p1_name'] = $p1_info['account'];
                }
            }
            if(!empty($data['p2'])){
                $p2_info = $accountDao->get_user_info($data['p2']);
                if($p2_info){
                    $account[$key]['p2_name'] = $p2_info['account'];
                }
            }
        }
        $this->assign('params',$params);
        $this->assign('list', $account);
        $this->assign("pages",$account_list->render());
        return view('account_list');
    }

    public function add_view(){
        $account_dao = Loader::model('AccountDao');
        $groups = $account_dao->get_groups();
        $this->assign('groups',$groups);
        return view('account_add');
    }

    public function do_add(){
        $params = Request::instance()->param();
        if(!$params['account'] || !$params['real_name'] || !$params['user_code'] || !$params['usr_pwd']){
            return error_msg("缺少必填参数");
        }
        if(preg_match("/[\x7f-\xff]/", $params['user_code'])){
            return error_msg("代码不能含中文.");
        }
        $account_dao = Loader::model('AccountDao');
        $user_code = $account_dao->check_account($params);
        if($user_code){
            return error_msg("账号或代码已被使用");
        }
        $params['usr_pwd'] = md5($params['usr_pwd']);
        $account_dao->insert_account($params);
        return succeed_msg();
    }

    public function edit_view(){
        $id = Request::instance()->param('id');
        $account_dao = Loader::model('AccountDao');
        $groups = $account_dao->get_groups();
        $info = $account_dao->get_account($id);
        $this->assign('info',$info);
        $this->assign('groups',$groups);
        return view('account_edit');
    }

    public function do_edit(){
        $params = Request::instance()->param();
        if(!$params['account'] || !$params['real_name'] || !$params['id']){
            return error_msg("缺少必填参数");
        }
        $account_dao = Loader::model('AccountDao');
        $account_info = $account_dao->check_account_info($params);
        if($account_info){
            return error_msg("账号已被使用,请换一个账号名称");
        }
        $account_dao->update_account($params);
        return succeed_msg();
    }

    public function password(){
        $id = Request::instance()->param('id');
        $account_dao = Loader::model('AccountDao');
        $info = $account_dao->get_account($id);
        $this->assign('info',$info);
        return view('account_pwd_edit');
    }

    public function do_pwd(){
        $params = Request::instance()->param();
        if(!$params['password'] || !$params['re_pwd']){
            return error_msg('缺少必填项');
        }
        if($params['password'] != $params['re_pwd']){
            return error_msg('两次输入的密码不一致，请重新输入');
        }
        $account_dao = Loader::model('AccountDao');
        $account_dao->update_pwd($params);
        return succeed_msg();
    }
}
