<?php
namespace app\index\controller;

use weather;
use app\index\controller\Common;
class Weatherr extends Common
{  
    public function weatherr()
    {
    	require(ROOT_PATH . 'vendor/weather.php');//引入PHP EXCEL类
        $appkey = '0308ec65c3b7a90d341079f7ee3fc754';
        $weather = new weather($appkey);


        $cityWeatherResult = $weather->getWeather('昆山');
        if($cityWeatherResult['error_code'] == 0){ 
            $weather1 = $cityWeatherResult['result'];
            // foreach ($data as $k => $v) {
            //     if ($k == 'sk') {
            //         $temp = $v;
            //     }
            //     if ($k == 'today') {
            //         $today = $v;
            //     }
            //     if ($k == 'future') {
            //         $future = $v;
            //     }
            // }
            $this->assign('weather1', $weather1);
            // dump($temp);die;
        }else{
            echo $cityWeatherResult['error_code'].":".$cityWeatherResult['reason'];
        }
        return view();
    }
}
