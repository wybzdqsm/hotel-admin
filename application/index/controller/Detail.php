<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Detail extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        $homewhere=['sid'=>$id];
        $home=Db::table('home')->where($homewhere)->find();
        $recommendswhere=['sid'=>['<>',$id]];
        $recommends=Db::table('home')->where($recommendswhere)->field('sid,sthumb,sname,sdesc,sprice,scity,sarea,sthumb,score')->order('sid','desc')->limit(0,4)->select();
            if($home&&$recommends) {
                return json([
                    'code' => 200,
                    'msg' => '数据获取成功',
                     'data'=>$home,
                    'recommends'=>$recommends
                ]);
            }else{
                return json([
                    'code' => 404,
                    'msg' => '数据获取失败',

                ]);

    }

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
