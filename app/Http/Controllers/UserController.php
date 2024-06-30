<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      return back()
        ->with('success', 'User deleted successfully');
    }

    public function change_department(Request $request)
    {
      $user = User::find($request->user_id);
      $user->department_id=json_encode($request->department_id);
      $user->save();
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
