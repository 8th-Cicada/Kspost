<?php
namespace app\index\controller;
use app\index\controller\Common;
class Idcards extends Common
{
    public function index()
    {

        $xingbie=" ";//性别
        $shengri=" ";//生日
        $diqu=" ";//地区


        $appkey = "7c9b0bdd7581ef1c9eefd4fca69b71e3";


    //************1.身份证信息查询************
        $url = "http://apis.juhe.cn/idcard/index";

        if(request()->isPost()){
            $data=input('post.');
            $params = array(
                "cardno" => $data['userid'],//身份证号码
                "dtype" => "json",//返回数据格式：json或xml,默认json
                "key" => $appkey,//你申请的key
            );


            $paramstring = http_build_query($params);
            $content = $this->juhecurl($url,$paramstring);
            $result = json_decode($content,true);

           // dump($result);
           $xingbie = $result['result']['sex'];
           $shengri = $result['result']['birthday'];
           $diqu = $result['result']['area'];

           
        }

         $this->assign(array(
                'xingbie' => $xingbie,
                'shengri' => $shengri,
                'diqu' => $diqu,
                ));



        return view();
    }
}

