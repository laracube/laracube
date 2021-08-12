<?php

namespace Laracube\Laracube\Http\Controllers;

use Illuminate\Http\Request;
use Laracube\Laracube\Laracube;

class ReportController extends Controller
{
    /**
     * Get the result of the report.
     *
     * @param $uriKey
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($uriKey, Request $request)
    {
        $report = Laracube::getItemClass(Laracube::$reports, $uriKey);

        if (!$report->canSee()) {
            abort(403);
        }

        return response()->json($report->details());
    }
}
