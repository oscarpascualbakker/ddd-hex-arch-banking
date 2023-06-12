<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $response = $this->call('POST', '/users', [], [], [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['name' => 'John Doe', 'email' => 'john.doe@example.com', 'password' => 'securepassword'])
        );

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'createdAt'
        ]);
    }
}
