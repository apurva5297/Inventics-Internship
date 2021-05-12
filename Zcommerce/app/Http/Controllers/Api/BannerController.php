<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Image;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class BannerController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function bannerList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array();
        	$banner_type = $request->banner_type ? $request->banner_type : null;
            
           	$banners = Banner::where(function($query) use ($banner_type){
           						if($banner_type != null || $banner_type != '')
                                	$query->where('group_id',$banner_type);
                            })->get();
            foreach($banners as $banner)
            {
            	$data[] = array(
            		'title' => $banner->title,
                    'description' => $banner->description,
                    'link' => $banner->link,
                    'link_label' => $banner->link_label,
                    'bg_color' => $banner->bg_color,
                    'sub_category_list' => $banner->sub_category_list,
                    'group_id' => $banner->group_id,
                    'columns' => $banner->columns,
                    'order' => $banner->order,
                    'bg_image' => $banner->featuredImage->path,
                    'image' => $banner->image->path
            	);
            }
            return $this->processResponse('banner_list',$data,'success','List of Banner');
        }   
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function bannerListCreate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array(
                'title' => $request->title,
                'description' => $request->description ? $request->description : null,
                'link' => $request->link ? $request->link : null,
                'link_label' => $request->link_label ? $request->link_label : null,
                'bg_color' => $request->bg_color ? $request->bg_color : null,
                'sub_category_list' => $request->sub_category_list,
                'group_id' => $request->group_id ? $request->group_id : 1,
                'columns' => $request->columns ? $request->columns : 12,
                'order' => $request->order,
            );
            $banner = Banner::create($data);

            if ($request->file)
            {
                $img = str_replace('data:image/jpeg;base64,', '', $request->file);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $folderPath = base_path().'/public/images/banner/';
                $file =  time() . '.jpeg';
                $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
                $image = $success ? 'images/banner/'.$file : 'No image found';
                $img_data = array(
                    'path' => $image,
                    'imageable_id' => $banner->id,
                    'imageable_type' => 'App\Banner'
                );

                Image::create($img_data);
            }

            return $this->processResponse('banner_list_create',null,'success','List of Banner Created');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }


    public function bannerListUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array(
                'title' => $request->title,
                'description' => $request->description ? $request->description : null,
                'link' => $request->link ? $request->link : null,
                'link_label' => $request->link_label ? $request->link_label : null,
                'bg_color' => $request->bg_color ? $request->bg_color : null,
                'sub_category_list' => $request->sub_category_list,
                'group_id' => $request->group_id ? $request->group_id : 1,
                'columns' => $request->columns ? $request->columns : 12,
                'order' => $request->order,
            );
            $banner = Banner::where('id',$request->id)->update($data);

            if ($request->file)
            {
                $img = str_replace('data:image/jpeg;base64,', '', $request->file);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $folderPath = base_path().'/public/images/banner/';
                $file =  time() . '.jpeg';
                $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
                $image = $success ? 'images/banner/'.$file : 'No image found';
                $img_data = array(
                    'path' => $image,
                    'imageable_id' => $request->id,
                    'imageable_type' => 'App\Banner'
                );

                Image::where(['imageable_id'=>$request->id, 'imageable_type' => 'App\Banner'])->update($img_data);
            }

            return $this->processResponse('banner_list_updated',null,'success','List of Banner Updated');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
    
}
