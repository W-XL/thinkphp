<?php
namespace app\index\controller;

use app\index\model\index_dao;
use think\Controller;
use think\Request;
use think\Session;
use think\Cache;

class Index extends Controller{
    public $DAO;
    public function __construct(Request $request = null){
        parent::__construct($request);
        $this->DAO = new index_dao();
    }

    public function index(){
        if(Session::get('usr_id')){
            return $this->fetch('/index');
        }else{
            header("location:login");
        }
    }

    public function login(){
        return $this->fetch('/login');
    }

    public function do_login(){
        $params = $_POST;
        if(!$params['user_name'] || !$params['password']){
            $this->error("缺少必填项");
        }
        if($this->user_pwd_check($params)){
            header("location:index");
        }else{
            header("location:login");
        }
    }

    //用户帐号密码验证
    public function user_pwd_check($params){
        $account = $params['user_name'];
        $password = $params['password'];
        $md5_pwd = md5($password);
        $user_info = $this->DAO->get_admins($account);
        if(strtolower($md5_pwd) != strtolower($user_info['usr_pwd'])){
            if($user_info){
                Session::set('login_error_msg','密码错误，请重新输入');
                $this->DAO->do_login_log($account, $password, '密码错误', $this->request->ip(), $user_info['id']);
                return false;
            }else{
                Session::set('login_error_msg','用户名不存在，请重新输入');
                $this->DAO->do_login_log($account, $password, '用户名错误', $this->request->ip());
                return false;
            }
        }else{
            $this->DAO->do_login_log($account, $password, '登录成功', $this->request->ip(),$user_info['id']);
            Session::set('usr_id',$user_info['id']);
            Session::set('group_id',$user_info['group_id']);
            Session::delete('login_error_msg');
            return true;
        }

    }

    public function do_logout(){
        Session::delete('usr_id');
        Session::delete('group_id');
        header("location:login");
    }

    public function main(){
        return $this->fetch('/main');
    }

}
