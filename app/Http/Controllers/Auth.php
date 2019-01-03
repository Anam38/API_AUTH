<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\user as User;

class Auth extends Controller
{
    public function register(Request $request)
    {
      $validateStore = $request->validate([
          'name' => 'required',
          'email' => 'required',
          'password' => 'required',
      ]);

          $data = User::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'password'=> bcrypt($request->password),
            'token'   => '',
          ]);

      if ($data) {
          $response = [
            'Message' => 'Register is Succesfully',
            'Status'  => '200',
            'Body'    => $data,
          ];

          return Response()->json($response,200);
        }else {
          return Response()->json('error ',200);
        }
    }

    public function login(Request $request)
    {
      $email = $request->email;
      $pass = $request->password;
      $check = User::where('email',$email)->first();
      if ($check) {
        if (Hash::check($pass,$check->password)) {
            $check->token = str_random(75);
            $check->save();

              $response = [
                'Message'   => 'Login Sucsessfull',
                'Status'    => '200 OK',
                'name'      =>$check->name,
                'email' => $check->email,
                'Token' => $check->token,
              ];

            return Response()->json($response);
        }else{
          return Response()->json([
            'Message' => 'error, your Password is wrong',
            'status'  => '404',
          ]);
        }
      }else {
        return Response()->json([
          'Message' => 'error, your Email is wrong',
          'status'  => '404',
        ]);
      }
    }

    public function logout(Request $request)
    {
      $token = $request->header('Authorization');
      $user = User::where('token',$token)->first();
      if ($user) {
          $user->token = '';
          $user->save();

          return Response()->json([
            'Message' => 'Sucsessfull, logout is complite',
          ]);
        }else {

          return Response()->json([
            'Message' => 'error, Authorization token',
          ]);
        }
    }
}
