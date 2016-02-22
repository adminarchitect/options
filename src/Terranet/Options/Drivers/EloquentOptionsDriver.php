<?php

namespace Terranet\Options\Drivers;

use Terranet\Options\Contracts\Driver;
use Terranet\Options\Manager;

class EloquentOptionsDriver implements Driver
{
    protected static $options = null;

    /**
     * @var
     */
    protected $model;

    /**
     * EloquentOptionsDriver constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Find an option by name
     *
     * @param $name
     * @param $default
     * @return mixed
     */
    public function find($name, $default = null)
    {
        return ($options = $this->fetchAll()->lists('value', 'key')) && $options->has($name)
                ? $options->get($name)
                : $default;
    }

    /**
     * Fetch all options
     *
     * @return mixed
     */
    public function fetchAll()
    {
        if (static::$options === null) {
            static::$options = $this
                ->createModel()
                ->orderBy('key', 'asc')
                ->get();
        }

        return static::$options;
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createModel()
    {
        $class = '\\' . ltrim($this->model, '\\');

        return new $class;
    }

    /**
     * Save options
     *
     * @param        $options
     * @return mixed
     */
    public function save($options)
    {
        $updated = 0;
        while (list($key, $value) = each($options)) {
            $updated += $this
                ->createModel()
                ->whereKey($key)
                ->update(['value' => $value]);
        }

        return $updated;
    }

    /**
     * Create new option
     *
     * @param        $key
     * @param        $value
     * @param string $group
     * @return static
     */
    public function create($key, $value, $group = Manager::DEFAULT_GROUP)
    {
        return $this->createModel()->create([
            'key'   => $key,
            'value' => $value,
            'group' => $group,
        ]);
    }

    /**
     * Delete an option
     *
     * @param        $key
     * @return static
     */
    public function remove($key)
    {
        return $this->createModel()->whereKey($key)->delete();
    }
}
