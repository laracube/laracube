<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Filters;

use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Base\Filter;

class UserFilter extends Filter
{
    /** {@inheritdoc} */
    public $heading = 'Select User';

    /** {@inheritdoc} */
    public $key = 'user_id';

    /** {@inheritdoc} */
    public static $type = 'single-select';

    /** {@inheritdoc} */
    public function options()
    {
        return User::orderBy('name')
            ->selectRaw('id AS value, first_name AS text')
            ->get();
    }
}
