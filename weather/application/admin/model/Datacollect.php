<?php
namespace app\admin\model;
use think\Model;
class Datacollect extends Model
{
  	protected static function init()
    {
      	Datacollect::event('before_insert',function($datacollect)
      	{
          	if($_FILES['thumb']['tmp_name']){
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/water/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $datacollect['thumb']=$thumb;
                }
            }
    	});


      	Datacollect::event('before_update',function($datacollect)
      	{
          	if($_FILES['thumb']['tmp_name']){
          		$datacollects=Datacollect::find($datacollect->id);
          		$thumbpath=$_SERVER['DOCUMENT_ROOT'].$datacollects['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $thumb='/water/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
                    $datacollect['thumb']=$thumb;
                }
            }
      	});
   
            
      	Datacollect::event('before_delete',function($datacollect){
          		$datacollects=Datacollect::find($datacollect->id);
          		$thumbpath=$_SERVER['DOCUMENT_ROOT'].$datacollects['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
        });

    }  



}
