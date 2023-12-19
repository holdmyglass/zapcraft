<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftRepositoryCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:repository {entity} {--module=}';

    public $description = 'Generate a repository for the entity';

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

        $repository = $this->craft->craftRepository($name, $module);
        $this->generateResponse($repository);
        $this->line('');

        return self::SUCCESS;
    }
}
