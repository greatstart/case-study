<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use Spatie\Permission\Models\Role; 
use Faker\Factory as Faker; 
use App\User; 
use Hash; 

class LoginTest extends TestCase
{
    protected $faker, $user; 

  /** 
   * Create a new faker instance. 
   * 
   * @return void 
   */ 

   public function __construct() { 

     parent::__construct(); 
     $this->faker = Faker::create();
    }

    /**
     * Create a new user instance.
     *
     * @return array
     */
    private function validCredentials()
    {
        self::createRoles();
        $password   = $this->faker->password;
        $this->user = factory(User::class)->create(['password' => Hash::make($password)]);

        return [
            'email'    => $this->user->email,
            'password' => $password,
        ];
    }

    /**
     * Create a roles
     *
     * @return void
    */
    public static function createRoles()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'supplier'],
            ['name' => 'user']
        ];

        foreach($roles as $key => $role) {
            Role::create($role);
        }
    }

    /**
    * @test
    * Assert a user can view login form.
    *
    * @return void
    */
    public function user_can_view_a_login_form()
    {
        $this->get('/login')
             ->assertStatus(200)
             ->assertViewIs('auth.login');
    }

    /**
    * @test
    * Assert a admin can login
    *
    * @return void
    */
    public function a_admin_can_login()
    {
        $credentials = $this->validCredentials();
        $this->user->assignRole(['admin']);

        $this->post('/login', $credentials)
             ->assertRedirect(route('home'))
             ->assertSessionHasNoErrors()
             ->assertStatus(302);
    }

 
    /**
    * @test
    * Assert a user can not login without email or password
    *
    * @return void
    */
    public function a_user_can_not_login_without_credentials()
    {
        $this->post('/login', [])
             ->assertSessionHasErrors([
                'email'    => 'The email field is required.',
                'password' => 'The password field is required.',
             ]);
    }

    /**
    * @test
    * Assert a user can not login without email
    *
    * @return void
    */
    public function a_user_can_not_login_without_email()
    {
        $credentials = $this->validCredentials();
        unset($credentials['email']);

        $this->post('/login', $credentials)
             ->assertSessionHasErrors([
                'email' => 'The email field is required.',
             ]);
    }

    /**
    * @test
    * Assert a user can not login without password
    *
    * @return void
    */
    public function a_user_can_not_login_without_password()
    {
        $credentials = $this->validCredentials();
        unset($credentials['password']);

        $this->post('/login', $credentials)
             ->assertSessionHasErrors([
                'password' => 'The password field is required.',
             ]);
    }
    
}
