<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getPost(){
        $posts = Post::paginate(4);
        return response()->json([
            'posts' => $posts,
        ]);
    }
    //search post
    public function searchPost(Request $request ){

        $posts = Post::where('title','LIKE','%'.$request->key.'%')->paginate(4);
        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }
    //get post detail
    public function postDetail(Request $request){

        $post = Post::where('post_id',$request->id)->first();
        return response()->json([
            'status' => 'success',
            'post' => $post
        ]);
    }
    //like post
    public function likePost(Request $request){
        $post = Post::where('post_id',$request->post_id)->first();
        $post_like = $post->like + 1;
        Post::where('post_id',$request->post_id)->update([
            'like' => $post_like
        ]);
       return response()->json([
        'status' => 'like succes'
       ]);
    }
    //dislike post
    public function disLikePost(Request $request){
        $post = Post::where('post_id',$request->post_id)->first();
        $post_disLike = $post->dislike + 1;
        Post::where('post_id',$request->post_id)->update([
            'dislike' => $post_disLike
        ]);
        return response()->json([
            'status' => 'dislike success'
        ]);
    }
    //get reaction (like and dislike)
    public function getReaction(Request $request){
        $post = Post::where('post_id',$request->id)->first();
        $likeCount = $post->like;
        $disLikeCount = $post->dislike;
        return  response()->json([
            'status' => 'success',
            'like_count' => $likeCount,
            'dislike_count' => $disLikeCount
        ]);
    }
}
