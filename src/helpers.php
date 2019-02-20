<?php

use Terranet\Options\Manager;

if (! function_exists('options_fetch')) {
    /**
     * Fetch all available options
     *
     * @param null|string $group
     * @return
     */
    function options_fetch($group = null)
    {
        return app('terranet.options')->fetchAll($group);
    }
}

if (! function_exists('options_save')) {
    function options_save($options)
    {
        return app('terranet.options')->save($options);
    }
}

if (! function_exists('options_find')) {
    /**
     * Fetch specific option
     * @param $key
     * @param null $default
     * @return
     */
    function options_find($key, $default = null)
    {
        return app('terranet.options')->find($key, $default);
    }
}

if (! function_exists('options_create')) {
    /**
     * Fetch specific option
     * @param $key
     * @param string $value
     * @param string $group
     * @return
     */
    function options_create($key, $value = '', $group = Manager::DEFAULT_GROUP)
    {
        return app('terranet.options')->create($key, $value, $group);
    }
}

if (! function_exists('options_remove')) {
    /**
     * Fetch specific option
     * @param $key
     * @return
     */
    function options_remove($key)
    {
        return app('terranet.options')->remove($key);
    }
}
