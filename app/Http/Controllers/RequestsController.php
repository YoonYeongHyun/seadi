<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class RequestsController extends Controller
{
    public function loadRequestView(){

        $items = Idea::all();
        return view('boards.idea_board', [
            'items' => $items
        ]);
        
    }
}