<?php
namespace app\index\controller;
use app\index\controller\Common;
class Postcode extends Common
{
    public function index()
    {




        $province1 = " ";
        $city1 = " ";
        $district1 = " ";
        // $area2 = " ";
        // $province = " ";
        // $city = " ";
        



        $appkey = "c9143f9a70178870a5969b43d6e7d2da";


    //************1.邮编查询地名************
        $url = "http://v.juhe.cn/postcode/query";

        if(request()->isPost()){
            // dump(input('post.')['action']);die;
            // dump(strcmp("pcodeid",input('post.')['action']));die;
            // dump(strcmp("pareaid",input('post.')['action']));die;
            if (strcmp("pcodeid",input('post.')['action']) == 0) {

             $data=input('post.');

             $params = array(
                "postcode" => $data['pcodeid'],//邮编，如：215001
                "key" => $appkey,//应用APPKEY(应用详细页查询)
                "page" => "",//页数，默认1
                "pagesize" => "",//每页返回，默认:20,最大不超过50
                "dtype" => "json",//返回数据的格式,xml或json，默认json
                );
             $paramstring = http_build_query($params);
             $content = $this->juhecurl($url,$paramstring);
             $result = json_decode($content,true);

             // dump($result);die();
             $province1 = $result['result']['list'][1]['Province'];
             $city1 = $result['result']['list'][1]['City'];
             $district1 = $result['result']['list'][1]['District'];
            // $xingbie = $result['result']['sex'];
            // $shengri = $result['result']['birthday'];
            // $diqu = $result['result']['area'];

         }


     }

//         //************2.省份城市区域列表************




// //**************************************************



//         //************3.地名查询邮编************
//      $url = "http://v.juhe.cn/postcode/search";
//      if(request()->isPost()){


//         if (strcmp("pareaid",input('post.')['action']) == 0) {

//            $data=input('post.');

//         // dump($data);die();

//            // $pid = $data['pid'];

//            $url2 = "http://v.juhe.cn/postcode/pcd";

//            $params = array(
//             "key" => $appkey,//应用APPKEY(应用详细页查询)
//             "dtype" => "json",//返回数据的格式,xml或json，默认json
//             );
//            $paramstring = http_build_query($params);
//            $content = $this->juhecurl2($url2,$paramstring);
//            $result2 = json_decode($content,true);

//            // dump($result2);die;

//            $province = $result2['result'];

//            // $city = $result2['result'][''];
//             // dump($result2['result']);die();
//             // dump($data);die;
//             $pid = $data['pid'];
//             $city = $result2['result'][$pid-1]['city'];
       

//            $params = array(
//             "pid" => "",//省份ID
//             "cid" => "",//城市ID
//             "did" => "",//区域ID
//             "q" => $data['pareaid'],//地名关键字，如:木渎
//             "key" => $appkey,//应用APPKEY(应用详细页查询)
//             "dtype" => "",//返回数据的格式,xml或json，默认json
//             );
//            $paramstring = http_build_query($params);
//            $content = $this->juhecurl2($url,$paramstring);
//            $result = json_decode($content,true);

//              // dump($result);
//        }




//    }
//**************************************************
   $this->assign(array(
    'province1' => $province1,
    'city1' => $city1,
    'district1' => $district1,
        // 'province' => $province,
        // 'city' => $city,
    ));






        // $this->assign(array(
        //     'xingbie' => $xingbie,
        //     'shengri' => $shengri,
        //     'diqu' => $diqu,
        //     ));



   return view();
}
}

