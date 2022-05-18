<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StartRideTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->carId = 1;
        $this->userId = 1;
    }

    public function test_get_car_by_user()
    {
        $response = $this->json('POST', "/api/rides/{$this->carId}/start/{$this->userId}");
        $response
            ->assertStatus(201)
            ->assertExactJson([
                'success' => 'Поездка началась',
            ]);
        $this->assertDatabaseHas('rides', [
            'user_id' => $this->userId,
            'car_id' => $this->carId,
            'active' => true,
        ]);
        $this->assertDatabaseCount('rides', 1);
    }

    public function test_get_car_by_other_user()
    {
        $this->json('POST', "/api/rides/{$this->carId}/start/{$this->userId}");

        $otherUserId = 2;
        $response = $this->json('POST', "/api/rides/{$this->carId}/start/{$otherUserId}");
        $response
            ->assertStatus(400)
            ->assertExactJson([
                'error' => 'Автомобиль уже управляется каким-то пользователем',
            ]);
    }

    public function test_get_other_car_by_user()
    {
        $this->json('POST', "/api/rides/{$this->carId}/start/{$this->userId}");

        $otherCarId = 2;
        $response = $this->json('POST', "/api/rides/{$otherCarId}/start/{$this->userId}");
        $response
            ->assertStatus(400)
            ->assertExactJson([
                'error' => 'Пользователь уже управляет каким-то автомобилем',
            ]);
    }

    public function test_get_not_existing_car()
    {
        $notExistingCarId = 100;
        $response = $this->json('POST', "/api/rides/{$notExistingCarId}/start/{$this->userId}");
        $response->assertStatus(404);
    }

    public function test_get_by_not_existing_user()
    {
        $notExistingUserId = 100;
        $response = $this->json('POST', "/api/rides/{$this->carId}/start/{$notExistingUserId}");
        $response->assertStatus(404);
    }

    public function test_two_rides()
    {
        $this->json('POST', "/api/rides/{$this->carId}/start/{$this->userId}");
        [$otherCarId, $otherUserId] = [2, 2];
        $this->json('POST', "/api/rides/{$otherCarId}/start/{$otherUserId}");
        $this->assertDatabaseHas('rides', [
            'user_id' => $otherUserId,
            'car_id' => $otherCarId,
            'active' => true,
        ]);
        $this->assertDatabaseCount('rides', 2);
    }
}
