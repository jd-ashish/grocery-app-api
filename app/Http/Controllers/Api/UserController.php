<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Uploads;
use App\Models\User;
use App\Models\UserAddress;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    protected function get_user_by_id(){
        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        return response()->json([
            'access_token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer',
            'error' => false,
            'message' => 'Login Success',
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => ($user->avatar=="" || $user->avatar==null)? "": get_image_by_upload_id($user->avatar),
                'avatar_original' => $user->avatar_original,
                'phone' => $user->phone,
                'plateform' => $user->plateform,
                'provider_id' => $user->provider_id,
            ]
        ]);
    }

    public function deleteUserAddress($id){
        $order = Order::where("shipping_address",$id)->first();
        if($order){
            return response()->json([
                'error' => true,
                'message' => "This address can not be deleted"
            ]);
        }else{
            $userAddress = UserAddress::where("id",$id)->first();
            $userAddress->delete();
            return response()->json([
                'error' =>false,
                'message' => "Address has been deleted"
            ]);
        }

        return $user = Auth::user()->getAddress;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function update_profile(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        if($user){
            $user_check_2 = User::where("email",$request->email)->where('id','!=',Auth::user()->id)->first();
        if($user_check_2 ){
        return response()->json([
                                'error' => true,
                            'message' => "This email already used"
                            ]);
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            if($user->save()){
        return response()->json([
                                'error' => false,
                            'message' => "Profile update successfully"
                            ]);
            }else{
        return response()->json([
                                'error' => true,
                            'message' => "Something coing wrong"
                            ]);
            }
        }
        }else{
        return response()->json([
                                'error' => true,
                            'message' => "Not valid account"
                            ]);
        }
    }
    public function update_profile_pic(Request $request)
    {
// return response()->json([
//                        'error' => true,
//                        'message' => $request->file('file')->getRealPath()
//                    ]);

        $user = User::findOrFail(Auth::user()->id);
        if($user->avatar!=""){
            delete_image_by_upload_id($user->avatar);
        }
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
                $uploads->location_type  = "user";
                $uploads->single_file_full_url  = $files;
                $uploads->json_data  = $file_arr;
                $uploads->alt  = $request->file('file')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();

                $user_update = User::where('id',Auth::user()->id)->first();
                $user_update->avatar = $uploads->id;
                if($user_update->save()){
                    return response()->json([
                        'error' => false,
                        'message' => 'Profile upload successfully'
                    ]);;
                }else{
                    return response()->json([
                        'error' => true,
                        'message' => 'Some thing going wrong , try after some time'
                    ]);;
                }


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
                $uploads->location_type  = "user";
                $uploads->single_file  = $path;
                $uploads->single_file_full_url  = $files;
                $uploads->json_data  = $file_arr;
                $uploads->alt  = $request->file('file')->getClientOriginalName();
                $uploads->status  = 1;
                $uploads->save();

                $user_update = User::where('id',Auth::user()->id)->first();
                $user_update->avatar = $uploads->id;
                if($user_update->save()){
                    return response()->json([
                        'error' => false,
                        'message' => 'Profile upload successfully'
                    ]);;
                }else{
                    return response()->json([
                        'error' => true,
                        'message' => 'Some thing going wrong , try after some time'
                    ]);;
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_address()
    {
        return Auth::user()->getAddress;
    }
}
