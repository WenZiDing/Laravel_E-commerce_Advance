<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function signup(CreateUser $request){
    $validatedData = $request->validated();
    $user = new User([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => password_hash($validatedData['password'], PASSWORD_DEFAULT),
    ]);
    $user->save();

    return response('success',201);
  }
  public function login(Request $request){
    $validataedData = $request->validate([
      'email'=>'required|string|email',
      'password'=>'required|string'
    ]);
    if (!Auth::attempt($validataedData)){
      return response('授權失敗',401);
    }
    $user = $request->user();
    $tokenRusult = $user->createToken('Token');
    $tokenRusult->token->save();
    return response(['token'=>$tokenRusult->accessToken]);
  }
    //
}
