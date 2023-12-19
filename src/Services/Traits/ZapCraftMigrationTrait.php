<?php

namespace HoldMyGlass\ZapCraft\Services\Traits;

trait ZapCraftMigrationTrait
{
    use ZapCraftHelperTrait;

    // generate migration
    public function craftMigration(string $name, string $module): array
    {
        $placeholders = [
            '{{ table_name }}' => $this->getTableName($name),
        ];

        $stub = $this->getStub($name, 'migration', $module);
        $path = $this->getDestination($name, 'migration', $module);
        $path = $this->makeDirectory($path);
        if ($this->checkIfMigrationExist($path)) {
            return [
                'status' => 'error',
                'message' => 'Migration already exist for this table',
            ];
        }
        if ($this->generateFromStub($stub, $path, $placeholders)) {
            return [
                'status' => 'info',
                'message' => 'Migration created at: '.$path,
            ];
        }
    }
}
