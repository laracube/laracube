<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Resources;

use Illuminate\Http\Request;
use Laracube\Laracube\Base\ResourceCard;
use Laracube\Laracube\Tests\Fixtures\Models\User;

class CannotSeeResource extends ResourceCard
{
    /** {@inheritdoc} */
    public $heading = 'Cannot See, Number of Users';

    /** {@inheritdoc} */
    public $subHeading = 'Cannot See, Total number of users';

    /** {@inheritdoc} */
    public function canSee()
    {
        return false;
    }

    /** {@inheritdoc} */
    public function output(Request $request)
    {
        $count = User::count();

        return [
            [
                'type' => 'bigNumber',
                'data' => [
                    'line1' => [
                        'value' => $count,
                    ],
                    'line2' => [
                        'value' => $count - 5,
                    ],
                    'trend' => [
                        'value' =>  $count - 10,
                        'cssClass' => 'green--text text--darken-3',
                        'icon' => [
                            'value' => 'fa-arrow-up',
                            'cssClass' => 'green lighten-5 rounded-circle px-4 py-2',
                        ],
                    ],
                ],
            ],
        ];
    }
}
