<?php
namespace app\index\controller;

class Fxrate extends Common
{   
    // 汇率转化
    function convertCurrency($from="USD",$to="CNY",$amount="100"){
        if ($amount==""){
            $amount="1";
        }
        if ($from !== $to){
            $data = file_get_contents("http://www.baidu.com/s?wd={$from}%20{$to}&rsv_spt={$amount}");
            preg_match("/<div>1\D*=(\d*\.\d*)\D*<\/div>/",$data, $converted);
            $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
            return $amount*1.0*number_format(round($converted, 4), 4);
        }else{
            return $amount*1.0;
        }
    }
    public function fxrate()
    {
        $from=" ";
        $to=" ";
        $amount=" ";    
        $get_cur=" ";
         if (request()->isPost()){
            /*提取表单中的英文*/
            $from=input('from');
            preg_match("/[a-zA-Z]+/",$from, $fromed);
            $fromed=$fromed[0];
            $to=input('to');
            preg_match("/[a-zA-Z]+/",$to, $toed);
            $toed=$toed[0];
            $amount=input('amount'); 
            

            //调用汇率转换 
            $get_cur=$this->convertCurrency($fromed,$toed,$amount);

        }
        if ($amount==""){
            $amount="1";
        }
        $this->assign(array(
            'getcur' => $get_cur,
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
         ));
         return view();
    }
    
    
}
