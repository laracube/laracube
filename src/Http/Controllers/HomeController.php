<?php

namespace Laracube\Laracube\Http\Controllers;

use Laracube\Laracube\Laracube;

class HomeController extends Controller
{
    /**
     * Single page application catch-all route.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = $this->getAllReportsByGroup();

        return view('laracube::layout', [
            'user' => auth()->user(),
            'groups' => $groups,
            'laracubeConfig' => [
                'path' => config('laracube.path', '/'),
                'landingReport' => $this->getLandingReport($groups),
            ],
        ]);
    }

    /**
     * Get all the report by group.
     *
     * @return array
     */
    private function getAllReportsByGroup()
    {
        $reports = $this->getAllReports();

        $collection = collect($reports);
        $grouped = $collection->groupBy('meta.group');

        return $grouped->all();
    }

    /**
     * Get all reports.
     *
     * @return array
     */
    private function getAllReports()
    {
        $reports = Laracube::getAllItemDetails(Laracube::$reports);

        foreach ($reports as $key => $report) {
            $class = Laracube::getItemClass(Laracube::$reports, $key);
            if (!$class->canSee()) {
                unset($reports[$key]);
            }
        }

        return $reports;
    }

    /**
     * Get the landing report.
     *
     * @param $groups
     *
     * @return mixed
     */
    private function getLandingReport($groups)
    {
        foreach ($groups as $group) {
            foreach ($group as $item) {
                return $item['meta']['uriKey'];
            }
        }
    }
}
