<?php

namespace Terranet\Options\Drivers;

use Illuminate\Database\ConnectionInterface;
use Terranet\Options\Contracts\Driver;

class DatabaseOptionsDriver implements Driver
{
    protected static $options;

    /**
     * @var ConnectionInterface
     */
    private $conn;

    /**
     * @var
     */
    private $table;

    /**
     * DatabaseOptionsDriver constructor.
     *
     * @param ConnectionInterface $conn
     * @param                     $table
     */
    public function __construct(ConnectionInterface $conn, $table)
    {
        $this->conn = $conn;
        $this->table = $table;
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
     * Find an option by name
     *
     * @param $name
     * @param $default
     * @return mixed
     */
    public function find($name, $default = null)
    {
        foreach ($this->fetchAll() as $option) {
            if ($option->key == $name) {
                return $option->value;
            }
        }

        return $default;
    }

    /**
     * Save options
     *
     * @param $options
     * @return int
     */
    public function save($options)
    {
        $updated = 0;

        foreach ($options as $key => $value) {
            $updated += $this
                ->createModel()
                ->where('key', '=', $key)
                ->update(['value' => $value]);
        }

        return $updated;
    }

    /**
     * Create new option
     *
     * @param string $key
     * @param string $value
     * @param string $group
     * @return bool
     */
    public function create($key, $value, $group = 'general')
    {
        return $this->createModel()
            ->insert([
                'key' => $key,
                'value' => $value,
                'group' => $group,
            ]);
    }

    /**
     * Delete an option
     *
     * @param string $key
     * @return int
     */
    public function remove($key)
    {
        return $this->createModel()->where('key', '=', $key)->delete();
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function createModel()
    {
        return $this->conn->table($this->table);
    }
}
