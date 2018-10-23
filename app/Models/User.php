<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    public static function boot()
    {
        parent::boot();     //boot 方法会在用户模型类完成初始化之后进行加载

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);   #指明一个用户拥有多条微博  同statused表user方法相对应
    }

    /*
     * 将当前用户发布过的所有微博从数据库中取出，并根据创建时间来倒序排序。
     * TODO:获取当前用户关注的人发布过的所有微博动态
     */
    public function feed()
    {
        return $this->statuses()
                    ->orderBy('created_at', 'desc');
    }
}
