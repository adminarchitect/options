<?php

namespace Terranet\Options\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class OptionRemoveCommand extends Command
{
    protected $name = 'options:remove';

    protected $description = 'Remove an option';

    public function handle()
    {
        $name = $this->argument('name');

        if (options_remove($name)) {
            $this->info("Option \"{$name}\" has been removed.");
        } else {
            $this->warn("Can not remove option \"{$name}\". Option not found.");
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
        ];
    }
}
