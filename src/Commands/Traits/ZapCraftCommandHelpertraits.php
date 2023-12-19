<?php

namespace HoldMyGlass\ZapCraft\Commands\Traits;

use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

trait ZapCraftCommandHelpertraits
{
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Element name'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', null, InputOption::VALUE_OPTIONAL, 'Module.', null],
        ];
    }

    /**
     * Generate terminal output depending on the type of message
     */
    private function generateResponse(array $response)
    {
        $message = $response['message'];
        $status = $response['status'];

        if ($status === 'error') {
            return $this->error($message);
        }

        if ($status === 'info') {
            return $this->info($message);
        }
    }

    private function confirmModule(string $module)
    {
        $module = ucwords($module);
        // generate module if it doesnot exist
        if (! Module::has($module)) {
            Artisan::call('module:make', ['name' => [$module]]);
            $this->info($module.' module created successfully.');
        }

        return $module;
    }
}
