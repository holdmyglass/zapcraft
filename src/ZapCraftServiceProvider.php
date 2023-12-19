<?php

namespace HoldMyGlass\ZapCraft;

use HoldMyGlass\ZapCraft\Commands\ZapCraftCollectionCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftControllerCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftDtoCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftInterfaceCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftMigrationCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftModelCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftRepositoryCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftResourceCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftRouteCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftServiceCommand;
use HoldMyGlass\ZapCraft\Commands\ZapCraftRequestCommand;
use Illuminate\Support\ServiceProvider;

class ZapCraftServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->commands([
            ZapCraftCommand::class,
            ZapCraftModelCommand::class,
            ZapCraftMigrationCommand::class,
            ZapCraftControllerCommand::class,
            ZapCraftRepositoryCommand::class,
            ZapCraftInterfaceCommand::class,
            ZapCraftRequestCommand::class,
            ZapCraftServiceCommand::class,
            ZapCraftDtoCommand::class,
            ZapCraftResourceCommand::class,
            ZapCraftCollectionCommand::class,
            ZapCraftRouteCommand::class
        ]);
    }
}
