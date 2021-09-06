<?php

namespace Laracube\Laracube\Base;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laracube\Laracube\Traits\AuthorizedToSee;

abstract class Resource
{
    use AuthorizedToSee;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = null;

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public $subHeading = null;

    /**
     * The columns of the resource.
     *
     * @var int
     */
    public $columns = 3;

    /**
     * The component of the resource.
     *
     * @var string
     */
    protected static $component = null;

    /**
     * The type of the resource.
     *
     * @var string
     */
    public static $type = null;

    /**
     * Run the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     * @throws \Throwable
     */
    abstract public function run(Request $request);

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    {
        return Str::singular(Str::kebab(class_basename(get_called_class())));
    }

    /**
     * Set the columns of the resource.
     *
     * @param $columns
     *
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get details about the resource.
     *
     * @return array
     */
    public function details()
    {
        return [
            'uriKey' => static::uriKey(),
            'heading' => $this->heading,
            'subHeading' => $this->subHeading,
            'columns' => $this->columns,
            'component' => static::$component,
            'type' => static::$type,
        ];
    }
}
