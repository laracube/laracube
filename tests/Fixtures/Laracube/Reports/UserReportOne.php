<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Reports;

use Laracube\Laracube\Base\Report;

class UserReportOne extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'User Report One';

    /** {@inheritdoc} */
    public static $heading = 'User Report One';

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
