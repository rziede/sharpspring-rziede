<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Sharpspring Notes Authenticate
 *
 * Simple authentication. Inspects session for logged in user
 * for each route decorated with Authenticate.
 */
class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      // If the user is logged in...
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        // Proceed.
        return $next($request);

      // If the user is not...
      } else {
        // Redirect to login page.
        return redirect()->route('login_page');
      }
    }
}
