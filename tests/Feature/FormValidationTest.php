<?php

namespace Tests\Feature;

use Tests\TestCase;

class FormValidationTest extends TestCase
{
    public function testEmptyFields()
    {
        $response = $this->postJson('/api/play', ['name' => '', 'hand' => '']);
        $response->assertJson(['errors' => [
            'name' => ['The name field is required.'],
            'hand' => ['The hand field is required.']
        ]]);
    }

    public function testEmptyNameField()
    {
        $response = $this->postJson('/api/play', ['name' => '', 'hand' => '2 3 4 5']);
        $response->assertJson(['errors' => ['name' => ['The name field is required.']]]);
    }

    public function testEmptyHandField()
    {
        $response = $this->postJson('/api/play', ['name' => 'Gustavo', 'hand' => '']);
        $response->assertJson(['errors' => ['hand' => ['The hand field is required.']]]);
    }

    public function testInvalidCards()
    {
        $response = $this->postJson('/api/play', ['name' => 'Gustavo', 'hand' => '1 2 3']);
        $response->assertJson(['errors' => ['hand' => ["The cards must be in 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A."]]]);
    }

    public function testInvalidSizeCards()
    {
        $response = $this->postJson('/api/play', ['name' => 'Gustavo', 'hand' => '2 3 4 5 6 7 8 9 10 J Q K A 2']);
        $response->assertJson(['errors' => ['hand' => ["The hand must not be greater than 25 characters."]]]);
    }
}
