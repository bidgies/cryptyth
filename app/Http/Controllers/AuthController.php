<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard as AuthService;
use App\Services\Contracts\UserService;

use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserLogin;

class AuthController extends Controller
{

  public $authService;
  public $userService;

  public function __construct(AuthService $authService, UserService $userService) {
    $this->authService = $authService;
    $this->userService = $userService;
  }

  function login(UserLogin $login) {
    if(
      $this->authService->attempt(['email' => $login->login, 'password' => $login->password], true) ||
      $this->authService->attempt(['name' => $login->login, 'password' => $login->password], true)
    ){
      return response()->json($this->authService->user());
    }
    else{
      return response()->json(['error'=>'Unauthorised'], 401);
    }
  }

  function register(UserRegistration $register) {
    $user = $this->userService->createUser(
      $register->name, $register->email, $register->password, $register->joinCode
    );

    $this->authService->login($user);
    return response()->json($user);
  }

  function resetPassword() {

  }

  function logout(Request $request) {
    $this->authService->logout();

    return response()->json(['success' => true ]);
  }

  function user() {
    return response()->json($this->authService->user());
  }
}
