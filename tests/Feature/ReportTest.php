<?php

namespace Laracube\Laracube\Tests\Feature;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Tests\TestCase;

class ReportTest extends TestCase
{
    /** @test */
    public function it_should_return_details_of_report()
    {
        factory(User::class)->create();

        $this->actingAs(User::first())
            ->post('laracube-api/report/user-report-one')
            ->assertSuccessful()
            ->assertJsonFragment([
                'meta' => [
                    'uriKey' => 'user-report-one',
                    'navigation' => 'User Report One',
                    'heading' => 'User Report One',
                    'subHeading' => 'This report shows all the users.',
                    'group' => 'Reports',
                ],
            ])
            ->assertJsonStructure([
                'meta' => [
                    'uriKey',
                    'navigation',
                    'heading',
                    'subHeading',
                    'group',
                ],
                'resources' => [],
                'filters' => [],
            ]);
    }
}
