<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Program;
use App\Models\Event;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Donation;
use App\Models\Type;
use App\Models\Project;
use App\Models\Resource;
use App\Models\Partner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $centers = Center::all();
        $programs = Program::all();
        $events = Event::all();
        $posts = Post::all();
        $tags = Tag::all();
        $categories = Category::all();
        $comments = Comment::all();
        $images = Image::all();
        $users = User::all();
        $donations = Donation::all();
        $types = Type::all();
        $projects = Project::all();
        $resources = Resource::all();
        $partners = Partner::all();

        return view('dashboard', compact(
            'centers', 
            'programs', 
            'events', 
            'posts', 
            'tags', 
            'categories', 
            'comments', 
            'images', 
            'users', 
            'donations', 
            'types', 
            'projects', 
            'resources', 
            'partners'
        ));
    }
}