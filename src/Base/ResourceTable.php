<?php

namespace Laracube\Laracube\Base;

use Illuminate\Http\Request;

abstract class ResourceTable extends Resource
{
    /**
     * The component of the resource.
     *
     * @var string
     */
    protected static $component = 'table';

    /**
     * The type of the resource.
     *
     * @var string
     */
    public static $type = 'paginated';

    /**
     * The per-page options for the resource.
     *
     * @var array
     */
    public static $perPageOptions = 20;

    /**
     * Get the query for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Throwable
     */
    abstract public function query(Request $request);

    /**
     * Run the resource.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function run(Request $request)
    {
        if (static::$type === 'paginated') {
            $resource = $this->query($request)
                ->paginate(static::$perPageOptions);
        } else {
            $resource = $this->query($request)
                ->get();
        }

        return new static::$collection($resource);
    }
}
