<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Cache'; // 这里是您的实际类的别名或标识符
    }
}
