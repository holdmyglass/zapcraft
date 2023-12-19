<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftDtoCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:dto {entity} {--module=}';

    public $description = 'Generate dto for the entity';

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

        $dto = $this->craft->craftDTO($name, $module);
        $this->generateResponse($dto);
        $this->line('');

        return self::SUCCESS;
    }
}
