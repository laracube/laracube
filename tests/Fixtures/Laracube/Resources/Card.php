<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;
use Laracube\Laracube\Tests\Fixtures\Models\User;

class Card extends ResourceCard
{
    /** {@inheritdoc} */
    public $heading = 'Number of Users';

    /** {@inheritdoc} */
    public $subHeading = 'Total number of users';

    /** {@inheritdoc} */
    public function output(Request $request)
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
