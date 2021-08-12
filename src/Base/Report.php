<?php

namespace Laracube\Laracube\Base;

use Illuminate\Support\Str;
use Laracube\Laracube\Traits\AuthorizedToSee;

abstract class Report
{
    use AuthorizedToSee;

    /**
     * The logical group associated with the report.
     *
     * @var string
     */
    public static $group = 'Reports';

    /**
     * The single value name that would be used to display in navigation.
     *
     * @var string
     */
    public static $navigation = 'navigation';

    /**
     * The single value that will be displayed as heading.
     *
     * @var string
     */
    public static $heading = 'heading';

    /**
     * The single value that will be displayed as sub-heading.
     *
     * @var string
     */
    public static $subHeading = 'sub-heading';

    /**
     * Get the resources for the report.
     *
     * @return array
     */
    abstract public function resources();

    /**
     * Get the filters for the report.
     *
     * @return array
     */
    abstract public function filters();

    /**
     * Get the URI key for the report.
     *
     * @return string
     */
    public static function uriKey()
    {
        return Str::singular(Str::kebab(class_basename(get_called_class())));
    }

    /**
     * Get details information about the report.
     *
     * @return array
     */
    public function details()
    {
        return [
            'meta' => $this->meta(),
            'resources' => $this->getResources(),
            'filters' => $this->getFilters(),
        ];
    }

    /**
     * Get meta information about the report.
     *
     * @return array
     */
    private function meta()
    {
        return [
            'uriKey' => static::uriKey(),
            'navigation' => static::$navigation,
            'heading' => static::$heading,
            'subHeading' => static::$subHeading,
            'group' => static::$group,
        ];
    }

    /**
     * Get all the resources of the report.
     *
     * @return array
     */
    private function getResources()
    {
        $resources = [];

        foreach ($this->resources() as $resource) {
            if ($resource->canSee()) {
                $resources[] = $resource->details();
            }
        }

        return $resources;
    }

    /**
     * Get all the filters of the report.
     *
     * @return array
     */
    private function getFilters()
    {
        $filters = [];

        foreach ($this->filters() as $filter) {
            if ($filter->canSee()) {
                $filters[] = $filter->details();
            }
        }

        return $filters;
    }
}
