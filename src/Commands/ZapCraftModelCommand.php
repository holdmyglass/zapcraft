<?php

namespace HoldMyGlass\ZapCraft\Commands;

use HoldMyGlass\ZapCraft\Commands\Traits\ZapCraftCommandHelpertraits;
use HoldMyGlass\ZapCraft\Services\ZapCraftService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ZapCraftModelCommand extends Command
{
    use ZapCraftCommandHelpertraits;

    protected $signature = 'zapcraft:model {entity} {--module=} {--m|migration : To create migration file}';

    public $description = 'Generate a model for an entity';

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

        if ($this->option('migration')) {
            $migration = $this->craft->craftMigration($name, $module);
            $this->generateResponse($migration);
            $this->line('');
        }

        return self::SUCCESS;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Flag to create associated migrations', null],
        ];
    }

    /**
     * Create the migration file with the given model if migration flag was used
     */
    private function handleOptionalMigrationOption(string $name, string $module)
    {
        if ($this->option('migration') === true) {
            $this->craft->craftMigration($name, $module);
        }
    }
}
