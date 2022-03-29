<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'john',
            'email' => 'john@mailaddress.com',
        ]);

        $user2 = User::make([
            'name' => 'pole',
            'email' => 'pole@mailaddress.com',
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function test_delete_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if ($user) {
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_it_stores_new_users()
    {
        $response = $this->post('/register', [
            'name' => 'bellsilver7a',
            'email' => 'bellsilver7a@mailaddress.com',
            'password' => 'qlalfqjsgh486',
            'password_confirmation' => 'qlalfqjsgh486',
        ]);

        $response->assertRedirect('/home');
    }

    public function test_database()
    {
        $this->assertDatabaseMissing('users', [
            'name' => 'bellsilver7',
        ]);
    }

    public function test_if_seeders_works()
    {
        $this->seed(); // Seed all seeders in the Seeders folder
        // php artisan db:seed
    }
}
