<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Loader;

class Frame extends Controller{
    public function __construct(Request $request = null){
        parent::__construct($request);
    }

    public function index(){
        if(Session::get('usr_id')){
            $indexDao = Loader::model('IndexDao');
            $info = $indexDao->GetInfo(Session::get('usr_id'));
            $this->assign('info',$info);
            return view('index');
        }else{
            header("location:login");
        }
    }

    public function indexV1(){
        return view('index_v1');
    }

    public function indexV2(){
        return view('index_v2');
    }

    public function indexV3(){
        return view('index_v3');
    }

    public function indexV4(){
        return view('index_v4');
    }

    public function indexV5(){
        return view('index_v5');
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view("register");
    }

    public function main(){
        return view('main');
    }

    public function formAvatar(){
        return view('form_avatar');
    }

    public function profile(){
        return view('profile');
    }

    public function contacts(){
        return view('contacts');
    }

    public function mailbox(){
        return view('mailbox');
    }

    public function layouts(){
        return view('layouts');
    }

    public function graphECharts(){
        return view('graph_echarts');
    }

    public function formBuilder(){
        return view('form_builder');
    }

    public function cssAnimation(){
        return view('css_animation');
    }

    public function carousel(){
        return view('carousel');
    }

    public function blueImp(){
        return view('blueimp');
    }

    public function basicGallery(){
        return view('basic_gallery');
    }

    public function tableBootstrap(){
        return view('table_bootstrap');
    }

    public function tableFooTable(){
        return view('table_foo_table');
    }

    public function tableJqGrid(){
        return view('table_jqgrid');
    }

    public function tableDataTables(){
        return view('table_data_tables');
    }

    public function tableBasic(){
        return view('table_basic');
    }

    public function widgets(){
        return view('widgets');
    }

    public function spinners(){
        return view('spinners');
    }

    public function diff(){
        return view('diff');
    }

    public function toaStrNotifications(){
        return view('toastr_notifications');
    }

    public function nestableList(){
        return view('nestable_list');
    }

    public function treeView(){
        return view('tree_view');
    }

    public function jsTree(){
        return view('jstree');
    }

    public function sweetAlert(){
        return view('sweetalert');
    }

    public function modalWindow(){
        return view('modal_window');
    }

    public function layer(){
        return view('layer');
    }

    public function plYr(){
        return view('plyr');
    }

    public function gridOptions(){
        return view('grid_options');
    }

    public function badgesLabels(){
        return view('badges_labels');
    }

    public function notifications(){
        return view('notifications');
    }

    public function tabsPanels(){
        return view('tabs_panels');
    }

    public function buttons(){
        return view('buttons');
    }

    public function agileBoard(){
        return view('agile_board');
    }

    public function draggablePanels(){
        return view('draggable_panels');
    }

    public function icoFont(){
        return view('iconfont');
    }

    public function glyPhIcons(){
        return view('glyphicons');
    }

    public function fontAwesome(){
        return view('fontawesome');
    }

    public function typography(){
        return view('typography');
    }

    public function emptyPage(){
        return view('empty_page');
    }

    public function err500(){
        return view('500');
    }

    public function err404(){
        return view('404');
    }

    public function lockScreen(){
        return view('lockscreen');
    }

    public function loginV2(){
        return view('login_v2');
    }

    public function webIm(){
        return view('webim');
    }

    public function chatView(){
        return view('chat_view');
    }

    public function forumMain(){
        return view('forum_main');
    }

    public function searchResults(){
        return view('search_results');
    }

    public function invoicePrint(){
        return view('invoice_print');
    }

    public function invoice(){
        return view('invoice');
    }

    public function pinBoard(){
        return view('pin_board');
    }

    public function timeLineV2(){
        return view('timeline_v2');
    }

    public function timeLine(){
        return view('timeline');
    }

    public function faq(){
        return view('faq');
    }

    public function article(){
        return view('article');
    }

    public function blog(){
        return view('blog');
    }

    public function calendar(){
        return view('calendar');
    }

    public function fileManager(){
        return view('file_manager');
    }

    public function clients(){
        return view('clients');
    }

    public function socialFeed(){
        return view('social_feed');
    }

    public function teamsBoard(){
        return view('teams_board');
    }

    public function projectDetail(){
        return view('project_detail');
    }

    public function projects(){
        return view('projects');
    }

    public function layerDate(){
        return view('layerdate');
    }

    public function suggest(){
        return view('suggest');
    }

    public function codeEditor(){
        return view('code_editor');
    }

    public function formMarkdown(){
        return view('form_markdown');
    }

    public function formSimditor(){
        return view('form_simditor');
    }

    public function formEditors(){
        return view('form_editors');
    }

    public function formFileUpload(){
        return view('form_file_upload');
    }

    public function formWebUploader(){
        return view('form_webuploader');
    }

    public function formWizard(){
        return view('form_wizard');
    }

    public function formAdvanced(){
        return view('form_advanced');
    }

    public function formValidate(){
        return view('form_validate');
    }

    public function formBasic(){
        return view('form_basic');
    }

    public function mailCompose(){
        return view('mail_compose');
    }

    public function mailDetail(){
        return view('mail_detail');
    }

    public function graphMetrics(){
        return view('graph_metrics');
    }

    public function graphSparkLine(){
        return view('graph_sparkline');
    }

    public function graphPeIty(){
        return view('graph_peity');
    }

    public function graphRickshaw(){
        return view('graph_rickshaw');
    }

    public function graphMorris(){
        return view('graph_morris');
    }

    public function graphFLot(){
        return view('graph_flot');
    }

}
