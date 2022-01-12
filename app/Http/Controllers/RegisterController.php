<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class RegisterController extends Controller
{
    public  function index(){
         $users = User::get();
        return view('pages.register',compact('users'));
    }

    public  function store(RegisterRequest $request){
        $user = User::create([
           'firstName' =>  $request->firstName,
            'middleName' =>  $request->middleName,
            'lastName' =>  $request->lastName,
            'email' =>  $request->email,
            'password' =>  $request->password,
        ]);
        if($user)
        return response()->json($user);
        else
            return response()->json([
                'status' => false,
                'msg' => 'SomeThing Error Try Again',
            ]);
    }

    public  function edit($id){
        $userData = User::find($id);
        return response()->json($userData);
    }

    public function update(RegisterRequest $request, $id){
        $user = User::find($id);
        if (!$user)
            return response()->json([
                'status' => false,
                'msg' => 'SomeThing Error Try Again',
            ]);
        else
            $user->update([
                'firstName' =>  $request->firstName,
                'middleName' =>  $request->middleName,
                'lastName' =>  $request->lastName,
                'email' =>  $request->email,
            ]);

            return response()->json($user);

    }
}
