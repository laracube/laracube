<?php

namespace Laracube\Laracube\Http\Controllers;

use Laracube\Laracube\Laracube;

class RunResourceController extends Controller
{
    /**
     * Get the result of the resource.
     *
     * @param $uriKey
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function index($uriKey)
    {
        $report = Laracube::getItemClass(Laracube::$resources, $uriKey);

        return $report->run();
    }
}
