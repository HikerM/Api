<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Jwt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jwt'; // 这里是您的实际类的别名或标识符
    }
}
