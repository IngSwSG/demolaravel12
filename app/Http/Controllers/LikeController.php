<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Almacenar un like
    public function store(Post $post)
    {
        $post->like();

        return response()->json([
            'message' => 'Post liked successfully',
        ], Response::HTTP_CREATED);
    }

    // Eliminar un like
    public function destroy(Post $post)
    {
        $post->likes()
             ->where('user_id', auth()->id())
             ->delete();

        return response()->json([
            'message' => 'Like removed successfully',
        ], Response::HTTP_OK);
    }
}
