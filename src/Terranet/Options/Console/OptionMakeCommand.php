<?php

namespace Terranet\Options\Console;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Terranet\Options\Manager;

class OptionMakeCommand extends Command
{
    protected $name = 'options:make';

    protected $description = 'Insert new option';

    public function fire()
    {
        $name = $this->argument('name');
        $value = $this->argument('value') ? : '';
        $group = $this->argument('group') ? : Manager::DEFAULT_GROUP;

        try {
            options_create($name, $value, $group);
            $this->info("Option \"{$name}\" has been created.");
        } catch (Exception $e) {
            $this->warn("Can not create option \"{$name}\".");
            $this->comment($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the option'],
            ['value', InputArgument::REQUIRED, 'The value of the option'],
            ['group', InputArgument::OPTIONAL, 'The group of the option'],
        ];
    }
}
