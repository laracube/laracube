<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceTable;
use Laracube\Laracube\Tests\Fixtures\Laracube\Collections\UserCollection;
use Laracube\Laracube\Tests\Fixtures\Models\User;

class SimpleTable extends ResourceTable
{
    /**
     * Resource Collection class.
     *
     * @var string
     */
    public static $collection = UserCollection::class;

    /** {@inheritdoc} */
    public $heading = 'User List';

    /** {@inheritdoc} */
    public $subHeading = 'List of all users.';

    /** {@inheritdoc} */
    public static $type = 'simple';

    /** {@inheritdoc} */
    public function query(Request $request)
    {
        return User::orderBy('name');
    }
}
