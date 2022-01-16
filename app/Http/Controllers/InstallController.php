<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDO;
use RegistersUsers;
class InstallController extends Controller
{
    public function install()
    {
        return view('install.install');
    }
    public function CodeValidate(Request $request){
        // if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $request->code)) {
        //     return [
        //         "error"=>true,
        //         "message" => "Invalid purchase code"
        //     ];
        // }
        $url = "https://secondnews.in/evto_valid.php";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "code=".$request->code;

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        if(array_key_exists("error",json_decode($resp,true))){
            return json_decode($resp,true);
        }else{
            $path = Storage::path(installDir());

            $file_url = json_decode($resp)->file;

            $fp = fopen($path, "w+");

            $ch = curl_init($file_url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
            $st_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
            return json_decode($resp,true);
        }






        // return ;
    }

    public function InstallStart(Request $request) {
        if(!isIHIns()){
            return [
                "error" => "0",
                "message" => "PURCHASE CODE NOT FOUND"
            ];
        }

        $host = $request->host;
        $db_name = $request->db_name;
        $db_user = $request->db_user;
        $db_pass = $request->db_pass;

        $this->overWriteEnvFile("INIT_DB_HOST",$host);
        $this->overWriteEnvFile("INIT_DB_DATABASE",$db_name);
        $this->overWriteEnvFile("INIT_DB_USERNAME",$db_user);
        $this->overWriteEnvFile("INIT_DB_PASSWORD",$db_pass);

        $path = Storage::path(installDir());
        $con = new PDO("mysql:host=$host;dbname=$db_name",$db_user,$db_pass);
    $stmt = $con->prepare(file_get_contents($path));
    return $stmt->execute();
    if($stmt->execute()){
        return "Successfully imported to the .";
    }
        // DB::unprepared(file_get_contents($path));
        // DB::connection()->getPdo()->exec($path);
        // return redirect('step5');

        return [
            "error" => "2",
            "message" => "Install complected"
        ];
    }
    public function CreateAccount(Request $request){
        $name = $request->first_name." " .$request->last_name;
        $email = $request->email_id;
        $phone = $request->phone;
        $this->overWriteEnvFile("CODE",$request->code);
        $user_check = User::where("email",$email)->first();
        if($user_check){
            $user_check_phone = User::where("phone",$phone)->first();
            if($user_check_phone){
                return [
                    "error" => false,
                    "message" => "Install complected"
                ];
            }else{
                $user_check->phone = $phone;
                $user_check->user_type = "admin";
                $user_check->save();
                return [
                    "error" => false,
                    "message" => "Install complected"
                ];
            }
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->user_type = "admin";
        $user->plateform = "web";
        $user->password = Hash::make($phone."@123");
        $user->save();
        return [
            "error" => false,
            "message" => "Install complected"
        ];;
    }

    public function overWriteEnvFile($key, $val)
    {

        $path = base_path('.env');

        if(is_bool(env($key)))
        {
            $old = env($key)? 'true' : 'false';
        }
        elseif(env($key)===null){
            $old = 'null';
        }
        else{
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=".$old, "$key=".$val, file_get_contents($path)
            ));
        }
    }
    public function DbCheck(Request $request){
        $host = $request->host;
        $db_name = $request->db_name;
        $db_user = $request->db_user;
        $db_pass = $request->db_pass;
        if(@mysqli_connect($host, $db_user, $db_pass, $db_name)) {
            return [
                "error" => false,
                "message" => "Connected"
            ];
        }else {
            return [
                "error" => true,
                "message" => "Mysql Database not found"
            ];
        }
    }
}
