<?php
namespace app\index\controller;
use app\index\controller\Common;
class Violation extends Common
{   
	
    public function violation()
    {
  //       $city = 'GD_DG'; //城市代码，必传
		// $carno = '粤S*****'; //车牌号，必传
		// $engineno = '****'; //发动机号，需要的城市必传
		// $classno = '*****'; //车架号，需要的城市必传
		// $wzcitys=$this->getCitys(); //查询所有的支持城市
		$area = " "; //城市代码，必传
		$date = " "; //车牌号，必传
		$act = " "; //发动机号，需要的城市必传
		$fen = " "; //车架号，需要的城市必传
		$money = " ";
		$carnu = " ";
		$reason = " ";
		if(request()->isPost()){
			$city = 'JS_KUNSHAN'; //城市代码，必传
			$carno = input('carno'); //车牌号，必传
			$engineno = input('engineno'); //发动机号，需要的城市必传
			$classno = input('classno'); //车架号，需要的城市必传
			$carnu = $carno;
			//查询可查询违章的城市的接口
			$cityUrl = "http://v.juhe.cn/wz/citys";
	    	$appkey = "5bc4a98a7019eec6301949f476c02909";
	    	if ($city !== ""){
	    		$params = 'key='.$appkey."&format=2".'&province='.$city;
	    	}else{
	    		$params = 'key='.$appkey."&format=2";
	    	}
	        $content = $this->juhecurl($cityUrl,$params);
			$wzcitys=json_decode($content,true);
			//查询违章的车子
			$wzUrl = "http://v.juhe.cn/wz/query";
			//如果传过来的是数组，且有不必填写的，则需要用array这种方式
			$paramsw = array(
	                "engineno" => $engineno,//身份证号码
	                "city" => $city,
	                "hphm" => $carno,
	                "classno" => $classno,
	                "key" => $appkey,//你申请的key
	        );
			$paramstring = http_build_query($paramsw);
			$contentw = $this->juhecurl($wzUrl,$paramstring,1);
			$wzResult=json_decode($contentw,true);
			
			if($wzResult['error_code']==0){
				if($wzResult['result']['lists']){
					foreach ($wzResult['result']['lists'] as $key => $value) {
						# code...
						$area = $value['area']; 
						$date = $value['date']; 
						$act = $value['act']; 
						$fen = $value['fen']; 
						$money = $value['money'];
						// echo $value['area']." ".$value['date']." ".$value['act']." ".$value['fen']." ".$value['money']."<br>";
					}
				}else{
					echo "该车无违章记录";
				}
			}else{
				//查询不成功
				$reason=$wzResult['error_code'].":".$wzResult['reason'];
				// echo $wzResult['error_code'].":".$wzResult['reason'];
			}
		}
		$this->assign(array(
            'area' => $area,
            'fen' => $fen,
            'money' => $money,
            'date' => $date,
            'act' => $act,
            'carnu' => $carnu,
            'reason' => $reason,
         ));
        return view();
    }
}
