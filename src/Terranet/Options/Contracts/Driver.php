<?php

namespace Terranet\Options\Contracts;

interface Driver
{
    /**
     * Fetch all options
     *
     * @return mixed
     */
    public function fetchAll();

    /**
     * Find an option by name
     *
     * @param $name
     * @param $default
     * @return mixed
     */
    public function find($name, $default = null);

    /**
     * Save options
     *
     * @param $options
     * @return mixed
     */
    public function save($options);

    /**
     * Create new option
     *
     * @param        $key
     * @param        $value
     * @param string $group
     * @return static
     */
    public function create($key, $value, $group = 'general');

    /**
     * Delete an option
     *
     * @param        $key
     * @return static
     */
    public function remove($key);
}
