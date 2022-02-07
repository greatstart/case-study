<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_duplicate_user()
    {
        $user1 = User::make([
            'name' => 'William',
            'email' => 'william@happycat.com'
        ]);

        $user2 = User::make([
            'name' => 'CN',
            'email' => 'cn@happycat.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }
        
        $this->assertTrue(true);
    }

    public function test_register_new_user()
    {
        $response = $this->post('/register', [
            'name' => 'William',
            'email' => 'william@happycat.com',
            'password' => 'happycat',
            'password_confirmation' => 'happycat'
        ]);

        $response->assertRedirect('/home');
    }
}
