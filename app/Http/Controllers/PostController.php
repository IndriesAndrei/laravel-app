<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        // eager loading with the relationships (user and likes) to reduce query numbers
        $posts = Post::with(['user', 'likes'])->paginate(2); // get all posts as collection

        // passing the posts to the view as array
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // create a post through the user table based on the posts() function from User Controller
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }
}
