<?php

namespace App\Http\Middleware;

use Closure;
use App\user as User;

class Userlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $token = $request->header('Authorization');
      $user = User::where('token',$token)->first();
      if($user) {

        return $next($request);

      } else {
        return response()->json([
          'message' => 'Authorization token',
        ]);
      }
    }
}
