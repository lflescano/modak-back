<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Friendship;
use App\Models\User;

class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $friendships = Friendship::with('user','friend')->paginate($request->input('per_page'));

        return response()->json($friendships);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFriendshipByUser(Request $request, int $user_id)
    {
        $friends_by_user = User::findOrFail($user_id)->friendships()->paginate($request->input('per_page'));

        return response()->json($friends_by_user);
    }

    
}
