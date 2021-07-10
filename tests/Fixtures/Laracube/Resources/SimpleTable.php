<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

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

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'User List';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'List of all users.';

    /**
     * The type of the resource.
     *
     * @var string
     */
    public static $type = 'simple';

    /**
     * Get the query for the report.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function query()
    {
        return User::orderBy('name');
    }
}
