<?php

namespace Laracube\Laracube;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class Laracube
{
    /**
     * Item key for reports.
     *
     * @var string
     */
    public static $reports = 'reports';

    /**
     * Item key for resources.
     *
     * @var string
     */
    public static $resources = 'resources';

    /**
     * Item key for filters.
     *
     * @var string
     */
    public static $filters = 'filters';

    /**
     * The registered items.
     *
     * @var array
     */
    public static $items = [];

    /**
     * The callback that should be used to authenticate Laracube users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Determine if the given request can access the Laracube dashboard.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public static function check(Request $request)
    {
        return (static::$authUsing)($request);
    }

    /**
     * Set the callback that should be used to authenticate Laracube users.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Get the current Laracube version.
     *
     * @return string
     */
    public static function version()
    {
        return '0.2.3';
    }

    /**
     * Register all of the item classes in the given directory.
     *
     * @param $itemKey
     * @param string $directory
     * @param $baseClass
     *
     * @return void
     * @throws \ReflectionException
     */
    public static function registerItems($itemKey, string $directory, $baseClass)
    {
        $namespace = app()->getNamespace();

        $items = [];

        if (! File::isDirectory($directory)) {
            return;
        }

        foreach ((new Finder())->in($directory)->files() as $item) {
            $item = $namespace.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($item->getPathname(), app_path().DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($item, $baseClass) &&
                ! (new ReflectionClass($item))->isAbstract()) {
                $items[$item::uriKey()] = $item;
            }
        }

        static::$items[$itemKey] = array_unique(
            array_merge(Arr::get(static::$items, $itemKey, []), $items)
        );
    }

    /**
     * Push Items.
     *
     * @param $itemKey
     * @param array $items
     */
    public static function pushItems($itemKey, array $items)
    {
        $pushItems = [];

        foreach ($items as $item) {
            $pushItems[$item::uriKey()] = $item;
        }

        static::$items[$itemKey] = array_unique(
            array_merge(Arr::get(static::$items, $itemKey, []), $pushItems)
        );
    }

    /**
     * Get the item class by key.
     *
     * @param $itemKey
     * @param $uriKey
     *
     * @return mixed
     */
    public static function getItemClass($itemKey, $uriKey)
    {
        $class = Collection::make(static::$items[$itemKey])->first(function ($value) use ($uriKey) {
            return $value::uriKey() === $uriKey;
        });

        return new $class();
    }

    /**
     * Return the details of items.
     *
     * @param $itemKey
     *
     * @return array
     */
    public static function getAllItemDetails($itemKey)
    {
        $output = [];

        foreach (static::$items[$itemKey] as $item) {
            $class = static::getItemClass($itemKey, $item::uriKey());
            $output[$item::uriKey()] = $class->details();
        }

        ksort($output);

        return $output;
    }
}
