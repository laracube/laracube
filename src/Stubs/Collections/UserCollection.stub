<?php

namespace App\Laracube\Collections;

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
        return $this->collection->transform(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => (string) $user->created_at,
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
                'value' => 'name',
                'text' => 'Name',
                'tooltip' => 'Name of the user',
            ],
            [
                'value' => 'email',
                'text' => 'Email',
                'tooltip' => 'Email of the user',

            ],
            [
                'value' => 'created_at',
                'text' => 'Registration Date',
                'tooltip' => null,
            ],
        ];
    }
}
