<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_signup_returning_successful_response()
    {
        $user = User::factory()->create();
        $data = [
            "first_name" => "nidal",
            "last_name" => "jaafar",
            "email" => "nidaljaafar@x12.com",
            "password" => "1234",
            "password_confirmation" => "1234",
            "role" => "admin"
        ];
        $testResponse = $this->post('localhost:8000/api/signup', $data)
            ->assertCreated();
        var_dump($testResponse);
    }
}
