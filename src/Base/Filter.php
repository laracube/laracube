<?php

namespace Laracube\Laracube\Base;

use Illuminate\Support\Str;
use Laracube\Laracube\Traits\AuthorizedToSee;

abstract class Filter
{
    use AuthorizedToSee;

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public $heading = null;

    /**
     * The single value that will be used as request key.
     *
     * @var string
     */
    public $key = null;

    /**
     * The type of the filter.
     *
     * @var string
     */
    public static $type = null;

    /**
     * Get the options for the filter.
     *
     * @return array
     */
    abstract public function options();

    /**
     * Get the URI key for the filter.
     *
     * @return string
     */
    public static function uriKey()
    {
        return Str::singular(Str::kebab(class_basename(get_called_class())));
    }

    /**
     * Set the heading of the filter.
     *
     * @param $heading
     *
     * @return $this
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Set the key of the filter.
     *
     * @param $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get details about the filter.
     *
     * @return array
     */
    public function details()
    {
        return [
            'uriKey' => static::uriKey(),
            'heading' => $this->heading,
            'type' => static::$type,
            'key' => $this->key,
        ];
    }

    /**
     * Run the filter.
     *
     * @return array
     */
    public function run()
    {
        return $this->options();
    }
}
