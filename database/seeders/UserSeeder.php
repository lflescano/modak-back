<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Friendship;
use App\Models\Lesson;
use App\Models\LessonUser;
use Carbon\Carbon;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds for creating 11 Users. 10 using factory
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->upsert([
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'password' => bcrypt('Ac123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ], "email");

        User::factory()
            ->count(10)->create();

        LessonUser::factory()->count(30)->create();

        Friendship::factory()->count(30)->create();
    }
}
