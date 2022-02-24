<?php

namespace App\Http\Controllers;
use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function bbs() {
        $posts = Post::all();
        $error = array();
 
        return view('test_db', [
           'posts' => $posts,
            'error' => $error
        ]);
 
    }
}
