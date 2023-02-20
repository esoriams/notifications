<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create some users
        User::factory(3)->create();
        // create the categories
        DB::table('categories')->insert([
            ['name' => 'Sports'],
            ['name' => 'Finance'],
            ['name' => 'Movies'],
        ]);
        // create the notification types
        DB::table('channels')->insert([
            [
                'name' => 'SMS',
                'endpoint' => 'sms'
            ],
            [
                'name' => 'E-Mail',
                'endpoint' => 'email'
            ],
            [
                'name' => 'Push Notification',
                'endpoint' => 'push'
            ],
        ]);
        // create the category user
        DB::table('category_user')->insert([
            [ 'user_id' => 1, 'category_id' => 1],
            [ 'user_id' => 1, 'category_id' => 2],
            [ 'user_id' => 2, 'category_id' => 2],
            [ 'user_id' => 2, 'category_id' => 3],
            [ 'user_id' => 3, 'category_id' => 2],
        ]);
        // create the channel user
        DB::table('channel_user')->insert([
            [ 'user_id' => 1, 'channel_id' => 1],
            [ 'user_id' => 1, 'channel_id' => 2],
            [ 'user_id' => 2, 'channel_id' => 2],
            [ 'user_id' => 2, 'channel_id' => 3],
            [ 'user_id' => 3, 'channel_id' => 2],
        ]);
    }
}
