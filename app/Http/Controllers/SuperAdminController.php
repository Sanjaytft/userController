<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    //
    public function index()
    {
      $posts = Post::all();
      return view('super-admin.index', compact('posts'));
    }
    
    public function dashboard()
    {
        return view('super-admin.dashboard');
    }

    public function users()
    {
        $users = User::where('role_id','!=',1)->latest()->get();
        return view('super-admin.users', compact('users'));
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->route('Super-admin.users')->with('status', 'User Deleted Sucessfully');
    }

    public function manageRole()
    {
        $users = User::where('role','!=',1)->get();
        $roles = Role::all();
        return view('super-admin.manage-role', compact(['users','roles']));
    }

    public function updateRole(Request $request)
    {
        User::where('id', $request->user_id)->update([
            'role' => $request->role_id
        ]);
        return redirect()->back();
    }



}
