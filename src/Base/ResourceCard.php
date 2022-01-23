<?php

namespace Laracube\Laracube\Base;

use Illuminate\Http\Request;

abstract class ResourceCard extends Resource
{
    /**
     * The component of the resource.
     *
     * @var string
     */
    protected static $component = 'card';

    /**
     * Get the output for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    abstract public function output(Request $request);

    /**
     * Run the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function run(Request $request)
    {
        return $this->output($request);
    }
}
