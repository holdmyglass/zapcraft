<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftCollectionCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:collection {entity} {--module=}';

    public $description = 'Generate collection files for the entity';

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

        $collection = $this->craft->craftCollection($name, $module);
        $this->generateResponse($collection);
        $this->line('');

        return self::SUCCESS;
    }
}
