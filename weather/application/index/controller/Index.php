<?php
namespace app\index\controller;
use weather;
class Index extends Common
{
    public function index()
    {
    	require(ROOT_PATH . 'vendor/weather.php');//引入PHP EXCEL类
        $appkey = 'ce863d0fcc3ff9e405c251b8239de8a3';
        $weather = new weather($appkey);


        $cityWeatherResult = $weather->getWeather('昆山');
        if($cityWeatherResult['error_code'] == 0){ 
            $weather1 = $cityWeatherResult['result'];
            foreach ($weather1['future'] as $k => $v) {
                if ($k == 'weather_id') {
                    $weather_id = $v;
                }
            }
            // dump($weather_id);die;
            $this->assign('weather_id', $weather_id);
             
        }else{
            echo $cityWeatherResult['error_code'].":".$cityWeatherResult['reason'];
        }
        
        return view();
    }
}
