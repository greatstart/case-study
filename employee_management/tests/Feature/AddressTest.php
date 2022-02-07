<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_with_permission_can_view_index_page()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->givePermissionTo('address-list');

        $response = $this->get('/addresses');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_with_permission_can_create_address()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->givePermissionTo('address-create');

        $response = $this->post('/addresses', [
            'name' => 'Bangsar Office',
            'unit' => '100',
            'street' => 'Jalan Maarof',
            'postcode' => '51000',
            'country' => 'Malaysia'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('addresses', [
            'name' => 'Bangsar Office',
        ]);

        $address = Address::first();

        $this->assertEquals('Bangsar Office', $address->name);
        $this->assertEquals('100', $address->unit);
        $this->assertEquals('Jalan Maarof', $address->street);
        $this->assertEquals('51000', $address->postcode);
        $this->assertEquals('Malaysia', $address->country);
    }
}
