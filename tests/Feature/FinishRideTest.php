<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FinishRideTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->carId = 1;
        $this->userId = 1;
        $this->json('POST', "/api/rides/{$this->carId}/start/{$this->userId}");
    }

    public function test_base_finish()
    {
        $response = $this->json('PATCH', "/api/rides/{$this->carId}/finish");
        $response->assertStatus(201);
        $this->assertDatabaseHas('rides', [
            'user_id' => $this->userId,
            'car_id' => $this->carId,
            'active' => false,
        ]);
        $this->assertDatabaseCount('rides', 1);
    }

    public function test_not_started_finish()
    {
        $otherCarId = 2;
        $response = $this->json('PATCH', "/api/rides/{$otherCarId}/finish");
        $response->assertStatus(404);
        $this->assertDatabaseHas('rides', [
            'user_id' => $this->userId,
            'car_id' => $this->carId,
            'active' => true,
        ]);
        $this->assertDatabaseCount('rides', 1);
    }
}
