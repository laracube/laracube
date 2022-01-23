<?php

namespace Laracube\Laracube\Http\Controllers;

use Illuminate\Http\Request;
use Laracube\Laracube\Laracube;

class RunFilterController extends Controller
{
    /**
     * Get the result of the filter.
     *
     * @param $uriKey
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index($uriKey, Request $request)
    {
        $filter = Laracube::getItemClass(Laracube::$filters, $uriKey);

        if (! $filter->canSee()) {
            abort(403);
        }

        return $filter->run();
    }
}
