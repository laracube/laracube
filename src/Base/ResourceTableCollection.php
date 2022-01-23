<?php

namespace Laracube\Laracube\Base;

use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class ResourceTableCollection extends ResourceCollection
{
    /**
     * Get the columns definition for the report.
     *
     * @return array
     */
    abstract public static function columns();

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'columns' => static::columns(),
            ],
        ];
    }
}
