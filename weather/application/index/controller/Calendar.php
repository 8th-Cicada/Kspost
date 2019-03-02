<?php
namespace app\index\controller;
use app\index\controller\Common;
class Calendar extends Common
{   
    
    public function calendar()
    {
        $nowday=date('Y-n-j');
        $nowdays=date('j');
        //获取当天的详细信息
        $dayUrl = "http://v.juhe.cn/calendar/day";
        $appkey = "38c356dfc4b91785767584b64ec933ec";
        $params = 'date='.$nowday."&key=".$appkey;
        $content = $this->juhecurl($dayUrl,$params);
        $dataresult=json_decode($content,true);

        $date='';
        $weekday='';
        $lunarYear='';
        $lunar='';
        $animalsYear='';
        $avoid='';
        $suit='';

        if ($dataresult) {
            # code...
            if($dataresult['error_code']=='0'){
                $result=array();
                $result=$dataresult['result'];
                foreach ($result as $k => $v) {
                    # code...
                    if ($k == 'data') {
                        # code...
                        $date=$v['date'];
                        $weekday=$v['weekday'];
                        $lunarYear=$v['lunarYear'];
                        $lunar=$v['lunar'];
                        $animalsYear=$v['animalsYear'];
                        $avoid=$v['avoid'];
                        $suit=$v['suit'];
                    }
                }

                // $datas=array(array());
                // $datas=$dataresult['result']['data'];
            }else{
                echo $dataresult['error_code'].":".$dataresult['reason'];
            }
        }else{
            echo "请求失败";
        }
        //此处需注意，例如今天不是holiday，那holiday的值是什么，是否没有holiday这个组，所以建议先打印出数据再看。
        $this->assign(array(
            'avoid' => $avoid,
            'animalsYear' => $animalsYear,
            'weekday' => $weekday,
            'suit' => $suit,
            'lunarYear' => $lunarYear,
            'lunar' => $lunar,
            'date' => $date,
            'nowdays' => $nowdays,
         ));
        return view();
    }
}
