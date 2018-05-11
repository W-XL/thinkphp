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
        $group_id = Session::get('group_id');
        $accountDao = Loader::model('AccountDao');
//        if($group_id == 10){
//        }

        $account_list = $accountDao->get_account_list();
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
        $this->assign('list', $account);
        $this->assign("pages",$account_list->render());
        return view('account_list');
    }

    public function add_view(){
        return view('account_add');
    }

}
