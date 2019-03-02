<?php
namespace app\admin\controller;
use app\admin\model\Datacollect as DatacollectModel;
use app\admin\controller\Common;
class Datacollect extends Common
{
    public function lst()
    {
        $datacollect=new DatacollectModel();
        if(request()->isPost()){
            $sorts=input('post.');
            foreach ($sorts as $k => $v) {
                $datacollect->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('lst'));
            return;
        }
        $datacollectres=$datacollect->order('sort desc')->paginate(5);
        $this->assign('datacollectres',$datacollectres);
        return view();
	}

    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            
            $validate = \think\Loader::validate('datacollect');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $datacollect=new DatacollectModel;
            if($_FILES['thumb']['tmp_name']){
                $file=request()->file('thumb');
                $info=$file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='http://127.0.0.1/water/'. 'public' . DS . 'uploads' . '/' . $info->getSaveName();
                    $data['thumb']=$thumb;
                }
            }
            if($datacollect->save($data)){
                $this->success('添加采集方式成功！',url('lst'));
            }else{
                $this->error('添加采集方式失败！');
            }
        }
        return view();
    }

    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Datacollect');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $datacollect=new DatacollectModel();
            $save=$datacollect->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改采集方式成功！',url('lst'));
            }else{
                $this->error('修改采集方式失败！');
            }
            return;
        }
        $datacollects=DatacollectModel::find(input('id'));
        $this->assign('datacollects',$datacollects);
        return view();
    }

    public function del(){
        $del=DatacollectModel::destroy(input('id'));
        if($del){
           $this->success('删除采集方式成功！',url('lst')); 
        }else{
            $this->error('删除采集方式失败！');
        }
    }

    




   

	












}
