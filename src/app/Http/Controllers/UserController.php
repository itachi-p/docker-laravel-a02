<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    # show() view the Profile Page
    public function show($user_id)
    {
        // $user = $this->user->findOrFail(Auth::user()->id);

        // 8/29追加課題：ログインユーザー本人以外のプロフィールも閲覧可能に変更
        $user = $this->user->findOrFail($user_id);

        return view('users.show')
            ->with('user', $user);
    }


    # edit() view the Edit Profile Page
    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.edit')
            ->with('user', $user);
    }


    # update() save changes of the Auth user details
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar' => 'mimes:jpg,png,jpeg,gif|max:1048',
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        # if there's new avatar
        if ($request->avatar) {
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('profile.show', $user->id);
    }
}
