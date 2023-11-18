<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;


/**
 * 后台管理权限中间件
 * Class AdminCheck
 * @package App\Http\Middleware
 */
class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = \Jwt::get('admin_info.role' ,[]);

        $permissions = array();

        //超级管理员角色,则通过
        if (in_array(1, $roles)) {
            return $next($request);
        }

        //获取角色对应的权限
        foreach ($roles as $v) {
            $role = \App\Model\AdminRoleModel::where('id', $v)->where('is_on', 1)->first();
            if (!$role) {
                continue;
            }

            $get_cache = \Cache::get('cache:role_permission:' . $v);
            if (empty($get_cache)) {
                $permission = $role->permissions()->get(['name', 'slug']);

                if (!$permission->isEmpty()) {
                    $temp = array();
                    foreach ($permission as $vv) {
                        $code = explode(',', $vv->slug);
                        foreach ($code as $v) {
                            $temp_key = explode('@', $v);
                            if (isset($temp_key[2])) {
                                $key = $temp_key[0] . 'Controller@' . $temp_key[1] . '@' . strtoupper($temp_key[2]);
                            } else {
                                $key = $temp_key[0] . 'Controller@' . $temp_key[1];
                            }
                            $temp[$key] = 1;
                        }
                    }

                    $get_permission = $temp;
                } else {
                    continue;
                }
            } else {
                $get_permission = $get_cache;
            }
            $permissions = array_merge($permissions, $get_permission);
        }

        $route_info = \Route::getCurrentRoute();

        $module = '';

        if ($route_info->action['namespace']) {
            $namspace_arr = explode('\\', $route_info->action['namespace']);
            if (isset($namspace_arr[2]) && $namspace_arr[2] == 'Modules') {
                $module = '@' . strtoupper($namspace_arr[3]);
            }
        }

        $current_key = str_replace($route_info->action['namespace'] . '\Admin\\', '', $route_info->action['controller']) . $module;
        if (isset($permissions[$current_key]) && $permissions[$current_key] == 1) {

            return $next($request);
        }

        throw new ApiException('你没有访问权限,请联系管理员!', 'PERMISSION_DENIED', 403);
    }


}
