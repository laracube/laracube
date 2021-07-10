<?php

namespace Laracube\Laracube\Tests\Fixtures\Laracube\Collections;;

use Laracube\Laracube\Base\ResourceTableCollection;

class UserCollection extends ResourceTableCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'company' => $item->company,
                'email' => $item->email,
                'created_at' => (string) $item->created_at,
            ];
        });
    }

    /**
     * Get the columns definition for the report
     *
     * @return array
     */
    public static function columns()
    {
        return [
            [
                'value' => 'first_name',
                'text' => 'First Name',
                'tooltip' => 'First Name of the user',
            ],
            [
                'value' => 'email',
                'text' => 'Email',
                'tooltip' => 'Email of the user',

            ],
            [
                'value' => 'company',
                'text' => 'Company',
                'tooltip' => null,
            ],
            [
                'value' => 'created_at',
                'text' => 'Registration Date',
                'tooltip' => null,
            ],
        ];
    }
}
