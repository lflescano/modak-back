<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Subject;
use App\Models\Lesson;

use Carbon\Carbon;
use DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds. Creating 50 Lessons with Random Users and Subjects already created.
     *
     * @return void
     */
    public function run()
    {
        Lesson::factory()->count(50)->create();
    }
}
