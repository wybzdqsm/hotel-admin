<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;
//1.验证权限
//2.验证请求方式
//3.接受前台发送数据
//4.前台数据验证
//5.业务逻辑
//username->find
class Login extends Controller
{

public function check(){
    $method=$this->request->method();
//    echo $method;
    if($method !='POST'){
        return json([
           'code'=>404,
            'msg'=>'请求方式不正确'
        ]);
    }
   $data=$this->request->post();
    $validate=validate('Login');
    $flag=$validate->scene('check')->check($data);
   if($flag){
       $arr=['username'=>$data["username"]];
       $user=Db::table('admin')->where($arr)->find();
       $password=md5(crypt($data["password"],config('salt')));
       if($user){
       if($password===$user["password"]){
           $payload=[
               'id'=>$user['id'],
               'username'=>$user['username'],
               'avatar'=>$user['avatar']
           ];
           $token=JWT::getToken($payload,config('jwtkey'));
           return json([
               'code'=>200,
               'msg'=>'success',
               'token'=>$token,
               'user'=>$payload
           ]);
       }else{
           return json([
               'code'=>404,
               'msg'=>'密码错误'
           ]);
       }
       }else{
           return json([
               'code'=>404,
               'msg'=>'用户名不存在'
           ]);
       }
   }else{
       return json([
           'code'=>404,
           'msg'=>$validate->getError()
       ]);
   }
}


public function  changepass(){
checkToken();
$id=$this->request->id;
if(!$this->request->isPost()){
    return json([
        'code'=>404,
        'msg'=>'请求方式错误'
    ]);
}
$data=$this->request->post();
    $validate=validate('login');
    if(!$validate->scene('changepass')->check($data)){
        return json([
            'code'=>404,
            'msg'=>$validate->getError()
        ]);
    }
    $oldpass=secretpass($data["oldpass"]);
    $newpass=secretpass($data["newpass"]);
    if($oldpass===$newpass){
        return json([
            'code'=>404,
            'msg'=>'新密码与原密码不能相同',
        ]);
    }
  $result=Db::table('admin')->field('password')->where('id',$id)->find();

    $pass=$result["password"];

    if(!$pass === $oldpass){
        return json([
            'code'=>404,
            'msg'=>'原密码输入错误',
        ]);
    }
        $result=Db::table('admin')->where('id',$id)->update(['password'=>$newpass]);
    if($result){
        return json([
            'code'=>200,
            'msg'=>'数据更新成功',

        ]);
    }else{
        return json([
            'code'=>404,
            'msg'=>'数据更新失败'
        ]);
    }

}



}