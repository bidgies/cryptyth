<?php

use Illuminate\Database\Seeder;

use App\Services\Contracts\UserService;
use App\Services\Contracts\HunterService;

class UserSeed extends Seeder
{

  public $userService;
  public $hunterService;

  public function __construct(UserService $userService, HunterService $hunterService) {
    $this->userService = $userService;
    $this->hunterService = $hunterService;
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
        'BlackSapphire',
        'sapphy@bidgies.com',
        'secret',
        null
      );
      $this->userService->createUser(
        'Ithildin',
        'ithildin@bidgies.com',
        'secret',
        null
      );
      $this->hunterService->createHunterNpc(
        'Anna',
        'vanna_things'
      );
      $this->hunterService->createHunterNpc(
        'Tibs',
        'ol_yeller'
      );
      $this->userService->createUser(
        'Falconblade',
        'falconblade@bidgies.com',
        'secret',
        null
      );
      $this->hunterService->createHunterNpc(
        'NPC 3',
        'booya'
      );
      $this->userService->createUser(
        'Sylphie',
        'sylphie@bidgies.com',
        'secret',
        null
      );
      $this->hunterService->createHunterNpc(
        'NPC 4',
        'ahdhg'
      );
      $this->userService->createUser(
        'Eleven',
        'eleven@bidgies.com',
        'secret',
        null
      );
      $this->hunterService->createHunterNpc(
        'NPC 5',
        'dhgjsfd'
      );
      $this->userService->createUser(
        'Maui',
        'maui@bidgies.com',
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
