<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

  /*
   * showLogin
   *
   * Logout the user and serve the login page.
   */
  public function showLogin()
  {
    session_unset();
    return view('login');
  }

  /*
   * login
   *
   * Compares submitted credentials to DB user and hash.
   * Adds user to session if successful and notifies client of login success
   * or failure.
   */
  public function login(Request $request)
  {
    $data = $request->all();
    $email = $data["email"];
    $pw = $data["password"];

    // If incomplete request...
    if( empty($email) || empty($pw) ) {
      // TODO: Handle
    }

    // Find user by email.
    $user = \App\Models\User::where('email', $email)->first();

    // If user not found...
    if( empty($user) ) {
      // TODO: Handle
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

      // Generate response.
      $accept = array( "logged_in" => true, "user_name" => $user_name, "user_id" => $user_id );
      return response()->json($accept);

    } else {

      // Do not authenticate, generate response.
      $reject = array( "logged_in" => false );
      return response()->json($reject);
    }
  }
}
