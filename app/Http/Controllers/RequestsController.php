<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;

class RequestsController extends Controller
{
    public function loadRequestView(){
        return view('boards.idea_board');
    }
}