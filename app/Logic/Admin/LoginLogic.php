<?php
namespace App\Logic\Admin;

class LoginLogic
{
    /**
     * Login Admin function
     *
     * @param [type] $account
     * @param [type] $password
     * @param string $locked_verification_code
     * @return array
     */
    public static function login($account ,$password )
    {
        // 查询账号
        $admin = \App\Model\AdminUserModel::where('is_on' ,1)
                    ->where('account' ,$account)
                    ->first(['id' ,'account' ,'password' ,'phone' ,'salt' ,'avatar']);
        if (!$admin) {
            throw new \ApiException('用户不存在');
        }

        load_helper('Password');
        $get_password = encrypt_password($password ,$admin->salt);
        // 验证
        $error_num = 0;
        $lock_info = \Cache::get('login:admin:password:locked:' . md5($account));
        if ($lock_info) {
            $error_num = $lock_info['error_num'];
            //判断是否够3次
            if ($error_num >= 3) {
                throw new \ApiException('多次输入密码错误,请稍后重试');
            } 
        }

        if ($admin->password != $get_password) {
            \Cache::put('login:admin:password:locked:' . md5($account), ['error_num' => $error_num + 1], 600);
            throw new \ApiException("用户不存在或密码错误!");
        }

        // 获取权限
        $role = [];
        $role_info = $admin->roles()->get(['role_id', 'name']);

        if (!$role_info->isEmpty()) {
            foreach ($role_info as $v) {
                $role[] = $v->role_id;
            }
        }
        // 记录 ip信息 
        load_helper('Network');
        set_save_data($admin ,[
            'last_login_ip' => get_client_ip(),
            'last_login_time' => time()
        ]);
        $update = $admin->save();
        if (!$update) {
            throw new \ApiException('登录失败, 请稍后重试');
        }
        \Cache::forget('login:admin:password:locked:' . md5($account));

        // Jwt 记录信息
        \Jwt::set('admin_info' ,[
            'admin_id' => $admin->id,
            'phone' => $admin->phone,
            'role' => $role,
        ]);

        return [
            'account' => $admin->account,
            'phone' => $admin->phone,
            'avatar' => $admin->avatar ?? '',
        ];

    }
}