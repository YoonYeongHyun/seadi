<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;

class IdeasController extends Controller
{
    public function loadIdeasView(){

        $ideas = DB::table('ideas')
        ->leftJoin('users', 'ideas.writer_id', '=', 'users.id')
        ->get();

        return view('boards.idea_board', [
            'ideas' => $ideas
        ]);
    }

    public function loadWriteIdeaView(){

        $users = User::all();

        return view('boards.idea_write', [
            'users' => $users
        ]);
    }
}
