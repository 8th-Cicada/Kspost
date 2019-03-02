<?php
namespace app\admin\validate;
use think\Validate;
class Datacollect extends Validate
{

    protected $rule=[
        'name'=>'unique:datacollect|require|max:25',
        // 'url'=>'url|unique:link|require|max:60',
        //'desc'=>'require',
    ];


    protected $message=[
        'name.require'=>'采集方式不得为空！',
        'name.unique'=>'采集方式不得重复！',
        // 'url.unique'=>'链接地址不得重复！',
        // 'url.require'=>'链接地址不得为空！',
        // 'url.url'=>'链接地址格式不正确！',
        // 'url.max'=>'链接地址不得大于60个字符！',
        'name.max'=>'采集方式长度大的大于25个字符！',
        //'desc.require'=>'描述不得为空！',
    ];

    protected $scene=[
        'add'=>['name','url','desc'],
        'edit'=>['name','url'],
    ];





    

    




   

	












}
