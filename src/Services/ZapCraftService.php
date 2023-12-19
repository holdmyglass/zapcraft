<?php

namespace HoldMyGlass\ZapCraft\Services;

use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftCollectionTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftControllerTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftDtoTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftHelperTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftInterfaceTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftMigrationTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftModelTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftRepositoryTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftRequestTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftResourceTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftRouteTrait;
use HoldMyGlass\ZapCraft\Services\Traits\ZapCraftServiceTrait;

class ZapCraftService
{
    use ZapCraftCollectionTrait;
    use ZapCraftControllerTrait;
    use ZapCraftDtoTrait;
    use ZapCraftHelperTrait;
    use ZapCraftInterfaceTrait;
    use ZapCraftMigrationTrait;
    use ZapCraftModelTrait;
    use ZapCraftRepositoryTrait;
    use ZapCraftRequestTrait;
    use ZapCraftResourceTrait;
    use ZapCraftRouteTrait;
    use ZapCraftServiceTrait;
}
