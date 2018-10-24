<div class="stats">
    <a href="{{ route('users.followings', $user->id) }}">
        <strong id="following" class="stat">
            {{ count($user->followings) }}
        </strong>
        关注
    </a>
    <a href="{{ route('users.followers', $user->id) }}">
        <strong id="followers" class="stat">
            {{ count($user->followers) }}
        </strong>
        粉丝
    </a>
    <a href="{{ route('users.show', $user->id) }}">
        <strong id="statuses" class="stat">
            {{--TODO: 在数据库中添加一个模型计数器字段--}}
            {{ $user->statuses()->count() }}
        </strong>
        微博
    </a>
</div>