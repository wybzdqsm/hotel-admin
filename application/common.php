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
//获取token
// get token
//post token
//header token
//JWT ::verify

use think\JWT;
// 应用公共文件
function checkToken(){
//JWT::verify('','');
    $get_token=request()->get('token');
    $post_token=request()->post('token');
    $header_token=request()->header('token');
    if($get_token){
        $token=$get_token;
    }else if ($post_token){
        $token=$post_token;
    }else if($header_token){
        $token=$header_token;
    }else{
        json([
            'code'=>404,
            'msg'=>'token不能为空'
        ],401)->send();
        exit();
    }
    $tokenresult=JWT::verify($token,config('jwtkey'));
    if(!$tokenresult){
        json([
            'code'=>'404',
            'msg'=>'token验证失败'
        ],401)->send();
        exit();
    }
    request()->id=$tokenresult['id'];
    request()->username=$tokenresult['username'];

}

 function secretpass($password){
    return  md5(crypt($password,config('salt')));
}
 function  resetpassword(){
    return md5(crypt(config('defaultpassworld'),config('salt')));
}