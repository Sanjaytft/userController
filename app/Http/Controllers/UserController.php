<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Json;

class UserController extends Controller
{
    //
    public function index () 
    {
        $user_id = Auth::user()->id;
        return view ('/dashboard', compact('user_id'));
    }
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function destroy(Request $request)
    {
      $user = User::find($request->user_id);
      $user->delete();
      $post = Post::where('user_id', $user->id)->delete();
      return back()
        ->with('success', 'User deleted successfully');
    }

    public function change_department(Request $request)
    {
      $user = User::find($request->user_id);
      $user->department_id = $request->department_id;
      $user->save();
      
      $posts = Post::where('user_id', $user->id)->get();
      foreach ($posts as $post) {
          $post->department_id = $request->department_id;
          $post->save();
      }
       
      return back()->with('status','Department change successfully!!!');
    }

    public function change_role(Request $request)
    {
      $role = User::find($request->user_id);
      $role->role_id=$request->role_id;
      $role->save();
      return back()->with('status','Role change successfully!!!');
    }
}
