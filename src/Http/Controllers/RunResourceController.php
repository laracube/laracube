<?php

namespace Laracube\Laracube\Http\Controllers;

use Illuminate\Http\Request;
use Laracube\Laracube\Laracube;

class RunResourceController extends Controller
{
    /**
     * Get the result of the resource.
     *
     * @param $uriKey
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($uriKey, Request $request)
    {
        $resource = Laracube::getItemClass(Laracube::$resources, $uriKey);

        if (!$resource->canSee()) {
            abort(403);
        }

        return $resource->run();
    }
}
