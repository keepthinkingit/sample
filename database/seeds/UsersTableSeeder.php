<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();   //批量生成50个用户
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        //  自动设置第2个用户为管理员等属性
        $user = User::find(1);
        $user->name = 'abcford';
        $user->email = 'abcford@email.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
