<?php

namespace App\Services;

use App\Services\Contracts\UserService as IUserService;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Hunter;
use App\JoinCode;

class UserService implements IUserService {

  public function createUser($name, $email, $password, $joinCode) {
    $user = User::create([
      'name' => $name,
      'password' => Hash::make($password),
      'email' => $email,
    ]);
    $hunter = new Hunter();
    $user->hunters()->save($hunter);
    $code = JoinCode::where('code', $joinCode)->update([
      'used_by' => $user->id,
    ]);
    return $user;
  }


}
