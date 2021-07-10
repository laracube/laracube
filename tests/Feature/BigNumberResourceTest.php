<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class BigNumberResourceTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_response()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->get('laracube-api/run/resource/big-number')
            ->assertSuccessful()
            ->assertJson([
                'number' => 40
            ]);
    }
}
