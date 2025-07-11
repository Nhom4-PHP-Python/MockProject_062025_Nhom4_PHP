<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Sc009AndSc010\User;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'username'    => 'required|string',
      'password' => 'required',
    ]);

    $user = User::where('username', $request->username)
      ->where('is_deleted', 0)
      ->first();

    // Check if user exists and has correct role_id is Report Approver
    if ($user && $user->role_id == 11) {
      if ($request->password === $user->password_hash) {
        // Save user to session
        Session::put('user', $user);
        return redirect()->route('reports');
      } else {
        return back()->withErrors(['password' => 'Incorrect password.']);
      }
    }

    return back()->withErrors(['username' => 'Invalid credentials or unauthorized access.']);
  }

  public function logout()
  {
    // Delete the entire session
    Session::flush();
    return redirect()->route('login')->with('message', 'Logged out successfully.');
  }
}
