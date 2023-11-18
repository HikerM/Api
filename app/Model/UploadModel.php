<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UploadModel extends Model
{
    protected $table = 'upload';

    //定义为毫秒时间戳
    protected $dateFormat = 'Uv';

    //获取created_at字段时处理
    public function getCreatedAtAttribute($value)
    {
        return $value / 1000;
    }

    //获取updated_at字段时处理
    public function getUpdatedAtAttribute($value)
    {
        return $value / 1000;
    }

    //不需要记录created_at或updated_at
    //protected $timestamps = false;

    protected $casts = [
        'id' => 'string',   //把id返回字符串
    ];

}