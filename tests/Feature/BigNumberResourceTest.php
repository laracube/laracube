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
               'line1' => [
                   'value' => 40,
               ],
                'line2' => [
                    'value' => 35,
                ],
                'trend' => [
                    'value' => 30,
                    'icon' => 'fa-up',
                ],
                'sparkline' => [
                    'value' => [1, 2, 3],
                ],
            ]);
    }
}
