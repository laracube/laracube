<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Filters;

use Laracube\Laracube\Base\Filter;
use Laracube\Laracube\Tests\Fixtures\Models\User;

class CannotSeeUserFilter extends Filter
{
    /** {@inheritdoc} */
    public $heading = 'Cannot See, Select User';

    /** {@inheritdoc} */
    public $key = 'cannot_see_user_id';

    /** {@inheritdoc} */
    public static $type = 'single-select';

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

    /** {@inheritdoc} */
    public function options()
    {
        return User::orderBy('name')
            ->selectRaw('id AS value, first_name AS text')
            ->get();
    }
}
