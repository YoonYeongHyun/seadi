<?php

namespace App\Http\Controllers\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Idea;
use App\Models\User;
use App\Http\Controllers\Controller;

class IdeasController extends Controller
{
    public function loadIdeasView(){

        $ideas = DB::table('ideas')
        ->leftJoin('users', 'ideas.created_id', '=', 'users.id')
        ->get();

        //return view('boards.idea_board', [
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

    public function storeIdea(Request $request): JsonResponse
    {
        dd($request->all());
        return view('boards.idea_board', [
            'ideas' => $request
        ]);
    }
}
