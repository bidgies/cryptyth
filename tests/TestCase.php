<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
   * Migrates the database and set the mailer to 'pretend'.
   * This will cause the tests to run quickly.
   *
   */
  private function prepareForTests()
  {
    Artisan::call('migrate:refresh --seed');
    Mail::fake();
  }

  /**
   * Default preparation for each test
   *
   */
  public function setUp(): void
  {
    parent::setUp(); // Don't forget this!
    $this->prepareForTests();
  }
}
