<?php

namespace App\Http\Middleware;

use App\Services\Notify;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ( ! Auth::check()) {
        //     return $next($request);
        // }

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        if (request()->ajax()) {

            return $next($request);

        } else {
            $permissionName = $this->getPermissionNameFromRoute($request);
// dd($permissionName);
            if (access()->allow($permissionName) == true) {
                return $next($request);
            }

            return back()->withFlashDanger('Запрещенное действие! У Вас недостаточно прав для данного действия!');
        }
    }

    private function getPermissionNameFromRoute($request)
    {
        $action = $request->route()->getActionName();

        $_action = explode('@', $action);

        $controllerPath = explode('\\', $_action[0]);

        $controller = array_pop($controllerPath);
        $controller = Str::plural(str_replace('Controller', '', $controller));
        $controllerStr = $controller == 'Homes' ? 'dashboard' : snake_case($controller);

        $controllerPrefix = array_pop($controllerPath);
        $controllerPrefixStr = $controllerPrefix == 'Shop' ? $controllerPrefix .'_' : '';

        $method = end($_action);
        $methodSrt = $method == 'index' ? 'browse' : snake_case($method);

        return strtolower($methodSrt .'_'. $controllerPrefixStr . $controllerStr);
    }
}
