<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftControllerCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:controller {entity} {--module=}';

    public $description = 'Generate a Controller for the entity';

    public function __construct(
        private ZapCraftService $craft
    ) {
        parent::__construct();
    }

    public function handle(): int
    {

        $name = $this->argument('entity');
        $module = $this->option('module');

        $module = $this->confirmModule($module);

        $controller = $this->craft->craftController($name, $module);
        $this->generateResponse($controller);
        $this->line('');

        return self::SUCCESS;
    }
}
