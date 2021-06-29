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
        $reports = Laracube::getAllItemDetails(Laracube::$reports);
        $landing = null;
        $collection = collect($reports);
        $grouped = $collection->groupBy('meta.group');
        $groups = $grouped->all();

        foreach ($groups as $group) {
            foreach ($group as $item) {
                $landing = $item['meta']['uriKey'];
                break;
            }
            break;
        }

        return view('laracube::layout', [
            'user' => auth()->user(),
            'groups' => $groups,
            'laracubeConfig' => [
                'path' => config('laracube.path', '/'),
                'landingReport' => $landing,
            ],
        ]);
    }
}
