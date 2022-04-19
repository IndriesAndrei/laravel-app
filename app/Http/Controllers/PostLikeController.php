<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Post $post) {

        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }
        // a user can add only one like
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post) {
        // only likes the user has created
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }

}
