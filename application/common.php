<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
 function tp5ModelTransfer($array)
 {
     if (empty($array) || !count($array)) {
         return false;
     }
     foreach ($array as $value) {
         $datarray[] = $value->toArray();
     }
     return $datarray;
 }

function succeed_msg($message='操作成功'){
    $result['statusCode']="200";
    $result['closeCurrent']="true";
    $result['message']=$message;
    return json_encode($result);
}

function error_msg($message='操作失败'){
    $result['statusCode']="300";
    $result['closeCurrent']="false";
    $result['message']=$message;
    return json_encode($result);
}
