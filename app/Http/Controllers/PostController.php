<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(2);
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }
        return response()->json($posts);
    }
    public function show(Post $post)
    {
        return response()->json([
            'id'=>$post->id,
            'slug'=>$post->slug,
            'body'=>$post->body,
            'added_at'=>$post->created_at->diffForHumans(),
            'comments_count'=>$post->comments->count(),
            'image'=>$post->image,
            'user'=>$post->user,
            'title'=>$post->title,
            'category'=>$post->category,
            'comments'=>$post->comments->map(function ($comment) {
                return [
                    'id'=>$comment->id,
                    'body'=>$comment->body,
                    'user'=>$comment->user,
                    'added_at'=>$comment->created_at->diffForHumans()
                ];
            })

           /*  'comments'=>$this->commentsFormatted($post->comments) */
        ]);
    }
    public function commentsFormatted($comments){
       $new_comments = [];
       foreach($comments as $comment){
           array_push($new_comments,[
               'id'=>$comment->id,
               'body'=>$comment->body,
               'user'=>$comment->user,
               'added_at'=>$comment->created_at->diffForHumans()
           ]);
       }
       return $new_comments;
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
