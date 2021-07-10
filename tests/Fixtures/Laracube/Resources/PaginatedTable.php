<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

use Laracube\Laracube\Tests\Fixtures\Laracube\Collections\UserCollection;
use Laracube\Laracube\Tests\Fixtures\Models\User;
use Laracube\Laracube\Base\ResourceTable;

class PaginatedTable extends ResourceTable
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
