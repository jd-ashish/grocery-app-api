<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Image;
use ImageOptimizer;
use Cloudinary;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::orderBy('id','desc')->get();
        return view('admin.products.category.index',compact('category'));
    }
    public function create(){
        return view('admin.products.category.create');
    }
    public function upload_category(Request $request){

        $cat_name = $request->category_name;

        if($cat_name==""){
            return back()->with("error","Write some thing");
        }
        if(!$request->hasFile("photos")){
            return back()->with("error","Without image cannot be create category");
        }
        $uploads = new Uploads();
        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = $cat_name;
        $category->status = 1;
        if($request->hasFile("photos")){
            $file_arr = array();
            $files = "";
            if(setting("cloudinar")=="1" && setting("default_storage")=="cloudinar"){
                $uploadedFileUrl = Cloudinary::upload($request->file('photos')->getRealPath(),[
                    "folder" => "products/category/image"
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
                $uploads->location_type  = "create_category";
                $uploads->single_file_full_url  = $files;
                $uploads->json_data  = $file_arr;
                $uploads->alt  = $request->file('photos')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();

                $category->upload_id = $uploads->id;
                $category->save();

                $update_upload = Uploads::where('id',$uploads->id)->first();
                $update_upload->location_type_id = $category->id;
                $update_upload->save();
            }
            if(setting("local")=="1"  && setting("default_storage")=="local"){
                $path = $request->photos->store('uploads/products/category/image');
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
                $uploads->alt  = $request->file('photos')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();

                $category->upload_id = $uploads->id;
                $category->save();

                $update_upload = Uploads::where('id',$uploads->id)->first();
                $update_upload->location_type_id = $category->id;
                $update_upload->save();
            }
            return redirect(route('product.category'))->with("success","Category Created successfully");
            // $image       = $request->file('photos');
            // $filename    = $image->getClientOriginalName();

            // $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(300, 300);

            // $upload_folder = ('uploads/products/category/image/300X300/' .$filename);
            // $image_resize->save(public_path($upload_folder));
            // return $upload_folder;

// Store the uploaded file on Cloudinary
// $result = $request->file('file')->storeOnCloudinary();

            // // Upload an Image File to Cloudinary with One line of Code

            // $uploadedFileUrl = Cloudinary::upload($request->file('photos')->getRealPath(),[
            //     "folder" => "products/category/image"
            // ]);

            // return $uploadedFileUrl->getPublicId();

            // return $path = $request->photos->store('uploads/products/category/image');
            // ImageOptimizer::optimize(base_path('public/').$path);

        }
    }
    public function delete(Request $request,$id){

        $cat = Category::where("id",$id)->first();
        if($cat==null){
            return ["error" => true , "message" => "No any category found to delete more!"];
        }
        $upload_id = $cat->upload_id;
        $upload = Uploads::where("id",$upload_id)->first();
        if($upload->upload_to=="cloudinar"){

            // return json_decode($upload->json_data)->id;
            Cloudinary::destroy(json_decode($upload->json_data)->id);
            $upload->delete();
            $cat->delete();
        }
        if($upload->upload_to=="local"){

            // return json_decode($upload->json_data)->id;
            unlink(($upload->single_file));
            $upload->delete();
            $cat->delete();
        }
        return back()->with("success","Deleted successfully");
        // return Cloudinary::destroy('products/category/image/ikpcx5xdrggblvsmpute');
        // unlink(("uploads/products/category/image/ZiEoQKYWfgKcS5vJokOvav4Tv5ZR6VAhMxrHuwLi.jpg"));
        // unlink(("uploads/products/category/image/300X300/maxresdefault (3).jpg"));
    }

}
