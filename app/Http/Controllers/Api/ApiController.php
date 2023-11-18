<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
class ApiController extends Controller
{
    public function init()
    {
        $user_id = \Jwt::get('user_info.user_id', 0);
        $token = \Jwt::createToken(
            [
                'user_info' => [
                    'user_id' => $user_id,
                ]
            ],
            'web'
        );
        return $this->response($token);

    }

    public function user()
    {
        return 3;
    }
}