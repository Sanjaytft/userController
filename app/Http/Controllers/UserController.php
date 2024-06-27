<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
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
}
