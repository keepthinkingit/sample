<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //只为前 7 个用户生成共 321 条微博假数据
        $user_ids = ['1', '2', '3' , '4', '5', '6', '7'];
        $faker = app(Faker\Generator::class);   #获取一个 Faker 容器 的实例

        //借助 randomElement 方法来取出用户 id 数组中的任意一个元素并赋值给微博的 user_id，使得每个用户都拥有不同数量的微博
        $statuses = factory(Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
            $status->user_id = $faker->randomElement($user_ids);
    });

        status::insert($statuses->toArray());
    }
}
