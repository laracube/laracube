<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

use Laracube\Laracube\Base\ResourceBigNumber;
use Laracube\Laracube\Tests\Fixtures\Models\User;

class BigNumber extends ResourceBigNumber
{
    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = 'Number of Users';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = 'Total number of users';

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    public function output()
    {
        $count = User::count();

        return [
            'line1' => [
                'value' => $count,
            ],
            'line2' => [
                'value' => $count - 5,
            ],
            'trend' => [
                'value' => $count - 10,
                'icon' => 'fa-up',
            ],
            'sparkline' => [
                'value' => [1, 2, 3],
            ],
        ];
    }
}
