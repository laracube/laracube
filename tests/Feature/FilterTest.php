<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class FilterTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_response()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/run/filter/user-filter')
            ->assertSuccessful()
            ->assertJsonCount(40);
    }
}
