<?php

namespace Laracube\Laracube\Base;

abstract class ResourceBigNumber extends Resource
{
    /**
     * The component of the resource.
     *
     * @var string
     */
    protected static $component = 'big-number';

    /**
     * Get the output for the resource.
     *
     * @return array
     */
    abstract public function output();

    /**
     * Run the resource.
     *
     * @return array
     */
    public function run()
    {
        return $this->output();
    }
}
