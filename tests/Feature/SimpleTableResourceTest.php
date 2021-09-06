<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class SimpleTableResourceTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_response()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/run/resource/simple-table')
            ->assertSuccessful()
            ->assertJsonCount(40, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'first_name',
                        'last_name',
                        'company',
                        'email',
                        'created_at',
                    ],
                ],
                'meta' => [
                    'columns' => [],
                ],
            ]);
    }
}
