<?php


namespace app\admin\validate;


use think\Validate;

class Home extends Validate
{
    protected $rule=[
        'sid'=>'require|number',
        'sname'=>'require|chsAlphaNum',
        'sdesc'=>'require|chsAlphaNum',
        'sprice'=>'require|number',

    ];
    protected $message=[
        'sid.require'=>'cid必传',
        'sid.number'=>'cid只能是数字',
        'sname.require'=>'民宿名称必填',
        'sname.chsAlphaNum'=>'民宿名称只能包含汉字字母下划线',
        'sdesc.require'=>'民宿描述必填',
        'sdesc.chsAlphaNum'=>'民宿描述只能包含汉字字母下划线',
        'sprice.require'=>'民宿描述必填',
        'sprice.chsAlphaNum'=>'民宿描述只能包含汉字字母下划线'
    ];

}