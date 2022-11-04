<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follow;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(Tweet::factory()->count(10))
            ->count(20)
            ->create();

        User::where('id', 1)->update(['username' => 'admin2022']);

        $follows = [
            [ 'user_id' => 1, 'followed' => [2,4,5,7,8,9,10,12,13,14,15,18,19,20]],
            [ 'user_id' => 2, 'followed' => [3,4,6,7,9,10,12,13,14,16,17,18]],
            [ 'user_id' => 3, 'followed' => [2,4,6,7,9,11,13,14,16,17,18,19,20]],
            [ 'user_id' => 4, 'followed' => [3,5,6,12]],
            [ 'user_id' => 5, 'followed' => [2,4,10,14,19]],
            [ 'user_id' => 6, 'followed' => [2,3,7,8,17]],
            [ 'user_id' => 7, 'followed' => [1,10,11,20]],
            [ 'user_id' => 8, 'followed' => [1,4,7,11,13,15,16,17]],
            [ 'user_id' => 9, 'followed' => [2,3,6,8,10,12,14,18]],
            [ 'user_id' => 10, 'followed' => [2,3,6,7,8,11,14,16]],
            [ 'user_id' => 11, 'followed' => [1,2,5,6,7,8,9,12,14,15,17,18,19]],
            [ 'user_id' => 12, 'followed' => [6,7,16,18,20]],
            [ 'user_id' => 13, 'followed' => [2,4,6]],
            [ 'user_id' => 14, 'followed' => [3,5,10,13]],
            [ 'user_id' => 15, 'followed' => [5,7,12,19]],
            [ 'user_id' => 16, 'followed' => [1,4,8,13]],
            [ 'user_id' => 17, 'followed' => [4,7,10,16]],
            [ 'user_id' => 18, 'followed' => [2,3,4,6,7,8,9,10,11,13,19,20]],
            [ 'user_id' => 19, 'followed' => [1,3,7,9]],
            [ 'user_id' => 20, 'followed' => [6,9,10]],
        ];

        foreach ($follows as $item) {
            foreach ($item['followed'] as $subitem) {
                Follow::create([ 'user_id' => $item['user_id'], 'followed_id' => $subitem]);
            }
        }
    }
}
