<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    #
    public function index()
    {
        $all_posts = $this->post->latest()->get();

        return view('posts.index')
            ->with('all_posts', $all_posts);
    }


    # create() view the Create Post page
    public function create()
    {
        return view('posts.create');
    }


    # store() save the post to database
    public function store(Request $request)
    {
        # 1. Validate the request
        $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        // mime = multipurpose internet mail extensions

        # 2. Save the form data to the DB
        $this->post->user_id = Auth::user()->id;
        $this->post->title = $request->title;
        $this->post->body = $request->body;
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        # 3. Back to Homepage
        return redirect()->route('index');
    }

    # show() view the Show Post Page
    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('posts.show')
            ->with('post', $post);
    }


    # edit() view the Edit Post Page
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if ($post->user_id != Auth::user()->id) { // $post->user->id is also Ok.
            return redirect()->route('index');
        }

        return view('posts.edit')
            ->with('post', $post);
    }


    # update() save changes of the post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:50',
            'body' => 'required|min:1|max:1000',
            'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        // mime = multipurpose internet mail extensions

        $post = $this->post->findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;

        # if there's a new image ...
        if ($request->image) {
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        return redirect()->route('post.show', $id);
    }


    # destroy() - Delete the record of the post
    public function destroy($post_id)
    {
        $this->post->destroy($post_id);

        return redirect()->back();
    }
}
