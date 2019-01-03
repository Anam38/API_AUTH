<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user as User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $response = [
        'Message'   => 'Sucsesfull',
        'Status'    => '200 OK',
        'body'      => User::all(),
      ];
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = User::create([
        'name'    => $request->name,
        'email'    => $request->email,
        'password'    => bcrypt($request->password),
        'token'   => '',
      ]);
      $response = [
        'message' => 'added data is Sucsessfull',
        'status'  =>  '200 OK',
        'body'    =>  $data,
      ];

      return Response()->json($response);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id',$id)->first();
        $response = [
          'message' => 'Detail',
          'status'  =>  '200 OK',
          'body'    =>  $data,
        ];

        return Response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::where('id', $id)->first();
          $data->name   = $request->name;
          $data->email   = $request->email;
          $data->password =$request->password;

        $response = [
          'message' => 'update data is Sucsessfull',
          'status'  =>  '200 OK',
          'body'    =>  $data,
        ];

        return Response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return Response()->json([
          'message' => 'delete is Succesfully',
        ]);
    }
}
