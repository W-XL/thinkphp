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

    public function indexV1(){
        return $this->fetch('/index_v1');
    }

    public function indexV2(){
        return $this->fetch('/index_v2');
    }

    public function indexV3(){
        return $this->fetch('/index_v3');
    }

    public function indexV4(){
        return $this->fetch('/index_v4');
    }

    public function indexV5(){
        return $this->fetch('/index_v5');
    }

    public function login(){
        return $this->fetch('/login');
    }

    public function register(){
        return $this->fetch("/register");
    }

    public function doLogin(){
        $params = $_POST;
        if(!$params['user_name'] || !$params['password']){
            $this->error("缺少必填项");
        }
        if($this->userPwdCheck($params)){
            header("location:index");
        }else{
            header("location:login");
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
        header("location:login");
    }

    public function main(){
        return $this->fetch('/main');
    }

    public function formAvatar(){
        return $this->fetch('/form_avatar');
    }

    public function profile(){
        return $this->fetch('/profile');
    }

    public function contacts(){
        return $this->fetch('/contacts');
    }

    public function mailbox(){
        return $this->fetch('/mailbox');
    }

    public function layouts(){
        return $this->fetch('/layouts');
    }

    public function graphECharts(){
        return $this->fetch('/graph_echarts');
    }

    public function formBuilder(){
        return $this->fetch('/form_builder');
    }

    public function cssAnimation(){
        return $this->fetch('/css_animation');
    }

    public function carousel(){
        return $this->fetch('/carousel');
    }

    public function blueImp(){
        return $this->fetch('/blueimp');
    }

    public function basicGallery(){
        return $this->fetch('/basic_gallery');
    }

    public function tableBootstrap(){
        return $this->fetch('/table_bootstrap');
    }

    public function tableFooTable(){
        return $this->fetch('/table_foo_table');
    }

    public function tableJqGrid(){
        return $this->fetch('/table_jqgrid');
    }

    public function tableDataTables(){
        return $this->fetch('/table_data_tables');
    }

    public function tableBasic(){
        return $this->fetch('/table_basic');
    }

    public function widgets(){
        return $this->fetch('/widgets');
    }

    public function spinners(){
        return $this->fetch('/spinners');
    }

    public function diff(){
        return $this->fetch('/diff');
    }

    public function toaStrNotifications(){
        return $this->fetch('/toastr_notifications');
    }

    public function nestableList(){
        return $this->fetch('/nestable_list');
    }

    public function treeView(){
        return $this->fetch('/tree_view');
    }

    public function jsTree(){
        return $this->fetch('/jstree');
    }

    public function sweetAlert(){
        return $this->fetch('/sweetalert');
    }

    public function modalWindow(){
        return $this->fetch('/modal_window');
    }

    public function layer(){
        return $this->fetch('/layer');
    }

    public function plYr(){
        return $this->fetch('/plyr');
    }

    public function gridOptions(){
        return $this->fetch('/grid_options');
    }

    public function badgesLabels(){
        return $this->fetch('/badges_labels');
    }

    public function notifications(){
        return $this->fetch('/notifications');
    }

    public function tabsPanels(){
        return $this->fetch('/tabs_panels');
    }

    public function buttons(){
        return $this->fetch('/buttons');
    }

    public function agileBoard(){
        return $this->fetch('/agile_board');
    }

    public function draggablePanels(){
        return $this->fetch('/draggable_panels');
    }

    public function icoFont(){
        return $this->fetch('/iconfont');
    }

    public function glyPhIcons(){
        return $this->fetch('/glyphicons');
    }

    public function fontAwesome(){
        return $this->fetch('/fontawesome');
    }

    public function typography(){
        return $this->fetch('/typography');
    }

    public function emptyPage(){
        return $this->fetch('/empty_page');
    }

    public function err500(){
        return $this->fetch('/500');
    }

    public function err404(){
        return $this->fetch('/404');
    }

    public function lockScreen(){
        return $this->fetch('/lockscreen');
    }

    public function loginV2(){
        return $this->fetch('/login_v2');
    }

    public function webIm(){
        return $this->fetch('/webim');
    }

    public function chatView(){
        return $this->fetch('/chat_view');
    }

    public function forumMain(){
        return $this->fetch('/forum_main');
    }

    public function searchResults(){
        return $this->fetch('/search_results');
    }

    public function invoicePrint(){
        return $this->fetch('/invoice_print');
    }

    public function invoice(){
        return $this->fetch('/invoice');
    }

    public function pinBoard(){
        return $this->fetch('/pin_board');
    }

    public function timeLineV2(){
        return $this->fetch('/timeline_v2');
    }

    public function timeLine(){
        return $this->fetch('/timeline');
    }

    public function faq(){
        return $this->fetch('/faq');
    }

    public function article(){
        return $this->fetch('/article');
    }

    public function blog(){
        return $this->fetch('/blog');
    }

    public function calendar(){
        return $this->fetch('/calendar');
    }

    public function fileManager(){
        return $this->fetch('/file_manager');
    }

    public function clients(){
        return $this->fetch('/clients');
    }

    public function socialFeed(){
        return $this->fetch('/social_feed');
    }

    public function teamsBoard(){
        return $this->fetch('/teams_board');
    }

    public function projectDetail(){
        return $this->fetch('/project_detail');
    }

    public function projects(){
        return $this->fetch('/projects');
    }

    public function layerDate(){
        return $this->fetch('/layerdate');
    }

    public function suggest(){
        return $this->fetch('/suggest');
    }

    public function codeEditor(){
        return $this->fetch('/code_editor');
    }

    public function formMarkdown(){
        return $this->fetch('/form_markdown');
    }

    public function formSimditor(){
        return $this->fetch('/form_simditor');
    }

    public function formEditors(){
        return $this->fetch('/form_editors');
    }

    public function formFileUpload(){
        return $this->fetch('/form_file_upload');
    }

    public function formWebUploader(){
        return $this->fetch('/form_webuploader');
    }

    public function formWizard(){
        return $this->fetch('/form_wizard');
    }

    public function formAdvanced(){
        return $this->fetch('/form_advanced');
    }

    public function formValidate(){
        return $this->fetch('/form_validate');
    }

    public function formBasic(){
        return $this->fetch('/form_basic');
    }

    public function mailCompose(){
        return $this->fetch('/mail_compose');
    }

    public function mailDetail(){
        return $this->fetch('/mail_detail');
    }

    public function graphMetrics(){
        return $this->fetch('/graph_metrics');
    }

    public function graphSparkLine(){
        return $this->fetch('/graph_sparkline');
    }

    public function graphPeIty(){
        return $this->fetch('/graph_peity');
    }

    public function graphRickshaw(){
        return $this->fetch('/graph_rickshaw');
    }

    public function graphMorris(){
        return $this->fetch('/graph_morris');
    }

    public function graphFLot(){
        return $this->fetch('/graph_flot');
    }

}
