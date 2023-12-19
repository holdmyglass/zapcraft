<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;

class ZapCraftCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    public $signature = 'zapcraft:all {entity} {--module=}';

    public $description = 'Scafold an entity with all necessary files.';

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

        $model = $this->craft->craftModel($name, $module);
        $this->generateResponse($model);
        $this->line('');

        $migration = $this->craft->craftMigration($name, $module);
        $this->generateResponse($migration);
        $this->line('');

        $controller = $this->craft->craftController($name, $module);
        $this->generateResponse($controller);
        $this->line('');

        $repository = $this->craft->craftRepository($name, $module);
        $this->generateResponse($repository);
        $this->line('');

        $readInterface = $this->craft->craftInterface('read-interface', $name, $module);
        $this->generateResponse($readInterface);
        $this->line('');

        $writeInterface = $this->craft->craftInterface('write-interface', $name, $module);
        $this->generateResponse($writeInterface);
        $this->line('');

        $service = $this->craft->craftService($name, $module);
        $this->generateResponse($service);
        $this->line('');

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

        $resource = $this->craft->craftResource($name, $module);
        $this->generateResponse($resource);
        $this->line('');

        $collection = $this->craft->craftCollection($name, $module);
        $this->generateResponse($collection);
        $this->line('');

        $dto = $this->craft->craftDTO($name, $module);
        $this->generateResponse($dto);
        $this->line('');

        $route = $this->craft->craftRoute($name, $module);
        $this->generateResponse($route);
        $this->line('');

        $route = $this->craft->addRoutes($name, $module);
        $this->info('Routes added successfully');
        $this->line('');

        return self::SUCCESS;
    }
}
