<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class  ZapCraftRequestCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:request {entity} {--module=}';

    public $description = 'Generate request classes for the entity';

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

        $oneRequest = $this->craft->craftRequest('readOne-request', $name, $module);
        $this->generateResponse($oneRequest);
        $this->line('');

        $manyRequest = $this->craft->craftRequest('readMany-request', $name, $module);
        $this->generateResponse($manyRequest);
        $this->line('');

        $createRequest = $this->craft->craftRequest('create-request', $name, $module);
        $this->generateResponse($createRequest);
        $this->line('');

        $updateRequest = $this->craft->craftRequest('update-request', $name, $module);
        $this->generateResponse($updateRequest);
        $this->line('');

        $deleteRequest = $this->craft->craftRequest('delete-request', $name, $module);
        $this->generateResponse($deleteRequest);
        $this->line('');

        return self::SUCCESS;
    }
}
