<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Reports;

use Laracube\Laracube\Base\Report;

class UserReportTwo extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'User Report Two';

    /** {@inheritdoc} */
    public static $heading = 'User Report Two';

    /** {@inheritdoc} */
    public static $subHeading = 'This report shows all the users.';

    /** {@inheritdoc} */
    public function resources()
    {
        return [];
    }

    /** {@inheritdoc} */
    public function filters()
    {
        return [];
    }
}
