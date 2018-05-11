<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Loader;

class Index extends Controller{
    public function __construct(Request $request = null){
        parent::__construct($request);
    }

    public function index(){
        if(Session::get('usr_id')){
            $indexDao = Loader::model('IndexDao');
            $info = $indexDao->GetInfo(Session::get('usr_id'));
            $this->assign('info',$info);
            return $this->fetch('/index');
        }else{
            header("location:login");
        }
    }


    public function login(){
        return $this->fetch('/login');
    }

    public function doLogin(){
        $params = $_POST;
        if(!$params['user_name'] || !$params['password']){
            $this->error("缺少必填项");
        }
        if($this->userPwdCheck($params)){
            $this->redirect('Index/index');
        }else{
            $this->redirect('Index/login');
        }
    }

    //用户帐号密码验证
    public function userPwdCheck($params){
        $account = $params['user_name'];
        $password = $params['password'];
        $md5_pwd = md5($password);
        $index = Loader::model('IndexDao');
        $user_info = $index->GetAdmins($account);
        if(strtolower($md5_pwd) != strtolower($user_info['usr_pwd'])){
            if($user_info){
                Session::set('login_error_msg','密码错误，请重新输入');
                $index->do_login_log($account, $password, '密码错误', $this->request->ip(), $user_info['id']);
                return false;
            }else{
                Session::set('login_error_msg','用户名不存在，请重新输入');
                $index->do_login_log($account, $password, '用户名错误', $this->request->ip());
                return false;
            }
        }else{
            $index->do_login_log($account, $password, '登录成功', $this->request->ip(),$user_info['id']);
            Session::set('usr_id',$user_info['id']);
            Session::set('group_id',$user_info['group_id']);
            Session::delete('login_error_msg');
            return true;
        }

    }

    public function doLogout(){
        Session::delete('usr_id');
        Session::delete('group_id');
        $this->redirect('Index/login');
    }

}
