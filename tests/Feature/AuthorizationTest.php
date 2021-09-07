<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class AuthorizationTest extends TestCase
{
    /** @test */
    public function it_cannot_see_report()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/report/cannot-see-user-report')
            ->assertStatus(403);
    }

    /** @test */
    public function it_cannot_see_resource()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/run/resource/cannot-see-resource')
            ->assertStatus(403);
    }

    /** @test */
    public function it_cannot_see_filter()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/run/filter/cannot-see-user-filter')
            ->assertStatus(403);
    }
}
