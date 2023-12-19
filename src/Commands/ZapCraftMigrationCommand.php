<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftMigrationCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    public $signature = 'zapcraft:migration {entity} {--module=}';

    public $description = 'Generate a migration file for an entity';

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

        $model = $this->craft->craftMigration($name, $module);
        $this->generateResponse($model);
        $this->line('');

        return self::SUCCESS;
    }
}
