<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * 动态表,用来存储微博信息
 */
class Status extends Model
{
    protected $fillable = ['content'];  //指定在微博模型中可以进行正常更新的字段

    public function user()
    {
        return $this->belongsTo(User::class);   #指明一条微博属于一个用户
    }
}
