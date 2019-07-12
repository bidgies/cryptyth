<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\JoinCode;

class AuthTest extends TestCase
{
    /** @test */
    public function loginUsername()
    {
        $response = $this->json('POST', 'api/auth/login',
          [
            'login' => 'Serien',
            'password' => 'secret'
          ]
        );

        $response->assertStatus(200)->assertJsonFragment([
          'id' => 2,
          'name' => 'Serien',
          'email' => 'serien@bidgies.com',
          'email_verified_at' => null,
        ]);
    }

    /** @test */
    public function loginEmail()
    {
        $response = $this->json('POST', 'api/auth/login',
          [
            'login' => 'serien@bidgies.com',
            'password' => 'secret'
          ]
        );

        $response->assertStatus(200)->assertJsonFragment([
          'id' => 2,
          'name' => 'Serien',
          'email' => 'serien@bidgies.com',
          'email_verified_at' => null,
        ]);
    }

    /** @test */
    public function loginValidation()
    {
        $response = $this->json('POST', 'api/auth/login',
          [
            'password' => 'secret'
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'login' => ['The login field is required.']
          ]
        ]);
        $response = $this->json('POST', 'api/auth/login',
          [
            'login' => 'Test@',
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'password' => ['The password field is required.']
          ]
        ]);
        $response = $this->json('POST', 'api/auth/login',
          [
            'login' => 'Serien',
            'password' => 'secret2'
          ]
        );
        $response->assertStatus(401)->assertJson([ 'error' => 'Unauthorised']);
    }

    /** @test */
    public function registerValidation()
    {
        $response = $this->json('POST', 'api/auth/register',
          [
            'name' => 'Seri@n',
            'email' => 'test@bidgies.com',
            'password' => 'secret',
            'joinCode' => 'test code'
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'name' => ['Your username contains invalid characters.']
          ]
        ]);
        $response = $this->json('POST', 'api/auth/register',
          [
            'name' => 'Serien',
            'email' => 'test',
            'password' => '',
            'joinCode' => 'test code'
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'name' => ['The name has already been taken.'],
            'email' => ['The email must be a valid email address.'],
            'password' => ['The password field is required.']
          ]
        ]);
        $response = $this->json('POST', 'api/auth/register',
          [
            'name' => 'Serien2',
            'email' => 'serien@bidgies.com',
            'password' => 'secret',
            'joinCode' => ''
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'email' => ['The email has already been taken.'],
            'joinCode' => ['You must enter a valid, unused join code.']
          ]
        ]);

        $response = $this->json('POST', 'api/auth/register',
          [
            'name' => 'Test User',
            'email' => 'test@bidgies.com',
            'password' => 'secret',
            'joinCode' => 'invalid code'
          ]
        );
        $response->assertStatus(422)->assertJson([
          'message' => 'The given data was invalid.',
          'errors' => [
            'joinCode' => ['You must enter a valid, unused join code.']
          ]
        ]);
    }

    /** @test **/
    public function registerUser() {
      $response = $this->json('POST', 'api/auth/register',
        [
          'name' => 'Test User',
          'email' => 'test@bidgies.com',
          'password' => 'secret',
          'joinCode' => 'test code'
        ]
      );

      $response->assertStatus(200)->assertJsonFragment([
        'name' => 'Test User',
        'email' => 'test@bidgies.com',
      ]);

      $user = User::where('email', 'test@bidgies.com')->first();
      $this->assertTrue($user->name === 'Test User');
      $this->assertTrue($user->hunters()->count() === 1);
      $this->assertTrue(JoinCode::where('used_by', $user->id)->count() === 1);

      $response = $this->json('POST', 'api/auth/register',
        [
          'name' => 'Test Again',
          'email' => 'test2@bidgies.com',
          'password' => 'secret',
          'joinCode' => 'test code'
        ]
      );

      $response->assertStatus(422)->assertJson([
        'message' => 'The given data was invalid.',
        'errors' => [
          'joinCode' => ['You must enter a valid, unused join code.']
        ]
      ]);
    }
}
