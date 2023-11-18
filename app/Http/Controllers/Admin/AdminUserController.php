<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function store(Request $request)
    {
        $this->verify([
            'account' => '',
            'password' => '',
            'realname' => '',
            'type' => '',
            'company_id' => '',
            'phone' => 'no_required|mobile',
            'avatar' => 'no_required|egnum|can_null',
        ], 'POST');
        \App\Logic\Admin\AdminUserLogic::addAdminUser($this->verifyData);

        return $this->response();
    }
}