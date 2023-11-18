<?php
namespace App\Logic\Admin;

use App\Exceptions\ApiException;

class AdminUserLogic
{

    /**
     * 添加管理员
     * @param array $data 要添加的数据
     * @return bool
     * @throws ApiException
     */
    public static function addAdminUser($data)
    {
        //验证用户名是否已经被使用
        $verift_admin = \App\Model\AdminUserModel::where('is_on' ,1)
            ->where('account' ,$data['account'])
            ->first(['id']);

        if (!empty($verift_admin)) {
            throw new ApiException('该用户已被注册');
        }

        load_helper('Password');
        $get_password = create_password($data['password'], $salt);

        load_helper('Network');

        \DB::beginTransaction();

        $admin_user_model = new \App\Model\AdminUserModel();
        $get_admin_data = array(
            'account' => $data['account'],
            'phone' => isset($data['phone']) ? $data['phone'] : 0,
            'password' => $get_password,
            'salt' => $salt,
            'realname' => $data['realname'],
            'type' => $data['type'],
            'company_id' => $data['company_id'],
            'last_login_ip' => get_client_ip()
        );

        //上传的头像
        if (isset($data['avatar'])) {
            if (!empty($data['avatar'])) {
                $path = \App\Model\UploadModel::where('is_on', 1)
                    ->select('path')
                    ->find($data['avatar']);

                if (!$path) {
                    \DB::beginTransaction();
                    throw new ApiException('图片不存在!');
                }

                $get_admin_data['avatar'] = $path->path;
            } else {
                $get_admin_data['avatar'] = '';
            }

        }

        set_save_data($admin_user_model, $get_admin_data);
        $res = $admin_user_model->save();

        if (!$res) {
            \DB::beginTransaction();
            throw new ApiException('数据库错误!');
        }
        \DB::commit();
        return true;
    }
}