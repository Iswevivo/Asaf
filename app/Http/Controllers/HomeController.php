<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::with('images')->orderBy('created_at', 'desc')->paginate(6);
        return view('home', compact('posts'));
    }
}