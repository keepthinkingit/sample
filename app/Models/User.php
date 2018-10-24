<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Auth;

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
     * 获取当前用户关注的人发布过的所有微博动态
     */
    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
                     ->with('user')
                     ->orderBy('created_at', 'desc');
    }

    /*
     * 粉丝关系列表
     */
    public function followers()
    {
        //belongsToMany 参数:关联模型全称,中间表名,中间表中当前model对应的关联字段,中间表中目标model对应的关联字段
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /*
     *用户关注人列表
     *  关注人列表，关联表，当前model在中间表中的字段，目标model在中间表中的字段
     */
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    //关注
    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids);
    }

    //取消关注
    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    /*
     * 判断是否含有user_id,即:是否已经在关注列表
     */
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
