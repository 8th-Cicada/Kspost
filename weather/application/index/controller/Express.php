<?php
namespace app\index\controller;

use exp;
use app\index\controller\Common;
class Express extends Common
{  
    public function express()
    {
    	require(ROOT_PATH . 'vendor/exp.php');//引入PHP EXCEL类
        $appkey = '776ae0554edcd90740c1d6217ce59717';
        $exp = new exp($appkey);

        $company='';
        $number='';
        $list='';

        $comResult = $exp->getComs();
        if($comResult['error_code'] == 0){
            foreach ($comResult as $k => $v) {
                if ($k == 'result'){
                     $comlist = $v;
                }
            }
        }

        if(request()->isPost()){
        	$comp = input('comlist');//快递公司编码
        	$no = input('number');//快递编号
        	$result=$exp->query($comp,$no);
            
        	if($result['error_code'] == 0){//查询成功
                if($result['result']['list']){
                    foreach ($result as $k => $v) {
                        if ($k == 'result'){
                            $company = $v['company']; 
                            $number = $v['no']; 
                            $list = $v['list']; 
                        }
                    }
                }
        	}else{
        		echo $result['error_code'] . ":" . $result['reason'];
        	}
        }
        
        $this->assign(array(
            'comlist'=>$comlist,
            'company'=>$company,
            'number'=>$number,
            'list'=>$list
        ));
        
        return view();
    }
}
