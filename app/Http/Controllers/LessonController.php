<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lesson;
use App\Models\User;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lessons = Lesson::with('subject')->paginate($request->input('per_page'));

        return response()->json($lessons);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLessonsByUser(Request $request, int $user_id)
    {
        $lesson = User::findOrFail($user_id)->lessons()->with('subject')->paginate($request->input('per_page'));

        return response()->json($lesson);
    }

}
