<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    # store() save the comment to database
    public function store($post_id, Request $request)
    {
        $request->validate([
            'comment' => 'required|min:1|max:150'
        ]);

        $this->comment->user_id = Auth::user()->id; // Who created the comment and it is actually always the auth user
        $this->comment->post_id = $post_id; // What post was commented
        $this->comment->body = $request->comment; // What is the comment
        $this->comment->save();

        return redirect()->back();
    }


    # destroy() - delete a comment that owner can own comment
    public function destroy($comm_id)
    {
        $this->comment->destroy($comm_id);

        return redirect()->back();
    }
}
