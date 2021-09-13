<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Factory as Auth;

class AdminMicroMessenger
{

    protected $ingores = [
        'MainController@login',
        'MainController@logout',
        'MainController@jump',
        'MainController@welcome',
    ];

    protected $auth;

    public function __construct(Auth $auth )
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $this->writeLog($request);
        }catch (\Exception $e){
            logger()->error($e);
        }

        return $next($request);
    }

    public function writeLog($request)
    {
        $status=1;
        $route=$request->route();
        $routeName = $route->getName();

        if (in_array($routeName, $this->ingores)) {
            return true;
        }

        $user = $this->auth->user();
        
        $items = explode('@',$routeName);

        try{
            if(count(request()->allFiles()) > 0 ){
                $content ='';
            }else{
                $content = serialize(request()->all());
                if(strlen($content) > 2000){
                    $content ='';
                }
            }
        }catch (\Exception $e){
            logger()->error($e);
            $content ='';
        }

        $nicktitle = $this->getRouteTitle($routeName);

        $oLog = new \App\Models\Admin\AdminLogs();

        $oLog->users_id     = isset($user->id )? $user->id : 0;
        $oLog->username   = isset($user->name) ? $user->name : '';
        $oLog->type_id      = isset($user->type)?$user->type:0;
        $oLog->client_ip    = real_ip();;
        $oLog->proxy_ip     = 1;
        $oLog->request_url  = request()->url();
        $oLog->controller   = isset($items[0]) ? $items[0] : '';
        $oLog->action       = isset($items[1]) ? $items[1] : '';
        $oLog->status       = $status ? 1 : 0;
        $oLog->title        = "访问[{$nicktitle}]成功";
        $oLog->content      = $content;
        $s = $oLog->save();

        return $this;
    }

    public function getRouteTitle($routeName)
    {
        $acl    = config('admin.acl.privileges');
        foreach ($acl as $item) {
            if (!isset($item['child'])) {
                continue;;
            }
            foreach ($item['child'] as $secondItem) {
                if ($secondItem['action'] == $routeName) {
                    return $secondItem['title'];
                }
                if (!isset($secondItem['child'])) {
                    continue;;
                }
                foreach ($secondItem['child'] as $thirdItem) {
                    if (isset($thirdItem['action']) && $thirdItem['action'] == $routeName) {
                        return $thirdItem['title'];
                    }
                }
            }
        }
            
        return "";
    }

}
