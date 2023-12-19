<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftServiceCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:request {entity} {--module=}';

    public $description = 'Generate requests for the entity';

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

        $readInterface = $this->craft->craftInterface('read-interface', $name, $module);
        $this->generateResponse($readInterface);
        $this->line('');

        $writeInterface = $this->craft->craftInterface('write-interface', $name, $module);
        $this->generateResponse($writeInterface);
        $this->line('');

        return self::SUCCESS;
    }
}
