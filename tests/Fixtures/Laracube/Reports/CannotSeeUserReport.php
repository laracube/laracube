<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Reports;

use Laracube\Laracube\Base\Report;

class CannotSeeUserReport extends Report
{
    /** {@inheritdoc} */
    public static $navigation = 'Cannot See, User Report';

    /** {@inheritdoc} */
    public static $heading = 'Cannot See, User Report';

    /** {@inheritdoc} */
    public static $subHeading = 'Cannot See, This report shows all the users.';

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

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
