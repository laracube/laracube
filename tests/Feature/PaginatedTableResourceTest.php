<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class PaginatedTableResourceTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_response()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->get('laracube-api/run/resource/paginated-table')
            ->assertSuccessful()
            ->assertJsonCount(20, 'data')
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
                'links' => [],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [],
                    'path',
                    'per_page',
                    'to',
                    'total',
                    'columns' => [],
                ],
            ]);
    }
}
