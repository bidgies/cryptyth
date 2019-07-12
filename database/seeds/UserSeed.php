<?php

use Illuminate\Database\Seeder;

use App\Services\Contracts\UserService;

class UserSeed extends Seeder
{

  public $userService;

  public function __construct(UserService $userService) {
    $this->userService = $userService;
  }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->userService->createUser(
        'Ishliayaq',
        'ishliayaq@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        'Serien',
        'serien@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        '3',
        '3@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        'Ithildin',
        'ithildin@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        'Eleven',
        'eleven@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        '6',
        '6@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        'Falconblade',
        'falconblade@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        '8',
        '8@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        '9',
        '9@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        '10',
        '10@bidgies.com',
        'secret',
        null
      );

      // Test join codes
      DB::table('join_codes')->insert([
        'code' => 'test code',
        'user_id' => 2,
      ]);
      DB::table('join_codes')->insert([
        'code' => 'test code 2',
        'user_id' => 2,
      ]);
    }
}
