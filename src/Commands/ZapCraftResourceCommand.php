<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftResourceCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:resource {entity} {--module=}';

    public $description = 'Generate resource files for the entity';

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

        $resource = $this->craft->craftResource($name, $module);
        $this->generateResponse($resource);
        $this->line('');

        return self::SUCCESS;
    }
}
