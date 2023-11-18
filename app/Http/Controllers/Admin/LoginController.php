<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Loigin Admin function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->verify([
            'account' => '',
            'password' => '',
        ] ,'POST');
        $data = \App\Logic\Admin\LoginLogic::login($this->verifyData['account'], $this->verifyData['password']);
        return $this->response($data);
    }
     /**
     * 退出登录
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        \Jwt::destroy();
        return $this->response();
    }
}