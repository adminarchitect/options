<?php

namespace Terranet\Options;

use Illuminate\Support\Manager as DriverManager;
use Terranet\Options\Drivers\DatabaseOptionsDriver;
use Terranet\Options\Drivers\EloquentOptionsDriver;

class Manager extends DriverManager
{
    const DEFAULT_GROUP = 'general';

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'DatabaseOptions';
    }

    public function createEloquentOptionsDriver()
    {
        return new EloquentOptionsDriver(
            Option::class
        );
    }

    public function createDatabaseOptionsDriver()
    {
        $db = $this->container->get('db');
        return new DatabaseOptionsDriver($db->connection(), 'options');
    }
}
