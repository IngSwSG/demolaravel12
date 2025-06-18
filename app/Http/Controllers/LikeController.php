<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
      public function toggle(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = $request->user();

        $liked = $post->toggleLike($user);

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likesCount()
        ]);
    }

     // Agregar like
     
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = $request->user();

        $post->addLike($user);

        return response()->json([
            'message' => 'Like agregado',
            'likes_count' => $post->likesCount()
        ]);
    }

     //Quitar like
     
    public function destroy(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = $request->user();

        $post->removeLike($user);

        return response()->json([
            'message' => 'Like removido',
            'likes_count' => $post->likesCount()
        ]);
    }
}
