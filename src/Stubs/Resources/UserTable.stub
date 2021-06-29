<?php

namespace App\Laracube\Resources;

use App\Laracube\Collections\UserCollection;
use App\Models\User;
use Laracube\Laracube\Base\ResourceTable;

class UserTable extends ResourceTable
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
