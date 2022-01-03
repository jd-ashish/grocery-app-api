<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Uploads;
use App\Models\User;
use Image;
use ImageOptimizer;
use Cloudinary;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function upload(Request $request){

        $uploads = new Uploads();
        if($request->hasFile("file")){
            $file_arr = array();
            $files = "";
            if(setting("cloudinar")=="1" && setting("default_storage")=="cloudinar"){
                $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath(),[
                    "folder" => "media/image"
                ]);
                $files = $uploadedFileUrl->getSecurePath();
                $file_arr = json_encode(array(
                    "getPath" =>  $uploadedFileUrl->getPath(),
                    "getSecurePath" =>  $uploadedFileUrl->getSecurePath(),
                    "getSize" =>  $uploadedFileUrl->getSize(),
                    "getReadableSize" =>  $uploadedFileUrl->getReadableSize(),
                    "getFileType" =>  $uploadedFileUrl->getFileType(),
                    "getFileName" =>  $uploadedFileUrl->getFileName(),
                    "getOriginalFileName" =>  $uploadedFileUrl->getOriginalFileName(),
                    "getPublicId" =>  $uploadedFileUrl->getPublicId(),
                    "id" =>  $uploadedFileUrl->getPublicId(),
                    "getExtension" =>  $uploadedFileUrl->getExtension(),
                    "getWidth" =>  $uploadedFileUrl->getWidth(),
                    "getHeight" =>  $uploadedFileUrl->getHeight(),
                    "getTimeUploaded" =>  $uploadedFileUrl->getTimeUploaded(),
                ));

                $uploads->user_id = Auth::user()->id;
                $uploads->upload_to  = "cloudinar";
                $uploads->location_type  = "media_controlled";
                $uploads->single_file_full_url  = $files;
                $uploads->json_data  = $file_arr;
                $uploads->alt  = $request->file('file')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();
            }
            if(setting("local")=="1"  && setting("default_storage")=="local"){
                $path = $request->file->store('uploads/media/image');
                ImageOptimizer::optimize(base_path('public/').$path);

                $files = asset($path);
                $file_arr = json_encode(array(
                    "stored_path" =>  $path,
                ));

                $uploads->user_id = Auth::user()->id;
                $uploads->upload_to  = "local";
                $uploads->location_type  = "create_category";
                $uploads->single_file  = $path;
                $uploads->single_file_full_url  = $files;
                $uploads->json_data  = $file_arr;
                $uploads->alt  = $request->file('file')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();

            }
        }
        // return "not image found";
    }

    public function getMediaLibrary(Request $request){

        $upload = Uploads::all();

        $arr = array();
        foreach($upload as $item){

            $arr[] = array(
                "upload_at" => get_image_array_by_upload_id($item->id)['created_at'],
                "image_id" => get_image_array_by_upload_id($item->id)['image_id'],
                "img_url" => get_image_array_by_upload_id($item->id)['img_url'],
                "size" => get_image_array_by_upload_id($item->id)['size'],
                "dimensions" => get_image_array_by_upload_id($item->id)['dimensions'],
                "title" => get_image_array_by_upload_id($item->id)['title'],
                "alt" => get_image_array_by_upload_id($item->id)['alt'],);
        }


        return $arr;
    }
    public function update_alt(Request $request){


        $upload_id = $request->imgid;
        $upload = Uploads::where("id",$upload_id)->first();

        if($upload==null){
            return ["error" => true , "message" => "No data found! ".$request->upload_id];
        }
        $upload->alt = $request->alt;
        $upload->save();
        return ["error" => false , "message" => "This image alt successfully!"];
    }
    public function delete(Request $request){
        return delete_image_by_upload_id($request->upload_id);
    }
}
