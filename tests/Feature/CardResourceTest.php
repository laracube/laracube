<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class CardResourceTest extends TestCase
{
    /** @test */
    public function it_should_return_correct_response()
    {
        factory(User::class, 40)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/run/resource/card')
            ->assertSuccessful()
            ->assertJson([
                [
                    'type' => 'bigNumber',
                    'data' => [
                        'line1' => [
                            'value' => 40,
                        ],
                        'line2' => [
                            'value' => 35,
                        ],
                        'trend' => [
                            'value' =>  30,
                            'cssClass' => 'green--text text--darken-3',
                            'icon' => [
                                'value' => 'fa-arrow-up',
                                'cssClass' => 'green lighten-5 rounded-circle px-4 py-2',
                            ],
                        ],
                    ],
                ],
            ]);
    }
}
