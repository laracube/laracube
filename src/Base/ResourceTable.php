<?php

namespace Laracube\Laracube\Base;

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
     * @return mixed
     * @throws \Throwable
     */
    abstract public function query();

    /**
     * Run the resource.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function run()
    {
        if (static::$type === 'paginated') {
            $resource = $this->query()
                ->paginate(static::$perPageOptions);

            return new static::$collection($resource);
        } else {
            $resource = $this->query()
                ->get();

            return new static::$collection($resource);
        }
    }
}
