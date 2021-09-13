<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;

class MainController extends Controller
{

    public function index() {

        $admin      = $this->getCurrentUser();

        $adminId    = $admin->id;

        $menus      = $admin->getPrivilegeMenus();

        if (empty($menus)){
            auth('admin')->logout();
            return redirect('login')->with('warning', '暂未分权');;
        }

        $live=[];

        return $this->render('index')->with('admin', $admin)->with('menus', $menus)
//            ->with('uid', $adminId)
//
//            ->with('live', json_encode($live))
//            ->with('admin_group_name', $admin->group->group_name)
//
            ;
    }

    public static $login_rules = array(
        'user' => 'required|alpha_dash|min:2',
        'password' => 'required|alpha_dash|between:4,45',
//        'google_password' => 'required|alpha_num|between:4,45',
    );

    public function login(){
       
        if (auth('admin')->check()){
            
            return redirect('');
        }

        if (request()->isMethod('post')){
            $validator = validator(request()->all(), self::$login_rules,['user'=>'账号格式不对','password'=>'账号格式不对','google_password'=>'账号格式不对']);

            if ($validator->passes()) {

                $username = request('user','');

                $tryuser = Admin::where('name','=',$username)->first();

//                if(!$tryuser){
//                    try{
//                        $at_chat_id = configure('web_telegram_chat_id_at','');
//                        $msg = "不存在的异常账号:{$username} 尝试登录财务后台失败!!!!!!, 时间:".date('Y-m-d H:i:s',time())."";
//                        if($at_chat_id){
//                            $msg .="\n ";
//                            $ats = explode(',',$at_chat_id);
//                            foreach($ats as $at){
//                                $msg.="@".$at.' ';
//                            }
//                        }
//
//                        $job = new \App\Jobs\Telegram($msg);
//                        $job->onQueue( config('tube.Email', 'default') );
//                        dispatch( $job );
//                    }catch (\Exception $e){
//                        logger()->error($e);
//                    }
//
//                    return redirect('login')->with('warning', '登陆失败！');
//                }
                if(!$tryuser->google){
                    
                    return redirect('login')->with('warning', '登陆失败！');
                }

                $google2fa = new Google2FA();
                $google_password = request('google_password','');

                if(!$google_password || !$google2fa->verifyKey($tryuser->google, $google_password) ){
                    return redirect('login')->with('warning', '登陆失败！');
                }
//                $len=3;
//                if(strlen($username)<=$len){
//                    $tg_username = $tryuser->id.':'.$username.str_repeat('*',6-strlen($username));
//                }else{
//                    $tg_username = $tryuser->id.':'.str_limit($username, $len,'***');
//                }
//
//                $job = new \App\Jobs\Telegram("管理员:ID[{$tg_username}] 登录财务后台,登录时间:".date('Y-m-d H:i:s',time())."");
//                $job->onQueue( config('tube.Email', 'default') );
//

                if (auth('admin')->attempt(array('name' => request('user', ''), 'password' => request('password', '')), request('remember', 0) ? true : false)) {
                    $user = auth('admin')->user();

                    if ($user->status != 1) {
                        auth('admin')->logout();
                        return redirect('login')->with('warning', '登陆失败，账户处于禁用状态！');
                    }


//                    $iCostWorker = configure('web_pass_workers',10);
//                    dd($iCostWorker);
//                    $options = ['rounds' => $iCostWorker];
//                    if (Hash::needsRehash($user['password'],$options)) {
//                        $user->password = bcrypt(request('password'),$options);
//                    }
//
//                    if (Hash::needsRehash($user['password'])) {
//                        $user->password = bcrypt(request('password'));
//                    }

                    $user->session_id=session()->getId();
                    $user->save();

//                    try{
//                        $job = new \App\Jobs\Telegram("管理员:ID[{$tg_username}] 已登录财务后台,登录时间:".date('Y-m-d H:i:s',time())."");
//                        $job->onQueue( config('tube.Email', 'default') );
//                        dispatch( $job );
//                    }catch (\Exception $e){
//                        logger()->error($e);
//                    }
                    
                    return redirect('');
                }
//
//                try{
//                    $job = new \App\Jobs\Telegram("账号:ID[{$tg_username}] 尝试登录财务后台失败!, 时间:".date('Y-m-d H:i:s',time())."");
//                    $job->onQueue( config('tube.Email', 'default') );
//                    dispatch( $job );
//                }catch (\Exception $e){
//                    logger()->error($e);
//                }

                return redirect('login')->with('warning', '登陆失败，账号或密码错误！');
            } else {
                return redirect('login')->withErrors($validator)->withInput();
            }

        }
      
        return $this->render('login');
    }
    /**
     * 提示页面 跳转中转页面
     */
    public function jump()
    {
        $message = request('msg', '未知消息');
        $type    = request('type', 0);
        $links   = request('links', []);

        return $this->render('main_jump')
            ->with('msg', $message)
            ->with('type', $type)
            ->with('links', $links);
    }

    public function welcome()
    {
        return $this->render('welcome');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect('');
    }
}
