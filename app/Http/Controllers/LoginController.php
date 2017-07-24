<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
      // Unset session and show login page.
      session_unset();
      return view('login');
    }

    // Reinventing the wheel! Why add stateful auth to Lumen when Laravel exists?
    public function login(Request $request)
    {
      $data = $request->all();
      $email = $data["email"];
      $pw = $data["password"];

      // If incomplete request...
      if( empty($email) || empty($pw) ) {

      }

      // See if user exists.
      $user = \App\Models\User::where('email', $email)->first();

      // If user not found...
      if( empty($user) ) {

      }

      $hash = $user["password"];
      $password_match = password_verify($pw, $hash);
      $user_name = $user["name"];
      $user_id = $user["id"];

      // If password matches...
      if( $password_match ) {

        // Update session.
        $_SESSION["logged_in"] = true;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_id'] = $user_id;

        $accept = array( "logged_in" => true, "user_name" => $user_name, "user_id" => $user_id );
        //$accept = json_encode($accept);
        //return $accept;
        return response()->json($accept);

      } else {
        // Do not authenticate.
        $reject = array( "logged_in" => false );
        //$reject = json_encode($reject);
        //return $reject;
        return response()->json($reject);
      }
    }

    // public function authenticate()
    // {
    //   if (Auth::attempt(['email' => $email, 'password' => $password])) {
    //     // Authentication passed...
    //     return redirect()->intended('dashboard');
    //   }
    // }
}
