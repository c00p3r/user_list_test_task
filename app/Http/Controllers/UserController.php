<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        return view('users');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function usersData(Request $request)
    {
        $comments = Comment::select('comment')->orderBy('created_at', 'desc')->groupBy('user_id');


//        $users = User::select([
//            'users.id',
//            'users.first_name',
//            'users.last_name',
//            'users.phone',
//            'users.address',
//            'users.created_at',
//            //            \DB::raw('count(comments.user_id) as count'),
//            //            \DB::raw('max(comments.id) as last_comment'),
//        ])->join('comments', 'comments.user_id', '=', 'users.id')
//            ->get();


        $users = User::all();

        $users->each(function ($item, $key) {
            $item['count']        = $item->comments()->count();
            $first                = $item->comments()->latest()->first();
            $item['last_comment'] = empty($first->comment) ? '' : $first->comment;
        });

        return Datatables::of($users)->make(true);
    }
}


