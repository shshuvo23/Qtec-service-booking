<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     use RefreshDatabase;

    /** @test */
    public function guests_cannot_access_admin_routes()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login'); // or assertStatus(403) for APIs
    }

    /** @test */
    public function non_admin_users_cannot_access_admin_routes()
{
    $user = User::factory()->create(['role' => 'customer']);

    // Test web route
    $webResponse = $this->actingAs($user)
        ->get('/admin/dashboard');

    // Test API route
    $apiResponse = $this->actingAs($user)
        ->getJson('/api/admin/dashboard');

    // For web routes - either redirect or 403 is acceptable
    if ($webResponse->isRedirect()) {
        $webResponse->assertRedirect('/')
            ->assertSessionHas('error', 'Unauthorized access');
    } else {
        $webResponse->assertForbidden(); // HTTP 403
    }

    // For API routes - should always be 403
    $apiResponse->assertForbidden()
        ->assertJson(['message' => 'Unauthorized']);
}

    /** @test */
    public function admin_users_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->get('/admin/dashboard');

        $response->assertOk(); // HTTP 200
    }

    /** @test */
    public function api_returns_proper_response_for_unauthorized_admins()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)
            ->getJson('/api/admin/dashboard');

        $response->assertStatus(403)
            ->assertJson(['message' => 'Unauthorized access']);
    }
}
