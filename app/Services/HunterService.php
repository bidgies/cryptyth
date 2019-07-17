<?php

namespace App\Services;
use App\Services\Contracts\HunterService as IHunterService;

use App\Hunter;

class HunterService implements IHunterService
{
  public function createHunterNpc($name, $handle) {
    $hunter = Hunter::create([
      'name' => $name,
      'handle' => $handle,
      'npc' => true,
    ]);
  }
}
