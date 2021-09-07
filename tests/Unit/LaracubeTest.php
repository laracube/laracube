<?php

namespace Laracube\Laracube\Tests\Unit;

use Laracube\Laracube\Laracube;
use Laracube\Laracube\Tests\Fixtures\Laracube\Reports\UserReportOne;
use Laracube\Laracube\Tests\TestCase;

class LaracubeTest extends TestCase
{
    /** @test */
    public function it_should_register_report_items()
    {
        $this->assertCount(3, Laracube::$items['reports']);
    }

    /** @test */
    public function it_should_get_item_class()
    {
        $this->assertInstanceOf(
            UserReportOne::class,
            Laracube::getItemClass(Laracube::$reports, 'user-report-one')
        );
    }

    /** @test */
    public function it_should_get_item_details()
    {
        $this->assertCount(3, Laracube::getAllItemDetails(Laracube::$reports));
    }
}
