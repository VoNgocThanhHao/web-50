<?php

namespace App\Http\Controllers;

use App\Models\profileModel;
use App\Models\ToolsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class usersController extends Controller
{

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['username'=>$username,'password'=>$password])){
            if (Auth::user()->permission == 0)
                return ToolsModel::status('Từ chối truy cập', 500);
            return ToolsModel::status('Đăng nhập thành công', 200);
        }

        return ToolsModel::status('Sai tài khoản hoặc mật khẩu!', 500);
    }

    public function userLogin(Request  $request){
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['username'=>$username,'password'=>$password]))
            return ToolsModel::status('Đăng nhập thành công', 200);
        return ToolsModel::status('Sai tài khoản hoặc mật khẩu!', 500);

    }

    public function regis(Request $request){
        $profile = new profileModel();
        $profile->name = 'Unknow';
        $profile->image= 'images/users/unknow.jpg';
        $profile->score= 0;
        $profile->score_used= 0;
        $profile->total=0;
        $profile->save();

        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->hint_password = $request->input('password');
        $user->email = $request->input('email');
        $user->permission = 0;
        $user->id_profile = $profile['id'];

        if ($user->save())
            return ToolsModel::status('Đăng ký tài khoản thành công', 200);
        return ToolsModel::status('Đăng ký tài khoản thất bại', 500);
    }

    public function changePassWord(Request $request){
        $user = User::find($request->input('id'));
        $user->password = bcrypt($request->input('password'));
        $user->hint_password = $request->input('password');
        if ($user->save())
            return ToolsModel::status('Đổi mật khẩu thành công', 200);
        return ToolsModel::status('Đổi mật khẩu thất bại', 500);
    }

    public function getPassWord(Request $request){
        try {
            $user = User::find($request->input('id'));
            return $user->hint_password;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function resetPass(Request $request){

        $token = Str::random(64);
        $id = User::where('username',$request->input('username'))->first();
        if (!$id) return ToolsModel::status('Tên đăng nhập không tồn tại!', 500);

        $user = User::find($id['id'])->toArray();

        if (!$user['email']) return ToolsModel::status('Email của tài khoản này không tồn tại!', 500);

        DB::table('password_resets')->insert([
            'email' => $user['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.resetPassword', ['token' => $token, 'id' => $id['id']], function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Đặt lại mật khẩu');
        });

        return ToolsModel::status('Đã gửi đến email của tài khoản '.$request->input('username'), 200);

    }


    public function getViewReset($id, $token){

        $object = DB::table('password_resets')->where('token', $token) -> first();


        if (!$object) return abort(404);

        Carbon::setLocale('vi');
        $now = Carbon::now();
        $dt = Carbon::create($object->created_at);
        $time_out = $dt->diffInMinutes($now);

        if ($time_out < 10)
            return view('reset-password',['id'=>$id, 'token'=>$token, 'username' => (User::find($id)->toArray())['username']]);
        DB::table('password_resets')->where(['token'=> $token])->delete();
        return abort(404);
    }

    public function reset_password(Request $request){
        $user = User::find($request->input('id'));

        $object = DB::table('password_resets')->where('email', $user['email']) -> first();
        if ($request->input('token') != $object->token)
            return ToolsModel::status($object->token, 500);

        $user->password = bcrypt($request->input('password'));
        $user->hint_password = $request->input('password');

        if ($user->save()) {
            DB::table('password_resets')->where(['token' => $request->input('token')])->delete();
            return ToolsModel::status('Thay đổi mật khẩu thành công', 200);
        }
        return ToolsModel::status('Thay đổi mật khẩu thất bại', 500);

    }


    public function verify($id_user){

        $token = Str::random(64);
        $user = User::find($id_user);

        DB::table('password_resets')->insert([
            'email' => $user['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.verify_email', ['token' => $token, 'id' => $id_user], function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Kích hoạt tài khoản');
        });

        return ToolsModel::status('Đã gửi thông tin đến email của bạn!', 200);
    }

    public function active($id, $token){
        $object = DB::table('password_resets')->where('token', $token) -> first();

        if (!$object) return abort(404);

        Carbon::setLocale('vi');
        $now = Carbon::now();
        $dt = Carbon::create($object->created_at);
        $time_out = $dt->diffInMinutes($now);
        DB::table('password_resets')->where(['token'=> $token])->delete();

        if ($time_out < 10)
        {
            $user = User::find($id);
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect('/');
        }
        return abort(404);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function getView(){
        return view('admin.users');
    }

    public function getData(){
        $data =User::all()->sortBy('username');
        return datatables($data)->make(true);
    }

    public function insert(Request $request){

        $profile = new profileModel();
        $profile->name = 'Unknow';
        $profile->image= 'images/users/unknow.jpg';
        $profile->score= 0;
        $profile->score_used= 0;
        $profile->total=0;
        $profile->save();

        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->hint_password = $request->input('password');
        $user->email = $request->input('email');
        $user->permission = $request->input('permission');
        $user->id_profile = $profile['id'];
        $email_check = $request->input('email_verified');

        if ($email_check == "true")
            $user->email_verified_at = Carbon::now();

        if ($user->save())
            return ToolsModel::status('Thêm thành công tài khoản '.$request->input('username'), 200);
        return ToolsModel::status('Thêm thất bại tài khoản '.$request->input('username'), 500);
    }

    public function delete(Request $request){

        profileModel::find(User::find($request->input('id'))['id_profile'])->delete();
        $name = (User::find($request->input('id'))->toArray())['username'];
        $result = User::find($request->input('id'))->delete();
        if ($result)
            return ToolsModel::status('Xóa thành công tài khoản '.$name, 200);
        return ToolsModel::status('Xóa thất bại tài khoản '.$name, 500);
    }

    public function update(Request $request){
        $user = User::find($request->input('id'));
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->hint_password = $request->input('password');
        $user->email = $request->input('email');
        $user->permission = $request->input('permission');
        if (($request->input('email_verified'))=='true' && $user['email_verified_at'] == null)
            $user->email_verified_at = Carbon::now();
        elseif (($request->input('email_verified'))=='false')
            $user->email_verified_at = null;


        if ($user->save())
            return ToolsModel::status('Cập nhật thành công tài khoản '.$request->input('username'), 200);
        return ToolsModel::status('Cập nhật thất bại tài khoản '.$request->input('username'), 500);
    }

    public function checkUsername(Request $request){
        $user = User::where('username',$request->input('username'))->first();
        if ($user)
            return true;
        return false;
    }

    public function checkUsername_update(Request $request){
        $user = User::where('username',$request->input('username'))->where('id','!=',$request->input('id'))->first();

        if ($user)
            return true;
        return false;
    }
}
