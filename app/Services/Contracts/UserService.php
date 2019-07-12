<?php

namespace App\Services\Contracts;

interface UserService {
  public function createUser($name, $email, $password, $joinCode);
}
