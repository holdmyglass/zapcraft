<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftRouteCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:route {entity} {--module=}';

    public $description = 'Generate routes for the entity';

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

        $route = $this->craft->craftRoute($name, $module);
        $this->generateResponse($route);
        $this->line('');

        $route = $this->craft->addRoutes($name, $module);
        $this->info('Routes added successfully');
        $this->line('');

        return self::SUCCESS;
    }
}
