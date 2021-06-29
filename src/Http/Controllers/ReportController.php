<?php

namespace Laracube\Laracube\Http\Controllers;

use Laracube\Laracube\Laracube;

class ReportController extends Controller
{
    /**
     * Get the result of the report.
     *
     * @param $uriKey
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function index($uriKey)
    {
        $report = Laracube::getItemClass(Laracube::$reports, $uriKey);

        return response()->json($report->details());
    }
}
